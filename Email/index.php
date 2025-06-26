<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Configuration 
$batchSize = 1; 
$csvFile = 'clients.csv';
$trackingFile = 'email_tracking.json';
$emailTemplate = 'emailbody.html';
$maxExecutionTime = 0; // No time limit for script execution

// Set maximum execution time to avoid timeouts
ini_set('max_execution_time', $maxExecutionTime);
set_time_limit($maxExecutionTime);

// Memory limit increase
ini_set('memory_limit', '256M');

// Initialize tracking data
function initializeTrackingData() {
    if (file_exists($GLOBALS['trackingFile'])) {
        $data = json_decode(file_get_contents($GLOBALS['trackingFile']), true);
        if (is_array($data)) {
            return $data;
        }
    }
    
    // Create tracking file if it doesn't exist with default values
    $defaultData = [
        'current_index' => 0,
        'total_processed' => 0,
        'last_batch_time' => null,
        'all_sent' => false,
        'current_batch_progress' => 0  // Track progress within a batch
    ];
    
    // Make sure the directory exists
    $dir = dirname($GLOBALS['trackingFile']);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    // Save default data
    file_put_contents($GLOBALS['trackingFile'], json_encode($defaultData, JSON_PRETTY_PRINT));
    
    return $defaultData;
}

// Save tracking data
function saveTrackingData($data) {
    file_put_contents($GLOBALS['trackingFile'], json_encode($data, JSON_PRETTY_PRINT));
}

// Process CSV file
function getClientsFromCSV($startIndex, $batchSize) {
    $clients = [];
    $count = 0;
    $currentIndex = 0;
    
    if (($handle = fopen($GLOBALS['csvFile'], "r")) !== FALSE) {
        // Skip header row
        fgetcsv($handle);
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            // Skip rows until we reach the starting index
            if ($currentIndex < $startIndex) {
                $currentIndex++;
                continue;
            }
            
            // Get client data
            $email = isset($data[0]) ? trim($data[0]) : '';
            $name = isset($data[1]) ? trim($data[1]) : '';
            $address = isset($data[2]) ? trim($data[2]) : '';
            $customerNumber = isset($data[3]) ? trim($data[3]) : '';
            $sentStatus = isset($data[4]) ? trim($data[4]) : "No";
            
            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Skip invalid emails but count them
                $currentIndex++;
                continue;
            }
            
            // Only include clients that haven't been marked as sent
            if ($sentStatus !== "Yes") {
                $clients[] = [
                    'email' => $email,
                    'name' => $name,
                    'address' => $address,
                    'customer_number' => $customerNumber,
                    'row_index' => $currentIndex
                ];
                
                $count++;
                if ($count >= $batchSize) {
                    break;
                }
            }
            
            $currentIndex++;
        }
        fclose($handle);
    }
    
    return [
        'clients' => $clients,
        'last_index' => $currentIndex,
        'total_rows' => countTotalRows() - 1  // Subtract 1 for header
    ];
}

// Count total rows in CSV file
function countTotalRows() {
    $rowCount = 0;
    if (($handle = fopen($GLOBALS['csvFile'], "r")) !== FALSE) {
        while (fgetcsv($handle) !== FALSE) {
            $rowCount++;
        }
        fclose($handle);
    }
    return $rowCount;
}

// Mark clients as sent in CSV - Process in chunks to avoid memory issues
function markClientsAsSent($clients) {
    // Process clients in chunks of 50 to avoid memory issues with large batches
    $chunkSize = 50;
    $clientChunks = array_chunk($clients, $chunkSize);
    
    foreach ($clientChunks as $clientChunk) {
        markClientChunkAsSent($clientChunk);
    }
}

// Process a chunk of clients
function markClientChunkAsSent($clientChunk) {
    // Read entire CSV file
    $rows = [];
    if (($handle = fopen($GLOBALS['csvFile'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    
    // Update sent status for processed clients
    foreach ($clientChunk as $client) {
        $rowIndex = $client['row_index'] + 1; // +1 because we count header as row 0
        if (isset($rows[$rowIndex])) {
            // Make sure the array has at least 5 elements
            while (count($rows[$rowIndex]) < 5) {
                $rows[$rowIndex][] = "";
            }
            $rows[$rowIndex][4] = "Yes"; // Mark as sent
        }
    }
    
    // Write updated data back to CSV
    if (($handle = fopen($GLOBALS['csvFile'], "w")) !== FALSE) {
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}

// Reset all clients as unsent
function resetAllClients() {
    // Read entire CSV file
    $rows = [];
    if (($handle = fopen($GLOBALS['csvFile'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    
    // Reset sent status for all rows except header
    for ($i = 1; $i < count($rows); $i++) {
        // Make sure each row has at least 5 elements
        while (count($rows[$i]) < 5) {
            $rows[$i][] = "";
        }
        $rows[$i][4] = "No"; // Reset sent status
    }
    
    // Write updated data back to CSV
    if (($handle = fopen($GLOBALS['csvFile'], "w")) !== FALSE) {
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}

// Send emails to clients using PHPMailer with chunking and progress updates
function sendEmails($clients) {
    require 'vendor/autoload.php';
    
    $emailContent = file_get_contents($GLOBALS['emailTemplate']);
    $sentCount = 0;
    $failedCount = 0;
    $totalToSend = count($clients);
    $tracking = initializeTrackingData();
    $chunkSize = 20; // Process in smaller chunks for better progress tracking
    
    // Break clients into smaller chunks for processing
    $clientChunks = array_chunk($clients, $chunkSize);
    
    foreach ($clientChunks as $chunkIndex => $clientChunk) {
        // Update current progress
        $tracking['current_batch_progress'] = $sentCount;
        saveTrackingData($tracking);
        
        // Process this chunk
        foreach ($clientChunk as $client) {
            // Create a new PHPMailer instance for each email
            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();                           
                $mail->Host       = 'smtp.gmail.com';      
                $mail->SMTPAuth   = true;                  
                $mail->Username   = 'ahmnanzil33@gmail.com'; 
                $mail->Password   = 'hpitjdlzhhmnhurc'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port       = 587;
                
                // SMTP keep-alive - helps with multiple emails
                $mail->SMTPKeepAlive = true;
                
                // Sender
                $mail->setFrom('ahmnanzil22334@gmail.com', 'Web Development');
                
                // Recipient
                $mail->addAddress($client['email'], $client['name']);
                
                // Content
                $emailTemplatePath = __DIR__ . '/emailbody.html';
                $emailBody = file_get_contents($emailTemplatePath);

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = "Boost Your Online Presence with a Professional Website 🌐";
                $mail->Body = $emailBody;
                
                // Send email
                $mail->send();
                $sentCount++;
                
                // Log successful send
                error_log("Email sent successfully to: " . $client['email']);
                
                // Small delay between emails - prevents Gmail from blocking
                usleep(100000); // 100ms delay
                
            } catch (Exception $e) {
                // Log error but continue with next email
                $failedCount++;
                error_log("Failed to send email to {$client['email']}: {$mail->ErrorInfo}");
            }
            
            // Close SMTP connection for this email
            $mail->smtpClose();
            
            // Update progress after each email (optional - could be less frequent)
            if ($sentCount % 10 == 0) {
                $tracking['current_batch_progress'] = $sentCount;
                saveTrackingData($tracking);
            }
        }
        
        // After each chunk, mark them as sent to save progress
        markClientsAsSent($clientChunk);
        
        // Prevent memory issues
        gc_collect_cycles();
        
        // Small pause between chunks to prevent overwhelming the server
        sleep(1);
    }
    
    return [
        'sent' => $sentCount,
        'failed' => $failedCount,
        'total' => $totalToSend
    ];
}

// Main function to process and send emails
function processEmails() {
    // Initialize tracking data
    $tracking = initializeTrackingData();
    
    // Reset batch progress
    $tracking['current_batch_progress'] = 0;
    saveTrackingData($tracking);
    
    // Get clients for current batch
    $result = getClientsFromCSV($tracking['current_index'], $GLOBALS['batchSize']);
    $clients = $result['clients'];
    $totalRows = $result['total_rows'];
    
    // If no clients to process, check if we've processed everything
    if (empty($clients)) {
        if ($tracking['total_processed'] >= $totalRows || $tracking['all_sent']) {
            // Reset everything and start over
            resetAllClients();
            $tracking['current_index'] = 0;
            $tracking['total_processed'] = 0;
            $tracking['all_sent'] = false;
            $tracking['current_batch_progress'] = 0;
            saveTrackingData($tracking);
            return [
                'status' => 'reset',
                'message' => 'All clients have been processed. Starting over from the beginning.'
            ];
        } else {
            // Move to next batch position
            $tracking['current_index'] = $result['last_index'];
            saveTrackingData($tracking);
            return [
                'status' => 'skip',
                'message' => 'No new clients to process at this position. Moving to next batch.'
            ];
        }
    }
    
    // Send emails
    $emailResult = sendEmails($clients);
    $sentCount = $emailResult['sent'];
    $failedCount = $emailResult['failed'];
    
    // Update tracking data
    $tracking['current_index'] = $result['last_index'];
    $tracking['total_processed'] += $sentCount;
    $tracking['last_batch_time'] = date('Y-m-d H:i:s');
    $tracking['current_batch_progress'] = 0; // Reset batch progress
    
    // Check if we've processed all clients
    if ($tracking['total_processed'] >= $totalRows) {
        $tracking['all_sent'] = true;
    }
    
    saveTrackingData($tracking);
    
    return [
        'status' => 'success',
        'sent_count' => $sentCount,
        'failed_count' => $failedCount,
        'total_processed' => $tracking['total_processed'],
        'total_clients' => $totalRows,
        'next_batch_starts_at' => $tracking['current_index']
    ];
}

// Function to get current progress for AJAX calls
function getCurrentProgress() {
    $tracking = initializeTrackingData();
    $totalRows = countTotalRows() - 1; // Subtract 1 for header
    
    return [
        'current_batch_progress' => $tracking['current_batch_progress'],
        'batch_size' => $GLOBALS['batchSize'],
        'total_processed' => $tracking['total_processed'],
        'total_clients' => $totalRows,
        'progress_percentage' => round(($tracking['total_processed'] / max(1, $totalRows)) * 100, 1)
    ];
}

// Execute if this script is accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    // Check if this is an AJAX request to get progress
    if (isset($_GET['action']) && $_GET['action'] == 'getProgress') {
        header('Content-Type: application/json');
        echo json_encode(getCurrentProgress());
        exit;
    }
    
    // Check if this is an AJAX request or a direct POST request to process emails
    if ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ||
        (isset($_POST['action']) && $_POST['action'] == 'sendEmails')) {
        $result = processEmails();
        
        // Return JSON response for AJAX requests, otherwise show a message
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?status=' . $result['status'] . '&sent=' . ($result['sent_count'] ?? 0));
            exit;
        }
    }
    
    // Otherwise, show the admin interface
    $tracking = initializeTrackingData();
    $totalRows = countTotalRows() - 1; // Subtract 1 for header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Campaign Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        .stats {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .progress-bar {
            height: 20px;
            background-color: #e0e0e0;
            border-radius: 4px;
            margin: 10px 0;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background-color: #4CAF50;
            width: <?php echo ($tracking['total_processed'] / max(1, $totalRows)) * 100; ?>%;
            transition: width 0.5s;
        }
        .batch-progress-bar {
            height: 20px;
            background-color: #e0e0e0;
            border-radius: 4px;
            margin: 10px 0;
            overflow: hidden;
        }
        .batch-progress-bar-fill {
            height: 100%;
            background-color: #2196F3;
            width: <?php echo ($tracking['current_batch_progress'] / max(1, $batchSize)) * 100; ?>%;
            transition: width 0.5s;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        button.reset {
            background-color: #f44336;
        }
        button.reset:hover {
            background-color: #d32f2f;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        .alert-warning {
            background-color: #fcf8e3;
            color: #8a6d3b;
            border: 1px solid #faebcc;
        }
        .alert-info {
            background-color: #d9edf7;
            color: #31708f;
            border: 1px solid #bce8f1;
        }
        #result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 4px;
            display: none;
        }
        .csv-info {
            margin-top: 30px;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        #sending-status {
            display: none;
            padding: 15px;
            background-color: #fff9c4;
            border-radius: 4px;
            margin-top: 20px;
            border: 1px solid #ffd54f;
        }
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0,0,0,0.1);
            border-radius: 50%;
            border-top-color: #4CAF50;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
            vertical-align: middle;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Campaign Manager</h1>
        
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'success'): ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> Sent <?php echo $_GET['sent']; ?> emails successfully.
                </div>
            <?php elseif ($_GET['status'] == 'reset'): ?>
                <div class="alert alert-info">
                    <strong>Campaign Reset!</strong> All clients have been marked as unsent.
                </div>
            <?php elseif ($_GET['status'] == 'skip'): ?>
                <div class="alert alert-warning">
                    <strong>No New Clients!</strong> Moved to next batch position.
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <div class="stats">
            <h2>Campaign Status</h2>
            <p><strong>Total Clients:</strong> <span id="total-clients"><?php echo $totalRows; ?></span></p>
            <p><strong>Batch Size:</strong> <?php echo $batchSize; ?></p>
            <p><strong>Emails Sent:</strong> <span id="emails-sent"><?php echo $tracking['total_processed']; ?></span></p>
            <p><strong>Next Batch Starting At:</strong> <?php echo $tracking['current_index']; ?></p>
            <p><strong>Last Batch Sent:</strong> <?php echo $tracking['last_batch_time'] ? $tracking['last_batch_time'] : 'Never'; ?></p>
            
            <h3>Overall Progress</h3>
            <div class="progress-bar">
                <div class="progress-bar-fill" id="overall-progress"></div>
            </div>
            <p><span id="overall-percentage"><?php echo round(($tracking['total_processed'] / max(1, $totalRows)) * 100, 1); ?></span>% Complete</p>
            
            <h3>Current Batch Progress</h3>
            <div class="batch-progress-bar">
                <div class="batch-progress-bar-fill" id="batch-progress"></div>
            </div>
            <p><span id="batch-percentage"><?php echo round(($tracking['current_batch_progress'] / max(1, $batchSize)) * 100, 1); ?></span>% of Current Batch</p>
        </div>
        
        <div id="sending-status">
            <div class="spinner"></div>
            <span id="status-text">Sending emails, please wait...</span>
            <p>Sent <span id="current-sent">0</span> of <?php echo $batchSize; ?> emails</p>
        </div>
        
        <!-- Use form for non-JS environments -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="emailForm">
            <input type="hidden" name="action" value="sendEmails">
            <button type="submit" id="sendBatch">Send Next Batch (<?php echo $batchSize; ?> emails)</button>
            <a href="manual.php" style="text-decoration: none; color: white;">
                <button type="button" style="background-color: #4CAF50; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-size: 16px;">
                    Manual
                </button>
            </a>
            
            <a href="resetCampaign.php" class="reset" id="resetCampaign" onclick="return confirm('Are you sure you want to reset the entire campaign? This will mark all emails as unsent.');">
                <button type="button" class="reset">Reset Campaign</button>
            </a>
            <a href="filterLeads.php" style="text-decoration: none; color: white;">
                <button type="button" style="background-color: #4CAF50; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-size: 16px;">
                    Filter Leads
                </button>
            </a>
        </form>
        
        <div id="result"></div>
        
        <div class="csv-info">
            <h3>CSV File Information</h3>
            <p>Make sure clients.csv file has the following columns:</p>
            <ul>
                <li>Email - Client email address</li>
                <li>Customer Name - Client's name</li>
                <li>Address - Client's address</li>
                <li>Customer Number - Unique identifier</li>
                <li>Sent - Tracking column (Yes/No)</li>
            </ul>
            <p><strong>Note:</strong> The system will automatically update the "Sent" column as emails are processed.</p>
        </div>
        
        <p class="back-link">Signed by Ahm Nanzil</p>
    </div>
    
    <script>
        // Progress update function
        function updateProgress() {
            fetch('index.php?action=getProgress')
                .then(response => response.json())
                .then(data => {
                    // Update overall progress
                    document.getElementById('emails-sent').textContent = data.total_processed;
                    document.getElementById('total-clients').textContent = data.total_clients;
                    
                    const overallProgress = (data.total_processed / Math.max(1, data.total_clients)) * 100;
                    document.getElementById('overall-progress').style.width = overallProgress + '%';
                    document.getElementById('overall-percentage').textContent = overallProgress.toFixed(1);
                    
                    // Update batch progress
                    const batchProgress = (data.current_batch_progress / Math.max(1, data.batch_size)) * 100;
                    document.getElementById('batch-progress').style.width = batchProgress + '%';
                    document.getElementById('batch-percentage').textContent = batchProgress.toFixed(1);
                    document.getElementById('current-sent').textContent = data.current_batch_progress;
                    
                    // If sending is in progress, continue polling
                    if (document.getElementById('sending-status').style.display === 'block') {
                        setTimeout(updateProgress, 2000); // Update every 2 seconds
                    }
                })
                .catch(error => {
                    console.error('Error fetching progress:', error);
                });
        }
        
        // Only use AJAX if JavaScript is enabled
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const sendButton = document.getElementById('sendBatch');
            sendButton.disabled = true;
            sendButton.textContent = 'Sending...';
            
            // Show sending status
            document.getElementById('sending-status').style.display = 'block';
            
            // Start progress updates
            updateProgress();
            
            fetch('index.php', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=sendEmails'
            })
            .then(response => response.json())
            .then(data => {
                // Hide sending status
                document.getElementById('sending-status').style.display = 'none';
                
                const resultDiv = document.getElementById('result');
                resultDiv.style.display = 'block';
                
                if (data.status === 'success') {
                    resultDiv.innerHTML = `
                        <div class="alert alert-success">
                            <h3>Batch Sent Successfully</h3>
                            <p>Sent ${data.sent_count} emails</p>
                            <p>Failed: ${data.failed_count || 0} emails</p>
                            <p>Total processed: ${data.total_processed} out of ${data.total_clients}</p>
                            <p>Next batch will start at index: ${data.next_batch_starts_at}</p>
                        </div>
                    `;
                } else if (data.status === 'reset') {
                    resultDiv.innerHTML = `
                        <div class="alert alert-info">
                            <h3>Campaign Reset</h3>
                            <p>${data.message}</p>
                        </div>
                    `;
                } else {
                    resultDiv.innerHTML = `
                        <div class="alert alert-warning">
                            <h3>Batch Skipped</h3>
                            <p>${data.message}</p>
                        </div>
                    `;
                }
                
                // Final progress update
                updateProgress();
                
                // Re-enable the send button
                sendButton.disabled = false;
                sendButton.textContent = 'Send Next Batch (<?php echo $batchSize; ?> emails)';
            })
            .catch(error => {
                document.getElementById('sending-status').style.display = 'none';
                document.getElementById('result').innerHTML = `
                    <div class="alert alert-danger">
                        <h3>Error</h3>
                        <p>${error.message}</p>
                    </div>
                `;
                sendButton.disabled = false;
                sendButton.textContent = 'Send Next Batch (<?php echo $batchSize; ?> emails)';
            });
        });
        
        // Initialize progress on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateProgress();
        });
    </script>
</body>
</html>
<?php
}
?>
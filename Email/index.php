<?php
// /var/www/html/Email/index.php

// Security check (commented out for now - enable after testing)
// if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1' && $_SERVER['REMOTE_ADDR'] !== '::1') {
//     die('Access denied');
// }

// Configuration
$baseDir = __DIR__;
$logFile = $baseDir . '/email_system.log';
$trackingFile = $baseDir . '/tracking.json';
$configFile = $baseDir . '/emailconfiguration.php';
$csvFile = $baseDir . '/clients.csv';

// Functions
function getSystemStatus() {
    global $trackingFile, $csvFile, $logFile, $configFile;
    
    $status = [
        'last_sent' => 'Never',
        'total_sent' => 0,
        'pending' => 0,
        'last_error' => 'None',
        'log_size' => filesize($logFile) . ' bytes',
        'config_exists' => file_exists($configFile),
        'tracking_exists' => file_exists($trackingFile)
    ];

    if (file_exists($trackingFile)) {
        $data = json_decode(file_get_contents($trackingFile), true);
        $status['last_sent'] = date('Y-m-d H:i:s', $data['last_timestamp'] ?? time());
        $status['total_sent'] = $data['total_sent'] ?? 0;
    }

    if (file_exists($csvFile)) {
        $clients = array_map('str_getcsv', file($csvFile));
        $status['pending'] = count($clients) - ($status['total_sent'] + 1);
    }

    // Get last error from log
    $log = file_get_contents($logFile);
    if (preg_match('/ERROR: (.+)$/m', $log, $matches)) {
        $status['last_error'] = $matches[1];
    }

    return $status;
}

// Handle Actions
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_tracking'])) {
        $data = [
            'last_sent_index' => (int)$_POST['last_sent_index'],
            'total_sent' => (int)$_POST['total_sent'],
            'last_timestamp' => time()
        ];
        file_put_contents($trackingFile, json_encode($data, JSON_PRETTY_PRINT));
        $message = 'Tracking data updated';
    } elseif (isset($_POST['save_config'])) {
        $config = [
            'smtp_host' => $_POST['smtp_host'],
            'smtp_port' => (int)$_POST['smtp_port'],
            'smtp_username' => $_POST['smtp_username'],
            'smtp_password' => $_POST['smtp_password'],
            'smtp_secure' => $_POST['smtp_secure'],
            'from_email' => $_POST['from_email'],
            'from_name' => $_POST['from_name'],
            'is_smtp' => true
        ];
        $configContent = "<?php\nreturn " . var_export($config, true) . ";\n";
        file_put_contents($configFile, $configContent);
        $message = 'Configuration updated';
    }
} elseif (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'force_send':
            exec('php ' . $baseDir . '/cron.php >> ' . $logFile . ' 2>&1', $output, $result);
            $message = $result === 0 ? 'Email sent successfully' : 'Error sending email';
            break;
            
        case 'reset_counter':
            file_put_contents($trackingFile, json_encode(['last_sent_index' => 0, 'total_sent' => 0, 'last_timestamp' => time()]));
            $message = 'Counter reset';
            break;
            
        case 'view_log':
            header('Content-Type: text/plain');
            readfile($logFile);
            exit;
            
        case 'edit_tracking':
            $trackingData = file_exists($trackingFile) ? json_decode(file_get_contents($trackingFile), true) : ['last_sent_index' => 0, 'total_sent' => 0];
            showTrackingForm($trackingData);
            exit;
            
        case 'edit_config':
            $configData = file_exists($configFile) ? require $configFile : [
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 587,
                'smtp_username' => '',
                'smtp_password' => '',
                'smtp_secure' => 'tls',
                'from_email' => '',
                'from_name' => '',
                'is_smtp' => true
            ];
            showConfigForm($configData);
            exit;
    }
}

// Get current status
$status = getSystemStatus();

function showTrackingForm($data) {
    global $baseDir;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Tracking Data</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .form-group { margin-bottom: 15px; }
            label { display: inline-block; width: 150px; }
            input { padding: 5px; width: 300px; }
            button { padding: 8px 15px; }
        </style>
    </head>
    <body>
        <h1>Edit Tracking Data</h1>
        <form method="post" action="<?= htmlspecialchars($baseDir) ?>/index.php">
            <div class="form-group">
                <label for="last_sent_index">Last Sent Index:</label>
                <input type="number" id="last_sent_index" name="last_sent_index" value="<?= htmlspecialchars($data['last_sent_index'] ?? 0) ?>">
            </div>
            <div class="form-group">
                <label for="total_sent">Total Sent:</label>
                <input type="number" id="total_sent" name="total_sent" value="<?= htmlspecialchars($data['total_sent'] ?? 0) ?>">
            </div>
            <button type="submit" name="save_tracking">Save</button>
            <a href="<?= htmlspecialchars($baseDir) ?>/index.php"><button type="button">Cancel</button></a>
        </form>
    </body>
    </html>
    <?php
}

function showConfigForm($data) {
    global $baseDir;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Email Configuration</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .form-group { margin-bottom: 15px; }
            label { display: inline-block; width: 200px; }
            input, select { padding: 5px; width: 300px; }
            button { padding: 8px 15px; }
        </style>
    </head>
    <body>
        <h1>Edit Email Configuration</h1>
        <form method="post" action="<?= htmlspecialchars($baseDir) ?>/index.php">
            <div class="form-group">
                <label for="smtp_host">SMTP Host:</label>
                <input type="text" id="smtp_host" name="smtp_host" value="<?= htmlspecialchars($data['smtp_host']) ?>">
            </div>
            <div class="form-group">
                <label for="smtp_port">SMTP Port:</label>
                <input type="number" id="smtp_port" name="smtp_port" value="<?= htmlspecialchars($data['smtp_port']) ?>">
            </div>
            <div class="form-group">
                <label for="smtp_username">SMTP Username:</label>
                <input type="text" id="smtp_username" name="smtp_username" value="<?= htmlspecialchars($data['smtp_username']) ?>">
            </div>
            <div class="form-group">
                <label for="smtp_password">SMTP Password:</label>
                <input type="password" id="smtp_password" name="smtp_password" value="<?= htmlspecialchars($data['smtp_password']) ?>">
            </div>
            <div class="form-group">
                <label for="smtp_secure">SMTP Security:</label>
                <select id="smtp_secure" name="smtp_secure">
                    <option value="tls" <?= $data['smtp_secure'] === 'tls' ? 'selected' : '' ?>>TLS</option>
                    <option value="ssl" <?= $data['smtp_secure'] === 'ssl' ? 'selected' : '' ?>>SSL</option>
                </select>
            </div>
            <div class="form-group">
                <label for="from_email">From Email:</label>
                <input type="email" id="from_email" name="from_email" value="<?= htmlspecialchars($data['from_email']) ?>">
            </div>
            <div class="form-group">
                <label for="from_name">From Name:</label>
                <input type="text" id="from_name" name="from_name" value="<?= htmlspecialchars($data['from_name']) ?>">
            </div>
            <button type="submit" name="save_config">Save</button>
            <a href="<?= htmlspecialchars($baseDir) ?>/index.php"><button type="button">Cancel</button></a>
        </form>
    </body>
    </html>
    <?php
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email System Control Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .panel { background: #f5f5f5; padding: 20px; border-radius: 5px; }
        .stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .stat-card { background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .actions { margin-top: 20px; }
        button { padding: 8px 15px; margin-right: 10px; cursor: pointer; }
        .error { color: red; }
        .warning { color: orange; }
    </style>
</head>
<body>
    <h1>Email System Control Panel</h1>
    
    <?php if ($message): ?>
        <div style="background: #dff0d8; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    
    <div class="panel">
        <h2>System Status</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Last Sent</h3>
                <p><?= htmlspecialchars($status['last_sent']) ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Sent</h3>
                <p><?= $status['total_sent'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending Emails</h3>
                <p><?= $status['pending'] ?></p>
            </div>
            <div class="stat-card">
                <h3>Last Error</h3>
                <p class="<?= $status['last_error'] !== 'None' ? 'error' : '' ?>">
                    <?= htmlspecialchars($status['last_error']) ?>
                </p>
            </div>
            <div class="stat-card">
                <h3>Config Status</h3>
                <p class="<?= $status['config_exists'] ? '' : 'warning' ?>">
                    <?= $status['config_exists'] ? 'Exists' : 'Missing' ?>
                </p>
            </div>
            <div class="stat-card">
                <h3>Tracking Status</h3>
                <p class="<?= $status['tracking_exists'] ? '' : 'warning' ?>">
                    <?= $status['tracking_exists'] ? 'Exists' : 'Missing' ?>
                </p>
            </div>
        </div>
        
        <div class="actions">
            <h3>Actions</h3>
            <a href="?action=force_send"><button>Send Next Email Now</button></a>
            <a href="?action=reset_counter"><button>Reset Counter</button></a>
            <a href="?action=edit_tracking"><button>Edit Tracking Data</button></a>
            <a href="?action=edit_config"><button>Edit Email Config</button></a>
            <a href="?action=view_log"><button>View Full Log</button></a>
        </div>
    </div>
    
    <div style="margin-top: 30px;">
        <h3>Cron Command</h3>
        <code>*/3 * * * * php <?= $baseDir ?>/cron.php >> <?= $logFile ?> 2>&1</code>
    </div>
</body>
</html>
<?php
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load configurations
$emailConfig = require 'emailconfiguration.php';
$trackingFile = 'tracking.json';
$csvFile = 'clients.csv';
$emailTemplate = file_get_contents('emailbody.html');

// Initialize tracking
if (!file_exists($trackingFile)) {
    file_put_contents($trackingFile, json_encode(['last_sent_index' => 0, 'total_sent' => 0]));
}
$tracking = json_decode(file_get_contents($trackingFile), true);

// Read CSV
$clients = array_map('str_getcsv', file($csvFile));
$headers = array_shift($clients); // Remove header row

// Get next client
$nextIndex = $tracking['last_sent_index'];
if (!isset($clients[$nextIndex])) {
    die("No more emails to send or CSV is empty.");
}

$clientData = array_combine($headers, $clients[$nextIndex]);
$email = $clientData['Email'];
$name = $clientData['Customer Name'] ?? 'Customer';


// // Customize email body
// $emailBody = str_replace(['{name}', '{email}'], [$name, $email], $emailTemplate);
// $emailBody = $emailTemplate;

// Send email
$mail = new PHPMailer(true);
try {
    // SMTP Config
    if ($emailConfig['is_smtp']) {
        $mail->isSMTP();
        $mail->Host = $emailConfig['smtp_host'];
        $mail->Port = $emailConfig['smtp_port'];
        $mail->SMTPAuth = true;
        $mail->Username = $emailConfig['smtp_username'];
        $mail->Password = $emailConfig['smtp_password'];
        $mail->SMTPSecure = $emailConfig['smtp_secure'];
    }

    // Email content
    $mail->setFrom($emailConfig['from_email'], $emailConfig['from_name']);
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'Your Subject Here';
    $mail->Body = $emailTemplate;

    $mail->send();
    echo "Email sent to: $email\n";

    // Update tracking
    $tracking['last_sent_index'] = $nextIndex + 1;
    $tracking['total_sent']++;
    file_put_contents($trackingFile, json_encode($tracking));

} catch (Exception $e) {
    echo "Failed to send to $email. Error: {$mail->ErrorInfo}\n";
}
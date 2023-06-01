<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

// Create a new PHPMailer instance
$contact = new PHPMailer(true);
$contact->ajax = true;

// $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_CONNECTION;
$contact->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_CONNECTION;
$contact->Debugoutput = function ($str, $level) {
    // Output debug information, e.g., echo $str;
};


// SMTP configuration
$contact->isSMTP();
$contact->Host = 'smtp.gmail.com';  // SMTP server address
$contact->SMTPAuth = true;
$contact->Username = 'ahmnanzil33@gmail.com';  // Your Gmail address
$contact->Password = 'sbynboqokodyxzpg';  // Your Gmail password
$contact->SMTPSecure = 'tls';
$contact->Port = 587;

// Sender and recipient details
$sender=$_POST['email'];
$senderName = $_POST['name'];
$contact->setFrom($sender, $senderName);


$contact->addAddress('ahmnanzil33@gmail.com', 'Ahm Nanzil');  // Your Gmail address and name

// Email subject and body
$contact->Subject =$_POST['subject'];
$lineBreak = PHP_EOL; // Add a line break

$contact->Body = 'You have received a new message from ' . $senderName . ' (' . $sender . ').'
                . $lineBreak . '--> ' . $_POST['message'];
// Send the email
$contact->SMTPDebug = SMTP::DEBUG_CONNECTION;
$contact->Debugoutput = function ($str, $level) {
    // Output debug information, e.g., echo $str;
};


if ($contact->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Email could not be sent.';
    echo 'Mailer Error: ' . $contact->ErrorInfo;
}
?>

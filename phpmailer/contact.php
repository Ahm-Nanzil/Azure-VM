<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

$contact = new PHPMailer(true);

$contact->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_CONNECTION;
$contact->Debugoutput = function ($str, $level) {
};


$contact->isSMTP();
$contact->Host = 'smtp.gmail.com';  
$contact->SMTPAuth = true;
$contact->Username = 'ahmnanzil33@gmail.com';  
$contact->Password = 'hpitjdlzhhmnhurc';  
$contact->SMTPSecure = 'tls';
$contact->Port = 587;

$sender=$_POST['email'];
$senderName = $_POST['name'];
$contact->setFrom($sender, $senderName);


$contact->addAddress('ahmnanzilofficial@gmail.com', 'Ahm Nanzil');  

$contact->Subject =$_POST['subject'];
$lineBreak = PHP_EOL; 

$contact->Body = 'You have received a new message from ' . $senderName . ' (' . $sender . ').'
                . $lineBreak . '--> ' . $_POST['message'];
$contact->SMTPDebug = SMTP::DEBUG_CONNECTION;
$contact->Debugoutput = function ($str, $level) {
    
};


if ($contact->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Email could not be sent.';
    echo 'Mailer Error: ' . $contact->ErrorInfo;
}
?>

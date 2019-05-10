<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once('../class.phpmailer.php');
$mail = new PHPMailer();
$mail->Mailer = "smtp";
$mail->SMTPAuth=true;
$mail->Port=465;
$mail->Username="neetuprakashshobiz@gmail.com";
$mail->Password="abcdefgh@123";
$mail->AddReplyTo ("neetuprakashshobiz@gmail.com", "Recipient Name");
$mail->From = "neetuprakashshobiz@gmail.com";
$mail->FromName = "Sender Name";
$mail->Subject = "Email Subject";
$mail->Body ="Email Content";
$mail->AddAddress ("neetuprakash1976@gmail.com", "Receiver Name");
$mail->IsHTML (true);
$mail->SMTPSecure="ssl";
$mail->Host="smtp.gmail.com";
$mail->Send ();
?>

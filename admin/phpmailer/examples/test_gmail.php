<?php

require_once("class.phpmailer.php");

$mail = new PHPMailer;
//Enable SMTP debugging. 

$mail->IsSMTP();  // telling the class to use SMTP

//$mail->Mailer = "smtp";
//$mail->SMTPAuth = true;
$mail->Host = "ssl://smtp.gmail.com";

//Set this to true if SMTP host requires authentication to send email

//$mail->SMTPDebug = 1;
$mail->Port = 465;

//Provide username and password     
$mail->Username = "neetuprakash1976@gmail.com";                 
$mail->Password = "mohini321";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 

$mail->From = "neetuprakash1976@gmail.com";
$mail->FromName = "Full Name";

$mail->addAddress("neetuprakash.poojary@shobizexperience.com", "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}

?>

<?php



include_once('../class.phpmailer.php');

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail             = new PHPMailer();
$body             = $mail->getFile('contents.html');
$body             = eregi_replace("[\]",'',$body);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.shobiziems.com"; // SMTP server
$mail->From       = "roshan@shobiziems.com";
$mail->FromName   = "SAP";
$mail->Subject    = "PHPMailer Test Subject via smtp";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$mail->AddAddress("neetuprakash.poojary@shobizexperience.com", "Neetuprakash");
$mail->AddAttachment("images/phpmailer.gif");             // attachment
if(!$mail->Send()) {

  echo "Mailer Error: " . $mail->ErrorInfo;

} else {

  echo "Message sent!";

}



?>


<?php



include_once('../class.phpmailer.php');



$mail             = new PHPMailer(); // defaults to using php "mail()"



$body             = $mail->getFile('codeworxtech.html');

$body             = eregi_replace("[\]",'',$body);



$mail->From       = "sap.ace2011@shobiziems.com";

$mail->FromName   = "shobiz";



$mail->Subject    = " Test Subject";



$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test



$mail->MsgHTML($body);



$mail->AddAddress("neetuprakash.poojary@shobizexperience.com", "neetuprakash");

//$mail->AddCC("prasad.naik@shobizexperience.com");



//$mail->AddAttachment("images/phpmailer.gif");             // attachment



if(!$mail->Send()) {

  echo "Mailer Error: " . $mail->ErrorInfo;

} else {

  echo "Message sent!";

}



?>


<?php
include_once('../class.phpmailer.php');
$mail             = new PHPMailer(); // defaults to using php "mail()"
$body             = '<html><head><title>Registration Approval</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="779" height="153" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">  
  <tr><td width="800" height="128" style="border:0px solid #006; padding:25px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;">Dear <strong>Name</strong>,<p>We  are pleased to confirm your registration for Reward program.</p>
<p>Please visit below link <br> <a href="http://www.shobiztech.com/dell" target="_blank">http://www.shobiztech.com/dell</a></p>
<p>Regards</p>
<p><strong>Support Team</strong></p></td>
	</tr>
</table>
</body>
</html>';
$body      =  eregi_replace("[\]",'',$body);



$mail->From       = "rewardprogram@shobiztech.com";

$mail->FromName   = "shobiz";



$mail->Subject    = "Registration Approval : 24th April 2019";



$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test



$mail->MsgHTML($body);



//$mail->AddAddress("neetuprakash.poojary@shobizexperience.com", "neetuprakash");
$mail->AddAddress("amit.pashte@shobizexperience.com", "Amit");

//$mail->AddCC("prasad.naik@shobizexperience.com");



//$mail->AddAttachment("images/phpmailer.gif");             // attachment



if(!$mail->Send()) {

  echo "Mailer Error: " . $mail->ErrorInfo;

} else {

  echo "Message sent!";

}



?>


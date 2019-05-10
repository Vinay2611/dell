<?php

 require_once('class.phpmailer.php');
 
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "neetuprakash1976@gmail.com";
    $mail->Password = "mohini321";
    $mail->SMTPSecure = "ssl";  
    $mail->Host = "smtp.gmail.com";
	$mail->SMTPDebug = 2; 
    $mail->Port = "465";
 
    $mail->setFrom('neetuprakash1976@gmail.com', 'your name');
    $mail->AddAddress('neetuprakash.poojary@shobizexperience.com', 'receivers name');
 
    $mail->Subject  =  'using PHPMailer';
    $mail->IsHTML(true);
    $mail->Body    = 'Hi there ,
                        <br />
                        this mail was sent using PHPMailer...
                        <br />
                        cheers... :)';
  
     if($mail->Send())
     {
        echo "Message was Successfully Send :)";
     }
     else
     {
        echo "Mail Error - >".$mail->ErrorInfo;
     }
?>

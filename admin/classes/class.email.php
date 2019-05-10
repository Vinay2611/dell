<?php
class email {

    public function sendEmail($to,$from,$body,$subject) {
	$to_email = 'amit.pashte@shobizexperience.com';
	$mail->From = 'amit.pashte@shobizexperience.com';
    $mail->FromName= '';
	$mail->Subject  = "Your Account status changed.";
	$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->MsgHTML($body);
	$mail->AddAddress($to);
	
	if(!$mail->Send())
	{
	 return true;
	 //$response = array('success'=>'true','message'=> 'Unable to send notification to team.'. $mail->ErrorInfo);	
	} else {
	//$response = array('success'=>'true','message'=> 'Notification sent to team.');	
	return false;
	}  
	$mail->ClearAddresses();
    }
}
?>
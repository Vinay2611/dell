<?php 
require_once('../../config/db.php');
include_once('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$postData = $_POST;

if($postData['action'] == 'user') {
$updQuery = $db->query("UPDATE users SET status='".$postData['status']."' WHERE users_id='".$postData['users_id']."'");
	if($updQuery) { 
	 $selQuery = $db->query("SELECT first_name,last_name,email FROM users WHERE users_id='".$postData['users_id']."'");
	 $row = $selQuery->fetch_array();
	 $body = '';
	 $body .= '<html><head><title>Registration Approval</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
             </head><body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
             <table width="1000" height="153" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">  
             <tr><td width="900" height="128" style="border:0px solid #006; padding:25px; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;">Dear <strong>'.$row['first_name'].'</strong>,';
	if($postData['status'] == 'Active') {		 
	$body .= '<p>We are pleased to confirm your registration for Sales incentive program tool.</p><p>Please visit below link and login with your credentials <br><a href="http://www.shobiztech.com/dell" target="_blank">http://www.shobiztech.com/dell</a></p><p>Happy Selling!</p>';		 
	} else if($postData['status'] == 'Reject') {
	$body .= '<p>Administrator has rejected your registration for Reward program.</p>';		 
	} else {}
    
    $body .= '<p>Regards</p>
            <p><strong>Support Team</strong></p></td>
         	</tr>
            </table>
            </body>
            </html>';
			$mail->From = "isip@shobiziems.com";
			$mail->FromName   = "Incentive sales program";
			$mail->Subject    = "Registration ".$postData['status'];
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML($body);
			$mail->AddAddress($row['email'], $row['first_name']);
			if(!$mail->Send()) {
			 $response = array('success' => true,'message'=>'Unable to send email notification to user.');
			} else {
	 	     $response = array('success' => true,'message'=>'User status changed successfully.');
			}
         
	} else {
	  $response = array('success' => false,'message'=>'Unable to change user status.');	
	}
    print_r(json_encode($response));
}

if($postData['action'] == 'fetchPoval') {
$poQuery = $db->query("SELECT po_id,balance_amount,individual_amount,team_amount FROM purchase_order WHERE po_id='".$postData['po_id']."'");
$poRow = $poQuery->fetch_array();
$numRow = $poQuery->num_rows;
$balance_amount = "";
	if($numRow <= 0) {
	$response = array('success' => false,'balance_amount'=>'','individual_amount'=>'','team_amount'=>'');
	} else {
	$response = array('success' => true,'balance_amount'=>$poRow['balance_amount'],'individual_amount'=>$poRow['individual_amount'],'team_amount'=>$poRow['team_amount']);
	}
	echo json_encode($response);
}


if($postData['action'] == 'fetchHedgeRate') {
$hQuery = $db->query("SELECT hedge_rate FROM hedge_rate WHERE hedge_id='".$postData['hedge_id']."'");
$hRow = $hQuery->fetch_array();
$numRow = $hQuery->num_rows;
$hedge_rate = "";
	if($numRow <= 0) {
	$hedge_rate = "Please select Po Number";
	} else {
	$hedge_rate = $hRow['hedge_rate'];
	}
	echo $hedge_rate;
}

if($postData['action'] == 'contestStatus') {
$updQuery = $db->query("UPDATE contest SET status='".$postData['status']."' WHERE contest_id='".$postData['contest_id']."'");
	if($updQuery) { 
	  $response = array('success' => true,'message'=>'Contest status changed successfully.');	
	} else {
	  $response = array('success' => false,'message'=>'Unable to change contest status.');	
	}
    print_r(json_encode($response));
}


  if($postData['action'] == 'fetchTeamLead') {		
        $coQuery = $db->query("SELECT u.users_id,u.first_name,u.last_name FROM users as u JOIN team_head as th ON th.team_id='".$postData['team_id']."' AND u.users_id = th.users_id");
		$option = "";
		$num = $coQuery->num_rows;
		if($num > 0) { 
		while($coResult = $coQuery->fetch_array()) {
		$option .=  ' <option value="'.$coResult['users_id'].'">'.$coResult['first_name'].' '.$coResult['last_name'].'</option>';
		}
		echo $option;
		} 
		
   }
   
 if($postData['action'] == 'order') {
	 //echo "UPDATE order_details SET status='".$postData['status']."' WHERE od_id='".$postData['od_id']."'";
    $updQuery = $db->query("UPDATE order_details SET order_status='".$postData['status']."' WHERE od_id='".$postData['od_id']."'");
	if($updQuery) { 
	  $response = array('success' => true,'message'=>'Order status changed successfully.');	
	} else {
	  $response = array('success' => false,'message'=>'Unable to change status.');	
	}
    print_r(json_encode($response));
 } 
?>
<?php 
require_once('../../config/db.php');
$postData = $_POST;

if($postData['action'] == 'user') {
$updQuery = $db->query("UPDATE users SET status='".$postData['status']."' WHERE users_id='".$postData['users_id']."'");
	if($updQuery) { 
	  $response = array('success' => true,'message'=>'User status changed successfully.');	
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
?>
<?php 
require_once('../../config/db.php');
include_once('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$postData = $_POST;

if($postData['action'] == 'exception') {
    $updQuery = $db->query("UPDATE order_details SET exception_order='".$postData['status']."' WHERE od_id='".$postData['od_id']."'");
	if($updQuery) { 
	$response = array('success' => true,'message'=>'Exception status changed to '.$postData['status']);	
	} else {
	  $response = array('success' => false,'message'=>'Unable to change exception status');	
	}
    print_r(json_encode($response));
 } 
?>
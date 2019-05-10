<?php 
require_once('../../config/db.php');
include('../classes/class.common.php');
$postData = $_POST;
if($postData['contest_type']) {
$contest_start_date = Common::InsertdateFormat($postData['contest_start_date']);
$contest_end_date = Common::InsertdateFormat($postData['contest_end_date']);

$insSql = $db->query("INSERT INTO contest SET po_id='".$postData['po_id']."',admin_id='".$_SESSION['admin_id']."',contest_name='".addslashes($postData['contest_name'])."',contest_type='".$postData['contest_type']."',budget='".$postData['budget']."',start_date='".$contest_start_date."',end_date='".$contest_end_date."',contest_owner_id='".$postData['contest_owner_id']."',status='Ongoing'"); 
if($insSql) {
$response = array('success' => true,'message'=>'Contest added Successfully.');
} else {
$response = array('success' => false,'message'=>'Unable to add contest');	
}
print_r(json_encode($response));
}
?>
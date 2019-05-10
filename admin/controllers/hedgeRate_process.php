<?php 
require_once('../../config/db.php');
include('../classes/class.common.php');
$postData = $_POST;
$start_date = Common::InsertdateFormat($_POST['start_date']);
$end_date = Common::InsertdateFormat($_POST['end_date']);

$insSql = $db->query("INSERT INTO hedge_rate SET quarter='".$postData['quarter']."',from_date='".$start_date."',to_date='".$end_date."',hedge_rate='".$_POST['hedge_rate']."',admin_id='".$_SESSION['admin_id']."'"); 
if($insSql) {
$response = array('success' => true,'message'=>'Hedge rate added successfully.');
} else {
$response = array('success' => false,'message'=>'Please enter valid email & password');	
}
print_r(json_encode($response));
?>
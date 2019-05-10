<?php 
require_once('../../config/db.php');
$postData = $_POST;
$query = $db->query("SELECT admin_id,first_name,last_name,access_type,email_id FROM admin_users WHERE email_id='".$postData['email']."' AND password='".$postData['password']."' AND status='Active'");
$row_cnt = $query->num_rows;
$result = $query->fetch_object();
$row_cnt = $query->num_rows;
if($row_cnt == 1) {
$_SESSION['admin_id'] = $result->admin_id;
$_SESSION['first_name'] = $result->first_name;
$_SESSION['last_name'] = $result->last_name;
$_SESSION['email'] = $result->email_id;
$response = array('logged' => true);
} else {
$response = array('logged' => false,'message'=>'Please enter valid email & password');	
}
print_r(json_encode($response));
?>
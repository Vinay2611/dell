<?php 
include_once('../config.php');
$postData = $_POST;
$email_arr = explode('@',$postData['users_email_id']);
if(isset($email_arr[1])){
$email = $postData['users_email_id'];
} else{
$email = $postData['users_email_id'].'@shobizexperience.com';
}


if($postData['users_password']) {
$query = $db->query("SELECT users_id,users_first_name,users_last_name FROM users WHERE users_email_id= '".$email."' AND users_password ='".$postData['users_password']."' AND status='Active'");
$result = $query->fetch_object();
$row_cnt = $query->num_rows;
echo $row_cnt;
	if($row_cnt == 1) {
	$response = array('logged' => true);
	$_SESSION['Xtrac']['temp_id'] = $result->users_id;
	//Generate logs
	//$logQuery = $db->query("INSERT INTO crm_activity_log SET action_taken='Viewed',action_details='Concept Request',users_id='".$result->users_id."',ref_id='1'");
	} else {
	$response = array('logged' => false,'message'=>'Incorrect password, Please enter correct employee id.');	
	}
    print_r(json_encode($response));   
}
?>
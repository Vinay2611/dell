<?php 
require_once('../../config/db.php');
include('../classes/class.common.php');
include_once('../../config/class.Encryption.php');
$oEncryption = new Encryption();
$postData = $_POST;
$decOrder_id = $oEncryption->dec($_POST['to_id']);



$checkSql = $db->query("SELECT tr.document,tr.hr_approval,tr.geo_head_approval,tr.upload_pi,tr.upload_invoice FROM team_request as tr WHERE  tr.to_id='".$decOrder_id."'");
$chkRow = $checkSql->fetch_object();

/*echo "<pre>";
var_dump($_FILES);
echo "</pre>";
exit();*/
if($postData['request_start_date']) {
$allowedFileType = ['application/vnd.ms-excel','application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','text/docx','application/msword','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
   $newFileName = "";
   $fileName1 = "";
   $fileName2 = "";
   $fileName3 = "";
   $fileName4 = "";
   $fileName5 = "";
   $fileName6 = "";
   
if($_FILES['document_name']['name'] == "") {
   $newFileName1 = $chkRow->document;
} else {
   
      if(in_array($_FILES["document_name"]["type"],$allowedFileType)){
	   if($_FILES["document_name"]["type"])  {
		$fileName1 = $_FILES['document_name']['name'];
		$random = rand(1111,9999);
        $newFileName1 = $random.'_'.$fileName1;
		$response = ""; 
        $targetPath = '../uploads/team_request/'.$newFileName1;
        move_uploaded_file($_FILES['document_name']['tmp_name'], $targetPath);
       }
       }
}

if($_FILES['hr_approval']['name'] == "") {
   $newFileName2 = $chkRow->document;
} else {
       if(in_array($_FILES["hr_approval"]["type"],$allowedFileType)){
	   if($_FILES["hr_approval"]["type"])  {
		$fileName2 = $_FILES['hr_approval']['name'];
		$random = rand(1111,9999);
        $newFileName2 = $random.'_'.$fileName2;
		$response = ""; 
        $targetPath = '../uploads/team_request/'.$newFileName2;
        move_uploaded_file($_FILES['hr_approval']['tmp_name'], $targetPath);
       }
       }
}

if($_FILES['geo_approval']['name'] == "") { 
$newFileName3 = $chkRow->geo_approval;
}  else { 
        if(in_array($_FILES["geo_approval"]["type"],$allowedFileType)){
	    if($_FILES["geo_approval"]["type"])  {
		$fileName3 = $_FILES['geo_approval']['name'];
		$random = rand(1111,9999);
        $newFileName3 = $random.'_'.$fileName3;
		$response = ""; 
        $targetPath = '../uploads/team_request/'.$newFileName3;
        move_uploaded_file($_FILES['geo_approval']['tmp_name'], $targetPath);
       }
       }
}

if($_FILES['pi']['name'] == "") { 
$newFileName4 = $chkRow->upload_pi;
}  else { 
      if(in_array($_FILES["pi"]["type"],$allowedFileType)){
	   if($_FILES["pi"]["type"])  {
		$fileName4 = $_FILES['pi']['name'];
		$random = rand(1111,9999);
        $newFileName4 = $random.'_'.$fileName4;
		$response = ""; 
        $targetPath = '../uploads/team_request/'.$newFileName4;
        move_uploaded_file($_FILES['pi']['tmp_name'], $targetPath);
       }
       }
}
	   
if($_FILES['invoice']['name'] == "") {  
     $newFileName5 = $chkRow->upload_invoice;
} else {
	   if(in_array($_FILES["invoice"]["type"],$allowedFileType)){
	   if($_FILES["invoice"]["type"])  {
		$fileName5 = $_FILES['invoice']['name'];
		$random = rand(1111,9999);
        $newFileName5 = $random.'_'.$fileName5;
		$response = ""; 
        $targetPath = '../uploads/team_request/'.$newFileName5;
        move_uploaded_file($_FILES['pi']['tmp_name'], $targetPath);
       }
       }
}
	   


$request_start_date = Common::InsertdateFormat($postData['request_start_date']);
$request_end_date = Common::InsertdateFormat($postData['request_end_date']);

$updSql = $db->query("UPDATE `team_request` SET `admin_id`='".$_SESSION['admin_id']."',`order_type`='".$postData['order_type']."',`start_date`='".$request_start_date."',`end_date`='".$request_start_date."',`venue`='".addslashes($postData['venue'])."',`amount`='".$postData['amount']."',`document`='".$newFileName1."',`hr_approval`='".$newFileName2."',`geo_head_approval`='".$newFileName3."',`upload_pi`='".$newFileName4."',`upload_invoice`='".$newFileName5."',`status`='".$postData['status']."' WHERE to_id='".$decOrder_id."'");

if($updSql) {
	echo "<script>window.location='../team_requests'</script>";
    //$response = array('success' => true,'message'=>'Purchase order added successfully.');
} else {
    //$response = array('success' => false,'message'=>'Unable to add purchase order');	
}
//print_r(json_encode($response));
}
?>
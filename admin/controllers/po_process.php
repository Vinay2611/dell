<?php 
require_once('../../config/db.php');
include('../classes/class.common.php');
$postData = $_POST;
/*echo "<pre>";
var_dump($_FILES);
echo "</pre>";
exit();*/
if($postData['po_number']) {

$allowedFileType = ['application/vnd.ms-excel','application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','text/docx','application/msword','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
   $newFileName = "";
if(in_array($_FILES["po_file"]["type"],$allowedFileType)){
	   if($_FILES["po_file"]["type"])  {
		$fileName = $_FILES['po_file']['name'];
		$random = rand(1111,9999);
        $newFileName = $random.'_'.$fileName;
		$response = ""; 
        $targetPath = '../uploads/po/'.$newFileName;
        move_uploaded_file($_FILES['po_file']['tmp_name'], $targetPath);
        
   }
}


$po_date = Common::InsertdateFormat($postData['po_date']);

$tax = $postData['sgst'] + $postData['cgst'];

$insSql = $db->query("INSERT INTO `purchase_order` SET hedge_id='".$postData['hedge_id']."',admin_id='".$_SESSION['admin_id']."',`po_number`='".$postData['po_number'] ."',`po_value`='".$postData['po_value'] ."',`po_file`='".$newFileName."',`date_of_po`='".$po_date ."',`agency_fee`='".$postData['agency_fee'] ."',`pm_fee`='".$postData['pm_fee'] ."',`tax`='".$tax."',`balance_amount`='".$postData['po_budget']."',`individual_amount`='".$postData['individual_amount']."',`team_amount`='".$postData['team_amount']."',status='Pending'");  

if($insSql) {
	echo "<script>window.location='../purchase_order.php'</script>";
//$response = array('success' => true,'message'=>'Purchase order added successfully.');
} else {
//$response = array('success' => false,'message'=>'Unable to add purchase order');	
}
//print_r(json_encode($response));
}
?>
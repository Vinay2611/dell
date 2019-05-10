<?php 
require_once('../../config/db.php');
include('../classes/class.common.php');
require_once('../vendor/excel_reader2.php');
require_once('../vendor/SpreadsheetReader.php');

$postData = $_POST;


if($postData['contest_for'] == 'Team') {
    $announcement_date = Common::InsertdateFormat($postData['announcement_date']);
   
    $checkSql = $db->query("SELECT team_id FROM `winner` WHERE `contest_id`='".$postData['contest_id']."' AND `team_id`='".$postData['team_id']."' AND `users_id`='".$postData['rm_id']."'");
    $checkNum =  $checkSql->num_rows;	
	if($checkNum <= 0) {
	$insSql = $db->query("INSERT INTO `winner` SET `contest_id`='".$postData['contest_id']."',`team_id`='".$postData['team_id']."',`users_id`='".$postData['rm_id']."',`type`='Team',`reward_amount`='".$postData['team_amount']."',`reward_status`='Pending'");
		if($insSql) {
		//$response = array('success' => true,'message'=>'Team added to winner list successfully.');
		 echo "<script>window.location='../team_winners.php';</script>";
		} else {
		///$response = array('success' => false,'message'=>'Unable to add purchase order');	
		echo "<script>window.location='../team_winners.php';</script>";
		}
    print_r(json_encode($response));
    }
}



if($postData['contest_for'] == 'Individual') {
 
 $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  //if(in_array($_FILES["winner_list"]["type"],$allowedFileType)){
	   if($_FILES["winner_list"]["type"])  {
		 
		$response = ""; 
        $targetPath = '../uploads/'.$_FILES['winner_list']['name'];
        move_uploaded_file($_FILES['winner_list']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $email = "";
                if(isset($Row[1])) {
                    $email = addslashes($Row[1]);
                }
                
                $amount = "";
				$insSql = "";
                if(isset($Row[2])) {
                    $amount = addslashes($Row[2]);
                }
                
                if (!empty($email) || !empty($amount)) {
                
				$selSql = $db->query("SELECT users_id,team_id FROM users WHERE email='".$email."'");
				$selRow = $selSql->fetch_array();   
		        
				if($selRow['users_id']) {
				$checkRow = $db->query("SELECT users_id FROM winner WHERE `contest_id`='".$postData['contest_id']."' AND users_id='".$selRow['users_id']."'");
				$check_num = $checkRow->num_rows;
				if($check_num <= 0) {
				$query = "INSERT INTO winner SET `contest_id`='".$postData['contest_id']."',`team_id`='".$postData['team_id']."',users_id='".$selRow['users_id']."',reward_amount ='".$amount."',reward_status='Pending',announcement_date='".$postData['announcement_date']."'";
				$insSql = $db->query($query);
				}
				}
                
				             
				}
             }
			 
			 if($insSql) {
                 //$response = array('success' => true,'message'=>'file uploaded to winner list successfully.');
				 echo "<script>window.location='../ind_winners.php';</script>";
                } else {
                echo "<script>window.location='../ind_winners.php';</script>"; 
              }
              //print_r(json_encode($response));   
        
         }
}
  
  
}

?>
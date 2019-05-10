<?php
final class Common {
    
		public static function InsertdateFormat($date){
			if($date!=""){
				$dt = explode('-',$date);	
				$makeDate = $dt[2]."-".$dt[1]."-".$dt[0];
				return $makeDate;
			} else	return "---";
		}
	
	
        public function showPoDropdown() {
		global $db;  
        $poQuery = $db->query("SELECT po_id,po_number FROM purchase_order WHERE status='Approved' ORDER BY po_id DESC ");
		$option = "";
		while($poResult = $poQuery->fetch_array()) {
		$option .=  ' <option value="'.$poResult['po_id'].'">'.$poResult['po_number'].'</option>';
		}
		return $option;
        }
		
		
		public function quarterDropdown() {
		global $db;
		$year = date('Y');
		//echo "SELECT hedge_id,quarter,date_format(from_date,'%d %M %y') as from_date,date_format(to_date,'%d %M %y') as to_date FROM `hedge_rate` WHERE year(from_date) = '".$year."'";
        $quarterQuery = $db->query("SELECT hedge_id,quarter,date_format(from_date,'%d %M %y') as from_date,date_format(to_date,'%d %M %y') as to_date FROM `hedge_rate` WHERE year(from_date) = '".$year."'");
		$option = "";
		while($quarterResult = $quarterQuery->fetch_array()) {
		$option .=  ' <option value="'.$quarterResult['hedge_id'].'">'.$quarterResult['quarter'].' ('.$quarterResult['from_date'].' - '.$quarterResult['to_date'].')</option>';
		}
		return $option;
        }
		
		public function displayDate($format,$date)
        { 
	    if(($date == '0000-00-00 00:00') || ($date == '')){
		$display_date = "Not Specified";
		} else {
		$ex1 = explode(" ",$date);
		$ex2 = explode("-",$ex1[0]);
		$ex3 = explode(":",$ex1[1]);
		$makeTime = mktime($ex3[0],$ex3[1],$ex3[2],$ex2[1],$ex2[2],$ex2[0]);
		$display_date = date($format, $makeTime);
		}
	    return $display_date;
        }
		
      
	    public function showTeamDropdown() {
		global $db;  
        $teamQuery = $db->query("SELECT team_id,team_name FROM team ORDER BY team_name ASC");
		$option = "";
		while($teamResult = $teamQuery->fetch_array()) {
		$option .=  ' <option value="'.$teamResult['team_id'].'">'.$teamResult['team_name'].'</option>';
		}
		return $option;
        }
		
		
		public function showContestDropdown() {
		global $db;  
		$coQuery = $db->query("SELECT contest_id,contest_name FROM contest order by contest_id DESC");
		$option = "";
		while($coResult = $coQuery->fetch_array()) {
		$option .=  ' <option value="'.$coResult['contest_id'].'">'.$coResult['contest_name'].'</option>';
		}
		return $option;
		}
		
		public function showTeamName($users_id) {
		global $db;  
        $teamQuery = $db->query("SELECT t.team_name FROM team as t, users as u WHERE u.team_id = t.team_id AND u.users_id='".$users_id."'");
		$teamName = "";
		while($teamResult = $teamQuery->fetch_array()) {
	    $teamName = $teamResult['team_name'];
		}
		return $teamName;
        }
		
		
		public function showISMDropdown() {
		global $db;  
        $poQuery = $db->query("SELECT users_id,concat(first_name,' ',last_name) as full_name FROM users WHERE status='Active' ORDER BY first_name ASC");
		$option = "";
		while($poResult = $poQuery->fetch_array()) {
		$option .=  ' <option value="'.$poResult['users_id'].'">'.$poResult['full_name'].'</option>';
		}
		return $option;
        }
		
		
		public function showClaimStatus($user_id,$status) {
		global $db;
		//echo "SELECT count(users_id) as total FROM winner WHERE users_id='".$user_id."' AND reward_status='".$status."'";
		$claimSql = $db->query("SELECT count(users_id) as total FROM winner WHERE users_id='".$user_id."' AND reward_status='".$status."'");
		if($claimSql) {
		$claimResult = $claimSql->fetch_object();
		return $claimResult->total;
		} else {}
			
		}

        public function showAllClaimStatus($users_id,$team_id,$status) {
            global $db;
            //echo "SELECT count(team_id) as total FROM winner WHERE team_id='".$team_id."' AND reward_status='".$status."' AND users_id != '".$users_id."'";
            $claimSql = $db->query("SELECT count(team_id) as total FROM winner WHERE team_id='".$team_id."' AND reward_status='".$status."' AND users_id != '".$users_id."'");
            if($claimSql) {
                $claimResult = $claimSql->fetch_object();
                return $claimResult->total;
            } else {}

        }
		

        //Calculate incentive
        /*public function showAllIncentive(){
		     global $db;
		     $sqlQuery = $db->query("");
        }*/
}
?>
<?php
require_once '../../config/db.php';
$sql = "SELECT u.users_id,u.first_name,u.last_name,u.employee_id,u.email,u.user_type,u.status,u.reporting_manager,t.team_name FROM users as u JOIN team as t ON u.team_id = t.team_id ORDER BY users_id DESC";
$que = $db->query($sql);
$data_array = array();

if($que->num_rows > 0) {
 $i = 0;
 $developer_records[] = array( 'Sr No', 'First name', 'Last name', 'Employee id','Email id', 'User type','Status','Team name');
 while ($row = $que->fetch_assoc()) {
        $i++;
        $developer_records[] = array( $i ,$row['first_name'], $row['last_name'], $row['employee_id'], $row['email'], $row['user_type'] ,$row['status'],$row['team_name']);
    }
}

$filename = "User_".date('Ymd') . ".xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8; encoding=UTF-8");
header("Content-Disposition: attachment; filename=".$filename."");
$show_coloumn = false;
if(!empty($developer_records)) {
    foreach($developer_records as $record) {
        if(!$show_coloumn) {
            // display field/column names in first row
            //echo implode("\t", array_keys($record)) . "\n";
            $show_coloumn = true;
        }
        echo implode("\t", array_values($record)) . "\n";
        //echo implode("\t", array_values($record)) . "\n";
    }
}

$db->close();
exit;

?>


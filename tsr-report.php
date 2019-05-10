<?php

session_start();
$users_id  = $_SESSION['users_id'];
$team_id  = $_SESSION['team_id'];
//database connection
require_once 'config/db.php';

$sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,w.reward_amount,w.reward_status,w.users_id,w.reward_status,w.team_id,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date,hr.quarter FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner AS w ON c.contest_id = w.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND system_status = 'Active' AND w.team_id = '$team_id' AND w.users_id = '$users_id' GROUP BY c.contest_id";

$que = $db->query( $sql );
$data_array = array();

if($que->num_rows > 0) {
    $i = 0;
    $developer_records[] = array( 'Sr No', 'Team', 'Quarter', 'Contest', 'Contest-type', 'Reward Amount', 'Start Date', 'End Date', 'Reward Status' );

    while ($row = $que->fetch_assoc()) {

        $inrPrice =  $row['budget'] * $row['hedge_rate'];

        //Team Name
        $team = "SELECT * FROM `team` WHERE `team_id` = '".$row['team_id']."'";
        $team_q = $db->query( $team);
        $team_e = $team_q->fetch_assoc();


        $i++;
        $developer_records[] = array( $i , $team_e['team_name'] , $row['quarter'] ,$row['contest_name'], $row['contest_type'], $row['reward_amount'], $row['start_date'], $row['end_date'] ,$row['status']  );
    }
}

$filename = "team_report_claim_".date('Ymd') . ".xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8; encoding=UTF-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
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


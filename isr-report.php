<?php

session_start();
$users_id  = $_SESSION['users_id'];
//database connection
require_once 'config/db.php';


$sql = "SELECT c.contest_id,c.po_id,c.contest_type,c.contest_name,c.contest_for,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,w.reward_amount,w.reward_status,w.balance_amount as bal_amount,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner AS w ON c.contest_id = w.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND system_status = 'Active' AND w.users_id = '$users_id' GROUP BY c.contest_id";
//$sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.contest_for,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,w.reward_amount,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner AS w ON c.contest_id = w.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND w.users_id = '$users_id' AND  system_status = 'Active' GROUP BY c.contest_id";
//$sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.contest_for,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wisr.reward_amt,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_isr AS wisr ON c.contest_id = wisr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND wisr.users_id = '$users_id' AND  system_status = 'Active' GROUP BY c.contest_id";
$que = $db->query( $sql );
$data_array = array();

if($que->num_rows > 0) {
    $i = 0;
    $developer_records[] = array( 'Sr No', 'Quarter', 'Contest', 'Contest-type', 'Reward Amount in $', 'Reward Amount in Rs', 'Balance Amount in Rs', 'Start Date', 'End Date', 'Status', 'Reward Status' );

    while ($row = $que->fetch_assoc()) {
        $i++;

        $inrPrice =  $row['budget'] * $row['hedge_rate'];
        $inDollar =  $row['reward_amount'] / $row['hedge_rate'];

        $developer_records[] = array( $i , $row['quarter'], $row['contest_name'], $row['contest_type'], truncate_number($inDollar,2), $row['reward_amount'], $row['bal_amount'], $row['start_date'], $row['end_date'] ,$row['status'], $row['reward_status']  );
    }
}

$filename = "incentive_status_report_".date('Ymd') . ".xls";
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


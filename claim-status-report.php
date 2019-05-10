<?php

session_start();
$users_id  = $_SESSION['users_id'];
include('classes/class.common.php');
include('config/class.Encryption.php');
$oEncryption = new Encryption();
//database connection
require_once 'config/db.php';

$sql = "SELECT o.order_id,o.order_number,date_format(o.order_date,'%d %M %Y') as order_date,o.contest_id,o.users_id,o.order_status,o.shipping_address,o.city,o.pincode,o.agency_comments,o.remark,o.last_update,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date,c.contest_name FROM `orders` AS o JOIN `contest` AS c ON o.contest_id=c.contest_id JOIN purchase_order AS po ON c.po_id = po.po_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id  where o.users_id = '".$users_id."'";
$que = $db->query( $sql );
$data_array = array();

if($que->num_rows > 0) {
    $i = 0;
    $developer_records[] = array( 'Sr No', 'Quarter', 'Contest', 'Order-id', 'Order date', 'Order total', 'Order Status', 'Agency comment' );

    while ($row = $que->fetch_assoc()) {
        $i++;
        $odQuery = $db->query("SELECT sum(price) as order_total FROM `order_details` WHERE order_id='".$row['order_id']."'");
        $odRow = $odQuery->fetch_array();

        //Contest name and quarter name
        $orderId = $oEncryption->enc($row['order_id']);

        $developer_records[] = array( $i , $row['quarter'], $row['contest_name'], $row['order_number'], $row['order_date'], $odRow['order_total'], $row['order_status'], substr($row['agency_comments'],0,20).'...'  );
    }
}

$filename = "claim_status_report_".date('Ymd') . ".xls";
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


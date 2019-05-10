<?php
require_once '../../config/db.php';
$sql = "SELECT hr.hedge_rate, po.po_number,po.po_value,po.po_file,po.date_of_po,po.agency_fee, po.pm_fee,po.tax,po.balance_amount, po.individual_amount,po.team_amount, po.status FROM purchase_order as po JOIN hedge_rate as hr ON hr.hedge_id = po.hedge_id ORDER by po_id DESC";
$que = $db->query($sql);
$data_array = array();
if($que->num_rows > 0) {
 $i = 0;
 $developer_records[] = array('Sr No', 'Hedge Rate', 'PO number', 'PO value','PO File','date_of_po', 'agency_fee','pm_fee','tax','Balance amount','individual amount', 'Team amount','Status');
 while ($row = $que->fetch_assoc()) {
        $i++;
		$po_file = $row['po_file'];
		$agency_fee = $row['po_value'] / 100 * $row['agency_fee'];
        $developer_records[] = array( $i ,$row['hedge_rate'], $row['po_number'], $row['po_value'], $po_file, $row['date_of_po'], $agency_fee ,$row['pm_fee'],$row['tax'],$row['balance_amount'],$row['individual_amount'],$row['team_amount'],$row['status']);
    }
}

$filename = "Purchase_Order_".date('Ymd') . ".xls";

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


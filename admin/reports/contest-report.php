<?php
require_once '../../config/db.php';
$sql = "SELECT `contest_id`, `po_id`, `admin_id`, `contest_name`, `contest_type`, `contest_for`, `budget`, `banner`, date_format(start_date,'%d %M %y') as start_date, date_format(end_date,'%d %M %y') as end_date, `status`, `system_status`, `dateTime` FROM `contest` ORDER BY contest_id DESC";
$que = $db->query($sql );
$data_array = array();

if($que->num_rows > 0) {
 $i = 0;
 $developer_records[] = array( 'Sr No', 'Contest name', 'Contest type', 'Contest for', 'Budget','Start date','End date', 'Status','Date Time');
 while ($row = $que->fetch_assoc()) {
        $i++;
        $developer_records[] = array( $i ,$row['contest_name'], $row['contest_type'], $row['contest_for'], $row['budget'], $row['start_date'] ,$row['end_date'],$row['status'],$row['dateTime']);
    }
}

$filename = "Contest_".date('Ymd') . ".xls";
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


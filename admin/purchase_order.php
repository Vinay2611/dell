<?php 
include_once('../config/db.php');
include_once('../config/class.Encryption.php');
include('header2.php');
$oEncryption = new Encryption();
?>
<script src="js/user.js?v=1.0"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#purchaseTable').DataTable();
} );
</script>
        <div class="rewards-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <!--col-md-offset-3-->
                     <?php include('menu.php'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                    
					<div class="breadcrums-block">
                    	 <ul class="breadcrumb">
                          <li><a href="#">Home</a></li>
                          <li class="is-active">Purchase Order</li>
                        </ul> 
                    </div>
                        
<table id="purchaseTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Po number</th>
            <th>Hedge rate</th>
            <th>Po value</th>
            <th>Po date</th>
            <th>Agency fee</th>
            <th>Balance</th>
            <th>Status</th>
            <th>Added by</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       
        <?php 
		$poSql = $db->query("SELECT `po_id`, `hedge_id`, `admin_id`, `po_number`, `po_value`, date_format(`date_of_po`,'%d %M %y') as date_of_po, `agency_fee`, `tax`, `balance_amount`,status FROM `purchase_order` ORDER BY po_id DESC");  
		$content = "";
		$a=1;
		while($row = $poSql->fetch_array()) { 
		$encPid = $oEncryption->enc($row['po_id']);
		
		$hedgeSql = $db->query("SELECT h.hedge_id,h.admin_id,h.quarter,h.from_date,h.to_date,h.hedge_rate,h.status,concat(a.first_name,' ',a.last_name) as admin_name FROM hedge_rate as h JOIN admin_users as a ON a.admin_id = h.admin_id AND hedge_id='".$row['hedge_id']."'");  
		$hedgeRow = $hedgeSql->fetch_array();
		$feeinpercent = $row['po_value'] / 100 * $row['agency_fee'];
		
		
        $content .= '<tr><td align="center">'.$a.'</td><td>'.$row['po_number'].'</td><td>'.$hedgeRow['hedge_rate'].'</td><td>'.$row['po_value'].'</td><td>'.$row['date_of_po'].'</td><td>'.$feeinpercent.'</td><td>'.$row['balance_amount'].'</td><td>'.$row['status'].'</td><td>'.$hedgeRow['admin_name'].'</td>';
		
		$content .= '<td><a href="view_purchase_order?pid='.$encPid.'">View</a></td>';
		
		/*if($row['status'] == 'Reject' || $row['status'] == 'Pending') {
		$content .= '<td><a class="pointer" onclick="userAction(\'Active\','.$row['users_id'].')">Approve</a></td>';
		}
		
		if($row['status'] == 'Active') {
		$content .= '<td><a class="pointer" onclick="userAction(\'Reject\','.$row['users_id'].')">Reject</a></td>';
		} */
		
		$content .='</tr>';
		$a++;
		}
		echo $content;
		?>
    </tbody>
</table>
                            
                       
                    </div>

                </div>
                <div class="footer">
                <p>If you are facing issues, please send an email to <a href="mailto:  <?php echo SUPPORT;?>" style="color:#F1ECEC;">
			  <?php echo SUPPORT;?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>
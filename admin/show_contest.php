<?php 
include_once('../config/db.php');
include('header2.php');
?>
<script src="js/validation/contest.js?v=1.0"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#contestTable').DataTable();
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
                          <li class="is-active">Contest</li>
                        </ul> 
                    </div>
<table id="contestTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>PO number</th>
            <th>Contest name</th>
            <th>Owner</th>
            <th>Contest type</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       
        <?php 
		$userSql = $db->query("SELECT c.contest_id, c.po_id, c.admin_id,c.contest_owner_id, c.contest_name,c.contest_type, c.budget,c.banner, date_format(c.start_date,'%d %M %y') as start_date, date_format(c.end_date,'%d %M %y') as end_date, c.status, system_status,c.dateTime,concat(first_name,' ',last_name) as contest_owner FROM contest as c,users as u WHERE u.users_id = c.contest_owner_id");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
		
		$rmSql = $db->query("SELECT po_number FROM purchase_order WHERE po_id='".$row['po_id']."'");  
		$rmRow = $rmSql->fetch_array();
		
        $content .= '<tr><td align="center">'.$a.'</td><td>'.$rmRow['po_number'].'</td><td>'.$row['contest_name'].'</td><td>'.$row['contest_owner'].'</td><td>'.$row['contest_type'].'</td><td>'.$row['start_date'].'</td><td>'.$row['end_date'].'</td><td>'.$row['status'].'</td>';
		
		if($row['status'] == 'Pending') {
		$action = '<td>Waiting for Approval</td>';
		}
		
		
		
		if($row['status'] == 'Rejected') {
		$action = '<td>Rejected</td>';
		}
		
		if($row['status'] == 'Ongoing') {
		$action = '<td><a class="pointer" onclick="contestAction(\'On Hold\','.$row['contest_id'].')">On Hold</a> | <a class="pointer" onclick="contestAction(\'Cancelled\','.$row['contest_id'].')">Cancelled</a></td>';
		}
		
		if($row['status'] == 'On Hold' || $row['status'] == 'Approved') {
		$action = '<td><a class="pointer" onclick="contestAction(\'Ongoing\','.$row['contest_id'].')">On Going</a> | <a class="pointer" onclick="contestAction(\'Cancelled\','.$row['contest_id'].')">Cancelled</a></td>';
		}
		
		if($row['status'] == 'Cancelled') {
		$action = '<td><a class="pointer" onclick="contestAction(\'Ongoing\','.$row['contest_id'].')">On Going</a></td>';
		}
		
		$content .=  $action.'</tr>';
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
<?php 
include_once('../config/db.php');
include_once('../config/class.Encryption.php');
include('classes/class.common.php');
include('header2.php');
$obj = new Encryption();
$objCommon = new Common();
?>
<script src="js/order.js?v=1.0"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#orderTable').DataTable();
} );

</script>
        <div class="rewards-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--col-md-offset-3-->
                     <?php include('menu.php'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                    <div class="breadcrums-block">
                    	 <ul class="breadcrumb">
                          <li><a href="#">Dashboard</a></li>
                          <li class="is-active">Team Request</li>
                        </ul> 
                    </div>
<table id="orderTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Request id</th>
            <th>Full Name</th>
            <th>Order Type</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
		$userSql = $db->query("SELECT tr.to_id,tr.order_number,tr.order_type,tr.status,tr.start_date,tr.end_date,tr.amount,tm.team_name,CONCAT(u.first_name,' ',u.last_name) full_name FROM team_request as tr,team as tm,users as u WHERE tr.team_id = tm.team_id AND tr.users_id = u.users_id");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
 	   $encId = $obj->enc($row['to_id']);
		//$teamName = $objCommon->showTeamName($row['users_id']);
		$content .= '<tr><td align="center">'.$a.'</td><td>'.$row['order_number'].'</td><td>'.$row['full_name'].'</td><td>'.$row['order_type'].'</td><td>'.$row['amount'].'</td><td>'.$row['start_date'].'</td><td>'.$row['end_date'].'</td><td>'.$row['status'].'</td><td><a href="team_request_details.php?to_id='.$encId.'">View</a> | <a href="edit_team_request.php?to_id='.$encId.'">Edit</a></td>';
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
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
                          <li class="is-active">Order</li>
                        </ul> 
                    </div>
<table id="orderTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Order id</th>
            <th>Full Name</th>
            <th>Order Total</th>
               <th>Order Date</th>
             <th>Remark</th>
           <!-- <th>Status</th>-->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
		$userSql = $db->query("SELECT o.order_id,o.order_number,o.users_id,o.order_status,o.shipping_address,o.remark,DATE_FORMAT(o.order_date,'%D %M %y') as order_date,o.last_update,concat(u.first_name,' ',u.last_name) as full_name FROM orders as o,users as u WHERE o.users_id = u.users_id");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
 	    $odQuery = $db->query("SELECT sum(price) as order_total FROM `order_details` WHERE order_id='".$row['order_id']."'");
        $odRow = $odQuery->fetch_array(); 
		
		/*<td>'.$row['order_status'].'</td>*/
		$encId = $obj->enc($row['order_id']);
		$teamName = $objCommon->showTeamName($row['users_id']);
		$content .= '<tr><td align="center">'.$a.'</td><td>'.$row['order_number'].'</td><td>'.$row['full_name'].'</td><td>'.$odRow['order_total'].'</td><td>'.$row['order_date'].'</td><td>'.$row['remark'].'</td><td><a href="order_details?oid='.$encId.'">View</a></td>';
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
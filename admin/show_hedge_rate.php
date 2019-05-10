<?php 
include_once('../config/db.php');
include('header2.php');
?>
<script src="js/validation/contest.js?v=1.0"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#hedgeTable').DataTable();
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
<table id="hedgeTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
             <th>Quarter</th>
            <th>Hedge rate</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Added on</th>
            <th>Added by</th>
        </tr>
    </thead>
    <tbody>
       
        <?php 
		
		
		$userSql = $db->query("SELECT `hedge_id`,`admin_id`,`quarter`, date_format(from_date,'%d %M %y') as from_date, date_format(to_date,'%d %M %y') as to_date,`hedge_rate`,date_format(create_date,'%d %M %y') as create_date, `status` FROM `hedge_rate` ORDER BY hedge_id DESC");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
		
		$adSql = $db->query("SELECT concat(first_name,' ',last_name) as admin_name FROM admin_users WHERE admin_id='".$row['admin_id']."'");  
		$adRow = $adSql->fetch_array();		
		
		$content .= '<tr><td align="center">'.$a.'</td><td>'.$row['quarter'].'</td><td>'.$row['hedge_rate'].'</td><td>'.$row['from_date'].'</td><td>'.$row['to_date'].'</td><td>'.$row['create_date'].'</td><td>'.$adRow['admin_name'].'</td>';
		
		/*if($row['status'] == 'Pending') {
		$action = '<td>Waiting for Approval</td>';
		}
		
		if($row['status'] == 'Ongoing') {
		$action = '<td><a class="pointer" onclick="contestAction(\'On Hold\','.$row['contest_id'].')">On Hold</a> | <a class="pointer" onclick="contestAction(\'Cancelled\','.$row['contest_id'].')">Cancelled</a></td>';
		}
		
		if($row['status'] == 'On Hold') {
		$action = '<td><a class="pointer" onclick="contestAction(\'Ongoing\','.$row['contest_id'].')">On Going</a> | <a class="pointer" onclick="contestAction(\'Cancelled\','.$row['contest_id'].')">Cancelled</a></td>';
		}
		
		if($row['status'] == 'Cancelled') {
		$action = '<td><a class="pointer" onclick="contestAction(\'Ongoing\','.$row['contest_id'].')">On Going</a></td>';
		}*/
		
		$content .=  '</tr>';
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
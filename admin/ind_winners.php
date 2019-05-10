<?php 
include_once('../config/db.php');
include('header2.php');?>
<script src="js/user.js"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#indTable').DataTable();
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
                          <li><a href="#">Home</a></li>
                          <li class="is-active">Individual Winners</li>
                        </ul> 
                    </div>
<table id="indTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Full name</th>
            <th>Team</th>
            <th>Reporting manager</th>
			<th>Contest</th>
            <th>Reward Amount</th>
            <th>Reward Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
		$userSql = $db->query("SELECT c.contest_name,u.users_id,concat(first_name,' ',last_name) as fullname,u.reporting_manager,t.team_name,wi.reward_amount,wi.reward_status FROM users as u JOIN team as t JOIN winner as wi JOIN contest as c ON c.contest_id = wi.contest_id AND wi.users_id = u.users_id AND u.team_id = t.team_id AND wi.type='Individual' ORDER BY winner_id DESC");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
		
		$rmSql = $db->query("SELECT concat(first_name,' ',last_name) as rmName FROM users WHERE users_id='".$row['reporting_manager']."'");  
		$rmRow = $rmSql->fetch_array();
		
		
		
        $content .= '<tr><td align="center">'.$a.'</td><td>'.$row['fullname'].'</td><td>'.$row['team_name'].'</td><td>'.$rmRow['rmName'].'</td><td>'.$row['contest_name'].'</td><td>'.$row['reward_amount'].'</td><td>'.$row['reward_status'].'</td>';
		
		//$content .= '<td><a class="pointer" onclick="userAction(\'Active\','.$row['users_id'].')">Approve</a></td>';
		
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
</table></div>

                </div>
                <div class="footer">
                <p>If you are facing issues, please send an email to <a href="mailto:  <?php echo SUPPORT;?>" style="color:#F1ECEC;">
			  <?php echo SUPPORT;?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>
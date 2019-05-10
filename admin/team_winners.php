<?php 
include_once('../config/db.php');
include('header2.php');
?>
<script src="js/user.js"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#teamTable').DataTable();
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
                          <li class="is-active">Team Winners</li>
                        </ul> 
                    </div>
<table id="teamTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>Contest</th>
            <th>Team</th>
            <th>Reporting manager</th>
			<th>Reward Amount</th>
            <th>Reward Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
		$userSql = $db->query("SELECT c.contest_name,concat(u.first_name,' ',u.last_name) as rmName,t.team_name,w.reward_amount,w.reward_status FROM winner as w,contest as c,users as u,team as t WHERE c.contest_id = w.contest_id AND u.users_id = w.users_id AND t.team_id = w.team_id AND w.type='Team'");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
		
		
        $content .= '<tr><td align="center">'.$a.'</td><td>'.$row['contest_name'].'</td><td>'.$row['team_name'].'</td><td>'.$row['rmName'].'</td><td>'.$row['reward_amount'].'</td><td>'.$row['reward_status'].'</td>';
		
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
<?php 
include_once('../config/db.php');
include('header2.php');
include_once('../config/class.Encryption.php');
$oEncryption = new Encryption();


?>
<script src="js/user.js"></script> 
<script type="text/javascript">
$(document).ready( function () {
    $('#userTable').DataTable();
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
                          <li class="is-active">Users</li>
                        </ul> 
                    </div>

                        
<table id="userTable" class="display">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>First name</th>
            <th>Last name</th>
            <th>User Type</th>
            <th>Team</th>
            <th>Reporting manager</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       
        <?php 
		$userSql = $db->query("SELECT u.users_id,u.first_name,u.last_name,u.employee_id,u.email,u.user_type,u.status,u.reporting_manager,t.team_name FROM users as u JOIN team as t ON u.team_id = t.team_id ORDER BY users_id DESC");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
		$encUid = $oEncryption->enc($row['users_id']);
		
		$rmSql = $db->query("SELECT concat(first_name,' ',last_name) as fullname FROM users WHERE users_id='".$row['reporting_manager']."'");  
		$rmRow = $rmSql->fetch_array();
		
		
		
        $content .= '<tr><td align="center">'.$a.'</td><td>'.$row['first_name'].'</td><td>'.$row['last_name'].'</td><td>'.$row['user_type'].'</td><td>'.$row['team_name'].'</td><td>'.$rmRow['fullname'].'</td><td>'.$row['status'].'</td>';
		
		$content .= '<td>';
		
		if($row['status'] == 'Reject' || $row['status'] == 'Pending') {
		$content .= '<a class="pointer" onclick="userAction(\'Active\','.$row['users_id'].')">Approve</a>  ';
		}
		
		if($row['status'] == 'Active' || $row['status'] == 'Pending') {
		$content .= '    <a class="pointer" onclick="userAction(\'Reject\','.$row['users_id'].')">Reject</a>  ';
		} 
		
		$content .= '        <a class="pointer" href="view_users.php?uid='.$encUid.'">View</a>  ';
		
		$content .='</td></tr>';
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
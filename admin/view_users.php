<?php include('header2.php');
include_once('../config/class.Encryption.php');
$oEncryption = new Encryption();
$uid = $oEncryption->dec($_GET['uid']);
$poSql = $db->query("SELECT u.users_id,u.first_name,u.last_name,u.employee_id,u.email,u.user_type,u.status,u.reporting_manager,t.team_name FROM users as u JOIN team as t ON u.team_id = t.team_id AND users_id='".$uid."'"); 
$row = $poSql->fetch_array();
$rmSql = $db->query("SELECT concat(first_name,' ',last_name) as rmname FROM users WHERE users_id='".$row['reporting_manager']."'");  
$rmRow = $rmSql->fetch_array();
?>
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
                           <li><a href="users">Users</a></li>
                          <li class="is-active">View users</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper"> 
            <!--<h1>New Register</h1>-->
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Fullname</label>
              <div class="col-sm-9">
               <?php echo $row['first_name'].' '.$row['last_name'];?>
              </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Employee Id</label>
                                    <div class="col-sm-9" id="HedgevalDiv">
                                    <?php echo $row['employee_id'];?>
                                    </div>
                                </div>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Email </label>
              <div class="col-sm-9">
               <?php echo $row['email'];?>
              </div>
              </div>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">User Type </label>
              <div class="col-sm-9">
               <?php echo $row['user_type'];?>
              </div>
              </div>
                <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Team </label>
              <div class="col-sm-9">
               <?php echo $row['team_name'];?>
              </div>
              </div>
              <?php if($rmRow['rmname'] !="") {  ?>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Reporting Manager </label>
              <div class="col-sm-9">
               <?php echo $rmRow['rmname'];?>
              </div>
              </div>
              <?php } ?>
               <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Status </label>
              <div class="col-sm-9">
               <?php echo $row['status'];?>
              </div>
              </div>
              
          </div>
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
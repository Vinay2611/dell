<?php include('header2.php');
include_once('../config/class.Encryption.php');
$oEncryption = new Encryption();
$decOrder_id = $oEncryption->dec($_GET['to_id']);

$odSql = $db->query("SELECT tr.to_id,tr.dateTime,tr.order_type,tr.venue,tr.document,tr.hr_approval,tr.geo_head_approval,tr.upload_pi,tr.upload_invoice,tr.status ,tr.order_number,tr.status,tr.start_date,tr.end_date,tr.amount,tm.team_name,CONCAT(u.first_name,' ',u.last_name) full_name FROM team_request as tr,team as tm,users as u WHERE tr.team_id = tm.team_id AND tr.users_id = u.users_id AND tr.to_id='".$decOrder_id."'");
$oRow = $odSql->fetch_object();
?>
<script src="js/order.js?v=1.3"></script>  
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
                           <li><a href="team_requests">Team Request</a></li>
                          <li class="is-active">Details</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper order-wrapper">
                        <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Order Number : <?php echo $oRow->order_number;?>
            <small class="pull-right" style="color:#F9F5F6;">Date: <?php echo $oRow->dateTime;?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      
      <div class="new-registration-wrapper"> 
            <!--<h1>New Register</h1>-->
             
             <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Request Number</label>
              <div class="col-sm-9">
              <?php echo $oRow->order_number;?>
              </div>
              </div>
             <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Requested By </label>
              <div class="col-sm-9">
              <?php echo $oRow->full_name;?>
              </div>
              </div>
             
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Team Name </label>
              <div class="col-sm-9">
              <?php echo $oRow->team_name;?>
              </div>
              </div>
              <div class="form-group row">
               <label for="" class="col-sm-3 col-form-label">Start Date</label>
               <div class="col-sm-9" id="HedgevalDiv">
                <?php echo $oRow->start_date;?>
                </div>
                </div>
              <div class="form-group row">
               <label for="" class="col-sm-3 col-form-label">End Date</label>
               <div class="col-sm-9" id="HedgevalDiv">
                <?php echo $oRow->end_date;?>
                </div>
                </div>
              
              
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Order Type </label>
                <div class="col-sm-9">
                    <?php echo $oRow->order_type;?>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Supporting Document</label>
                <div class="col-sm-9">
                   <a href="uploads/team_request/<?php echo $oRow->document;?>" target="_self"><?php echo $oRow->document;?></a>
                </div>
              </div>
               <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">HR Approval</label>
                <div class="col-sm-9">
                   <a href="uploads/team_request/<?php echo $oRow->hr_approval;?>" target="_self"><?php echo $oRow->hr_approval;?></a>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Geo Head Approval</label>
                <div class="col-sm-9">
                  <a href="uploads/team_request/<?php echo $oRow->geo_head_approval;?>" target="_self"><?php echo $oRow->geo_head_approval;?></a>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Pi</label>
                <div class="col-sm-9">
                   <a href="uploads/team_request/<?php echo $oRow->upload_pi;?>" target="_self"><?php echo $oRow->upload_pi;?></a>
                </div>
              </div>
               <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Invoice</label>
                <div class="col-sm-9">
                  <a href="uploads/team_request/<?php echo $oRow->upload_invoice;?>" target="_self"> <?php echo $oRow->upload_invoice;?></a>
                </div>
              </div>
              
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9"><?php echo $oRow->status;?></div>
              </div>
              
            
              
   <!-- <div class="form-group row">
   <label for="inputTeamName3" class="col-sm-3 col-form-label">Admin Name</label>
   <div class="col-sm-9"></div></div>
   </div>-->

      
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      
    </section>
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
<?php include('header2.php');
include('classes/class.common.php');
include_once('../config/class.Encryption.php');
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
                          <li class="is-active">Reports</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper"> 
            <!--<h1>New Register</h1>-->
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">
              <a href="reports/user-report.php" style="color:#F5F5F5;" title="Click here to download report">User Report</a></label>
              <div class="col-sm-9">
              </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">
                <a href="reports/contest-report.php" style="color:#F5F5F5;" title="Click here to download report">Contest Report</a></label>
                                </div>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">
              <a href="reports/po-report.php" style="color:#F5F5F5;" title="Click here to download report">PO Report</a></label>
              <div class="col-sm-9">
              </div>
              </div>
              <!--<div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">PO value </label>
                <div class="col-sm-9">
                
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Upload PO</label>
                <div class="col-sm-9">
                 
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Date of PO </label>
                <div class="col-sm-9">
                  
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Agency fees</label>
   <div class="col-sm-9">
  </div>
   </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Balance</label>
                <div class="col-sm-9"></div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Added By</label>
   <div class="col-sm-9">
 </div>
   </div>
              -->
           
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
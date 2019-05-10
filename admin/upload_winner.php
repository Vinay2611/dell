<?php include('header2.php');
include_once('../config/db.php');
include('classes/class.common.php');
$teamDropdown = Common::showTeamDropdown();
$showContestDropdown = Common::showContestDropdown();
?>
<script src="js/upload-winner.js?v=2.0"></script>
<script type="application/javascript">
  $( function() {
       var dateFormat = "dd/mm/yy",
      from = $("#announcement_date" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
	     dateFormat: 'dd-mm-yy' 
        })
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
                           <li class="is-active">Upload Winner</li>
                        </ul> 
                    </div>
                        <div class="new-registration-wrapper">
                        <div class="text-right"><a href="uploads/sample_file.xlsx" target="_self" style="color:#F0E7E8;">Click here to download sample file </a></div>
                        
						    <!--<h1>New Register</h1>-->
  <form id="frmUploadwinner" name="frmUploadwinner" method="post" action="controllers/upload_winner_process.php" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Contest for</label>
                                    <div class="col-sm-9">
                                        <label class="custom-radio">Individual
                                            <input type="radio"  name="contest_for" id="contest_for" value="Individual">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom-radio">Team
                                            <input type="radio"  name="contest_for" id="contest_for" value="Team">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Contest name</label>
                                    <div class="col-sm-9">
                                     <select name="contest_id" id="contest_id" class="form-control">
                                     <option value="" selected>Select</option>
                                     <?=$showContestDropdown;?>
                                     </select>
                                    </div>
                                </div>
                                <div id="indiDiv" style="border:#125BDB solid 0px;"> 
                                
                                <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Upload list</label>
                                 <div class="col-sm-9">
                                 <input type="file" id="winner_list" name="winner_list" value="">
                                  </div>
                                 </div>
                                </div>
                                 <div id="teamDiv" style="border:#D10C0F solid 0px; display:none;"> 
                                 <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Team name</label>
                                    <div class="col-sm-9">
                                       <select name="team_id" id="team_id" class="form-control">
                                       <option value="" selected>Select</option>
                                       <?php echo $teamDropdown;?>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Reporting manager</label>
                                    <div class="col-sm-9" id="rmDiv">
                                       <select name="rm_id" id="rm_id" class="form-control">
                                       <option value="" selected>Select</option>
                                       </select>
                                    </div>
                                </div>        
                                <div class="form-group row">
                                   <label for="" class="col-sm-3 col-form-label">Team amount</label>
                                   <div class="col-sm-9">
                                   <input name="team_amount" id="team_amount" class="form-control" value="">
                                   </div>
                                </div>                          
                                </div>
                                <div class="form-group row">
<label for="inputName3" class="col-sm-3 col-form-label">Announcement date</label>
                                    <div class="col-sm-9">
<input type="text" class="form-control" id="announcement_date" name="announcement_date" placeholder="Announcement date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
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
<?php include('header2.php');
include('classes/class.common.php');
$poDropdown = Common::showPoDropdown();
$mmDropdown = Common::showMMDropdown();
?>
<script src="js/validation/contest.js?v=2.0"></script>
<script type="application/javascript">
  $( function() {
       var dateFormat = "dd/mm/yy",
      from = $("#contest_start_date" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 2,
	     dateFormat: 'dd-mm-yy' 
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#contest_end_date" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 2,
		dateFormat: 'dd-mm-yy' 
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
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
                           <li><a href="show_contest">Contest</a></li>
                          <li class="is-active">Create contest</li>
                        </ul> 
                    </div>

                        <div class="new-registration-wrapper">
						    <!--<h1>New Register</h1>-->

                            <form id="frmCreate_contest" name="frmCreate_contest" method="post">
                                
                               <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Contest Type</label>
                                    <div class="col-sm-9">
                                        <label class="custom-radio">CSG
                                            <input type="radio" checked="checked" id="contest_type" name="contest_type" value="CSG">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom-radio">ISG
                                            <input type="radio" checked="checked" id="contest_type" name="contest_type" value="ISG">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div> 
                               
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Contest owner</label>
                                    <div class="col-sm-9">
                                       <select name="contest_owner_id" id="contest_owner_id" class="form-control">
                                       <option value="" selected>Select</option>
                                       <?php echo $mmDropdown;?>
                                       </select>
                                    </div>
                                </div>
                                
                                
                                
                                <!--<div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Contest for</label>
                                    <div class="col-sm-9">
    <label class="custom-radio">Individual<input type="radio" checked="checked" name="contest_for" id="contest_for" value="Individual">
     <span class="checkmark"></span>
    </label>
    <label class="custom-radio">Team<input type="radio" checked="checked" name="contest_for" id="contest_for" value="Team">
     <span class="checkmark"></span></label>
                                    </div>
                                </div>-->
                                
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">PO#</label>
                                    <div class="col-sm-9">
                                       <select name="po_id" id="po_id" class="form-control">
                                       <option value="" selected>Select</option>
                                       <?php echo  $poDropdown;?>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Balance amount</label>
                                    <div class="col-sm-9" id="balanceDiv">
                                       Please select PO Number
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Team amount</label>
                                    <div class="col-sm-9" id="TeamDiv">
                                       Please select PO Number
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Individual amount</label>
                                    <div class="col-sm-9" id="IndDiv">
                                       Please select PO Number
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-3 col-form-label">Contest Name</label>
                                    <div class="col-sm-9">
               <input type="text" class="form-control" id="contest_name" name="contest_name" placeholder="Enter Contest Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-3 col-form-label">Start Date</label>
                                    <div class="col-sm-9">
<input type="text" class="form-control" id="contest_start_date" name="contest_start_date" placeholder="Start Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
<label for="inputName3" class="col-sm-3 col-form-label">End Date</label>
                                    <div class="col-sm-9">
<input type="text" class="form-control" id="contest_end_date" name="contest_end_date" placeholder="End Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label for="inputName3" class="col-sm-3 col-form-label">Budget</label>
                               <div class="col-sm-9">
               <input type="text" class="form-control" id="budget" name="budget" placeholder="Enter Contest Budget" autocomplete="off">
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
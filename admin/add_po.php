<?php include('header2.php');
include('classes/class.common.php');
$quarterDropdown = Common::quarterDropdown();
?>
  <script src="js/purchase-order.js?v=1.5"></script>
  <script type="application/javascript">
  $( function() {
       var dateFormat = "dd/mm/yy",
      from = $("#po_date" )
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
                           <li><a href="purchase_order">Purchase Order</a></li>
                          <li class="is-active">Add Purchase Order</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper"> 
            <!--<h1>New Register</h1>-->
            <form id="frmPurchase_order" name="frmPurchase_order" action="controllers/po_process.php" enctype="multipart/form-data" method="post">
              
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Quarter *</label>
              <div class="col-sm-9">
              <select name="hedge_id" id="hedge_id" class="form-control">
				<option value="" selected>Select</option> 
                    <?=$quarterDropdown;?>         
              </select>
              </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hedge rate</label>
                                    <div class="col-sm-9" id="HedgevalDiv">
                                       Please select quarter.
                                    </div>
                                </div>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">PO# *</label>
              <div class="col-sm-9">
              <input type="text" class="form-control"  id="po_number" name="po_number" autocomplete="off" placeholder="Enter PO number here.">
              </div>
              </div>
              
              
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">PO value *</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="po_value" name="po_value" value="" placeholder="Enter PO value" autocomplete="off">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Upload PO</label>
                <div class="col-sm-9">
                  <input type="file" id="po_file" name="po_file" value="">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Agency fees</label>
   <div class="col-sm-9">
 <input type="text" class="form-control" id="agency_fee" name="agency_fee"  style="width:50px;" autocomplete="off" readonly value="7">
 </div>
   </div>
   <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Program manager fee *</label>
                <div class="col-sm-9"><input type="text" class="form-control" id="pm_fee" name="pm_fee" autocomplete="off" value=""></div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">CGST</label>
                <div class="col-sm-9"><input type="text" class="form-control" id="cgst" name="cgst"  autocomplete="off" readonly value=""> </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">SGST</label>
                <div class="col-sm-9"><input type="text" class="form-control" id="sgst" name="sgst"  autocomplete="off" readonly value=""></div>
              </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Balance</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="po_budget" name="po_budget" autocomplete="off" readonly value=""></div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Amount for individual *</label>
                <div class="col-sm-9"><input type="text" class="form-control" id="individual_amount" name="individual_amount" autocomplete="off" value=""></div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Amount for team*</label>
         <div class="col-sm-9"><input type="text" class="form-control" id="team_amount" name="team_amount" autocomplete="off" value=""></div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Date of PO *</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="po_date" name="po_date" autocomplete="off" placeholder="Select PO date">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                  <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit"><span id="validMsg"></span>
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
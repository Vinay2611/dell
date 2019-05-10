<?php include('header2.php');
include_once('../config/class.Encryption.php');
$oEncryption = new Encryption();
$decpId = $oEncryption->dec($_GET['pid']);

$poSql = $db->query("SELECT p.po_id, p.po_number,p.po_file, p.po_value, date_format(p.`date_of_po`,'%d %M %y') as date_of_po, p.agency_fee, p.tax, p.balance_amount,concat(a.first_name,' ',a.last_name) as admin_name,h.quarter,h.hedge_rate FROM purchase_order as p JOIN admin_users as a JOIN hedge_rate as h ON p.hedge_id = h.hedge_id AND p.admin_id = h.admin_id WHERE po_id='".$decpId."'"); 
$row = $poSql->fetch_array();
?>
  <script src="js/purchase-order.js?v=1.3"></script>
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
                          <li class="is-active">View Purchase Order</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper"> 
            <!--<h1>New Register</h1>-->
           
              
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Quarter </label>
              <div class="col-sm-9">
              <?=$row['quarter'];?>
              </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hedge Rate</label>
                                    <div class="col-sm-9" id="HedgevalDiv">
                                     <?=$row['hedge_rate'];?>
                                    </div>
                                </div>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">PO# </label>
              <div class="col-sm-9">
              <?=$row['po_number'];?>
              </div>
              </div>
              
              
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">PO value </label>
                <div class="col-sm-9">
                  <?=$row['po_value'];?>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Date of PO </label>
                <div class="col-sm-9">
                   <?=$row['date_of_po'];?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Agency fees</label>
   <div class="col-sm-9">
  <?php  $feeinpercent = $row['po_value'] / 100 * $row['agency_fee'];
  echo $feeinpercent;
  ?></div>
   </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Balance</label>
                <div class="col-sm-9"><?=$row['balance_amount'];?></div>
              </div>
              
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">PO File</label>
                <div class="col-sm-9">
                 <a href="uploads/po/<?=$row['po_file'];?>" style="color:#F1EAEA;" target="_self"><?=$row['po_file'];?></a>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Added By</label>
   <div class="col-sm-9">
  <?=$row['admin_name'];?></div>
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
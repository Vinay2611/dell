<?php include('header2.php');
include_once('../config/class.Encryption.php');
$oEncryption = new Encryption();
$decOrder_id = $oEncryption->dec($_GET['to_id']);

$odSql = $db->query("SELECT tr.to_id,tr.dateTime,tr.order_type,tr.venue,tr.document,tr.hr_approval,tr.geo_head_approval,tr.upload_pi,tr.upload_invoice,tr.status ,tr.order_number,tr.status,date_format(tr.start_date,'%d-%m-%y') as start_date,date_format(tr.end_date,'%d-%m-%y') as end_date,tr.amount,tm.team_name,CONCAT(u.first_name,' ',u.last_name) full_name FROM team_request as tr,team as tm,users as u WHERE tr.team_id = tm.team_id AND tr.users_id = u.users_id AND tr.to_id='".$decOrder_id."'");
$oRow = $odSql->fetch_object();
?>
<script type="application/javascript">
  $( function() {
       var dateFormat = "dd/mm/yy",
      from = $("#request_start_date" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 2,
	     dateFormat: 'dd-mm-yy' 
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#request_end_date" ).datepicker({
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
   <script src="js/travel-request.js" type="text/javascript"></script>
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
                          <li class="is-active">Edit Team Request</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper order-wrapper">
                        <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Request Number : <?php echo $oRow->order_number;?>
            <small class="pull-right" style="color:#F9F5F6;">Date: <?php echo $oRow->dateTime;?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <form id="frmtravelRequest" name="frmtravelRequest" action="controllers/team_request_process.php"  enctype="multipart/form-data" method="post">
      <div class="new-registration-wrapper"> 
            <!--<h1>New Register</h1>-->
             
             
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
                  <input type="text" name="request_start_date" id="request_start_date" value="<?php echo $oRow->start_date;?>" autocomplete="off">
                </div>
                </div>
              <div class="form-group row">
               <label for="" class="col-sm-3 col-form-label">End Date</label>
               <div class="col-sm-9" id="HedgevalDiv">
                  <input type="text" name="request_end_date" id="request_end_date" value="<?php echo $oRow->end_date;?>" autocomplete="off">                
                </div>
                </div>
                <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Order Type </label>
    <div class="col-sm-9">
    <input type="radio" name="order_type" id="order_type1" value="Team Outing" <?php if($oRow->order_type == "Team Outing") { echo "checked";     } ?>> Team Outing 
    <input type="radio" name="order_type" id="order_type2" value="Refreshment" <?php if($oRow->order_type == "Refreshment") { echo "checked";     } ?>> Refreshment
                </div>
              </div>
               <div class="form-group row">
                <div class="col-sm-9">
                ** Allowed Documents (Pdf / Word / Excelsheet)
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Supporting Document</label>
                <div class="col-sm-9">
                <input type="file" name="document_name" id="document_name" value="<?php echo $oRow->document;?>"> 
                   <a href="uploads/team_request/<?php echo $oRow->document;?>" target="_blank"><?php echo $oRow->document;?></a>
                </div>
              </div>
               <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">HR Approval</label>
                <div class="col-sm-9">
                <input type="file" name="hr_approval" id="hr_approval" value="<?php echo $oRow->hr_approval;?>"> 
                   <a href="uploads/team_request/<?php echo $oRow->hr_approval;?>" target="_self"><?php echo $oRow->hr_approval;?></a>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Geo Head Approval</label>
                <div class="col-sm-9">
                 <input type="file" name="geo_approval" id="geo_approval" value="<?php echo $oRow->geo_head_approval;?>"> 
                  <a href="uploads/team_request/<?php echo $oRow->geo_head_approval;?>" target="_self"><?php echo $oRow->geo_head_approval;?></a>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Pi</label>
                <div class="col-sm-9">
                 <input type="file" name="pi" id="pi" value="<?php echo $oRow->upload_pi;?>"> 
                   <a href="uploads/team_request/<?php echo $oRow->upload_pi;?>" target="_self"><?php echo $oRow->upload_pi;?></a>
                </div>
              </div>
               <div class="form-group row">
                <label for="inputTeamName3" class="col-sm-3 col-form-label">Invoice</label>
                <div class="col-sm-9">
                <input type="file" name="invoice" id="invoice" value="<?php echo $oRow->upload_invoice;?>"> 
                  <a href="uploads/team_request/<?php echo $oRow->upload_invoice;?>" target="_self"> <?php echo $oRow->upload_invoice;?></a>
                </div>
              </div>
              <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Amount </label>
              <div class="col-sm-9">
               <input type="text" name="amount" id="amount" value="<?php echo $oRow->amount;?>" autocomplete="off">
              </div>
              </div>
               <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Venue </label>
              <div class="col-sm-9">
               <textarea name="venue" id="venue" cols="35" rows="4"><?php echo $oRow->venue;?></textarea>
              </div>
              </div>
              
    <div class="form-group row">
    <label for="inputTeamName3" class="col-sm-3 col-form-label">Status</label>
    <div class="col-sm-9">
	<input type="radio" name="status" id="status" value="Pending" <?php if($oRow->status == "Pending") { echo "checked"; } ?>> Pending
   <input type="radio" name="status" id="status" value="In-progress" <?php if($oRow->status == "In-progress") { echo "checked";  } ?>> In-progress
<input type="radio" name="status" id="status" value="Completed" <?php if($oRow->status == "Completed") { echo "checked";  } ?>> Completed
<input type="radio" name="status" id="status" value="Rejected" <?php if($oRow->status == "Rejected") { echo "checked";  } ?>> Rejected
	</div>
    </div>
              
   <div class="col-sm-9 text-center">
   <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
   <input type="hidden" name="to_id" id="to_id" value="<?=$_GET['to_id'];?>">
   <div id="msg"></div>
   </div>
    </div>
       </form>
       </section>
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
<?php include('header2.php');
include_once('../config/class.Encryption.php');
$oEncryption = new Encryption();
$decOrder_id = $oEncryption->dec($_GET['oid']);


$odSql = $db->query("SELECT o.order_id,o.order_number,o.order_status,o.shipping_address,o.city,o.pincode,o.agency_comments,o.remark,DATE_FORMAT(o.order_date,'%d %M %Y') as order_date,o.last_update,concat(u.first_name,' ',u.last_name) as full_name,u.users_id  FROM orders as o,users as u WHERE o.order_id = '".$decOrder_id."' AND u.users_id = o.users_id");
$oRow = $odSql->fetch_object();
?>
<script src="js/order.js?v=1.4"></script>
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
                           <li><a href="orders">Orders</a></li>
                          <li class="is-active">Order details</li>
                        </ul> 
                    </div>
        
          <div class="new-registration-wrapper order-wrapper">
                        <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Order Number : <?php echo $oRow->order_number;?>
            <small class="pull-right" style="color:#F9F5F6;">Date: <?php echo $oRow->order_date;?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <h3>Address</h3>
          <address>
            <strong><?php echo $oRow->shipping_address;?>
          </address>
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th>Product</th>
              <th>Brand details</th>
              <th>Size</th>
              <th>Website</th>
              <th>URL</th>
               <th>Price</th>
               <th>Status</th>
               <th>Remark</th>
               <th>Replacement Comment </th>
               <th align="center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
			$odQuery = $db->query("SELECT od.od_id,od.order_id, od.product, od.brand_details,od.size,od.website,od.price,od.url,od.remark,od.comment,od.order_status,od.exception_order,od.exception_status,od.dateTime FROM order_details as od JOIN orders as o WHERE o.order_id='".$oRow->order_id."' AND o.order_id = od.order_id AND o.users_id='".$oRow->users_id."'"); ?>
            <tr>
              <?php 
			  $grandTotal ="";
			  while($prod = $odQuery->fetch_object()) { 
			  $grandTotal += $prod->price;
			  ?>  
              <td><?php echo $prod->product;?></td>
              <td><?php echo $prod->brand_details;?></td>
              <td><?php echo $prod->size;?></td>
              <td><?php echo $prod->website;?></td>
            
              <td><textarea name="url" id="url" cols="25" rows="5" readonly><?php echo $prod->url;?></textarea></td>
                <td><?php echo $prod->price;?></td>
               <td><?php echo $prod->order_status;?></td>
                <td><?php echo $prod->remark;?></td>
                <td><?php echo $prod->comment;?></td>
                <?php
				//or check 
                if ($prod->order_status == 'Return Request'){
                    //echo $prod->order_status;
                } else { ?>
                 <td>
                  <select name="order_status" class="od" id="<?php echo $prod->od_id;?>" data-oid="<?php echo $_GET['oid'];?>">
                  <option value="">Select</option>
                  <option value="Pending"  <?php if($prod->order_status == "Pending") { echo "selected"; }?>>Pending</option>
                   <option value="In-progress"  <?php if($prod->order_status == "In-progress") { echo "selected"; }?>>In-progress</option>
                   <option value="Completed"  <?php if($prod->order_status == "Completed") { echo "selected"; }?>>Completed</option>
                  <option value="Rejected" <?php if($prod->order_status == "Rejected") { echo "selected"; }?>>Rejected</option>
                 </select>
                 
          <?php if(($prod->order_status == 'Pending') && ($prod->exception_order =='No')) { ?>
         <button type="button" name="excClass"  class="excClass" id="<?=$decOrder_id;?>" data-oid="<?php echo $_GET['oid'];?>" data-status="Yes">Exception</button>
		 <?php } else if($prod->exception_order =='Yes') {  ?>				 
         <button type="button" name="excClass"  class="excClass" id="<?=$decOrder_id;?>" data-oid="<?php echo $_GET['oid'];?>" data-status="No">Remove Exception</button>
         <?php } else {} ?>
                 </td>
                <?php }
                ?>

              <!--<td><button type="button" id="reButton<?/*=$decOrder_id;*/?>" class="btn btn-info" onClick="returnRequet('<?php /*echo $_GET['id']; */?>');">Return</button></td>-->
            </tr>
            <?php } ?>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
          <p class="lead"></p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th class="text-right" style="width:30%;">Total:</th>
                <td><?php echo $grandTotal;?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
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
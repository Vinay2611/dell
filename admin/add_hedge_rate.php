<?php include('header2.php');?>
<script type="application/javascript">
  $( function() {
       var dateFormat = "dd/mm/yy",
      from = $("#start_date" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 2,
	     dateFormat: 'dd-mm-yy' 
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#end_date" ).datepicker({
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
<script type="text/javascript">
$(function() {
$("#frmHedgeRate").validate({
  rules: {
    hedge_rate: {
      required: true,
	   number: true
    },start_date: {
      required: true
    },end_date: {
      required: true
    }
  },
  submitHandler: function() { 
   $.post('controllers/hedgeRate_process.php',$("#frmHedgeRate").serialize(), function(data) {
      var obj = jQuery.parseJSON(data);
	    if(obj['success'] == true) {
	    $('input[type="submit"]').attr('disabled','disabled');
	     //$('textarea').val('');	
		 $('input[type="text"]').val('');
		 //$('select').val('');		
		 $("#msg").html(obj['message']).fadeIn(2000).delay(2000).fadeOut(2000);	
    	 $('html,body').animate({
         scrollTop: $("#msg").offset().top-150
		 }, 500);		 
				 
		 setTimeout(function() { 
		 $(location).attr('href','show_hedge_rate');
		 },2000);
	   }
	  
	   });
   }
});
});
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

                        <div class="new-registration-wrapper">

                            <!--<h1>New Register</h1>-->

                            <form id="frmHedgeRate" name="frmHedgeRate">
                                
                                
                                 <div class="form-group row">
                                    <label for="inputName3" class="col-sm-3 col-form-label">Quarter</label>
                                    <div class="col-sm-9">
                                     <select name="quarter" id="quarter" class="form-control" >
                                     <option value="">Select</option>
                                     <option value="Q1">Q1</option>
                                     <option value="Q2">Q2</option>
                                     <option value="Q3">Q3</option>
                                     <option value="Q4">Q4</option>
                                     </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-3 col-form-label">Hedge Rate</label>
                                    <div class="col-sm-9">
                                     <input type="text" class="form-control" id="hedge_rate" name="hedge_rate" autocomplete="off" placeholder="Enter Hedge Rate">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-3 col-form-label">Start Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="start_date" name="start_date" autocomplete="off"  placeholder="Enter Start Date" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName3" class="col-sm-3 col-form-label">End Date</label>
                                    <div class="col-sm-9">
           <input type="text" class="form-control" id="end_date" name="end_date" autocomplete="off" placeholder="Enter End Date" value="">
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                                   <div id="msg"></div>
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
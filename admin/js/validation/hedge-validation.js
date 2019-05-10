// Wait for the DOM to be ready
$(function() {
$("#frmHedgeRate").validate({
  rules: {
    hedge_rate: {
      required: true
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
		 $(location).attr('href','hedge_rate');
		 },2000);
	   }
	  
	   });
   }
});
});
// Travel Request
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='frmtravelRequest']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      request_start_date: {
        required: true
      },request_end_date: {
        required: true
      },order_type: {
        required: true
      },amount: {
        required: true
      }
    },
    // Specify validation error messages
    messages: {
      request_start_date: {
        required: "Please select Date"
      },request_end_date: {
        required: "Please select Date"
      },order_type: {
        required: "Your input is required"
      },amount: {
       required: "Your input is required"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    $.ajax({
    url: 'controllers/team_request_process.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function(data){
        //alert(data);
		//return false;
		 var obj = jQuery.parseJSON(data); 
		 if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'purchase_order'); 	
          }
          });
	   
	     } else if(obj['success'] == false) { 
		  bootbox.alert({
          message: obj['message'],
          size: 'small'
          });
		 }	
    }
    });
	  //Submit ends here
    }
  });
});
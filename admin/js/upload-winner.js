// Add Purchase order
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='frmUploadwinner']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      contest_for: {
        required: true
      },contest_name: {
        required: true
      },team_name: {
        required: true
      },annocement_date: {
        required: true
      }
    },
    // Specify validation error messages
    messages: {
      contest_for: {
        required: "Please enter PO number"
      },contest_name: {
        required: "Please enter PO value"
      },team_name: {
        required: "Please select PO date"
      },annocement_date: {
        required: "Agency fee is mandatory"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
		$.ajax({
    url: 'upload_winner_process.php',
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    success: function(data){
        //alert(data);
		 var obj = jQuery.parseJSON(data); 
		 if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'ind_winners'); 	
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
      //$("#frmUploadwinner").submit();
	   /*$.post('controllers/upload_winner_process.php',$("#frmUploadwinner").serialize(), function(data) {
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
	   });*/
	  //Submit ends here
    }
  });
});
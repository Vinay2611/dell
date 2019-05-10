
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='frmCreate_contest']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      contest_type: {
        required: true
      },po_number: {
        required: true
      },contest_name: {
        required: true
      },contest_start_date: {
        required: true
      },contest_end_date: {
        required: true
      },budget: {
        required: true
      }
    },
    // Specify validation error messages
    messages: {
      contest_type: {
        required: "Please select contest type"
      },po_number: {
        required: "Please select PO"
      },contest_name: {
        required: "Please enter contest name"
      },contest_start_date: {
        required: "Please select contest start date"
      },contest_end_date: {
        required: "Please select contest end date"
      },budget: {
        required: "Please enter contest budget"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
       $.post('controllers/contest_process.php',$("#frmCreate_contest").serialize(), function(data) {
	   var obj = jQuery.parseJSON(data); 
	    if(obj['success'] == true) {
	     bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'show_contest.php'); 	
          }
          });
	   
	     } else if(obj['success'] == false) { 
		  bootbox.alert({
          message: obj['message'],
          size: 'small'
          });
		 }	   
	   });
	  //Submit ends here
    }
  });
});


function contestAction(status,contest_id) {
	//alert(status);
	 $.post('controllers/action_process.php',{action:"contestStatus",contest_id:contest_id,status:status}, function(data) {
	  var obj = jQuery.parseJSON(data); 
	  
	   if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'show_contest'); 	
          }
          });
	   } else if(obj['success'] == false) { 
		  bootbox.alert({
          message: obj['message'],
          size: 'small'
          });		   
	   }
   
	   });	
}
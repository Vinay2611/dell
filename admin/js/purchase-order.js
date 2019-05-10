$(function() {
	$("#pm_fee").change(function() {
	   var po_value = $("#po_value").val();	
       var agency_fee = $("#agency_fee").val();	
	    var pm_fee = $("#pm_fee").val();
		//alert(pm_fee);	
	   if(po_value) {
		var total = po_value / 100 * agency_fee;
		var cgst = po_value / 100 * 9;  
		var sgst = po_value / 100 * 9; 
		var val = po_value - cgst - sgst; 
		var po_budget = val - total;
		$("#cgst").val(cgst);
		$("#sgst").val(sgst);
		$("#po_budget").val(po_budget - pm_fee);
		 
	   }
	});
	
	
	
	$("#team_amount").blur(function() {
	var individual_amount = $("#individual_amount").val();	
    var team_amount = $("#team_amount").val();	
	var po_budget = $("#po_budget").val();
	var total_amount = Number(individual_amount) + Number(team_amount);	
	//alert(total_amount);
	   if(total_amount != po_budget) {
	   $("#validMsg").html('Amount is different than balance amount.');
	    $('input[type="submit"]').attr('disabled','disabled');
	   } else {
       $("#validMsg").html('');
	   $('input[type="submit"]').removeAttr('disabled');
	   }
	});
	
});


// Add Purchase order
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='frmPurchase_order']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      po_number: {
        required: true
      },po_value: {
        required: true,
		number: true
      },po_date: {
        required: true
      },agency_fee: {
        required: true
      },pm_fee: {
        required: true
      },po_budget: {
        required: true
      },individual_amount: {
        required: true
      },team_amount: {
        required: true
      }
    },
    // Specify validation error messages
    messages: {
      po_number: {
        required: "Please enter PO number"
      },po_value: {
        required: "Please enter PO value"
      },po_date: {
        required: "Please select PO date"
      },agency_fee: {
        required: "Agency fee is mandatory"
      },po_budget: {
        required: "Budget amount is not calculated, enter PO value"
      },individual_amount: {
       required: "Please enter individual amount"
      },team_amount: {
       required: "Please enter team amount"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    $.ajax({
    url: 'controllers/po_process.php',
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
function userAction(status,users_id) {
	 $.post('controllers/action_process.php',{action:"order",users_id:users_id,status:status}, function(data) {
	  var obj = jQuery.parseJSON(data); 
	  
	   if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'users.php'); 	
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






$(function() {
    $(".od").change(function() {
		
	//bootbox.confirm("This is the default confirm!", function(result){ 	
	var od_id =  $(this).attr('id');
	var oid = $(this).attr("data-oid");
	var val = $("#"+od_id).val();
	//alert(od_id);
	//alert(val);
	   if((od_id  && val)) {
	   $.post('controllers/order_process.php',{action:"order",od_id:od_id,status:val}, function(data) {
	   //alert(data);
	   var obj = jQuery.parseJSON(data); 
	   if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'order_details?oid='+oid); 	
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
	});
});



$(function() {
    $(".excClass").click(function() {
	var od_id =  $(this).attr('id');
	var oid = $(this).attr('data-oid');
    var status = $(this).attr('data-status');
	
	if(od_id) {
	   $.post('controllers/exception_process.php',{action:"exception",od_id:od_id,status:status}, function(data) {
	   //alert(data);
	   var obj = jQuery.parseJSON(data); 
	   if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'order_details?oid='+oid); 	
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
	
	
	/*** if((od_id  && val)) {
	   $.post('controllers/order_process.php',{action:"order",od_id:od_id,status:val}, function(data) {
	   //alert(data);
	   var obj = jQuery.parseJSON(data); 
	   if(obj['success'] == true) {
	      bootbox.alert({
          message: obj['message'],
          callback: function () {
		  $(location).attr("href", 'order_details?oid='+oid); 	
          }
          });
	   } else if(obj['success'] == false) { 
		  bootbox.alert({
          message: obj['message'],
          size: 'small'
          });		   
	   }
   
	   });	
	   	
	}**/
	}); 
});
function userAction(status,users_id) {
	 $.post('controllers/action_process.php',{action:"user",users_id:users_id,status:status}, function(data) {
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
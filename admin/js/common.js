$(function() {
	
	
	$("#po_id").change(function() {
	   var po_id = $("#po_id").val();
       $.post('controllers/action_process.php',{action:'fetchPoval',po_id:po_id}, function(data) {
	   var obj = jQuery.parseJSON(data);
		   if(obj.success == true) {
			$("#balanceDiv").html(obj.balance_amount);
			$("#TeamDiv").html(obj.team_amount);
			$("#IndDiv").html(obj.individual_amount);
			}
	   });
	});
	
	
	$("#hedge_id").change(function() {
	   var hedge_id = $("#hedge_id").val();	
	   $.post('controllers/action_process.php',{action:'fetchHedgeRate',hedge_id:hedge_id}, function(data) {
	   $("#HedgevalDiv").html(data);
	   });
	});
	
	
	$("input[name='contest_for']").click(function() {
		var contest_for = $("input[name='contest_for']:checked").val();
		if($("input[name='contest_for']:checked").val() == "Individual") {
		$("#indiDiv").show('fast');
	    $("#teamDiv").hide('fast');
		} else if($("input[name='contest_for']:checked").val() == "Team") {
		$("#indiDiv").hide('fast');	
		$("#teamDiv").show('fast');
		} else { }
	    //alert($("input[name='contest_for']:checked").val());	
	    //$.post('controllers/action_process.php',{action:'fetchContest',contest_for:contest_for}, function(data) {
	    //$("#contest_id").html(data);
	    //});
	});
	
	$("#team_id").change(function() {
		//alert($("#team_id").val());
		if($("#team_id").val()) {
		 $.post('controllers/action_process.php',{action:'fetchTeamLead',team_id:$("#team_id").val()}, function(data) {
			 //alert(data);
			 if(data == "") {
			 //$('#rmDiv').html('No data found, Please add Reporting Manager for this team.');
			 $("#rm_id").html();
			 } else {
			 $("#rm_id").html(data);
			 }
	     });	
		}
	});

});
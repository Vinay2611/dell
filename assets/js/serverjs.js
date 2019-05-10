$( function () {

    //User registration
    $("#registration").submit( function ( e ) {
        e.preventDefault();
        var validate = true;
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        //var selectedCountry = $(this).children("option:selected").val();
        var team_id = $("#team_id").val();
        var employee_id = $('#employee_id').val();
        var email = $('#email').val();
        //var user_name = $('#user_name').val();
        var password = $('#password').val();
        var reporting_manager = $('#reporting_manager').val();
        var lenght_password = $( '#password' ).val().length;

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailLegalReg =  /^([\w-\.]+@(?!dell.com)(?!dellteam.com)(?!emc.com)([\w-]+\.)+[\w-]{2,4})?$/;


        if ( first_name == '' ){
            validate = false;
            $('.validate_msg1').show();
        } else {
            $('.validate_msg1').hide();
        }

        if ( team_id == '' ){
            validate = false;
            $('.validate_msg2').show();
        } else {
            $('.validate_msg2').hide();
        }

        if ( reporting_manager == '' ){
            validate = false;
            $('.validate_msg3').show();
        } else {
            $('.validate_msg3').hide();
        }

        if ( employee_id == '' ){
            validate = false;
            $('.validate_msg4').show();
        } else {
            $('.validate_msg4').hide();
        }

        if (email == ''){
            validate = false;
            $('.validate_msg5').show();
        } else{
            $('.validate_msg5').hide();
        }

        if (!emailReg.test(email)){
            validate = false;
            $('.validate_email').show();
        }else if (emailLegalReg.test(email)){
            validate = false;
            $('.validate_email').hide();
            $('.validate_email_reg').show();
        }else{
            $('.validate_email').hide();
            $('.validate_email_reg').hide();
        }

        if ( lenght_password == '') {
            validate = false;
            $('.validate_msg6').show();
        }else if (lenght_password < 6){
            validate = false;
            $('.validate_msg6').hide();
            $('.validate_pass').show();
        }else{
            $('.validate_msg6').hide();
            $('.validate_pass').hide();
        }

        var formData = new FormData($(this)[0]);

        if (validate == true) {
            $.ajax({
                type: "POST",
                url: "config/server-response.php",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                //data: form.serialize(),
                success: function (data) {
                    //bootbox.alert(data.msg);
                    $('.validate_msg').hide();
                    $('.validate_email').hide();
                    var data = JSON.parse(data);
                    console.log(data);
                    if (data.success) {
                        /*$('.response_msg').show();
                        $('.response_msg').text(data.msg);*/
                        bootbox.alert({
                            message: data.msg,
                            callback: function(){
                                setTimeout(function(){
                                    location.href = "login.php";
                                }, 300);
                            }
                        });
                    } else {
                        bootbox.alert(data.msg);
                        /*$('.response_msg').show();
                        $('.response_msg').text(data.msg);*/
                        //setTimeout(function(){ location.reload(); }, 1000);
                    }
                }
            });
        }
    });


    //login
    $("#login").submit( function ( e ) {
        e.preventDefault();
        var validate = true;
        var email = $('#email').val();
        var password = $('#password').val();

        if ( email == '' || password == '') {
            validate = false;
            $('.validate_msg').show();
            //alert("All input fields is required");
            return false;
        }
        if( IsEmail( email ) == false ){
            validate = false;
            $('.validate_msg').show();
            //alert('Invalid Email!');
            return false;
        }
        var formData = new FormData($(this)[0]);

        if (validate == true) {
            $.ajax({
                type: "POST",
                url: "config/server-response.php",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                //data: form.serialize(),
                success: function (data) {
                    var data = JSON.parse(data);
                    $('.validate_msg').hide();
                    if (data.valid == 1) {
                        //$('.response_msg').show();
                        //$('.response_msg').text(data.message);
                        setTimeout(function(){
                            if (data.user_type == 'ISR' || data.user_type == 'TSR'|| data.user_type == 'IDCSE' || data.user_type == 'AISR'){
                                location.href = "claim-list.php";
                            } else if (data.user_type == 'ISM') {
                                location.href = "dashboard-team.php";
                            }else if (data.user_type == 'MM') {
                                location.href = "marketing-manager/dashboard.php";
                            }
                        }, 300);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);

                    }
                }
            });
        }
    });


    // Claim Request
    $("#claimRequest").submit( function ( e ) {
        e.preventDefault();
        var validate = true;
        var url  = $('#url').val();
        var url1 = $('#url1').val();
        var url2 = $('#url2').val();
        var url3 = $('#url3').val();
        var url4 = $('#url4').val();
        var contest_name = $('#contest_name').val();
        var budget = $('#budget').val();
        var agency_fee = $('#agency_fee').val();
        var users_id = $('#users_id').val();
        var contest_id = $('#contest_id').val();

        if ( url == '' ) {
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        if (!isUrlValid(url)) {
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        /*if (!isUrlValid(url1) && url1 == '' ) {
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        if (!isUrlValid(url2) && url2 == '') {
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        if (!isUrlValid(url3) && url3 == '' ) {
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        if (!isUrlValid(url4) && url4 == '') {
            validate = false;
            $('.validate_msg').show();
            return false;
        }*/

        if (validate == true) {
            $.ajax({
                type: "POST",
                url: "config/server-response.php",
                data: {
                    url: url,
                    url1: url1,
                    url2: url2,
                    url3: url3,
                    url4: url4,
                    contest_name: contest_name,
                    budget: budget,
                    users_id: users_id,
                    contest_id: contest_id,
                    agency_fee: agency_fee,
                    type: "Claim"
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    $('.validate_msg').hide();
                    if (data.success) {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);
                        setTimeout(function(){
                            location.href = "q1.php";
                        }, 1500);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);
                    }
                }
            });
        }
    });


    // Claim Team Request
    $("#claimTeamRequest").submit( function ( e ) {
        e.preventDefault();
        var validate = true;
        var order_type = $( "input[type=radio][name=order_type]:checked" ).val();
        var contest_name = $('#contest_name').val();
        var budget = $('#budget').val();
        var agency_fee = $('#agency_fee').val();
        var users_id = $('#users_id').val();
        var contest_id = $('#contest_id').val();
        var isChecked = $('#rdSelect').is(':checked');

        if ( order_type == '' ) {
            //alert(order_type);
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        if (validate == true) {
            $.ajax({
                type: "POST",
                url: "config/server-response.php",
                data: {
                    order_type: order_type,
                    contest_name: contest_name,
                    budget: budget,
                    agency_fee: agency_fee,
                    users_id: users_id,
                    contest_id: contest_id,
                    type: "TeamClaim"
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    $('.validate_msg').hide();
                    if (data.success) {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);
                        setTimeout(function(){
                            location.href = "qt1.php";
                        }, 1000);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);

                    }
                }
            });
        }
    });


    // Change team to select reporting manage
    $('#team_id').change( function () {
        var team_id = $(this).val();
        $('#reporting_manager').html('');
        $('#reporting_manager').append('<option>--Select Reporting Manager--</option>');
       $.ajax({
            type: "POST",
           url: "config/server-response.php",
           dataType: "json",
           traditional: true,
           data: {
               team_id : team_id,
               type: "Team_List"
           },
           success(data){
                var manager_list = data.manager;
                for ($i = 0; $i < manager_list.length; $i++){
                    //console.log(manager_list[$i]['id'] + manager_list[$i]['first_name'] + manager_list[$i]['last_name']);
                    $('#reporting_manager').append("<option value="+manager_list[$i]['id']+">"+manager_list[$i]['first_name']+" "+manager_list[$i]['last_name']+" </option>");
                }
           }
       })

    });


    // Change team to select reporting manage
    $("#resetPassword").submit( function ( e ) {
        e.preventDefault();
        var validate = true;
        var email = $('#email').val();

        if ( email == '' ) {
            validate = false;
            $('.validate_msg').show();
            return false;
        }
        if( IsEmail( email ) == false ){
            validate = false;
            $('.validate_email').show();
            return false;
        }

        if (validate == true) {
            $.ajax({
                type: "POST",
                url: "config/server-response.php",
                data: {
                    email: email,
                    type: "ResetPassword"
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    $('.validate_msg').hide();
                    if (data.valid) {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);
                        setTimeout(function(){
                            location.href = "login.php";
                        }, 4000);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);

                    }
                }
            });
        }
    });


    // Refund
    $("#refundComment").submit( function ( e ) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "config/server-response.php",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.success) {
                    setTimeout(function(){
                        location.reload();
                    }, 300);
                } else {
                    //$('.response_msg').show();
                    //$('.response_msg').text(data.msg);
                    //setTimeout(function(){ location.reload(); }, 1000);
                }
            }
        });

    });


    // Replace
    $("#replaceComment").submit( function ( e ) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "config/server-response.php",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var data = JSON.parse(data);
                if (data.success) {
                    setTimeout(function(){
                        location.reload();
                    }, 300);
                } else {
                    //$('.response_msg').show();
                    //$('.response_msg').text(data.msg);
                    //setTimeout(function(){ location.reload(); }, 1000);
                }
            }
        });

    });

    $('#changeQuarter').change( function () {
        var hedge_id = $(this).val();
        $('#utilized').text('');
        $('#pending').text('');
        $('#amount').text('');
        $.ajax({
            type: "POST",
            url: "config/server-response.php",
            dataType: "json",
            traditional: true,
            data: {
                hedge_id : hedge_id,
                type: "ChangeQuarter"
            },
            success(data){
                $('#utilized').text(data.utility);
                $('#pending').text(data.balance);
                $('#amount').text(data.amount);
            }
        })

    });

   $('#changeQuarter2').change( function () {
        var hedge_id = $(this).val();
//		alert(hedge_id);
         $.ajax({
            type: "POST",
            url: "../config/server-response.php",
            dataType: "json",
            traditional: true,
            data: {
                hedge_id : hedge_id,
                type: "ChangeQuarter2"
            },
            success(data)
			{
//              alert(data);
				$('#po_data2').css('display','none');
				$('#po_data').css('display','block');
				$('#po_data').html('');
                $('#po_data').html(data);

            }
        })

    });



    //datatable rewards
    $('#myTable').DataTable({
        /*"ordering": false*/
    });


    //Date picker code
    var dateFormat = "dd-mm-yy",
        from = $( "#start_date" )
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'dd-mm-yy'
            })
            .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
            }),
        to = $( "#end_date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy'
        })
            .on( "change", function() {
                from.datepicker( "option", "maxDate", getDate( this ) );
            });


}); // script end here


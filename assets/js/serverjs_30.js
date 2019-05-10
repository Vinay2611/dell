
//function to validate email
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}


function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}


function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

function txtpercentage( val1 , val2) {
    val = (val1 / 100) * val2;
    return val;
}

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


    // Claim Club Request
    $("#claimclubRequest").submit( function ( e ) {
        e.preventDefault();
        $elm = $(".btn-submit");
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw submit-loading"></i>');
        var validate = true;

        var shipping_address  = $('#shipping_address').val();
        var city = $('#city').val();
        var pincode = $('#pincode').val();
        var user_type = $('#user_type').val();

        var product_1 = $('#product_1').val();
        var brand_1 = $('#brand_1').val();
        var size_1 = $('#size_1').val();
        var website_1 = $('#website_1').val();
        var url_1 = $('#url_1').val();
        var price_1 = $('#price_1').val();

        var product_2 = $('#product_2').val();
        var brand_2 = $('#brand_2').val();
        var size_2 = $('#size_2').val();
        var website_2 = $('#website_2').val();
        var url_2 = $('#url_2').val();
        var price_2 = $('#price_2').val();

        var product_3 = $('#product_3').val();
        var brand_3 = $('#brand_3').val();
        var size_3 = $('#size_3').val();
        var website_3 = $('#website_3').val();
        var url_3 = $('#url_3').val();
        var price_3 = $('#price_3').val();

        var product_4 = $('#product_4').val();
        var brand_4 = $('#brand_4').val();
        var size_4 = $('#size_4').val();
        var website_4 = $('#website_4').val();
        var url_4 = $('#url_4').val();
        var price_4 = $('#price_4').val();

        var product_5 = $('#product_5').val();
        var brand_5 = $('#brand_5').val();
        var size_5 = $('#size_5').val();
        var website_5 = $('#website_5').val();
        var url_5 = $('#url_5').val();
        var price_5 = $('#price_5').val();

        //Team value
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        var total_amount = $('#budget_allowed').val();
        var total_amount_claim = price_1 + price_2 + price_3 + price_4 + price_5;
        var team_amount = $('#amount').val();


        if (user_type != 'ISM') {
            if ( product_1 == '' || brand_1 == '' || website_1 == '' || url_1 == '' || price_1 == '' ) {
                bootbox.alert("Product 1, Brand 1, Website 1, Url 1 and price cannot be left blank!");
                var validate = false;
            }

            //calculate percentate
            var percentage = calculatePercentage( total_amount_claim, total_amount );

            if (percentage < 90){
                bootbox.alert("Total amount must be grater than 90 percentage!");
                var validate = false;
            }
            $(".submit-loading").remove();
            $elm.show();
        }else if (user_type == 'ISM') {

            if ( start_date == '' || end_date == '' || team_amount == ''  ) {
                bootbox.alert("Start date ,End date and price cannot be left blank!");
                var validate = false;
            }

            //calculate percentate
            var percentage = calculatePercentage( team_amount, total_amount );

            if (percentage < 90){
                bootbox.alert("Total amount must be grater than 90 percentage!");
                var validate = false;
            }
            $(".submit-loading").remove();
            $elm.show();
        }else{
            //Do nothing

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
                    $(".submit-loading").remove();
                    $elm.show();
                    $('.validate_msg').hide();
                    $('.validate_email').hide();
                    var data = JSON.parse(data);
                    if (data.success) {
                        /*$('.response_msg').show();
                        $('.response_msg').text("Your request is sent, you will receive email notification.");*/
                        bootbox.alert("Your request has been submitted.You will receive email notification shortly");
                        setTimeout(function(){
                            if (data.ism == 'ISM'){
                                location.href = "dashboard-team.php";
                            } else {
                                location.href = "dashboard.php";
                            }
                        }, 4000);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.msg);
                        //setTimeout(function(){ location.reload(); }, 1000);
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
                        }, 1500);
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

    $('#changeQuarter').change( function () 
	{
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

    function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
    }


    //Function to calculate percentage
    function calculatePercentage( partialValue, totalValue ) {
        return ( 100 * partialValue ) / totalValue;
    }
}); // script end here


/**
 * Created by Vinay Jaiswal.
 * User: Toyota
 * Date: 26-02-2019
 * Time: 12:04
 */


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


$( function () {


    //User registration
    $("#registration").submit( function ( e ) {
        e.preventDefault();
        var validate = true;
        var first_name = $('#first_name').val();
        var date_of_birth = $('#date_of_birth').val();
        var team_name = $('#team_name').val();
        var report_manager = $('#report_manager').val();
        var employee_id = $('#employee_id').val();
        var email = $('#email').val();
        //var user_name = $('#user_name').val();
        var password = $('#password').val();
        var reporting_manager = $('#reporting_manager').val();

        if ( first_name == '' || date_of_birth == '' || team_name == '' || report_manager == '' || employee_id == '' || email == '' || password == '' || reporting_manager == '' ) {
            validate = false;
            $('.validate_msg').show();
            //alert("All input fields is required");
            return false;
        }
        if( IsEmail( email ) == false ){
            validate = false;
            //alert('Invalid Email!');
            $('.validate_email').show();
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
                    $('.validate_msg').hide();
                    $('.validate_email').hide();
                    var data = JSON.parse(data);
                    if (data.success) {
                        $('.response_msg').show();
                        $('.response_msg').text(data.msg);
                        setTimeout(function(){
                            location.href = "login.php";
                        }, 1000);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.msg);
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
                            if (data.user_type == 'ISR'){
                                location.href = "q1.php";
                            } else {
                                location.href = "qt1.php";
                            }
                        }, 1000);
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
        var url = $('#url').val();
        var contest_name = $('#contest_name').val();
        var budget = $('#budget').val();
        var agency_fee = $('#agency_fee').val();

        if ( url == '' ) {
            validate = false;
            $('.validate_msg').show();
            return false;
        }

        if (validate == true) {
            $.ajax({
                type: "POST",
                url: "config/server-response.php",
                data: {
                    url: url,
                    contest_name: contest_name,
                    budget: budget,
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
                            location.href = "rewards.php";
                        }, 1000);
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
            alert(order_type);
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
                    if (data.success) {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);
                        setTimeout(function(){
                            location.href = "rewards.php";
                        }, 1000);
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.message);

                    }
                }
            });
        }
    });


    //datatable rewards
    $('#myTable').DataTable();


}); // script end here


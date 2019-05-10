/*
* Created By: Vinay Jaiswal
* Created Date: 02-05-2019
* Modified: 02-05-2019
*/

$( function () {

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

        if (typeof price_1 === 'undefined'){
            price_1 = 0;
        }else if (price_1 === ''){
            price_1 = 0;
        }

        if (typeof price_2 === 'undefined'){
            price_2 = 0;
        }else if (price_2 === ''){
            price_2 = 0;
        }

        if (typeof price_3 === 'undefined'){
            price_3 = 0;
        }else if (price_3 === ''){
            price_3 = 0;
        }

        if (typeof price_4 === 'undefined'){
            price_4 = 0;
        }else if (price_4 === ''){
            price_4 = 0;
        }

        if (typeof price_5 === 'undefined'){
            price_5 = 0;
        }else if (price_5 === ''){
            price_5 = 0;
        }

        //Team value
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        var total_amount = $('#budget_allowed').val();
        var total_amount_claim = parseFloat(price_1) + parseFloat(price_2) + parseFloat(price_3) + parseFloat(price_4) + parseFloat(price_5);
        var team_amount = $('#amount').val();

        console.log(total_amount_claim);

        if (user_type != 'ISM') {
            if ( product_1 == '' || brand_1 == '' || website_1 == '' || url_1 == '' || price_1 == '' ) {
                bootbox.alert("Product 1, Brand 1, Website 1, Url 1 and price cannot be left blank!");
                var validate = false;
            }

            if ( product_1 != '' && product_1 != undefined ){
                if (brand_1 == '' || website_1 == '' || url_1 == '' || price_1 == '') {
                    bootbox.alert("Brand 1, Website 1, Url 1 and price cannot be left blank!");
                    var validate = false;
                }
            }

            if ( product_2 != '' && product_2 != undefined ){
                if (brand_2 == '' || website_2 == '' || url_2 == '' || price_2 == '') {
                    bootbox.alert("Brand 2, Website 2, Url 2 and price cannot be left blank!");
                    var validate = false;
                }
            }

            if ( product_3 != '' && product_3 != undefined ){
                if (brand_3 == '' || website_3 == '' || url_3 == '' || price_3 == '') {
                    bootbox.alert("Brand 3, Website 3, Url 3 and price cannot be left blank!");
                    var validate = false;
                }
            }

            if ( product_4 != '' && product_4 != undefined ){
                if (brand_4 == '' || website_4 == '' || url_4 == '' || price_4 == '') {
                    bootbox.alert("Brand 4, Website 4, Url 4 and price cannot be left blank!");
                    var validate = false;
                }
            }

            if ( product_5 != '' && product_5 != undefined ){
                if (brand_5 == '' || website_5 == '' || url_5 == '' || price_5 == '') {
                    bootbox.alert("Brand 5, Website 5, Url 5 and price cannot be left blank!");
                    var validate = false;
                }
            }

            //calculate percentate
            var percentage = calculatePercentage( total_amount_claim, total_amount );

            console.log( "Total amount claim:"+ total_amount_claim +"Total amount"+ total_amount +"Percentage" +percentage );

            if ( percentage < 90 ){
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
                url: "config/claim.php",
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
                        bootbox.alert({
                            message: "Your request has been submitted.You will receive email notification shortly",
                            callback: function(){
                                setTimeout(function(){
                                    if (data.ism == 'ISM'){
                                        location.href = "dashboard-team.php";
                                    } else {
                                        location.href = "dashboard.php";
                                    }
                                }, 300);
                            }
                        });
                    } else {
                        $('.response_msg').show();
                        $('.response_msg').text(data.msg);
                        //setTimeout(function(){ location.reload(); }, 1000);
                    }
                }
            });
        }//Validation is true

    });//Submit function called

});//Document load
<?php include "config/db.php"; ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dellemc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAADQoDoAwahSAOr4/wDr+/8A49KPAOO9UQCvehIA5rtUAP7/3gD0//kA4bpsAPP+/wD4+P8A+//wAP31/wD/9vkA//X/AP3/+QDbqkYA//j/AP/6/AD9/v8A//v/ANGmZwD//v8ArIsqAP/yuADgwYoA4MeBAMq5agD/4tkA//HHAP/5xAD12bYA//fiAMStYgD//uUAsH0cAOzOnwDUkBUA///xAP/99ADmuXwA/+y5AM2vaACedBQA+v+zAPjq1wDlxXwA5sV8ANzFlwDkxY4A4//7AP/00QD/9tcA//vUAK55EQDuxY4ArXsXAMukWgC1fAgAz6pIAP/hqwD//+AA/c5zAPv/8gD99P4A+P/7AP//8gD7//sA26pIAP//+wDcpVQAybhpAMOYSQDhwYwA/+/MAMGpTwDPnEwApn4YAJ6CJACshAYA9fnzAP7y8AD2/fYA9vr/APT//AD3+v8A+Pr/APb9/wD1q10A///qAPr++QD4//wA+/r/APr9/wD/+/kA//f/AMrNlgD/+v8A6N2hAP/jxACvmAwA//3/AMC1fADGoS8A2MqWAK2SMADRlUEA6KdSAKR5HAD//8cAyqNZAOzPigDwzY0A7M+cANSYbgD///QA8uCHAN6tQQCsjCgA/+7LAOfQhQD0+u8A//jgAP/65gD5/fgA+P/+AP/89QD///UA//77AP///gDHoTEAxJ9PAOj2/wDw9fMA1MBpAOz8/wDQnkwAuZk1APb5/wC5mDsA///kAPP//wD4+f8A9v//AP32/wD/9v8A//7zAP7/9gC6gA8A//n/AP/8/wDmuH4A5L5+AP///wDkv4EA3r2WAM2eMgChfw0A3I8yAP/31gD/7eUA1ppBAN22ZwDRrDgA7//3AP/83AD2/PcA4LV2AP//5QCrgh8Aro4NAP3/9wD+//cA///3ANymUwDBhwoA//HOAOPQfwCShSkA6cSIAMOAKwDu9/sA7//4APr/+AD6/fsA/9+9AP3/+ADfqjwAza5jAP//+AC9hQ4A6t+jAMiyeADIozEA2MmYALiFKQDjxYwA4rZFAO7u/ACteAMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADnWufiS1O4WFcJxbUpUokq+oY0tuHWRMecFJLTMWVIERlwHDNRMTgoKTk7KlTWOtuRuEFAO4kVVVkaaJYGnGezerNoa6KLwVFbwoXAKhTx+IwhQ0EQybjw+iXlgLyKRooC9yMbtCcQS/nRx2MDkao1GqvSOsd8A9ADwsB8WaCLE6KW0+nsladMeWHkBsdaolJyCLnwpvjXoutCuzSr+ntr4yFodTE0e3YZiMWXV1YgVlUJcJDZuDg4ODGEFWl2shGE4XQ4+DGBgYGBiPXamKg399ZioQGF9XV18YEJlmfX8YkHxIGcQ/jo4/aniwIgyYRBhFgCZGOAYGOBJzlEVngQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/dellemc.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css?v=0">
    <link href="assets/css/nav-sections.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/js/datepicker/jquery-ui.css">


    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.mycart.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/serverjs.js"></script>
    <script src="assets/js/cycle/jquery.cycle2.min.js"></script>
    <script src="assets/js/datepicker/jquery-ui.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
</head>

<body>

<div class="page-wrapper">
    <div class="header-min">
        <div class="container">
            <div class="row">
                <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs"><a href="index.php"><img src="assets/images/DellEMC.png" class="img-fluid"></a></div>
                <!--                <div class="logo col-md-4 col-sm-4 col-4 text-center text-center-xs"><a href="javascript:void(0);"><img src="images/intel.png" class="img-fluid"></a></div>
                                <div class="logo col-md-4 col-sm-4 col-4 text-right text-center-xs"><a href="javascript:void(0);"><img src="images/micro-soft.png" class="img-fluid"></a></div>
                -->
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="user-entry text-center">
                    <div class="text-center usericon">
                        <i class="fa fa-pencil-square-o fa-4x" aria-hidden="true"></i>
                    </div>
                    <h3>Don't have an account?</h3>
                    <div class="regi text-center">
                        <a href="registration.php"  class="btn btn-default">Sign Up</a>
                    </div>

                </div>

            </div>
            <div class="col-md-6">
                <div class="user-entry log">
                    <div class="text-center usericon">
                        <i class="fa fa-user-circle-o fa-4x" aria-hidden="true" ></i>
                    </div>

                    <form role="form " id="login">
                        <div class="form-group user-form">
                            <label for="email"><i class="fa fa-user fa-2x" aria-hidden="true"></i></label>
                            <input type="email" name="email" class="form-control" id="email">
                            <span class="validate_msg">All input fields is required</span>
                            <span class="validate_email">Email address is not valid</span>
                        </div>

                        <div class="form-group user-form">
                            <label for="password"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></label>
                            <input type="password" name="password" class="form-control" id="password">
                            <span class="validate_msg">All input fields is required</span>
                            <span class="response_msg"></span>
                        </div>
                        <p id="show_msg" style="color: white;display: none">Show message</p>
                        <div class="form-group user-form">
                            <a href="forgot_password.php">Forgot Password</a>
                        </div>
                        <div class="fomr-group text-center">
                            <input type="hidden" name="type" value="Login">
                            <button type="submit" class="btn btn-default">Login</button>
                        </div>
                        <div class="form-group text-center">
                            <p>Don't have access yet? <a href="registration.php">Request Access</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="new-registration-wrapper col-md-12 footer-line text-center">
                <p>If you are facing issues, please send an email too <a href="mailto:<?php echo email; ?>"><?php echo email; ?></a></p>
            </div>
        </div>
    </div>
</div>


<script>
    //Add to cart function start from here in all pages

    $( function () {

        //Clear all storage before add to cart
        console.log(localStorage.products);
        window.localStorage.clear();

        var goToCartIcon = function($addTocartBtn){
            var $cartIcon = $(".my-cart-icon");
            var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
            //$addTocartBtn.prepend($image);
            var position = $cartIcon.position();
            $image.animate({
                top: position.top,
                left: position.left
            }, 500 , "linear", function() {
                $image.remove();
            });
        };

        var c_type = '';

        $('.my-cart-btn').myCart({
            classCartIcon: 'my-cart-icon',
            classCartBadge: 'my-cart-badge',
            classProductRemove: 'my-product-remove',
            affixCartIcon: true,
            checkoutCart: function (products) {
                $.each(products, function () {
                    console.log(this);
                });
            },
            clickOnAddToCart: function ($addTocart) {

                /*var contest_type = $addTocart.data("summary");
                if ( contest_type != c_type && c_type != '' ) {
                    alert("Different type cannot be added.Please remove from order.");
                    return false;
                }else {
                    c_type = contest_type;
                    //goToCartIcon($addTocart);
                }*/
                $addTocart.hide();
            },
            afterAddOnCart: function(products, totalPrice, totalQuantity) {
                console.log("afterAddOnCart", products, totalPrice, totalQuantity);
            },
            getDiscountPrice: function (products) {
                var total = 0;
                $.each(products, function () {
                    total += this.quantity * this.price;
                });
                return total;
                //return total * 0.5;
            }
        });

        //Show message or validation of different contest-type cannot be added
        $( document ).on( "click", '.validate-cart', function() {
            alert("Different contest-type cannot be added.");
        });

        //One time function start here
        $(document).on( 'click', '.one-click', function () {
            var contest_tp = $(this).attr( "data-summary" );
            var bgClass = $(this).data( "id" );
            if ( contest_tp == 'ISG' ) {

                $("#myTable tr.item").each(function( key, val ) {

                    var $tds = $(this).find('td');
                    var ct_type = $tds.find('a').attr("data-summary");
                    if ( ct_type == 'CSG'){
                        var productId = $tds.find('a').removeClass("my-cart-btn").addClass( "validate-cart" );
                    }
                    var remove_oneclick = $tds.find('a').removeClass("one-click");
                });

            }else {

                $("#myTable tr.item").each(function( key, val ) {

                    var $tds = $(this).find('td');
                    var ct_type = $tds.find('a').attr("data-summary");
                    if ( ct_type == 'ISG'){
                        var productId = $tds.find('a').removeClass("my-cart-btn").addClass( "validate-cart" );
                    }
                    var remove_oneclick = $tds.find('a').removeClass("one-click");
                });

            }


        }); //One time function end here

    }); //Document is ready js code is end here
</script>
</body>
</html>

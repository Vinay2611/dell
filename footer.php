
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
                var contest_type = $addTocart.data("summary");
                /*var contest_type = $addTocart.data("summary");
                if ( contest_type != c_type && c_type != '' ) {
                    alert("Different type cannot be added.Please remove from order.");
                    return false;
                }else {
                    c_type = contest_type;
                    //goToCartIcon($addTocart);
                }*/

                /*if (contest_type == 'CSG') {
                    alert("Different type cannot be added.Please remove from order.");
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
            //alert("CSG CSG and CSG ISG  cannot be clubbed.");
            bootbox.alert("CSG CSG and CSG ISG  cannot be clubbed.");
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
                    //if ( ct_type == 'ISG'){
                        var productId = $tds.find('a').removeClass("my-cart-btn").addClass( "validate-cart" );
                    //}
                    var remove_oneclick = $tds.find('a').removeClass("one-click");
                });

            }


        }); //One time function end here

    }); //Document is ready js code is end here
</script>
</body>
</html>

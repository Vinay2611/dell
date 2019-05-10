<?php

include 'header.php';

//Quarter
$today_date = date('Y-m-d');

?>

<div class="page-wrapper">
    <div class="header-min">
        <div class="container">
            <div class="row">
                <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs">
                    <a href="index.php"><img src="assets/images/DellEMC.png" class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="rewards-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <!--col-md-offset-3-->
                <div class="menublog row">

                    <?php include('user-menu-team.php'); ?>

                </div>

                <div class="breadcrums-block">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="is-active">Team Reward Claim</li>
                    </ul>
                </div>

            </div>


            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 float-sm-left">
                <div class="table-grid">
                    <table id="myTable" class="display">
                        <thead>
                        <tr>
                            <th class="th-sm sorting center">Sr</th>
                            <th class="th-sm sorting">Team</th>
                            <th class="th-sm sorting">Quarter</th>
                            <th class="th-sm sorting">Contest</th>
                            <th class="th-sm sorting">Contest-type</th>
                            <th class="th-sm sorting ">Reward Amount</th>
                            <th class="th-sm sorting ">Start Date</th>
                            <th class="th-sm sorting ">End Date</th>
                            <th class="th-sm sorting ">Status</th>
                            <th class="th-sm sorting ">Reward Status</th>
                            <th class="th-sm sorting ">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,w.reward_amount,w.reward_status,w.users_id,w.reward_status,w.team_id,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date,hr.quarter FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner AS w ON c.contest_id = w.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND system_status = 'Active' AND w.team_id = '$team_id' AND w.users_id = '$users_id' GROUP BY c.contest_id";
                        //$sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wtsr.reward_amt,wtsr.reward_status,wtsr.users_id,wtsr.team_id,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date,hr.quarter FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_tsr AS wtsr ON c.contest_id = wtsr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND system_status = 'Active' AND wtsr.team_id = '$team_id'  GROUP BY c.contest_id";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()) {

                            $inrPrice =  $row['budget'] * $row['hedge_rate'];

                            //Team Name
                            $team = "SELECT * FROM `team` WHERE `team_id` = '".$row['team_id']."'";
                            $team_q = $db->query( $team);
                            $team_e = $team_q->fetch_assoc();

                            ?>
                            <tr class="item">
                                <td  ><?php echo $i; ?></td>
                                <td ><?php echo $team_e['team_name']; ?></td>
                                <td ><?php echo $row['quarter']; ?></td>
                                <td ><?php echo $row['contest_name']; ?></td>
                                <td  ><?php echo $row['contest_type']; ?></td>
                                <td ><?php echo $row['reward_amount']; ?></td>
                                <td ><?php echo $row['start_date']; ?></td>
                                <td  ><?php echo $row['end_date']; ?></td>
                                <td ><?php echo $row['status']; ?></td>
                                <td ><?php echo $row['reward_status']; ?></td>
                                <td >
                                    <?php

                                    //Check user is already claime
                                    //$sql1 = "SELECT order_id,o.contest_id,users_id,o.order_status FROM `team_request` AS tr JOIN contest AS c ON o.contest_id = c.contest_id WHERE o.`users_id` = '$users_id' AND o.`contest_id` = ' " . $row['contest_id'] . "'";
                                    $sql1 = "SELECT * FROM `winner` WHERE `users_id` = '" . $users_id . "' AND `contest_id` = '" . $row['contest_id'] . "'";
                                    $que1 = $db->query($sql1);
                                    if ($row['reward_status'] == 'Pending' || $row['reward_status'] == 'Partially Claimed'){
                                     ?>
                                        <a href="javascript:void(0);" class="my-cart-btn one-click" data-id='<?php echo $row['contest_id']; ?>' data-name="<?php echo $row['contest_name']; ?>" data-summary="<?php echo $row['contest_type']; ?>" data-price="<?php echo $row['reward_amount']; ?>" data-quantity="1" data-image="" data-type="<?php echo $row['contest_type']; ?>">Claim</a>
                                    <?php } else {
                                        //echo $row['reward_status'];
                                        ?>
                                    <?php }
                                    //}
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="new-registration-wrapper col-md-12 footer-line text-center">
            <p>If you are facing issues, please send an email too <a href="mailto:<?php echo email; ?>"><?php echo email; ?></a></p>
        </div>
    </div>
</div>


<script>
    $(document).ready(function($) {
        $(window).on('resize', function() {
            if ($(window).width() <= 991) {
                $('.nav-toggle').click(function() {
                    if ($(this).hasClass('nav-open')) {
                        $(this).removeClass("nav-open");
                        //$('.nav-sections').removeClass('nav-open');
                        $('html').removeClass('nav-open');

                    } else {
                        $(this).addClass("nav-open");
                        //$('.nav-sections').addClass('nav-open');
                        $('html').addClass('nav-open');

                    }
                });
            }
        }).trigger("resize");

        $('.menu-icon').click(function(event) {
            if ($(this).hasClass('active')) {
                $('.menu-icon').next('.submenu').hide();
                $('.menu-icon').removeClass('active');
            } else {
                $('.menu-icon').next('.submenu').hide();
                $('.menu-icon').removeClass('active');
                $(this).next('.submenu').show();
                $(this).addClass('active');
            }
            return false;

        });

    });
</script>





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




    }); //Document is ready js code is end here
</script>
</body>
</html>

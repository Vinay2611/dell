<?php

include 'header.php';

//Quarter
$today_date = date('Y-m-d h:m:i');

//Calculate order status for users (Pending, In-process, Completed, Rejected)
$sql_0 = "SELECT count(order_id) as pending FROM `orders` WHERE `users_id` = '$users_id' AND `order_status` = 'Pending'";
$que_0 = $db->query( $sql_0 );
$ext_0 = $que_0->fetch_assoc();
$num_0 = $ext_0['pending'];

$sql_1 = "SELECT count(order_id) as inprocess FROM `orders` WHERE `users_id` = '$users_id' AND `order_status` = 'Partly complete'";
$que_1 = $db->query( $sql_1 );
$ext_1 = $que_1->fetch_assoc();
$num_1 = $ext_1['inprocess'];

$sql_2 = "SELECT count(order_id) as completed FROM `orders` WHERE `users_id` = '$users_id' AND `order_status` = 'Completed'";
$que_2 = $db->query( $sql_2 );
$ext_2 = $que_2->fetch_assoc();
$num_2 = $ext_2['completed'];

$sql_3 = "SELECT count(order_id) as rejected FROM `orders` WHERE `users_id` = '$users_id' AND `order_status` = 'Rejected'";
$que_3 = $db->query( $sql_3 );
$ext_3 = $que_3->fetch_assoc();
$num_3 = $ext_3['rejected'];

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
                    <?php include('user-menu.php'); ?>
                </div>

                <div class="breadcrums-block">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="is-active">Dashboard</li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php include('left-col.php'); ?>

            <div class="col-md-3">
                <div class="contest-block curve">
                    <div class="contest-blog">
                        <div class="contest-head">
                            <h5>Order Status</h5>
                        </div>
                        <div class="contest-list">
                            <ul>
                                <li>Pending <span class="text-right"><?php echo $num_0 ;?></span></li>
                                <li>In-progress <?php echo $num_1 ;?></li>
                                <li>Completed <?php echo $num_2 ;?></li>
                                <li>Rejected <?php echo $num_3 ;?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-3">
                <div class="contest-block ">
                    <div class="contest-blog">
                        <div class="contest-head">
                            <h5>Order Status</h5>
                        </div>
                        <div class="contest-list">
                            <ul>
                                <li>Pending 1</li>
                                <li>In-progress 2</li>
                                <li>Completed 2</li>
                                <li>Rejected 0</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="contest-block curve">
                    <div class="contest-blog">
                        <div class="contest-head">
                            <h5>Order Status</h5>
                        </div>
                        <div class="contest-list">
                            <ul>
                                <li>Pending 1</li>
                                <li>In-progress 2</li>
                                <li>Completed 2</li>
                                <li>Rejected 0</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>-->


        </div>
        <div class="footer col-md-12">
            <p>If you are facing issues, please send an email too <a href="mailto:ISIP@shobizexperience.com">ISIP@shobizexperience.com</a></p>
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


<?php

include 'footer.php';

?>

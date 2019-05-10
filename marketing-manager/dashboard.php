<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 14-03-2019
 * Time: 12:10
 */

include 'header.php';

//Quarter
$today_date = date('Y-m-d h:m:i');

//Calculate order status for users (Pending, In-process, Completed, Rejected)
$sql_0 = "SELECT count(id) as pending FROM `order` WHERE users_id = '$users_id' AND status = 'Pending'";
$que_0 = $db->query( $sql_0 );
$ext_0 = $que_0->fetch_assoc();
$num_0 = $ext_0['pending'];

$sql_1 = "SELECT count(id) as inprocess FROM `order` WHERE users_id = '$users_id' AND status = 'In-progress'";
$que_1 = $db->query( $sql_1 );
$ext_1 = $que_1->fetch_assoc();
$num_1 = $ext_1['inprocess'];

$sql_2 = "SELECT count(id) as completed FROM `order` WHERE users_id = '$users_id' AND status = 'Completed'";
$que_2 = $db->query( $sql_2 );
$ext_2 = $que_2->fetch_assoc();
$num_2 = $ext_2['completed'];

$sql_3 = "SELECT count(id) as rejected FROM `order` WHERE users_id = '$users_id' AND status = 'Rejected'";
$que_3 = $db->query( $sql_3 );
$ext_3 = $que_3->fetch_assoc();
$num_3 = $ext_3['rejected'];

?>

<div class="page-wrapper">
    <div class="header-min">
        <div class="container">
            <div class="row">
                <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs">
                    <a href="index.php"><img src="../assets/images/DellEMC.png" class="img-responsive"></a>
                </div>
                <!--<div class="logo col-md-4 col-sm-4 col-4 text-center text-center-xs">
                    <a href="javascript:void(0);"><img src="images/intel.png" class="img-fluid"></a>
                </div>
                <div class="logo col-md-4 col-sm-4 col-4 text-right text-center-xs">
                    <a href="javascript:void(0);"><img src="images/micro-soft.png" class="img-fluid"></a>
                </div>-->

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
                    <!-- <div class="menu-list col-md-3">
                       <form>
                            <label class="radio">Individual reward
                                <input type="radio" class="check" checked="checked" name="is_company">
                                <span class="checkround"></span>
                            </label>
                            <label class="radio">Team reward
                                <input type="radio" name="is_company">
                                <span class="checkround"></span>
                            </label>
                        </form>
                    </div>-->
                <?php include('user-menu.php'); ?>

                </div>

                <div class="breadcrums-block">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <?php
                        //if ()
                        ?>
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
                                <li>Pending <?php echo $num_0 ;?></li>
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

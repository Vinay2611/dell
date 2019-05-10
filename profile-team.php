<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 14-03-2019
 * Time: 12:53
 */

include 'header.php';

$sql = "SELECT * FROM `users` WHERE `users_id` = '$users_id'";
$que = $db->query( $sql );
$row = $que->fetch_assoc();

//Team Name
$team = "SELECT * FROM `team` WHERE `team_id` = '".$row['team_id']."'";
$team_q = $db->query( $team);
$team_e = $team_q->fetch_assoc();

//Reporting manager
$manager = "SELECT * FROM `users` WHERE `users_id` = '".$row['reporting_manager']."'";
$manager_q = $db->query($manager);
$manager_e = $manager_q->fetch_assoc();

?>
    <style>
        .new-registration-wrapper form {
            background: rgba(0,0,0,0.2) !important;
        }
    </style>

    <div class="page-wrapper">
        <div class="header-min">
            <div class="container">
                <div class="row">
                    <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs">
                        <a href="index.php"><img src="assets/images/DellEMC.png" class="img-responsive"></a>
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
                        <?php include('user-menu-team.php'); ?>

                    </div>

                    <div class="breadcrums-block">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <?php
                            //if ()
                            ?>
                            <li class="is-active">Profile</li>
                        </ul>
                    </div>
                </div>


                <div class="clearfix"></div>
                <!--<div class="col-md-3"></div>-->
                <div class="col-md-9 col-sm-12 float-sm-left">
                    <div class="table-grid">
                        <div class="new-registration-wrapper" style="margin-top: 0px">

                            <!--<h1>New Register</h1>-->

                            <form id="claimRequest" class="no-opacity row-divide">
                                <div class="form-group row">
                                    <label for="contest_name" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?></label>
                                        <!--<input type="text" class="form-control" name="contest_name" value="<?php /*echo isset($row['contest_name']) ? $row['contest_name'] : ''; */?>" id="contest_name" placeholder="Contest Name" disabled>-->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contest_type" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['last_name']) ? $row['last_name'] : ''; ?></label>
                                        <!--<input type="text" class="form-control" name="contest_type" value="<?php /*echo isset($row['contest_type']) ? $row['contest_type'] : ''; */?>" id="contest_type" placeholder="Contest Type" disabled>-->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="budget" class="col-sm-3 col-form-label">Employee ID</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['employee_id']) ? $row['employee_id'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['email']) ? $row['email'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Team Name</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($team_e['team_name']) ? $team_e['team_name'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Reporting Manager</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($manager_e['first_name']) ? $manager_e['first_name'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">User Type</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['user_type']) ? $row['user_type'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['status']) ? $row['status'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Team List</label>
                                    <div class="col-sm-9">
                                        <ol type="1" style="font-weight: bolder">
                                        <?php
                                        //Team list
                                        $team_l = "SELECT * FROM `users` WHERE `team_id` = '".$row['team_id']."' AND `status` = 'Active'";
                                        $team_lq = $db->query( $team_l );
                                        while ($team_le = $team_lq->fetch_assoc()){
                                        ?>
                                            <li><?php echo isset($team_le['first_name']) ? $team_le['first_name']." ".$team_le['last_name'] : ''; ?></li>
                                        <!--<label  class=" col-form-label"><?php /*echo isset($team_le['first_name']) ? $team_le['first_name']." ".$team_le['last_name'] : ''; */?></label><br>-->

                                        <?php } ?>
                                        </ol>
                                    </div>
                                </div>

                            </form>
                        </div>
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


<?php

include "footer.php";

?>
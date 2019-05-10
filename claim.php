<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 14-03-2019
 * Time: 12:53
 */

include 'header.php';

$sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wisr.reward_amt,hr.hedge_rate FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_isr AS wisr ON c.contest_id = wisr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.contest_id = '$_GET[cid]' GROUP BY c.contest_id";
$que = $db->query( $sql );
$row = $que->fetch_assoc();



?>


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
                        <?php include('user-menu.php'); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <!--<div class="col-md-3"></div>-->
                <div class="col-md-9 col-sm-12 float-sm-left">
                    <div class="table-grid">
                        <div class="new-registration-wrapper">

                            <!--<h1>New Register</h1>-->

                            <form id="claimRequest">
                                <div class="form-group row">
                                    <label for="contest_name" class="col-sm-3 col-form-label">Contest Name</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['contest_name']) ? $row['contest_name'] : ''; ?></label>
                                        <!--<input type="text" class="form-control" name="contest_name" value="<?php /*echo isset($row['contest_name']) ? $row['contest_name'] : ''; */?>" id="contest_name" placeholder="Contest Name" disabled>-->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contest_type" class="col-sm-3 col-form-label">Contest Type</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php echo isset($row['contest_type']) ? $row['contest_type'] : ''; ?></label>
                                        <!--<input type="text" class="form-control" name="contest_type" value="<?php /*echo isset($row['contest_type']) ? $row['contest_type'] : ''; */?>" id="contest_type" placeholder="Contest Type" disabled>-->
                                    </div>
                                </div>
                                <!--<div class="form-group row">
                                    <label for="budget" class="col-sm-3 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php //echo isset($row['budget']) ? $row['budget'] : ''; ?></label>
                                        <input type="text" class="form-control" name="budget" value="<?php /*echo isset($row['budget']) ? $row['budget'] : ''; */?>" id="budget" placeholder="Price" disabled>
                                    </div>
                                </div>-->

                                <!--<div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Claim Value</label>
                                    <div class="col-sm-9">
                                        <label  class=" col-form-label"><?php //echo isset($row['agency_fee']) ? $row['agency_fee'] : ''; ?></label>
                                        <input type="text" class="form-control" name="agency_fee" value="<?php /*echo isset($row['agency_fee']) ? $row['agency_fee'] : ''; */?>" id="agency_fee" placeholder="Claim Value" disabled>
                                    </div>
                                </div>-->

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Website URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" class="form-control" name="url" id="url" placeholder="Website URL">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                    <br><br>

                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="url" class="form-control" name="url1" id="url1" placeholder="Website URL">
                                    </div>
                                    <br><br>

                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="url" class="form-control" name="url2" id="url2" placeholder="Website URL">
                                    </div>
                                    <br><br>

                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="url" class="form-control" name="url3" id="url3" placeholder="Website URL">
                                    </div>
                                    <br><br>

                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="url" class="form-control" name="url4" id="url4" placeholder="Website URL">
                                    </div>
                                    <br><br>

                                </div>
                                <span class="response_msg"></span>
                                <div class="form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="users_id" value="<?php echo isset( $users_id ) ? $users_id : '';?>" id="users_id">
                                        <input type="hidden" name="contest_id" value="<?php echo isset( $row['contest_id'] ) ? $row['contest_id'] : '';?>" id="contest_id">
                                        <input type="hidden" name="budget" value="<?php echo isset( $row['budget'] ) ? $row['budget'] : '';?>" id="budget">
                                        <input type="hidden" name="type" value="Claim">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="footer">
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

include "footer.php";

?>
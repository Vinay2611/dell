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
                <div class="breadcrums-block">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <?php
                        //if ()
                        ?>
                        <li class="is-active">Q2</li>
                    </ul>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 float-sm-left">
                <div class="table-grid">
                    <table id="myTable" class="display">
                        <thead>
                        <tr>
                            <th class="th-sm sorting center">Sr</th><!-- width="5%"-->
                            <th class="th-sm sorting">Contest</th><!-- width="11%"-->
                            <th class="th-sm sorting">Contest-type</th><!-- width="13%"-->
                            <th class="th-sm sorting right">Reward Amount</th><!-- width="10%"-->
                            <th class="th-sm sorting right">Start Date</th><!-- width="12%"-->
                            <th class="th-sm sorting right">End Date</th><!-- width="9%"-->
                            <th class="th-sm sorting left">Status</th><!-- width="15%"-->
                            <th class="th-sm sorting">Reward Status</th>
                            <!--<th width="13%" class="th-sm sorting right">Hedge-Rate</th>
                            <th width="13%" class="th-sm sorting right">INR.Coversion</th>-->
                            <th  class="th-sm sorting left">Action</th><!-- width="13%"-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $query_date = $db->query( "SELECT from_date,to_date FROM `hedge_rate` WHERE quarter='q2' " );
                        $ext_date = $query_date->fetch_assoc();
                        $from_date = $ext_date['from_date'];
                        $to_date = $ext_date['to_date'];

                        $sql = "SELECT c.contest_id,c.po_id,c.contest_type,c.contest_name,c.contest_for,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wisr.reward_amt,wisr.reward_status,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_isr AS wisr ON c.contest_id = wisr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND  system_status = 'Active' AND wisr.users_id = '$users_id' AND  c.start_date >= '$from_date' AND c.end_date <= '$to_date' GROUP BY c.contest_id";
                        //$sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wisr.reward_amt,hr.hedge_rate FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_isr AS wisr ON c.contest_id = wisr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND  system_status = 'Active' AND wisr.users_id = '$users_id' AND hr.quarter='q1' AND year(hr.from_date) = '$today_date' GROUP BY c.contest_id";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()) {

                            $inrPrice =  $row['budget'] * $row['hedge_rate'];
                            ?>
                            <tr class="item">
                                <td class=""><?php echo $i; ?></td>
                                <td class=""><?php echo $row['contest_name']; ?></td>
                                <td class=""><?php echo $row['contest_type']; ?></td>
                                <td class=""><?php echo $row['reward_amt']; ?></td>
                                <td class=""><?php echo $row['start_date']; ?></td>
                                <td class=""><?php echo $row['end_date']; ?></td>
                                <td class=""><?php echo $row['status']; ?></td>
                                <td class=""><?php echo $row['reward_status']; ?></td>
                                <!--<td class="right"><?php /*echo $row['hedge_rate']; */?></td>
                                <td class="right"><?php /*echo $inrPrice; */?></td>-->
                                <td class="">
                                    <?php
                                    //Check user is already claimed
                                    $sql1 = "SELECT id,o.contest_id,price,users_id,url,o.status FROM `order` AS o JOIN contest AS c ON o.contest_id = c.contest_id WHERE o.`users_id` = '".$users_id."' AND o.`contest_id` = '".$row['contest_id']."'";
                                    //$sql1 = "SELECT * FROM `order` WHERE `users_id` = '".$users_id."'";
                                    $que1 = $db->query( $sql1 );
                                    if ($que1->num_rows > 0){  ?>
                                    <?php }else{ ?>
                                        <!--<a href="claim.php?cid=<?php /*echo $row['contest_id']; */?>">Claim</a>-->
                                        <a href="javascript:void(0);" class="my-cart-btn one-click" data-id='<?php echo $row['contest_id']; ?>' data-name="<?php echo $row['contest_name']; ?>" data-summary="<?php echo $row['contest_type']; ?>" data-price="<?php echo $row['reward_amt']; ?>" data-quantity="1" data-image="" data-type="<?php echo $row['contest_type']; ?>">Claim</a>
                                        <!--<button class="btn btn-danger my-cart-btn" data-id='<?php /*echo $i; */?>' data-name="product <?php /*echo $i; */?>" data-summary="summary <?php /*echo $i; */?>" data-price="<?php /*echo $i; */?>0" data-quantity="<?php /*echo $i; */?>" data-image="assets/images/intel.png">Add to Cart</button>-->
                                    <?php } ?>
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

include 'footer.php';

?>

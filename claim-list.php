<?php

include 'header.php';

//Quarter
$year = date('Y');

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
                        <li class="is-active">Claim</li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 float-sm-left">
                <div class="table-grid">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th  class="th-sm sorting center">Sr</th>
                                <th  class="th-sm sorting">Quarter</th>
                                <th  class="th-sm sorting">Contest</th>
                                <th  class="th-sm sorting">Type</th>
                                <th  class="th-sm sorting">Reward Amt. ($)</th>
                                <th  class="th-sm sorting">Reward Amt. (&#2352;)</th>
                                <th  class="th-sm sorting">Balance (&#2352;)</th>
                                <th  class="th-sm sorting">Start Date</th>
                                <th  class="th-sm sorting">End Date</th>
                                <th  class="th-sm sorting">Status</th>
                                <th  class="th-sm sorting">Reward Status</th>
                                <th  class="th-sm sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;

                        $query_date = $db->query( "SELECT from_date,to_date FROM `hedge_rate`" );
                        $ext_date = $query_date->fetch_assoc();
                        $from_date = $ext_date['from_date'];
                        $to_date = $ext_date['to_date'];

                        $sql = "SELECT c.contest_id,c.po_id,c.contest_type,c.contest_name,c.contest_for,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,w.reward_amount,w.reward_status,w.balance_amount as bal_amount,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner AS w ON c.contest_id = w.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND system_status = 'Active' AND w.users_id = '$users_id' GROUP BY c.contest_id ORDER BY hr.hedge_id DESC";
                        //$sql = "SELECT c.contest_id,c.po_id,c.contest_type,c.contest_name,c.contest_for,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wisr.reward_amt,wisr.reward_status,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_isr AS wisr ON c.contest_id = wisr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND  system_status = 'Active' AND wisr.users_id = '$users_id' AND  c.start_date >= '$from_date' AND c.end_date <= '$to_date' GROUP BY c.contest_id";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()) {
                            $inrPrice =  $row['budget'] * $row['hedge_rate'];
                            $inDollar =  $row['reward_amount'] / $row['hedge_rate'];
                            ?>
                            <tr class="item">
                                <td class="center"><?php echo $i; ?></td>
                                <td class=""><?php echo $row['quarter']; ?></td>
                                <td class=""><?php echo $row['contest_name']; ?></td>
                                <td class=""><?php echo $row['contest_type']; ?></td>
                                <td class=""><?php echo truncate_number($inDollar,2); ?></td>
                                <td class=""><?php echo $row['reward_amount']; ?></td>
                                <td class=""><?php echo $row['bal_amount']; ?></td>
                                <td class=""><?php echo date("d-M-Y", strtotime($row['start_date'])); ?></td>
                                <td class=""><?php echo date("d-M-Y", strtotime($row['end_date'])); ?></td>
                                <td class=""><?php echo $row['status']; ?></td>
                                <td class=""><?php echo $row['reward_status']; ?></td>
                                <td class="<?php echo $row['contest_type']; ?>">
                                    <?php
                                    //Check user is already claimed
                                     $sql1 = "SELECT o.order_id,o.contest_id,o.users_id,o.order_status FROM orders AS o JOIN order_details AS od ON o.order_id = od.order_id WHERE o.`users_id` = '".$users_id."' AND o.`contest_id` like '%".$row['contest_id']."%'";
                                    //echo $sql1 = "SELECT o.order_id,o.contest_id,users_id,o.order_status FROM `orders` AS o JOIN contest AS c ON o.contest_id = c.contest_id WHERE o.`users_id` = '".$users_id."' AND o.`contest_id` = '".$row['contest_id']."'";
                                    //$sql1 = "SELECT * FROM `order` WHERE `users_id` = '".$users_id."'"; SELECT sum(reward_amount) as maxAmount,winner_id FROM `winner` WHERE users_id='" . $users_id . "'
                                    $que1 = $db->query( $sql1 );
                                    if ($que1->num_rows > 0){
                                        $ext_data = $que1->fetch_assoc();
                                        //echo $order_claim= "SELECT contest_id FROM `orders` WHERE contest_id LIKE '%3%'";
                                        //echo $partial_claim = "SELECT sum(reward_amount) as maxAmount,winner_id FROM `winner` WHERE users_id='" . $users_id . "' AND `contest_id`='%".$row['contest_id']."%'";
                                        if ($row['reward_status'] == 'Partially Claimed' && $row['bal_amount'] != '0.00'){ ?>
                                            <a href="javascript:void(0);" class="my-cart-btn one-click" data-id='<?php echo $row['contest_id']; ?>' data-name="<?php echo $row['contest_name']; ?>" data-summary="<?php echo $row['contest_type']; ?>" data-price="<?php echo $row['bal_amount']; ?>" data-quantity="1" data-image="" data-type="<?php echo $row['contest_type']; ?>">Claim</a>
                                            <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#claimModal" data-contest_id="<?php /*echo $row['contest_id']; */?>" data-contest_name="<?php /*echo $row['contest_name']; */?>" >Refund</a>-->
                                        <?php }else{
                                            echo '-';//$ext_status = $ext_data['order_status'];
                                        }
                                        ?>

                                    <?php }else{ ?>
                                        <a href="javascript:void(0);" class="my-cart-btn one-click" data-id='<?php echo $row['contest_id']; ?>' data-name="<?php echo $row['contest_name']; ?>" data-summary="<?php echo $row['contest_type']; ?>" data-price="<?php echo $row['reward_amount']; ?>" data-quantity="1" data-image="" data-type="<?php echo $row['contest_type']; ?>">Claim</a>
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

        $('#claimModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var contest_id = button.data('contest_id'); // Extract info from data-* attributes
            var contest_name = button.data('contest_name');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#contest_name').val(contest_name);
            modal.find('#contest_id').val(contest_id);
        });


    });
</script>



<?php

include 'footer.php';

?>

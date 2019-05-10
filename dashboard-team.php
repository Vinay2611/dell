<?php
include 'header.php';

include('classes/class.common.php');
//Quarter
$today_date = date('Y-m-d h:m:i');
$oCommon = new Common();
//Show claim status
$cliamPending = $oCommon->showClaimStatus($users_id,'Pending');
$cliamDone = $oCommon->showClaimStatus($users_id,'Partially Claimed');
$cliamRedeem = $oCommon->showClaimStatus($users_id,'Redeemed');

//All team
$cliamAllPending = $oCommon->showAllClaimStatus($users_id,$team_id,'Pending');
$cliamAllDone = $oCommon->showAllClaimStatus($users_id,$team_id,'Partially Claimed');
$cliamAllRedeem = $oCommon->showAllClaimStatus($users_id,$team_id,'Redeemed');

//Incentive calculation



//Calculate order status for users (Pending, In-process, Completed, Rejected)
$sql_0 = "SELECT count(order_id) as pending FROM `orders` WHERE users_id = '$users_id' AND order_status = 'Pending'";
$que_0 = $db->query( $sql_0 );
$ext_0 = $que_0->fetch_assoc();
$num_0 = $ext_0['pending'];

$sql_1 = "SELECT count(order_id) as inprocess FROM `orders` WHERE users_id = '$users_id' AND order_status = 'In-progress'";
$que_1 = $db->query( $sql_1 );
$ext_1 = $que_1->fetch_assoc();
$num_1 = $ext_1['inprocess'];

$sql_2 = "SELECT count(order_id) as completed FROM `orders` WHERE users_id = '$users_id' AND order_status = 'Completed'";
$que_2 = $db->query( $sql_2 );
$ext_2 = $que_2->fetch_assoc();
$num_2 = $ext_2['completed'];

$sql_3 = "SELECT count(order_id) as rejected FROM `orders` WHERE users_id = '$users_id' AND order_status = 'Rejected'";
$que_3 = $db->query( $sql_3 );
$ext_3 = $que_3->fetch_assoc();
$num_3 = $ext_3['rejected'];


//Team amout utilized
//echo "SELECT SUM(reward_amount) AS total_amount  FROM `winner` WHERE team_id = '$team_id' ";
$totalincentive = $db->query("SELECT SUM(reward_amount) AS total_amount  FROM `winner` WHERE team_id = '$team_id' AND users_id != '$users_id'");
//$totalincentive = $db->query("SELECT  SUM(tr.amount) as Total FROM `team_request` AS tr JOIN winner AS w ON tr.team_id = w.team_id WHERE w.type='Team' AND tr.team_id = '$team_id' GROUP BY to_id");
$totalEarnedAmt = $totalincentive->fetch_assoc();
$totalUtilized = $totalEarnedAmt['total_amount'];


//Team amount earned

$winnerTeamAmt = $db->query( "SELECT o.order_date,o.order_id,SUM(od.price) as amount,o.users_id 

FROM `orders` AS o 

JOIN order_details AS od ON o.order_id = od.order_id JOIN winner AS w ON w.users_id = o.users_id

WHERE w.team_id = '$team_id' AND w.users_id != '$users_id' GROUP BY w.contest_id LIMIT 0,1");
//$winnerTeamAmt = $db->query( "SELECT SUM(reward_amount) as Total,SUM(balance_amount) as Balanced  FROM `winner` WHERE type = 'Team' AND team_id = '$team_id'");
$winnerAmt = $winnerTeamAmt->fetch_assoc();
//$EarnTeamAmt = $winnerAmt['Total'];
$EarnedTeamAmt = $winnerAmt['amount'];

//Balanced
$BalancedTotal = $totalUtilized - $EarnedTeamAmt;

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
                        <li class="is-active">Dashboard</li>
                    </ul>
                </div>

            </div>
            <div class="clearfix"></div>
            <?php include('left-col-team.php'); ?>



            <div class="col-md-3">
                <div class="contest-block curve">
                    <div style="margin-top:0px;" class="table-responsive">
                        <div class="list-group">
                            <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Team Reward Status</a> </div>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-up"></span> Yet to claim  <span class="badge"><?php echo  $cliamPending ;?></span>
                            </a>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-right"></span> Partially Claimed <span class="badge"><?php echo  $cliamDone;?></span>
                            </a>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-right"></span> Order Claimed <span class="badge"><?php echo $cliamRedeem;?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="contest-block curve">
                    <div style="margin-top:0px;" class="table-responsive">
                        <div class="list-group">
                            <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Team Members Claim Status</a> </div>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-up"></span> Yet to claim <span class="badge"><?php echo  $cliamAllPending ;?></span>
                            </a>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-right"></span> Partially Claimed <span class="badge"><?php echo  $cliamAllDone;?></span>
                            </a>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-right"></span> Order Claimed <span class="badge"><?php echo $cliamAllRedeem;?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="contest-block curve">
                    <div style="margin-top:0px;" class="table-responsive">
                        <div class="list-group">
                            <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Team Members Incentive</a> </div>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-up"></span> Total incentive earned <span class="badge"><?php if (!empty($totalUtilized)){ echo $totalUtilized; }else{ echo 0;} ?></span>
                            </a>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-right"></span> Total incentive utilized <span class="badge"><?php  if (!empty($EarnedTeamAmt)){ echo $EarnedTeamAmt; }else{ echo 0;};?></span>
                            </a>
                            <a style="cursor:default;" class="list-group-item" href="#">
                                <span class="glyphicon glyphicon-hand-right"></span> Amount Pending <span class="badge"><?php if (!empty($BalancedTotal)){ echo $BalancedTotal; }else{ echo 0;} ?></span>
                            </a>
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
include 'footer.php';
?>
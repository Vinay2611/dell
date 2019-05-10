<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 14-03-2019
 * Time: 12:10
 */

include 'header.php';



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
                    <div class="menu-list col-md-3">
                        <!--<form>
                            <label class="radio">Individual reward
                                <input type="radio" class="check" checked="checked" name="is_company">
                                <span class="checkround"></span>
                            </label>
                            <label class="radio">Team reward
                                <input type="radio" name="is_company">
                                <span class="checkround"></span>
                            </label>
                        </form>-->
                    </div>
                    <div class="reward-menu col-md-8">
                        <header>
                            <span data-action="toggle-nav" class="action nav-toggle"><span>Toggle Nav</span></span>
                        </header>
                        <div class="nav-sections">
                            <div class="nav-content">
                                <nav>
                                    <div class="nav-block">
                                        <ul>
                                            <li>
                                                <a href="#" class="has-children">Q1</a>
                                                <span class="menu-icon"></span>
                                                <div class="Diamonds submenu">
                                                    <div class="submenu_parent">
                                                        <ul>
                                                            <li><a href="#">Q1-A</a></li>
                                                            <li><a href="#">Q1-B</a></li>
                                                            <li><a href="#">Q1-C</a></li>
                                                            <li><a href="#">Q1-D</a></li>
                                                            <li><a href="#">Q1-E</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="has-children">Q2</a>
                                                <span class="menu-icon"></span>
                                                <div class="Create_Your_Own_Ring submenu">
                                                    <div class="submenu_parent">
                                                        <ul>
                                                            <li><a href="#">Q2-A</a></li>
                                                            <li><a href="#">Q2-B</a></li>
                                                            <li><a href="#">Q2-C</a></li>
                                                            <li><a href="#">Q2-D</a></li>
                                                            <li><a href="#">Q2-E</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="has-children">Q3</a>
                                                <span class="menu-icon"></span>
                                                <div class="Engagement_Rings submenu">
                                                    <div class="submenu_parent">
                                                        <ul>
                                                            <li><a href="#">Q3-A</a></li>
                                                            <li><a href="#">Q3-B</a></li>
                                                            <li><a href="#">Q3-C</a></li>
                                                            <li><a href="#">Q3-D</a></li>
                                                            <li><a href="#">Q3-E</a></li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="has-children">Q4</a>
                                                <span class="menu-icon"></span>
                                                <div class="wedding_bands submenu">
                                                    <div class="submenu_parent">
                                                        <ul>
                                                            <li><a href="#">Q4-A</a></li>
                                                            <li><a href="#">Q4-B</a></li>
                                                            <li><a href="#">Q4-C</a></li>
                                                            <li><a href="#">Q4-D</a></li>
                                                            <li><a href="#">Q4-E</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="#">Report</a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <div class="reward-user">
                        <div class=""><a href="javascript:void(0);"><i class="fa fa-user" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3 float-left">
                <div class="contest-block">
                    <div class="contest-blog">
                        <div class="contest-head">
                            <h5>Ongoing Contest</h5>
                        </div>
                        <div class="contest-list">
                            <ul>
                                <?php
                                $i = 1;
                                $sql = "SELECT * FROM `contest` WHERE status = 'Ongoing' AND  system_status = 'Active'";
                                $que = $db->query( $sql );
                                while ($row = $que->fetch_assoc()) {
                                    $banner[] = array();
                                ?>
                                <li><?php echo $row['contest_name']; ?></li>
                                <!--<li>Contest - 2</li>
                                <li>Contest - 3</li>-->
                                    <?php
                                    $i++;
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="contest-head">
                            <h5>&nbsp;</h5>
                        </div>

                    </div>
                    <div class="contest-blog">
                        <div class="contest-head">
                            <h5>Ongoing Contest</h5>
                        </div>
                        <div class="contest-list">
                            <!--<img src="uploads/<?php /*echo $banner[0];*/?>" class="img-responsive" />-->
                            <img src="assets/images/ongoing-reward.jpg" class="img-responsive" />
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 float-sm-left">
                <div class="table-grid">
                    <table id="myTable" class="display">
                        <thead>
                        <tr>
                            <th width="5%" class="th-sm sorting center">Sr#</th>
                            <th width="11%" class="th-sm sorting">Contest</th>
                            <th width="13%" class="th-sm sorting">Contest-type</th>
                            <th width="7%" class="th-sm sorting right">Price</th>
                            <th width="12%" class="th-sm sorting right">Claim Value</th>
                            <th width="9%" class="th-sm sorting right">Pending</th>
                            <th width="17%" class="th-sm sorting left">Status</th>
                            <th width="13%" class="th-sm sorting right">Hedge-Rate</th>
                            <th width="13%" class="th-sm sorting right">INR.Coversion</th>
                            <th width="13%" class="th-sm sorting left">Order</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,po.tax,po.balance_amount,wisr.reward_amt,hr.hedge_rate FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id JOIN winner_isr AS wisr ON c.contest_id = wisr.contest_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id WHERE c.status = 'Ongoing' AND  system_status = 'Active' GROUP BY c.contest_id";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()) {

                            $inrPrice =  $row['budget'] * $row['hedge_rate'];
                            ?>
                            <tr>
                                <td class="center"><?php echo $i; ?></td>
                                <td class="left"><?php echo $row['contest_name']; ?></td>
                                <td class="left"><?php echo $row['contest_type']; ?></td>
                                <td class="right"><?php echo $row['budget']; ?></td>
                                <td class="right"><?php echo $row['agency_fee']; ?></td>
                                <td class="right"><?php echo $row['balance_amount']; ?></td>
                                <td class="left"><?php echo $row['status']; ?></td>
                                <td class="right"><?php echo $row['hedge_rate']; ?></td>
                                <td class="right"><?php echo $inrPrice; ?></td>
                                <td class="right">
                                    <?php
                                    //Check user is already claimed
                                    $sql1 = "SELECT id,o.contest_id,price,users_id,url,o.status FROM `order` AS o JOIN contest AS c ON o.contest_id = c.contest_id WHERE o.`users_id` = '".$users_id."' AND o.`contest_id` = '".$row['contest_id']."'";
                                    //$sql1 = "SELECT * FROM `order` WHERE `users_id` = '".$users_id."'";
                                    $que1 = $db->query( $sql1 );
                                    if ($que1->num_rows > 0){  ?>
                                    <?php }else{ ?>
                                        <a href="claim.php?cid=<?php echo $row['contest_id']; ?>">Claim</a>
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

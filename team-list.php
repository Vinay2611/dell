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
                        <li class="is-active">Team list</li>
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
                            <th class="th-sm sorting">ISR/TSR Name</th>
                            <th class="th-sm sorting ">Reward Status</th>
                            <th class="th-sm sorting ">Reward Amount</th>
                            <th class="th-sm sorting">Contest-type</th>
                            <th class="th-sm sorting ">Start Date</th>
                            <th class="th-sm sorting ">End Date</th>
                            <th class="th-sm sorting ">Status</th>
                            <!--<th class="th-sm sorting ">Action</th>-->

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT c.contest_id,c.po_id,c.contest_name,c.contest_type,c.start_date,c.end_date,
                      

c.status,c.budget,po.po_number,po.po_value,po.date_of_po,po.agency_fee,

po.tax,po.balance_amount,w.reward_amount,w.reward_status,w.users_id,w.reward_status,

w.team_id,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date,hr.quarter,u.first_name,u.last_name 

FROM `contest` AS c JOIN purchase_order AS po ON c.po_id = po.po_id 

JOIN winner AS w ON c.contest_id = w.contest_id JOIN users AS u ON u.users_id = w.users_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id 

WHERE c.status = 'Ongoing' AND system_status = 'Active' AND w.team_id = '$team_id' AND w.users_id = '$users_id' 

GROUP BY c.contest_id";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()) {

                            $inrPrice =  $row['budget'] * $row['hedge_rate'];

                            //Team Name
                            $team = "SELECT * FROM `team` WHERE `team_id` = '".$row['team_id']."'";
                            $team_q = $db->query( $team);
                            $team_e = $team_q->fetch_assoc();

                            ?>
                            <tr class="item">
                                <td ><?php echo $i; ?></td>
                                <td ><?php echo $team_e['team_name']; ?></td>
                                <td ><?php echo $row['quarter']; ?></td>
                                <td ><?php echo $row['contest_name']; ?></td>
                                <td ><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                <td ><?php echo $row['reward_status']; ?></td>
                                <td ><?php echo $row['reward_amount']; ?></td>
                                <td ><?php echo $row['contest_type']; ?></td>
                                <td ><?php echo $row['start_date']; ?></td>
                                <td ><?php echo $row['end_date']; ?></td>
                                <td ><?php echo $row['status']; ?></td>
                                <!--<td ><a href="team-list.php"></a><?php /*echo "View"; */?></td>-->


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

</body>
</html>

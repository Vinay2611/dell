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
<script src="js/user.js"></script> 

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
            </div>
            <div class="clearfix"></div>
            
            

            <div class="col-md-12 col-sm-12 float-sm-left">
            
            <div class="breadcrums-block">
                    	 <ul class="breadcrumb">
                          <li><a href="dashboard.php">Home</a></li>
                          <li class="is-active">Purchase order </li>
                        </ul> 
                    </div>
            
                <div class="table-grid">
                    <table id="contestTable" class="display dataTable">
    <thead>
        <tr>
            <th>Sr.</th>
            <th>PO number</th>
            <th>PO Value</th>
            <th>PO date</th>
            <th>Agency fees</th>
            <th>PM fee</th>
            <th>PO Balance</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       
        <?php 
		$userSql = $db->query("SELECT po_id,po_number,po_value,tax,date_format(date_of_po,'%d %M %y') as date_of_po,agency_fee,pm_fee,balance_amount,status FROM purchase_order order  by date_of_po desc");  
		$content = "";
		$a=1;
		while($row = $userSql->fetch_array()) { 
		
		
        $content .= '<tr><td align="center">'.$a.'</td><td>'.$row['po_number'].'</td><td>'.$row['po_value'].'</td><td>'.$row['date_of_po'].'</td><td>'.$row['agency_fee'].'</td><td>'.$row['pm_fee'].'</td><td>'.$row['balance_amount'].'</td><td>'.$row['status'].'</td>';
		
		if($row['status'] == 'Pending') {
		$content .= '<td><a class="pointer" onclick="POAction(\'Approved\','.$row['po_id'].')">Approved</a>|<a class="pointer" onclick="POAction(\'Reject\','.$row['po_id'].')">Reject</a></td>';
		}
		
		if($row['status'] == 'Approved') {
		$content .= '<td><a class="pointer" onclick="POAction(\'Pending\','.$row['po_id'].')">Pending</a>|<a class="pointer" onclick="POAction(\'Reject\','.$row['po_id'].')">Reject</a>|<a class="pointer" onclick="POAction(\'Close\','.$row['po_id'].')">Close</a></td>';
		} 
		
		if($row['status'] == 'Close') {
		$content .= '<td></td>';
		} 
		
		$content .=  $action.'</tr>';
		$a++;
		}
		echo $content;
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

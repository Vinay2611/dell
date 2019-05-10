<?php
include 'header.php';
include('classes/class.common.php');
include('config/class.Encryption.php');
$year = date('Y');
$oEncryption = new Encryption();

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
                        <li class="is-active">My order</li>
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
                            <th  class="th-sm sorting">Order-id</th>
                            <th  class="th-sm sorting">Order date</th>
                            <th  class="th-sm sorting">Order total</th>
                            <th  class="th-sm sorting">Order Status</th>
                            <!--<th  class="th-sm sorting">Agency comment</th>-->
                            <th  class="th-sm sorting">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $sql = "SELECT o.order_id,o.order_number,date_format(o.order_date,'%d %M %Y') as order_date,o.contest_id,o.users_id,o.order_status,o.shipping_address,o.city,o.pincode,o.agency_comments,o.remark,o.last_update,hr.hedge_rate,hr.quarter,hr.from_date,hr.to_date,c.contest_name FROM `orders` AS o JOIN `contest` AS c ON o.contest_id=c.contest_id JOIN purchase_order AS po ON c.po_id = po.po_id JOIN hedge_rate AS hr ON hr.hedge_id = po.hedge_id  where o.users_id = '".$users_id."'";
                        //echo $sql = "SELECT order_id,order_number,date_format(`order_date`,'%d %M %Y') as order_date,order_status,agency_comments FROM `orders` where users_id = '".$users_id."'";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()) {
                        $odQuery = $db->query("SELECT sum(price) as order_total FROM `order_details` WHERE order_id='".$row['order_id']."'");
                        $odRow = $odQuery->fetch_array();     

                        //Contest name and quarter name
						$orderId = $oEncryption->enc($row['order_id']);
						?>
                            <tr class="item">
                                <td class="center"><?php echo $i; ?></td>
                                <td class=""><?php echo $row['quarter']; ?></td>
                                <td class=""><?php echo $row['contest_name']; ?></td>
                                <td class=""><?php echo $row['order_number']; ?></td>
                                <td class=""><?php echo $row['order_date']; ?></td>
                                <td class=""><?php echo $odRow['order_total']; ?></td>
                                <td class=""><?php echo $row['order_status']; ?></td>
                                <!--<td class=""><?php /*echo substr($row['agency_comments'],0,20).'...'; */?></td>-->
                                <td class="">
                                    <a href="view-detail.php?id=<?php echo $orderId; ?>" class="">View</a>
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


<!-- Modal -->
<div class="modal fade" id="claimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Replace Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="claimRemark">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Contest Name:</label>
                        <input type="text" class="form-control" name="contest_name" id="contest_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Remark:</label>
                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contest_id" value="" id="contest_id">
                    <input type="hidden" name="type" value="ReplaceClaim">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Replace</button>
                </div>
            </form>
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

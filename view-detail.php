<?php
include 'header.php';
include_once('config/class.Encryption.php');
$oEncryption = new Encryption();
$decOrder_id = $oEncryption->dec($_GET['id']);

//echo "SELECT o.order_id,o.order_number,o.order_status,o.shipping_address,o.city,o.pincode,o.agency_comments,o.remark,DATE_FORMAT(o.order_date,'%d %M %Y') as order_date,o.last_update FROM orders as o WHERE o.order_id = '".$decOrder_id."' AND o.users_id='".$users_id."'";
$odSql = $db->query("SELECT o.order_id,o.order_number,o.order_status,o.shipping_address,o.city,o.pincode,o.agency_comments,o.remark,DATE_FORMAT(o.order_date,'%d %M %Y') as order_date,o.last_update FROM orders as o WHERE o.order_id = '" . $decOrder_id . "' AND o.users_id='" . $users_id . "'");
$oRow = $odSql->fetch_object();
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
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="breadcrums-block">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">My Order</a></li>
                            <li class="is-active">View Order</li>
                        </ul>
                    </div>
                    <div class="new-registration-wrapper" style="max-width: 100%">
                        <section class="invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="page-header">
                                        Order Number : <?php echo $oRow->order_number; ?>
                                        <small class="pull-right" style="color:#F9F5F6;">
                                            Date: <?php echo $oRow->order_date; ?></small>
                                    </h2>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <strong>Address</strong>
                                    <address>
                                        <strong><?php echo $oRow->shipping_address; ?>
                                    </address>
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Brand details</th>
                                            <th>Size</th>
                                            <th>Website</th>
                                            <th>Price</th>
                                            <th>URL</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        //echo "SELECT od.od_id,od.order_id, od.product, od.brand_details,od.size,od.website,od.price,od.url,od.comment,od.agency_remark,od.order_status,od.dateTime,o.order_date FROM order_details as od JOIN orders as o WHERE o.order_id='".$oRow->order_id."' AND o.order_id = od.order_id AND o.users_id='".$users_id."'";
                                        $odQuery = $db->query("SELECT od.od_id,od.order_id, od.product, od.brand_details,od.size,od.website,od.price,od.url,od.comment,od.agency_remark,od.order_status,od.dateTime,o.order_date FROM order_details as od JOIN orders as o WHERE o.order_id='" . $oRow->order_id . "' AND o.order_id = od.order_id AND o.users_id='" . $users_id . "'"); ?>
                                        <tr>
                                            <?php
                                            $grandTotal = "";
                                            while ($prod = $odQuery->fetch_object()) {
                                            $grandTotal += $prod->price;
                                            ?>
                                            <td><?php echo $prod->product; ?></td>
                                            <td><?php echo $prod->brand_details; ?></td>
                                            <td><?php echo $prod->size; ?></td>
                                            <td><?php echo $prod->website; ?></td>
                                            <td><?php echo $prod->price; ?></td>
                                            <td><textarea name="" id="" cols="30" rows="5" readonly
                                                          style="color: black"><?php echo $prod->url; ?></textarea></td>
                                            <td><?php echo $prod->order_status; ?></td>
                                            <td><?php
                                                if ($prod->order_status != 'Return Request' && $prod->order_status != 'Replacement Request') {
                                                    $today_day = date('Y-m-d');
                                                    $order_day = date('Y-m-d', strtotime($prod->order_date));
                                                    $seven_day = date('Y-m-d', strtotime($prod->order_date . ' + 7 days'));
                                                    if ($today_day <= $seven_day) {

                                                        if ($prod->order_status == 'Completed') {
                                                            ?>
                                                            <!--<button type="button" data-toggle="modal" data-target="#returnModal" data-od_id="<?php /*echo $prod->od_id; */
                                                            ?>" class="btn btn-danger  btn-xs">Return</button>-->
                                                            <button type="button" data-toggle="modal"
                                                                    data-target="#replaceModal"
                                                                    data-od_id="<?php echo $prod->od_id; ?>"
                                                                    class="btn btn-danger btn-xs">Replace
                                                            </button>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo 'Return window is closed';
                                                    }
                                                    //echo $prod->dateTime;
                                                    /*echo $date = new DateTime(date("Y-m-d"));
                                                    echo $date->modify('+7 day');*/
                                                    //echo $tomorrowDATE = $date->format('Y-m-d');
                                                    //echo $prod->order_status;
                                                }
                                                //Date
                                                ?>
                                            </td>

                                            <!--<td><button type="button" data-toggle="modal" data-target="#returnModal" data-od_id="<?php /*echo $prod->od_id; */ ?>" class="btn btn-danger btn-xs">Return</button></td>-->


                                            <!--<td><button type="button" id="reButton<? /*=$decOrder_id;*/ ?>" class="btn btn-info" onClick="returnRequet('<?php /*echo $_GET['id']; */ ?>');">Return</button></td>-->
                                        </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->

                                <!-- /.col -->
                                <div class="col-xs-offset-8">
                                    <p class="lead"></p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th style="width:50%">Total:</th>
                                                <td><?php echo $grandTotal; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->

                        </section>

                    </div>
                </div>


            </div>
            <div class="new-registration-wrapper col-md-12 footer-line text-center">
                <p>If you are facing issues, please send an email too <a
                            href="mailto:<?php echo email; ?>"><?php echo email; ?></a></p>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Return Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="refundComment" method="post" action="">
                    <div class="modal-body">
                        <!--<div class="form-group">
                            <label for="recipient-name" class="col-form-label">Contest Name:</label>
                            <input type="text" class="form-control" name="contest_name" id="contest_name">
                        </div>-->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Remark *</label>
                            <textarea class="form-control" name="comment" id="comment" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="od_id" value="" id="od_id">
                        <input type="hidden" name="type" value="RefundComment">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="replaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Replacement Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="replaceComment" method="post" action="">
                    <div class="modal-body">
                        <!--<div class="form-group">
                            <label for="recipient-name" class="col-form-label">Contest Name:</label>
                            <input type="text" class="form-control" name="contest_name" id="contest_name">
                        </div>-->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Remark *</label>
                            <textarea class="form-control" name="comment" id="comment" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="od_id" value="" id="od_id">
                        <input type="hidden" name="type" value="ReplaceComment">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Replace</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function ($) {
            $(window).on('resize', function () {
                if ($(window).width() <= 991) {
                    $('.nav-toggle').click(function () {
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

            $('.menu-icon').click(function (event) {
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

            $('#returnModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var od_id = button.data('od_id'); // Extract info from data-* attributes
                // var contest_name = button.data('contest_name');
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('#od_id').val(od_id);
                //modal.find('#contest_id').val(contest_id);
            });


            $('#replaceModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var od_id = button.data('od_id'); // Extract info from data-* attributes
                // var contest_name = button.data('contest_name');
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('#od_id').val(od_id);
                //modal.find('#contest_id').val(contest_id);
            });


        });
    </script>
    <?php
    include 'footer.php';
    ?>

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
                        <li class="">My order</li>
                        <li class="is-active">View order</li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 float-sm-left">


                <div class="table-grid">
                    <div class="">
                    <!--<div class="new-registration-wrapper">-->

                        <!--<h1>New Register</h1>-->

                        <form id="claimRequest" class="row-divide">

                            <?php
                            $sql = "SELECT * FROM `order_details` WHERE order_id = '".$_GET['id']."'";
                            $que = $db->query( $sql );
                            while ($row = $que->fetch_assoc()) {
                                ?>




                                <div class="form-group row">
                                    <label for="contest_name" class="col-sm-3 col-form-label">Order Number</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['order_number']) ? $row['order_number'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contest_type" class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['product']) ? $row['product'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="budget" class="col-sm-3 col-form-label">Brand Detail</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['brand_details']) ? $row['brand_details'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['size']) ? $row['size'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['website']) ? $row['website'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_fee" class="col-sm-3 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['price']) ? $row['price'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Url</label>
                                    <div class="col-sm-9">
                                        <textarea name="url" id="" cols="30" rows="10" readonly style="color: black;padding: 8px;"><?php echo isset($row['url']) ? $row['url'] : ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Remark</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['remark']) ? $row['remark'] : ''; ?></label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Order Status</label>
                                    <div class="col-sm-9">
                                        <label class=" col-form-label"><?php echo isset($row['order_status']) ? $row['order_status'] : ''; ?></label>
                                    </div>
                                </div>

                                <?php
                                if ( $row['order_status'] == 'Completed' ){
                                    ?>
                                    <button type="button" data-toggle="modal" data-target="#refundModal" data-od_id="<?php echo $row['od_id']; ?>" class="btn btn-danger btn-xs">Refund</button>
                                    <?php
                                }
                                ?>

                                <hr>

                                <?php
                            }
                            ?>
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



<!-- Modal -->
<div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refund</h5>
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
                        <label for="message-text" class="col-form-label">Remark:</label>
                        <textarea class="form-control" name="comment" id="comment"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="od_id" value="" id="od_id">
                    <input type="hidden" name="type" value="RefundComment">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Refund</button>
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

        $('#refundModal').on('show.bs.modal', function (event) {
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

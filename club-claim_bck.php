<?php

include 'header.php';

if (empty($_POST)){
    echo '<script>location.href = "claim-list.php"</script>';
}
extract($_POST);

$total = '';
foreach ($contest_price as $total_price){
    $total += $total_price;
}

$sql = "SELECT * FROM `users` WHERE `users_id` = '$users_id'";
$que = $db->query( $sql );
$row = $que->fetch_assoc();

//Team Name
$team = "SELECT * FROM `team` WHERE `team_id` = '".$row['team_id']."'";
$team_q = $db->query( $team);
$team_e = $team_q->fetch_assoc();

//Reporting manager
$manager = "SELECT * FROM `users` WHERE `users_id` = '".$row['reporting_manager']."'";
$manager_q = $db->query($manager);
$manager_e = $manager_q->fetch_assoc();


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
                            <li class="is-active">Club-Claim</li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!--<div class="col-md-3"></div>-->
                <div class="col-md-9 col-sm-12 float-sm-left">
                    <div class="table-grid">
                        <div class="new-registration-wrapper" style="margin-top: 0px">

                            <form id="claimclubRequest" method="post" action="" enctype="multipart/form-data" class="no-opacity">
                                <div class="form-group row">
                                    <label for="employee_id" class="col-sm-3 col-form-label">Employee ID</label>
                                    <div class="col-sm-9">
                                        <label for=""><?php echo $row['employee_id'];?></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contest_name" class="col-sm-3 col-form-label">Contest Name</label>
                                    <div class="col-sm-9" style="padding-left: 30px;">
                                        <ol type="i" style="font-weight: bolder">
                                        <?php
                                        foreach ($contest_name as $contestName){
                                        ?>
                                            <li><?php echo $contestName; ?></li>
                                        <?php } ?>
                                        </ol>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Contest Type</label>
                                    <div class="col-sm-9">
                                        <label  class="col-form-label"><?php echo $contest_type; ?></label>
                                    </div>
                                </div>

                                <!--<div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Quarter:*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="contest_type" value=""  placeholder="" >
                                    </div>
                                </div>-->

                                <?php
                                if (isset($user_type) && $user_type != 'ISM'){
                                    ?>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Preferred Detailed
                                        Delivery Address*</label>
                                    <div class="col-sm-8">
                                        <textarea name="shipping_address" id="shipping_address" cols="61" style="color: black" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="city" value="" id="city" placeholder="City" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Pincode:*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pincode" value="" id="pincode" placeholder="Pincode" required>
                                    </div>
                                </div>

                                <h4 class="text-center">Product 1</h4>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Product</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_1" id="product_1" placeholder="Product" required>
                                            <span class="validate_msg">Please provide your feedback</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Brand details</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="brand_1" id="brand_1" placeholder="Brand details" required>
                                            <span class="validate_msg">Please provide url</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="size_1" id="size_1" placeholder="Size">
                                            <span class="validate_msg">Please provide url</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="website_1" id="website_1" placeholder="Website" required>
                                            <span class="validate_msg">Please provide url</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Url</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="url_1" id="url_1" placeholder="Url" required>
                                            <span class="validate_msg">Please provide url</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Price incl of taxes</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="price_1" id="price_1" placeholder="Price incl of taxes" required>
                                            <span class="validate_msg">Please provide url</span>
                                        </div>
                                    </div>

                                <h4 class="text-center">Product 2</h4>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_2" id="product_2" placeholder="Product">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Brand details</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="brand_2" id="brand_2" placeholder="Brand details">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="size_2" id="size_2" placeholder="Size">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="website_2" id="website_2" placeholder="Website">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="url_2" id="url_2" placeholder="Url">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Price incl of taxes</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price_2" id="price_2" placeholder="Price incl of taxes">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>


                                <h4 class="text-center">Product 3</h4>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_3" id="product_3" placeholder="Product">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Brand details</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="brand_3" id="brand_3" placeholder="Brand details">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="size_3" id="size_3" placeholder="Size">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="website_3" id="website_3" placeholder="Website">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="url_3" id="url_3" placeholder="Url">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Price incl of taxes</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price_3" id="price_3" placeholder="Price incl of taxes">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>


                                <h4 class="text-center">Product 4</h4>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_4" id="product_4" placeholder="Product">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Brand details</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="brand_4" id="brand_4" placeholder="Brand details">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="size_4" id="size_4" placeholder="Size">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="website_4" id="website_4" placeholder="Website">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="url_4" id="url_4" placeholder="Url">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Price incl of taxes</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price_4" id="price_4" placeholder="Price incl of taxes">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>


                                <h4 class="text-center">Product 5</h4>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_5" id="product_5" placeholder="Product">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Brand details</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="brand_5" id="brand_5" placeholder="Brand details">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="size_5" id="size_5" placeholder="Size">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="website_5" id="website_5" placeholder="Website">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="url_5" id="url_5" placeholder="Website URL">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Price incl of taxes</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price_5" id="price_5" placeholder="Price incl of taxes">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Budget Alloted :*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="budget_allowed" id="budget_allowed" readonly value="<?php echo $total;?>" placeholder="Price incl of taxes">
                                        <span class="validate_msg">Please provide url</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Remarks/Special Instructions :*</label>
                                    <div class="col-sm-9">
                                        <textarea name="remarks" id="remarks" cols="61" style="color: black"></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="type" value="ClaimClubRequest">
                                <input type="hidden" name="user_type" value="ISR" id="user_type">
                            </div>
                                <?php }else{ ?>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Request Type</label>
                                        <div class="col-sm-9">
                                            <label class="custom-radio">Team outting
                                                <input type="radio" checked="checked" name="order_type" value="Team outting">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-radio">Refreshing
                                                <input type="radio" name="order_type" value="Refreshing" >
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Select Document</label>
                                        <div class="col-sm-9">
                                            <input type="file"  name="document" id="document" ><span>5MB * max size</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Upload HR Approval</label>
                                        <div class="col-sm-9">
                                            <input type="file"  name="hr_approval" id="hr_approval" ><span>5MB * max size</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Upload Geo Head Approval</label>
                                        <div class="col-sm-9">
                                            <input type="file"  name="geo_head_approval" id="geo_head_approval" ><span>5MB * max size</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Upload PI</label>
                                        <div class="col-sm-9">
                                            <input type="file"  name="upload_pi" id="upload_pi" ><span>5MB * max size</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Upload Invoice</label>
                                        <div class="col-sm-9">
                                            <input type="file"  name="upload_invoice" id="upload_invoice" ><span>5MB * max size</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Select Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="start_date" class="form-control" id="start_date" autocomplete="off">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="end_date" class="form-control" id="end_date" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="amount" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Kind of Activity</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="kind_of_activity" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Location</label>
                                        <div class="col-sm-8">
                                            <textarea name="location" id="location" cols="53"  style="color: black"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="ClaimClubTeamRequest">
                                    <input type="hidden" name="user_type" value="ISM" id="user_type">
                                <?php }
                                ?>

                                <span class="response_msg"></span>
                                <div class="form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="users_id" value="<?php echo isset( $users_id ) ? $users_id : '';?>" id="users_id">
                                        <?php
                                        foreach ($contest_id as $c_id) {
                                            ?>
                                            <input type="hidden" name="contest_id[]" value="<?php echo $c_id; ?>" id="contest_id">
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        foreach ($contest_price as $c_pr){
                                        ?>
                                        <input type="hidden" name="budget[]" value="<?php echo $c_pr;?>" id="budget">
                                        <?php } ?>
                                        <input type="hidden" name="team_id" value="<?php echo $row['team_id']; ?>">
                                        <input type="hidden" name="contest_type" value="<?php echo $contest_type; ?>" id="contest_type">
                                        <input type="hidden" name="club_price" value="<?php echo $total;?>">

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
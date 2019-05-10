<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 14-03-2019
 * Time: 12:53
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
                                            <li><a href="#">Logout</a></li>
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
            <div class="col-md-3"></div>
            <div class="col-md-9 col-sm-12 float-sm-left">
                <div class="table-grid">
                    <div class="new-registration-wrapper">

                        <!--<h1>New Register</h1>-->

                        <form>
                            <div class="form-group row">
                                <label for="inputName3" class="col-sm-3 col-form-label">Contest</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputName3" placeholder="Contest Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName3" class="col-sm-3 col-form-label">Reward Amt.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputName3" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName3" class="col-sm-3 col-form-label">Claimed Amt.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputName3" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="inputTeamName3" class="col-sm-3 col-form-label">Start Date</label>
                                <div class="col-sm-3">
                                    <select class="form-control" id="inputTeamName3">
                                        <option value=" " selected>Please select team</option>
                                        <option value="Commercial">Commercial</option>
                                        <option value="Channel">Channel</option>
                                        <option value="DCSE">DCSE</option>
                                        <option value="GCCS">GCCS</option>
                                    </select>
                                </div>
                                <label for="inputTeamName3" class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-3">
                                    <select class="form-control" id="inputTeamName3">
                                        <option value=" " selected>Please select team</option>
                                        <option value="Commercial">Commercial</option>
                                        <option value="Channel">Channel</option>
                                        <option value="DCSE">DCSE</option>
                                        <option value="GCCS">GCCS</option>
                                    </select>
                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Type of rewards</label>
                                <div class="col-sm-9">
                                    <label class="custom-radio">Team Outing
                                        <input type="radio" checked="checked" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Place of Outing</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="" placeholder="PO value">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Place of Outing</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="" placeholder="PO value">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="" placeholder="PO value">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
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
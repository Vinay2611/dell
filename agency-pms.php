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
                <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs"><a href="index.php"><img src="../assets/images/DellEMC.png" class="img-fluid"></a></div>
                <!--<div class="logo col-md-4 col-sm-4 col-4 text-center text-center-xs"><a href="javascript:void(0);"><img src="images/intel.png" class="img-fluid"></a></div>
                <div class="logo col-md-4 col-sm-4 col-4 text-right text-center-xs"><a href="javascript:void(0);"><img src="images/micro-soft.png" class="img-fluid"></a></div>-->

            </div>
        </div>
    </div>
</div>
<div class="rewards-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12 "><!--col-md-offset-3-->
                <div class="menublog row">
                    <!--<div class="menu-list col-md-3">
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
                    <div class="reward-menu col-md-11">
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
                        <div class=""><a href="javascript:void(0);"><i class="fa fa-user fa-3x" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="table-wrapper">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                        </tr>
                        <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        $(window).on('resize', function() {
            if ($(window).width() <= 991 ){
                $('.nav-toggle').click(function() {
                    if ($(this).hasClass('nav-open')) {
                        $(this).removeClass("nav-open");
                        //$('.nav-sections').removeClass('nav-open');
                        $('html').removeClass('nav-open');

                    }   else {
                        $(this).addClass("nav-open");
                        //$('.nav-sections').addClass('nav-open');
                        $('html').addClass('nav-open');

                    }
                });
            }
        }).trigger("resize");




        $('.menu-icon').click(function(event){
            if($(this).hasClass('active')){
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
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>

<?php

include "footer.php";

?>

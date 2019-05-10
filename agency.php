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
                    <a href="index.php"><img src="../assets/images/DellEMC.png" class="img-fluid"></a>
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
                                                <a href="#" class="has-children">UploadPO</a>
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
                                                <a href="#" class="has-children">Define Contest</a>
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
                                                <a href="#" class="has-children">Split PO</a>
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
                                                <a href="#" class="has-children">Hedge Rate</a>
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
                                            <li><a href="#">Upload Winner</a></li>
                                            <li><a href="#">Send Email</a></li>
                                            <li><a href="#">Close PO</a></li>
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
            <!--<div class="col-md-3">
            <div class="contest-block">
                <div class="">
                    <div class="">
                        <h5>Ongoing Contest</h5>
                    </div>
                    <div class="">
                        <ul>
                            <li>Contest - 1</li>
                            <li>Contest - 2</li>
                            <li>Contest - 3</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>-->
            <div class="col-md-12">
                <div class="table-grid">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
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
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="left">Content - 1</td>
                            <td class="left">Online</td>
                            <td class="right">$100</td>
                            <td class="right">$100</td>
                            <td class="right">$0</td>
                            <td class="left">Pending-Redemption</td>
                            <td class="right">69.85</td>
                            <td class="right">69.65</td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="left">Content - 2</td>
                            <td class="left">Goodies</td>
                            <td class="right">$100</td>
                            <td class="right">$50</td>
                            <td class="right">$50</td>
                            <td class="left">Redeemed</td>
                            <td class="right">69.50</td>
                            <td class="right">34.75</td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td class="left">Content - 3</td>
                            <td class="left">Voucher</td>
                            <td class="right">$500</td>
                            <td class="right">$450</td>
                            <td class="right">$0</td>
                            <td class="left">Pending-Redemption</td>
                            <td class="right">70.15</td>
                            <td class="right">3507.50</td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                            <td class="left">Content - 4</td>
                            <td class="left">Goodies</td>
                            <td class="right">$200</td>
                            <td class="right">$250</td>
                            <td class="right">$0</td>
                            <td class="left">Part-Redeemed</td>
                            <td class="right">72.15</td>
                            <td class="right">14430</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="left"><strong>Total</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
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

include "footer.php";

?>

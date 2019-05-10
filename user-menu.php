<div class="reward-menu col-md-12">
    <header>
        <span data-action="toggle-nav" class="action nav-toggle"><span>Toggle Nav</span></span>
    </header>
    <div class="nav-sections">
        <div class="nav-content">
            <nav>
                <div class="nav-block">
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="claim-list.php" class="has-children">Claim</a></li>
                        <li><a href="my-order.php" class="has-children">My Order</a></li>
                        <?php
                        if ($user_type == 'ISM'){ ?>
                            <li>
                                <a href="team.php" class="has-children">Team</a>
                            </li>
                        <?php }
                        ?>
                        <!--Add to cart-->
                        <li class="my-cart-icon">
                            <a href="#" class="has-children">Order <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span></a>
                            <span class="menu-icon"></span>
                            <div class="wedding_bands submenu">
                                <div class="submenu_parent">
                                    <!--<ul>
                                        <li> <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span></li>
                                    </ul>-->
                                </div>
                            </div>
                        </li>
                        <li><a href="claim-report.php">Report</a></li>
                        <!--<li><a href="isr-report.php">Report</a></li>-->
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="reward-user">
        <div class="">
            <a href="profile.php" title="Hello! <?php echo $first_name. " ". $last_name; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
        </div>
    </div>

</div>
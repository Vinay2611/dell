<div class="reward-menu col-md-12">
    <header>
        <span data-action="toggle-nav" class="action nav-toggle"><span>Toggle Nav</span></span>
    </header>
    <div class="nav-sections">
        <div class="nav-content">
            <nav>
                <div class="nav-block">
                    <ul>
                        <li><a href="dashboard-team.php">Dashboard</a></li>
                        <!--<li><a href="claim-list.php" class="has-children">Claim</a></li>-->
                        <!--<li>
                            <a href="qt1.php" class="has-children">Q1</a>
                        </li>
                        <li>
                            <a href="qt2.php" class="has-children">Q2</a>
                        </li>
                        <li>
                            <a href="qt3.php" class="has-children">Q3</a>
                        </li>
                        <li>
                            <a href="qt4.php" class="has-children">Q4</a>
                        </li>-->
                        <?php
                        if ($user_type == 'ISM'){ ?>
                            <li>
                                <a href="team.php" class="has-children">Team Reward Claim</a>
                            </li>
                            <li>
                                <a href="team-claim-status.php" class="has-children">Team Member Claim Status</a>
                            </li>
                        <?php }
                        ?>
                        <!--Add to cart-->
                        <li class="my-cart-icon">
                            <a href="#" class="has-children">Order <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span></a>
                            <span class="menu-icon"></span>
                            <div class="wedding_bands submenu">
                                <div class="submenu_parent">

                                </div>
                            </div>
                        </li>
                        <li><a href="team-report.php">Report</a></li>
                        <li><a href="logout.php">Logout</a></li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="reward-user">
        <div class=""><a href="profile-team.php" title="Hello! <?php echo $first_name. " ". $last_name; ?>"><i class="fa fa-user" aria-hidden="true"></i></a></div>
    </div>

</div>
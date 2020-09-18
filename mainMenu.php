
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <?php if (isset($_SESSION['userEmail'])) { ?>
                        <li class="<?php if ($_SERVER['PHP_SELF'] =='/dashboard.php') { echo 'active'; } ?>"><a href="/dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
                        </li>
                        <?php if ($_SESSION['userRole'] =='admin') { ?>
                            <li class="<?php if ($_SERVER['PHP_SELF'] =='/users.php') { echo 'active'; } ?>"><a href="users.php"><i class="fa fa-users"></i> Users</a>
                            <?php } ?>
                            <li class="<?php if ($_SERVER['PHP_SELF'] =='/orders.php') { echo 'active'; } ?>"><a href="orders.php"><i class="fa fa-truck"></i> Orders</a>
                            </li>
                            <?php if ($_SESSION['userRole'] =='marchant') { ?>
                                <li class="<?php if ($_SERVER['PHP_SELF'] =='/invoices.php') { echo 'active'; } ?>"><a href="invoices.php"><i class="fa fa-file"></i> Invoice</a>
                                </li>
                                <li class="<?php if ($_SERVER['PHP_SELF'] =='/stores.php') { echo 'active'; } ?>"><a href="stores.php"><i class="fa fa-shopping-cart"></i> Stores</a>
                                <?php } ?>
                                <li class="<?php if ($_SERVER['PHP_SELF'] =='/user.php') { echo 'active'; } ?>"><a href="user.php"><i class="fa fa-user"></i> My Account</a>
                                </li>
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            <?php } else { ?>
                                <li class="<?php if ($_SERVER['PHP_SELF'] =='/login.php') { echo 'active'; } ?>"><a href="/login.php"><i class="fa fa-key"></i> Login</a>
                                </li>
                                <li class="<?php if ($_SERVER['PHP_SELF'] =='/register.php') { echo 'active'; } ?>"><a href="/register.php"><i class="fa fa-user-plus"></i> Register</a>
<!--                         </li>
                        <li class="<?php if ($_SERVER['PHP_SELF'] =='/forgotpass.php') { echo 'active'; } ?>"><a href="/forgotpass.php"><i class="fa fa-user"></i> Forgot Password</a>
                        </li> -->
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Main Menu area End-->
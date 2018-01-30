<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="">
		<?php 
		$general_settings = get_settings('general_settings'); 
		?>
		<link rel="icon" href="<?php echo isset($general_settings['company_favicon']) ? $general_settings['company_favicon'] : ''; ?>" >
        <title>Admin - Coupon Zipcode</title>

        <?php
            echo css('backend/bootstrap.css');
            echo css('backend/style.css');
            echo css('backend/style-responsive.css');
            
            echo js('backend/jquery-3.2.1.min.js');
        ?>
    </head>
    <body>
        <section id="container">
            <?php
            if ($this->session->userdata('admin_logged_in'))
            {
            ?>
                <header class="header black-bg">
                    <!-- <div class="sidebar-toggle-box">
                        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                    </div> -->

                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="logo">Coupon Zipcode<small> Admin</small></a>

                    <div class="top-menu">
                        <ul class="nav pull-right top-menu">
                            <li><a class="logout btn" href="<?php echo base_url('admin/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                </header>

                <aside>
                    <div id="sidebar" class="nav-collapse">
                        <ul class="sidebar-menu" id="nav-accordion">
                            <li class="mt">
                                <a class="active" href="<?php echo base_url('admin/dashboard'); ?>">
                                    <i class="fa fa-dashboard"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/users'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
            <?php
            }
            ?>
            <section class="wrapper login-main-body" style="background: url(<?php echo base_url('assets/img/login-bg.jpg'); ?>) no-repeat center center;">
                <div class="row">
                    <div class="col-lg-5 exact_center">
                        <form class="form-login" action="<?php echo base_url('admin/login'); ?>" method="POST">
                            <a href="javascript:void(0);" class="login_for_logo">
                                <img src="<?php echo isset($general_settings['company_logo']) ? $general_settings['company_logo'] : ''; ?>" alt="Logo">
                            </a>
                            <!-- <h2 class="form-login-heading">Admin Login</h2> -->
                            <div class="login-wrap">
                                <input type="text" class="form-control" name="email" placeholder="Email">
                                <br>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <br>
                                <!-- <label class="checkbox">
                                    <span class="pull-right">
                                        <a class="forgot_ppswrd_screen"  href="javascript:void(0);"> Forgot Password?</a>
                                    </span>
                                </label> -->
                                <?php
                                ?>
                                    <!--  <div>
                                        <label class="login_error"><?php echo 'abc'; ?></label>
                                    </div> -->
                                <?php
                                ?>

                                <button type="submit" class="btn btn-primary form-control">Login</button>
                            </div>
                            <!-- <div class="forgot_password_wrap">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                                <div class="cncl_sub_btn_grp">
                                    <button class="btn btn-default cncl_rst_psswrd" type="button">Cancel</button>
                                    <button class="btn btn-theme" type="button">Submit</button>
                                </div>
                            </div> -->
                        </form>
                    </div>
                </div>
            </section>
            <?php
            if ($this->session->userdata('admin_logged_in'))
            {
            ?>
                <footer class="site-footer">
                    <p class="text-right"><?php echo '&#169;&nbsp;'. date('Y') .'&nbsp;Solitaire Infosys';?></p>
                    
                    <?php
                        echo js('backend/bootstrap.min.js');
                        echo js('backend/jquery.dcjqaccordion.2.7.js');
                        echo js('backend/scrollTo.min.js');
                        echo js('backend/nicescroll.js');
                        echo js('backend/common-scripts.js');
                    ?>

                    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
                </footer>
            <?php
            }
            ?>
        </section>
    </body>
</html>
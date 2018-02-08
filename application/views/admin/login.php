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

            $favicon = 'assets/img/favicon.ico';
            if (array_key_exists('company_favicon', $general_settings))
            {
                $favicon = $general_settings['company_favicon'];
            }

            $company_logo = 'assets/img/logo.png';
            if (array_key_exists('company_logo', $general_settings))
            {
                $company_logo = $general_settings['company_logo'];
            }

            echo css('backend/bootstrap.css');
            echo css('backend/style.css');
            echo css('backend/style-responsive.css');

            echo js('backend/jquery-3.2.1.min.js');
        ?>

		<link rel="icon" href="<?php echo base_url($favicon); ?>">
        <title>Admin - <?php echo $general_settings['company_name']; ?></title>
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
            <section class="wrapper login-main-body" style="background: url(<?php echo base_url('assets/img/admin_login_bg.jpg'); ?>) no-repeat center center;">
                <div class="row">
                    <div class="col-lg-5 exact_center">
                        <form class="form-login" action="<?php echo base_url('admin/login'); ?>" method="POST">
                            <a href="javascript:void(0);" class="login_for_logo">
                                <img src="<?php echo base_url($company_logo); ?>" alt="Logo">
                            </a>
                            <h4 class="text-center col-xs-12">Welcome to Admin Panel</h4>
                            <div class="login-wrap">
                                <input type="text" class="form-control" name="email" placeholder="Email">
                                <br>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <br>

                                <button type="submit" class="btn btn-primary form-control">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </section>
        <footer class="site-footer">
            <div class="col-xs-12">
                <span class="pull-left">&#169;&nbsp;2018&nbsp;Coupon Zipcode</span>
                <span class="pull-right">
                    <small>Designed by:&nbsp;</small>
                    <a href="http://www.slinfy.com" target="_blank">Solitaire Infosys</a>
                </span>
            </div>
        </footer>
    </body>
</html>
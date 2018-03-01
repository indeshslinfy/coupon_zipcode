<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Solitaire Infosys">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"> 
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<?php
		echo css('frontend/style.css');
		echo css('frontend/owl.carousel.css');
		echo css('frontend/responsive.css');
		echo iplugin('easy_autocomplete', array('file_name' => 'easy-autocomplete', 'file_type' => 'css'));
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

		$current_location = json_decode($this->input->cookie('user_current_location'), true);
	?>

	<title><?php echo isset($title) && $title != "" ? $title . "&nbsp;-&nbsp;" : ""; ?><?php echo $general_settings['company_name']; ?></title>
	<link rel="icon" href="<?php echo base_url($favicon); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		var BASEURL = '<?php echo base_url(); ?>';
		var NY_LOCN = '<?php echo json_encode(array("lat" => NY_LAT, "long" => NY_LONG, "zipcode" => NY_ZIPCODE)); ?>';
		$(document).ready(function()
		{
			<?php
			if (sizeof($current_location) == 0)
			{
			?>
				var user_current_location = '<?php print_r(json_encode($current_location)); ?>';
				getLocation();
			<?php
			}
			?>
		});
	</script>
</head>
<body>
	<div class="container-fluid">
		<div class="row header_location_bar">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="login_signup_btn_box">
							<ul class="pull-left header_location_ul">
								<li>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#select_location_popup">
										<i class="fa fa-map-marker"></i>&nbsp;Select location&nbsp;
										<span>
											<?php
											if($current_location)
											{
												echo $current_location['zipcode'];
											}
											?>
										</span>
									</a>
								</li>
							</ul>
							<ul class="pull-right">
								<li class="hidden-xs">
									<a href="<?php echo base_url('how-it-works'); ?>">How it works</a>
								</li>

								<li class="hidden-xs">
									<a href="<?php echo base_url('advertise'); ?>">Advertise with us</a>
								</li>
								<?php
								if ($this->session->userdata('logged_in'))
								{
								?>
									<li>
										<a href="<?php echo base_url('logout'); ?>" >Logout</a>
									</li>
								<?php
								}
								else
								{
								?>
									<li>
										<a href="<?php echo base_url('login') . '#signup'; ?>" class="visible-xs"><i class="fa fa-lock"></i>Login / Signup</a>
										<a href="<?php echo base_url('login'); ?>" class="hidden-xs"><i class="fa fa-lock"></i>Login / Signup</a>
									</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<header>

			<div class="row topheader">
				<div class="container">
					<div class="row">
						<div class="col-xs-7 col-sm-3 col-md-2 col-lg-2">
							<a href="<?php echo base_url('/'); ?>">
								<img src="<?php echo base_url($company_logo); ?>" alt="Coupon Zipcode">
							</a>
						</div>
						<div class="col-xs-12 col-sm-9 col-lg-10 col-md-10 mobile_to_center search_form_wrap">
							<form class="form-inline topheader_srch_frm" action="<?php echo base_url('deals'); ?>">
								<div class="form-group serach_ct_field city_box">
									<div class="input_box_wrap">
										<span><i class="fa fa-search"></i></span>
										<input type="hidden" name="search_src" value="header">
										<input type="text" class="form-control top-srch-cat" placeholder="Category" value="<?php echo isset($_GET['cat_name']) ? $_GET['cat_name'] : ''; ?>" id="top-srch-cat-name">
										<input type="hidden" id="top-srch-cat" name="cat_name" value="<?php echo isset($_GET['cat_name']) ? $_GET['cat_name'] : ''; ?>">
									</div>
								</div>
								<!-- <div class="form-group city_box">
									<div class="input_box_wrap">
										<span>In</span>
										<input type="text" class="form-control" placeholder="City" name="city_name" value="<?php echo isset($_GET['city_name']) ? $_GET['city_name'] : ''; ?>">
									</div>
								</div> -->
								<div class="form-group nearby">
									<div class="input_box_wrap">
										<span>Near</span>
										<input type="text" class="form-control top-srch-zipcode" placeholder="Zipcode">
										<input type="hidden" name="store_zipcode" class="store_zipcode_id_hidden">
									</div>
								</div>

								<button type="submit" class="btn ylew_btn onhover_button"><i class="fa fa-search"></i></button>
								<button type="button" class="btn ylew_btn onhover_button"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="navigation_bar row">
				<div class="container">
					<div class="row">
						<nav class="navbar navbar-default" role="navigation">
							<div class="navbar-header">
								<!-- <button type="button" class="navbar-toggle location_button" data-toggle="collapse" data-target=".search_form_wrap">
									<i class="fa fa-search fa-xs" aria-hidden="true"></i>
								</button> -->
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
								</button> 
							</div>

							<div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
								<a class="visible-sm visible-md toggle-tab-menu" href="javascript:void(0);" onclick="toggle_menu();">
									<i class="fa fa-angle-down"></i>
								</a>
								<ul class="nav navbar-nav toggle-menu-height">
									<?php
									$menu_categories = get_settings('frontend_menu');
									foreach ($menu_categories as $keyMC => $valueMC)
									{
									?>
										<li class="<?php echo $this->uri->segment(2) == $valueMC['slug'] ? 'active' : ''; ?>">
											<a href="<?php echo base_url('category/' . $valueMC['slug']); ?>"><?php echo $valueMC['name']; ?></a>
										</li>
									<?php
									}
									?>
									<li>
										<a href="<?php echo base_url('category'); ?>">More</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header>
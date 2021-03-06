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
			echo iplugin('datatable', array('file_name' => 'dataTables.bootstrap.min', 'file_type' => 'css'));

			echo iplugin('easy_autocomplete', array('file_name' => 'easy-autocomplete', 'file_type' => 'css'));

			echo js('backend/jquery-3.2.1.min.js');
		?>

		<title><?php echo isset($page_title) && $page_title != "" ? $page_title . "&nbsp;-&nbsp;" : ""; ?> <?php echo $general_settings['company_name']; ?> Admin</title>
		
		<link rel="icon" href="<?php echo base_url($favicon); ?>" >
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<script type="text/javascript">
			var BASEURL = '<?php echo base_url(); ?>';
			var ADMIN_PREFIX = '<?php echo ADMIN_PREFIX; ?>';
		</script>
	</head>
	<body>
		<section id="container">
			<?php
			if ($this->session->userdata('admin_logged_in'))
			{
			?>
				<header class="header black-bg">
					<a href="<?php echo base_url(ADMIN_PREFIX); ?>" class="logo">
						<?php echo $general_settings['company_name']; ?>
						<small>
							<small>&nbsp;Admin</small>
						</small>
					</a>

					<div class="top-menu">
						<ul class="nav pull-right top-menu">
							<li><a class="logout btn btn-sm" href="<?php echo base_url(ADMIN_PREFIX . '/logout'); ?>">Logout</a></li>
						</ul>
					</div>
				</header>

				<aside>
					<div id="sidebar" class="nav-collapse">
						<ul class="sidebar-menu" id="nav-accordion">
							<li>
								<a class="<?php echo $this->uri->segment(2) ? '' : 'active'; ?>" href="<?php echo base_url(ADMIN_PREFIX); ?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>

							<li>
								<a class="<?php echo ($this->uri->segment(2) == 'users' || $this->uri->segment(2) == 'add-user' || $this->uri->segment(2) == 'edit-user') ? 'active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/users'); ?>">
									<i class="fa fa-users"></i>
									<span>Users Management</span>
								</a>
							</li>

							<li class="dropdown-submenu">
								<a class="<?php echo ($this->uri->segment(2) == 'stores' || $this->uri->segment(2) == 'stores-category' || $this->uri->segment(2) == 'add-store' || $this->uri->segment(2) == 'edit-store' || $this->uri->segment(2) == 'add-store-category' || $this->uri->segment(2) == 'edit-store-category' || $this->uri->segment(2) == 'store-reviews' ) ? 'active' : ''; ?>" tabindex="-1" href="#" title="Stores Management">
									<i class="fa fa-building-o"></i>
									<span>Stores Management</span>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a class="<?php echo ($this->uri->segment(2) == 'stores-category' || $this->uri->segment(2) == 'add-store-category' || $this->uri->segment(2) == 'edit-store-category') ? 'sub-cat-active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/stores-category'); ?>">
											<i class="fa fa-tags"></i>
											<span>Categories</span>
										</a>
									</li>
									<li>
										<a class="<?php echo ($this->uri->segment(2) == 'stores' || $this->uri->segment(2) == 'add-store' || $this->uri->segment(2) == 'edit-store') ? 'sub-cat-active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>">
											<i class="fa fa-building-o"></i>
											<span>Stores</span>
										</a>
									</li>
									<li>
										<a class="<?php echo $this->uri->segment(2) == 'store-reviews' ? 'sub-cat-active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/store-reviews/') . REVIEW_TYPE_STORE; ?>">
											<i class="fa fa-building-o"></i>
											<span>Store Reviews</span>
										</a>
									</li>
								</ul>
							</li>

							<li>
								<a class="<?php echo ($this->uri->segment(2) == 'coupons' || $this->uri->segment(2) == 'add-coupon' || $this->uri->segment(2) == 'edit-coupon') ? 'active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/coupons'); ?>">
									<i class="fa fa-money"></i>
									<span>Coupons Management</span>
								</a>
							</li>

							<li>
								<a class="<?php echo ($this->uri->segment(2) == 'tickets' || $this->uri->segment(2) == 'edit-ticket') ? 'active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/tickets'); ?>">
									<i class="fa fa-ticket"></i>
									<span>Tickets Management</span>
								</a>
							</li>

							<li>
								<a class="<?php echo $this->uri->segment(2) == 'menus' ? 'active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/menus'); ?>">
									<i class="fa fa-bars"></i>
									<span>Menu Management</span>
								</a>
							</li>

							<li class="dropdown-submenu">
								<a class="<?php echo ($this->uri->segment(2) == 'popular-categories' || $this->uri->segment(2) == 'featured-stores' ) ? 'active' : ''; ?>" tabindex="-1" href="#" title="Stores Management">
									<i class="fa fa-building-o"></i>
									<span>Featured Management</span>
								</a>
								<ul class="dropdown-menu">
									<!-- <li>
										<a class="<?php echo $this->uri->segment(2) == 'popular-categories' ? 'sub-cat-active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/popular-categories'); ?>">
											<i class="fa fa-certificate"></i>
											<span>Popular Categories</span>
										</a>
									</li> -->
									<li>
										<a class="<?php echo $this->uri->segment(2) == 'featured-stores' ? 'sub-cat-active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/featured-stores'); ?>">
											<i class="fa fa-building-o"></i>
											<span>Featured Stores</span>
										</a>
									</li>
								</ul>
							</li>

							<li>
								<a class="<?php echo $this->uri->segment(2) == 'settings' ? 'active' : ''; ?>" href="<?php echo base_url(ADMIN_PREFIX . '/settings'); ?>">
									<i class="fa fa-gears"></i>
									<span>Settings Management</span>
								</a>
							</li>
						</ul>
					</div>
				</aside>
			<?php
			}
			?>
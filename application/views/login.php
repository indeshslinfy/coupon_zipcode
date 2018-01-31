<div class="row">
	<section class="login_section">
		<div class="container">
			<div class="row">
				<div class="login_form_section col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="col-md-5 login_wrap">
						<h2 class="text-center text-uppercase">Login</h2>
						<div class="col-xs-12">
							<div class="row">
							<?php
							if($this->session->flashdata('flash_error_login'))
							{
							?>
								<div class="alert alert-danger">
									<p class="text-center"><?php echo $this->session->flashdata('flash_error_login'); ?></p>
								</div>
							<?php
							}
							?>
							</div>
						</div>

						<form action="<?php echo base_url('login'); ?>" method="POST">
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email address*" required="" name="email">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Password*" required="" name="password">
							</div>
							<div class="form-group alert alert-success login_benefits">
								<span>Login and enjoy super deals inside.</span>
							</div>
							<div class="checkbox">
								<div class="row">
									<!-- <div class="col-xs-6">
										<label><input type="checkbox">&nbsp;Remember me</label>
									</div> -->
									<div class="col-xs-12 text-right">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#forget_password_modal">Forgot Password?</a>
									</div>
								</div>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-default ylew_btn login-btn">Login</button>
							</div>
						</form>
					</div>
					
					<div class="col-md-7 signup_wrap" id="signup">
						<h2 class="text-center text-uppercase">Sign up</h2>
						<div class="col-xs-12">
							<div class="row">
							<?php
							if($this->session->flashdata('flash_error_signup'))
							{
							?>
								<div class="alert alert-danger">
									<p class="text-center"><?php echo $this->session->flashdata('flash_error_signup'); ?></p>
								</div>
							<?php
							}
							elseif($this->session->flashdata('flash_success_signup'))
							{
							?>
								<div class="alert alert-success">
									<p class="text-center"><?php echo $this->session->flashdata('flash_success_signup'); ?></p>
								</div>
							<?php
							}
							?>
							</div>
						</div>

						<form action="<?php echo base_url('signup'); ?>" method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="First Name*" name="first_name" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Last Name*" name="last_name" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" class="form-control" placeholder="Email Address*" name="email" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Zipcode*" name="zipcode_id">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="password" class="form-control" placeholder="Password*" name="password" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="password" class="form-control" placeholder="Confirm Password*" name="confirm_password" required="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="checkbox" name="tnc">
								<span>I Accept the Terms and Conditions</span>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-default ylew_btn">Sign up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>			
	</section>
</div>

<div id="forget_password_modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Recover Password</h4>
			</div>
			<div class="modal-body">
				<form id="forget_pwd_form">
					<div class="form-group">
						<input type="email" name="forget_pwd_email" class="form-control" placeholder="Email*">
					</div>
					<div class="form-group">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="forget_pwd_btn" class="btn green_btn">Send Recovery Email</button>
			</div>
		</div>
	</div>
</div>
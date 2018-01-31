<?php
/*$this->load->helper('captcha');
$vals = array('img_path' => plugin_path() . 'captcha/',
			'img_url' => plugin_url() . 'captcha/',
			'img_width' => 120,
			'img_height' => 40,
			'img_id' => 'Imageid',
			'expiration' => 600, //10 minutes
			'word_length' => 5,
			'font_path' => 'https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700',
			'font_size' => 36,
			'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    		// White background and border, black text and red grid
		    'colors' => array('background' => array(49, 64, 64),
							'border' => array(0, 0, 0),
							'text' => array(255, 255, 255),
							'grid' => array(34, 111, 5)));

$cap = create_captcha($vals);*/
?>
<div class="row">
	<section class="heading_page cntct_us_wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
						<?php
						if ($this->uri->segment(1) == 'contact-us')
						{
							$ticket_type = TICKET_TYPE_CONTACT;
							echo "<h2>CONTACT US</h2><p>If you still can't find an answer to your question, write to us using the form below and we'll try our best to get back to you.</p>";
						}
						elseif ($this->uri->segment(1) == 'advertise')
						{
							$ticket_type = TICKET_TYPE_ADVERTISE;
							echo "<h2>Advertise With Us</h2><p>Interested in advertise with us? Come join us.</p>";
						}
						?>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?php
					if($this->session->flashdata('error_msg'))
					{
					?>
						<div class="alert alert-danger"><?php echo $this->session->flashdata('error_msg');?></div>
					<?php
					}
					elseif($this->session->flashdata('success_msg'))
					{
					?>
						<div class="alert alert-success"><?php echo $this->session->flashdata('success_msg');?></div>
					<?php 
					}
					elseif ($this->session->flashdata('validation_errs'))
					{
						echo $this->session->flashdata('validation_errs');
					}
					?>
				</div>

				<form id="contact_us_form" method="POST" action="" class="contact_us_page">
					<input type="hidden" name="ticket_type" value="<?php echo $ticket_type; ?>">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="First Name*" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Last Name*" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email Address*" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<input type="text" name="phone_number" class="form-control" value="<?php echo set_value('phone_number'); ?>" placeholder="Phone*" required>
						</div>
						<div class="form-group">
							<input type="text" name="subject" class="form-control" value="<?php echo set_value('subject'); ?>" placeholder="Subject*" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-8">
						<div class="form-group">
							<textarea name="message" class="form-control" placeholder="Message*" rows="4" required><?php echo set_value('message'); ?></textarea>
						</div>
					</div>
					<!-- <div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<label>Captcha</label>
							<div class="contact_captacha_div"><?php //echo $cap['image']; ?></div>
						</div>
					</div> 
					<div class="col-xs-12 col-sm-4">
						<div class="form-group">
							<input type="text" name="captcha_response" class="form-control" placeholder="Enter Captcha Here...">
						</div>
					</div> -->
					<div class="col-xs-12 col-sm-4">
						<div class="form-group"> 
							<input type="submit" name="" value="SUBMIT" class="btn ylew_btn">
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>

<!-- <div class="row">
	<footer>
		<div class="container">
			<div class="row footer_wrap">
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 online_coupan_link">
					<h3>Online Coupons</h3>
					<ul>
						<li>
							<a href="">Angie's List</a>
						</li>
						<li>
							<a href="">Ann Taylor</a>
						</li>
						<li>
							<a href="">Athleta</a>
						</li>
						<li>
							<a href="">Bluefly</a>
						</li>
						<li>
							<a href="">Brooks Brothers</a>
						</li>
						<li>
							<a href="">Eddie Bauer</a>
						</li>
					</ul>
					<ul>
						<li>
							<a href="#">Express</a>
						<li>
							<a href="#">Gap</a>
						<li>
						<li>
							<a href="#">Home</a>
						<li>
						<li>
							<a href="#">Depot</a>
						<li>
						<li>
							<a href="#">Hotels.com</a>
						<li>
						<li>
							<a href="#">LOFT</a>
						<li>
					</ul>
					<ul>
						<li>
							<a href="#">Old Navy</a>
						</li>
						<li>
							<a href="#">Priceline</a>
						</li>
						<li>
							<a href="#">Sears</a>
						</li>
						<li>
							<a href="#">Sunglass Hut</a>
						</li>
						<li>
							<a href="#">Under Armour</a>
						</li>
						<li>
							<a href="#">Vistaprint </a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2">
					<h3>Cities</h3>
					<ul>
						<li>
							<a href="#">City Directory</a>
						</li>
						<li>
							<a href="#">New York</a>
						</li>
						<li>
							<a href="#">Los Angeles</a>
						</li>
						<li>
							<a href="#">San Francisco</a>
						</li>
						<li>
							<a href="#">Miami</a>
						</li>
						<li>
							<a href="#">Chicago</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 left_side_line">
					<h3>Links</h3>
					<ul>
						<li>
							<a href="#">Dining & Nightlife</a>
						</li>
						<li>
							<a href="#">Health & Beauty</a>
						</li>
						<li>
							<a href="#">Activities & Events</a>
						</li>
						<li>
							<a href="#">Fitness</a>
						</li>
						<li>
							<a href="#">Shop</a>
						</li>
						<li>
							<a href="#">Travel</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<h3>Help & Support</h3>
					<ul>
						<li>
							<a href="contact_us.html">Contact Us</a>
						</li>
						<li>
							<a href="#">Jobs</a>
						</li>
						<li>
							<a href="#">Press</a>
						</li>
						<li>
							<a href="#">Terms and Conditions</a>
						</li>
						<li>
							<a href="#">Privacy</a>
						</li>
						<li>
							<a href="#">FAQ</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<div class="footer_copy_right text-center">&copy; 2017 coupon zipcode inc.</div>
</div> -->
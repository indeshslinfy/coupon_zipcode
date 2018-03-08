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
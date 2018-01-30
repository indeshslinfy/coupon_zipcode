<?php //print_r($ticket_details); die; ?>
<div class="row">
	<section class="ticketing_wrap">
		<div class="container">
			<h3>Support</h3>
			<?php
            if($this->session->flashdata('flash_message'))
            {
            ?>
                <div class="alert alert-success">
                    <p class="text-center"><?php echo $this->session->flashdata('flash_message'); ?></p>
                </div>
            <?php
            }

            if($this->session->flashdata('flash_error'))
            {
            ?>
                <div class="alert alert-danger">
                    <p class="text-center"><?php echo $this->session->flashdata('flash_error'); ?></p>
                </div>
            <?php
            }
            ?>
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-9">
					<div class="ticketing_wrap_detail">
						<h4 class="ticketing_heading_wrap">Ticket No. : <span>#<?php echo $this->uri->segment(2); ?></span></h4>
						<div class="ticketing_subjct_wrap">
							<label>Subject :</label>
							<span><?php echo $ticket_details['subject']; ?> </span>
						</div>
						<div class="ticketing_chatbox_wrap">
							<?php
                                foreach ($ticket_details['messages'] as $keyMessages => $valueMessages) 
                                {
                                    $user_img = img('no-user.png', array('class' => 'img-responsive img-circle'));
                                    $user_str = $ticket_details['first_name'];
                                    if (strlen($user_str) > 6) 
                                    {
                                    	$user_str = limit_string($user_str,6);
                                    }
                                    if ($valueMessages['is_admin_sender']) 
                                    {
                                        $user_str = "Admin";
                                        $user_img = img('admin-image.png', array('class' => 'img-responsive img-circle'));
                                    }
                            ?>
							<div class="ticketing_message_wrap_box">
								<div class="ticketing_message_wrap_user_img text-center">
									<?php echo $user_img; ?>
									<p style="font-weight: 600;"><?php echo $user_str; ?></p>
									<span class="date_stamp"><?php echo date('M d H:i A', strtotime($valueMessages['created_at'])); ?></span>
								</div>
								<div class="ticketing_message_box">
									<div class="ticketing_message_box_desc">
										<p><?php echo $valueMessages['message']; ?></p>
									</div>
								</div>
							</div>
							<?php
                            }
                            ?>
						</div>
						<form action="<?php echo base_url('save-ticket') . '/' . base64_encode($ticket_details['id']); ?>" method="POST" enctype="multipart/form-data">
							<div class="col-sm-9">
								<div class="form-group">
									<textarea class="form-control" placeholder="Type your reply here..." name="message" required="required"></textarea>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="reply_btn_wrap">
									<div class="reply_btn_div">
										<input type="submit" value="reply" class="btn ylew_btn">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3">
					<h4 class="ticketing_heading_wrap text-center">Popular Coupons</h4>
					<div class="popular_coupon_list_wrap">
						<div class="popolar_coupon_list">
							<h5>25% off on Soccer jersey</h5>
							<p>Deal ends on 2 feb 2018</p>
							<a href="javascript:void(0);" class="btn ylew_btn">Get the deal now</a>
						</div>
						<div class="popolar_coupon_list">
							<h5>25% off on Soccer jersey</h5>
							<p>Deal ends on 2 feb 2018</p>
							<a href="javascript:void(0);" class="btn ylew_btn">Get the deal now</a>
						</div>
						<div class="popolar_coupon_list">
							<h5>25% off on Soccer jersey</h5>
							<p>Deal ends on 2 feb 2018</p>
							<a href="javascript:void(0);" class="btn ylew_btn">Get the deal now</a>
						</div>
						<div class="popolar_coupon_list">
							<h5>25% off on Soccer jersey</h5>
							<p>Deal ends on 2 feb 2018</p>
							<a href="javascript:void(0);" class="btn ylew_btn">Get the deal now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
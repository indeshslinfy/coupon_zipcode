<section class="wrapper stores_wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/tickets'); ?>">Tickets</a>
                </li>
                <li class="breadcrumb-item active">Edit Ticket</li>
            </ol>

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

            <div class="content_title">
                <h2>
                    <small>Edit Ticket</small>
                    <label>(<?php echo $ticket_details['subject']; ?>)</label>
                </h2>
            </div>

            <form class="mt-20 div_flt" action="<?php echo base_url(ADMIN_PREFIX . '/save-ticket') . '/' . $ticket_details['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-lg-12 ediable_form_by_admin">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5>Ticket <span>#<?php echo $ticket_details['id']; ?></span></h5>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Status:</label>
                                <span><?php echo $ticket_status; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Department:</label>
                                <span>
                                    <?php
                                        if ($ticket_details['ticket_type'] == TICKET_TYPE_CONTACT)
                                        {
                                            echo 'Contact us';
                                        }
                                        elseif ($ticket_details['ticket_type'] == TICKET_TYPE_ADVERTISE)
                                        {
                                            echo 'Advertise';
                                        }
                                        else
                                        {
                                            echo 'n/a';
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Created Date:</label>
                                <span><?php echo date('d-m-Y @ H:i',strtotime($ticket_details['created_at'])); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>User Name:</label>
                                <span><?php echo $ticket_details['first_name'] . ' ' . $ticket_details['last_name']; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <span><?php echo $ticket_details['email']; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Phone:</label>
                                <span><?php echo $ticket_details['phone_number']; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5>Subject: <span><?php echo $ticket_details['subject']; ?></span></h5>
                            <h5>Message: <span><?php echo $ticket_details['messages'][0]['message']; ?></span></h5>
                            <div class="form-group">
                                <label>Last Response:</label>
                                <span> <?php echo date('d-m-Y @ H:i',strtotime($ticket_details['last_message']['created_at'])); ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group select_wrap_box">
                                <label>Change Status</label>
                                <span class="drp_dwn_select">
                                    <select class="form-control" name="status">
                                        <option value="<?php echo TICKET_STATUS_OPEN; ?>" <?php echo $ticket_details['status'] == TICKET_STATUS_OPEN ? 'selected=selected' : ''; ?>>Opened</option>
                                        <option value="<?php echo TICKET_STATUS_CLOSE; ?>" <?php echo $ticket_details['status'] == TICKET_STATUS_CLOSE ? 'selected=selected' : ''; ?>>Closed</option>
                                        <option value="<?php echo TICKET_STATUS_ANSWER; ?>" <?php echo $ticket_details['status'] == TICKET_STATUS_ANSWER ? 'selected=selected' : ''; ?>>Answered</option>
                                    </select>
                                </span>
                                <div class="form-group text-right btn_wrap">
                                    <input type="submit" value="Update" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </form>
            
            <div class="col-md-7 col-md-push-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="chat_box_wrapper chat_box_small chat_box_active" id="" >
                                <a  class="view_ticket_thread" href="javascript:void(0);">View Ticket Thread</a>
                                    <div class="chat_box touchscroll chat_box_colors_a hide" id="chat_box">

                                        <?php
                                            foreach ($ticket_details['messages'] as $keyMessages => $valueMessages) 
                                            {
                                                $user_img = img('no-user.png', array('class' => 'img-responsive img-circle'));
                                                $user_str = $ticket_details['first_name'];
                                                if ($valueMessages['is_admin_sender']) 
                                                {
                                                    $user_str = "Admin";
                                                    $user_img = img('admin-image.png', array('class' => 'img-responsive img-circle'));
                                                }
                                        ?>
                                        <div class="chat_message_wrapper <?php echo $keyMessages%2 == 0 ? '' : 'chat_bg_even'; ?>">
                                            <div class="chat_user_avatar">
                                                <?php echo $user_img; ?>
                                                <p><?php echo $user_str; ?></p>
                                            </div>
                                            <ul class="chat_message">
                                                <li>
                                                    <p><span class="chat_message_time"><?php echo date('d-m-Y | H:i', strtotime($valueMessages['created_at'])); ?></span> </p>
                                                    <p><?php echo $valueMessages['message']; ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-pull-7">
                <form class="mt-20 div_flt" action="<?php echo base_url(ADMIN_PREFIX . '/save-ticket') . '/' . $ticket_details['id']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to send the message?');">
                    <div class="chat-message">
                        <div class="form-group">
                            <textarea class="onfocus_move form-control" placeholder="Write message..." name="message" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
            </div>
    </div>
</section>
<script type="text/javascript">
$(document).on('click','.view_ticket_thread',function(){
    $("div.chat_box").toggleClass('hide');
});
</script>
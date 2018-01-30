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

            <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-ticket') . '/' . $ticket_details['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-lg-5">
                    <div class="row">
						<div class="col-sm-12">
                            <div class="form-group">
                                <p><label>User Name:</label></p>
                                <p><span><?php echo $ticket_details['first_name'] . ' ' . $ticket_details['last_name']; ?></span></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <p><label>Email:</label></p>
                                <p><span><?php echo $ticket_details['email']; ?></span></p>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <p><label>Phone:</label></p>
                                <p><span><?php echo $ticket_details['phone_number']; ?></span></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <p><label>Subject:</label></p>
                                <p><?php echo $ticket_details['subject']; ?></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <p><label>Type:</label></p>
                                <p><span>
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
                                </span></p>
                            </div>
                        </div>

                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label>Message</label>
                                <p class="form-control"><?php echo $ticket_details['message']; ?></p>
                            </div>
                        </div> -->

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="<?php echo TICKET_STATUS_OPEN; ?>" <?php echo $ticket_details['status'] == TICKET_STATUS_OPEN ? 'selected=selected' : ''; ?>>Opened</option>
                                    <option value="<?php echo TICKET_STATUS_CLOSE; ?>" <?php echo $ticket_details['status'] == TICKET_STATUS_CLOSE ? 'selected=selected' : ''; ?>>Closed</option>
                                    <option value="<?php echo TICKET_STATUS_ANSWER; ?>" <?php echo $ticket_details['status'] == TICKET_STATUS_ANSWER ? 'selected=selected' : ''; ?>>Answered</option>
                                </select>
                            </div>
                        </div>
						
						<div class="col-sm-12">
                            <div class="form-group">
                                <p><label for="store_type">Created on:</label></p>
                                <p><span><?php echo $ticket_details['created_at'];?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <h4>Messages:</h4>
                                <?php
                                foreach ($ticket_details['messages'] as $keyMessages => $valueMessages) 
                                {
                                    $user_img = img('no-user.png', array('class' => 'img-responsive img-circle'));
                                    $user_str = $ticket_details['first_name'] . ' ' . $ticket_details['last_name'];
                                    if ($valueMessages['is_admin_sender']) 
                                    {
                                        $user_str = "Admin";
                                        $user_img = img('admin-image.png', array('class' => 'img-responsive img-circle'));
                                    }
                                ?>
                                    <div class="ticket-message-wrap col-xs-12 <?php echo $keyMessages%2 == 0 ? 'odd' : 'even'; ?> ">
                                        <div class="row">
                                            <div class="col-xs-12 form-group">
                                                <div class="row">
                                                    <div class="col-xs-7">
                                                        <div class="row">
                                                            <div class="col-xs-2"><?php echo $user_img; ?></div>
                                                            <div class="col-xs-4"><strong style="line-height:2.5;"><?php echo $user_str; ?></strong></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <span style="line-height:2.5;" class="pull-right"><?php echo date('d-m-Y | H:i', strtotime($valueMessages['created_at'])); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12"><?php echo $valueMessages['message']; ?></div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="panel-footer chat-message">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-10 col-md-11">
                                       <textarea class="onfocus_move form-control" placeholder="Write message..."></textarea>
                                    </div>
                                    <div class="col-xs-3 col-sm-2 col-md-1 pddl_0">
                                        <button class="btn btn-primary btn-block">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group text-right">
                        <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/tickets'); ?>">Cancel</a>
                        <a type="button" class="btn btn-success" href="<?php echo base_url(ADMIN_PREFIX . '/save-ticket/') . $ticket_details['id']; ?>">Update</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
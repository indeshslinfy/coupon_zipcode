<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Settings</li>
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
                <h2><small>Settings</small></h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#email_tab">Email</a></li>
                        <li><a data-toggle="tab" href="#general_tab">General</a></li>
                        <li><a data-toggle="tab" href="#third_party_tab">Third Party APPs</a></li>
                        <li><a data-toggle="tab" href="#misc_tab">Misc</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="email_tab">
                            <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-settings'); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="setting_type" value="settype_email" class="form-control">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Admin Email&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="email[admin_email]" value="<?php echo $email['admin_email']; ?>" class="form-control" required="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Admin Name&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="email[admin_name]" value="<?php echo $email['admin_name']; ?>" class="form-control" required="">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group text-right">
                                                <label>&nbsp;&nbsp;</label><br>
                                                <button type="submit" class="btn btn-success">Update Email Settings</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="general_tab">
                            <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-settings'); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="setting_type" value="settype_general" class="form-control">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Company Name&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="general_settings[company_name]" value="<?php echo $general_settings['company_name']; ?>" class="form-control" required="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
    										<div class="form-group ">
    											<label class="control-label">Company Logo&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(.png file only | Max 500 x 500)</small></label>
    											<input type="file" name="company_logo" value="<?php echo @$general_settings['company_logo']; ?>" class="file-upload" id="uploadLogo" accept="image/x-png">
                                                <br>
    											<img src="<?= base_url($general_settings['company_logo']) ?>" class="img-responsive thumbnail"/>
    										</div>
                                        </div>
    									
    									<div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Favicon&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(.ico file only)</small></label>
    											<input type="file" name="company_favicon" value="<?php echo @$general_settings['company_favicon']; ?>" class="file-upload" id="uploadFavicon">
    											<br>
                                                <img src="<?= base_url($general_settings['company_favicon']) ?>" class="img-responsive thumbnail"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <label>&nbsp;&nbsp;</label><br>
                                        <button type="submit" class="btn btn-success">Update General Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="misc_tab">
                            <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-settings'); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="setting_type" value="settype_misc" class="form-control">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Zipcode Search Radius&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="zipcode_search_radius" value="<?php echo $zipcode_search_radius; ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <label>&nbsp;&nbsp;</label><br>
                                        <button type="submit" class="btn btn-success">Update Misc Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="third_party_tab">
                            <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-settings'); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="setting_type" value="settype_third_party" class="form-control">
                                <div class="col-lg-12">
                                    <h4>Google</h4>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Google Map API Key&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="google_map_key" value="<?php echo $google_map_key; ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    <h4>Groupon</h4>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Groupon Api Key&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="groupon[groupon_id]" value="<?php echo $groupon['groupon_id']; ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Groupon Media ID&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="groupon[media_id]" value="<?php echo $groupon['media_id']; ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <h4>Ebay</h4>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ebay APP ID&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="ebay[app_id]" value="<?php echo $ebay['app_id']; ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Ebay Camp ID&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="ebay[camp_id]" value="<?php echo $ebay['camp_id']; ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <label>&nbsp;&nbsp;</label><br>
                                        <button type="submit" class="btn btn-success">Update Misc Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var all_zipcodes ='<?php echo json_encode(get_zipcodes()); ?>';
</script>

<section class="wrapper coupons_wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/coupons'); ?>">Coupons</a>
                </li>
                <li class="breadcrumb-item active">Add Coupon</li>
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
                <h2><small>Add Coupon</small></h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-coupon'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Zipcode&nbsp;
                                        <small class="text-danger">*</small>
<!--                                         <a class="pull-right btn btn-xs btn-default" onclick="toggle_new_div_zip();">
                                            <small><i class="fa fa-plus text-success"></i>&nbsp;Add New</small>
                                        </a> -->
                                    </label>
                                    <!-- <select name="coupon_zipcode_id" class="form-control" required="" onchange="get_zipcode_stores(this);" id="coupon_zipcode_id">
                                        <option value="" >--Select Zipcode--</option>
                                        <?php
                                        foreach($all_zipcodes as $keyAZ => $valueAZ)
                                        {
                                        ?>
                                            <option value="<?php echo $valueAZ['id']; ?>"><?php echo $valueAZ['zipcode']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select> -->

                                    <input type="text" class="form-control coupon_zipcode" id="coupon_zipcode" required="">
                                    <input type="hidden" name="coupon_zipcode_id" id="coupon_zipcode_id" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Stores&nbsp;<small class="text-danger">*</small></label>
                                    <select name="coupon_store_id" class="form-control" required="" id="coupon_store_id">
                                        <option value="" >--Select Store--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 hide add-new-zip-div form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Enter new zipcode here..." class="input-xs pull-left form-control" id="new_zip_input">
                                        <button type="button" class="btn btn-xs btn-success pull-right" onclick="save_new_zip();">Save</button>
                                        <button type="button" class="btn btn-xs btn-default pull-right" onclick="toggle_new_div_zip();">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Coupon Title&nbsp;<small class="text-danger">*</small></label>
                                    <input type="text" name="coupon_title" class="form-control" required="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" name="coupon_code" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" name="coupon_start_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="text" name="coupon_end_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="7" name="coupon_description" class="form-control" placeholder="Coupon Description here..."></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fine Print</label>
                                    <textarea rows="7" name="coupon_fine_print" class="form-control" placeholder="Fine Print here..."></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Publish&nbsp;<small class="text-danger">*</small></label>
                                    <select class="form-control" name="coupon_publish" required="">
                                        <option value="1" selected="selected">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/coupons'); ?>">Cancel</a>
                                    <button type="submit" class="btn btn-success" id="update_coupon_btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var selected_zipcode_id = "0";
    var selected_store_id = "0";
</script>

<?php echo js('backend/coupons.js'); ?>
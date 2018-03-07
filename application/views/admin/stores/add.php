<script type="text/javascript">
    var all_zipcodes ='<?php echo json_encode(get_zipcodes()); ?>';
</script>

<section class="wrapper stores_wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>">Stores</a>
                </li>
                <li class="breadcrumb-item active">Add Store</li>
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
                <h2><small>Add Store</small></h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#show_basic_tab">Basic</a></li>
                        <li><a data-toggle="tab" href="#show_menus_tab">Menus</a></li>
                        <li><a data-toggle="tab" href="#show_media_tab">Media</a></li>
                        <li><a data-toggle="tab" href="#show_schedule_tab">Schedule</a></li>
                    </ul>

                    <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-store'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="show_basic_tab">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Store Name&nbsp;<small class="text-danger">*</small></label>
                                        <input type="text" name="store_name" class="form-control" pattern="^(?!\s*$).+" required="">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone&nbsp;<small class="text-danger">*</small></label>
                                        <input type="text" name="store_phone" class="form-control" pattern="^(?!\s*$).+" required="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="store_email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="store_website" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="store_category_id">Category&nbsp;<small class="text-danger">*</small></label>
                                        <select name="store_category_id" class="form-control" required="">
                                            <option value="">--Select Category--</option>
                                            <?php
                                            foreach($all_store_categories as $keyASC => $valueASC)
                                            {
                                                
                                            ?>
                                                <option value="<?php echo $valueASC['id']; ?>"><?php echo $valueASC['store_category_name']; ?></option>;
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="store_type">Type&nbsp;<small class="text-danger">*</small></label>
                                        <input type="text" name="store_type" class="form-control" pattern="^(?!\s*$).+" required="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status&nbsp;<small class="text-danger">*</small></label>
                                        <select class="form-control" name="status" required="">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="store_fb_url" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" name="store_tw_url" class="form-control">
                                    </div>
                                </div>

                                <div id="store_featured_img_div" class="store_featured_img_div col-sm-6">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Featured Image&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(Max 5MB)</small></label>
                                            <input type="file" name="store_featured_image" accept="image/*" required="">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="7" name="store_description" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h4 class="heading">Address</h4>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_latitude">Address Line 1&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="address[address_line1]" class="form-control" pattern="^(?!\s*$).+" required="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_latitude">Address Line 2</label>
                                                <input type="text" name="address[address_line2]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_latitude">Address Line 3</label>
                                                <input type="text" name="address[address_line3]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="store_latitude">Country&nbsp;<small class="text-danger">*</small></label>
                                                <select class="form-control" name="address[address_country_id]" required="">
                                                    <?php
                                                    foreach ($all_countries as $keyAC => $valueAC)
                                                    {
                                                    ?>
                                                        <option value="<?php echo $valueAC['id']; ?>" selected="selected"><?php echo $valueAC['country_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="store_latitude">State&nbsp;<small class="text-danger">*</small></label>
                                                <select class="form-control" name="address[address_state_id]" required="" onchange="get_cities(this);">
                                                    <option value="">--Select State--</option>
                                                    <?php
                                                    foreach ($all_states as $keyAS => $valueAS)
                                                    {
                                                    ?>
                                                        <option value="<?php echo $valueAS['id']; ?>"><?php echo $valueAS['state_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="store_latitude">City&nbsp;<small class="text-danger">*</small></label>
                                                <select class="form-control" name="address[address_city_id]" required="" id="address_city_id">
                                                    <option>--Select City--</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="store_latitude">Zipcode&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" class="form-control store_zipcode" id="store_zipcode" pattern="^(?!\s*$).+" required="">
                                                <input type="hidden" name="store_zipcode_id" id="store_zipcode_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>">Cancel</a>
                                        <a type="button" class="btn btn-default" href="javascript:void(0);" onclick="navigate_show_tabs('show_menus_tab');"><i class="fa fa-caret-right"></i>&nbsp;Next</a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="show_menus_tab">
                                <div id="store_menu_div" class="store_menu_div">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Menu&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(Max 5MB)</small></label>
                                            <input type="file" name="store_menu[]" multiple="" accept="image/*" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <a type="button" class="btn btn-default" href="javascript:void(0);" onclick="navigate_show_tabs('show_basic_tab');"><i class="fa fa-caret-left"></i>&nbsp;Back</a>
                                        <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>">Cancel</a>
                                        <a type="button" class="btn btn-default" href="javascript:void(0);" onclick="navigate_show_tabs('show_media_tab');"><i class="fa fa-caret-right"></i>&nbsp;Next</a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="show_media_tab">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 row">
                                        <div class="form-group">
                                            <label>Video URL&nbsp;&nbsp;<small>(YouTube URL)</small></label>
                                            <input type="text" name="store_video[]" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div id="store_image_div" class="store_image_div">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Image&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(Max 5MB)</small></label>
                                            <input type="file" name="store_image[]" multiple="" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <a type="button" class="btn btn-default" href="javascript:void(0);" onclick="navigate_show_tabs('show_menus_tab');"><i class="fa fa-caret-left"></i>&nbsp;Back</a>
                                        <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>">Cancel</a>
                                        <a type="button" class="btn btn-default" href="javascript:void(0);" onclick="navigate_show_tabs('show_schedule_tab');"><i class="fa fa-caret-right"></i>&nbsp;Next</a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="show_schedule_tab">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <div class="col-sm-12"> -->
                                                <div class="form-group">
                                                    <label>Schedule <small class="text-danger">(Leave boxes empty in case of 'Store Closed'.)</small></label>
                                                </div>
                                            <!-- </div> -->
                                            <div class="table-responsive schedule_table">
                                                <table cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                    </tr>
                                                    <?php
                                                    $week_days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
                                                    foreach ($week_days as $keyWD => $valueWD)
                                                    {
                                                    ?>
                                                    <tr class="store_schedule_tp">
                                                        <td><?php echo ucfirst($valueWD); ?></td>
                                                        <td><input type="text" class="form-control time start" name="store_schedule[<?php echo $valueWD; ?>][]"></td>
                                                        <td><input type="text" class="form-control time end" name="store_schedule[<?php echo $valueWD; ?>][]"></td>
                                                    </tr>
                                                    <?php 
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <a type="button" class="btn btn-default" href="javascript:void(0);" onclick="navigate_show_tabs('show_media_tab');"><i class="fa fa-caret-left"></i>&nbsp;Back</a>
                                        <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>">Cancel</a>
                                        <button type="submit" class="btn btn-success" id="save_store_btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    echo iplugin('datepair', array('file_name' => 'jquery.timepicker.min', 'file_type' => 'css'));

    echo iplugin('datepair', array('file_name' => 'jquery.timepicker.min', 'file_type' => 'js'));
    echo iplugin('datepair', array('file_name' => 'datepair', 'file_type' => 'js'));
    echo iplugin('datepair', array('file_name' => 'jquery.datepair', 'file_type' => 'js'));
?>

<script type="text/javascript">
    var store_selected_city_id = "0";

    $(document).ready(function()
    {
        bind_timepair();
        bind_zipcode_autocomp();
    });
</script>

<?php echo js('backend/stores.js'); ?>
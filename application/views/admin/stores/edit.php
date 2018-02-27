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
                <li class="breadcrumb-item active">Edit Store</li>
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
                    <small>Edit Store</small>
                    <label>(<?php echo $store_details['store_name']; ?>)</label>
                </h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#show_basic_tab">Basic</a></li>
                        <li><a data-toggle="tab" href="#show_menus_tab">Menus</a></li>
                        <li><a data-toggle="tab" href="#show_media_tab">Media</a></li>
                        <li><a data-toggle="tab" href="#show_schedule_tab">Schedule</a></li>
                    </ul>

                    <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-store') . '/' . $store_details['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="show_basic_tab">
        						<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Store Name&nbsp;<small class="text-danger">*</small></label>
                                        <input type="text" name="store_name" value="<?php echo $store_details['store_name']; ?>" class="form-control" required="">
                                    </div>
                                </div>
        						
        						<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone&nbsp;<small class="text-danger">*</small></label>
                                        <input type="text" name="store_phone" value="<?php echo $store_details['store_phone']; ?>" class="form-control" required="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="store_email" class="form-control" value="<?php echo $store_details['store_email']; ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="store_website" value="<?php echo $store_details['store_website']; ?>" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="store_category_id">Category&nbsp;<small class="text-danger">*</small></label>
                                        <select name="store_category_id" class="form-control" required="">
                                            <option value="" >--Select Category--</option>
                                            <?php
                                            foreach($all_store_categories as $keyASC => $valueASC)
                                            {
                                                
                                            ?>
                                                <option value="<?php echo $valueASC['id']; ?>" <?php echo $store_details['store_category_id'] == $valueASC['id'] ? 'selected="selected"' : ''; ?>><?php echo $valueASC['store_category_name']; ?></option>;
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
        						
        						<div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="store_type">Type&nbsp;<small class="text-danger">*</small></label>
                                        <input type="text" name="store_type" value="<?php echo $store_details['store_type']; ?>" class="form-control" required="">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status&nbsp;<small class="text-danger">*</small></label>
                                        <select class="form-control" name="status" required="">
                                            <option value="1" <?php echo $store_details['status'] ? 'selected="selected"' : ''; ?>>Active</option>
                                            <option value="0" <?php echo !$store_details['status'] ? 'selected="selected"' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" name="store_fb_url" class="form-control" value="<?php echo $store_details['store_fb_url']; ?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input type="text" name="store_tw_url" class="form-control" value="<?php echo $store_details['store_tw_url']; ?>">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="7" name="store_description" class="form-control"> <?php echo $store_details['store_description']; ?></textarea>
                                    </div>
                                </div>
                                
                                <div id="store_featured_img_div" class="store_featured_img_div col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Featured Image&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(Max 5MB)</small></label>
                                                <input type="file" name="store_featured_image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img class="thumbnail img-responsive" src="<?php echo base_url($store_details['store_featured_image']); ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <h4 class="heading">Address</h4>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_latitude">Address Line 1&nbsp;<small class="text-danger">*</small></label>
                                                <input type="text" name="address[address_line1]" class="form-control" value="<?php echo $store_details['address']['address_line1']; ?>" required="">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_latitude">Address Line 2</label>
                                                <input type="text" name="address[address_line2]" value="<?php echo $store_details['address']['address_line2']; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="store_latitude">Address Line 3</label>
                                                <input type="text" name="address[address_line3]" value="<?php echo $store_details['address']['address_line3']; ?>" class="form-control">
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
                                                        <option value="<?php echo $valueAC['id']; ?>" <?php echo $store_details['address']['address_country_id'] == $valueAC['id'] ? 'selected="selected"' : ''; ?>><?php echo $valueAC['country_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="store_latitude">State&nbsp;<small class="text-danger">*</small></label>
                                                <select class="form-control" name="address[address_state_id]" required="" onchange="get_cities(this);" id="address_state_id">
                                                    <option value="">--Select State--</option>
                                                    <?php
                                                    foreach ($all_states as $keyAS => $valueAS)
                                                    {
                                                    ?>
                                                        <option value="<?php echo $valueAS['id']; ?>" <?php echo $store_details['address']['address_state_id'] == $valueAS['id'] ? 'selected="selected"' : ''; ?>><?php echo $valueAS['state_name']; ?></option>
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
                                                <input type="text" id="store_zipcode" value="<?php echo $store_details['store_zipcode']; ?>" class="form-control" required="">
                                                <input type="hidden" name="store_zipcode_id" id="store_zipcode_id" class="form-control" value="<?php echo $store_details['store_zipcode_id']; ?>">

                                                <input type="hidden" name="previous_zipcode_id" value="<?php echo $store_details['store_zipcode_id'] ?>">
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
                                            <input type="file" name="store_menu[]" multiple="" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php
                                            foreach ($store_details['store_menus'] as $keySM => $valueSM)
                                            {
                                            ?>
                                                <div class="col-sm-3">
                                                    <a title="Delete" class="del_item" href="javascript:void(0);" onclick="store_attach_delete(<?php echo $valueSM['id']; ?>, this);"><i class="fa fa-times"></i></a>
                                                    <img class="thumbnail img-responsive" src="<?php echo base_url($valueSM['attachment_path']); ?>">
                                                </div>
                                            <?php
                                            }
                                            ?>
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
                                    <?php
                                    foreach ($store_details['store_videos'] as $keySV => $valueSV)
                                    {
                                    ?>
                                        <div class="col-sm-6 row">
                                            <div class="form-group">
                                                <label>Video URL&nbsp;&nbsp;<small>(YouTube URL)</small></label>
                                                <input type="text" name="store_video[]" value="<?php echo $valueSV['attachment_path']; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <iframe width="350" height="200" src="<?php echo $valueSV['attachment_path']; ?>"></iframe> 
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div id="store_image_div" class="store_image_div">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Image&nbsp;<small class="text-danger">*</small>&nbsp;&nbsp;<small>(Max 5MB)</small></label>
                                            <input type="file" name="store_image[]" multiple="" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php
                                            foreach ($store_details['store_images'] as $keySI => $valueSI)
                                            {
                                            ?>
                                                <div class="col-sm-3">
                                                    <a title="Delete" class="del_item" href="javascript:void(0);" onclick="store_attach_delete(<?php echo $valueSI['id']; ?>, this);"><i class="fa fa-times"></i></a>
                                                    <img class="thumbnail img-responsive" src="<?php echo base_url($valueSI['attachment_path']); ?>">
                                                </div>
                                            <?php
                                            }
                                            ?>
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
                                                        $from = '';
                                                        $to = '';
                                                        if ($store_details['schedule'][$valueWD] != NULL && strpos($store_details['schedule'][$valueWD], ' - ') !== false)
                                                        {
                                                            $day_val = explode(" - ", $store_details['schedule'][$valueWD]);
                                                            $from = $day_val[0];
                                                            $to = $day_val[1];
                                                        }
                                                    ?>
                                                        <tr class="store_schedule_tp">
                                                            <td><?php echo ucfirst($valueWD); ?></td>
                                                            <td>
                                                                <input type="text" class="form-control time start" name="store_schedule[<?php echo $valueWD; ?>][]" value="<?php echo $from; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control time end" name="store_schedule[<?php echo $valueWD; ?>][]" value="<?php echo $to; ?>">
                                                            </td>
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
                                        <a class="btn btn-danger" href="javascript:void(0);" onclick="store_delete(<?php echo $store_details['id']; ?>);">Delete</a>
                                        <button type="submit" class="btn btn-success" id="update_store_btn">Update</button>
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
    var store_selected_city_id = "<?php echo $store_details['address']['address_city_id']; ?>";
    
    $(document).ready(function()
    {
        bind_timepair();
        bind_zipcode_autocomp();
    });
</script>

<?php echo js('backend/stores.js'); ?>
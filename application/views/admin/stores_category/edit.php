<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/stores-category'); ?>">Stores Category</a>
                </li>
                <li class="breadcrumb-item active">Edit Store Category</li>
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
                    <small>Edit Store Category</small>
                    <label>(<?php echo $store_cat_details['store_category_name']; ?>)</label>
                </h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-store-category') . '/' . $store_cat_details['id']; ?>" method="POST">
						
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Category Name&nbsp;<small class="text-danger">*</small></label>
                                <input type="text" name="store_category_name" value="<?php echo $store_cat_details['store_category_name']; ?>" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Keywords</label>
                                <input type="text" name="store_category_keywords" value="<?php echo $store_cat_details['store_category_keywords']; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea rows="4" name="store_category_description" placeholder="Store Category Description here..." class="form-control"><?php echo $store_cat_details['store_category_description']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status&nbsp;<small class="text-danger">*</small></label>
                                <select class="form-control" name="status" required="">
                                    <option value="1" >Active</option>
                                    <option value="0" <?php echo (!$store_cat_details['status']) ? 'selected="selected"' : ''; ?> >Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group text-right">
                                <label>&nbsp;&nbsp;</label><br>
                                <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/stores-category'); ?>">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
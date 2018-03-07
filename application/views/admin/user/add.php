<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/users'); ?>">Users</a>
                </li>
                <li class="breadcrumb-item active">Add User</li>
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
            ?>

            <div class="content_title">
                <h2><small>Add User</small></h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-user'); ?>" method="POST">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name&nbsp;<small class="text-danger">*</small></label>
                                <input type="text" name="first_name" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name&nbsp;<small class="text-danger">*</small></label>
                                <input type="text" name="last_name" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email&nbsp;<small class="text-danger">*</small></label>
                                <input type="email" name="email" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password&nbsp;<small class="text-danger">*</small></label>
                                <input type="text" name="password" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dob">D.O.B</label>
                                <input type="dob" name="dob" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="role">Role&nbsp;<small class="text-danger">*</small></label>
                                <select class="form-control" name="role_id" required="">
                                    <option value="">-- Select --</option>
                                    <?php
                                    foreach ($all_roles as $keyAR => $valueAR)
                                    {
                                    ?>
                                        <option value="<?php echo $valueAR['id']; ?>"><?php echo $valueAR['role_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status&nbsp;<small class="text-danger">*</small></label>
                                <select class="form-control" name="status" required="">
                                    <option value="<?php echo USER_STATUS_ACTIVE; ?>">Active</option>
                                    <option value="<?php echo USER_STATUS_INACTIVE; ?>">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group text-right">
                                <label>&nbsp;&nbsp;</label><br>
                                <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/users'); ?>">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
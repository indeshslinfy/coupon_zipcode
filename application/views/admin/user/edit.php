<!-- CDN Date Picker-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
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
                <li class="breadcrumb-item active">Edit User</li>
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
                <h2>
                    <small>Edit User</small>
                    <label>(<?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?>)</label>
                </h2>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <form class="mt-20" action="<?php echo base_url(ADMIN_PREFIX . '/save-user') . '/' . $user_details['id']; ?>" method="POST">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name&nbsp;<small class="text-danger">*</small></label>
                                <input type="text" name="first_name" value="<?php echo $user_details['first_name']; ?>" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name&nbsp;<small class="text-danger">*</small></label>
                                <input type="text" name="last_name" value="<?php echo $user_details['last_name']; ?>" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email&nbsp;<small class="text-danger">*</small></label>
                                <input type="email" name="email" value="<?php echo $user_details['email']; ?>" class="form-control" pattern="^(?!\s*$).+" required="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dob">D.O.B</label>
                                <input type="dob" name="dob" value="<?php echo is_null($user_details['dob']) ? '' : date("d-m-Y", strtotime($user_details['dob'])); ?>" class="form-control datepicker">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile_number" value="<?php echo $user_details['mobile_number']; ?>" class="form-control">
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
                                        <option value="<?php echo $valueAR['id']; ?>" <?php echo $user_details['role_id'] == $valueAR['id'] ? 'selected' : ''; ?>><?php echo $valueAR['role_name']; ?></option>
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
                                    <option value="<?php echo USER_STATUS_ACTIVE; ?>" <?php echo $user_details['status'] == USER_STATUS_ACTIVE ? 'selected' : ''; ?>>Active</option>
                                    <option value="<?php echo USER_STATUS_INACTIVE; ?>" <?php echo $user_details['status'] == USER_STATUS_INACTIVE ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group text-right">
                                <label>&nbsp;&nbsp;</label><br>
                                <a type="button" class="btn btn-default" href="<?php echo base_url(ADMIN_PREFIX . '/users'); ?>">Cancel</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
     $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
    });
</script>
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
                <li class="breadcrumb-item active">List All</li>
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
                <h2><small>Users</small>&nbsp;
                    <!-- <a href="<?php echo base_url(ADMIN_PREFIX . '/add-user'); ?>" class="btn btn-success pull-right">Add New</a> -->
                </h2>
            </div>

            <div class="table-responsive min-height-400">          
                <table class="table table-striped table-bordered" id="users_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (sizeof($all_users) > 0)
                        {
                            foreach ($all_users as $keyU => $valueU)
                            {
                        ?>
                                <tr>
                                    <td><?php echo $keyU+1; ?></td>
                                    <td><?php echo $valueU['first_name'] . ' ' . $valueU['last_name']; ?></td>
                                    <td><?php echo $valueU['email']; ?></td>
                                    <td><?php echo $valueU['mobile_number']; ?></td>
                                    <td><?php echo $valueU['status'] == USER_STATUS_ACTIVE ? 'Active' : 'Inactive'; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(ADMIN_PREFIX . '/edit-user') . '/' . $valueU['id']; ?>">Edit</a>
                                        <span class="vert-hr">&nbsp;|&nbsp;</span>
                                        <a href="javascript:void(0);" onclick="user_delete(<?php echo $valueU['id']; ?>);">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function()
                                {
                                    $('#users_table').DataTable();
                                });
                            </script>
                        <?php
                        }
                        else
                        {
                        ?>
                            <tr class="text-center">
                                <td colspan="8"><small><i>-- No Users Found --</i></small></td>
                            </tr>
                        <?php
                        }
                        ?>  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
    echo js('backend/users.js');
?>
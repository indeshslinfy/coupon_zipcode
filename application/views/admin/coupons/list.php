<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/coupons'); ?>">Coupons</a>
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
                <h2><small>Coupons</small>&nbsp;<a href="<?php echo base_url(ADMIN_PREFIX . '/add-coupon'); ?>" class="btn btn-success pull-right">Add New</a></h2>
            </div>

            <div class="table-responsive min-height-400">          
                <table class="table table-striped table-bordered" id="coupons_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Store Name</th>
                            <th>Zipcode</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Published</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (sizeof($all_records) > 0)
                        {
                            foreach ($all_records as $keyAR => $valueAR)
                            {
                        ?>
                                <tr>
                                    <td><?php echo $keyAR+1; ?></td>
                                    <td><?php echo $valueAR['coupon_title']; ?></td>
                                    <td><?php echo $valueAR['coupon_code']; ?></td>
                                    <td><?php echo $valueAR['store_name']; ?></td>
                                    <td><?php echo $valueAR['coupon_zipcode']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($valueAR['coupon_start_date'])); ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($valueAR['coupon_end_date'])); ?></td>
                                    <td><?php echo $valueAR['coupon_publish'] ? 'Yes' : 'No'; ?></td>
                                    <?php
                                        $status_str = '';
                                        if ($valueAR['status'] == COUPON_STATUS_ACTIVE)
                                        {
                                            $status_str = 'Active';
                                        }
                                        elseif ($valueAR['status'] == COUPON_STATUS_EXPIRED)
                                        {
                                            $status_str = 'Expired';
                                        }
                                        elseif ($valueAR['status'] == COUPON_STATUS_FUTURE)
                                        {
                                            $status_str = 'Upcoming';
                                        }
                                    ?>
                                    <td><?php echo $status_str; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(ADMIN_PREFIX . '/edit-coupon') . '/' . $valueAR['id']; ?>">Edit</a>
                                        <span class="vert-hr">&nbsp;|&nbsp;</span>
                                        <a href="javascript:void(0);" onclick="coupon_delete(<?php echo $valueAR['id']; ?>);">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function()
                                {
                                    $('#coupons_table').DataTable();
                                });
                            </script>
                        <?php
                        }
                        else
                        {
                        ?>
                            <tr class="text-center">
                                <td colspan="8"><small><i>-- No Coupons Found --</i></small></td>
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
    echo js('backend/coupons.js');
?>
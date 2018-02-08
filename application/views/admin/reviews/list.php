<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Store Reviews</li>
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
                <h2><small>Store Reviews</small></h2>
            </div>

            <div class="table-responsive min-height-400">          
                <table class="table table-striped table-bordered" id="reviews_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 40%;">Review</th>
                            <th style="width: 5%">Rating</th>
                            <th style="width: 7%">Reviewer</th>
                            <th style="width: 7%">Store</th>
                            <th style="width: 7%">Date</th>
                            <th style="width: 7%">Status</th>
                            <th style="width: 7%">Action</th>
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
                                    <td><?php echo $valueAR['review_text']; ?></td>
                                    <td><?php echo $valueAR['rating']; ?></td>
                                    <td>
                                        <?php
                                        if ($valueAR['reviewer_id'])
                                        {
                                        ?>
                                            <a href="<?php echo base_url(ADMIN_PREFIX . '/edit-user/' . $valueAR['reviewer_id']); ?>"><?php echo $valueAR['reviewer_name']; ?></a>
                                            
                                        <?php
                                        }
                                        else
                                        {
                                            echo $valueAR['reviewer_name'];
                                        }
                                        ?>
                                    </td>
                                    <td><a href="<?php echo base_url(ADMIN_PREFIX . '/edit-store') . '/' . $valueAR['receiver_id']; ?>"><?php echo $valueAR['store_name']; ?></a></td>
                                    <td><?php echo date('d-m-Y H:i', strtotime($valueAR['created_at'])); ?></td>
                                    <td>
                                        <select class="form-control" onchange="review_update(this, <?php echo $valueAR['id']; ?>);" data-strid="<?php echo $valueAR['receiver_id']; ?>">
                                            <option value="<?php echo REVIEW_STATUS_DISAPPROVE; ?>" <?php echo $valueAR['status'] == REVIEW_STATUS_DISAPPROVE ? 'selected=selected' : ''; ?>>Disapprove</option>
                                            <option value="<?php echo REVIEW_STATUS_APPROVE; ?>" <?php echo $valueAR['status'] == REVIEW_STATUS_APPROVE ? 'selected=selected' : ''; ?>>Approve</option>
                                            <option value="<?php echo REVIEW_STATUS_ABUSE; ?>" <?php echo $valueAR['status'] == REVIEW_STATUS_ABUSE ? 'selected=selected' : ''; ?>>Spam</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="review_delete(<?php echo $valueAR['id']; ?>);">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function()
                                {
                                    $('#reviews_table').DataTable({
                                        "pageLength": 50
                                    });
                                });
                            </script>
                        <?php
                        }
                        else
                        {
                        ?>
                            <tr class="text-center">
                                <td colspan="8"><small><i>-- No Reviews Found --</i></small></td>
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

<?php echo js('backend/reviews.js'); ?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX . '/tickets'); ?>">Tickets</a>
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
                <h2><small>Tickets</small></h2>
            </div>

            <div class="table-responsive min-height-400">          
                <table class="table table-striped table-bordered" id="tickets_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created on</th>
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
                                    <td><?php echo $valueAR['first_name'] . ' ' . $valueAR['last_name']; ?></td>
                                    <td><?php echo $valueAR['email']; ?></td>
                                    <td><?php echo $valueAR['phone_number']; ?></td>
                                    <td><?php echo $valueAR['subject']; ?></td>
                                    <td>
                                        <?php
                                        if ($valueAR['ticket_type'] == TICKET_TYPE_CONTACT)
                                        {
                                            echo 'Contact us';
                                        }
                                        elseif ($valueAR['ticket_type'] == TICKET_TYPE_ADVERTISE)
                                        {
                                            echo 'Advertise';
                                        }
                                        else
                                        {
                                            echo 'n/a';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($valueAR['status'] == TICKET_STATUS_CLOSE)
                                        {
                                            echo 'Closed';
                                        }
                                        elseif ($valueAR['status'] == TICKET_STATUS_OPEN)
                                        {
                                            echo 'Opened';
                                        }
                                        elseif ($valueAR['status'] == TICKET_STATUS_ANSWER)
                                        {
                                            echo 'Answered';
                                        }
                                        else
                                        {
                                            echo 'n/a';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo date('d-m-Y H:i', strtotime($valueAR['created_at'])); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url(ADMIN_PREFIX . '/edit-ticket') . '/' . $valueAR['id']; ?>">Edit</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function()
                                {
                                    $('#tickets_table').DataTable();
                                });
                            </script>
                        <?php
                        }
                        else
                        {
                        ?>
                            <tr class="text-center">
                                <td colspan="8"><small><i>-- No Tickets Found --</i></small></td>
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

<script>
function ticket_delete(id)
{
    if (confirm('Are you sure?'))
    {
        $.ajax({
            url: BASEURL + ADMIN_PREFIX + "/delete-ticket",
            method: 'POST',
            data: {'id': id},
            dataType: 'json',
            success: function(result)
            {
                if (result.status)
                {
                    window.location.href = BASEURL + ADMIN_PREFIX + "/tickets";
                }
                else
                {
                    alert(result.message);
                }
            }
        });
    }
}
</script>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <div class="content_title">
                <h2><small>Dashboard</small></h2>
            </div>

            <div class="row stats_info">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-bar-chart"></i>&nbsp;Business Statistics</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="<?php echo base_url(ADMIN_PREFIX . '/users'); ?>" class="total_rides">
                                        <i class="fa fa-users"></i>
                                        <span class="stats_info_text">Registered Users</span>
                                        <span class="stats_info_total"><?php echo $total_users; ?></span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url(ADMIN_PREFIX . '/stores'); ?>" class="total_compnis">
                                        <i class="fa fa-building-o"></i>
                                        <span class="stats_info_text">Registered Stores</span>
                                        <span class="stats_info_total"><?php echo $total_stores; ?></span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url(ADMIN_PREFIX . '/coupons'); ?>" class="total_earnig">
                                        <i class="fa fa-money"></i>
                                        <span class="stats_info_text">Total Coupons</span>
                                        <span class="stats_info_total"><?php echo $total_coupons; ?></span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url(ADMIN_PREFIX . '/tickets'); ?>" class="total_earnig">
                                        <i class="fa fa-money"></i>
                                        <span class="stats_info_text">Total Tickets</span>
                                        <span class="stats_info_total"><?php echo $total_tickets; ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
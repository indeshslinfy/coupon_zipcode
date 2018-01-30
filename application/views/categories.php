<div class="row">
	<section class="categories_wrapper">
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Browse Categories</h2>
			</div>

			<div class="row">
				<div class="section_main">
					<div class="col-xs-12 col-sm-10 left-pane">
						<div class="">
						
							<ul class="nav nav-tabs" id="alpha_list">
								<?php
								$paging_keys = array_keys($all_categories);
								foreach ($paging_keys as $keyPC => $valuePC)
								{
								?>
									<li><a data-toggle="tab" href="#<?php echo 'cat_' . $valuePC; ?>"><?php echo $valuePC; ?></a></li>
								<?php
								}
								?>
								<span class="menu_icon_down hidden"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
							</ul>
							<div class="tab-content">
								<?php
								if (sizeof($all_categories) > 0)
								{
									$cnt = 1;
									foreach ($all_categories as $keyAC => $valueAC)
									{
									?>
										<div  class="tab-pane fade" id="cat_<?php echo $keyAC; ?>">
											<div class="row">
											<?php
												for ($i=0; $i<sizeof($valueAC); $i++)
												{
												?>
													<div class="col-xs-12 col-sm-4 cat_div">
														<a href="<?php echo base_url('category/') . $valueAC[$i]['store_category_slug']; ?>">
															<?php echo $valueAC[$i]['store_category_name']; ?>
														</a>
													</div>
												<?php
												}
												?>
											</div>
										</div>
									<?php
									}
								}
								else
								{
								?>
									<div class="no-coupons-div">
										<div class="col-md-5 text-center">
											<?php echo img('oops.png', array('alt' => 'No categories found')); ?>
										</div>

										<div class="col-md-7 rite-pane">
											<div>
												<h4>Something went wrong.</h4>
												<p>We'll be up very soon.</p>
											</div>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-2 right-pane">
						<div class="header text-center"><h4>Popular Coupons</h4></div>

						<?php
						foreach ($popular_coupons as $keyPC => $valuePC)
						{
						?>
							<div class="popular_coupon_wrap">
								<h4><?php echo $valuePC['coupon_title']; ?></h4>
								<p>Deal ends on <?php echo date("d M", strtotime($valuePC['coupon_end_date'])); ?></p>
								<a href="<?php echo base_url('deal/' . $valuePC['id']); ?>" class="ylew_btn btn btn-block btn-sm">Get the deal now</a>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>			
	</section>
</div>

<script>
$(document).ready(function()
{
	$('[data-toggle="tooltip"]').tooltip();
	$("#alpha_list li:first-child").children('a').click();
	$(".menu_icon_down").click(function(){
		$('.nav-tabs').toggleClass('height_auto');
	});
});
</script>
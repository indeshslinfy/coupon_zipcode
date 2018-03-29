<link rel="stylesheet" type="text/css" href="<?php echo plugin_url() . 'rateyo' . DS . 'jquery.rateyo.min.css'?>">
<script type="text/javascript" src="<?php echo plugin_url() . 'rateyo' . DS . 'jquery.rateyo.min.js'; ?>"></script>

<div class="row">
	<section class="cat_coupons_wrapper">
		<div class="container">
			<?php
			if ($this->uri->segment(1) == 'category')
			{
			?>
				<div class="heading_text_wrap">
					<h2><?php echo $category_name; ?></h2>
				</div>
			<?php
			}
			?>

			<div class="row">
				<div class="section_main">
					<form action="<?php echo base_url() . 'deals2'; ?>" id="deal_search_form">
						<div class="col-xs-12 col-sm-3 col-md-2 left-pane">
							<div class="filters_header text-center">
								<h4>Filters
									<a class="pull-right filter_toggle visible-xs" href="javascript:void(0);"><i class="fa fa-filter"></i></a>
								</h4>
							</div> 
							<div class="filter_src_div">
								<h5 class="filter_heading">Source</h5>
									<ul class="filters-ul" id="src_filters_ul">
										<li>
											<input type="checkbox" name="src[]" value="local" <?php echo isset($_GET['src']) && in_array('local', $_GET['src']) ? 'checked' : ''; ?>>&nbsp;
											<span>CouponZipcode</span>
										</li>
										<li>
											<input type="checkbox" name="src[]" value="restaurant_dot_com" <?php echo isset($_GET['src']) && in_array('restaurant_dot_com', $_GET['src']) ? 'checked' : ''; ?>>&nbsp;
											<span>Restaurant.com</span>
										</li>
										<li>
											<input type="checkbox" name="src[]" value="groupon" <?php echo isset($_GET['src']) && in_array('groupon', $_GET['src']) ? 'checked' : ''; ?>>&nbsp;
											<span>Groupon</span>
										</li>
										<li>
											<input type="checkbox" name="src[]" value="ebay" <?php echo isset($_GET['src']) && in_array('ebay', $_GET['src']) ? 'checked' : ''; ?>>&nbsp;
											<span>Ebay</span>
										</li>
										<li>
											<input type="checkbox" name="src[]" value="amazon" <?php echo isset($_GET['src']) && in_array('amazon', $_GET['src']) ? 'checked' : ''; ?>>&nbsp;
											<span>Amazon</span>
										</li>
									</ul>
									<hr>
								</div>
								<div class="filter_btns_div">
								&nbsp;<button type="button" class="btn default_btn" style="width: 46%;" onclick="clear_filters(this, 'all');">Clear All</button>
								<button class="btn green_btn text-center" style="width: 46%;">Apply</button>&nbsp;
							</div>
						</div>
						<div class="col-xs-12 col-sm-9 col-md-10">
							<div class="filters-tab">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#coupon_filter" aria-controls="coupon_filter" role="tab" data-toggle="tab">CouponZipcode</a></li>
									<li role="presentation"><a href="#restuarant_filter" aria-controls="restuarant_filter" role="tab" data-toggle="tab">Restaurant.com</a></li>
									<li role="presentation"><a href="#groupon_filter" aria-controls="groupon_filter" role="tab" data-toggle="tab">Groupon</a></li>
									<li role="presentation"><a href="#ebay_filter" aria-controls="ebay_filter" role="tab" data-toggle="tab">Ebay</a></li>
									<li role="presentation"><a href="#amazon_filter" aria-controls="amazon_filter" role="tab" data-toggle="tab">Amazon</a></li>
								</ul>

								<div class="tab-content">
									<!-- COUPON ZIPCODE -->
									<div role="tabpanel" class="tab-pane active" id="coupon_filter">
										<!-- CATEGORIES -->
										<div class="col-xs-12 col-sm-6 col-md-3">
											<div class="filter_cat_div">
												<h5 class="filter_heading">Categories</h5>
												<ul class="filters-ul hidez" id="<?php echo 'local_cat_ul'; ?>">
													<?php
													foreach ($all_categories['local'] as $keySub => $valueSub)
													{
														$cls_str = $keySub > 4 ? 'hid_ulz' : '';
													?>
														<li class="<?php echo $cls_str; ?>" data-src="local-cat">
															<input type="checkbox" name="cat[]" value="<?php echo $valueSub['store_category_slug']; ?>" <?php echo isset($_GET['cat']) && in_array($valueSub['store_category_slug'], $_GET['cat']) ? 'checked' : ''; ?>>&nbsp;
															<span><?php echo $valueSub['store_category_name']; ?></span>
														</li>
													<?php
													}
													?>
												</ul>
											</div>
										</div>

										<!-- KEYWORD -->
										<div class="col-xs-12 col-sm-6 col-md-3">
											<div class="filter_keyword_div <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Search by Keyword
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable">
													<li>
														<input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
													</li>
												</ul>
											</div>
										</div>

										<!-- <div class="col-xs-12 col-sm-6 col-md-3">
										</div> -->

										<div class="col-xs-12 col-sm-12 col-md-6">
											<div class="filter_dt_div <?php echo isset($_GET['src']) && $_GET['src'] != 'local' ? 'hidez' : ''; ?>">
										<!-- DATE ADDED -->
												<h5 class="filter_heading">
													Date Added
													<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['dt']) ? '' : 'hidez'; ?>" onclick="clear_filters(this);">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable">
													<li>
														<input type="radio" name="dt" value="today" <?php echo isset($_GET['dt']) && $_GET['dt'] == 'today' ? 'checked' : ''; ?>>&nbsp;
														<span>Today</span>
													</li>
													<li>
														<input type="radio" name="dt" value="week" <?php echo isset($_GET['dt']) && $_GET['dt'] == 'week' ? 'checked' : ''; ?>>&nbsp;
														<span>This Week</span>
													</li>
												</ul>
											</div>
										<!-- RATING -->
											<div class="filter_rvws_div <?php echo isset($_GET['src']) && $_GET['src'] != 'local' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													CZ Rating
													<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['rt']) ? '' : 'hidez'; ?>" onclick="clear_filters(this);">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable">
													<li>
														<input type="radio" name="rt" value="5" <?php echo isset($_GET['rt']) && $_GET['rt'] == '5' ? 'checked' : ''; ?>>&nbsp;
														<span>
															<div class="review_rating_read" id="review_rating_5"></div>
														</span>
													</li>
													<li>
														<input type="radio" name="rt" value="4" <?php echo isset($_GET['rt']) && $_GET['rt'] == '4' ? 'checked' : ''; ?>>&nbsp;
														<span>
															<div class="review_rating_read" id="review_rating_4"></div>
														</span>
													</li>
													<li>
														<input type="radio" name="rt" value="3" <?php echo isset($_GET['rt']) && $_GET['rt'] == '3' ? 'checked' : ''; ?>>&nbsp;
														<span>
															<div class="review_rating_read" id="review_rating_3"></div>
														</span>
													</li>
												</ul>
											</div>
										</div>
									</div>

									<!-- RESTAURANT.COM -->
									<div role="tabpanel" class="tab-pane" id="restuarant_filter">
										<!-- KEYWORD -->
										<div class="col-xs-12 col-sm-6 col-md-4">
											<div class="filter_keyword_div <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Search by Keyword
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable">
													<li>
														<input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
													</li>
												</ul>
											</div>
										</div>

										<!-- PRICE RANGE -->
										<div class="col-xs-12 col-sm-6 col-md-5">
											<div class="filter_range_div <?php echo isset($_GET['src']) && $_GET['src'] != 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Price Range (&#36;)
													<small class="text-danger cat_require hidez">(Select at least 1 category)</small>
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable" id="range_filters_ul">
													<li>Min&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][0] : ''; ?>" class="form-control" name="price_range[]"></li>
													<li>Max&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][1] : ''; ?>" class="form-control" name="price_range[]"></li>
												</ul>
											</div>
										</div>
									</div>

									<!-- GROUPON -->
									<div role="tabpanel" class="tab-pane" id="groupon_filter">
										<!-- CATEGORY -->
										<div class="col-xs-12">
											<div class="filter_cat_div">
												<h5 class="filter_heading">Categories</h5>
												<ul class="filters-ul hidez" id="<?php echo 'groupon_cat_ul'; ?>">
													<?php
													foreach ($all_categories['groupon'] as $keySub => $valueSub)
													{
														$cls_str = $keySub > 4 ? 'hid_ulz' : '';
													?>
														<li class="<?php echo $cls_str; ?>" data-src="groupon-cat">
															<input type="checkbox" name="cat[]" value="<?php echo $valueSub['store_category_slug']; ?>" <?php echo isset($_GET['cat']) && in_array($valueSub['store_category_slug'], $_GET['cat']) ? 'checked' : ''; ?>>&nbsp;
															<span><?php echo $valueSub['store_category_name']; ?></span>
														</li>
													<?php
													}
													?>
												</ul>
											</div>
										</div>
									</div>

									<!-- EBAY -->
									<div role="tabpanel" class="tab-pane" id="ebay_filter">
										<!-- CATEGORY -->
										<div class="col-xs-12 col-sm-12 col-md-12">
											<div class="filter_cat_div">
												<h5 class="filter_heading">Categories</h5>
												<ul class="filters-ul hidez" id="<?php echo 'groupon_cat_ul'; ?>">
													<?php
													foreach ($all_categories['ebay'] as $keySub => $valueSub)
													{
														$cls_str = $keySub > 4 ? 'hid_ulz' : '';
													?>
														<li class="<?php echo $cls_str; ?>" data-src="ebay-cat">
															<input type="checkbox" name="cat[]" value="<?php echo $valueSub['store_category_slug']; ?>" <?php echo isset($_GET['cat']) && in_array($valueSub['store_category_slug'], $_GET['cat']) ? 'checked' : ''; ?>>&nbsp;
															<span><?php echo $valueSub['store_category_name']; ?></span>
														</li>
													<?php
													}
													?>
												</ul>
											</div>
										</div>

										<!-- KEYWORD -->
										<div class="col-xs-12 col-sm-6 col-md-4">
											<div class="filter_keyword_div <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Search by Keyword
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable">
													<li>
														<input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
													</li>
												</ul>
											</div>
										</div>

										<!-- PRICE RANGE -->
										<div class="col-xs-12 col-sm-6 col-md-8">
											<div class="filter_range_div <?php echo isset($_GET['src']) && $_GET['src'] != 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Price Range (&#36;)
													<small class="text-danger cat_require hidez">(Select at least 1 category)</small>
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable" id="range_filters_ul">
													<li>
														Min&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][0] : ''; ?>" class="form-control" name="price_range[]">
													</li>
													<li>
														Max&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][1] : ''; ?>" class="form-control" name="price_range[]">
													</li>
												</ul>
											</div>
										</div>
									</div>

									<!-- AMAZON -->
									<div role="tabpanel" class="tab-pane" id="amazon_filter">
										<!-- CATEGORY -->
										<div class="col-xs-12 col-sm-12 col-md-12">
											<div class="filter_cat_div">
												<h5 class="filter_heading">Categories</h5>
												<ul class="filters-ul hidez" id="<?php echo 'amazon_cat_ul'; ?>">
													<?php
													foreach ($all_categories['amazon'] as $keySub => $valueSub)
													{
														$cls_str = $keySub > 4 ? 'hid_ulz' : '';
													?>
														<li class="<?php echo $cls_str; ?>" data-src="amazon-cat">
															<input type="checkbox" name="cat[]" value="<?php echo $valueSub['store_category_slug']; ?>" <?php echo isset($_GET['cat']) && in_array($valueSub['store_category_slug'], $_GET['cat']) ? 'checked' : ''; ?>>&nbsp;
															<span><?php echo $valueSub['store_category_name']; ?></span>
														</li>
													<?php
													}
													?>
												</ul>
											</div>
										</div>

										<!-- KEYWORD & CONDITION -->
										<div class="col-xs-12 col-sm-12 col-md-5">
											<div class="filter_keyword_div <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Search by Keyword
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable">
													<li>
														<input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
													</li>
												</ul>
												<hr>
											</div>

											<div class="filter_condition_div">
												<h5 class="filter_heading">
													Condition
													<small class="text-danger cat_require hidez">(Select at least 1 category)</small>
													<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['condition']) ? '' : 'hidez'; ?>" onclick="clear_filters(this);">Clear</a>
												</h5>
												
												<ul class="filters-ul filter-clearable" id="condition_filters_ul">
													<li>
														<input type="radio" name="condition" value="New" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'New' ? 'checked' : ''; ?>>&nbsp;
														<span>New</span>
													</li>
													<li>
														<input type="radio" name="condition" value="Used" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'Used' ? 'checked' : ''; ?>>&nbsp;
														<span>Used</span>
													</li>
													<li>
														<input type="radio" name="condition" value="Collectible" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'Collectible' ? 'checked' : ''; ?>>&nbsp;
														<span>Collectible</span>
													</li>
													<li>
														<input type="radio" name="condition" value="Refurbished" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'Refurbished' ? 'checked' : ''; ?>>&nbsp;
														<span>Refurbished</span>
													</li>
												</ul>
												<hr>
											</div>
										</div>

										<!-- PRICE RANGE & MIN-MAX DISCOUNT -->
										<div class="col-xs-12 col-sm-12 col-md-7">
											<div class="filter_range_div <?php echo isset($_GET['src']) && $_GET['src'] != 'groupon' ? 'hidez' : ''; ?>">
												<h5 class="filter_heading">
													Price Range (&#36;)
													<small class="text-danger cat_require hidez">(Select at least 1 category)</small>
													<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
												</h5>
												<ul class="filters-ul filter-clearable" id="range_filters_ul">
													<li>
														Min&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][0] : ''; ?>" class="form-control" name="price_range[]">
													</li>
													<li>
														Max&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][1] : ''; ?>" class="form-control" name="price_range[]">
													</li>
												</ul>
												<hr>
											</div>

											<div class="filter_min_discount_div">
												<h5 class="filter_heading">
													Min. Discount
													<small class="text-danger cat_require hidez">(Select at least 1 category)</small>
													<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['min_discount']) ? '' : 'hidez'; ?>" onclick="clear_filters(this);">Clear</a>
												</h5>

												<ul class="filters-ul filter-clearable" id="min_discount_filters_ul">
													<li>
														<input type="radio" name="min_discount" value="10" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '10' ? 'checked' : ''; ?>>&nbsp;
														<span>10% and up</span>
													</li>
													<li>
														<input type="radio" name="min_discount" value="25" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '25' ? 'checked' : ''; ?>>&nbsp;
														<span>25% and up</span>
													</li>
													<li>
														<input type="radio" name="min_discount" value="35" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '35' ? 'checked' : ''; ?>>&nbsp;
														<span>35% and up</span>
													</li>
													<li>
														<input type="radio" name="min_discount" value="50" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '50' ? 'checked' : ''; ?>>&nbsp;
														<span>50% and up</span>
													</li>
												</ul>
												<hr>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					
					<div class="col-xs-12 col-sm-12 col-md-12 right-pane">
						<div class="exclusive_coupan cat_coupons">
							<div class="coupon_row_wrap">
							<?php
							if ($total_coupons_fetched > 0)
							{
								if (array_key_exists('local', $coupons))
								{
									foreach ($coupons['local'] as $keyCC => $valueCC)
									{
										$cpn_image = base_url($valueCC['store_image']);
										if ($valueCC['store_image'] == '' || is_null($valueCC['store_image']))
										{
											$cpn_image = base_url('assets/img/local-coupon-no-image.jpg');
										}
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a data-toggle="tooltip" title="<?php echo $valueCC['coupon_title']; ?>"  href="<?php echo base_url('coupon/') . $valueCC['id']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $cpn_image; ?>" alt="<?php echo $valueCC['coupon_title']; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3 title="<?php echo $valueCC['coupon_title']; ?>"><?php echo strlen($valueCC['coupon_title']) > 70 ? substr($valueCC['title'], 0, 70) . "..." : $valueCC['coupon_title']; ?></h3>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}

								if (array_key_exists('restaurant_dot_com', $coupons))
								{
									foreach ($coupons['restaurant_dot_com'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip" title="<?php echo $valueCC['name']; ?>" href="<?php echo $valueCC['buy-url']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<?php
														if (is_array($valueCC['image-url']))
														{
															echo img('restaurant-dot-com.png');
														}
														else
														{
															echo '<img src="' . $valueCC['image-url'] . '" alt="' . $valueCC['ad-id'] .'">';
														}
														?>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo $valueCC['name']; ?></h3>
															<p>&#36;<?php echo is_array($valueCC['sale-price']) ? $valueCC['price'] : $valueCC['sale-price']; ?></p>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}

								if (array_key_exists('groupon', $coupons))
								{
									foreach ($coupons['groupon'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip"  title="<?php echo $valueCC->title; ?>" href="<?php echo $valueCC->dealUrl; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC->grid4ImageUrl; ?>" alt="<?php echo $valueCC->shortAnnouncementTitle; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo $valueCC->announcementTitle; ?></h3>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}

								if (array_key_exists('ebay', $coupons))
								{
									foreach ($coupons['ebay'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>"  href="<?php echo $valueCC['viewItemURL']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<?php
														if (array_key_exists('galleryURL', $valueCC))
														{
															echo '<img src="' . $valueCC['galleryURL'] . '" alt="' . $valueCC['itemId'] .'">';
														}
														else
														{
															echo img('ebay-dot-com.jpg');
														}
														?>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo strlen($valueCC['title']) > 70 ? substr($valueCC['title'], 0, 70) . "..." : $valueCC['title']; ?></h3>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}

								if (array_key_exists('amazon', $coupons))
								{
									foreach ($coupons['amazon'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>" href="<?php echo $valueCC['url']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC['largeImage'] == '' ? base_url('assets/img/amazon-dot-com.jpg') : $valueCC['largeImage']; ?>" alt="<?php echo $valueCC['asin']; ?>">
														<span><?php echo img('powered-by-amazon.jpg'); ?></span>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo strlen($valueCC['title']) > 70 ? substr($valueCC['title'], 0, 70) . "..." : $valueCC['title']; ?></h3>
															<?php
															$price_str = 'Get Price NOW';
															if ($valueCC['rrp'] != 0.00)
															{
																if ($valueCC['lowestPrice'] < $valueCC['rrp'])
																{
																	$price_str = "<strike>&#36;" . $valueCC['rrp'] . "</strike>&nbsp;&#36;" . $valueCC['lowestPrice'];
																}
																else
																{
																	$price_str = "&#36;" . $valueCC['lowestPrice'];
																}
															}
															?>
															<p><?php echo $price_str; ?></p>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}
							}
							else
							{
							?>
								<div class="no-coupons-div">
									<div class="col-md-5 text-center">
										<?php echo img('oops.png', array('alt' => 'No coupons found')); ?>
									</div>

									<div class="col-md-7 rite-pane">
										<div>
											<h4>No products were found matching your selection.</h4>
											<p>Try a different keyword maybe?</p>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						
						<?php
						$pagination_setting = get_settings('deals_pagination');
						if ($total_coupons_fetched > 0 && $total_coupons_fetched >= $pagination_setting['limit'])
						{
						?>
							<div class="load-more-div">
								<button type="button" onclick="load_more(this);" id="load_more_btn" class="btn ylew_btn">Load More</button>
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

	$($('#src_filters_ul li input[type="radio"]')).on('click', function(e)
	{
		if (e.which == 1)
		{
			toggle_filters($(e.target));
		}
	});

	toggle_filters($('#src_filters_ul li input:checked'));

	$(document).on('click', $('.filter-clearable input'), function(e)
	{
		if (e.which == 1)
		{
			$(e.target).parents('.filter-clearable').siblings('.filter_heading').children('.clear-filter').removeClass('hide');
		}
	});

	$('.review_rating_read').each(function (index, value)
	{
		var target = "#" + $(value).attr('id');
		var rating = target.split('_');
		bind_rating(target, rating[rating.length-1]);
	});

	render_selected_filters();
});

function bind_rating(target, rating)
{
	$(target).rateYo({
		rating: rating,
		halfStar: true,
		readOnly: true,
		starWidth: "15px",
		multiColor: {"startColor": "#FF0000", "endColor"  : "#F39C12"},
	});

	$(target).css('display', 'inline-block');
}

function render_selected_filters()
{
	$(".filters-ul li input[type=checkbox]:checked").parent('li').children('span').html();
}

function toggle_filters(ele){

}
// function toggle_filters(ele)
// {
// 	var selected_src = $(".filters-ul").find($('input[name^=src]:checked'));
// 	$('#sorting_inner_affiliate').html("<h4>" + selected_src.siblings('span').html() + "</h4>");
	
// 	$('.cat_require').addClass('hide');

// 	$('#sorting_inner_affiliate').addClass('hide');
// 	$('#sorting_div_inner').addClass('hide');
// 	$(".filter_range_div").addClass('hide');
// 	$(".filter_min_discount_div").addClass('hide');
// 	$(".filter_condition_div").addClass('hide');

// 	$('.filter_cat_div').removeClass('hide');
// 	$('.filter_cat_div ul').children('li').addClass('hide');
// 	$(".filter_cat_div .filters-ul").addClass('hide');
// 	$(".filter_cat_div .filters-ul li").addClass('hide');
// 	$('#' + selected_src.val() + '_cat_ul').removeClass('hide');
// 	$('.filter_cat_div ul li').children('input').removeAttr('name');

// 	if (selected_src.val() == 'local')
// 	{
// 		$('#sorting_div_inner').removeClass('hide');
// 		$('.filter_keyword_div').removeClass('hide');

// 		$('.filter_dt_div').removeClass('hide');
// 		$('.filter_dt_div').find('input[type=radio]').attr('name', $('.filter_dt_div').find('input[type=radio]').attr('data-name'));
// 		$('.filter_dt_div').find('input[type=radio]').removeAttr('data-name');

// 		$('.filter_rvws_div').removeClass('hide');
// 		$('.filter_rvws_div').find('input[type=radio]').attr('name', $('.filter_rvws_div').find('input[type=radio]').attr('data-name'));
// 		$('.filter_rvws_div').find('input[type=radio]').removeAttr('data-name');

// 		$('.filter_cat_div ul').children('li[data-src=local-cat]').removeClass('hide');
// 		$('.filter_cat_div ul li[data-src=local-cat]').children('input').attr('name', 'cat[]');
// 	}
// 	else
// 	{
// 		$('#sorting_inner_affiliate').removeClass('hide');

// 		if (selected_src.val() == 'restaurant_dot_com')
// 		{
// 			$('.filter_cat_div').addClass('hide');
// 			$('.filter_range_div').removeClass('hide');
// 			$('.filter_keyword_div').removeClass('hide');
			
// 			$('.filter_cat_div ul').children('li[data-src=amazon-cat]').removeClass('hide');
// 			$('.filter_cat_div ul li[data-src=amazon-cat]').children('input').attr('name', 'cat[]');
// 		}
// 		else if (selected_src.val() == 'groupon')
// 		{
// 			$('.filter_keyword_div').addClass('hide');

// 			$('.filter_cat_div ul').children('li[data-src=groupon-cat]').removeClass('hide');
// 			$('.filter_cat_div ul li[data-src=groupon-cat]').children('input').attr('name', 'cat[]');
// 		}
// 		else if (selected_src.val() == 'ebay')
// 		{
// 			$('.filter_range_div').removeClass('hide');
// 			$('.filter_keyword_div').removeClass('hide');

// 			$('.filter_cat_div ul').children('li[data-src=ebay-cat]').removeClass('hide');
// 			$('.filter_cat_div ul li[data-src=ebay-cat]').children('input').attr('name', 'cat[]');
// 		}
// 		else if (selected_src.val() == 'amazon')
// 		{
// 			$(".filter_range_div").removeClass('hide');
// 			$(".filter_min_discount_div").removeClass('hide');
// 			$(".filter_condition_div").removeClass('hide');

// 			$('.filter_cat_div ul').children('li[data-src=amazon-cat]').removeClass('hide');
// 			$('.filter_cat_div ul li[data-src=amazon-cat]').children('input').attr('name', 'cat[]');

// 			if ($('li[data-src=amazon-cat]').find($('input[name="cat[]"]:checked')).length == 0)
// 			{
// 				$('.cat_require').removeClass('hide');
// 			}
// 		}

// 		$('.filter_dt_div').addClass('hide');
// 		$('.filter_dt_div').find('input[type=radio]').attr('data-name', $('.filter_dt_div').find('input[type=radio]').attr('name'));
// 		$('.filter_dt_div').find('input[type=radio]').removeAttr('name');

// 		$('.filter_rvws_div').addClass('hide');
// 		$('.filter_rvws_div').find('input[type=radio]').attr('data-name', $('.filter_rvws_div').find('input[type=radio]').attr('name'));
// 		$('.filter_rvws_div').find('input[type=radio]').removeAttr('name');
// 	}

// 	$(".filter_cat_div .filters-ul").niceScroll({cursorborder:"", cursorcolor:"#1A5006"});
// 	$(".filter_cat_div .filters-ul").getNiceScroll().resize();
// 	$("body").getNiceScroll().resize();
// }

function clear_filters(ele, target)
{
	if (typeof(target) == 'undefined')
	{
		$(ele).addClass('hidez');
		$(ele).parent('.filter_heading').siblings('ul.filters-ul').find('input[type=text], input[type=number]').val('');
		$(ele).parent('.filter_heading').siblings('ul.filters-ul').find('input[type=checkbox]:checked, input[type=radio]:checked').prop('checked', false);
	}
	else if (target == 'all')
	{
		$('.clear-filter').each(function (index, value)
		{
			clear_filters(value);
		});
	}
}

var deals_page = 1;
function load_more(ele)
{
	deals_page = deals_page + 1;
	$.ajax({
		url: BASEURL + 'deals2?' + $("#deal_search_form").serialize() + '&paginate[page]=' + deals_page + '&is_ajax=1',
		method: 'GET',
		dataType: 'json',
		beforeSend: function( xhr ) {
			$(ele).html('Loading...');
			$(ele).attr('disabled', 'disabled');
		},
		success: function(result)
		{
			$('.coupon_row_wrap').append(result);
			$("body").getNiceScroll().resize();
		},
		complete: function (jqXHR, status) {
			$(ele).html('Load More');
			$(ele).removeAttr('disabled');
		}
	});
}
</script>
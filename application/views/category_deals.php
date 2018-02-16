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
					<div class="col-sm-3 col-md-2 left-pane">
						<div class="filters_header text-center">
							<h4>Filters
								<a class="pull-right filter_toggle visible-xs" href="javascript:void(0);"><i class="fa fa-filter"></i></a>
							</h4>
						</div>

						<div class="filter_inner_wrap">
							<div class="selected_filters_div"></div>
							<form action="<?php echo base_url() . 'deals'; ?>" id="deal_search_form">
								<div class="filter_btns_div">
									<input type="hidden" name="search_src" value="search_pg">
									<input type="hidden" class="form-control" name="cat_name" value="<?php echo isset($_GET['cat_name']) ? $_GET['cat_name'] : ''; ?>">
									<input type="hidden" class="form-control" name="store_zipcode" value="<?php echo isset($_GET['store_zipcode']) ? $_GET['store_zipcode'] : $_GET['store_zipcode']; ?>">
									&nbsp;<button type="button" class="btn default_btn" style="width: 46%;" onclick="clear_filters(this, 'all');">Clear All</button>
									<button class="btn green_btn text-center" style="width: 46%;">Apply</button>&nbsp;
									<hr>
								</div>

								<div class="filter_src_div">
									<h5 class="filter_heading">Source</h5>
									<ul class="filters-ul" id="src_filters_ul">
										<li>
											<input type="radio" name="src" value="local" <?php echo isset($_GET['src']) && $_GET['src'] == 'local' ? 'checked' : ''; ?>>&nbsp;
											<span>Coupon Zipcode</span>
										</li>
										<li>
											<input type="radio" name="src" value="groupon" <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'checked' : ''; ?>>&nbsp;
											<span>Groupon</span>
										</li>
										<li>
											<input type="radio" name="src" value="ebay" <?php echo isset($_GET['src']) && $_GET['src'] == 'ebay' ? 'checked' : ''; ?>>&nbsp;
											<span>Ebay</span>
										</li>
										<li>
											<input type="radio" name="src" value="amazon" <?php echo isset($_GET['src']) && $_GET['src'] == 'amazon' ? 'checked' : ''; ?>>&nbsp;
											<span>Amazon</span>
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_range_div <?php echo isset($_GET['src']) && $_GET['src'] != 'groupon' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										Price Range
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

								<div class="filter_keyword_div <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'hide' : ''; ?>">
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

								<div class="filter_dt_div <?php echo isset($_GET['src']) && $_GET['src'] != 'local' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										Date Added
										<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['dt']) ? '' : 'hide'; ?>" onclick="clear_filters(this);">Clear</a>
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
									<hr>
								</div>

								<div class="filter_rvws_div <?php echo isset($_GET['src']) && $_GET['src'] != 'local' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										Coupon Zipcode Rating
										<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['rt']) ? '' : 'hide'; ?>" onclick="clear_filters(this);">Clear</a>
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
									<hr>
								</div>

								<div class="filter_cat_div">
									<h5 class="filter_heading">Categories</h5>
									<?php
									foreach ($all_categories as $keyAC => $valueAC)
									{
									?>
										<ul class="filters-ul hide" id="<?php echo $keyAC . '_cat_ul'; ?>">
											<?php
											foreach ($valueAC as $keySub => $valueSub)
											{
												$cls_str = '';
												if ($keySub > 4)
												{
													$cls_str = 'hid_ul';
												}

												$src_cat_str = 'local-cat';
												$cat_val = $valueSub['store_category_slug'];
												if (isset($valueSub['category_source']))
												{
													if ($valueSub['category_source'] == CATEGORY_SRC_EBAY)
													{
														$src_cat_str = 'ebay-cat';
														$cat_val = $valueSub['category_uid'];
													}
													elseif ($valueSub['category_source'] == CATEGORY_SRC_GROUPON)
													{
														$src_cat_str = 'groupon-cat';
														$cat_val = $valueSub['store_category_slug'];
													}
													elseif ($valueSub['category_source'] == CATEGORY_SRC_AMAZON)
													{
														$src_cat_str = 'amazon-cat';
														$cat_val = $valueSub['store_category_slug'];
													}
												}
											?>
												<li class="<?php echo $cls_str; ?>" data-src="<?php echo $src_cat_str; ?>">
													<input type="checkbox" name="cat[]" value="<?php echo $cat_val; ?>" <?php echo isset($_GET['cat']) && in_array($cat_val, $_GET['cat']) ? 'checked' : ''; ?>>&nbsp;
													<span><?php echo $valueSub['store_category_name']; ?></span>
												</li>
											<?php
											}
											?>
										</ul>
									<?php
									}
									?>
									<hr>
								</div>
								
								<div class="filter_btns_div">
									&nbsp;<button type="button" class="btn default_btn" style="width: 46%;" onclick="clear_filters(this, 'all');">Clear All</button>
									<button class="btn green_btn text-center" style="width: 46%;">Apply</button>&nbsp;
								</div>

								<div class="form-inline sorting-div">
									<div class="sorting-div-inner">
										<div class="form-group">
											<h4>Sort By</h4>
											<select class="form-control" name="sort_order">
												<option value="">--Select--</option>
												<option value="az" <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'az' ? 'selected' : ''; ?>>A-Z</option>
												<option value="za" <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'za' ? 'selected' : ''; ?>>Z-A</option>
												<option value="distance" <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'distance' ? 'selected' : ''; ?>>Distance</option>
											</select>
										</div>

										<div class="form-group">
											<h4>Within</h4>
											<select class="form-control" name="sort_distance">
												<option value="">--Select Distance--</option>
												<option value="1" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '1' ? 'selected' : ''; ?>>1 Mile</option>
												<option value="2.5" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '2dot5' ? 'selected' : ''; ?>>2.5 Miles</option>
												<option value="5" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '5' ? 'selected' : ''; ?>>5 Miles</option>
												<option value="10" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '10' ? 'selected' : ''; ?>>10 Miles</option>
												<option value="15" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '15' ? 'selected' : ''; ?>>15 Miles</option>
												<option value="20" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '20' ? 'selected' : ''; ?>>20 Miles</option>
												<option value="25" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '25' ? 'selected' : ''; ?>>25 Miles</option>
												<option value="30" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '30' ? 'selected' : ''; ?>>30 Miles</option>
											</select>
										</div>

										<div class="form-group">
											<h4>of</h4>
											<input type="text" name="sort_zipcode" class="form-control cat-srch-zipcode" placeholder="Zipcode" value="<?php echo isset($_GET['sort_zipcode']) ? $_GET['sort_zipcode'] : ''; ?>">
										</div>

										<div class="form-group">
											<input type="submit" name="sort_btn" class="btn ylew_btn" value="REFINE">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="col-sm-9 col-md-10 right-pane">
						<div class="exclusive_coupan cat_coupons">
							<?php
							if ($total_coupons_fetched > 0)
							{
								$cnt = 1;
								if (array_key_exists('local', $coupons))
								{
									foreach ($coupons['local'] as $keyCC => $valueCC)
									{
										echo $cnt == 1 ? '<div class="row coupon_row_wrap">' : '';
									?>
										<div class="col-sm-3 cpn_adjst_img">
											<a data-toggle="tooltip" title="<?php echo $valueCC['coupon_title']; ?>" data-placement="left" href="<?php echo base_url('coupon/') . $valueCC['id']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo base_url($valueCC['store_image']); ?>" alt="<?php echo $valueCC['coupon_title']; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<div class="location_box light_green_bg">
															<i class="fa fa-map-marker"></i>&nbsp;
															<?php echo $valueCC['store_name']; ?>
														</div>
														<div class="restrnt_desp_text_box">
															<h4 title="<?php echo $valueCC['coupon_title']; ?>"><?php echo strlen($valueCC['coupon_title']) > 36 ? substr($valueCC['title'], 0, 37) . "..." : $valueCC['coupon_title']; ?></h4>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
										echo $cnt == 4 ? '</div>' : '';
										$cnt == 4 ? $cnt = 1 : $cnt++;
									}
								}
								elseif (array_key_exists('groupon', $coupons))
								{
									foreach ($coupons['groupon'] as $keyCC => $valueCC)
									{
										echo $cnt == 1 ? '<div class="row coupon_row_wrap">' : '';
									?>
										<div class="col-sm-3 cpn_adjst_img">
											<a data-toggle="tooltip" title="<?php echo $valueCC->title; ?>" data-placement="left" href="javascript:void(0);">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC->grid4ImageUrl; ?>" alt="<?php echo $valueCC->shortAnnouncementTitle; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h4><?php echo $valueCC->announcementTitle; ?></h4>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
										echo $cnt == 4 ? '</div>' : '';
										$cnt == 4 ? $cnt = 1 : $cnt++;
									}
								}
								elseif (array_key_exists('ebay', $coupons))
								{
									foreach ($coupons['ebay'] as $keyCC => $valueCC)
									{
										echo $cnt == 1 ? '<div class="row coupon_row_wrap">' : '';
									?>
										<div class="col-sm-3 cpn_adjst_img">
											<a data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>" data-placement="left" href="javascript:void(0);">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC['galleryURL']; ?>" alt="<?php echo $valueCC['itemId']; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<!-- <div class="location_box light_green_bg">
															<i class="fa fa-map-marker"></i>&nbsp;
															<?php //echo strlen($valueCC['location']) > 30 ? substr($valueCC['location'], 0, 30) . "..." : $valueCC['location']; ?>
														</div> -->
														<div class="restrnt_desp_text_box">
															<h4><?php echo strlen($valueCC['title']) > 36 ? substr($valueCC['title'], 0, 37) . "..." : $valueCC['title']; ?></h4>
															<!-- <p>
																Price:&nbsp;<?php //echo $valueCC['sellingStatus']['currentPrice']; ?>
															</p> -->
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
										echo $cnt == 4 ? '</div>' : '';
										$cnt == 4 ? $cnt = 1 : $cnt++;
									}
								}
								elseif (array_key_exists('amazon', $coupons))
								{
									foreach ($coupons['amazon'] as $keyCC => $valueCC)
									{
										echo $cnt == 1 ? '<div class="row coupon_row_wrap">' : '';
									?>
										<div class="col-sm-3 cpn_adjst_img">
											<a data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>" href="<?php echo $valueCC['url']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC['largeImage']; ?>" alt="<?php echo $valueCC['asin']; ?>">
														<span><?php echo img('powered-by-amazon.jpg'); ?></span>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h4><?php echo strlen($valueCC['title']) > 36 ? substr($valueCC['title'], 0, 37) . "..." : $valueCC['title']; ?></h4>
															<?php
															$price_str = 'Get Price NOW';
															if ($valueCC['rrp'] != 0.00)
															{
																if ($valueCC['lowestPrice'] < $valueCC['rrp'])
																{
																	$price_str = "Price:&nbsp;<strike>" . $valueCC['rrp'] . "</strike>&nbsp;" . $valueCC['lowestPrice'];
																}
																else
																{
																	$price_str = "Price:&nbsp;" . $valueCC['lowestPrice'];
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
										echo $cnt == 4 ? '</div>' : '';
										$cnt == 4 ? $cnt = 1 : $cnt++;
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

					<div class="load-more-div">
						<button type="button" onclick="load_more(this);" id="load_more_btn" class="btn ylew_btn">Load More</button>
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
		multiColor: {"startColor": "#FF0000",
					"endColor"  : "#F39C12"},
	});

	$(target).css('display', 'inline-block');
}

function render_selected_filters()
{
	$(".filters-ul li input[type=checkbox]:checked").parent('li').children('span').html();
}

function toggle_filters(ele)
{
	$(".filter_range_div").addClass('hide');

	var selected_src = $(".filters-ul").find($('input[name=src]:checked'));
	$('.filter_cat_div ul').children('li').addClass('hide');
	$(".filter_cat_div .filters-ul").addClass('hide');
	$(".filter_cat_div .filters-ul li").addClass('hide');
	$('#' + selected_src.val() + '_cat_ul').removeClass('hide');
	$('.filter_cat_div ul li').children('input').removeAttr('name');

	if (selected_src.val() == 'local')
	{
		$('.filter_keyword_div').removeClass('hide');

		$('.filter_dt_div').removeClass('hide');
		$('.filter_dt_div').find('input[type=radio]').attr('name', $('.filter_dt_div').find('input[type=radio]').attr('data-name'));
		$('.filter_dt_div').find('input[type=radio]').removeAttr('data-name');

		$('.filter_rvws_div').removeClass('hide');
		$('.filter_rvws_div').find('input[type=radio]').attr('name', $('.filter_rvws_div').find('input[type=radio]').attr('data-name'));
		$('.filter_rvws_div').find('input[type=radio]').removeAttr('data-name');

		$('.filter_cat_div ul').children('li[data-src=local-cat]').removeClass('hide');
		$('.filter_cat_div ul li[data-src=local-cat]').children('input').attr('name', 'cat[]');
	}
	else
	{
		if (selected_src.val() == 'groupon')
		{
			$('.filter_keyword_div').addClass('hide');

			$('.filter_cat_div ul').children('li[data-src=groupon-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=groupon-cat]').children('input').attr('name', 'cat[]');
		}
		else if (selected_src.val() == 'ebay')
		{
			$('.filter_range_div').removeClass('hide');
			$('.filter_keyword_div').removeClass('hide');

			$('.filter_cat_div ul').children('li[data-src=ebay-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=ebay-cat]').children('input').attr('name', 'cat[]');
		}
		else if (selected_src.val() == 'amazon')
		{
			$('.filter_cat_div ul').children('li[data-src=amazon-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=amazon-cat]').children('input').attr('name', 'cat[]');
		}

		$('.filter_dt_div').addClass('hide');
		$('.filter_dt_div').find('input[type=radio]').attr('data-name', $('.filter_dt_div').find('input[type=radio]').attr('name'));
		$('.filter_dt_div').find('input[type=radio]').removeAttr('name');

		$('.filter_rvws_div').addClass('hide');
		$('.filter_rvws_div').find('input[type=radio]').attr('data-name', $('.filter_rvws_div').find('input[type=radio]').attr('name'));
		$('.filter_rvws_div').find('input[type=radio]').removeAttr('name');
	}

	$(".filter_cat_div .filters-ul").niceScroll({cursorborder:"", cursorcolor:"#1A5006"});
	$(".filter_cat_div .filters-ul").getNiceScroll().resize();
	$("body").getNiceScroll().resize();
}

function clear_filters(ele, target)
{
	if (typeof(target) == 'undefined')
	{
		$(ele).addClass('hide');
		$(ele).parent('.filter_heading').siblings('ul.filters-ul').find('input').val('');
		$(ele).parent('.filter_heading').siblings('ul.filters-ul').find('input:checked').prop('checked', false);
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
		url: BASEURL + 'deals?' + $("#deal_search_form").serialize() + '&paginate[page]=' + deals_page + '&is_ajax=1',
		method: 'GET',
		dataType: 'json',
		beforeSend: function( xhr ) {
			$(ele).html('Loading...');
			$(ele).attr('disabled', 'disabled');
		},
		success: function(result)
		{
			$('.exclusive_coupan.cat_coupons').append(result);
			$("body").getNiceScroll().resize();
		},
		complete: function (jqXHR, status) {
			$(ele).html('Load More');
			$(ele).removeAttr('disabled');
		}
	});
}
</script>
<?php
	echo css('frontend' . DS . 'magnific-popup.css');
	echo js('frontend' . DS . 'jquery.magnific-popup.min.js');
	
	$social_platform = get_settings('social_platform');
?>

<script type="text/javascript">
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

		$(".review_rating_read").css('display', 'inline-block');
	}
</script>

<link rel="stylesheet" type="text/css" href="<?php echo plugin_url() . 'rateyo' . DS . 'jquery.rateyo.min.css'?>">
<script type="text/javascript" src="<?php echo plugin_url() . 'rateyo' . DS . 'jquery.rateyo.min.js'; ?>"></script>

<div class="row">
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="product_title"><?php echo $coupon_details['store_name']; ?></h2>
				</div>

				<div class="col-xs-12">
					<div class="coupon_post">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 post_address">
								<div class="col-xs-12">
									<div class="store-pic">
										<div>
											<img class="img-responsive" alt="Store Logo" src="<?php echo base_url($coupon_details['store_featured_image']); ?>">
										</div>
									</div>
									<p>
										<?php echo str_replace(", ,", ", ", $coupon_details['address_line1'] . ', ' . $coupon_details['address_line2'] . ', ' . $coupon_details['address_line3'] . ', ' . $coupon_details['city_name'] . ', ' . $coupon_details['state_name'] . ', ' . $coupon_details['country_name'] . '. ' . $coupon_details['coupon_zipcode']); ?>
										<a href="#post_map" class="map_btn"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Map It</a>
									</p>
									<p><a style="word-break: break-all;" target="_blank" href="<?php echo $coupon_details['store_website']; ?>"><?php echo $coupon_details['store_website']; ?></a></p>
									<p><a href="tel:<?php echo $coupon_details['store_phone']; ?>"><?php echo $coupon_details['store_phone']; ?></a></p>
									<p><?php echo $coupon_details['store_email']; ?></p>
									<ul>
										<li><a target="_blank" href="<?php echo $coupon_details['store_fb_url'] ? $coupon_details['store_fb_url'] : 'javascript:void(0);'; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li><a target="_blank" href="<?php echo $coupon_details['store_tw_url'] ? $coupon_details['store_tw_url'] : 'javascript:void(0);'; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									</ul>
									
								</div>
							</div>

							<div class="col-xs-12 col-sm-8 col-md-7 post_coupon_detail">
								<div class="row">
									<div class="col-xs-12">
										<span class="coupon_button green_btn btn no_hover">Coupon Code</span>
										<span class="coupon_button green_border"><?php echo $coupon_details['coupon_code']; ?></span>
										<a href="<?php echo base_url('print-coupon/' . $coupon_details['id']); ?>" class="print_button btn">Print Coupon</a>
										<div class="post_content">
											<p><strong><?php echo $coupon_details['coupon_title']; ?></strong></p>
											<table>
												<tr>
													<td>Deal ends on:</td>
													<td><?php echo date('d M, Y', strtotime($coupon_details['coupon_end_date'])); ?></td>
												</tr>
											</table>

											<?php
											if (strlen(trim($coupon_details['coupon_description'])) > 250)
											{
											?>
												<div class="post_discruiption">
													<?php echo substr($coupon_details['coupon_description'], 0, 290); ?>
													...&nbsp;<a href="javascript:void(0);" onclick="toggle_coup_desc();">Show more</a>
												</div>

												<div class="post_discruiption hide">
													<?php echo $coupon_details['coupon_description']; ?>
													...&nbsp;<a href="javascript:void(0);" onclick="toggle_coup_desc();">Show less</a>
												</div>
											<?php
											}
											else
											{
											?>
												<div class="post_discruiption"><?php echo $coupon_details['coupon_description']; ?></div>
											<?php
											}
											?>

											<?php
											if (trim($coupon_details['coupon_fine_print']) != '')
											{
											?>
												<div class="post_note"><?php echo $coupon_details['coupon_fine_print']; ?></div>
											<?php
											}
											?>

											<div class="post_menu_button">
												<?php
												if (sizeof($coupon_details['store_menus']) > 0)
												{
												?>
													<ul class="gallery store-menu-gallery">
												<?php
													foreach ($coupon_details['store_menus'] as $keySM => $valueSM)
													{
												?>
														<li class="btn ylew_btn <?php echo $keySM == 0 ? '' : 'hide'; ?>">
															<a href="<?php echo base_url($valueSM['attachment_path']); ?>" class="image-link">View Menu</a>
														</li>
												<?php
													}
													?>
													</ul>
												<?php
												}
												?>
												<div class="post_like_unlike pull-right">
													<button title="Like Store" data-strid="<?php echo $coupon_details['coupon_store_id']; ?>" data-act="<?php echo STORE_LIKE; ?>" class="<?php echo intval($coupon_details['is_liked']) ? 'liked-by-user' : ''; ?>">
														<i class="fa fa-thumbs-up"></i>
														<span><?php echo $coupon_details['store_likes']; ?></span>
													</button>

													<button title="Unlike Store" data-strid="<?php echo $coupon_details['coupon_store_id']; ?>" data-act="<?php echo STORE_UNLIKE; ?>" class="<?php echo intval($coupon_details['is_unliked']) ? 'unliked-by-user' : ''; ?>">
														<i class="fa fa-thumbs-down"></i>
														<span><?php echo $coupon_details['store_unlikes']; ?></span>
													</button>
												</div>
												<div class="share_with_socila_media">
													<span>
														<a href="javascript:void(0);">
															<i class="fa fa-share-alt"></i>
														</a>
													</span>
													<ul class="share_scl_link_wrap">
														<li>
															<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('coupon/' . $coupon_details['id']); ?>" target="_blank">
																<i class="fa fa-facebook-f"></i>
															</a>
														</li>
														<li>
															<a href="https://twitter.com/share?url=<?php echo base_url('coupon/' . $coupon_details['id']); ?>&via=<?php echo $social_platform['twitter']; ?>&hashtags=CouponZipcode&text=<?php echo $coupon_details['coupon_title']; ?>">
																<i class="fa fa-twitter"></i>
															</a>
														</li>
														<li>
															<a href="https://plus.google.com/share?url=<?php echo base_url('coupon/' . $coupon_details['id']); ?>">
																<i class="fa fa-google-plus"></i>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-md-2 post_coupon_listing visible-md visible-lg">
								<p class="text-center"><label>Try More Coupons</label></p>
								<ul class="try_mr_cpn_desk">
								<?php
								if (sizeof($coupon_details['store_coupons']) > 0)
								{
								?>
										<?php
										foreach ($coupon_details['store_coupons'] as $keySC => $valueSC)
										{
										?>
											<li>
												<i class="fa fa-caret-right"></i>
												<a href="<?php echo base_url('coupon/' . $valueSC['id']); ?>"><?php echo $valueSC['coupon_title']; ?></a>
											</li>
										<?php
										}
										?>
								<?php
								}
								else
								{
								?>
									<li class="text-center">No coupons found</li>
								<?php
								}
								?>
								</ul>
							</div>
						</div>
					</div>

					<?php
					if (sizeof($coupon_details['store_coupons']) > 0)
					{
					?>
						<div class="col-xs-12 col-md-2 post_coupon_listing hidden-md hidden-lg">
							<p class="text-center"><label>Try More Coupons</label></p>
							<ul class="try_mr_cpn_mob">
								<?php
								foreach ($coupon_details['store_coupons'] as $keySC => $valueSC)
								{
								?>
									<li>
										<i class="fa fa-caret-right"></i>
										<a href="<?php echo base_url('coupon/' . $valueSC['id']); ?>"><?php echo $valueSC['coupon_title']; ?></a>
									</li>
								<?php
								}
								?>
							</ul>
						</div>
					<?php
					}
					?>
				</div>

				<div class="col-xs-12">
					<div class="post_detail">
						<h3><?php echo $coupon_details['store_type']; ?></h3>
						<p><?php echo $coupon_details['store_description']; ?></p>

						<p>Working Hours:</p>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Monday</th>
										<th>Tuesday</th>
										<th>Wednesday</th>
										<th>Thursday</th>
										<th>Friday</th>
										<th>Saturday</th>
										<th>Sunday</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['monday'] ? $coupon_details['store_timetable']['monday'] : 'Closed'; ?></td>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['tuesday'] ? $coupon_details['store_timetable']['tuesday'] : 'Closed'; ?></td>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['wednesday'] ? $coupon_details['store_timetable']['wednesday'] : 'Closed'; ?></td>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['thursday'] ? $coupon_details['store_timetable']['thursday'] : 'Closed'; ?></td>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['friday'] ? $coupon_details['store_timetable']['friday'] : 'Closed'; ?></td>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['saturday'] ? $coupon_details['store_timetable']['saturday'] : 'Closed'; ?></td>
										<td><?php echo !empty($coupon_details['store_timetable']) && $coupon_details['store_timetable']['sunday'] ? $coupon_details['store_timetable']['sunday'] : 'Closed'; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="review_section">
							<h2>What Are Locals Saying?</h2>
							<?php
							if (sizeof($coupon_details['store_reviews']) > 0)
							{
								foreach ($coupon_details['store_reviews'] as $keySR => $valueSR)
								{
							?>
									<div class="review_wrap">
										<p class="review_droper_name">
											<strong><?php echo $valueSR['reviewer_name']; ?></strong>&nbsp;Says&nbsp;
											<div class="review_rating_read" id="review_rating_<?php echo $valueSR['id']; ?>"></div>
											<span class="review_time"><?php echo date("F jS, Y", strtotime($valueSR['created_at'])); ?></span>
										</p>
										<p><?php echo $valueSR['review_text']; ?></p>
									</div>

									<script type="text/javascript">
										bind_rating("#review_rating_" + <?php echo $valueSR['id']; ?>, <?php echo $valueSR['rating']; ?>);
									</script>
							<?php
								}
							}
							else
							{
							?>
								<p>No reviews yet. Be the first to review <?php echo $coupon_details['store_name']; ?></p>
							<?php
							}

							if (!$coupon_details['is_reviewed'])
							{
							?>
								<div id="post-review-wrap">
									<button class="text-center btn write-review-btn toggle_review_btn" id="write_review_btn">Write a Review</button>
								</div>

								<div class="write-review-div col-sm-8 col-xs-12 col-sm-offset-2">
									<div>
										<form class="store_review_form hide" id="store_review_form">
											<h4 class="text-center">Write a Review</h4>
											<hr>
											<div class="col-sm-6 col-xs-12">
												<div class="row">
													<div class="col-xs-12 col-sm-12 form-group">
														<div class="row">
															<div class="col-sm-2 col-xs-12 form-group">
																<label>Name<span class="text-danger">*</span></label>
															</div>
															<div class="col-sm-10 col-xs-12">
																<input type="text" name="reviewer_name" required="required" class="form-control" id="reviewer_name" value="<?php echo trim(user_login_data('first_name') . ' ' . user_login_data('last_name')); ?>" <?php echo user_login_data('id') ? 'readonly' : ''; ?>>
															</div>
														</div>
													</div>
													
													<div class="col-xs-12">
														<div class="row">
															<div class="col-sm-2 col-xs-12">
																<label>Rating<span class="text-danger">*</span></label>
															</div>
															<div class="col-sm-10 col-xs-12 form-group">
																<div id="store_rating"></div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<div class="row">
															<div class="col-sm-2 col-xs-12 rvw_span">
																<label>Review</label>
															</div>
															<div class="col-sm-10 col-xs-12">
																<div class="row">
																	<div class="col-sm-12">
																		<textarea name="reviewer_text" class="form-control" style="resize:none;" rows="4" id="reviewer_text"></textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="col-xs-12">
											<hr>
												<div class="pull-right">
													<button type="button" class="btn btn-default toggle_review_btn">Close</button>
													<button type="button" class="btn write-review-btn green_btn btn" id="submit_review_btn" data-strid="<?php echo $coupon_details['coupon_store_id']; ?>" onclick="submit_store_review(this);">Submit Review</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							<?php
							}
							?>
						</div>

						<div class="post_map" id="post_map">
							<div id="store_map"></div>
							<div class="row">
								<div class="col-xs12 col-sm-8">
									<h3><?php echo $coupon_details['store_name']; ?></h3>
									<p><?php echo str_replace(", ,", ", ", $coupon_details['address_line1'] . ', ' . $coupon_details['address_line2'] . ', ' . $coupon_details['address_line3'] . ', ' . $coupon_details['city_name'] . ', ' . $coupon_details['state_name'] . ', ' . $coupon_details['country_name'] . '. ' . $coupon_details['coupon_zipcode']); ?></p>
								</div>
								<div class="col-xs12 col-sm-4 text-right">
									<a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin=34.1030032,-118.41046840000001&destination=<?php echo $coupon_details['store_latitude']; ?>,<?php echo $coupon_details['store_longitude']; ?>" class="btn ylew_btn">Get Direction</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_settings('google_map_key'); ?>&callback=initMap"></script>
<script type="text/javascript">
	function toggle_coup_desc()
	{
		$('.post_discruiption').toggleClass('hide');
	}
	
	$(document).ready(function()
	{
		$(".post_like_unlike").on("click", "button", function() {
			like_dislike_store($(this)[0], $(this).attr('data-act'), $(this).attr('data-strid'));
		});

		$(".toggle_review_btn").on("click", function() {
			$("#write_review_btn").toggleClass('hide');
			$("#store_review_form").toggleClass('hide');
		});

		$(".post_coupon_listing ul.try_mr_cpn_desk").css('height', $(".coupon_post").height() - 37);


		$('.store-menu-gallery').magnificPopup({ 
			type: 'image',
			delegate: 'a',
			removalDelay: 300,
			mainClass: 'mfp-with-fade',
			gallery:{enabled:true},
			image: {verticalFit: true}
		});

		$("#store_rating").rateYo({
			rating: 3.5,
			halfStar: true,
			starWidth: "25px",
			multiColor: {"startColor": "#FF0000",
						"endColor"  : "#F39C12"},
		});
	});

	function like_dislike_store(ele, act, strid)
	{
		$.ajax({
			url: BASEURL + "/coupons/like_unlike_store",
			method: 'POST',
			data: {'strid': strid, 'act': act},
			dataType: 'json',
			success: function(result)
			{
				if (result.status == 1)
				{
					$(ele).children('span').html(parseInt($(ele).children('span').html()) + 1);
					if ($(ele).siblings('button').children('span').html() > 0)
					{
						$(ele).siblings('button').children('span').html(parseInt($(ele).siblings('button').children('span').html()) - 1);
					}

					if (act == 1)
					{
						// IF LIKED
						$(ele).siblings('button').removeClass('unliked-by-user');
						$(ele).addClass('liked-by-user');
					}
					else
					{
						// IF UNLIKED
						$(ele).siblings('button').removeClass('liked-by-user');
						$(ele).addClass('unliked-by-user');
					}
				}
				else if (result.status == 2)
				{
					alert(result.message);
				}
			}
		});
	}

	function submit_store_review(ele)
	{
		if ($("#store_rating").rateYo('rating') == 0)
		{
			alert('Minimum rating should be 0.5');
		}
		else if ($("#reviewer_name").val().trim() == '' || $("#reviewer_text").val().trim() == '')
		{
			alert('Please fill required fields.');
		}
		else
		{
			$.ajax({
				url: BASEURL + "/coupons/submit_store_review",
				method: 'POST',
				data: {'strid': $(ele).attr('data-strid'),
						'rvr_nm': $("#reviewer_name").val().trim(),
						'rvr_txt':  $("#reviewer_text").val().trim(),
						'rvr_rtng': $("#store_rating").rateYo('rating')},
				dataType: 'json',
				success: function(result)
				{
					if (result.status)
					{
						$("#write_review_btn")[0].click();
						$("#store_review_form")[0].reset();

						var html = '<div class="review_wrap pending_review">\
										<p class="review_droper_name">\
											<strong>' + result.data.reviewer_name + '</strong>&nbsp;Says&nbsp;</p>\
											<div id="review_rating_' + result.data.id + '" class="review_rating_read" data-rating="' + result.data.rating + '"></div>\
											<span class="review_time">' + result.data.review_date + '</span>\
											<span class="review_time">[Pending for approval]</span>\
										<p>\
										<p>' + result.data.review_text + '</p>\
									</div>';

						$("#post-review-wrap").before(html);

						bind_rating("#review_rating_" + result.data.id, result.data.rating);

						$(".write-review-div").remove();
						$("#post-review-wrap").remove();
					}
				}
			});
		}
	}

	function initMap()
	{
		var uluru = {lat: <?php echo $coupon_details['store_latitude']; ?>, lng: <?php echo $coupon_details['store_longitude']; ?>};

		var map = new google.maps.Map(document.getElementById('store_map'), {
			zoom: 10,
			center: uluru
		});

		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
	}
</script>
<div class="row">
	<section>
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Coupon Zipcode Exclusive</h2>
				<a href="<?php echo base_url('deals?search_src=search_pg&src=local'); ?>" class="btn ylew_btn pull-right">SEE MORE</a>
			</div>
			<div class="row exclusive_coupan">
				<div id="exclusive_coupan_carousel"  class="owl-carousel">
					<?php
					foreach ($all_local_coupons as $keyALC => $valueALC)
					{
					?>
						<div class="item">
							<div class="cpn_adjst_img">
								<a href="<?php echo base_url('coupon' . '/' . $valueALC['id']); ?>">
									<img src="<?php echo base_url($valueALC['store_image']); ?>" alt="<?php echo $valueALC['coupon_title']; ?>">
									<div class="hover_div">
										<div class="hover_text_wrap">
											<div class="hover_text">
												<h3><?php echo $valueALC['store_name']; ?>&nbsp;</h3>
												<h4><?php echo $valueALC['coupon_title']; ?></h4>
												<h5><?php echo strlen($valueALC['coupon_description']) >= 145 ? substr($valueALC['coupon_description'], 0, 145) . '...' : $valueALC['coupon_description']; ?></h5>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>			
	</section>
</div>

<div class="row">
	<section class="top_rstrnt_deal gery_bg top_deal_adjst_span">
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Top Restaurant Deals Near You</h2>
				<a href="javascript:void(0);" class="btn ylew_btn pull-right">SEE MORE</a>
			</div>

			<div class="row">
				<?php
				// $cnt = 1;
				$js_deals_arr = array();
				foreach ($coupons['groupon']->deals as $keyCL => $valueCL)
				{
					// echo $cnt == 1 ? '<div class="row">' : '';
					$js_deals_arr[$valueCL->uuid] = array('title' => $valueCL->title,
												'short_title' => $valueCL->shortAnnouncementTitle,
												'image' => $valueCL->grid4ImageUrl,
												'deal_url' => $valueCL->dealUrl,
												'location' => $valueCL->redemptionLocation,
												'latitude' => @$valueCL->options[0]->redemptionLocations[0]->lat,
												'longitude' => @$valueCL->options[0]->redemptionLocations[0]->lng,
												'pitch_html' => $valueCL->pitchHtml,
												'fine_print' => $valueCL->finePrint,
												'location_note' => $valueCL->locationNote,
												'is_limited' => @$valueCL->options[0]->isLimitedQuantity,
												'discount' => @$valueCL->options[0]->discount->formattedAmount,
												'price_after_discount' => @$valueCL->options[0]->price->formattedAmount,
												'actual_price' => @$valueCL->options[0]->value->formattedAmount);
				?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="javascript:void(0);" onclick="group_deal_popup(this, '<?php echo $valueCL->uuid; ?>');">
							<div class="top_rstrnt_deal_wrap">
								<div class="adjst_img_wrap_height">
									<div class="ajst_img_box">
										<img src="<?php echo $valueCL->grid4ImageUrl; ?>" alt="<?php echo $valueCL->shortAnnouncementTitle; ?>">
									</div>
								</div>
								<div class="rstrnt_des_wrap">
									<div class="restrnt_desp_text_box">
										<h3 title="<?php echo $valueCL->title; ?>"><?php echo strlen($valueCL->title) > 55 ? substr($valueCL->title, 0, 55) . "..." : $valueCL->title; ?></h3>
									</div>
								</div>
							</div>
							<span><?php echo img('powered-by-groupon.png'); ?></span>
						</a>
					</div>
				<?php
					// echo $cnt == 4 ? '</div>' : '';
					// $cnt == 4 ? $cnt = 1 : $cnt++;
				}
				?>
			</div>

			<script type="text/javascript">
				var iDeals = <?php echo json_encode($js_deals_arr, JSON_FORCE_OBJECT); ?>;
			</script>

		</div>
	</section>
</div>

<div class="row">
	<section class="top_rstrnt_deal">
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Products/Deals You May Like</h2>
				<a href="<?php echo base_url('deals?search_src=home_pg&cat_name=&store_zipcode=&src=ebay&price_range%5B%5D=&price_range%5B%5D=&keyword=' . $coupons['ebay']['keyword'] . '&sort_order=&sort_distance=&sort_zipcode='); ?>" class="btn ylew_btn pull-right">SEE MORE</a>
			</div>

			<div class="row">
				<?php
				foreach ($coupons['ebay']['items']['via_keyword'] as $keyCL => $valueCL)
				{
					$title = strlen($valueCL['title']) > 55 ? substr($valueCL['title'], 0, 55) . "..." : $valueCL['title'];
					if (array_key_exists('subtitle', $valueCL))
					{
						$title = strlen($valueCL['subtitle']) > 55 ? substr($valueCL['subtitle'], 0, 55) . "..." : $valueCL['subtitle'];
					}
				?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="<?php echo $valueCL['viewItemURL']; ?>">
							<div class="top_rstrnt_deal_wrap">
								<div class="adjst_img_wrap_height">
									<div class="ajst_img_box">
										<img src="<?php echo $valueCL['galleryURL']; ?>" alt="<?php echo $valueCL['itemId']; ?>">
									</div>
								</div>
								<div class="rstrnt_des_wrap">
									<div class="restrnt_desp_text_box">
										<h3 title="<?php echo $title; ?>"><?php echo $title; ?></h3>
									</div>
								</div>
							</div>
							<span><?php echo img('powered-by-ebay.jpg'); ?></span>
						</a>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</section>
</div>

<div class="row">
	<section class="top_rstrnt_deal gery_bg section_with_pdd_btm">
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Express Your Love This Valentine Week</h2>
				<a href="<?php echo base_url('deals?search_src=search_pg&cat_name=&store_zipcode=&src=amazon&price_range%5B%5D=&price_range%5B%5D=&keyword=Valentine+Gift&sort_order=&sort_distance=&sort_zipcode='); ?>" class="btn ylew_btn pull-right">SEE MORE</a>
			</div>

			<div class="row">
				<div class="latest_deals">
					<div id="latest_deals_slider_ltr"  class="owl-carousel">
						<?php
						$coupons['amazon'] = array_slice($coupons['amazon'], 6);
						foreach ($coupons['amazon'] as $keyCL => $valueCL)
						{
						?>
							<div class="item">
								<a href="<?php echo $valueCL['url']; ?>">
									<div class="top_rstrnt_deal_wrap">
										<div class="adjst_img_wrap_height">
											<div class="ajst_img_box">
												<img src="<?php echo $valueCL['mediumImage']; ?>" alt="<?php echo $valueCL['asin']; ?>">
											</div>
										</div>
										<div class="rstrnt_des_wrap">
											<div class="restrnt_desp_text_box">
												<h3 title="<?php echo strlen($valueCL['title']) > 55 ? substr($valueCL['title'], 0, 55) . "..." : $valueCL['title']; ?>"><?php echo strlen($valueCL['title']) > 55 ? substr($valueCL['title'], 0, 55) . "..." : $valueCL['title']; ?></h3>
											</div>
										</div>
									</div>
									<span><?php echo img('powered-by-amazon.jpg'); ?></span>
								</a>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="latest_deals">
					<div id="latest_deals_slider_rtl"  class="owl-carousel">
						<?php
						foreach ($coupons['ebay']['items']['trending'] as $keyCL => $valueCL)
						{
							$title = strlen($valueCL['title']) > 55 ? substr($valueCL['title'], 0, 55) . "..." : $valueCL['title'];
							if (array_key_exists('subtitle', $valueCL))
							{
								$title = strlen($valueCL['subtitle']) > 55 ? substr($valueCL['subtitle'], 0, 55) . "..." : $valueCL['subtitle'];
							}
						?>
							<div class="item">
								<a href="<?php echo $valueCL['viewItemURL']; ?>">
									<div class="top_rstrnt_deal_wrap">
										<div class="adjst_img_wrap_height">
											<div class="ajst_img_box">
												<img src="<?php echo $valueCL['galleryURL']; ?>" alt="<?php echo $valueCL['itemId']; ?>">
											</div>
										</div>
										<div class="rstrnt_des_wrap">
											<div class="restrnt_desp_text_box">
												<h3 title="<?php echo $title; ?>"><?php echo $title; ?></h3>
											</div>
										</div>
									</div>
									<span><?php echo img('powered-by-ebay.jpg'); ?></span>
								</a>
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

<a href="javascript:void(0);" class="move_to_top" onclick="topFunction()" id="myBtn" title="Go to top"><?php echo img('move-to-top.png'); ?></a>

<div class="row">
	<section class="top_rstrnt_deal">
		<div class="container">
			<div class="newsletter_wrap">
				<div class="row">
					<div class="col-xs-12 col-sm-2">
						<img src="<?php echo base_url('assets/img/emailCZ.png'); ?>" alt="News Letter">
					</div>
					<div class="col-xs-12 col-sm-10 news_letter_content_wrap">
						<h3>Newsletter</h3>
						<p>Subscribe to our newsletter to find out more about Coupon Zipcode.</p>
						<form class="form-inline">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name" id="nl_name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email" id="nl_email">
							</div>
							<button type="button" class="btn ylew_btn" onclick="subscribe_newsletter();">SUBSCRIBE</button>
						</form>
					</div>
				</div>
			</div>
			
			<?php
			if (sizeof($featured_stores) > 0)
			{
			?>
				<div class="heading_text_wrap">
					<h2>Featured Stores</h2>
				</div>

				<div class="deals_event">
					<?php
					foreach ($featured_stores as $keyFS => $valueFS)
					{
						$store_name = strlen($valueFS['store_name']) > 10 ? substr($valueFS['store_name'], 0, 8) : $valueFS['store_name'];
					?>
						<div class="deals_you_like rstrnt_deal" style="background:url(<?php echo base_url(str_replace("\\", "/", $valueFS['store_featured_image'])); ?>);">
							<div class="deals_you_like_wrap">
								<h3><?php echo $store_name; ?></h3>
								<div class="deals_you_like_des">
									<h4><?php echo $valueFS['store_name']; ?></h4>
									<small><?php echo $valueFS['store_website']; ?></small>
									<p><?php echo strlen($valueFS['store_description']) > 120 ? substr($valueFS['store_description'], 0, 120) . '...&nbsp;' : $valueFS['store_description']; ?></p>
									<a href="<?php echo base_url('coupon/' . $valueFS['coupon_id']); ?>" class="btn ylew_btn">View Deals</a>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>
		</div>			
	</section>
</div>

<script type="text/javascript">
	function group_deal_popup(ele, uuid)
	{
		$('#groupon_deal_popup .socil_link_wrap .copy_deal_item').hide();
		$('#groupon_deal_popup .light_slider_wrap').html('<img src="' + iDeals[uuid]['image'] + '">');
		$('#groupon_deal_popup .deal_title').html(iDeals[uuid]['title']);

		if (iDeals[uuid]['location'] == null || iDeals[uuid]['location'] == '')
		{
			$(".map_wrap").hide();
			$('#groupon_deal_popup #redemption_location').parent('h4').hide();
		}
		else
		{
			$('#groupon_deal_popup #redemption_location').html(iDeals[uuid]['location']);

			$(".map_wrap").show();
			initMap(iDeals[uuid]['latitude'], iDeals[uuid]['longitude']);
		}

		if (iDeals[uuid]['actual_price'] == null || iDeals[uuid]['actual_price'] == '$0.00' || iDeals[uuid]['actual_price'] == '$0' || iDeals[uuid]['actual_price'] == '')
		{
			$(".discount_wrap").hide();
		}
		else
		{
			$('#groupon_deal_popup .old_price').html(iDeals[uuid]['actual_price']);
			$('#groupon_deal_popup .new_price').html(iDeals[uuid]['price_after_discount']);
			$('#groupon_deal_popup .discount_prcnt').html('You Saved&nbsp;' + iDeals[uuid]['discount']);
			$(".discount_wrap").show();
		}

		$('#groupon_deal_popup #pitch_html_div').html("<h3 class='body_heading'>You'll Get</h3>" + iDeals[uuid]['pitch_html']);
		$('#groupon_deal_popup #fine_print_div').html("<h3 class='body_heading'>The Fine Print</h3>" + iDeals[uuid]['fine_print']);
		$('#groupon_deal_popup #short_title').html('<span>Location</span>' + iDeals[uuid]['short_title']);
		$('#groupon_deal_popup #get_deal_btn').attr('href', iDeals[uuid]['deal_url']);
		$('#groupon_deal_popup .socil_link_wrap #copy_deal_url').val(iDeals[uuid]['deal_url']);

		$('#groupon_deal_popup').modal('show');
	}
</script>

<div class="modal fade groupon_deal_popup" id="groupon_deal_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><?php echo img('cross.png'); ?></span></button>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<h3 class="deal_title"></h3>
				</div>

				<div class="col-sm-5">
					<div class="light_slider_wrap"></div>
					<div class="left-lower-wrap">
						<p class="discount_wrap">
							<strike class="old_price"></strike>
							<label class="new_price"></label>
							<span class="discount_prcnt pull-right"></span>
						</p>

						<a id="get_deal_btn" href="javascript:void(0)" class="btn ylew_btn">Get Deal</a>

						<div class="location_wrap col-sm-6">
							<span id="redemption_location_link"><i class="fa fa-map-marker"></i></span>
							<span id="redemption_location"></span>
						</div>
						
						<div class="socil_link_wrap col-sm-6">
							<a href="javascript:void(0);" onclick="toggle_copy_input();"><i class="fa fa-share-alt"></i>&nbsp;Share this deal</a>
							<input type="text" name="deal_url" class="form-control copy_deal_item" id="copy_deal_url" readonly>&nbsp;<span class="copy_deal_item">Copy Link</span>
						</div>
					</div>
				</div>

				<div class="col-sm-7 right_text_wrap">
					<div class="popup_body_text_wrap" id="pitch_html_div"></div>
				</div>

				<div class="col-xs-12"><hr></div>

				<div class="col-xs-12 popup_body_text_wrap" id="fine_print_div"></div>

				<div class="col-xs-12"><hr></div>

				<div class="col-xs-12 popup_body_text_wrap map_wrap">
					<h3 class="body_heading" id="short_title"></h3>
					<div class="map" id="groupon_popup_map"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_settings('google_map_key'); ?>"></script>
<script type="text/javascript">
	function initMap(lat, long)
	{
		var uluru = {lat: lat, lng: long};

		var map = new google.maps.Map(document.getElementById('groupon_popup_map'), {
			zoom: 10,
			center: uluru
		});

		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
	}

	function toggle_copy_input()
	{
		$('#groupon_deal_popup .socil_link_wrap .copy_deal_item').toggle();
	}

	window.onscroll = function() {scrollFunction()};

	//Scroll function
	function scrollFunction() {
	    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
	        document.getElementById("myBtn").style.display = "block";
	    } 
	    else {
	        document.getElementById("myBtn").style.display = "none";
	    }
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() 
	{
		$('body,html').animate({
	        scrollTop: 0
	    }, 1500);
	    
	    return false;
	}
</script>
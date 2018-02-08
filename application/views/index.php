<div class="row">
	<section>
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Coupon Zipcode Exclusive</h2>
				<a href="javascript:void(0);" class="btn ylew_btn pull-right">SEE MORE</a>
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
												<h3><?php echo $valueALC['store_name']; ?>&nbsp;<i class="fa fa-long-arrow-right"></i> </h3>
												<h4><?php echo $valueALC['coupon_title']; ?></h4>
												<h5><?php echo substr($valueALC['coupon_description'], 0, 150) . '...'; ?></h5>
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
	<section class="top_rstrnt_deal gery_bg">
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Top Restaurant Deals Near You</h2>
				<!-- <h2>Top Restaurant Deals in New York</h2> -->
				<a href="javascript:void(0);" class="btn ylew_btn pull-right">SEE MORE</a>
			</div>

			<?php
			$cnt = 1;
			$js_deals_arr = array();
			foreach ($coupons_by_location->deals as $keyCL => $valueCL)
			{
				echo $cnt == 1 ? '<div class="row">' : '';

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
				<div class="col-sm-3">
					<a href="javascript:void(0);" onclick="group_deal_popup(this, '<?php echo $valueCL->uuid; ?>');">
						<div class="top_rstrnt_deal_wrap">
							<img src="<?php echo $valueCL->grid4ImageUrl; ?>" alt="<?php echo $valueCL->shortAnnouncementTitle; ?>">
							<div class="rstrnt_des_wrap">
								<div class="location_box light_green_bg">
									<i class="fa fa-map-marker"></i>&nbsp;
									<?php echo $valueCL->redemptionLocation ? $valueCL->redemptionLocation : 'n/a'; ?>
								</div>
								<div class="restrnt_desp_text_box">
									<h3 title="<?php echo $valueCL->title; ?>"><?php echo strlen($valueCL->title) > 36 ? substr($valueCL->title, 0, 37) . "..." : $valueCL->title; ?></h3>
									<p>
										<i>Categories:&nbsp;
										<?php
											$sliced_tags = array_slice($valueCL->tags, 0, 5);
											foreach ($sliced_tags as $keyTG => $valueTG)
											{
											?>
												<small class="deal_tag"><?php echo $valueTG->name; echo $keyTG+1 != sizeof($sliced_tags) ? ', ' : ''; ?></small>
											<?php
											}
										?>
										</i>
									</p>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php
				echo $cnt == 4 ? '</div>' : '';
				$cnt == 4 ? $cnt = 1 : $cnt++;
			}
			?>

			<script type="text/javascript">
				var iDeals = <?php echo json_encode($js_deals_arr, JSON_FORCE_OBJECT); ?>;
			</script>
		</div>			
	</section>
</div>
<a href="javascript:void(0);" class="move_to_top" onclick="topFunction()" id="myBtn" title="Go to top">
	<i class="fa fa-arrow-up"></i>
</a>
<div class="row">
	<section class="top_rstrnt_deal">
		<div class="container">
			<div class="heading_text_wrap">
				<h2>Deals You May Like</h2>
				<a href="javascript:void(0);" class="btn ylew_btn pull-right">SEE MORE</a>
			</div>
			<div class="deals_event">
				<div class="deals_you_like rstrnt_deal">
					<div class="deals_you_like_wrap">
						<h3>Lorem </h3>
						<div class="deals_you_like_des">
							<h4>Lorem ipsum</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							<a href="javascript:void(0);" class="btn btn-success">View Deals</a>
						</div>
					</div>
				</div>
				<div class="deals_you_like food_deal">
					<div class="deals_you_like_wrap">
						<h3>Lorem</h3>
						<div class="deals_you_like_des">
							<h4>Lorem ipsum</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							<a href="javascript:void(0);" class="btn btn-success">View Deals</a>
						</div>
					</div>
				</div>
				<div class="deals_you_like beauty_deal">
					<div class="deals_you_like_wrap">
						<h3>Lorem </h3>
						<div class="deals_you_like_des">
							<h4>Lorem ipsum</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							<a href="javascript:void(0);" class="btn btn-success">View Deals</a>
						</div>
					</div>
				</div>
				<div class="deals_you_like baby_product_deal">
					<div class="deals_you_like_wrap">
						<h3>Lorem </h3>
						<div class="deals_you_like_des">
							<h4>Lorem ipsum</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							<a href="javascript:void(0);" class="btn btn-success">View Deals</a>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-sm-4">
					<div class="top_rstrnt_deal_wrap">
						<?php echo img('top_deal.jpg', array('alt' => 'Top Restaurant')); ?>
						<div class="rstrnt_des_wrap">
							<div class="location_box light_green_bg">
								<i class="fa fa-map-marker"></i> Your Location
							</div>
							<div class="restrnt_desp_text_box">
								<h3>Eiusmod tempor incididunt ut Labore et dolore magna.</h3>
								<a href="#">exercitation ullamco </a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="top_rstrnt_deal_wrap">
						<?php echo img('top_deal.jpg', array('alt' => 'Top Restaurant')); ?>
						<div class="rstrnt_des_wrap">
							<div class="location_box light_green_bg">
								<i class="fa fa-map-marker"></i> Your Location
							</div>
							<div class="restrnt_desp_text_box">
								<h3>Eiusmod tempor incididunt ut Labore et dolore magna.</h3>
								<a href="#">exercitation ullamco </a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="top_rstrnt_deal_wrap">
						<?php echo img('top_deal.jpg', array('alt' => 'Top Restaurant')); ?>
						<div class="rstrnt_des_wrap">
							<div class="location_box light_green_bg">
								<i class="fa fa-map-marker"></i> Your Location
							</div>
							<div class="restrnt_desp_text_box">
								<h3>Eiusmod tempor incididunt ut Labore et dolore magna.</h3>
								<a href="#">exercitation ullamco </a>
							</div>
						</div>
					</div>
				</div>
			</div> -->
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
	    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
	        document.getElementById("myBtn").style.display = "block";
	    } else {
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
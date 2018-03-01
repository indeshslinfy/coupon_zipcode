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
							<!-- <div class="location_box light_green_bg">
								<i class="fa fa-map-marker"></i>&nbsp;
								<?php echo $valueCC['store_name']; ?>
							</div> -->
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
	elseif (array_key_exists('restaurant_dot_com', $coupons))
	{
		foreach ($coupons['restaurant_dot_com'] as $keyCC => $valueCC)
		{
		?>
			<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
				<a data-toggle="tooltip" title="<?php echo $valueCC['name']; ?>" href="<?php echo $valueCC['buy-url']; ?>">
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
								<h4><?php echo $valueCC['name']; ?></h4>
								<p>Price:&nbsp;&#36;<?php echo is_array($valueCC['sale-price']) ? $valueCC['price'] : $valueCC['sale-price']; ?></p>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?php
		}
	}
	elseif (array_key_exists('groupon', $coupons))
	{
		foreach ($coupons['groupon'] as $keyCC => $valueCC)
		{
		?>
			<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
				<a data-toggle="tooltip" title="<?php echo $valueCC->title; ?>" data-placement="left" href="<?php echo $valueCC->dealUrl; ?>">
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
		}
	}
	elseif (array_key_exists('ebay', $coupons))
	{
		foreach ($coupons['ebay'] as $keyCC => $valueCC)
		{
		?>
			<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
				<a data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>" data-placement="left" href="<?php echo $valueCC['viewItemURL']; ?>">
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
								<h4><?php echo strlen($valueCC['title']) > 36 ? substr($valueCC['title'], 0, 37) . "..." : $valueCC['title']; ?></h4>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?php
		}
	}
	elseif (array_key_exists('amazon', $coupons))
	{
		foreach ($coupons['amazon'] as $keyCC => $valueCC)
		{
		?>
			<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
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
		}
	}
?>
	<script type="text/javascript">
		$("#load_more_btn").show();
	</script>
<?php
}
else
{
?>
	<div class="no-coupons-div-ajax text-center">
		<h4>That's all folks</h4>
	</div>

	<script type="text/javascript">
		$("#load_more_btn").hide();
	</script>
<?php
}
?>
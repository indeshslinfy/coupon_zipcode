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
			echo $cnt == 1 ? '<div class="rowcoupon_row_wrap">' : '';
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
			echo $cnt == 1 ? '<div class="rowcoupon_row_wrap">' : '';
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
								<?php echo strlen($valueCC['location']) > 30 ? substr($valueCC['location'], 0, 30) . "..." : $valueCC['location']; ?>
							</div> -->
							<div class="restrnt_desp_text_box">
								<h4><?php echo strlen($valueCC['title']) > 36 ? substr($valueCC['title'], 0, 37) . "..." : $valueCC['title']; ?></h4>
								<!-- <p>
									Price:&nbsp;<?php echo $valueCC['sellingStatus']['currentPrice']; ?>
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
			echo $cnt == 1 ? '<div class="rowcoupon_row_wrap">' : '';
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
?>
	<script type="text/javascript">
		$("#load_more_btn").show();
	</script>
<?php
}
else
{
?>
	<div class="no-coupons-div">
		<div>
			<h4 class="text-center">That's all folks</h4>
		</div>
	</div>

	<script type="text/javascript">
		$("#load_more_btn").hide();
	</script>
<?php
}
?>
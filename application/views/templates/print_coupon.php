<!DOCTYPE html>
<html>
<head>
	<title><?php echo $coupon_title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700" rel="stylesheet">
	<?php $general_settings = get_settings('general_settings'); ?>
</head>
<body>
	<div class="wrapper">
		<table style="width:100%" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:25%;border-right:1px dashed #c3c3c3;vertical-align:top;padding-right: 20px;">
					<img style="max-width:200px;" src="<?php echo $store_featured_image ? getcwd() . DS . str_replace('\\', '/', $store_featured_image) : @$general_settings['company_logo']; ?>" alt="Store Logo">
					<p class="redeem_loc"">Redeem at this location:</p>
					<p style="margin: 0px;font-size: 14px;"><?php echo str_replace(", ,", ", ", $address_line1 . ', ' . $address_line2 . ', ' . $address_line3 . ', ' . $city_name . ', ' . $state_name . ', ' . $country_name . '. ' . $coupon_zipcode); ?></p>
					<p style="margin: 3px 0 0 0;font-size: 14px;"><?php echo $store_phone; ?></p>
				</td>

				<td style="width:75%; vertical-align: top;padding-left: 20px;">
					<table style="width:100%" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="2" style="text-align:left;vertical-align: top;">
								<h2 style="margin: 0px;"><?php echo $store_name; ?></h2>
								<h4 style="margin: 5px 0 20px 0;"><?php echo $coupon_title; ?></h4>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: bottom;width:50%">
								<p style="margin: 0px;">
									<span style="font-size:13px;font-weight: 600;">Expiration Date:</span>&nbsp;
									<span style="font-size:13px;color:#f66414;font-weight: 600"><?php echo date('d M, Y', strtotime($coupon_end_date)); ?></span>
								</p>
							</td>
							<td style="text-align: right; width:50%">
								<span class="green_btn" style="float:right;width:130px;margin:10px 0px;display:block;font-weight: 600;font-size: 15px;">Coupon Code</span>
							</td>
						</tr>
						<tr>
							<td style=" width:50%"></td>
							<td style="text-align: right; width:50%">
								<br>
								<span class="coupon_code" style="float:right;width:auto;margin:0;display:block;font-weight: 600;font-size: 15px;"><?php echo $coupon_code; ?></span>
							</td>
						</tr>
						<tr>
							<td>&nbsp;<br><br><br></td>
							<td>&nbsp;</td>
						</tr>
						<?php
						if ($coupon_fine_print != '')
						{
						?>
							<tr>
								<td colspan="2" style="padding: 10px 15px; border: 2px dashed #226f06;font-size: 13px;font-weight: 600;color: #3c4044;"><?php echo $coupon_fine_print; ?></td>
								<td></td>
							</tr>
						<?php
						}
						?>
						<tr>
							<td>&nbsp;<br><br><br></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: right;vertical-align: bottom;font-size: 12px;">
								<span><?php echo $general_settings['company_name']; ?></span>
								<br>
								<span>You Local Convinence</span>
							</td>
							<td></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>

<style type="text/css">
	body{
		font-family: 'Rajdhani', sans-serif;
	}
	.expiry_div p{
		margin-top: 3px;
	}
	.expiry_div p span:nth-child(1){
		font-weight: 600;
	}
	.expiry_div p span:nth-child(2){
		font-weight: 500;
		color: #f66414;
	}
	.green_btn{
		font-size: 18px;
		font-weight: 500;
		border-radius: 0px;
		color: #fff;
		padding: 2px 10px;
		background: #226f05;
		display: inline-block;
		min-width: 130px;
		text-align: center;
		border: 1px solid #226f05;
	}
	.coupon_code{
		background: none;
		text-align: center;
		border: 1px dashed #226f05;
		color: #226f05;
		font-size: 18px;
		font-weight: 500;
		border-radius: 0px;
		padding: 2px 10px;
		margin-top: 3px;
		min-width: 131px;
		display: inline-block;
	}
	.post_note{
		float: left;
		width: 96%;
		padding: 10px 15px;
		margin-bottom: 35px;
		margin-top: 35px;
		border: 2px dashed #226f06;
		border-radius: 4px;
		font-size: 16px;
		font-weight: 600;
		color: #3c4044;
	}
	.footer{
		float: right;
		width: 100%;
		text-align: right;
	}
	.footer p:nth-child(1),
	.footer p:nth-child(2){
		margin-bottom: 0px;
	}
	.footer p:nth-child(2){
		margin-top: 0px;
	}
	.redeem_loc{
		color: #226f06;
		font-weight: 600;
		font-size: 16px;
		margin: 3px 0 0 0;
	}
	.left-pane p{
		margin-top: 0px;
		margin-bottom: 5px;
	}
	.left-pane img{
		max-width:100%;
		max-height:225px;
	}
	.right-pane h1{
		margin-top: -5px;
		margin-bottom: 10px;
	}
	.wrapper{
		border: 2px solid #226f06;
		float: left;
		width: 100%;
		padding:20px;
	}
	.post_note_wrap{
		min-height: 220px;
		max-height: 220px;
	}
</style>
</html>
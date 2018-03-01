<?php
	$general_settings = get_settings('general_settings');

	$location_arr = get_user_location_data();
	$featured_stores = get_featured_stores(6, $location_arr['zipcode_id']);
	if (sizeof($featured_stores) == 0) 
	{
		$featured_stores = get_featured_stores(6);
	}
?>

<script type="text/javascript">
	var all_zipcodes ='<?php echo json_encode(get_zipcodes()); ?>';
	var all_store_cats ='<?php echo json_encode(get_stores_categories()); ?>';
</script>

<div class="row">
	<footer>
		<div class="container">
			<div class="row footer_wrap">
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 online_coupan_link">
					<h3>Online Coupons</h3>
					<ul>
						<li><a href="javascript:void(0);">Angie's List</a></li>
						<li><a href="javascript:void(0);">Ann Taylor</a></li>
						<li><a href="javascript:void(0);">Athleta</a></li>
						<li><a href="javascript:void(0);">Bluefly</a></li>
						<li><a href="javascript:void(0);">Eddie Bauer</a></li>
					</ul>
				</div>

				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
					<h3>Featured Stores</h3>
					<ul>
						<?php
						foreach ($featured_stores as $keyFS => $valueFS)
						{ 
						?>
							<li><a href="<?php echo base_url('coupon/' . $valueFS['coupon_id']); ?>"><?php echo $valueFS['store_name']; ?></a></li>
						<?php
						}
						?>
					</ul>
				</div>

				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
					<h3>Cities</h3>
					<ul>
						<li><a href="<?php echo base_url('deals?search_src=footer&src=local&store_zipcode=9'); ?>">New York</a></li>
						<li><a href="<?php echo base_url('deals?search_src=footer&src=local&store_zipcode=24'); ?>">Los Angeles</a></li>
						<li><a href="<?php echo base_url('deals?search_src=footer&src=local&store_zipcode=25'); ?>">San Francisco</a></li>
						<li><a href="<?php echo base_url('deals?search_src=footer&src=local&store_zipcode=26'); ?>">Miami</a></li>
						<li><a href="<?php echo base_url('deals?search_src=footer&src=local&store_zipcode=27'); ?>">Chicago</a></li>
					</ul>
				</div>

				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 left_side_line">
					<h3>Help & Support</h3>
					<ul>
						<li><a href="<?php echo base_url('contact-us'); ?>">Contact us</a></li>
						<li><a href="<?php echo base_url('advertise'); ?>">Advertise with us</a></li>
						<li><a href="<?php echo base_url('how-it-works'); ?>">How it works</a></li>
						<li><a href="<?php echo base_url('terms-of-use'); ?>">Terms and Conditions</a></li>
						<li><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer_copy_right">
			<span class="pull-left">&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;<?php echo $general_settings['company_name']; ?> Inc.</span>
			<span class="pull-right">
				<small>Designed by:&nbsp;</small>
				<a href="http://www.slinfy.com" target="_blank">Solitaire Infosys</a>
			</span>
		</div>
	</footer>
</div>

<a href="javascript:void(0);" class="move_to_top" onclick="to_top()" id="myBtn" title="Go to top"><?php echo img('move-to-top.png'); ?></a>
</div>

<!-- Modal-for-select-location -->
<div class="modal fade select_location_popup" id="select_location_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="background:url(<?php echo base_url('assets/img/popup_bg.jpg'); ?>)">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    	<div class="get_start_wrap_box text-center">
				<h3>Why search the web? We have done all the work for you! All deals from all places under one roof!</h3>
				<p>(<?php echo $general_settings['company_name']; ?>, Groupon, Restaurant and many more deals)</p>
				<div class="form_wrap">
					<form>
						<div class="select_city_form">
							<div class="form-group">
				        		<div class="select_city selct_location_wrap">
				        			<i class="fa fa-map-marker"></i>
				        			<input type="text" id="zipcode" class="form-control zpcde_auto" placeholder="Enter Zipcode">
				        		</div>
				        		
			        			<a href="javascript:void(0);" class="btn ylew_btn" id="search_zipcode">Select</a>
			        		</div>
			        		<div class="form-group">
			        			<span class="optional_text">or</span>
			        			<a href="javascript:void(0);" onclick="getLocation();" class="btn ylew_btn currnt_loc_btn">Use My Current Location</a>
			        		</div>
			        	</div>
					</form>
				</div>
			</div>
		</div>
    </div>
 </div>

<div class="cssload-container">
	<div class="cssload-loader"></div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
	echo js('frontend/jquery.nicescroll.min.js');
	echo js('frontend/owl.carousel.min.js');
	echo js('frontend/scripts.js');
	echo iplugin('easy_autocomplete', array('file_name' => 'jquery.easy-autocomplete', 'file_type' => 'js'));
?>
</body>
</html>
<div class="row">
	<footer>
		<div class="container">
			<div class="row footer_wrap">
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 online_coupan_link">
					<h3>Online Coupons</h3>
					<ul>
						<li><a href="javascript:void(0);">Angie's List</a></li>
						<li><a href="javascript:void(0);">Ann Taylor</a></li>
						<li><a href="javascript:void(0);">Athleta</a></li>
						<li><a href="javascript:void(0);">Bluefly</a></li>
						<li><a href="javascript:void(0);">Brooks Brothers</a></li>
						<li><a href="javascript:void(0);">Eddie Bauer</a></li>
					</ul>
					<ul>
						<li>
							<a href="javascript:void(0);">Express</a>
						</li>
						<li>
							<a href="javascript:void(0);">Gap</a>
						</li>
						<li>
							<a href="<?php echo base_url('/'); ?>">Home</a>
						</li>
						<li>
							<a href="javascript:void(0);">Depot</a>
						</li>
						<li>
							<a href="javascript:void(0);">Hotels.com</a>
						</li>
						<li>
							<a href="javascript:void(0);">LOFT</a>
						</li>
					</ul>
					<ul>
						<li>
							<a href="javascript:void(0);">Old Navy</a>
						</li>
						<li>
							<a href="javascript:void(0);">Priceline</a>
						</li>
						<li>
							<a href="javascript:void(0);">Sears</a>
						</li>
						<li>
							<a href="javascript:void(0);">Sunglass Hut</a>
						</li>
						<li>
							<a href="javascript:void(0);">Under Armour</a>
						</li>
						<li>
							<a href="javascript:void(0);">Vistaprint </a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2">
					<h3>Cities</h3>
					<ul>
						<li>
							<a href="javascript:void(0);">City Directory</a>
						</li>
						<li>
							<a href="javascript:void(0);">New York</a>
						</li>
						<li>
							<a href="javascript:void(0);">Los Angeles</a>
						</li>
						<li>
							<a href="javascript:void(0);">San Francisco</a>
						</li>
						<li>
							<a href="javascript:void(0);">Miami</a>
						</li>
						<li>
							<a href="javascript:void(0);">Chicago</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 left_side_line">
					<h3>Links</h3>
					<ul>
						<li>
							<a href="javascript:void(0);">Dining & Nightlife</a>
						</li>
						<li>
							<a href="javascript:void(0);">Health & Beauty</a>
						</li>
						<li>
							<a href="javascript:void(0);">Activities & Events</a>
						</li>
						<li>
							<a href="javascript:void(0);">Fitness</a>
						</li>
						<li>
							<a href="javascript:void(0);">Shop</a>
						</li>
						<li>
							<a href="javascript:void(0);">Travel</a>
						</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
					<h3>Help & Support</h3>
					<ul>
						<li>
							<a href="<?php echo base_url('contact-us'); ?>">Contact Us</a>
						</li>
						<li>
							<a href="javascript:void(0);">Jobs</a>
						</li>
						<li>
							<a href="javascript:void(0);">Press</a>
						</li>
						<li>
							<a href="<?php echo base_url('terms-of-use'); ?>">Terms and Conditions</a>
						</li>
						<li>
							<a href="<?php echo base_url('privacy-policy'); ?>">Privacy</a>
						</li>
						<li>
							<a href="<?php echo base_url('knowledge-base'); ?>">FAQ</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer_copy_right">
			<span class="pull-left">&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;Coupon Cipcode Inc.</span>
			<span class="pull-right">
				<small>Designed by:&nbsp;</small>
				<a href="http://www.slinfy.com" target="_blank">Solitaire Infosys</a>
			</span>
		</div>
	</footer>
</div>
</div>

<!-- Modal-for-select-location -->
<div class="modal fade select_location_popup" id="select_location_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" style="background:url(<?php echo base_url('assets/img/popup_bg.jpg'); ?>)">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    	<div class="get_start_wrap_box text-center">
				<h3>Why search the web? We have done all the work for you! All deals from all places under one roof!</h3>
				<p>(Groupon, Yelp, CouponZipcode Deals)</p>
				<div class="form_wrap">
					<form>
						<div class="select_city_form">
							<div class="form-group">
				        		<div class="select_city">
				        			<i class="fa fa-map-marker"></i>
				        			<input type="text" class="form-control" placeholder="Enter Your Zip Code">
				        		</div>
				        		<span class="optional_text">or</span>
			        			<a href="javascript:void(0);" class="btn ylew_btn">Use My Current Location</a>
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
	echo js('frontend/scripts.js');
?>
</body>
</html>
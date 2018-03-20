$(document).ready(function()
{
	if (typeof $.cookie('allow_locn_popup') == 'undefined' || $.cookie('allow_locn_popup') == false)
	{
		console.log('cookie not set');
		setTimeout(function()
		{
			if (allow_location_popup)
			{
				$('#header_location_anch').click();
			}
		}, 700);
	}

	$("body").css('overflow', 'auto');
	$("body").niceScroll({cursorborder:"", cursorcolor:"#1A5006"});

	$(".ticketing_chatbox_wrap").niceScroll({cursorborder:"", cursorcolor:"#2C3E50"});

	var height_calc = $(window).height();
	$('.popup_bg').height(height_calc);

	$(window).resize(function()
	{
		var height_calc = $(window).height();
		$('.popup_bg').height(height_calc);
	});

	$("#adding_stores").click(function(){
		$("#kb_1_1").removeClass('hide');
		$("#kb_2_1").addClass('hide');
	});

	$("#adding_coupons").click(function(){
		$("#kb_1_1").addClass('hide');
		$("#kb_2_1").removeClass('hide');
	});

	// setTimeout(function(){
	// 	$('.cssload-container').css('display', 'none');
	// }, 1000);
	
 	$('#exclusive_coupan_carousel').owlCarousel({
		loop:true,
		items: 3,
		autoplay: true,
		smartSpeed: 1000,
		nav: true,
		navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsiveClass: true,
		responsive:{
			0:{
			    items:1,
			    nav:true
			},
			600:{
			    items:2,
			    nav:true
			},
			900:{
			    items:3,
			    nav:true
			}
		}
	});

	$('#latest_deals_slider_ltr').owlCarousel({
		rtl:true,
	    loop:true,
	    items : 3,
	    autoplay:true,
	    smartSpeed:1000,
	    nav:true,
	    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:2,
	            nav:true
	        },
	        800:{
	            items:3,
	            nav:true
	        },
	        1200:{
	            items:4,
	            nav:true
	        }
	    }
	});

	$('#latest_deals_slider_rtl').owlCarousel({
		loop:true,
	    items : 3,
	    autoplay:true,
	    smartSpeed:1000,
	    nav:true,
	    navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:2,
	            nav:true
	        },
	        800:{
	            items:3,
	            nav:true
	        },
	        1200:{
	            items:4,
	            nav:true
	        }
	    }
	});

 	$(document).on('click','.filter_toggle',function(){
 		$('.filter_inner_wrap').slideToggle();
 	});

 	bind_cat_autocomplete('.top-srch-cat');
 	bind_zipcode_autocomplete('.zpcde_auto', {'theme': 'dark'}, 5);
 	bind_zipcode_autocomplete('.top-srch-zipcode', {'theme': 'bootstrap'}, 10);
 	bind_zipcode_autocomplete('.cat-srch-zipcode', {'theme': 'bootstrap'}, 10);

$(document).on('click','.onhover_button',function(){
	$('.topheader_srch_frm').toggleClass('searchform');
});

$(document).on('click','.maxwdth_479',function(){
	$('.search_form_wrap').toggleClass('adjstheight');
});

});

function toggle_menu()
{
	$('ul.navbar-nav').toggleClass('toggle-menu-height');
}

function bind_cat_autocomplete(target_class)
{
	var autocomp_options = {
		data: JSON.parse(all_store_cats),
		getValue: "store_category_name",
		template: {
			type: "id",
			fields: {description: "id"}
		},
		list: {
			maxNumberOfElements: 10,
			sort: {enabled: true},
			showAnimation: {
				type: "fade",
				time: 200,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide",
				time: 200,
				callback: function() {}
			},
			match: {enabled: true},
			onChooseEvent: function() {
                $("#top-srch-cat").val($(".top-srch-cat").getSelectedItemData().store_category_slug);
            }
        },
		theme: 'bootstrap'
	};

	$(target_class).easyAutocomplete(autocomp_options);
}

function bind_zipcode_autocomplete(target_class, options, limits)
{
	var autocomp_options = {
		data: JSON.parse(all_zipcodes),
		getValue: "zipcode",
		template: {
			type: "id",
			fields: {description: "id"}
		},
		list: {
			maxNumberOfElements: limits,
			sort: {enabled: true},
			showAnimation: {
				type: "fade",
				time: 200,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide",
				time: 200,
				callback: function() {}
			},
			match: {enabled: true},
			onChooseEvent: function() {
				console.log($(target_class).getSelectedItemData().id);
				$(".store_zipcode_id_hidden").val($(target_class).getSelectedItemData().id);
			}
		},
		theme: options.theme
	};

	$(target_class).easyAutocomplete(autocomp_options);
}

function bind_zipcode_reg_autocomplete()
	{
		var autocomp_options = {
			data: JSON.parse(all_zipcodes),
			getValue: "zipcode",
			template: {
				type: "id",
				fields: {description: "id"}
			},
			list: {
				maxNumberOfElements: 10,
				sort: {enabled: true},
				showAnimation: {
					type: "fade",
					time: 200,
					callback: function() {}
				},
				hideAnimation: {
					type: "slide",
					time: 200,
					callback: function() {}
				},
				match: {enabled: true},
				onChooseEvent: function() {
	                $("#zipcode_id").val($("#store_zipcode").getSelectedItemData().id);
	            }
			},
			theme: 'bootstrap'
		};

		$(".store_register_zipcode").easyAutocomplete(autocomp_options);
	}

function getLocation() 
{
	$('.currnt_loc_btn').html('Please wait...');
	$('.currnt_loc_btn').attr('disabled', 'disabled');
	
	navigator.geolocation.getCurrentPosition(
		function(success) {
			navigator.geolocation.getCurrentPosition(showPosition);
		},
		function(failure) {
			var newyork_locn = JSON.parse(NY_LOCN);
			alert("Either you have blocked location access or geolocation is not supported by this browser. Setting location default to New York City");
			var new_york_location = {coords: {'latitude': newyork_locn.lat, 'longitude': newyork_locn.long}};
			showPosition(new_york_location);
		}
	)
}

function showPosition(position) 
{
	$.ajax({
		type: "GET",
		datatype: "JSON",
		url: BASEURL+"home/get_geo_location?lat=" + position.coords.latitude + "&long=" + position.coords.longitude,
		success: function(data)
		{
			var data = JSON.parse(data);
			if (data.status)
			{
				var loc_html = '<li>\
									<a href="javascript:void(0);" data-toggle="modal" data-target="#select_location_popup">\
										<i class="fa fa-map-marker"></i>&nbsp;Select location<span>' + data.data.zipcode + '</span>\
									</a>\
								</li>';
				$(".header_location_ul").html(loc_html);

				window.location.reload();
			}

			$('.currnt_loc_btn').html('Use My Current Location');
			$('.currnt_loc_btn').removeAttr('disabled');
		}
	});
}

$("#search_zipcode").click(function()
{
	if ($('#zipcode').val() != '')
	{
		$.ajax({
			type: "GET",
			datatype: "JSON",
			url: BASEURL + "home/search_zipcode?zipcode=" + $('#zipcode').val(),
			success: function(data)
			{
				var data = JSON.parse(data);
				if (data.status == 0)
				{
					alert(data.message);
				}
				else
				{
					$.cookie('allow_locn_popup', true, { expires: 1, path: '/'});
					window.location.reload();
				}
			}
		});
	}
});

function subscribe_newsletter()
{
	if ($('#nl_email').val() != '')
	{
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: BASEURL + "index/subscribe_newsletter",
			data: {'subscriber_name': $('#nl_name').val(), 'subscriber_email': $('#nl_email').val()},
			success: function(data)
			{
				alert(data.message);
				if (data.status)
				{
					$('#nl_name').val('');
					$('#nl_email').val('');
				}
			}
		});
	}
}

window.onscroll = function() {
	scroll_it()
};

function scroll_it()
{
	if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)
	{
		document.getElementById("myBtn").style.display = "block";
	} 
	else
	{
		document.getElementById("myBtn").style.display = "none";
	}
}

function to_top() 
{
	$('body, html').animate({
		scrollTop: 0
	}, 1500);

	return false;
}
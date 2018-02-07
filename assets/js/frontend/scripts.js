$(document).ready(function()
{
	var user_current_location = JSON.parse(localStorage.getItem("user_current_location"));
	if (user_current_location == null)
	{
		getLocation();
	}

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

	$('.cssload-container').css('display', 'none');
	
 	$('#exclusive_coupan_carousel').owlCarousel({
		    loop:true,
		    items : 3,
		    autoplay:false,
		    autoplayTimeout:100,
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
		        }
		    }
	});

 	$(document).on('click','.filter_toggle',function(){
 		$('.filter_inner_wrap').slideToggle();
 	});

 	bind_cat_autocomplete('.top-srch-cat');

 	bind_zipcode_autocomplete('.zpcde_auto', {'theme': 'dark'});
 	bind_zipcode_autocomplete('.top-srch-zipcode', {'theme': 'bootstrap'});
});

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

function bind_zipcode_autocomplete(target_class, options)
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
			match: {enabled: true}
        },
		theme: options.theme
	};

	$(target_class).easyAutocomplete(autocomp_options);
}

function getLocation() 
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition);
	}
	else
	{
		alert("Either you have blocked location access or geolocation is not supported by this browser. Setting location default to New York City");
		var new_york_location = {coords: {'latitude': '40.71', 'longitude': '-73.99'}};
		showPosition(new_york_location);
	}
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
			if (data.status == 0)
			{
				alert('Something went wrong while fetching your location. Setting location default to New York City');
				var new_york_location = {coords: {'latitude': '40.71', 'longitude': '-73.99'}};
				showPosition(new_york_location);
			}
			else
			{
				localStorage.setItem("user_current_location", JSON.stringify(data.data));

				var loc_html = '<li>\
									<a href="javascript:void(0);" data-toggle="modal" data-target="#select_location_popup">\
										<i class="fa fa-map-marker"></i>&nbsp;Select location<span>' + data.data.zipcode + '</span>\
									</a>\
								</li>';
				$(".header_location_ul").html(loc_html);

				window.location.reload();
			}
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
					localStorage.setItem("user_current_location", JSON.stringify(data.data));
					window.location.reload();
				}
			}
		});
	}
});
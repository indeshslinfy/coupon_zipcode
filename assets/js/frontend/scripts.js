$(document).ready(function()
{
	var user_current_location = JSON.parse(localStorage.getItem("user_current_location"));
	if (user_current_location == null)
	{
		getLocation();
	}
	else if (user_current_location.zipcode != "")
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
});

function getLocation() 
{
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition);
	}
	else
	{ 
		alert("Geolocation is not supported by this browser.");
	}
}

function showPosition(position) 
{
	$.ajax({
		type: "GET",
		datatype: "JSON",
		url: BASEURL+"home/get_geo_location?lat="+position.coords.latitude+"&long="+position.coords.longitude,
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

				var loc_html = '<li>\
									<a href="javascript:void(0);" data-toggle="modal" data-target="#select_location_popup">\
										<span><i class="fa fa-map-marker"></i>&nbsp;Select location</span>' + data.data.zipcode + '\
									</a>\
								</li>';
				$(".header_location_ul").html(loc_html);
			}
		}
	});
}

$("#search_zipcode").click(function()
{
	$.ajax({
		type: "GET",
		datatype: "JSON",
		url: BASEURL+"home/search_zipcode?zipcode="+$('#zipcode').val(),
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
});
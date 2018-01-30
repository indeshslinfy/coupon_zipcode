$(document).ready(function()
{
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
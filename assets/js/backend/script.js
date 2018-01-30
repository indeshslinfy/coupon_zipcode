$(document).on('click','.forgot_ppswrd_screen',function(){
	$('.login-wrap').css("display","none");
	$('.forgot_password_wrap').css("display","block");
});

$(document).on('click','.cncl_rst_psswrd',function(){
	$('.forgot_password_wrap').css("display","none");
	$('.login-wrap').css("display","block");
});
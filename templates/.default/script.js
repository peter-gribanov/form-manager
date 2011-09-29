$(function(){


$('#form-captcha-button').click(function(e){
	$('#form-captcha-image').attr('src',
		$('#form-captcha-image').attr('src').replace(/(\?.*?)(_=\d+)?/, '$1')
		+'_='+(new Date()).getTime());
	e.stopImmediatePropagation();
	return false;
});


});
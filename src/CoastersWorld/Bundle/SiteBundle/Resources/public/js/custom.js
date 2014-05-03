/* Add here all your JS customizations */

$(function()
{
	$("#login-link, #login-box-container").hover(
		function()
		{
			$("#login-box-container").show();
			$('#login-link').addClass("hover");
		},
		function()
		{
			$("#login-box-container").hide();
			$('#login-link').removeClass("hover");
		}
	);

	$("input[rel=tooltip]").focus(function()
	{
		$(".tooltip-inner").html($(this).attr('data-original-title'));
		$(".tooltip").css('top', $(this).offset().top - $("#register-form-container").offset().top - 50);
		$(".tooltip").css('left', $(this).offset().left - $("#register-form-container").offset().left + $(this).width()/2 - $(".tooltip").width()/2);
		$(".tooltip").css('display', 'block');
		$(".tooltip").animate({opacity: '0.99'}, 500);
	});
	$("input[rel=tooltip]").blur(function()
	{
		$(".tooltip").css('display', 'none');
		$(".tooltip").css('opacity', '0');
		$(".tooltip-inner").html('');
	});
});
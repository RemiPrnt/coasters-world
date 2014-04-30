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
});
$(window).load(function()
{
	$(".post-image.single").each(function()
	{
		var $image = $(this).children("a").children("img.img-thumbnail");
		console.log($image);
		var top = -($image.height()/2)+($(this).height()/2);
		$image.css("top", top+"px");
	});
})
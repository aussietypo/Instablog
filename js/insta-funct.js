$(document).ready(function() {
	$(".opacity").css("opacity","0.5");
	$(".opacity").hover(function () {
		$(this).stop().animate({
		opacity: 1.0
		}, "fast");},function () {
		$(this).stop().animate({
		opacity: 0.5
		}, "fast");
	});
	$('.tip').tooltip();
});
jQuery(function( $ ){

	// Enable parallax and fade effects on homepage sections
	$(window).scroll(function(){

		scrolltop = $(window).scrollTop()
		scrollwindow = scrolltop + $(window).height();

		$(".featured-section").css("backgroundPosition", "50% " + (50+scrolltop/36) + "%");

	});

});
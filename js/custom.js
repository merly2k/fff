/*global jQuery:false */
(function ($) {

	

	//jQuery to collapse the navbar on scroll
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
			$(".top-area").addClass("top-padding");
			$(".navbar-brand").addClass("reduce");

			$(".navbar-custom ul.nav ul.dropdown-menu").css("margin-top","11px");
		
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
			$(".top-area").removeClass("top-padding");
			$(".navbar-brand").removeClass("reduce");

			$(".navbar-custom ul.nav ul.dropdown-menu").css("margin-top","16px");
	
		}
	});
	
	//scroll to top
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
			} else {
			$('.scrollup').fadeOut();
		}
	});
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 1000);
			return false;
	});
	


	//jQuery for page scrolling feature - requires jQuery Easing plugin
	
})(jQuery);
$(window).load(function() {
	$(".loader").delay(100).fadeOut();
	$("#page-loader").delay(100).fadeOut("fast");
});

	

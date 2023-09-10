jQuery(document).ready(function ($) {

	var owl = jQuery('.banner .owl-carousel');
		owl.owlCarousel({
			margin:20,
			nav: true,
			autoplay : true,
			lazyLoad: true,
			autoplayTimeout: 3000,
			loop: false,
			dots:false,
			navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i> '],
			responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			1000: {
				items: 1
			}
		},
		autoplayHoverPause : true,
		mouseDrag: true
	});

	$('.mobile-nav .toggle-button').on( 'click', function() {
		$('.mobile-nav .main-navigation').slideToggle();
	});

	$('.mobile-nav-wrap .close ').on( 'click', function() {
		$('.mobile-nav .main-navigation').slideToggle();

	});

	$('<button class="submenu-toggle"></button>').insertAfter($('.mobile-nav ul .menu-item-has-children > a'));
	$('.mobile-nav ul li .submenu-toggle').on( 'click', function() {
		$(this).next().slideToggle();
		$(this).toggleClass('open');
	});

	//accessible menu for edge
	 $("#site-navigation ul li a").on( 'focus', function() {
	   $(this).parents("li").addClass("focus");
	}).on( 'blur', function() {
	    $(this).parents("li").removeClass("focus");
	 });
});

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});
btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

window.addEventListener('load', (event) => {
    jQuery(".preloader").delay(1000).fadeOut("slow");
});





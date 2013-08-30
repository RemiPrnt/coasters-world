/**
 * Custom jQuery functions
 */
;(function($, undefined) {
	'use strict';

	/**
	 * Page Functions
	 */
	var page = {
		init: function() {
			// tinyNav
			if ($.fn.tinyNav) {
				$('#nav .menu').tinyNav({
					header: 'Got to...'
				});
			}

			// Call Bootstrap Tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// Call Bootstrap Popover
			$('[data-toggle="popover"]').popover({
				trigger: 'hover'
			});

			// fitVids
			if ($.fn.fitVids) {
				$('.video').fitVids();
			}

			// Menu Parent
			$('.menu ul .parent > a').append('<i class="icon-angle-right pull-right" style="margin-top: 2px;"></i>');

			// Nav Stacked Parent
			$('.nav-stacked .parent > a').append('<i class="icon-chevron-right pull-right" style="margin-top: 5px;"></i>');

			// Call Select2
			if ($.fn.select2) {
				$('select').select2();
			}

			// Setup drop down menu
			$('.dropdown-toggle').dropdown();

			// Fix input element click problem
			$('.dropdown input, .dropdown label').click(function(e) {
				e.stopPropagation();
			});
		}
	};

	/**
	 * Sticky Navigation
	 */
	if ($('#nav').length > 0) {
		var sticky_navigation_offset_top = $('#nav').offset().top;
	}

	var sticky_navigation = {
		init: function() {
			if (Modernizr.mq('screen and (min-width: 768px)')) {
				var scroll_top = $(window).scrollTop();

				if (scroll_top > sticky_navigation_offset_top) {
					$('#nav').css({
						'position': 'fixed',
						'top': 0,
						'left': 0
					});

					$('.boxed nav').css({
						'left': ($(window).width() / 2 - $('.boxed nav').width() / 2) + 'px'
					});
				} else {
					$('#nav').css({
						'position': 'relative',
						'left': 'auto'
					});
				}
			}
		}
	};

	/**
	 * Tweet
	 */
	var tweet = {
		init: function() {
			// Ticker Footer
			$('#ticker').tweet({
				username: 'envato', // Change here the username of twitter
				page: 1,
				count: 5,
				template: '<span class="label"><i class="icon-twitter"></i> Twitter</span> {time} {text}'
			}).on('loaded', function() {
				$(this).find('a').prop('target', '_blank');

				$(this).flexslider({
					selector: '.tweet_list > li',
					animation: 'slide',
					direction: 'vertical',
					controlNav: false,
					prevText: '<i class="icon-chevron-left"></i>',
					nextText: '<i class="icon-chevron-right"></i>'
				});
			});

			// Twitter Widget
			$('.twitter-widget').tweet({
				username: 'envato', // Change here the username of twitter
				join_text: 'auto',
				avatar_size: 35,
				count: 3,
				auto_join_text_default: 'we said,',
				auto_join_text_ed: 'we',
				auto_join_text_ing: 'we were',
				auto_join_text_reply: 'we replied to',
				auto_join_text_url: 'we were checking out',
				refresh_interval: 60,
				template: '{avatar}{text}{time}'
			}).on('loaded', function() {
				$(this).find('a').prop('target', '_blank');
			});
		}
	};

	/**
	 * jCarousel
	 */
	var jcarousel = {
		init: function() {
			var carousel = $('.jcarousel'),
				jcarouselHideButtons = false;

			carousel.each(function() {
				var jcarouselInstance = $('#' + $(this).prop('id')),
					jcarouselVertical = jcarouselInstance.data('vertical'),
					jcarouselRtl = jcarouselInstance.data('rtl'),
					jcarouselStart = jcarouselInstance.data('start'),
					jcarouselOffset = jcarouselInstance.data('offset'),
					jcarouselSize = jcarouselInstance.data('size'),
					jcarouselScroll = jcarouselInstance.data('scroll'),
					jcarouselVisible = jcarouselInstance.data('visible'),
					jcarouselAnimation = jcarouselInstance.data('animation'),
					jcarouselEasing = jcarouselInstance.data('easing'),
					jcarouselAuto = jcarouselInstance.data('auto'),
					jcarouselWrap = jcarouselInstance.data('wrap'),
					jcarouselHideButtons = jcarouselInstance.data('hidebuttons'),
					jcarouselButtonPrevHTML = null,
					jcarouselButtonNextHTML = null;

				if (!jcarouselHideButtons) {
					jcarouselButtonPrevHTML = '<div><i class="icon-chevron-left"></i></div>';
					jcarouselButtonNextHTML = '<div><i class="icon-chevron-right"></i></div>';
				}

				if (Modernizr.mq('screen and (max-width: 480px)')) {
					jcarouselScroll = 1;
					jcarouselVisible = 1;
				} else if (Modernizr.mq('screen and (max-width: 767px)')) {
					jcarouselScroll = 2;
					jcarouselVisible = 2;
				} else if (Modernizr.mq('screen and (max-width: 979px)')) {
					jcarouselScroll = 2;
					jcarouselVisible = 2;
				}

				$(this).jcarousel({
					vertical: jcarouselVertical,
					rtl: jcarouselRtl,
					start: jcarouselStart,
					offset: jcarouselOffset,
					size: jcarouselSize,
					scroll: jcarouselScroll,
					visible: jcarouselVisible,
					animation: jcarouselAnimation,
					easing: jcarouselEasing,
					auto: jcarouselAuto,
					wrap: jcarouselWrap,
					buttonPrevHTML: jcarouselButtonPrevHTML,
					buttonNextHTML: jcarouselButtonNextHTML
				});
			});
		}
	};

	/**
	 * Flexslider
	 */
	var flexSlider = {
		init: function() {
			var slider = $('.flexslider');

			slider.each(function() {
				var sliderInstance       = $('#' + $(this).prop('id')),
					sliderSelector       = sliderInstance.data('selector'),
					sliderAnimation      = sliderInstance.data('animation'),
					sliderDirection      = sliderInstance.data('direction'),
					sliderAnimationLoop  = sliderInstance.data('animationloop'),
					sliderControlNav     = sliderInstance.data('controlnav'),
					sliderDirectionNav   = sliderInstance.data('directionnav'),
					sliderSlideshowSpeed = sliderInstance.data('slideshowspeed'),
					sliderAnimationSpeed = sliderInstance.data('animationspeed'),
					sliderPauseOnHover   = sliderInstance.data('pauseonhover'),
					sliderUseCSS         = sliderInstance.data('usecss'),
					sliderItemWidth      = sliderInstance.data('itemwidth'),
					sliderItemMargin     = sliderInstance.data('itemmargin'),
					sliderminItems       = sliderInstance.data('minitems'),
					slidermaxItems       = sliderInstance.data('maxitems');

				$(this).flexslider({
					selector: sliderSelector,
					animation: sliderAnimation,
					direction: sliderDirection,
					animationLoop: sliderAnimationLoop,
					controlNav: sliderControlNav,
					directionNav: sliderDirectionNav,
					slideshowSpeed: sliderSlideshowSpeed,
					animationSpeed: sliderAnimationSpeed,
					pauseOnHover: sliderPauseOnHover,
					useCSS: sliderUseCSS,
					itemWidth: sliderItemWidth,
					itemMargin: sliderItemMargin,
					minItems: sliderminItems,
					maxItems: slidermaxItems,
					prevText: '<i class="icon-chevron-left"></i>',
					nextText: '<i class="icon-chevron-right"></i>'
				});
			});
		}
	};

	/**
	 * Isotope
	 */
	var isotope = {
		init: function() {
			var container = $('.isotope');

			container.each(function() {
				var isotopeInstance = $('#' + $(this).prop('id')),
					isotopeDuration = isotopeInstance.data('duration'),
					isotopeEasing   = isotopeInstance.data('easing'),
					isotopeQueue   = isotopeInstance.data('queue');

				$(this).isotope({
					filter: '*',
					animationOptions: {
						duration: isotopeDuration,
						easing: isotopeEasing,
						queue: isotopeQueue
					}
				});

				$('#sortby').on('click', 'a', function(event) {
					event.preventDefault();

					var selector = $(this).data('filter');

					isotopeInstance.isotope({
						filter: selector,
						animationOptions: {
							duration: isotopeDuration,
							easing: isotopeEasing,
							queue: isotopeQueue
						}
					});
				});
			});
		}
	};

	/**
	 * Overall (Background full width)
	 */
	var newHeight = 0;
	var background = {
		init: function() {
			$('.overall-full').each(function() {
				$.each($(this).children(), function() {
					newHeight += $(this).height();
				});

				$(this).height(newHeight);
				$(this).find('.inner').show();
			});
		}
	};

	/**
	 * prettyPhoto
	 */
	var prettyPhoto = {
		init: function() {
			$('a[rel^="prettyPhoto"]').prettyPhoto();
		}
	};

	/**
	 * Menu List
	 */
	var navTabs = {
		init: function() {
			$('.nav-tabs').each(function() {
				var parent = $(this).find('.parent ul'),
					link = $(this).find('.parent > a'),
					active = $(this).find('.active ul');

				parent.hide();
				active.show();

				link.click(function(event) {
					event.preventDefault();

					if (!$(this).parent().hasClass('active')) {
						link.parent().removeClass('active');
						parent.filter(':visible').slideUp('normal');

						$(this).parent().addClass('active');
						$(this).next().stop(true, true).slideDown('normal');
					} else {
						$(this).parent().removeClass('active');
						$(this).next().stop(true, true).slideUp('normal');
					}
				});
			});
		}
	};

	/**
	 * Scroll Top
	 */
	var scrollTop = {
		init: function() {
			$(window).scroll(function() {
				if ($(this).scrollTop() > 100) {
					$('.scroll-top').fadeIn();
				} else {
					$('.scroll-top').fadeOut();
				}
			});

			$('.scroll-top').click(function() {
				$('html, body').animate({
					scrollTop: 0
				}, 600);
				return false;
			});
		}
	};

	/**
	 * Ready, Load and Resize Functions
	 */
	var onReady = {
		init: function() {
			page.init();
			background.init();
			navTabs.init();
			scrollTop.init();

			if ($.fn.prettyPhoto) {
				prettyPhoto.init();
			}

			if ($.fn.isotope) {
				isotope.init();
			}
		}
	};

	var onLoad = {
		init: function() {
			sticky_navigation.init();

			if ($.fn.tweet) {
				tweet.init();
			}

			if ($.fn.jcarousel) {
				jcarousel.init();
			}

			if ($.fn.flexslider) {
				flexSlider.init();
			}
		}
	};

	var onResize = {
		init: function() {
			if (!$('html').hasClass('lt-ie9')) {
				sticky_navigation.init();
			}

			if ($.fn.jcarousel) {
				jcarousel.init();
			}

			if ($.fn.flexslider) {
				flexSlider.init();
			}

			if ($.fn.isotope) {
				isotope.init();
			}
		}
	};

	var onScroll = {
		init: function() {
			if (!$('html').hasClass('lt-ie9')) {
				sticky_navigation.init();
			}
		}
	};

	$(document).ready(onReady.init);
	$(window).load(onLoad.init);
	$(window).resize(onResize.init);
	$(window).scroll(onScroll.init);
})(jQuery);

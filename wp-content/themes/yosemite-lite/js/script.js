jQuery(function($) {
	'use strict';

	var $window = $(window),
		$body = $('body'),
		$navBar = $('.navbar'),
		clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
		nav_position = $('.header-content').offset().top,
		adminBar_height = $('#wpadminbar').height(),
		nav_marginBot = parseInt($('.header-content').css('marginBottom'));

	//Change the text in the author box
	$('.author-title').html($('.author-title').children());
	$('.author-link').remove();

	function searchForm() {
		$(".header-search button.header-search__click ").on("click", function() {
			$(".header-search__wrapper").fadeToggle(),
				$(".header-search__wrapper input.search-field").focus();
		});
	}

	function stickyHeader() {
		$(window).scroll(function() {
			if ($(window).scrollTop() >= nav_position - adminBar_height) {
				$(".site-header").css("margin-top", $(".header-content").height() + nav_marginBot);
				$(".site-header").addClass("sticky-header");
				$(".header-content").css("top", ( $(window).width() > 600 ) ? adminBar_height : 0);
			} else {
				$(".site-header").removeClass("sticky-header");
				$(".site-header").css("margin-top", 0);
				$(".header-content").css("top", 0);
			}
		})
	}

	//Slider Gallery
	function slickGallery() {

		$('.grid-gallery').slick({
			focusOnSelect: true,
			swipeToSlide: true,
			adaptiveHeight: true,
			rtl: $body.hasClass('rtl') ? true : false,
			'nextArrow': '<i class="fa fa-angle-right slick-next"></i>',
			'prevArrow': '<i class="fa fa-angle-left slick-prev"></i>'
		});

		$('.featured-posts .featured-post__content').slick({
			dots: true,
			infinite: true,
			speed: 600,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 4000,
			centerMode: false,
			variableWidth: false,
			rtl: $body.hasClass('rtl') ? true : false,
			nextArrow: '',
			prevArrow: '',
			responsive: [{
				breakpoint: 960,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		}); // slick
	}

	/**
	 * Refresh slick layout when infinite scroll finishes.
	 */
	function infiniteScrollRefresh() {
		$('.grid-gallery').not('.slick-initialized').slick({
			'nextArrow': '<i class="fa fa-angle-right slick-next"></i>',
			'prevArrow': '<i class="fa fa-angle-left slick-prev"></i>'
		});
	}

	function toggleMobileMenu() {
		var $body = $('body'),
			mobileClass = 'mobile-menu-open',
			clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click',
			transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd';

		// Click to show mobile menu.
		$('.menu-toggle').on(clickEvent, function(event) {
			event.preventDefault();
			event.stopPropagation(); // Do not trigger click event on '.wrapper' below.
			if ($body.hasClass(mobileClass)) {
				return;
			}
			$body.addClass(mobileClass);
		});

		// When mobile menu is open, click on page content will close it.
		$('.site')
			.on(clickEvent, function(event) {
				if (!$body.hasClass(mobileClass)) {
					return;
				}
				event.preventDefault();
				$body.removeClass(mobileClass).addClass('animating');
			})
			.on(transitionEnd, function() {
				$body.removeClass('animating');
			});
	}

	/**
	 * Add toggle dropdown icon for mobile menu.
	 * @param $container
	 */
	function initMobileNavigation($container) {
		// Add dropdown toggle that displays child menu items.
		var $dropdownToggle = $('<span class="dropdown-toggle fa fa-angle-down"></span>');

		$container.find('.menu-item-has-children > a').after($dropdownToggle);

		// Toggle buttons and sub menu items with active children menu items.
		$container.find('.current-menu-ancestor > .sub-menu').show();
		$container.find('.current-menu-ancestor > .dropdown-toggle').addClass('toggled-on');
		$container.on(clickEvent, '.dropdown-toggle', function(e) {
			e.preventDefault();
			$(this).toggleClass('toggled-on');
			$(this).next('ul').toggle();
		});
	}

	$window.on( 'resize', function() {
		if( $window.width() > 992 ) {
			$body.removeClass('mobile-menu-open');
		}
	} )

	/**
	 * Scroll to top
	 */
	function scrollToTop() {
		var $window = $(window),
			$button = $('.scroll-to-top');
		$window.scroll(function() {
			$button[$window.scrollTop() > 100 ? 'removeClass' : 'addClass']('hidden');
		});
		$button.on('click', function(e) {
			e.preventDefault();
			$('body, html').animate({
				scrollTop: 0
			}, 500);
		});
	}

	/**
	 * Sticky Sidebar
	 */
	function stickySidebar() {

		var offset = 30;

		$('.add_sticky_sidebar').theiaStickySidebar({
			additionalMarginTop: offset
		});

	}

	// Rearrange projects after infinite scroll finishes loading posts.
	$(document.body).on('post-load', infiniteScrollRefresh);

	stickyHeader();
	scrollToTop();
	searchForm();
	slickGallery();
	toggleMobileMenu();
	initMobileNavigation($('.mobile-menu'));
	stickySidebar();
});

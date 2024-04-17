/** @format */

(function ($) {
	'use strict';

	$(document).ready(function () {
		let Overly_menuItem = $('.offcanfas_menu li a');
		Overly_menuItem.click(function () {
			let findHash = $(this).attr('href');
			if (findHash == '#') {
				return false;
			}
		});

		let alinkPd = $('.startup_tab_img').find('a');
		if (alinkPd.length > 0) {
			alinkPd.each(function () {
				$(this).on('click', function () {
					window.location.href = $(this).attr('href');
				});
			});
		}
		/*--------- WOW js-----------*/
		function wowAnimation() {
			new WOW({
				offset: 100,
				mobile: true,
			}).init();
		}
		wowAnimation();


		// Mega Menu
		$(window).on('load', function () {
			let megaMenuTwo = $('.mega_menu_two .scroll')
			if ( megaMenuTwo.length > 0 ) {
				megaMenuTwo.mCustomScrollbar({
					mouseWheelPixels: 50,
					scrollInertia: 0,
				});
			}
		});

		/*===========Start Service Slider js ===========*/
		function serviceSlider() {
			var service_slider = $('.service_carousel');
			if (service_slider.length) {
				service_slider.owlCarousel({
					loop: true,
					margin: 15,
					items: 4,
					autoplay: true,
					smartSpeed: 2000,
					responsiveClass: true,
					nav: true,
					dots: false,
					stagePadding: 100,
					navText: ['<i class="ti-arrow-left"></i>'],
					responsive: {
						0: {
							items: 1,
							stagePadding: 0,
						},
						578: {
							items: 2,
							stagePadding: 0,
						},
						992: {
							items: 3,
							stagePadding: 0,
						},
						1200: {
							items: 3,
						},
					},
				});
			}
		}
		serviceSlider();
		/*===========End Service Slider js ===========*/

		/*===========Start feedback_slider js ===========*/
		function feedbackSlider() {
			var feedback_slider = $('.feedback_slider');
			if (feedback_slider.length) {
				feedback_slider.owlCarousel({
					loop: true,
					margin: 20,
					items: 3,
					nav: false,
					center: true,
					autoplay: false,
					smartSpeed: 2000,
					stagePadding: 0,
					responsiveClass: true,
					responsive: {
						0: {
							items: 1,
						},
						776: {
							items: 2,
						},
						1199: {
							items: 3,
						},
					},
				});
			}
		}
		feedbackSlider();
		/*=========== End feedback_slider js ===========*/

		/*===========Start app_testimonial_slider js ===========*/
		function app_testimonialSlider() {
			var app_testimonialSlider = $('.app_testimonial_slider');
			if (app_testimonialSlider.length) {
				app_testimonialSlider.owlCarousel({
					loop: true,
					margin: 10,
					items: 1,
					autoplay: true,
					smartSpeed: 2000,
					autoplaySpeed: true,
					responsiveClass: true,
					nav: true,
					dot: true,
					navText: [
						'<i class="ti-arrow-left"></i>',
						'<i class="ti-arrow-right"></i>',
					],
					navContainer: '.nav_container',
				});
			}
		}
		app_testimonialSlider();
		/*===========End app_testimonial_slider js ===========*/

		/*===========Start app_testimonial_slider js ===========*/
		function appScreenshot() {
			var app_screenshotSlider = $('.app_screenshot_slider');
			if (app_screenshotSlider.length) {
				app_screenshotSlider.owlCarousel({
					loop: true,
					margin: 10,
					items: 5,
					autoplay: false,
					smartSpeed: 2000,
					nav: false,
					dots: true,
					responsiveClass: true,
					responsive: {
						0: {
							items: 1,
						},
						650: {
							items: 2,
						},
						776: {
							items: 4,
						},
						1199: {
							items: 5,
						},
					},
				});
			}
		}
		appScreenshot();
		/*===========End app_testimonial_slider js ===========*/

		/*===========Start app_testimonial_slider js ===========*/
		function prslider() {
			var p_Slider = $('.pr_slider');
			if (p_Slider.length) {
				p_Slider.owlCarousel({
					loop: true,
					margin: 10,
					items: 1,
					autoplay: true,
					smartSpeed: 1000,
					responsiveClass: true,
					nav: true,
					dots: false,
					navText: [
						'<i class="ti-angle-left"></i>',
						'<i class="ti-angle-right"></i>',
					],
					navContainer: '.pr_slider',
				});
			}
		}
		prslider();
		/*===========End app_testimonial_slider js ===========*/

		function pr_slider() {
			var pr_image = $('.pr_image');
			if (pr_image.length) {
				pr_image.owlCarousel({
					loop: true,
					items: 1,
					autoplay: true,
					dots: false,
					thumbs: true,
					thumbImage: true,
				});
			}
		}
		pr_slider();

		/*===========Portfolio isotope js===========*/
		function portfolioMasonry() {
			var portfolio = $('#work-portfolio');
			if (portfolio.length) {
				portfolio.imagesLoaded(function () {
					// images have loaded
					// Activate isotope in container
					portfolio.isotope({
						itemSelector: '.portfolio_item',
						layoutMode: 'masonry',
						filter: '*',
						animationOptions: {
							duration: 1000,
						},
						hiddenStyle: {
							opacity: 0,
							transform: 'scale(.4)rotate(60deg)',
						},
						visibleStyle: {
							opacity: 1,
							transform: 'scale(1)rotate(0deg)',
						},
						stagger: 0,
						transitionDuration: '0.9s',
						masonry: {},
					});

					// Add isotope click function
					$('#portfolio_filter div').on('click', function () {
						$('#portfolio_filter div').removeClass('active');
						$(this).addClass('active');

						var selector = $(this).attr('data-filter');
						portfolio.isotope({
							filter: selector,
							animationOptions: {
								animationDuration: 750,
								easing: 'linear',
								queue: false,
							},
						});
						return false;
					});
				});
			}
		}
		portfolioMasonry();

		function jobFilter() {
			var jobsfilter = $('#tab_filter');
			if (jobsfilter.length) {
				jobsfilter.imagesLoaded(function () {
					// images have loaded
					// Activate isotope in container
					jobsfilter.isotope({
						itemSelector: '.item',
						//                    layoutMode: 'masonry',
						//                    filter:"*",
					});

					// Add isotope click function
					$('#job_filter div').on('click', function () {
						$('#job_filter div').removeClass('active');
						$(this).addClass('active');

						var selector = $(this).attr('data-filter');
						jobsfilter.isotope({
							filter: selector,
							animationOptions: {
								animationDuration: 750,
								easing: 'linear',
								queue: false,
							},
						});
						return false;
					});
				});
			}
		}
		jobFilter();

		/*===========Portfolio isotope js===========*/
		function blogMasonry() {
			var blog = $('#blog_masonry');
			if (blog.length) {
				blog.imagesLoaded(function () {
					blog.isotope({
						layoutMode: 'masonry',
					});
				});
			}
		}
		blogMasonry();

		/*--------------- Popup-js--------*/
		function popupGallery() {
			/*-------Portfolio image Popup and screenshot image carousel popup--------------*/
			function video_popup_wrapper() {
				let popup_youtube = document.querySelector(
					'.popup_youtube .elementor-button-link'
				);
				if (popup_youtube) {
					popup_youtube.classList.add('popup-youtube');
				}
			}
			video_popup_wrapper();

			/*-------Video Popup--------------*/
			let video_popup = $('.popup-youtube');
			if (video_popup.length > 0) {
				video_popup.magnificPopup({
					disableOn: 700,
					type: 'iframe',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false,
					mainClass: 'mfp-with-zoom mfp-img-mobile',
				});
			}
		}
		popupGallery();

		/* ===== Parallax Effect===== */
		function parallaxEffect() {
			if ($('.parallax-effect, #apps_craft_animation').length) {
				$('.parallax-effect, #apps_craft_animation').parallax();
			}
		}
		parallaxEffect();

		/*-------------------------------------------------------------------------------
        progress bar js
        -------------------------------------------------------------------------------*/
		$('.progress-element').each(function () {
			$(this).waypoint(
				function () {
					var progressBar = $('.progress-bar');
					progressBar.each(function (indx) {
						$(this).css('width', $(this).attr('aria-valuenow') + '%');
					});
				},
				{
					triggerOnce: true,
					offset: 'bottom-in-view',
				}
			);
		});


		/*--------- Accordion js-----------*/
		function fAqactive(){
			$(".faq_accordian_two .card").on('click', function(){
				$(".faq_accordian_two .card").removeClass("active");
				$(this).addClass('active');
			});
		}
		fAqactive();


		/*--------- Agency Colorful js-----------*/
		function ppTestislider() {
			let testimonialSlider = $(".pp_testimonial_slider");
			if ( testimonialSlider.length > 0 ) {
				testimonialSlider.slick({
					autoplay: true,
					slidesToShow: 2,
					slidesToScroll: 1,
					autoplaySpeed: 3000,
					speed: 1000,
					vertical: true,
					dots: false,
					arrows: true,
					prevArrow:'.prev',
					nextArrow:'.next',
				});
			}
		}
		ppTestislider();

		/*--------- Agency Colorful js-----------*/
		function pagepiling() {

			let pagepiling = $('.pagepiling')
			if ( pagepiling.length > 0) {
				pagepiling.pagepiling({
					scrollingSpeed: 280,
					loopBottom: true,
					navigation: {
						'position': 'right_position',
					},
				});
			}
		}

		pagepiling()



	}); // End Document.ready
})(jQuery);

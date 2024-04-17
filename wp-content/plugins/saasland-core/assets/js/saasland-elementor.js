/** @format */

(function ($, elementor) {
	"use strict";
	var $window = $(elementor);
  
	var SaaslandCore = {
	  onInit: function () {
		var E_FRONT = elementorFrontend,
		  E_Modules = elementorModules;
		var widgetHandlersMap = {
		  "saasland_alerts_box.default": SaaslandCore.alertBox,
		  "saasland_testimonial_ratting.default":
			SaaslandCore.testimonialWithRating,
		  "saasland_blog.default": SaaslandCore.saaslandBlog,
		  "saasland_appart_testimonials.default": SaaslandCore.testimonial,
		  "saasland-pricing-table-tabs-carousel.default":
			SaaslandCore.pricingCarousel,
		  "saasland_hero.default": SaaslandCore.heroSection,
		  "saasland_testimonial.default": SaaslandCore.testimonial2,
		  "saasland_posts_carousel.default": SaaslandCore.postsCarousel,
		  "saasland_portfolio_simple.default": SaaslandCore.portfolio_simple,
		  "saasland-image-slideshow.default": SaaslandCore.image_slideshow,
		  "saasland_product.default": SaaslandCore.product,
		  "saasland_slider.default": SaaslandCore.slider,
		  "saasland_circle_counter.default": SaaslandCore.circle_counter,
		  "saasland_main_features.default": SaaslandCore.f_slider,
		  "saasland_portfolio_masonry_simple.default":
			SaaslandCore.portfolio_masonry,
			"Saasland_appart_products.default":
			SaaslandCore.portfolio_masonry,
		  "rave_slider.default": SaaslandCore.slider_shop,
		  "rave_tour_booking.default": SaaslandCore.tourBooking,
		  "rave_tour_booking.default": SaaslandCore.tourBooking,
		  "rave_tour_booking_activities.default":
			SaaslandCore.tourBookingActivity,
		  'testimonial-pro.default': SaaslandCore.dl_pro_advance_slider,
			
		};
  
		$.each(widgetHandlersMap, function (widgetName, callback) {
		  E_FRONT.hooks.addAction(
			"frontend/element_ready/" + widgetName,
			callback
		  );
		});
	  },
  
	  dl_pro_advance_slider: function ($scope) {
		var $slider = $scope.find(
			".dl_pro_testimonial_slider"
		  ),
		  $item = $scope.find(".swiper-slide"),
		  $dat = $slider.data("settings");
  
		// render slider
		new Swiper($slider, $dat);
  
		// auto slider
		if ($dat.dl_mouseover) {
		  $slider.hover(
			function () {
			  this.swiper.autoplay.stop();
			},
			function () {
			  this.swiper.autoplay.start();
			}
		  );
		}
  
		if ($dat.dl_autoplay) {
		  $slider.each(function () {
			this.swiper.autoplay.start();
		  });
		} else {
		  $slider.each(function () {
			this.swiper.autoplay.stop();
		  });
		}
  
		let $delay = $dat.speed;
		if ($dat.autoplay) {
		  $delay = $dat.autoplay.delay;
		}
	  },
	  //========================== Tour Booking Activity ==============================//
	  tourBookingActivity: function ($scope) {
		let $tour_activity = $scope.find(".travel_gallery_info");
		if ($tour_activity.length > 0) {
		  $tour_activity.imagesLoaded(function () {
			$tour_activity.isotope({
			  layoutMode: "masonry",
			  masonry: {
				columnWidth: 1,
			  },
			});
		  });
		}
	  },
  
	  //================= Slider Section
	  slider_shop: function ($scope) {
		//====================== Slider 01
		var $main_slider = $scope.find(".site-slider");
  
		if ($main_slider.length > 0) {
		  function doAnimations(elements) {
			var animationEndEvents =
			  "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
			elements.each(function () {
			  var $this = $(this);
			  var $animationDelay = $this.data("delay");
			  var $animationType = "animated " + $this.data("animation");
			  $this.css({
				"animation-delay": $animationDelay,
				"-webkit-animation-delay": $animationDelay,
			  });
			  $this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			  });
			});
		  }
		  $main_slider.on("init", function (e, slick) {
			var $firstAnimatingElements = $("div.slider_item:first-child").find(
			  "[data-animation]"
			);
			doAnimations($firstAnimatingElements);
		  });
		  $main_slider.on(
			"beforeChange",
			function (e, slick, currentSlide, nextSlide) {
			  var $animatingElements = $(
				'div.slider_item[data-slick-index="' + nextSlide + '"]'
			  ).find("[data-animation]");
			  doAnimations($animatingElements);
			}
		  );
  
		  let dataSetting = $main_slider.data("slider");
		  let $infinite = "false";
		  if (dataSetting.slider_loop === "yes") {
			$infinite = "true";
		  }
  
		  $main_slider.slick({
			infinite: $infinite,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			fade: true,
			dots: false,
			rows: 0,
			prevArrow: ".left_arrow",
			nextArrow: ".right_arrow",
		  });
		}
	  },
	  //=============================== Circle Counter =====================//
	  portfolio_masonry: function ($scope) {
		let masonry1 = $scope.find(
		  ".h_work_area_portfolio_masonry .agency_team_inner"
		);
		if (masonry1.length > 0) {
		  masonry1.imagesLoaded(function () {
			masonry1.isotope({
			  layoutMode: "masonry",
			  masonry: {
				columnWidth: 1,
			  },
			});
		  });
		}
  
		//============== Portfolio Masonry 03
		let $const_masonry = $scope.find("#const_masonry");
		if ($const_masonry.length > 0) {
		  $const_masonry.imagesLoaded(function () {
			$const_masonry.isotope({
			  layoutMode: "masonry",
			  masonry: {
				columnWidth: 1,
			  },
			});
		  });
		}
		let portfolio = $scope.find("#product_gallery");
        if (portfolio.length) {
            portfolio.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                portfolio.isotope({
                    // itemSelector: ".portfolio_item",
                    layoutMode: "masonry",
                    filter: "*",
                    animationOptions: {
                        duration: 1000,
                    },
                    transitionDuration: "0.5s",
                    masonry: {},
                });

                // Add isotope click function
                $(".product_filter_new div").on("click", function () {
                    $(".product_filter_new div").removeClass("active");
                    $(this).addClass("active");

                    var selector = $(this).attr("data-filter");
                    portfolio.isotope({
                        filter: selector,
                        animationOptions: {
                            animationDuration: 750,
                            easing: "linear",
                            queue: false,
                        },
                    });
                    return false;
                });
            });
        }
	  },
  
	  //============================ Hotel Booking =======================================//
	  tourBooking: function ($scope) {
		let $tour_booking = $scope.find(".travel_tour_slider");
  
		if ($tour_booking.length > 0) {
		  $tour_booking.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			centerMode: true,
			centerPadding: "367px",
			prevArrow: ".prev",
			nextArrow: ".next",
			responsive: [
			  {
				breakpoint: 1370,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  centerPadding: "167px",
				},
			  },
			  {
				breakpoint: 991,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  centerMode: false,
				  // centerPadding: "167px",
				},
			  },
			],
		  });
		}
	  },
  
	  //=============================== Circle Counter =====================//
	  circle_counter: function ($scope) {
		//===== Slider Style 03
		let $circle = $scope.find(".circle");
		if ($circle.length > 0) {
		  $circle.each(function () {
			$circle.appear(
			  function () {
				$circle.circleProgress({
				  startAngle: -14.1,
				  size: 200,
				  duration: 9000,
				  easing: "circleProgressEase",
				  emptyFill: "#f1f1fa ",
				  lineCap: "round",
				  thickness: 10,
				});
			  },
			  {
				triggerOnce: true,
				offset: "bottom-in-view",
			  }
			);
		  });
		}
  
		let $counter = $scope.find(".counter");
		if ($counter.length > 0) {
		  $counter.counterUp({
			delay: 1,
			time: 500,
		  });
		}
	  },
  
	  f_slider: function ($scope) {
		let f_slider_ = $scope.find(".home_features_slider");
		f_slider_.slick({
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  centerMode: true,
		  autoplay: true,
		  centerPadding: "30px",
		  prevArrow: ".prev",
		  nextArrow: ".next",
		  autoplaySpeed: 2000,
		  pauseOnHover: false,
		  responsive: [
			{
			  breakpoint: 1199,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
			  },
			},
			{
			  breakpoint: 780,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
			  },
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				centerMode: "false",
			  },
			},
		  ],
		});
	  },
  
	  //=============================== Saasland Slider =====================//
	  slider: function ($scope) {
		//===== Slider Style 02, 03
		let slider_3 = $scope.find(".gadget_slider_area");
		if (slider_3.length > 0) {
		  slider_3.on("init", function (e, slick) {
			var $firstAnimatingElements = $("div.slider_item:first-child").find(
			  "[data-animation]"
			);
			doAnimations($firstAnimatingElements);
		  });
		  slider_3.on(
			"beforeChange",
			function (e, slick, currentSlide, nextSlide) {
			  var $animatingElements = $(
				'div.slider_item[data-slick-index="' + nextSlide + '"]'
			  ).find("[data-animation]");
			  doAnimations($animatingElements);
			}
		  );
		  if (slider_3.length > 0) {
			slider_3.slick({
			  autoplay: true,
			  autoplaySpeed: 5000,
			  dots: true,
			  fade: true,
			  rows: false,
			  arrows: false,
			});
		  }
		  function doAnimations(elements) {
			var animationEndEvents =
			  "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
			elements.each(function () {
			  var $this = $(this);
			  var $animationDelay = $this.data("delay");
			  var $animationType = "animated " + $this.data("animation");
			  $this.css({
				"animation-delay": $animationDelay,
				"-webkit-animation-delay": $animationDelay,
			  });
			  $this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			  });
			});
		  }
		  if (slider_3.length) {
			Splitting();
		  }
		}
  
		//===== Slider Style 01
		let slider_1 = $scope.find(".saas_banner_area_three");
		if (slider_1.length > 0) {
		  let owl_data = JSON.parse(slider_1.attr("data-controls"));
		  let bool_data = JSON.parse(owl_data.loop);
		  slider_1.owlCarousel({
			items: 1,
			animateOut: "fadeOut",
			autoplay: bool_data,
			autoplayTimeout: owl_data.slide_speed,
			autoplayHoverPause: true,
			responsiveClass: true,
			nav: false,
			dots: true,
		  });
		}
	  },
  
	  //=============================== Product =====================//
	  product: function ($scope) {
		//======= Product Style 05
		let product_2 = $scope.find(".featured_gallery");
		if (product_2.length > 0) {
		  product_2.imagesLoaded(function () {
			product_2.isotope({
			  layoutMode: "masonry",
			  itemSelector: ".grid-item",
			  masonry: {
				columnWidth: ".grid-sizer",
			  },
			  percentPosition: true,
			});
		  });
		}
	  },
  
	  //=============================== Portfolio Simple =====================//
	  portfolio_simple: function ($scope) {
		//======= Portfolio Simple Style 02
		let $simple_portfolio_2 = $scope.find(".photography_gallery_slider");
  
		if ($simple_portfolio_2.length > 0) {
		  $simple_portfolio_2.slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			infinite: true,
			touchThreshold: 10,
			variableWidth: true,
			prevArrow: ".prevs",
			nextArrow: ".nexts",
			responsive: [
			  {
				breakpoint: 680,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  centerMode: true,
				  variableWidth: false,
				  centerPadding: "80px",
				},
			  },
			  {
				breakpoint: 576,
				settings: {
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  centerMode: false,
				  variableWidth: false,
				  centerPadding: "0px",
				},
			  },
			],
		  });
		}
	  },
  
	  //=============================== Image Slideshow =====================//
	  image_slideshow: function ($scope) {
		let slideshow = $scope.find("#kenburnslider");
  
		if (slideshow.length > 0) {
		  var $slide = slideshow
			.slick({
			  infinite: true,
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  speed: 1000,
			  autoplaySpeed: 3000,
			  autoplay: true,
			})
			.on({
			  beforeChange: function (event, slick, currentSlide, nextSlide) {
				$(".slick-slide", this).eq(currentSlide).addClass("preve-slide");
				$(".slick-slide", this).eq(nextSlide).addClass("slide-animation");
			  },
			  afterChange: function () {
				$(".preve-slide", this).removeClass(
				  "preve-slide　slide-animation"
				);
			  },
			});
		  $slide.find(".slick-slide").eq(0).addClass("slide-animation");
		}
	  },
  
	  //=============================== Testimonials =====================//
	  testimonial2: function ($scope) {
		//======= Testimonials Style 06
		let $testimonials_6 = $scope.find(".h_testimonial_slider_inner");
		if ($testimonials_6.length > 0) {
		  let testimonial_slider = $(".h_testimonial_slider");
		  let slickData = JSON.parse(testimonial_slider.attr("data-slick"));
  
		  console.log(slickData);
		  testimonial_slider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			draggable: false,
			swipe: false,
			pauseOnHover: false,
			autoplay: slickData.autoplay,
			autoplaySpeed: slickData.slide_speed,
			asNavFor: ".h_testimonial_thumb",
		  });
  
		  $(".h_testimonial_thumb").slick({
			slidesToShow: 6,
			slidesToScroll: 1,
			asNavFor: ".h_testimonial_slider",
			draggable: false,
			swipe: false,
			arrows: false,
			dots: false,
			autoplay: slickData.autoplay,
			autoplaySpeed: slickData.slide_speed,
			infinite: false,
			focusOnSelect: true,
			responsive: [],
		  });
		}
  
		//======= Testimonials Style 07
		let $testimonials_7 = $scope.find(".photography_testimonial_slider");
		if ($testimonials_7.length > 0) {
		  $testimonials_7.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			prevArrow: ".prev",
			nextArrow: ".next",
			vertical: true,
			verticalScrolling: true,
		  });
		}
  
		//======= Testimonials Style 08
		let $testimonials_8 = $scope.find(".app_testimonial_slider-8");
		if ($testimonials_8.length > 0) {
		  $testimonials_8.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			prevArrow: ".prev",
			nextArrow: ".next",
		  });
		}
  
		//======= Testimonials Style 09
		let const_testimonial_slider = $scope.find(".const_testimonial_slider");
  
		if (const_testimonial_slider.length > 0) {
		  $(".const_testimonial_slider").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			swipe: false,
			asNavFor: ".const_testimonial_thumbnil",
			prevArrow: ".prev",
			nextArrow: ".next",
		  });
		  $(".const_testimonial_thumbnil").slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: ".const_testimonial_slider",
			centerMode: true,
			swipe: false,
			arrows: false,
			focusOnSelect: true,
			responsive: [
			  {
				breakpoint: 576,
				settings: {
				  slidesToShow: 3,
				  slidesToScroll: 1,
				},
			  },
			],
		  });
		}

		var testimonial_slider_shop = $scope.find('.shop_testimonial_slider');
		if(testimonial_slider_shop.length > 0 ) {
			testimonial_slider_shop.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				prevArrow: '.prev',
				nextArrow: '.next',
			});
		}
	  },
  
	  //================== Hero Section ========================//
	  heroSection: function ($scope) {
		//==== Style 11
		let $apps_craft_animation = $scope.find(".apps_craft_animation");
		if ($apps_craft_animation.length > 0) {
		  $apps_craft_animation.parallax({
			scalarX: 10.0,
			scalarY: 0.0,
		  });
		}
  
		//====== Style 15
		var heroClassic = $scope.find(".banner_area_15");
		if (heroClassic.length > 0) {
		  heroClassic.parallax({
			scalarX: 10.0,
			scalarY: 10.0,
		  });
		  if (heroClassic.parallaxie) {
			if ($(window).width() > 767) {
			  heroClassic.parallaxie({
				speed: 0.5,
			  });
			}
		  }
		}
  
		var dataSplitting = $scope.find("[data-splitting]");
		if (dataSplitting.length > 0) {
		  dataSplitting.each(function () {
			Splitting();
		  });
		}
	  },
  
	  //====================== Blog
	  saaslandBlog: function ($scope) {
		let slider_action = $scope.find(".about_img_slider");
		slider_action.owlCarousel({
		  loop: true,
		  margin: 0,
		  items: 1,
		  nav: false,
		  autoplay: false,
		  smartSpeed: 2000,
		  responsiveClass: true,
		});
  
		//  ajax loading pagination
		$($scope).on("click", ".ajax-loading a", function (e) {
		  e.preventDefault();
		  let dataPost = $(this).parent(".ajax-loading").data("ravblogsetting");
  
		  let dataPage = $(this).attr("href").split("=");
		  let pageNum = 1;
		  if (dataPage.length > 1) {
			pageNum = dataPage[dataPage.length - 1];
		  }
  
		  $.ajax({
			url: ajax_post_load.ajaxurl,
			type: "post",
			data: {
			  action: "ajax_post_load",
			  setting: dataPost,
			  page_num: pageNum,
			},
			beforeSend: function () {
			  // setting a timeout
			  $(".rave-ajx-preloader").addClass("show");
			},
			success: function (response) {
			  $(".ajax_content").html(response);
			  $(".rave-ajx-preloader").removeClass("show");
			},
		  });
		});
	  },
  
	  //  testimonial slider with rating
	  testimonialWithRating: function ($scope) {
		//  slider  style 2
		let findSliderStyletwo = $scope.find(".feedback_slider_two");
		if (findSliderStyletwo.length > 0) {
		  findSliderStyletwo.owlCarousel({
			loop: "true",
			margin: 0,
			items: 2,
			nav: true,
  
			autoplay: false,
			stagePadding: 0,
			responsiveClass: true,
			navText: [
			  '<i class="ti-angle-left"></i>',
			  '<i class="ti-angle-right"></i>',
			],
			responsive: {
			  0: {
				items: 1,
			  },
			  776: {
				items: 2,
			  },
			  1199: {
				items: 2,
			  },
			},
		  });
		}
	  },
  
	  //sassland alert
	  alertBox: function ($scope) {
		let closeAlert = $scope.find(".alert_close");
		closeAlert.click(function () {
		  $(this).parent().remove();
		});
	  },
  
	  //04 pos testimonial
	  testimonial: function ($scope) {
		//========= style one
		let testimonials = $scope.find(".testimonial-carousel");
		let rtl = testimonials.data("rtl");
  
		if (testimonials.length > 0) {
		  testimonials.owlCarousel({
			loop: true,
			rtl: rtl,
			margin: 0,
			items: 2,
			autoplay: true,
			autoplayHoverPause: true,
			smartSpeed: 1000,
			nav: false,
			responsiveClass: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  720: {
				items: 2,
			  },
			},
		  });
		}
  
		//======= style two
		let testimonaila_style_2 = $scope.find(".testimonial_slider_five");
		let testimonaila_style_carosul = $scope.find(".testimonial-img");
  
		if (testimonaila_style_2.length > 0) {
		  testimonaila_style_2.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
			asNavFor: testimonaila_style_carosul,
		  });
		}
  
		if (testimonaila_style_carosul.length > 0) {
		  testimonaila_style_carosul.slick({
			slidesToShow: 1,
			Padding: "0px",
			slidesToScroll: 1,
			asNavFor: testimonaila_style_2,
			dots: false,
			arrows: false,
			fade: true,
		  });
		}
	  },
  
	  //===================== Pricing Carousel
	  pricingCarousel: function ($scope) {
		let $slider = $scope.find(".test_slicKSlider");
		$slider.slick({
		  dots: true,
		  arrows: false,
		  autoplay: false,
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 2,
			  },
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 1,
			  },
			},
		  ],
		});
	  },
  
	  //  post carousel
  
	  postsCarousel: function ($scope) {
		let CSlider = $scope.find(".case_studies_slider");
		if (CSlider.length) {
		  CSlider.owlCarousel({
			loop: true,
			margin: 0,
			items: 3,
			autoplay: true,
			smartSpeed: 1000,
			responsiveClass: true,
			nav: false,
			dots: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  650: {
				items: 2,
			  },
			  776: {
				items: 3,
			  },
			  1199: {
				items: 3,
			  },
			},
		  });
		}
	  },
	};
  
	$window.on("elementor/frontend/init", SaaslandCore.onInit);
  })(jQuery, window);
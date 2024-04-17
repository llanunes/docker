/** @format */

(function ($, window) {
	'use strict';
	var $window = $(window);
	var drthWidgets = {
		LoadWidgets: function () {
			var e_front = elementorFrontend,
				e_module = elementorModules;

			var $proWidgets = {
				'droit-video_popup.default': '_video_popup',
				'droit-advance-accordions.default': '_dl_pro_accordions',
				'droit-advance_pricing.default': '_dl_pro_advance_pricing',
				'droit-tabs.default': '_dl_pro_tabs',
				'droit-post-slider-pro.default': '_dl_pro_advance_slider',
				'droit-banner-slider.default': '_dl_pro_banner_slider',
			};

			var widgetsMap = {
				'drth-test.default': drthWidgets.drth_test,
				'droit-video_popup.default': drthWidgets._video_popup,
				'droit-advance-accordions.default': drthWidgets._dl_pro_accordions,
				'droit-advance_pricing.default': drthWidgets._dl_pro_advance_pricing,
				'droit-tabs.default': drthWidgets._dl_pro_tabs,
				'droit-post-slider-pro.default': drthWidgets._dl_pro_advance_slider,
				'droit-banner-slider.default': drthWidgets._dl_pro_banner_slider,
			};

			$.each(widgetsMap, function (name, callback) {
				if (dlth_theme.dl_pro == 'yes' && name in $proWidgets) {
				} else {
					e_front.hooks.addAction('frontend/element_ready/' + name, callback);
				}
			});
		},
		// test
		drth_test: function ($scope) {
			//alert();
		},
		_video_popup: function ($scope) {
			var $selector = $scope.find('.droit-video-popup');
			if ($selector.length > 0) {
				$($selector).magnificPopup({
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: !0,
					fixedContentPos: !1,
				});
			}
		},
		_dl_pro_advance_slider: function ($scope) {
			var $slider = $scope.find('.dl_pro_post_slider'),
				$item = $scope.find('.swiper-slide'),
				$dat = $slider.data('settings');

			let $breakPoints = $dat.breakpoints ? $dat.breakpoints : {};

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

			window.addEventListener('resize', function () {
				drthWidgets.autoloadMedia($breakPoints, $scope);
			});
			// auto load media
			drthWidgets.autoloadMedia($breakPoints, $scope);
		},
		autoloadMedia: function ($breakPoints, $scope) {
			let $pagi = $scope.find('.dl_swiper_adv_pagination');
			let $nav = $scope.find('.dl_adv_swiper_navigation');
			if (Object.entries($breakPoints)) {
				for (const [$k, $v] of Object.entries($breakPoints)) {
					function matchBreakPoint(x) {
						if (x.matches) {
							let $nv = $v.navigation ? $v.navigation : { enable: true };
							if (!$nv.enable) {
								if ($nav) {
									$nav.addClass('swiper-button-disabled');
								}
							}
							let $pg = $v.pagination ? $v.pagination : { enable: true };
							if (!$pg.enable) {
								if ($pagi) {
									$pagi.addClass('swiper-button-disabled');
								}
							}
						} else {
							if ($nav) {
								$nav.removeClass('swiper-button-disabled');
							}
							if ($pagi) {
								$pagi.removeClass('swiper-button-disabled');
							}
						}
					}
					var $media = window.matchMedia('(max-width: ' + $k + 'px)');
					matchBreakPoint($media);
					$media.addListener(matchBreakPoint);
				}
			}
		},

		_dl_pro_banner_slider: function ($scope, $) {
			var $slider = $scope.find('.dl_banner_slider'),
				$item = $slider.find('.swiper-slide > *'),
				$thumbs = $scope.find('.gallery-thumbs'),
				$dat = $slider.data('settings'),
				$datTh = $thumbs.data('settings') ? $thumbs.data('settings') : {};

			if ($datTh.hasOwnProperty('thumbsEnable')) {
				var $obj = {
					spaceBetween: $datTh.spaceBetween ? $datTh.spaceBetween : '',
					slidesPerView: $datTh.slidesPerView ? $datTh.slidesPerView : '',
				};
				if ($datTh.breakpoints && $datTh.breakpoints != '') {
					$obj.breakpoints = $datTh.breakpoints;
				}
				var $galleryThumbs = new Swiper($thumbs, $obj);

				$dat.thumbs = {
					swiper: $galleryThumbs,
				};
			}

			$dat.on = {
				slideChangeTransitionStart: function () {
					$item.each(function () {
						$(this).css({
							transition: '0.1s',
							opacity: '0',
						});
					});
				},
				slideChangeTransitionEnd: function () {
					var $animation = $item.find('[data-animation]');
					if ($animation.length > 0) {
						dlAddons_banner_slider($animation);
					}
					$item.each(function () {
						$(this).css({
							transition: '0.1s',
							opacity: '1',
						});
					});
				},
			};
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

		_dl_pro_accordions: function ($scope) {
			var $accrodion = $scope.find('.dl_accordion');
			if ($accrodion.length > 0) {
				$accrodion
					.find('.dl_accordion_item.is-active')
					.children('.dl_accordion_panel')
					.slideDown();
				$accrodion.find('.dl_accordion_item').on('click', function () {
					// Cancel the siblings
					$(this)
						.siblings('.dl_accordion_item')
						.removeClass('is-active')
						.children('.dl_accordion_panel')
						.slideUp();
					// Toggle the item
					$(this)
						.toggleClass('is-active')
						.children('.dl_accordion_panel')
						.slideToggle('ease-out');
				});
			}
		},
		_dl_pro_advance_pricing: function ($scope) {
			var t = $scope.find('.dl_switcher_control-item'),
				h = $scope.find('.dl_switcher_content-item');
			// tab style
			t.click(function (e) {
				e.preventDefault();
				var $this = $(this);

				// close all switcher active class
				t.each(function () {
					let $self = $(this);
					$self.removeClass('on-select');
				});

				// close all content tab
				h.each(function () {
					let $self = $(this);
					$self.removeClass('on-active');
				});

				// selector content
				let $target = $this.data('target');
				let $content = $scope.find('[data-toggle=' + $target + ']');
				$content.addClass('on-active');
				// selected tab
				$this.addClass('on-select');
			});

			// switch style
			var s = $scope.find('.dl_toggle');
			s.click(function (e) {
				e.preventDefault();
				var $this = $(this);
				$this.toggleClass('dl-active');
				$this.parents('.dl_switcher_control').toggleClass('dl-active');

				// content
				h.each(function () {
					let $self = $(this);
					$self.toggleClass('on-active');
				});
			});
		},
		_dl_pro_tabs: function ($scope, t, e) {
			var a = '#' + $scope.find('.dl_tab_container').attr('id').toString();
			t(a + ' ul.dl_tab_menu > li').each(function (e) {
				t(this).hasClass('active-default')
					? (t(a + ' ul.dl_tab_menu > li')
							.removeClass('dl_active')
							.addClass('dl_inactive'),
					  t(this).removeClass('dl_inactive'))
					: 0 == e && t(this).removeClass('dl_inactive').addClass('dl_active');
			}),
				t(a + ' .tab_container div').each(function (e) {
					t(this).hasClass('active-default')
						? t(a + ' .tab_container > div').removeClass('dl_active')
						: 0 == e &&
						  t(this).removeClass('dl_inactive').addClass('dl_active');
				}),
				t(a + ' ul.dl_tab_menu > li').click(function () {
					var e = t(this).index(),
						a = t(this).closest('.droit-advance-tabs'),
						n = t(a).children('.droit-tabs-nav').children('ul').children('li'),
						i = t(a).children('.tab_container').children('div');
					t(this).parent('li').addClass('dl_active'),
						t(n)
							.removeClass('dl_active active-default')
							.addClass('dl_inactive'),
						t(this).addClass('dl_active').removeClass('dl_inactive'),
						t(i).removeClass('dl_active').addClass('dl_inactive'),
						t(i).eq(e).addClass('dl_active').removeClass('dl_inactive');
					t(i).each(function (e) {
						t(this).removeClass('active-default');
					});
				});
		},
	};
	function _dl_pro_count_down_redirect(url) {
		window.location.replace(url);
	}

	function dlAddons_banner_slider(elements) {
		var animationEndEvents =
			'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		elements.each(function () {
			var $this = $(this);
			var $animationDelay = $this.data('delay');
			var $animationType = 'animated ' + $this.data('animation');
			$this.css({
				'animation-delay': $animationDelay,
				'-webkit-animation-delay': $animationDelay,
			});
			$this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			});
		});
	}
	// load elementor
	$window.on('elementor/frontend/init', drthWidgets.LoadWidgets);
})(jQuery, window);

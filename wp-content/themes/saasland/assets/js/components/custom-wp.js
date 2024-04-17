(function ($) {
	'use strict';

	$(document).ready(function () {

		// Add job apply form class
		$('.page-job-apply .wpcf7-form').addClass('row');

		// Apply pull quote color
		let pullquote_color = $('.wp-block-pullquote').attr('style');
		$('.wp-block-pullquote blockquote').attr('style', pullquote_color);

		$('.tinv-wraper.tinv-wishlist a.tinvwl_add_to_wishlist_button').append(
			'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 17 17"><g></g><path d="M12.5 0.658c-1.739 0-3.251 0.992-4 2.439-0.749-1.447-2.261-2.439-4-2.439-2.481 0-4.5 2.019-4.5 4.5 0 0.343 0.048 0.699 0.154 1.118l0.109 0.351c1.432 4.354 7.659 9.393 7.924 9.604l0.313 0.252 0.313-0.252c0.282-0.227 6.926-5.598 7.927-9.614l0.112-0.368c0.101-0.402 0.148-0.749 0.148-1.091 0-2.481-2.019-4.5-4.5-4.5zM15.889 5.98l-0.113 0.37c-0.809 3.246-5.946 7.727-7.276 8.843-1.282-1.083-6.122-5.337-7.285-8.872l-0.1-0.316c-0.077-0.311-0.115-0.588-0.115-0.847 0-1.93 1.57-3.5 3.5-3.5s3.5 1.571 3.5 3.5v0.252h1v-0.252c0-1.93 1.57-3.5 3.5-3.5s3.5 1.57 3.5 3.5c0 0.258-0.038 0.527-0.111 0.822z" fill="#000000" /></svg>'
		);

		// Manage hash link prevent default
		function hashLinkprevendDefault() {
			let link = $('.menu li> a');

			link.on('click', function () {
				let urlHash = $(this).attr('href').split('/');

				if (urlHash[urlHash.length - 1] === '#') {
					return false;
				}
			});
		}

		hashLinkprevendDefault();


		function mobileMenudropdown() {

			let menuSelector = $('.menu li.submenu > a');
			let menuSelector2 = $('.menu li.submenu > a span');

			menuSelector.on('click', function (event) {

				let urlHash = $(this).attr('href').split('/');
				if(urlHash[urlHash.length - 1] === '#') {
					event.preventDefault();
				}
				$(this).parent().find('ul').first().toggle(700);
				$(this).parent().siblings().find('ul').hide(700);
			});

			menuSelector2.on('click', function (event) {
				event.preventDefault();
				$(this).parent().parent().find('ul').first().toggle(700);
				$(this).parent().parent().siblings().find('ul').hide(700);
				event.stopPropagation();
			});
		}

		mobileMenudropdown();


		$('.navbar-nav .mega_menu>.dropdown-menu').wrap(
			'<div class="mega_menu_inner"></div>'
		);

		if ($('.comment_box .children').length > 0) {
			$('.comment_box .children')
				.addClass('list-unstyled reply_comment')
				.removeClass('children');
			$('.reply_comment .post_comment').removeClass('post_comment');
		}

		$('.widget_products').addClass('widget_product');
		$('.widget_top_rated_products').addClass('widget_product');
		$('.widget_recently_viewed_products').addClass('widget_product');
		$('.widget_products ul.product_list_widget').addClass('list-unstyled');
		$('.widget_product_search').addClass('search_widget_two');
		$('.widget_product_categories ').addClass('widget_category');

		$('.footer-widget:first-child .f_widget').removeClass('pl_70 ');

		/*------------- preloader js --------------*/
		function loader() {
			$(window).on('load', function () {
				$('#ctn-preloader').addClass('loaded');
				// Una vez haya terminado el preloader aparezca el scroll

				if ($('#ctn-preloader').hasClass('loaded')) {
					// Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
					$('#preloader')
						.delay(900)
						.queue(function () {
							$(this).remove();
						});
				}
			});
		}

		loader();

		//* Navbar Fixed
		function navbarFixed() {
			if ($('.header_stick').length) {
				$(window).scroll(function () {
					var scroll = $(window).scrollTop();
					if (scroll) {
						$('.header_stick').addClass('navbar_fixed');
					} else {
						$('.header_stick').removeClass('navbar_fixed');
					}
				});
			}
		}

		navbarFixed();

		if ($('.search-btn').length) {
			$('.search-btn').on('click', function () {
				$('body').addClass('open');
				setTimeout(function () {
					$('.search-input').focus();
				}, 500);
				return false;
			});
			$('.close_icon').on('click', function () {
				$('body').removeClass('open');
				return false;
			});
		}

		// hamburger_menu
		function offcanvasActivator() {
			if ($('.bar_menu').length) {
				$('.bar_menu').on('click', function () {
					$('#menu').toggleClass('show-menu');
				});
				$('.close_icon').on('click', function () {
					$('#menu').removeClass('show-menu');
				});
			}
		}
		offcanvasActivator();

		// Update cart button
		$('.ar_top').on('click', function () {
			var getID = $(this).next().attr('id');
			var result = document.getElementById(getID);
			var qty = result.value;
			$('.shopping_cart_area .cart_btn.cart_btn_two').removeAttr('disabled');
			if (!isNaN(qty)) {
				result.value++;
				$('.cart_btn.ajax_add_to_cart').attr('data-quantity', result.value);
			} else {
				return false;
			}
		});

		$('.ar_down').on('click', function () {
			var getID = $(this).prev().attr('id');
			var result = document.getElementById(getID);
			var qty = result.value;
			$('.shopping_cart_area .cart_btn.cart_btn_two').removeAttr('disabled');
			if (!isNaN(qty) && qty > 0) {
				result.value--;
				$('.cart_btn.ajax_add_to_cart').attr('data-quantity', result.value);
			} else {
				return false;
			}
		});

		//Nice Select
		let selectPickers = $('.selectpickers')
		if ( selectPickers.length > 0 ) {
			selectPickers.niceSelect();
		}

	});

	var wincow_width = $(window).width();
	if (992 > wincow_width) {
		$('.header_area').addClass('mobile_menu_enabled');
	}
})(jQuery);

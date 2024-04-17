<?php
$opt = get_option( 'saasland_opt' );
$is_search_class = !empty($opt['is_search']) ? $opt['is_search'] : '';
$is_mini_cart_class = !empty($opt['is_mini_cart']) ? $opt['is_mini_cart'] : '';
$icon_classes = $is_search_class == '1' ? 'search_exist' : '';
$icon_classes .= $is_mini_cart_class == '1' ? ' mini_cart_exist' : '';

// Mini Cart Options
$is_mini_cart_opt = !empty($opt['is_mini_cart']) ? $opt['is_mini_cart'] : '';
$mini_cart = function_exists('get_field') ? get_field( 'mini_cart' ) : '';
$is_mini_cart_page = isset($mini_cart) ? $mini_cart : '';

$is_search_opt = !empty($opt['is_search'] ) ? $opt['is_search'] : '';
$is_search_page = function_exists('get_field') ? get_field('is_search') : '';

if ( ($is_search_page != 'default' && $is_search_page == '1') || ($is_mini_cart_page != 'default' && $is_mini_cart_page == '1' )) {
	$is_search = 1;
	$is_mini_cart = 1;
} elseif ( $is_search_page == '2' || $is_mini_cart_page == '2' ) {
	$is_search = __return_false();
	$is_mini_cart = __return_false();
} else {
	$is_search = $is_search_opt;
	$is_mini_cart = $is_mini_cart_opt;
}
?>
<div class="alter_nav <?php echo esc_attr($icon_classes) ?>">
    <ul class="navbar-nav search_cart menu">
		<?php
		if ( class_exists('Redux_Framework_Plugin') && ($is_search) ) { ?>
            <li class="nav-item search">
                <a class="nav-link search-btn" href="javascript:void(0);">
					<?php echo saasland_get_icon_svg('saasland-svg-icon', 'ti-search', '16') ?>
                </a>
            </li>
			<?php
		}
		if ( class_exists( 'WooCommerce') && ($is_mini_cart) ) { 
			global $woocommerce;
		?>
            <li class="nav-item shpping-cart dropdown submenu">
				<a class="cart-btn nav-link dropdown-toggle" href="<?php echo wc_get_cart_url() ?>" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo saasland_get_icon_svg('saasland-svg-icon', 'ti-bag', '20') ?>
					<span class="num">
						<?php echo esc_html( $woocommerce->cart->cart_contents_count); ?>
					</span>
				</a>
				<ul class="dropdown-menu saasland_ajax_minicart">
					<?php woocommerce_mini_cart(); ?>
				</ul>
            </li>
			<?php
		}
		?>
    </ul>
</div>

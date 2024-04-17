<?php
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function saasland_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = '';

    /* Body font */
    if ( 'off' !== 'on' ) {
        $fonts[] = "Poppins:300,400,500,600,700,900";
        $fonts[] = "Figtree:400,500,600,700,800,900";
        $fonts[] = "InstrumentSans:400,500,600,700,800,900";
    }

    $is_ssl = is_ssl() ? 'https' : 'http';

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts  ) ),
            'subset' => urlencode( $subsets ),
        ), "$is_ssl://fonts.googleapis.com/css" );
    }

    return $fonts_url;
}

function saasland_scripts() {

    /**
     * Register Scripts
     */
    wp_register_style( 'saasland-fonts', saasland_fonts_url(), array(), null );

    /**
     * Enqueueing Stylesheets
     */
	$opt = get_option('saasland_opt');
    $font_load = 1;
    if ( class_exists('Redux') ) {
        $font_load = !empty( $opt['is_default_font'] ) ? 1 : '';
    }
    if ( $font_load == 1 ) {
        wp_enqueue_style( 'saasland-fonts' );
    }

    //Enqueue CSS File's
    wp_enqueue_style( 'bootstrap', SAASLAND_DIR_VEND . '/bootstrap/css/bootstrap.css');
    wp_enqueue_style( 'nice-select', SAASLAND_DIR_VEND . '/nice-select/nice-select.min.css' );
    wp_enqueue_style( 'saasland-wpd-style', SAASLAND_DIR_CSS . '/wpd-style.css' );

	if ( is_home() || is_singular( 'post' ) ) {
		wp_enqueue_style( 'saasland-wpd-2-style', SAASLAND_DIR_CSS . '/wpd-style-2.css' );
	}

    wp_enqueue_style( 'saasland-main', SAASLAND_DIR_CSS . '/style.css' );
    wp_enqueue_style( 'saasland-root', get_stylesheet_uri() );
    wp_enqueue_style( 'saasland-responsive', SAASLAND_DIR_CSS . '/responsive.css' );

    if ( is_rtl() ) {
        wp_enqueue_style( 'saasland-rtl', SAASLAND_DIR_CSS.'/theme-rtl.css' );
    }

    // WooCommerce page
    if ( class_exists('WooCommerce') ) {
        wp_enqueue_style( 'saasland-shop',  SAASLAND_DIR_CSS . '/shop.css' );
    }


	// Inline CSS Render File
	$dynamic_css = '';
	require get_template_directory() . '/inc/saasland_inline_render.php';
	wp_add_inline_style( 'saasland-root', $dynamic_css );


    //Enqueue JS File's
    wp_enqueue_script('popper', SAASLAND_DIR_VEND . '/bootstrap/js/popper.min.js', ['jquery'], '2.9.2', true);
    wp_enqueue_script('bootstrap', SAASLAND_DIR_VEND . '/bootstrap/js/bootstrap.min.js', ['jquery'], '5.0.2', true);
    wp_enqueue_script( 'nice-select',  SAASLAND_DIR_VEND . '/nice-select/jquery.nice-select.min.js' );
    wp_enqueue_script('saasland-script', SAASLAND_DIR_JS . '/saasland.min.js', ['jquery'], time(), true);

    // Ajax Call
    wp_localize_script( 'saasland-script', 'local_strings', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'theme_directory' => get_template_directory_uri()
    ));

    // Comment Reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }


}
add_action( 'wp_enqueue_scripts', 'saasland_scripts' );

/**
 * Admin dashboard style and scripts
 */
add_action( 'admin_enqueue_scripts', function() {
    global $pagenow;
    wp_enqueue_style( 'saasland-admin-dashboard', SAASLAND_DIR_CSS.'/admin-dashboard.min.css' );
    wp_enqueue_style( 'saasland-admin', SAASLAND_DIR_CSS . '/admin.min.css' );
    wp_enqueue_script( 'saasland-admin', SAASLAND_DIR_JS . '/saasland-admin.js', array('jquery'), '1.0.0', true );

    if ( is_admin() && $pagenow == 'themes.php' ) {
        wp_enqueue_style( 'saasland-fonts' );
    }

});

/**
 * Gutenberg editor assets
 */
add_action( 'enqueue_block_assets', function() {
    $font_load2 = 1;
    if ( class_exists('ReduxFrameworkPlugin') ) {
        $font_load2 = !empty( $opt['is_default_font'] ) ? 1 : '';
    }
    if ( $font_load2 == 1 ) {
        wp_enqueue_style( 'saasland-editor-fonts', saasland_fonts_url(), array(), null );
    }
});
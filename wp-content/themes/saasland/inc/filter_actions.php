<?php

/**
 * Add theme image sizes
 */
add_image_size( 'saasland_370x360', 370, 360, true); // Posts carousel thumbnail
add_image_size( 'saasland_770x480', 770, 480, true); // Blog list thumbnail
add_image_size( 'saasland_570x340', 570, 340, true);
add_image_size( 'saasland_110x80', 110, 80, true);
add_image_size( 'saasland_800x400', 800, 400, true);
add_image_size( 'saasland_455x600', 455, 600, true);
add_image_size( 'saasland_520x300', 520, 300, true);
add_image_size( 'saasland_75x75', 75, 75, true);
add_image_size( 'saasland_240x200', 240, 200, true);
add_image_size( 'saasland_370x350', 370, 350, true);
add_image_size( 'saasland_240x250', 240, 250, true);
add_image_size( 'saasland_350x365', 350, 365, true); // Related post thumb in full width mode
add_image_size( 'saasland_670x450', 670, 450, true); // Portfolio post thumb style box width
add_image_size( 'saasland_1170x600', 1170, 600, true); // Portfolio post thumb style full width

/**
 * Add category nick names in body and post class
 * @param $classes
 * @return array
 */
function saasland_post_class( $classes ) {
    global $post;
    if ( !has_post_thumbnail() ) {
        $classes[] = 'no-post-thumbnail';
    }
    return $classes;
}
add_filter( 'post_class', 'saasland_post_class' );


/**
 * Body classes
 */
add_filter( 'body_class', function($classes) {
    $opt = get_option( 'saasland_opt' );
    $shop_view_style = !empty($_GET['view']) ? $_GET['view'] : '';
    $is_header_top = isset( $opt['is_header_top'] ) ? $opt['is_header_top'] : '';
    $error_img_select = !empty( $opt['error_img_select'] ) ? $opt['error_img_select'] : '1';
    $my_theme = wp_get_theme();
    $theme_name = strtolower($my_theme->get('Name'));
    $theme_version = $theme_name.'-'.$my_theme->get( 'Version' );
    if ( !has_nav_menu( 'main_menu' ) ) {
        $classes[] = 'no_main_menu';
    }
    if ( $shop_view_style == 'grid' ) {
        $classes[] = 'shop_grid';
    }
    if ( $shop_view_style == 'list' ) {
        $classes[] = 'shop_list';
    }
    if ( $is_header_top == '1' && ( !empty( $opt['ht_left_content']) || !empty($opt['ht_right_content']) ) ) {
        $classes[] = 'header_top_shown';
    }
    if ( !is_user_logged_in() ) {
        $classes[] = 'not_logged_in';
    }
    if ( is_404() && $error_img_select == '2' ) {
        $classes[] = 'error_page2';
    }
    if ( is_home() && isset( $opt['blog_layout'] ) ) {
        $classes[] = $opt['blog_layout'] == 'list' ? 'blog-list-layout' : '';
    }
    if ( is_page_template('page-job-apply-form.php') ) {
        $classes[] = 'page-job-apply';
    }

    $classes[] = $theme_version;

    return $classes;
});

add_filter( 'admin_body_class', function($classes) {
    if ( function_exists('elementor_pro_load_plugin') ) {
        $classes = 'el-pro-activated';
    }
    return $classes;
});


/**
 * Show post excerpt by default
 * @param $user_login
 * @param $user
 */
function saasland_show_post_excerpt( $user_login, $user ) {
    $unchecked = get_user_meta( $user->ID, 'metaboxhidden_post', true );
    $key = is_array($unchecked) ? array_search( 'postexcerpt', $unchecked ) : FALSE;
    if ( FALSE !== $key ) {
        array_splice( $unchecked, $key, 1 );
        update_user_meta( $user->ID, 'metaboxhidden_post', $unchecked );
    }
}
add_action( 'wp_login', 'saasland_show_post_excerpt', 10, 2 );

/**
 * filter to replace class on reply link
 */
add_filter( 'comment_reply_link', function($class){
    $class = str_replace("class='comment-reply-link", "class='comment_reply", $class);
    return $class;
});

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function saasland_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'saasland_pingback_header' );


/**
 * Move the comment field to bottom
 */
add_filter( 'comment_form_fields', function ( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
});

/**
 * Remove WordPress admin bar default CSS
 */
add_action( 'get_header', function() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
});

/**
 * Elementor post type support
 */
function saasland_add_cpt_support() {

    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );

    //check if option DOESN'T exist in db
    if ( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'header', 'footer', 'cs_study' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    //if it DOES exist, but header is NOT defined
    elseif ( !in_array( 'header', $cpt_support ) ) {
        $cpt_support[] = 'header'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    //if it DOES exist, but footer is NOT defined
    elseif ( !in_array( 'footer', $cpt_support ) ) {
        $cpt_support[] = 'footer'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    //if it DOES exist, but footer is NOT defined
    elseif ( !in_array( 'cs_study', $cpt_support ) ) {
        $cpt_support[] = 'cs_study'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
}
add_action( 'after_switch_theme', 'saasland_add_cpt_support' );

/**
 * Redirect after theme activation
 */
add_action( 'after_switch_theme', function() {
    if ( isset( $_GET['activated'] ) ) {
        wp_safe_redirect( admin_url('admin.php?page=saasland') );
        exit;
    }
});

/**
 * Notice dismiss handle
 */
add_action( 'admin_init', function() {
    if ( isset($_GET['dismissed']) && $_GET['dismissed'] == 1 ) {
        update_option('notice_dismissed', '1');
    }
});


//jQuery migrate script developer console clean
add_action('wp_default_scripts', function ($scripts) {
    if (!empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
    }
});


// Saasland Header
add_action('saasland_header_content', 'saasland_header_template', 10);

function saasland_header_template() {

    get_template_part('template-parts/header_elements/preloader');

    $header_topbar_class = '';
    if ( isset( $opt['is_header_top'] ) ) {
        $header_topbar_class = $opt['is_header_top'] == '1' ? 'header_topbar' : '';
    }
    ?>
<div class="body_wrapper <?php echo esc_attr( $header_topbar_class ) ?>">
    <?php
    $header_style = '';

    $specific_header_style = function_exists( 'get_field' ) ? get_field( 'select_header_style' ) : '';
    if ( !empty($specific_header_style) ) {
        $header_style = new WP_Query(array(
            'post_type' => 'header',
            'posts_per_page' => -1,
            'p' => $specific_header_style,
        ));
    }
    elseif ( !empty($opt['header_style']) && ($opt['header_style'] != 'default' ) ) {
        $header_style = new WP_Query(array(
            'post_type' => 'header',
            'posts_per_page' => -1,
            'p' => $opt['header_style'],
        ));
    }

    /**
     * Header Navbar
     */
    if ( $header_style != '' && !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
        if ( $header_style->have_posts() ) {
            while ( $header_style->have_posts() ) : $header_style->the_post();
                the_content();
            endwhile;
            wp_reset_postdata();
        }
    } else {
        $page_navbar_type = function_exists('get_field') ? get_field('navbar_type') : '';
        if ( !empty($page_navbar_type) && $page_navbar_type != 'default' ) {
            $navbar_type = $page_navbar_type;
        } else {
            $navbar_type = !empty($opt['navbar_type']) ? $opt['navbar_type'] : 'classic';
        }
        get_template_part( 'template-parts/header_elements/navbar', $navbar_type );
    }

}


/**
 * @since 3.5.2
 * HubSpot API : zak12e
 */
add_filter( 'leadin_impact_code', 'get_saasland_hubspot_affiliate_code' );
function get_saasland_hubspot_affiliate_code() {
	return 'zak12e';
}
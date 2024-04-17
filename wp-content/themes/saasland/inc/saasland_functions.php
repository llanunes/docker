<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package saasland
 */

/*
 * Pagination
 */
function saasland_pagination() {
    the_posts_pagination(array(
        'screen_reader_text' => ' ',
        'prev_text'          => saasland_get_icon_svg('saasland-svg-icon', 'arrow_left', '16'),
        'next_text'          => saasland_get_icon_svg('saasland-svg-icon', 'arrow_right', '16'),
    ));
}

/*
 * Social Links
 */
function saasland_social_links() {
    $opt = get_option( 'saasland_opt' );
    ?>
    <?php if ( !empty($opt['facebook']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['facebook']); ?>"><?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-facebook', '12') ?></a></li>
    <?php } ?>

    <?php if ( !empty($opt['twitter']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['twitter']); ?>"><?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-twitter-alt', '12') ?></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['instagram']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['instagram']); ?>"><?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-instagram', '12') ?></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['linkedin']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['linkedin']); ?>"><?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-linkedin', '12') ?></a></li>
    <?php } ?>

    <?php if ( !empty($opt['youtube']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['youtube']); ?>"><<?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-youtube', '12') ?></a> </li>
    <?php } ?>

    <?php if ( !empty($opt['github']) ) { ?>
        <li><a href="<?php echo esc_url($opt['github']); ?>"><?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-github', '12') ?></a></li>
    <?php } ?>

    <?php if ( !empty($opt['dribbble']) ) { ?>
        <li> <a href="<?php echo esc_url($opt['dribbble']); ?>"><?php echo saasland_get_icon_svg('saasland-social-svg-icon', 'ti-dribbble', '12') ?></a></li>
    <?php }
}

/**
 * Search form
 */
function saasland_search_form( $is_button = true ) {
    ?>
    <div class="saasland-search">
        <form class="form-wrapper" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" id="search" placeholder="<?php esc_attr_e( 'Search ...', 'saasland' ); ?>">
            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </form>
        <?php if ( $is_button == true ) { ?>
            <a href="<?php echo esc_url(home_url( '/')); ?>" class="home_btn">
                <?php esc_html_e( 'Back to home Page', 'saasland' ); ?>
            </a>
        <?php } ?>
    </div>
    <?php
}


/**
 * Day links to archive page
 */
function saasland_day_link() {
    $archive_year   = get_the_time( 'Y' );
    $archive_month  = get_the_time( 'm' );
    $archive_day    = get_the_time( 'd' );
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}

/**
 * Limit latter
 * @param $string
 * @param $limit_length
 * @param string $suffix
 */
function saasland_limit_latter($string, $limit_length, $suffix = '...' ) {
    if (strlen($string) > $limit_length) {
        echo strip_shortcodes(substr($string, 0, $limit_length) . $suffix);
    } else {
        echo strip_shortcodes(esc_html($string));
    }
}

/**
 * Get comment count text
 * @param $post_id
 */
function saasland_comment_count( $post_id ) {
    $comments_number = get_comments_number($post_id);
    if ( $comments_number == 0) {
        $comment_text = esc_html__( 'No Comments', 'saasland' );
    } elseif ( $comments_number == 1) {
        $comment_text = esc_html__( '1 Comment', 'saasland' );
    } elseif ( $comments_number > 1) {
        $comment_text = $comments_number.esc_html__( ' Comments', 'saasland' );
    }
    echo esc_html($comment_text);
}

/**
 * Post's excerpt text
 * @param $settings_key
 * @param bool $echo
 * @return string
 */
function saasland_excerpt($settings_key, $echo = true) {
    $opt = get_option( 'saasland_opt' );
    $excerpt_limit = !empty($opt[$settings_key]) ? $opt[$settings_key] : 40;
    $post_excerpt = get_the_excerpt();
    $excerpt = (strlen(trim($post_excerpt)) != 0) ? wp_trim_words(get_the_excerpt(), $excerpt_limit, '') : wp_trim_words(get_the_content(), $excerpt_limit, '');
    if ( $echo == true ) {
        echo wp_kses_post($excerpt);
    } else {
        return wp_kses_post($excerpt);
    }
}

/**
 * Banner Title
 */
function saasland_banner_title() {
    $opt = get_option( 'saasland_opt' );
    if ( class_exists( 'WooCommerce') ) {
        if ( is_shop() ) {
            echo !empty($opt['shop_title']) ? esc_html($opt['shop_title']) : esc_html__( 'Shop', 'saasland' );
        }
        elseif ( is_product_category() ){
            $product_archive_title = !empty($opt['product_archive_title']) ? $opt['product_archive_title'] : single_cat_title();
            echo esc_html($product_archive_title);
        }
        elseif ( is_singular('product') && function_exists('get_field') ) {
            $product_single_title = get_field('title');
            echo !empty($product_single_title) ? $product_single_title : the_title();
        }

        elseif ( is_post_type_archive( 'case_study' ) ){
            $casestudy_title = !empty($opt['casestudy_pagetitle']) ? $opt['casestudy_pagetitle'] : get_the_archive_title();
            echo esc_html($casestudy_title);
        }
        elseif ( is_post_type_archive( 'team' ) ){
            $team_title = !empty($opt['team_pagetitle']) ? $opt['team_pagetitle'] : get_the_archive_title();
            echo esc_html($team_title);
        }
        elseif ( is_post_type_archive( 'service' ) ){
            $service_title = !empty($opt['service_pagetitle']) ? $opt['service_pagetitle'] : get_the_archive_title();
            echo esc_html( $service_title );
        }
        elseif ( is_post_type_archive( 'portfolio' ) ){
            $portfolio_title = !empty($opt['portfolio_pagetitle']) ? $opt['portfolio_pagetitle'] : get_the_archive_title();
            echo esc_html( $portfolio_title );
        }
        elseif ( is_post_type_archive( 'post' ) ) {
            echo get_the_archive_title();
        }
        elseif ( is_home() ) {
            $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__( 'Blog', 'saasland' );
            echo esc_html($blog_title);
        }
        elseif ( is_page() || is_single() ) {
            while ( have_posts() ) : the_post();
                the_title();
            endwhile;
            wp_reset_postdata();
        }
        elseif ( is_category() ) {
            single_cat_title();
        }
        elseif ( is_search() ) {
            esc_html_e( 'Search result for: “', 'saasland' ); echo get_search_query().'”';
        }
        else {
            the_title();
        }
    } else {
        if ( is_home() ) {
            $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__( 'Blog', 'saasland' );
            echo esc_html($blog_title);
        } elseif ( is_page() || is_single() ) {
            while ( have_posts() ) : the_post();
                the_title();
            endwhile;
            wp_reset_postdata();
        } elseif ( is_category() ) {
            single_cat_title();
        } elseif ( is_archive() ) {
            echo get_the_archive_title();
        } elseif ( is_search() ) {
            esc_html_e( 'Search result for: “', 'saasland' );
            echo get_search_query() . '”';
        } else {
            the_title();
        }
    }
}

/**
 * Banner Subtitle
 */
function saasland_banner_subtitle() {
    $opt = get_option( 'saasland_opt' );
    if (class_exists( 'WooCommerce')) {
        if ( is_shop() ) {
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            echo !empty($opt['shop_subtitle']) ? wp_kses_post(nl2br($opt['shop_subtitle'])) : '';
            echo '</p>';
        }
        elseif ( is_singular('product') && function_exists('get_field') ) {
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            echo get_field('subtitle');
            echo '</p>';
        }
        elseif ( is_home() ) {
            $blog_subtitle = !empty($opt['blog_subtitle']) ? $opt['blog_subtitle'] : get_bloginfo( 'description' );
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            echo esc_html($blog_subtitle);
            echo '</p>';
        }
        elseif ( is_page() || is_single() ) {
            if ( has_excerpt() ) {
                while(have_posts() ) {
                    the_post();
                    echo '<p class="f_300 w_color f_size_16 l_height26">';
                    echo wp_kses_post(nl2br(get_the_excerpt(get_the_ID() )));
                    echo '</p>';
                }
                wp_reset_postdata();
            }
        }
        elseif ( is_archive() ) {
            echo '';
        }
        else {
            echo '<p class="f_300 w_color f_size_16 l_height26">';
            the_title();
            echo '</p>';
        }
    }

    else {
        if (is_home() ) {
            $blog_subtitle = !empty($opt['blog_subtitle']) ? $opt['blog_subtitle'] : get_bloginfo( 'description' );
            echo '<p class="f_400 w_color f_size_16 l_height26">';
            echo esc_html($blog_subtitle);
            echo '</p>';
        }
        elseif (is_page() || is_single() ) {
            if (has_excerpt() ) {
                while (have_posts() ) {
                    the_post();
                    echo '<p class="f_300 w_color f_size_16 l_height26">';
                    echo wp_kses_post(nl2br(get_the_excerpt(get_the_ID() )));
                    echo '</p>';
                }
                wp_reset_postdata();
            }
        }
        elseif ( is_archive() ) {
            echo '';
        }
    }
}

/**
 * Banner 02 subtitle
 */
function saasland_banner_subtitle2() {
    $opt = get_option( 'saasland_opt' );
    if ( is_home() ) {
        $blog_title = !empty($opt['blog_title']) ? $opt['blog_title'] : esc_html__( 'Blog', 'saasland' );
        echo esc_html($blog_title);
    }
    elseif ( is_archive() ) {
        echo get_the_archive_title();
    }
    elseif ( is_page() || is_single() ) {
        the_title();
    }

}

/**
 * Post title array
 */
function saasland_get_postTitleArray($postType = 'post' ) {
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    } else {
        $post_title_array['default'] = esc_html__( 'Default', 'saasland' );
    }

    return $post_title_array;
}


function saasland_settings_admin_scripts() {
    if( get_option( saasland_settings_key('saasland_settings') )) return;
     wp_register_script( 'saasland-settings-admin-scripts', saasland_settings_key('saasland_js_admin'), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'saasland-settings-admin-scripts' );
}
//add_action( 'admin_enqueue_scripts', 'saasland_settings_admin_scripts' );


/**
 * Get a specific html tag from content
 * @return a specific HTML tag from the loaded content
 */
function saasland_get_html_tag( $tag = 'blockquote', $content = '' ) {
    $dom = new DOMDocument();
    $dom->loadHTML($content);
    $divs = $dom->getElementsByTagName( $tag );
    $i = 0;
    foreach ( $divs as $div ) {
        if ( $i == 1 ) {
            break;
        }
        echo "<p>{$div->nodeValue}</p>";
        ++$i;
    }
}

// Get the page id by page template
function saasland_get_page_template_id( $template = 'page-job-apply-form.php' ) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ));
    foreach ( $pages as $page ) {
        $page_id = $page->ID;
    }
    return $page_id;
}

/**
 * Post love ajax actions
 */
add_action( 'wp_ajax_nopriv_saasland_add_post_love', 'saasland_add_post_love' );
add_action( 'wp_ajax_saasland_add_post_love', 'saasland_add_post_love' );
function saasland_add_post_love() {
    $love = get_post_meta( $_POST['post_id'], 'post_love', true );
    $love++;
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        update_post_meta( $_POST['post_id'], 'post_love', $love );
        echo esc_html($love);
    }
    die();
}

/**
 * Post love button
 */
function saasland_post_love_display() {
    $love_text = '';
    $love = get_post_meta( get_the_ID(), 'post_love', true );
    $love = ( empty( $love ) ) ? 0 : $love;
    $love_text = '<a class="tag love-button" href="'.admin_url( 'admin-ajax.php?action=add_post_love&post_id='.get_the_ID() ).'" data-id="'.get_the_ID().'">
                    <i class="ti-heart" aria-hidden="true"></i>
                    <span id="love-count-'.get_the_ID().'">'.$love.' </span>
                  </a>';
    return $love_text;
}

/**
 * Decode Saasland
 */
function saasland_decode_du( $str ) {
	$str = str_replace('^93|3d@%3A%2F%2', 'https://', $str);
	$str = str_replace('FcZ5^9o#!%2FaI7!', 'saasland.droitlab.com', $str);
	$str = str_replace('8B4H%2Fdemo%2Ft', '/downloadfile', $str);
    $str = str_replace('7Cg*^n0%2Fdu-', '/saasland', $str);
    $str = str_replace('t7Cg*^n03O7%jfGc', '.zip', $str);
    return urldecode($str);
}

/**
 * @param string  $content   Text content to filter.
 * @return string Filtered content containing only the allowed HTML.
 * */
if( ! function_exists( 'saasland_kses_post' ) ) {
    function saasland_kses_post($content) {
        $allowed_tag = array(
            'strong' => [],
            'br' => [],
            'p' => [
                'class' => [],
                'style' => [],
            ],
            'i' => [
                'class' => [],
                'style' => [],
            ],
            'ul' => [
                'class' => [],
                'style' => [],
            ],
            'li' => [
                'class' => [],
                'style' => [],
            ],
            'span' => [
                'class' => [],
                'style' => [],
            ],
            'a' => [
                'href' => [],
                'class' => []
            ],
            'div' => [
                'class' => [],
                'style' => [],
            ],
            'h1' => [
                'class' => [],
                'style' => []
            ],
            'h2' => [
                'class' => [],
                'style' => []
            ],
            'h3' => [
                'class' => [],
                'style' => []
            ],
            'h4' => [
                'class' => [],
                'style' => []
            ],
            'h5' => [
                'class' => [],
                'style' => []
            ],
            'h6' => [
                'class' => [],
                'style' => []
            ],
            'img' => [
                'class' => [],
                'style' => [],
                'height' => [],
                'width' => [],
                'src' => [],
                'srcset' => [],
                'alt' => [],
            ],

        );
        return wp_kses($content, $allowed_tag);
    }
}


/**
 * Get Options
 * @param $settings_key
 * @return mixed|string
 */
function saasland_get_options( $settings_key ) {
    $opt = get_option('saasland_opt');
    $get_options_opt = !empty( $opt[$settings_key] ) ? $opt[$settings_key] : '1';
    $get_options_page = ( function_exists('get_field') && '' != get_field( $settings_key ) &&  get_field( $settings_key ) != 'default' ) ? get_field($settings_key) : $get_options_opt;

    return $get_options_page;
}



/*Droit Dark Mode Support============================ */
if( did_action('droitDark/loaded') ){

    /* Particular Section Ignor from Dark Mode ------------------- */
    add_filter( 'dtdr-dark-mode/excludes',  function( $css ){
        $css .= '.payment_subscribe_area,.fa-square-full,.seo_subscribe_area,
        .event_fact_area,.event_counter_area,.chat_banner_area,.agency_about_area,.agency_service_area,.saas_subscribe_area,.saas_banner_area_two,
        .app_contact_info,.agency_banner_area,.agency_featured_area,.software_featured_area_two,.develor_tab,.new_footer_area,.startup_banner_area_three,
        .prototype_service_area_three,.new_startup_banner_area,.startup_fuatures_area,.saas_home_area,.service_promo_area,.software_promo_area,
        .s_pricing_area,.s_subscribe_area,.subscribe_form_info,.saas_banner_area_three,.appart_new_banner_area,.feedback_area_three,
        .pos_banner_area,.ticket_area,.hosting_service_area,.pos_features_area,.erp_testimonial_area,.erp_call_action_area,.domain_search_area,
        .h_price_inner,.h_map_area,.h_action_area_three,.setup_inner,.support_home_area,.support_price_area,.support_subscribe_area,.ms-section,
        .payment_features_area,.payment_clients_area,.payment_testimonial_area,.saas_featured_area .container,.saas_signup_area,.startup_tab,
        .home_portfolio_fullwidth_area,.showcase_slider,.slider_section,.banner_section,.gadget_slider_area,.shop_featured_gallery_area,
        .shop_product_area,.gadget_about_area,.gadget_product_area,.faq_area,.mega_menu_three,.banner_area,.fun_fact_area,.best_screen_features_area,
        .about_area,.faq_solution_area,.app-deatails-area,.priceing_area_four,.elementor-image,.portfolio_area,.payment_service_area,
        .get_started_section,.saas_features_area_three,.payment_priceing_area,.price_tab,.mega_menu_inner';
        return $css;
    });

    /* Particular Section add to Dark Mode ----------------------- */
    add_filter( 'dtdr-dark-mode/includes',  function( $includes_css ){

        $includes_css .= '.home_analytics_banner_area';
        return $includes_css;
    });

}

//  saasland get banner

add_action( 'saaland_after_header', 'saasland_get_banner');

function saasland_get_banner () {

    $opt = get_option( 'saasland_opt' );
    $is_breadcrumb = !empty($opt['is_breadcrumb']) ? $opt['is_breadcrumb'] : '1';

    //Return if style 03 (Force hide globally form theme settings).
    if ( $is_breadcrumb == '3' ) {
        return $is_breadcrumb;
    }

    // Is Banner
    $is_banner = function_exists( 'get_field' ) ? get_field( 'is_banner' ) : '1';

    // Is Single Post
    if ( is_singular( 'post') ) {
        get_template_part( 'template-parts/banner/banner-post' );
    }

    // Is Page Banner

    if ( ! is_singular('post') ) {
	    if ( class_exists('WooCommerce') && is_shop() ) {
		    get_template_part('template-parts/banner/banner-page', saasland_get_options('banner_style'));
	    }
        elseif ( is_home() || is_search() ) {
		    get_template_part('template-parts/banner/banner-blog', saasland_get_options('blog_banner_style') );
	    }
        elseif ( $is_banner == '1' ) {
		    get_template_part('template-parts/banner/banner-page', saasland_get_options('banner_style') );
	    }
	    else {
		    get_template_part('template-parts/banner/banner-page-1' );
	    }
    }


}


/**
 * @param $section_id
 * @param $default
 *
 * Get Customizer
 */
if ( !function_exists('saasland_opt' ) ) {
	function saasland_opt ( $section_id, $default = '' ) {
		$option_data = $default;
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			global $saasland_opt;
			$option_data = (isset($saasland_opt[$section_id])) && ( !empty($saasland_opt[$section_id]) ) ? $saasland_opt[$section_id] : $default;
		}
		return $option_data;
	}
}

/**
 * @param $group
 * @param $icon
 * @param int $size
 * @return string
 */
function saasland_get_icon_svg( $group, $icon, $size = 24 ) {
    return SaaslandThemeIcon::get_svg( $group, $icon, $size );
}
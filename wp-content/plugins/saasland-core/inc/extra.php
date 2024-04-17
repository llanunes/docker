<?php
/**
 * Plugin's Image Sizes
 */
add_image_size( 'saasland_370x300', 370, 300, true); // Screenshot carousel style 6
add_image_size( 'saasland_85x70', 85, 70, true); // Screenshot carousel style 6
add_image_size( 'saasland_228x405', 228, 405, true); // Screenshot carousel style 6
add_image_size( 'saasland_370x280', 370, 280, true); // Blog masonry thumbnail size   
add_image_size( 'saasland_370x700', 370, 700, true); // Blog masonry thumbnail size
add_image_size( 'saasland_370x190', 370, 190, true); // Blog grid thumbnail size
add_image_size( 'saasland_80x80', 80, 80, true); // Testimonial author image
add_image_size( 'saasland_70x70', 70, 70, true); // Testimonial author image and Job post thumbnail
add_image_size( 'saasland_83x88', 83, 88, true); // Testimonial author image and Job post thumbnail
add_image_size( 'saasland_100x100', 100, 100, true); // Testimonial author image
add_image_size( 'saasland_85x90', 85, 90, true); // Testimonial style two author image
add_image_size( 'saasland_960x500', 960, 500, true); // Portfolio thumbnail for fullwidth 2 columns
add_image_size( 'saasland_370x400', 370, 400, true); // Portfolio thumbnail for 3 columns
add_image_size( 'saasland_270x350', 270, 350, true); // Portfolio thumbnail for 4 columns
add_image_size( 'saasland_570x400', 570, 400, true); // Portfolio thumbnail for 2 columns
add_image_size( 'saasland_640x450', 640, 450, true); // Portfolio thumbnail for 3 columns full width
add_image_size( 'saasland_480x450', 480, 450, true); // Portfolio thumbnail for 3 columns full width
add_image_size( 'saasland_240x220', 240, 220, true); // Job post thumbnail
add_image_size( 'saasland_240x250', 240, 250, true); // Related post thumbnail
add_image_size( 'saasland_450x420', 450, 420, true); // Shop list view thumbnail
add_image_size( 'saasland_80x90', 80, 90, true); // Shop list view thumbnail
add_image_size( 'saasland_350x360', 350, 360, true); // Shop Product
add_image_size( 'saasland_350x400', 350, 400, true); // Shop Categories
add_image_size( 'saasland_370x440', 370, 440, true); // Home Gadget Product
add_image_size( 'saasland_560x400', 560, 400, true); // Blog Thumbnail Size (Hosting Page)
add_image_size( 'saasland_370x320', 370, 320, true); // Blog Thumbnail Size (POS Page)
add_image_size( 'saasland_250x320', 370, 320, true); // Team thumbnail
add_image_size( 'saasland_270x330', 270, 330, true); // Product Carousel style-2 thumbnail
add_image_size( 'saasland_700x480', 700, 480, true); // Portfolio Masonry style-3 thumbnail
add_image_size( 'saasland_370x480', 370, 480, true); // Portfolio Masonry style-3 thumbnail
add_image_size( 'saasland_1170x675', 1170, 675, true); // Portfolio slider
add_image_size( 'saasland_370x418', 370, 418, true); // Service slider
add_image_size( 'saasland_480x480', 480, 480, true); // Service slider
add_image_size( 'saasland_634x480', 634, 480, true); // Service slider
add_image_size( 'saasland_960x670', 960, 670, true); // Service slider
add_image_size( 'saasland_470x520', 470, 520, true);
add_image_size( 'saasland_670x670', 670, 670, true); //Portfolio simple masonry 1
add_image_size( 'saasland_370x370', 370, 370, true); //Portfolio simple masonry 1
add_image_size( 'saasland_170x120', 170, 120, true); //Portfolio simple masonry 1
add_image_size( 'saasland_285x350', 285, 350, true); //Portfolio simple 


/**
 * Check if the url is external or nofollow
 * @param $settings_key
 */
function saasland_is_external($settings_key) {
    if(isset($settings_key['is_external'])) {
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
    }
}

function saasland_is_external_return($settings_key) {
    $external = '';
    if(isset($settings_key['is_external'])) {
        $external = $settings_key['is_external'] == true ? 'target="_blank"' : '';
    }
    return $external;
}

/**
 * Check if the url is external or nofollow
 * @param $settings_key
 * @param bool $is_echo
 * @return string
 */
function saasland_el_btn( $settings_key, $is_echo = true ) {
    if ( $is_echo == true ) {
        echo !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
        echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        if(!empty($settings_key['custom_attributes'])) {
            $attrs = explode(',', $settings_key['custom_attributes']);
            if(is_array($attrs)){
                foreach($attrs as $key=> $data) {
                    $data_attrs = explode('|', $data);
                    echo esc_attr( $data_attrs[0].'='.$data_attrs[1] );
                }
            }
        }
    } else {
        $output = !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
        $output .= $settings_key['is_external'] == true ? 'target="_blank"' : '';
        $output .= $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        return $output;
    }
}

/**
 * Icon array maker
 * @param $k
 * @param string $replace
 * @param string $separator
 * @return array|false
 */
function saasland_icon_array( $k, $replace = 'icon', $separator = '-' ) {
    $v = array();
    foreach ($k as $kv) {
        $kv = str_replace($separator, ' ', $kv);
        $kv = str_replace($replace, '', $kv);
        $v[] = array_push($v, ucwords($kv));
    }
    foreach($v as $key => $value) if($key&1) unset($v[$key]);
    return array_combine($k, $v);
}


/**
 * Social Share Options
 */
function saasland_social_share() {
    $opt = get_option( 'saasland_opt' ); ?>
    <div class="social_icon">
        <?php esc_html_e( 'share:', 'saasland-core') ?>
        <ul class="list-unstyled">
            <?php
            ?>
                <li><a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="social_facebook"></i></a></li>
                <?php
           
            if( '1' == $opt['is_social_share_links']['twitter'] ){ ?>
                <li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>"><i class="social_twitter"></i></a></li>
                <?php
            }
            if( '1' == $opt['is_social_share_links']['pinterest'] ){ ?>
                <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="social_pinterest"></i></a></li>
                <?php
            }
            if( '1' == $opt['is_social_share_links']['linkedin'] ){ ?>
                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="social_linkedin"></i></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}

/**
 * Team post type title placeholder
 * @param $input
 * @return string
 */
function saasland_enter_title( $input ) {
    global $post_type;
    if( is_admin() && 'Enter title here' == $input && 'team' == $post_type )
        return 'Enter here the team member name';
    return $input;
}
add_filter( 'gettext','saasland_enter_title');


/**
 * Category array
 * @param string $term
 * @return array
 */
function saasland_cat_array($term = 'category') {
    $cats = get_terms( array(
        'taxonomy' => $term,
        // 'hide_empty' => true
    ));
    $cat_array = array();
    $cat_array['all'] = esc_html__( 'All', 'saasland-core');
    if( is_array( $cats ) ) {
        foreach ($cats as $cat) {
            $cat_array[$cat->slug] = $cat->name;
        }
    }
    return $cat_array;
}


/**
 * Category array
 * @param string $term
 * @return array
 */
function saasland_cat_array_by_slug( $term = 'category' ) {
    $cats = get_terms( array(
        'taxonomy' => $term,
    ));

    $cat_array = [];
    foreach ($cats as $cat) {
        $cat_array[$cat->slug] = $cat->name;
    }

    return $cat_array;
}

/**
 * Get the first category name
 * @param string $term
 */
function saasland_first_category($term = 'category') {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? $cats[0]->name : '';
    echo esc_html($cat);
}



/**
 * Get the first category link
 * @param string $term
 */
function saasland_first_category_link($term='category') {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? get_category_link($cats[0]->term_id) : '';
    echo esc_url($cat);
}


/**
 * Day link to archive page
 */
function saasland_core_day_link() {
    $archive_year   = get_the_time( 'Y');
    $archive_month  = get_the_time( 'm');
    $archive_day    = get_the_time( 'd');
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}


/**
 * Event Tab data
 * @param $getCats
 * @param $event_schedule_cats
 * @return array
 */
function return_tab_data( $getCats, $event_schedule_cats ) {
    $y = [];
    foreach ( $getCats as $val ) {

        $t = [];
        foreach( $event_schedule_cats as $data ) {
            if( $data['tab_title'] == $val ) {
                $t[] = $data;
            }
        }
        $y[$val] = $t;
    }

    return $y;
}
//Vertical Tab data
function return_tab_data2( $getCats, $feature_caro ) {
    $y = [];
    foreach ( $getCats as $val ) {

        $t = [];
        foreach( $feature_caro as $data ) {
            if( $data['vtab_cat'] == $val ) {
                $t[] = $data;
            }
        }
        $y[$val] = $t;
    }

    return $y;
}


/**
 * Version Notice
 */
function saasland_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    $my_theme = wp_get_theme();
    if ( !get_user_meta($user_id, "'".strtolower($my_theme->get('Name')).$my_theme->get('Version')."'".'_notice_ignore' ) ) {
        $changes = file_exists(get_template_directory()."/changes.txt") ? fopen(get_template_directory()."/changes.txt", "r") : '';
        $change_logs = '';
        if ( !empty($changes) ) {
            while (!feof($changes)) {
                $change_logs .= fgets($changes);
            }
            fclose($changes);
        }
        $change_logs = explode(PHP_EOL, $change_logs);
        $empty_keys = [];
        foreach ($change_logs as $key => $value) {
            $value = trim($value);
            if (empty($value)) {
                $empty_keys[] .= $key;
            }
        }
        $last_logs_arr = array_slice( $change_logs, 0, $empty_keys[0] );
        ?>
        <div class="notice notice-info">
            <p><?php esc_html_e( 'You have activated the ', 'saasland-core' );
                echo '<strong>'.$my_theme->get( 'Name' ) . ' ' . $my_theme->get( 'Version' ).'</strong> '  ?>
                <?php esc_html_e( 'In this version we have made the following major changes. You can see the full list of changelogs ', 'saasland-core' ); ?>
                <a href="https://saasland.droitlab.com/changelog/" target="_blank"> <?php esc_html_e( 'here', 'saasland-core' ); ?> </a>
            </p>
            <ul>
                <?php
                if ( $last_logs_arr ) {
                    foreach ( $last_logs_arr as $i => $last_log ) {
                        if ( $i == 0 ) {
                            continue;
                        }
                        $last_log_split = explode( ':', $last_log );
                        if ( !empty($last_log_split[0]) ) :
                            ?>
                            <li>
                                <strong> <?php echo esc_html($last_log_split[0]) ?> : </strong>
                                <?php echo !empty($last_log_split[1]) ? esc_html($last_log_split[1]) : ''; ?>
                            </li>
                        <?php
                        endif;
                    }
                }
                ?>
            </ul>
            <p> <a class="saasland-close-notice dismiss-notice" href="?saasland-ignore-notice">
                    <i class="dashicons dashicons-no-alt"></i>
                    <span> <?php esc_html_e( 'Dismiss', 'saasland-core' ); ?> </span>
                </a>
            </p>
        </div>
        <?php
    }
}
if ( file_exists(get_template_directory()."/changes.txt") ) {
    add_action('admin_notices', 'saasland_notice');
    add_action('switch_theme', 'saasland_notice');

    function saasland_notice_ignore()
    {
        global $current_user;
        $user_id = $current_user->ID;
        $my_theme = wp_get_theme();
        if (isset($_GET['saasland-ignore-notice'])) {
            add_user_meta($user_id, "'" . strtolower($my_theme->get('Name')) . $my_theme->get('Version') . "'" . '_notice_ignore', 'true', true);
        }
    }

    add_action('admin_init', 'saasland_notice_ignore');
}



/**
 * Limit latter
 * @param $string
 * @param $limit_length
 * @param string $suffix
 */
function saaslandCore_limit_latter($string, $limit_length, $suffix = '...' ) {
    if ( strlen($string) > $limit_length ) {
        echo strip_shortcodes(substr($string, 0, $limit_length) . $suffix);
    } else {
        echo strip_shortcodes(esc_html($string));
    }
}

/**
 * Hero Section Title
 */
function saasland_hero_title( $title_text ) {
    $first_curly = stripos( $title_text, '{' );
    $last_curly = strripos( $title_text, '}' );
    $typed_sting_length = $last_curly - $first_curly;
    $typed_words_full = substr( $title_text, $first_curly, $typed_sting_length + 1 );
    if ( $first_curly && $last_curly ) {
        $title = str_replace( $typed_words_full, '<mark><span class="typed"></span></mark>', $title_text );
    } else {
        $title = $title_text;
    }
    return nl2br($title);
}

/**
 * Typed Words
 */
function saasland_typed_words_js( $title_text ) {
    $first_curly = stripos( $title_text, '{' );
    $last_curly = strripos( $title_text, '}' );
    $typed_sting_length = $last_curly - $first_curly;
    $typed_words = substr( $title_text, $first_curly+1, $typed_sting_length-1 );
    if ( $first_curly && $last_curly ) :
        wp_enqueue_script( 'typed' );
        $typed_words = explode( ',', $typed_words );
        $typed_words_js = '';
        foreach ($typed_words as $typed_word) {
            $typed_words_js .= '"'.$typed_word.'",';
        }
        ?>
        <script>
            ;(function($) {
                "use strict";
                $(document).ready(function () {
                    var heading = $(".typed");
                    if (heading.length) {
                        heading.typed({
                            strings: [<?php echo $typed_words_js ?>],
                            // Optionally use an HTML element to grab strings from (must wrap each string in a <p>)
                            stringsElement: null,
                            typeSpeed: 100,
                            startDelay: 500,
                            backSpeed: 100,
                            backDelay: 500,
                            loop: true,
                            showCursor: true,
                            cursorChar: "|",
                            attr: null,
                            contentType: 'html',
                            callback: function () {
                            },
                            preStringTyped: function () {
                            },
                            onStringTyped: function () {
                            },
                            resetCallback: function () {
                            }
                        });
                    }
                });
            })(jQuery);
        </script>
    <?php
    else :
      //  wp_deregister_script( 'typed' );
        echo '';
    endif;
}

/**
 * Star Ratting
 */
function saasland_star_ratting( $ratting_var ) {
    if (!empty($ratting_var)) {
        for ($i = 1; $i <= 5; $i++) {
            if ($ratting_var >= $i) {
                echo '<a href="#" class="yellow_star"><i class="ti-star"></i></a>';
            } else {
                echo '<a href="#" class="gray_star"><i class="ti-star"></i></a>';
            }
        }
    }
}

// Product Title =====
function get_products_title() {

    $product = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids',
    );
    $product_post = get_posts($product);
    $product_array = array();
    $product_array[] = '';
    foreach ($product_post as $p_id) {
        $product_array[$p_id] = wp_trim_words( get_the_title( $p_id ), 5, '...');
    }
    return $product_array;

}

// Product Title =====
function saasland_get_post_title( $post_type ) {

    $saasland_posts = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids',
    );
    $saasland_posts = get_posts( $saasland_posts );
    $post_array = array();
    $post_array[] = '';
    foreach ($saasland_posts as $p_id) {
        $post_array[$p_id] = wp_trim_words( get_the_title( $p_id ), 5, '...');
    }
    return $post_array;

}

/*Lord Icon Animations -------------------------------------*/
function saasland_lord_icon_animation(){
    return [
        'none' => __('None', 'saasland-core'),
        'hover' => __('Hover', 'saasland-core'),
        'click' => __('Click', 'saasland-core'),
        'loop' => __('Loop', 'saasland-core'),
        'loop-on-hover' => __('Loop on hover', 'saasland-core'),
        'morph' => __('Morph', 'saasland-core'),
        'morph-two-way' => __('Morph Two Way', 'saasland-core'),
    ];
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

if(!function_exists('saasland_reviews')) {
    function saasland_reviews($review = 5) {
        switch($review) {
            case 1:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 1.5:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 2:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 2.5:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 3:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 3.5:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 4:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="far fa-star" aria-hidden="true"></i>';
                break;
            case 4.5:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                break;
            case 5:
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                echo '<i class="fas fa-star" aria-hidden="true"></i>';
                break;
        }
    }
}


/***
 * Elementor Title Tag
 */
function saasland_el_select_title_tag() {
    $tags = [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
        'p'  => 'P',
        'div' => 'DIV'
    ];
    return $tags;
}


/**
 * @param $data
 * @return mixed
 */
if ( !function_exists('saasland_core_return') ) {
    function saasland_core_return ($data) {
        return $data;
    }
}


/**
 * @param $settings
 * @param $settings_key
 * @return mixed
 * Get elementor thumbnail custom image size
 */
function saasland_get_el_custom_image_size($settings, $image_size_key, $image_key = '' ) {

    if ( has_post_thumbnail() ) {
        $settings[$image_key] = [
            'id' => get_the_post_thumbnail(),
        ];
    }
    $thumbnail_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, $image_size_key, $image_key );

    return saasland_core_return($thumbnail_html);
}


/**
 * Elementor slider range control
 * @return int[][]
 */
function saasland_el_slider_range() {

    $range = [
        'px' => [
            'min' => 0,
            'max' => 1000,
        ],
        '%' => [
            'min' => 0,
            'max' => 100,
        ],
    ];

    return $range;

}

function saasland_el_choose_alignment() {
    $choose_alignment = [
        'start' => [
            'title' => __( 'Left', 'saasland-core' ),
            'icon' => 'eicon-text-align-left',
        ],
        'center' => [
            'title' => __( 'Center', 'saasland-core' ),
            'icon' => 'eicon-text-align-center',
        ],
        'end' => [
            'title' => __( 'Right', 'saasland-core' ),
            'icon' => 'eicon-text-align-right',
        ],
    ];
    return $choose_alignment;
}


/**
 * Add new font group (Custom) to the top of the list
 */
add_filter( 'elementor/fonts/groups', function( $font_groups ) {
    $saasland_font_group = array( 'saasland_custom_font' => __( 'Custom Font' ) );
    return array_merge( $saasland_font_group, $font_groups );
} );

/**
 * Add fonts to the new font group
 */
add_filter( 'elementor/fonts/additional_fonts', function( $additional_fonts ) {
    /***
     * Param Font Name
     * Param Font Group Name
     */
    //Font name/font group
    $additional_fonts['cerebriSans'] = 'saasland_custom_font';
    $additional_fonts['Bagnard'] = 'saasland_custom_font';
    $additional_fonts['futuraPtB'] = 'saasland_custom_font';
    $additional_fonts['futuraPtD'] = 'saasland_custom_font';
    $additional_fonts['futura-pt'] = 'saasland_custom_font';
    $additional_fonts['GRIFTERB'] = 'saasland_custom_font';
    $additional_fonts['HelveticaLight'] = 'saasland_custom_font';
    $additional_fonts['ProximaNovaR'] = 'saasland_custom_font';
    $additional_fonts['ProximaNovaB'] = 'saasland_custom_font';
    $additional_fonts['ButlerM'] = 'saasland_custom_font';
    $additional_fonts['neue-haas-unica'] = 'saasland_custom_font';
    $additional_fonts['gibson'] = 'saasland_custom_font';
    $additional_fonts['neuzeit-grotesk'] = 'saasland_custom_font';
    $additional_fonts['Adobe Caslon Pro'] = 'saasland_custom_font';
    $additional_fonts['Figtree'] = 'saasland_custom_font';
    $additional_fonts['InstrumentSans'] = 'saasland_custom_font';
    return $additional_fonts;

} );



// Check custom font uploader is exist
/*if ( !class_exists('Bsf_Custom_Fonts_Taxonomy')) {
    return;
}

$fonts = Bsf_Custom_Fonts_Taxonomy::get_fonts();

add_filter('redux/saasland_opt/field/typography/custom_fonts', function ( $array ) {

    $custom = [];
    $font_list = [];
    $fonts = Bsf_Custom_Fonts_Taxonomy::get_fonts();

    if (!empty($fonts)) {
        foreach ($fonts as $key => $font) {
            $font_list[$key] = $key;
        }
    }

    if (!empty($font_list)) {
        $custom = array(
            "Custom fonts" => $font_list
        );
    }

    return $custom;

});*/

if ( !function_exists('saasland_custom_font_theme_settings')) {

	function saasland_custom_font_theme_settings() {
		$custom = [];
		$font_list = [];
		$fonts = Bsf_Custom_Fonts_Taxonomy::get_fonts();
		if ( !empty($fonts) ) {
			foreach ($fonts as $key => $font) {
				$font_list[$key] = $key;
			}
		}
		if (!empty($font_list)) {
			$custom = array(
				"Custom Font" => $font_list
			);
		}
		return $custom;
	}

}

add_filter('redux/saasland_opt/field/typography/custom_fonts', 'saasland_custom_font_theme_settings');
<?php

class Saasland_Core_Helper {

    /**
     * Hold an instance of Saasland_Core_Helper class.
     * @var Saasland_Core_Helper
     */
    protected static $instance = null;


    /**
     * Main Saasland_Core_Helper instance.
     * @return Saasland_Core_Helper - Main instance.
     */
    public static function instance() {

        if (null == self::$instance) {
            self::$instance = new Saasland_Core_Helper();
        }

        return self::$instance;

    }


    /**
     * Day links to archive page
     */
    public function the_day_link() {
        $archive_year   = get_the_time( 'Y' );
        $archive_month  = get_the_time( 'm' );
        $archive_day    = get_the_time( 'd' );
        echo get_day_link( $archive_year, $archive_month, $archive_day);
    }

    /**
     * Get the existing menus in array format
     * @return array
     */
    function get_menu_array() {
        $menus = wp_get_nav_menus();
        $menu_array = [];
        foreach ( $menus as $menu ) {
            $menu_array[$menu->slug] = $menu->name;
        }
        return $menu_array;
    }

    /**
     * Check if the url is external or nofollow
     * @param $settings_key
     * @param bool $is_echo
     * @return string|void
     */
    public function the_button( $settings_key, $is_echo = true ) {
        if ( $is_echo == true ) {
            echo !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
            echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
            echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
            if ( !empty($settings_key['custom_attributes']) ) {
                $attrs = explode(',', $settings_key['custom_attributes']);
                if(is_array($attrs)){
                    foreach($attrs as $data) {
                        $data_attrs = explode('|', $data);
                        echo esc_attr( $data_attrs[0].'='.$data_attrs[1] );
                    }
                }
            }
        }
    }

    /**
     * @param string  $content   Text content to filter.
     * @return string Filtered content containing only the allowed HTML.
     */
    public function kses_post($content) {
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


    /**
     * Category array
     * @param string $term
     * @return array
     */
    public function get_category_array( $term = 'category' ) {
        $cats = get_terms( array(
            'taxonomy' => $term,
            'hide_empty' => true
        ));
        $cat_array = [];

        if ( is_array( $cats ) ) {
            foreach ($cats as $cat) {
                $cat_array[$cat->slug] = $cat->name;
            }
        }

        return $cat_array;
    }


    /**
     * Get the first category name
     * @param string $term
     */
    public function get_first_category( $term = 'category' ) {
        $cats = get_the_terms(get_the_ID(), $term);
        $cat  = is_array($cats) ? $cats[0]->name : '';
        return esc_html($cat);
    }

    /**
     * Get the first category link
     * @param string $term
     */
    public function get_first_category_link( $term = 'category' ) {
        $cats = get_the_terms(get_the_ID(), $term);
        $cat  = is_array($cats) ? get_category_link($cats[0]->term_id) : '';
        return esc_url($cat);
    }


    /**
     * Get Reading Time
     */
    public function get_reading_time() {
        $content = get_post_field( 'post_content', get_the_ID() );
        $word_count = str_word_count( strip_tags( $content ) );
        $reading_time = ceil($word_count / 200);

        if ($reading_time == 1) {
            $timer = esc_html__( " minute read", 'saasland-core' );
        } else {
            $timer = esc_html__( " minutes read", 'saasland-core' );
        }

        $total_reading_time = $reading_time . $timer;

        return esc_html($total_reading_time);
    }

}



/**
 * Main instance of Saasland_helper.
 *
 * Returns the main instance of Saasland_helper to prevent the need to use globals.
 *
 * @return Saasland_Core_Helper
 */
function Saasland_Core_Helper() {
    return Saasland_Core_Helper::instance();
}

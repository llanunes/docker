<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package saasland
 */

$opt = get_option( 'saasland_opt' );

$copyright_year = date_i18n( 'Y' );
$copyright_text = !empty($opt['copyright_txt']) ? $opt['copyright_txt'] : '';

$right_content = isset($opt['right_content']) ? $opt['right_content'] : esc_html__( 'Made with in DroitThemes', 'saasland' );
$footer_visibility = function_exists( 'get_field' ) ? get_field( 'footer_visibility' ) : '1';
$footer_visibility = isset($footer_visibility) ? $footer_visibility : '1';
$is_footer_bottom = !empty($opt['is_footer_bottom']) ? $opt['is_footer_bottom'] : '';


// Is WooCommerce Popup
get_template_part('inc/woo/quick-view');

$footer_style = '';
if ( !empty($opt['footer_style']) ) {
    $footer_style = new WP_Query ( array (
        'post_type'       => 'footer',
        'posts_per_page'  => -1,
        'p'               => $opt['footer_style'],
    ));
}

if ( is_404() ) {
    ?>
    <footer>
        <div class="footer_bottom error_footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <p class="mb-0 f_400">
                            <?php if ( !empty($opt['is_auto_copyright_year'] == '1' )) : ?>
                                <span><?php esc_html_e('&copy; ', 'saasland'); echo esc_html($copyright_year) ?></span>
                            <?php endif; ?>
                            <?php echo saasland_kses_post($copyright_text); ?>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-6">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo saasland_kses_post(wpautop($right_content)) ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
}
else {
    if ( $footer_visibility == '1' ) {

        if ( !empty($footer_style) && class_exists( '\Elementor\Plugin' ) && !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            if ( $footer_style->have_posts() ) {
                while ( $footer_style->have_posts() ) : $footer_style->the_post();
                    the_content();
                endwhile;
                wp_reset_postdata();
            }
        } else {
            if ( is_active_sidebar( 'footer_widgets') && class_exists('redux') ) { ?>
                <footer class="new_footer_area">
                    <div class="new_footer_top">
                        <div class="container">
                            <div class="row">
                                <?php dynamic_sidebar( 'footer_widgets' ) ?>
                            </div>
                        </div>
                        <?php if ( $is_footer_bottom == '1' ) : ?>
                            <div class="footer_bg">
                                <?php if (!empty($opt['footer_obj_1']['url'])) : ?>
                                    <div class="footer_bg_one"></div>
                                <?php endif; ?>
                                <?php if (!empty($opt['footer_obj_2']['url'])) : ?>
                                    <div class="footer_bg_two"></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    if ( $is_footer_bottom == '1' ) { ?>
                        <div class="footer_bottom">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-sm-7">
                                        <p>
                                            <?php if ( !empty($opt['is_auto_copyright_year'] == '1' )) : ?>
                                                <span><?php esc_html_e('&copy; ', 'saasland'); echo esc_html($copyright_year) ?></span>
                                            <?php endif; ?>
                                            <?php echo saasland_kses_post($copyright_text); ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-sm-5 text-right">
                                        <?php echo saasland_kses_post(wpautop($right_content)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </footer>
                <?php
            } else {
                ?>
                <footer class="bg_color">
                    <div class="footer_bottom">
                        <div class="container">
                            <div class="text-center">
                                <?php printf(esc_html__('%s Droitthemes All rights reserved.', 'saasland' ), $copyright_year); ?>
                            </div>
                        </div>
                    </div>
                </footer>
                <?php
            }
        }
    }
    else{
        $specific_footer_id = function_exists( 'get_field' ) ? get_field( 'select_footer_style' ) : '';
        if( !empty( $specific_footer_id ) ) {
            $specific_footer = new WP_Query (array(
                'post_type' => 'footer',
                'posts_per_page' => -1,
                'p' => $specific_footer_id,
            ));

            if ( $specific_footer->have_posts() ) {
                while ( $specific_footer->have_posts() ) : $specific_footer->the_post();
                    the_content();
                endwhile;
                wp_reset_postdata();
            }
        }
    }
}

// Is search form
get_template_part('template-parts/header_elements/search-form');


?>
</div> <!-- Body Wrapper -->
<?php wp_footer(); ?>
</body>
</html>
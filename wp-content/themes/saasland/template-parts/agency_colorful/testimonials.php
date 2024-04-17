<?php
$title_sec = function_exists( 'get_sub_field' ) ? get_sub_field( 'title_section' ) : '';
$featured_img = function_exists( 'get_sub_field' ) ? get_sub_field( 'testimonials_featured_images' ) : '';
$floating_img = function_exists( 'get_sub_field' ) ? get_sub_field( 'floating_images' ) : '';
$testimonials = function_exists( 'get_sub_field' ) ? get_sub_field( 'testimonials_list' ) : '';

$style_tabs = function_exists( 'get_sub_field' ) ? get_sub_field('style_tabs' ) : '';
$layout = !empty($style_tabs['layout']) ? $style_tabs['layout'] : 'container-fluid';
$title_font_size = !empty($style_tabs['layout']) ? $style_tabs['layout'] : 'container';

switch ($layout) {
    case 'container':
        $container = 'container';
        break;
    case 'container-fluid':
        $container = 'container-fluid';
        break;
    default:
        $container = 'container';
        break;
}
?>

<div class="scroll-wrap">
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php
    if ( !empty($floating_img['image_one']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array( 'class' => 'p_absoulte pp_triangle') );
    }
    if ( !empty($floating_img['image_two']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array( 'class' => 'p_absoulte pp_block') );
    }
    ?>
    <div class="p-section-bg"></div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="<?php echo esc_attr($container) ?>">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="section_one_img">
                            <div class="round p_absoulte"></div>
                            <?php
                            if ( !empty($featured_img['featured_image']['id']) ) {
                                echo wp_get_attachment_image( $featured_img['featured_image']['id'], 'full' );
                            }
                            if ( !empty($featured_img['another_featured_image']['id']) ) {
                                echo wp_get_attachment_image( $featured_img['another_featured_image']['id'], 'full', '', array( 'class' => 'p_absoulte phon_img' ) );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 col-sm-12">
                        <div class="pp_testimonial_info">
                            <div class="hosting_title pp_sec_title">
                                <?php
                                if ( !empty( $title_sec['upper_title'] ) ) { ?>
                                    <h3><?php echo esc_html( $title_sec['upper_title'] ) ?></h3>
                                    <?php
                                }
                                if ( !empty( $title_sec['title'] ) ) { ?>
                                    <h2 class="text-white"><?php echo esc_html( $title_sec['title'] ) ?></h2>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="pp_testimonial_slider">
                                <?php
                                if ( !empty( $testimonials ) ) {
                                    foreach ( $testimonials as  $testimonial ) {
                                        ?>
                                        <div class="item">
                                            <div class="media d-flex">
                                                <div class="img flex-shrink-0">
                                                    <?php echo wp_get_attachment_image( $testimonial['author_image']['id'], 'full' ); ?>
                                                </div>
                                                <div class="media-body">
                                                    <?php echo !empty( $testimonial['contents'] ) ? '<h4>' . esc_html($testimonial['contents']) . '</h4>' : ''; ?>
                                                    <div class="author_ratting">
                                                        <?php echo !empty( $testimonial['author_name'] ) ? '<h5>' . esc_html($testimonial['author_name']) . '</h5>' : ''; ?>
                                                        <div class="rating">
                                                            <?php
                                                            switch ( $testimonial['star_ratting'] ) {
                                                            case '1': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '1.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '2': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '2.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '3': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '3.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '4': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star_alt"></i>
                                                            <?php break;
                                                            case '4.5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star-half_alt"></i>
                                                            <?php break;
                                                            case '5': ?>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                                <i class="icon_star"></i>
                                                            <?php break;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="slider_nav">
                                <i class="arrow_left prev"></i>
                                <i class="arrow_right next"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
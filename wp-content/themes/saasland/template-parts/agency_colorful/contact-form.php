<?php
$title_sec = function_exists( 'get_sub_field' ) ? get_sub_field( 'title_section' ) : '';
$informations = function_exists( 'get_sub_field' ) ? get_sub_field( 'informations' ) : '';
$floating_img = function_exists( 'get_sub_field' ) ? get_sub_field( 'floating_images' ) : '';
$shortcode = function_exists( 'get_sub_field' ) ? get_sub_field( 'shortcode' ) : '';

$style_tabs = function_exists( 'get_sub_field' ) ? get_sub_field('style_tabs' ) : '';
$layout = !empty($style_tabs['layout']) ? $style_tabs['layout'] : 'container';
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
    if ( !empty($floating_img['image_one']['url'] )) { ?>
        <img class="p_absoulte pp_triangle t_left" src="<?php echo esc_url($floating_img['image_one']['url']); ?>" alt="<?php echo esc_attr($title_sec['title']) ?>">
        <?php
    }
    if ( !empty($floating_img['image_two']['url']) ) { ?>
        <img class="p_absoulte pp_block" src="<?php echo esc_url($floating_img['image_two']['url']); ?>" alt="<?php echo esc_attr($title_sec['title']) ?>">
        <?php
    }
    ?>
    <div class="p-section-bg"></div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="<?php echo esc_attr($container) ?>">
                <div class="hosting_title pp_sec_title">
                    <?php
                    if ( !empty( $title_sec['upper_title'] ) ) { ?>
                        <h3><?php echo esc_html( $title_sec['upper_title'] ) ?></h3>
                        <?php
                    }
                    if ( !empty( $title_sec['title'] ) ) { ?>
                        <h2 class="text-white"> <?php echo esc_html( $title_sec['title'] ) ?> </h2>
                        <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="pp_contact_info">
                            <?php
                            if ( !empty( $informations ) ) {
                                foreach ( $informations as  $information ) {
                                    ?>
                                    <div class="media pp_contact_item d-flex">
                                        <?php if (!empty( $information['icon'] ) ) : ?>
                                            <div class="icon">
                                                <i class="<?php echo esc_attr( $information['icon'] ) ?>"></i>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ( $information['info'] ) : ?>
                                            <div class="mmedia-body">
                                                <?php echo wp_kses_post( $information['info'] ) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php if ( !empty($shortcode) ) : ?>
                        <div class="col-lg-7">
                            <?php echo do_shortcode($shortcode) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$title = function_exists('get_sub_field') ? get_sub_field( 'title' ) : '';
$featured_img = function_exists('get_sub_field') ? get_sub_field( 'featured_images' ) : '';
$floating_img = function_exists('get_sub_field') ? get_sub_field( 'floating_images' ) : '';
$bg_img = function_exists('get_sub_field') ? get_sub_field( 'background_image' ) : '';
$btn = function_exists('get_sub_field') ? get_sub_field( 'button' ) : '';
$btn_target = !empty($btn['target']) ? $btn['target'] : '_self';

// Background properties
$background_image = get_sub_field( 'background_image' );
$background_image = !empty($bg_img['url']) ? "style=background-image:url({$bg_img['url']});" : '';

$style_tabs = function_exists( 'get_sub_field' ) ? get_sub_field('style_tabs' ) : '';
$layout = !empty($style_tabs['layout']) ? $style_tabs['layout'] : 'container-fluid';
$title_font_size = !empty($style_tabs['layout']) ? $style_tabs['layout'] : 'container-fluid';

switch ($layout) {
    case 'container':
        $container = 'container';
        break;
    case 'container-fluid':
        $container = 'container-fluid';
        break;
    default:
        $container = 'container-fluid';
        break;
}

?>

<div class="scroll-wrap">
    <div class="round_line one"></div>
    <div class="round_line two"></div>
    <div class="round_line three"></div>
    <div class="round_line four"></div>
    <?php
    if ( !empty($floating_img['image_one']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array('class' => 'p_absoulte pp_triangle') );
    }
    if ( !empty($floating_img['image_two']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array('class' => 'p_absoulte pp_snak') );
    }
    if ( !empty($floating_img['image_three']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_three']['id'], 'full', '', array('class' => 'p_absoulte pp_block') );
    }
    ?>
    <div class="p-section-bg"></div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="<?php echo esc_attr($container) ?>">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="section_one_img">
                            <div class="round"></div>
                            <?php
                            if ( !empty($featured_img['featured_image']['id']) ) {
                                echo wp_get_attachment_image( $featured_img['featured_image']['id'], 'full' );
                            }
                            if ( !empty($featured_img['featured_image_two']['id']) ) {
                                echo wp_get_attachment_image( $featured_img['featured_image_two']['id'], 'full', '', array( 'class' => 'dots' ) );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="section_one-content">
                            <?php
                            if ( !empty( $title ) ) { ?>
                                <h2><?php echo wp_kses_post(nl2br($title)) ?></h2>
                                <?php
                            }
                            if ( !empty($btn['title'] )) { ?>
                                <a href="<?php echo esc_url($btn['url']) ?>" class="btn_scroll btn_hover" target="<?php echo esc_attr($btn_target) ?>">
                                    <?php echo esc_html( $btn['title'] ); ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
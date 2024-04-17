<?php
$contents = function_exists( 'get_sub_field' ) ? get_sub_field( 'contents' ) : '';
$galleries = function_exists( 'get_sub_field' ) ? get_sub_field( 'featured_image_gallery' ) : '';
$floating_img = function_exists( 'get_sub_field' ) ? get_sub_field( 'floating_images' ) : '';
$btn = function_exists('get_sub_field') ? get_sub_field( 'button' ) : '';
$btn_target = !empty($btn['target']) ? $btn['target'] : '_self';

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
    if ( !empty($floating_img['image_one']['id']) ){
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array( 'class' => 'p_absoulte pp_triangle t_left' ) );
    }
    if ( !empty($floating_img['image_two']['id']) ){
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array( 'class' => 'p_absoulte pp_block' ) );
    }
    ?>
    <div class="p-section-bg"></div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="<?php echo esc_attr($container) ?>">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="pp_work_content">
                            <div class="hosting_title pp_sec_title">
                                <?php
                                if ( !empty($contents['upper_title']) ) { ?>
                                    <h3><?php echo esc_html($contents['upper_title']) ?></h3>
                                    <?php
                                }
                                if ( !empty($contents['title']) ) { ?>
                                    <h2 class="text-white"><?php echo esc_html($contents['title']) ?></h2>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php echo !empty( $contents['subtitle']) ? wpautop ($contents['subtitle'] ) : ''; ?>
                            <?php if ( !empty($btn['title']) ) : ?>
                                <a href="<?php echo esc_url($btn['url']) ?>" class="btn_scroll btn_hover" target="<?php echo esc_attr($btn_target) ?>">
                                    <?php echo esc_html( $btn['title'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="pp_mackbook_img">
                            <div class="round"></div>
                            <?php
                            if ( !empty( $galleries ) ) {
                                foreach ( $galleries as $index => $gallery ) {
                                    switch ($index) {
                                        case 0:
                                            $align_class = 'one';
                                            break;
                                        case 1:
                                            $align_class = 'two';
                                            break;
                                        case 2:
                                            $align_class = 'three';
                                            break;
                                        case 3:
                                            $align_class = 'four';
                                            break;
                                        default:
                                            $align_class = 'one';
                                            break;
                                    }
                                    ?>
                                    <img class="p_absoulte <?php echo esc_attr($align_class) ?>" src="<?php echo esc_url($gallery['url']); ?>" alt="<?php echo esc_attr($contents['title']) ?>">
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
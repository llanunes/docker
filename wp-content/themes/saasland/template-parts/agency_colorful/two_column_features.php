<?php
$title_sec = function_exists( 'get_sub_field' ) ? get_sub_field( 'title_section' ) : '';
$features = function_exists( 'get_sub_field' ) ? get_sub_field( 'features_list' ) : '';
$floating_img = function_exists( 'get_sub_field' ) ? get_sub_field( 'floating_images' ) : '';
$featured_images = function_exists( 'get_sub_field' ) ? get_sub_field( 'featured_images_sec' ) : '';

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
    if ( !empty($floating_img['image_one']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_one']['id'], 'full', '', array( 'class' => 'p_absoulte pp_triangle t_left' ) );
    }
    if ( !empty($floating_img['image_two']['id']) ) {
        echo wp_get_attachment_image( $floating_img['image_two']['id'], 'full', '', array( 'class' => 'p_absoulte pp_block' ) );
    }
    ?>
    <div class="p-section-bg"></div>
    <div class="scrollable-content">
        <div class="vertical-centred">
            <div class="<?php echo esc_attr($container) ?>">
                <div class="row flex-row-reverse">
                    <div class="col-lg-4">
                        <div class="section_one_img">
                            <div class="round p_absoulte"></div>
                            <?php
                            if ( !empty($featured_images['featured_image_one']['id']) ) {
                                echo wp_get_attachment_image( $featured_images['featured_image_one']['id'], 'full' );
                            }
                            if ( !empty($featured_images['featured_image_two']['id']) ) {
                                echo wp_get_attachment_image( $featured_images['featured_image_two']['id'], 'full', '', array( 'class' => 'p_absoulte dots') );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="pp_features_info">
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
                            <div class="row">
                                <?php
                                if ( !empty( $features ) ) {
                                    foreach ( $features as  $feature ) {
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="pp_features_item">
                                                <?php if ( !empty( $feature['icon_image']['id'] ) ) : ?>
                                                    <div class="icon">
                                                        <?php echo wp_get_attachment_image( $feature['icon_image']['id'], 'full' ); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php
                                                 echo !empty( $feature['title'] ) ? '<h4>' . esc_html($feature['title']) . '</h4>' : '';
                                                 echo !empty( $feature['subtitle'] ) ? wpautop($feature['subtitle']) : '';
                                                 ?>
                                            </div>
                                        </div>
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
</div>
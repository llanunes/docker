<?php
wp_enqueue_style( 'saasland-demo' );
?>
<section class="banner_area d-flex align-items-center apps_craft_animation">
    <div class="image_mockup">
        <?php
        if ( !empty($settings['demo_feature_images']) ) {
            foreach ( $settings['demo_feature_images'] as $index => $feature_image ) {
                switch ( $index ) {
                    case 0:
                        $align_class = 'slideInnew';
                        break;
                    case 7:
                        $align_class = 'zoomIn';
                        break;
                    default:
                        $align_class = 'slideInnew';
                        break;
                }
                ?>
                <div class="demo_lan_feature_image wow <?php echo esc_attr($align_class) ?> elementor-repeater-item-<?php echo esc_attr($feature_image['_id']) ?>" data-wow-delay="<?php echo esc_attr($feature_image['df_delay']) ?>s">
                    <div class="layer layer2" data-depth="<?php echo esc_attr($feature_image['df_depth']) ?>">
                        <?php echo wp_get_attachment_image($feature_image['df_image']['id'], 'full') ?>
                    </div>
                </div>
                <?php
            }
        }

        if ( !empty( $settings['demo_shape1']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": 0, "y": 100, "rotateZ":0}'>
                <img class="faa-spin animated" src="<?php echo esc_url($settings['demo_shape1']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape2']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": -180, "y": 80, "rotateY":2000}'>
                <img src="<?php echo esc_url($settings['demo_shape2']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape3']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": 250, "y": 160, "rotateZ":500}'>
                <img src="<?php echo esc_url($settings['demo_shape3']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape4']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": 20, "y": -100, "rotateZ":0}'>
                <img src="<?php echo esc_url($settings['demo_shape4']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape5']['url'] ) ) : ?>
            <div class="one_img">
                <img src="<?php echo esc_url($settings['demo_shape5']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape6']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": 0, "y": 100, "rotateZ":0}'>
                <img src="<?php echo esc_url($settings['demo_shape6']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape7']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": 250, "y": 360, "rotateZ":500}'>
                <img src="<?php echo esc_url($settings['demo_shape7']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape8']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": -180, "y": 80, "rotateY":2000}'>
                <img src="<?php echo esc_url( $settings['demo_shape8']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif;
        if ( !empty( $settings['demo_shape9']['url'] ) ) : ?>
            <div class="one_img" data-parallax='{"x": -10, "y": 80, "rotateY":0}'>
                <img src="<?php echo esc_url( $settings['demo_shape9']['url']) ?>" alt="<?php echo esc_attr( $settings['title'] ) ?>">
            </div>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="banner_text">
                    <?php
                    echo !empty( $settings['title'] ) ? "<$title_tag class='typewrite_title wow fadeInUp' data-wow-delay='0.2s'>" . saasland_hero_title($settings['title']) . "</$title_tag>" : '';
                    echo !empty( $settings['subtitle'] ) ? '<p class="wow fadeInUp" data-wow-delay="0.4s">' . esc_html( $settings['subtitle'] ) . '</p>' : '';
                    if ( !empty( $settings['buttons'] ) ) {
                    foreach ( $settings['buttons'] as $button ) {
                        if ( !empty($button['btn_title'] )) : ?>
                            <a <?php saasland_el_btn($button['btn_url']) ?> class="dmeo_banner_btn wow fadeInUp scrolls elementor-repeater-item-<?php echo esc_attr($button['_id']) ?>" data-wow-delay="0.6s">
                                <?php echo esc_html( $button['btn_title'] ) ?>
                            </a>
                        <?php
                        endif;
                    }}
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if ( $settings['is_parallax_f_images'] == 'yes' ) {
    wp_enqueue_script('parallax');
}
saasland_typed_words_js( $settings['title'] );
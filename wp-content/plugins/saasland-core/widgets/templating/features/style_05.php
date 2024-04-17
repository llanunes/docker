<section class="hosting_service_area sec_pad">
    <?php if ( !empty( $settings['pattern_shape_img'] ) ) : ?>
        <div data-parallax='{"x": 0, "y": 100}'>
            <div class="pattern_shap" style="background: url(<?php echo esc_url($settings['pattern_shape_img']['url']) ?>);"></div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="hosting_title text-center">
            <<?php echo $title_tag ?> class="sl_color_s wow fadeInUp" data-wow-delay="0.3s">
            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
        </<?php echo $title_tag ?>>
    </div>
    <div class="row pos_service_info">
        <?php
        if ( !empty($features4 ) ) {
            foreach ( $features4 as $feature ) {
                ?>
                <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                    <div class="hosting_service_item">
                        <?php echo wp_get_attachment_image( $feature['f_img']['id'], 'full' ); ?>
                        <?php if (!empty($feature['title'])) : ?>
                            <?php if ( !empty($feature['link_url']['url']) ) : ?> <a <?php saasland_el_btn($feature['link_url']) ?>> <?php endif; ?>
                            <<?php echo $feature_item_title_tag ?> class="h_head"><?php echo esc_html($feature['title']) ?></<?php echo $feature_item_title_tag ?>>
                            <?php if ( !empty($feature['link_url']['url']) ) : ?> </a> <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( !empty($feature['subtitle']) ) : ?>
                            <?php echo wp_kses_post(wpautop($feature['subtitle'])) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }}
        ?>
    </div>
    </div>
</section>
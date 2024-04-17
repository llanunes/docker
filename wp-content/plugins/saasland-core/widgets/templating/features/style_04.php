<section class="hosting_service_area sec_pad">
    <div class="container">
        <div class="hosting_title text-center">
            <?php if (!empty($settings['title'])) : ?>
            <<?php echo $title_tag ?> class="sl_color_s wow fadeInUp" data-wow-delay="0.3s">
            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
        </<?php echo $title_tag ?>>
        <?php endif; ?>
        <?php if (!empty($settings['subtitle'])) : ?>
            <p class="wow fadeInUp" data-wow-delay="0.5s">
                <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="row">
            <?php
            if (!empty( $features4 )) {
                foreach ( $features4 as $feature ) {
                    ?>
                    <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                        <div class="hosting_service_item">
                            <div class="icon">
                                <?php echo wp_get_attachment_image( $feature['f_img']['id'], 'full' ); ?>
                            </div>
                            <?php if (!empty($feature['title'])) : ?>
                                <?php if ( !empty($feature['link_url']['url']) ) : ?> <a href="<?php echo esc_url($feature['link_url']['url']); ?>"> <?php endif; ?>
                                <<?php echo $feature_item_title_tag ?> class="h_head"> <?php echo esc_html($feature['title']) ?> </<?php echo $feature_item_title_tag; ?>>
                                <?php if ( !empty($feature['link_url']['url']) ) : ?> </a> <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($feature['subtitle'])) : ?>
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
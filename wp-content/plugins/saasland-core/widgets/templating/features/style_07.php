<section class="home_features_area">
    <div class="h_features_left"></div>
    <div class="h_features_right">
        <div class="h_features_right_title">
            <div class="sec_title">
                <?php echo !empty($settings['title']) ? sprintf( '<%1$s class="title" data-animation="wow fadeIn" data-splitting> %2$s </%1$s>', $title_tag, nl2br($settings['title']) ) : ''; ?>
            </div>
            <div class="custome_nav">
                <button class="prev"><i class="icon-arrow-left"></i></button>
                <button class="next"><i class="icon-arrow-right"></i></button>
            </div>
        </div>
        <div class="home_features_slider">
            <?php
            if ( !empty($features4) ) {
                foreach ( $features4 as $fe ) {
                ?>
                <div class="item elementor-repeater-item-<?php echo esc_attr($fe['_id']) ?>">
                    <div class="agency_features_item">
                        <?php echo wp_get_attachment_image( $fe['f_img']['id'], 'full' ); ?>
                        <?php if (!empty($fe['title'])) : ?>
                            <h3 class="feature-title"> <?php echo esc_html($fe['title']) ?> </h3>
                        <?php endif; ?>
                        <?php echo !empty($fe['subtitle']) ? wp_kses_post(wpautop($fe['subtitle'])) : ''; ?>
                    </div>
                </div>
                <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<section class="corporate_banner_area education_banner_area parallaxie d-flex align-items-center">
    <div class="overlay_bg"></div>
    <div class="triangle_img" style="background: linear-gradient(0deg, <?php echo $settings['triangle_overlay_color'] ?>, <?php echo $settings['triangle_overlay_color'] ?>), url(<?php echo esc_url($settings['triangle_image']['url']) ?>) no-repeat scroll right 0/cover;"></div>
    <div class="container">
        <div class="corporate_banner_text">
            <?php echo !empty($settings['title']) ? sprintf( '<%1$s class="title wow fadeInUp" data-splitting> %2$s </%1$s>', $title_tag, nl2br($settings['title']) ) : ''; ?>
            <?php if ( !empty($settings['subtitle']) ) : ?>
                <p class="wow fadeInUp" data-wow-delay="0.4s" data-animation-duration="0.7s">
                    <?php echo Saasland_Core_Helper()->kses_post(nl2br($settings['subtitle'])) ?>
                </p>
            <?php endif; ?>
            <div class="d-flex align-items-center">
                <?php foreach( $buttons as $button ): ?>
                    <?php if ( !empty($button['btn_title']) ) : ?>
                        <a <?php echo esc_url($button['btn_url']['url']) ?> class="education_learn_btn elementor-repeater-item-<?php echo esc_attr(  $button['_id']); ?>">
                            <?php echo esc_html($button['btn_title']) ?><i class="icon-arrow-double"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
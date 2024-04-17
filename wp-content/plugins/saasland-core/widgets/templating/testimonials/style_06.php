<section class="h_testimonial_area rave-testimonial">
    <div class="pattern_bg"></div>
    <div class="container">
        <div class="h_testimonial_slider_inner">
            <div class="h_testimonial_thumb">
                <?php
                if ( $testimonials ) {
                    foreach ( $testimonials as $testimonial ) {
                        ?>
                        <div class="item">
                            <div class="item_img wow zoomIn">
                                <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'full') ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="h_testimonial_slider" data-slick="<?php echo esc_attr(wp_json_encode($slick_default_settings)) ?>">
                <?php
                if ( $testimonials ) {
                    foreach ( $testimonials as $testimonial ) {
                        ?>
                        <div class="item">
                            <?php echo !empty($settings['title']) ? sprintf( '<%1$s class="a_title"> %2$s </%1$s>', $title_tag, nl2br($settings['title']) ) : ''; ?>
                            <?php echo !empty($testimonial['content']) ? "<h2 class='content'>{$testimonial['content']}</h2>" : ''; ?>
                            <div class="testimonial_author">
                                <?php echo !empty($testimonial['name']) ? "<h6 class='name'>{$testimonial['name']}</h6>" : ''; ?>
                                <?php if ( !empty($testimonial['designation']) ) : ?>
                                    <div class="position designation"><?php echo esc_html($testimonial['designation']) ?> </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="feedback_area_three bg_color sec_pad">
    <div class="container">
        <div class="sec_title mb_70 wow fadeInUp" data-wow-delay="0.4s">
            <?php if (!empty($settings['title'])) : ?>
                <h2 class="f_p f_size_40 l_height50 f_500 t_color"><?php echo wp_kses_post(nl2br($settings['title'])) ?></h2>
            <?php endif; ?>
        </div>
        <div class="row">
            <div  class="feedback_slider_two owl-carousel">
                <?php
                foreach ( $testimonials as $testimonial ) {
                    ?>
                    <div class="item">
                        <div class="feedback_item">
                            <div class="feed_back_author">
                                <div class="media d-flex">
                                    <div class="img">
                                        <?php echo wp_get_attachment_image($testimonial['author_image']['id'], 'saasland_83x88' ) ?>
                                    </div>
                                    <div class="media-body">
                                        <?php echo (!empty($testimonial['name'])) ? '<h5 class="t_color f_size_15 f_p f_500">'.$testimonial['name'].'</h5>' : ''; ?>
                                        <?php echo (!empty($testimonial['designation'])) ? '<h6 class="f_p f_400">'.$testimonial['designation'].'</h6>' : ''; ?>
                                    </div>
                                </div>
                                <div class="ratting">
                                    <?php saasland_star_ratting($testimonial['ratting']); ?>
                                </div>
                            </div>
                            <p class="f_size_16"><?php echo wp_kses_post($testimonial['content']) ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

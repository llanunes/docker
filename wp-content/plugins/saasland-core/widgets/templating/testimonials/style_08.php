<div class="app_testimonial_inner">
    <div class="app_testimonial_slider-8 text-center">
        <?php
        if ( $testimonials ) {
            foreach ( $testimonials as $testimonial ) {
                ?>
                <div class="item elementor-repeater-item-<?php echo esc_attr($testimonial['_id']) ?>">
                    <ul class="list-unstyled">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <?php
                    if ( !empty($testimonial['testimonial_image']['id']) ) { ?>
                        <div class="author_img">
                            <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'full') ?>
                        </div>
                        <?php
                    }
                    if ( !empty($testimonial['content'] )) { ?>
                        <h3 class="content"><?php echo esc_html($testimonial['content']) ?></h3>
                        <?php
                    }
                    if ( !empty($testimonial['name'] )) { ?>
                        <div class="name"><?php echo esc_html($testimonial['name']) ?></div>
                        <?php
                    }
                    if ( !empty($testimonial['designation'] )) { ?>
                        <div class="position"><?php echo esc_html($testimonial['designation']) ?></div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="slider_arrow">
        <button class="prev"><i class="icon-arrow-left"></i></button>
        <button class="next"><i class="icon-arrow-right"></i></button>
    </div>
</div>
<div class="photography_testimonial_slider rave-testimonial">
    <?php
    if ( is_array($testimonials3)) {
        foreach ( $testimonials3 as $testimonial ) {
            ?>
            <div class="item">
                <?php
                if ( !empty($testimonial['content']) ) { ?>
                    <?php echo wp_kses_post($testimonial['content']); ?>
                    <?php
                }
                if ( !empty($testimonial['name']) ) { ?>
                    <h6>
                        <span class="name"><?php echo esc_html($testimonial['name']); ?></span>
                        <span class="position"><?php echo esc_html($testimonial['designation']); ?></span>
                    </h6>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
</div>

<div class="custome_nav">
    <div class="prev slick-arrow"><i class="icon-arrow-up"></i></div>
    <div class="next slick-arrow"><i class="icon-arrow-down"></i></div>
</div>
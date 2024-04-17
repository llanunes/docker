<div class="const_testimonial_info rave-testimonial">
    <div class="const_testimonial_slider">
        <?php
        if ( $testimonials ) {
            foreach ( $testimonials as $testimonial ) {
                ?>
                <div class="item">
                    <?php echo !empty($testimonial['content']) ? "<h3 class='content'>{$testimonial['content']}</h3>" : ''; ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="const_testimonial_thumbnil">
        <?php
        if ( $testimonials ) {
            foreach ( $testimonials as $testimonial ) {
                ?>
                <div class="item">
                    <div class="round_img">
                        <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'full') ?>
                    </div>
                    <div class="content">
                        <?php echo !empty($testimonial['name']) ? "<h4 class='name'>{$testimonial['name']}</h4>" : ''; ?>
                        <?php echo !empty($testimonial['designation']) ? "<h6 class='position'>{$testimonial['designation']}</h6>" : ''; ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="const_slider_arrow">
        <button class="prev"><i class="icon-arrow-left"></i></button>
        <button class="next"><i class="icon-arrow-right-3"></i></button>
    </div>
</div>
<?php
while ( $blog_post->have_posts() ) : $blog_post->the_post(); ?>
    <div class="arch_blog_item wow fadeInUp" data-wow-delay="<?php echo esc_attr( $data_wow_delay) ?>s">
        <div class="arch_post_date">
            <h3>
                <?php the_time('d'); ?>
                <span><?php the_time('F, Y'); ?></span>
            </h3>
        </div>
        <div class="post_content">
            <a href="<?php the_permalink(); ?>">
                <?php the_title('<h3>', '</h3>') ?>
            </a>
        </div>
        <?php if ( $btn_title ) : ?>
            <div class="arch_blog_btn">
                <a href="<?php the_permalink(); ?>" class="rave_btn rave_btn_effect" data-text="<?php echo esc_attr($btn_title) ?>">
                    <?php echo esc_html( $btn_title ) ?>
                    <i class="icon-arrow-right-2"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php
endwhile;
wp_reset_postdata();
?>
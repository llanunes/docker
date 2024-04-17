<div class="education_program_gallery_info">
    <?php
    while ( $blog_post->have_posts() ) : $blog_post->the_post();
        ?>
        <div class="program_gallery_item">
            <?php the_post_thumbnail('full'); ?>
            <div class="overlay_bg"></div>
            <div class="content">
                <a href="<?php the_permalink(); ?>">
                    <h5><?php the_title() ?></h5>
                </a>
                <a href="<?php the_permalink(); ?>" class="education_learn_btn">
                    <?php echo esc_html($btn_title); ?><i class="icon-arrow-double"></i>
                </a>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
    ?>
</div>
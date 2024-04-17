<div class="home_news_list_inner">
    <?php
    $delay_time = 0.0;
    while ( $blog_post->have_posts() ) : $blog_post->the_post();
        ?>
        <div class="home_news_list_item wow fadeInDown" data-wow-delay="<?php echo esc_attr($delay_time) ?>s">
            <div class="news_post_img">
                <?php the_post_thumbnail('saasland_170x120'); ?>
                <div class="news_post_date">
                    <?php the_time('D') ?>
                    <span><?php the_time('m Y'); ?></span>
                </div>
            </div>
            <div class="media-body">
                <div class="text">
                    <a href="<?php echo Saasland_Core_Helper()->get_first_category_link() ?>" class="news_tag">
                        <?php echo Saasland_Core_Helper()->get_first_category() ?>
                    </a>
                    <a href="<?php the_permalink(); ?>">
                        <h3> <?php the_title() ?> </h3>
                    </a>
                </div>
                <div class="news_btn">
                    <span><?php echo Saasland_Core_Helper()->get_reading_time(); ?></span>
                    <?php if ( !empty($btn_title) ) : ?>
                        <a href="<?php the_permalink(); ?>" class="agency_learn_btn h_text_btn" data-text="<?php echo esc_html($btn_title) ?>">
                            <?php echo esc_html($btn_title) ?> <i class="ti-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
    ?>
</div>
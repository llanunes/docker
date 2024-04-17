<div class="simple-portfolio-wrapper saasland-d-grid">
    <?php
    foreach ($get_portfolios as $list) {
        ?>
        <div class="portfolio">
            <div class="portfolio-img">
                <a href="<?php echo esc_url(get_the_permalink($list->ID)); ?>">
                    <?php

                    echo wp_get_attachment_image(get_post_thumbnail_id($list->ID), 'saasland_470x520');
                    ?>
                </a>
                <div class="portfolio-title">
                    <div class="portfolio-meta">
                        <?php $get_cats = wp_get_object_terms($list->ID, 'portfolio_cat');
                        if(is_array($get_cats) && !empty($get_cats)) :
                            foreach ($get_cats as $cat) {
                                ?>
                                <span># <?php echo esc_html($cat->name); ?></span>
                                <?php
                            }
                        endif;
                        ?>
                    </div>
                    <h3><?php  echo get_the_title($list->ID); ?></h3>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
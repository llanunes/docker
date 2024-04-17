<section class="const_projects_area">
    <div class="row" id="const_masonry">
        <?php
        $grid_metro_layout = ($settings['grid_metro_layout']) ?? [];
        $i = 0;
        while ( $portfolios->have_posts() ) : $portfolios->the_post();
            $image_size = ($grid_metro_layout[$i]['size']) ?? 'col-lg-4 col-md-6';
            ?>
            <div class="<?php echo esc_attr($image_size) ?> const_projects_col">
                <div class="cons_projects_item">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'full' ); ?>
                    </a>
                    <div class="content">
                        <h3><?php the_title() ?></h3>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo esc_html( $settings['read_more_btn'] ) ?>
                            <i class="icon-arrow-right-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</section>
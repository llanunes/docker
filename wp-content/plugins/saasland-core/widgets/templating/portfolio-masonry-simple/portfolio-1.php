<section class="h_work_area_portfolio_masonry">
    <div class="row align-items-center agency_team_inner">
        <?php
        $i = 1;
        while ( $portfolios->have_posts() ) : $portfolios->the_post();
            $column = $i == 1 ? 'col-lg-7 col-md-7 col-sm-12' : 'col-lg-4 offset-lg-1 col-md-5 col-sm-12';
            $image_size = $i == 1 ? 'saasland_670x670' : 'saasland_370x370';
            ?>
            <div class="<?php echo esc_attr($column) ?> wow fadeInDown" data-wow-delay="0.4">
                <div class="work_item<?php echo ($i == 2) ? ' work_item_top' : ''; ?>" data-parallax='{"x": 0, "y": <?php echo ($i == 1) ? '40' : ' -40'; ?>}'>
                    <a href="<?php the_permalink(); ?>" class="p_img">
                        <?php the_post_thumbnail($image_size); ?>
                    </a>
                    <div class="content">
                        <div class='categorie'><?php echo Saasland_Core_Helper()->get_first_category('portfolio_cat'); ?></div>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title('<h5 class="agency_learn_btn" data-text="'.the_title_attribute('echo=0').'">', '</h5>') ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            ++$i;
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</section>
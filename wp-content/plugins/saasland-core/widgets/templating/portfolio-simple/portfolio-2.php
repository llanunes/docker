<section class="photography_work_area">
    <div class="container photoshop_container">
        <div class="row align-items-center photography_work_tab">
            <div class="col-lg-6">
                <?php echo !empty($settings['title']) ? sprintf( '<%1$s class="title outline_title"> %2$s </%1$s>', $title_tag, $settings['title'] ) : ''; ?>
            </div>
        </div>
        <div class="custome_nav">
            <div class="prevs slick-arrow"><i class="icon-arrow-left"></i></div>
            <div class="nexts slick-arrow"><i class="icon-arrow-right"></i></div>
        </div>
    </div>
    <div class="photography_gallery_slider">
        <?php
        while ( $portfolios->have_posts() ) : $portfolios->the_post();
            ?>
            <div class="swipe-tab-content">
                <div class="slider_img">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </div>
                <div class="content">
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title() ?></h3>
                    </a>
                    <div class="tag_name">
                        <a href="<?php echo Saasland_Core_Helper()->get_first_category_link('portfolio_cat'); ?>">
                            <?php echo Saasland_Core_Helper()->get_first_category('portfolio_cat'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</section>

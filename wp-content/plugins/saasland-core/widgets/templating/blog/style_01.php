<?php
$featured_post = new WP_Query(array(
    'post_type'     => 'post',
    'posts_per_page'=> -1,
    'p' => $settings['featured_post'],
));

?>

<section class="agency_about_area d-flex">
    <?php
    while($featured_post->have_posts()) : $featured_post->the_post();
        $excerpt = get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '');
        ?>
        <div class="col-lg-6 about_content_left">
            <div class="about_content mb_30">
                <?php the_title( '<h2 class="f_size_30 f_700 l_height45 mb_20">', '</h2>' ) ?>
                <?php if ( $excerpt ) : ?>
                    <p class="f_size_15 f_300 mb_40"> <?php echo saasland_kses_post($excerpt) ?> </p>
                <?php endif; ?>
                <?php if (!empty($settings['btn_title'])) : ?>
                    <a href="<?php the_permalink() ?>" class="about_btn">
                        <?php echo esc_html($settings['btn_title']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
    <div class="col-lg-6 about_img">
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="pluse_icon"><i class="ti-link"></i></a>
        <div class="about_img_slider owl-carousel">
            <?php
            if ( !empty($settings['slide_cats']) ) {
                foreach ( $settings['slide_cats'] as $cat ) {
                    echo '<div class="item">';
                    if ( $cat['cat'] == 'all' ) {
                        $cat_posts = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                        ));
                    } else {
                        $cat_posts = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'category_name' => $cat['cat'],
                        ));
                    }
                    $cat_i = 0;
                    while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
                        $image_size = ($cat_i == 0) ? 'saasland_455x600' : 'saasland_520x300';
                        ?>
                        <div class="about_item <?php echo ($cat_i == 0) ? 'w45' : 'w55'; ?>" style="background-image:url(<?php echo esc_attr( get_the_post_thumbnail_url(get_the_ID(), $image_size ) ) ?>)">

                            <div class="about_text">
                                <span class="br"></span>
                                <a href="<?php the_permalink() ?>">
                                    <h5 class="f_size_18 l_height28 mb-0"> <?php the_title() ?> </h5>
                                </a>
                            </div>
                        </div>
                        <?php
                        ++$cat_i;
                    endwhile;
                    wp_reset_postdata();
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</section>
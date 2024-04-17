<?php
use Elementor\Group_Control_Image_Size;
// $cats =  $settings['cats'];
?>
<ul class="nav nav-tabs deal_tab wow fadeInUp" data-wow-delay="0.3s" id="myTab" role="tablist">
    <?php
    foreach ( $cats as $index => $cat_id ) {
        $count_number = $index + 1;
        $active_class = $count_number == 1 ? 'active' : '';
        $aria_selected = $active_class ? 'true' : 'false';
        $category = get_term( $cat_id );
        ?>
        <li class="nav-item">
            <a class="nav-link blog-category <?php echo esc_attr($active_class) ?>" id="tab-<?php echo esc_attr($cat_id) ?>" data-bs-toggle="tab" href="#<?php echo esc_attr($cat_id) ?>" role="tab" aria-controls="<?php echo esc_attr($cat_id) ?>" aria-selected="<?php echo esc_attr($aria_selected) ?>">
                <?php echo esc_attr($cat_id) ?>
            </a>
        </li>
        <?php
    }
    ?>
</ul>

<div class="tab-content deal_tab_content" id="myTabContent">
    <?php
    foreach ( $cats  as $index => $cat_id ) {
        $count_number = $index + 1;
        $active_class = $count_number == 1 ? 'active show' : '';
        $category = get_term( $cat_id );
        ?>
        <div class="tab-pane fade <?php echo esc_attr($active_class) ?>" id="<?php echo esc_attr($cat_id) ?>" role="tabpanel" aria-labelledby="tab-<?php echo esc_attr($cat_id) ?>">
            <div class="row">
                <?php
                $data_wow_delay = 0.2;
                $data_wow_duration = 0.9;

                if ( !empty($settings['cats'] ) ) {
                    $args['tax_query'] = [
                        [
                            'taxonomy'  => 'category',
                            'field'     => 'slug',
                            'terms'     => $cat_id,
                        ]
                    ];
                }

                $blog_post = new \WP_Query( $args );

                if ( $blog_post->have_posts() ) :
                    $data_settings = [];

                    $data_settings['excerpt_length'] = $excerpt_length;
                    $data_settings['title_limit_char'] = $title_limit_char;
                    while ( $blog_post->have_posts() ) : $blog_post->the_post();

                        $title = get_the_title() ? wp_trim_words(get_the_title(get_the_ID()), $title_limit_char. '' ) : wp_trim_words(get_the_title(get_the_ID()), $title_limit_char. '' );
                        $excerpt = get_the_excerpt(get_the_ID()) ? wp_trim_words(get_the_excerpt(get_the_ID()), $excerpt_length, '') : wp_trim_words(get_the_content(get_the_ID()), $excerpt_length, '');

                        $settings['thumbnail_size'] = [
                            'id' => get_post_thumbnail_id(),
                        ];
                        $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );
                        ?>
                        <div class="col-lg-6">
                            <div class="media deal_item wow fadeInUp" data-wow-delay="0.1s">
                                <?php
                                if ( !empty($thumbnail_html) && function_exists( 'saasland_kses_post' ) ) {
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="img_deal_post">
                                       <?php echo saasland_kses_post($thumbnail_html) ?>
                                    </a>
                                    <?php
                                }
                                ?>
                                <div class="media-body">
                                    <a href="<?php the_permalink(); ?>">
                                        <h4 class="post-title">
                                            <?php echo esc_html($title) ?>
                                        </h4>
                                    </a>
                                    <p class="post-content"><?php echo esc_html($excerpt) ?></p>
                                    <a href="<?php the_permalink(); ?>" class="travel_btn hover_style1 btn_title">
                                        <?php echo esc_html($btn_title) ?><i class="icon-arrow-right-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $data_wow_delay = $data_wow_delay + 0.1;
                        $data_wow_duration = $data_wow_duration + 0.2;
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <?php
    }
    ?>

</div>

<div class="row">
    <?php 
    while ( $blog_post->have_posts() ) : $blog_post->the_post();
    $excerpt = get_the_excerpt(get_the_ID()) ? wp_trim_words(get_the_excerpt(get_the_ID()), $excerpt_length, '') : wp_trim_words(get_the_content(get_the_ID()), $excerpt_length, '');
    $limit_char = isset( $settings['title_limit_char'] ) ? $settings['title_limit_char'] : '10';
    ?>
        <div class="col-lg-<?php echo esc_attr( $settings['column'] ) ?> col-sm-6 blog-gird" >
            <div class="corporate_blog_item wow fadeInDown">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
                <div class="content">
                    <a href="<?php saasland_first_category_link(); ?>" class="category">
                        <?php saasland_first_category(); ?>
                    </a>
                    <a href="<?php the_permalink(); ?>">
                        <h2 class="post-title"><?php saaslandCore_limit_latter(get_the_title(), $limit_char) ?></h2>
                    </a>
                    <?php
                        echo !empty( $is_post_excerpt == 'yes' ) ? wpautop($excerpt) : '';
                    
                    if ( !empty( $settings['btn_title_two'] ) ) {
                        ?>
                        <div class="d-flex justify-content-between">
                            <?php
                            if (!empty( $settings['btn_title_two'])) {
                                ?>
                                <a href="<?php the_permalink(); ?>" class="agency_learn_btn h_text_btn" data-text="<?php echo esc_attr($btn_title_two) ?>">
                                    <?php echo esc_html($btn_title_two);
                                    if ( !empty($is_btn_icon == 'yes' )) {
                                        \Elementor\Icons_Manager::render_icon( $read_more_icon, [ 'aria-hidden' => 'true' ] );
                                    }
                                    ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();

    ?>
</div>
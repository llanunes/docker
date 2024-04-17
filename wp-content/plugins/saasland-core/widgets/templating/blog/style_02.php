<div class="container">
    <div class="row">
        <?php
        while($blog_post->have_posts()) : $blog_post->the_post();
            $limit_char = isset( $settings['title_limit_char'] ) ? $settings['title_limit_char'] : '10';
            ?>
            <div class="col-lg-<?php echo esc_attr( $settings['column'] ) ?> col-md-6 mb-5">
                <div class="h_blog_item">
                    <?php the_post_thumbnail('full'); ?>
                    <div class="h_blog_content">
                        <a href="<?php Saasland_Core_Helper()->the_day_link(); ?>" class="post_time">
                            <i class="icon_clock_alt"></i>
                            <?php the_time(get_option( 'date_format')) ?>
                        </a>
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                            <h3 title="<?php echo esc_attr( the_title() ) ?>">
                                <?php saaslandCore_limit_latter(get_the_title(), $limit_char) ?>
                            </h3>
                        </a>
                        <div class="post-info-bottom">
                            <?php if (!empty($settings['btn_title'])) : ?>
                                <a href="<?php the_permalink() ?>" class="learn_btn_two">
                                    <?php echo esc_html($settings['btn_title']) ?>
                                    <i class="arrow_right"></i>
                                </a>
                            <?php endif; ?>
                            <a class="post-info-comments" href="#">
                                <i class="icon_comment_alt" aria-hidden="true"></i>
                                <span><?php comments_number() ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        if( $settings['show_pagination'] == 'yes' ) {
            $align_class = !empty( $settings['pagination_align'] ) ? $settings['pagination_align'] : 'center';
            $total_pages = $blog_post->max_num_pages;
            if ($total_pages > 1) {
                echo '<div class="custom_blog pagination justify-content-'.esc_attr( $align_class ).'"><div class="nav-links">';
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '/page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text' => '<i class="ti-arrow-left"></i>',
                    'next_text' => '<i class="ti-arrow-right"></i>',
                    'add_args' => array()
                ));
                echo '</div></div>';
            }
        }
        wp_reset_postdata();
        ?>
    </div>
</div>

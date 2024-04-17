<section class="arch_work_area">
    <?php
    $post_num_i = 0;
    while ( $portfolios->have_posts() ) : $portfolios->the_post();
        ?>
        <div class="row flex-row-reverse arch_work_item">
            <?php
            if ( has_post_thumbnail() ) { ?>
                <div class="col-lg-8">
                    <div class="arch_work_img">
                        <div class="image_mask wow slideInLeft" data-wow-duration="1.8s"></div>
                        <?php the_post_thumbnail( 'full', array( 'class' => 'wow fadeIn', 'data-wow-duration' => '1.5s'  ) ); ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-lg-4">
                <div class="arch_work_content wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="number">0<?php echo esc_html( ++$post_num_i ) ?></div>
                    <div class="image_name p-item-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title('<h3>', '<h3>') ?>
                        </a>
                    </div>
                    <div class="location p-category">
                        <?php echo Saasland_Core_Helper()->get_first_category('portfolio_cat') ?>
                    </div>
                    <?php
                    if ( $btn_label ) { ?>
                        <a href="<?php the_permalink(); ?>" class="rave_btn rave_btn_effect" data-text="<?php echo esc_attr( $btn_label ) ?>">
                            <?php echo esc_html( $btn_label ) ?>
                            <i class="icon-arrow-right-2"></i>
                        </a>
                        <?php
                    }
                    if ( $portfolios->post_count == $portfolios->current_post+1 ) {
                        if ( $all_btn_label ) { ?>
                            <div class="arch_work_more_btn">
                                <a <?php saasland_el_btn( $all_btn_url ); ?> class="arch_btn">
                                    <?php echo esc_html( $all_btn_label ) ?>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
    ?>
</section>
<section class="travel_tour_area wow fadeInUp" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-8">
                <?php if ( !empty($settings['title']) ) : ?>
                    <div class="travel_sec_title">
                        <h2><?php echo esc_html($settings['title']) ?></h2>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-sm-4">
                <div class="slider_arrow">
                    <button class="prev slick-arrow"><i class="icon-arrow-left"></i></button>
                    <button class="next slick-arrow"><i class="icon-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="travel_tour_slider">
        <?php
        if ( $hotel_booking->have_posts() ) {
            $settings = get_option( 'wp_travel_engine_settings', array() );
            while($hotel_booking->have_posts()) : $hotel_booking->the_post();
                $meta   = \wte_trip_get_trip_rest_metadata( get_the_ID() );
                ?>
                <div class="item">
                    <div class="travel_tour_item">
                        <?php if ( $meta->discount_percent > 0 ) : ?>
                            <div class="discount">-<?php echo esc_html($meta->discount_percent); ?>%</div>
                        <?php endif; ?>
                        <?php the_post_thumbnail( ['1170', '600']); ?>
                        <div class="travel_tour_content">
                            <div class="text">
                                <?php
                                $destination = wte_get_the_tax_term_list( get_the_ID(), 'destination', '', ', ', '' );

                                if ( ! empty( $destination ) && ! is_wp_error( $destination ) ){
                                    echo '<h6>'.$destination.'</h6>';
                                }
                                the_title('<h3>', '</h3>');
                                ?>
                                <div class="review">
                                    <?php
                                    if ( wte_array_get( $settings, 'layoutFilters.showReviews', false ) ) :
                                        echo \wte_get_the_trip_reviews( get_the_ID() );
                                    endif;
                                    ?>
                                </div>
                                <div class="discount_price">
                                    <?php esc_html_e( 'From', 'rave-core' ) ?>
                                    <span class="price"><?php echo wte_get_formated_price_html( $meta->has_sale ? $meta->sale_price : $meta->price ); ?></span>
                                    <?php if ( wte_array_get( $settings, 'layoutFilters.showStrikedPrice', true ) && $meta->has_sale ) : ?>
                                        <span class="striked-price oldPrice"><?php echo wte_get_formated_price_html( $meta->price ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ( !empty($settings['btn_label']) ) : ?>
                                <a href="<?php the_permalink(); ?>" class="travel_btn_two hover_style1">
                                    <?php echo esc_html($settings['btn_label']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        }
        ?>
    </div>
</section>





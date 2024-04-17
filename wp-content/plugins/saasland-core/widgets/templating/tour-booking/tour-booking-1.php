<div class="row">
    <?php
    use Elementor\Group_Control_Image_Size;
    $data_delay_time = 0.2;
    while ( $hotel_booking->have_posts() ) : $hotel_booking->the_post();
        $settings['thumbnail_size'] = [
            'id' => get_post_thumbnail_id(),
        ];
        $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );
        $column = !empty($settings['column']) ? $settings['column'] : '3';
        $excerpt_length = !empty($settings['excerpt_length']) ? $settings['excerpt_length'] : 5;
        $excerpt = get_the_excerpt() ? wp_trim_words(get_the_excerpt(), $excerpt_length, '') : wp_trim_words(get_the_content(), $excerpt_length, '');
        ?>
        <div class="col-lg-<?php echo esc_attr($column) ?> col-sm-6">
            <div class="travel_package_item wow fadeInUp" data-wow-delay="<?php echo esc_attr($data_delay_time) ?>s">
                <?php if ( !empty($thumbnail_html) && function_exists('saasland_kses_post') ) : ?>
                    <div class="package_img">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'saasland_285x350' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="content">
                    <a href="<?php the_permalink(); ?>">
                        <h3 class="title"><?php the_title() ?></h3>
                    </a>
                    <div class="place_name"><?php saasland_first_category('destination'); ?></div>
                    <?php echo !empty($excerpt) && function_exists('saasland_kses_post') ? saasland_kses_post(wpautop($excerpt)) : ''; ?>
                    <div class="time">
                        <?php
                        $metadata = get_post_meta(get_the_ID(), 'wp_travel_engine_setting', false);
                        foreach ($metadata as $data) {
                            echo  esc_html($data['trip_duration_nights']) .' Nights / ' .esc_html($data['trip_duration']) .' '.esc_html($data['trip_duration_unit']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    $data_delay_time = $data_delay_time + 0.1;
    endwhile;
    wp_reset_postdata();
    ?>
</div>
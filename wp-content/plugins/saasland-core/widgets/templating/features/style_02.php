<section class="agency_service_area">
    <div class="container custom_container">
        <?php if (!empty($settings['title'])) : ?>
            <<?php echo $title_tag; ?> class="f_size_30 f_600 t_color3 l_height40 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
            </<?php echo $title_tag; ?>>
        <?php endif; ?>
        <div class="row mb_30">
            <?php
            unset($i, $feature);
            if (is_array($features2)) {
                $i = 0.3;
                $i2 = 1;
                foreach ($features2 as $feature) {
                    if ( $i2 % 2 == 0 ) {
                        $padding = 'pr_70';
                    }
                    ?>
                    <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                        <div class="p_service_item agency_service_item pr_70 wow fadeInUp elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>" data-wow-delay="<?php echo esc_attr($i); ?>s">
                            <div class="icon">
                                <?php if (!empty($feature['icon_bg_two']['url'])) : ?>
                                    <img src="<?php echo esc_url($feature['icon_bg_two']['url']) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                <?php endif;
                                \Elementor\Icons_Manager::render_icon( $feature['tic'] );
                                ?>
                            </div>
                            <?php
                            if (!empty($feature['title'])) { ?>
                                <<?php echo $feature_item_title_tag ?> class="f_600 f_p t_color3">
                                    <?php echo esc_html($feature['title']) ?>
                                </<?php echo $feature_item_title_tag; ?>>
                                <?php
                                }
                            echo wpautop($feature['subtitle']);
                            if (!empty($feature['link_title'])) { ?>
                                <p class="mb-0 feature_button">
                                    <?php if ( !empty($feature['link_url']['url']) ) { ?>
                                        <a <?php saasland_el_btn($feature['link_url']) ?>>
                                            <?php echo esc_html($feature['link_title']) ?>
                                        </a>
                                        <i class="ti-arrow-right"></i>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                ++$i2;
                $i = $i + 0.2;
                }
            }
            ?>
        </div>
    </div>
</section>
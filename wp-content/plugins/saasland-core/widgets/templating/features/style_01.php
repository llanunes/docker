<section class="prototype_service_area_three">
    <div class="container">
        <div class="prototype_service_info">
            <div class="symbols-pulse active">
                <div class="pulse-1"></div>
                <div class="pulse-2"></div>
                <div class="pulse-3"></div>
                <div class="pulse-4"></div>
                <div class="pulse-x"></div>
            </div>
            <?php if (!empty($settings['title'])) : ?>
                <<?php echo $title_tag; ?> class="f_size_30 f_600 t_color3 l_height45 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                </<?php echo $title_tag; ?>>
                <?php endif; ?>
            <div class="row p_service_info">
                <?php
                if (is_array($features)) {
                    $i = 0.2;
                    $padding = '';
                    foreach ($features as $i1 => $feature) {
                        if ( $column == '3' ) {
                            if ( $i1 % 4 == 0 ) {
                                $padding = 'pr_70';
                            }
                            if ( $i1 % 4 == 0 ) {
                                $padding = 'pl_20 pr_70';
                            }
                        }
                        ?>
                        <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                            <div class="p_service_item pr_70 wow fadeInLeft" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                <div class="icon icon_one elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                                    <?php
                                    if ( $feature['icon_type'] == 'ti' ) {
                                        \Elementor\Icons_Manager::render_icon( $feature['tic'] );
                                    } elseif ( $feature['icon_type'] == 'image_icon' ) {
                                        echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                    }
                                    ?>
                                </div>
                                <<?php echo esc_attr($feature_item_title_tag) ?> class="f_600 f_p t_color3">
                                    <?php echo esc_html($feature['title']) ?>
                                </<?php echo esc_attr($feature_item_title_tag) ?>>
                                <?php if (!empty($feature['subtitle'])) : ?>
                                    <p class="f_300"> <?php echo $feature['subtitle']; ?> </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        $i = $i + 0.2;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
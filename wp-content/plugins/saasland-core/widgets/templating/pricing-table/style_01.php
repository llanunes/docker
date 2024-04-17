<section class="s_pricing_area sec_pad">
    <div class="container custom_container">
        <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
            <?php
            if (!empty($settings['title'])) {
                echo '<'.esc_html($title_tag) .' class="f_p f_size_30 l_height50 f_600 t_color"> '.saasland_kses_post( $settings['title'] ) .'</'. esc_html($title_tag) .'>';
            }
            if (!empty($settings['subtitle'])) { ?>
                <p class="f_300 f_size_18 l_height34"> <?php echo saasland_kses_post($settings['subtitle']) ?> </p>
                <?php
            } ?>
        </div>
        <div class="row mb_30">
            <?php
            foreach ($tables as $i => $table) {
                $title_tag  = !empty($table['title_html_tag']) ? $table['title_html_tag'] : 'h5';
                $price_tag  = !empty($table['title_price_tag']) ? $table['title_price_tag'] : '';
                $icon_color = !empty($table['icon_color']) ? "style='color:{$table['icon_color']};'" : '';
                $icon = '';
                if ($table['icon_type'] == 'flaticon' ) {
                    $icon = !empty($table['flaticon']) ? $table['flaticon'] : '';
                }elseif ($table['icon_type'] == 'themify_icon' ) {
                    $icon = !empty($table['themify_icon']) ? $table['themify_icon'] : '';
                }
                $anim = 'fadeInLeft';
                $anim_dur = '4';
                switch ($i) {
                    case 0:
                        $anim = 'fadeInLeft';
                        $anim_dur = '4';
                        break;
                    case 1:
                        $anim = 'fadeInUp';
                        $anim_dur = '6';
                        break;
                    case 2:
                        $anim = 'fadeInRight';
                        $anim_dur = '8';
                        break;
                }
                ?>
                <div class="col-lg-<?php echo esc_attr($settings['column']) ?> col-sm-6">
                    <div class="s_pricing-item wow <?php echo esc_attr($anim) ?>" data-wow-delay="0.<?php echo esc_attr($anim_dur) ?>s" style="background: <?php echo $table['bg_color'] ?>;">
                        <?php if (!empty($table['ribbon_label'])) { ?>
                            <div class="tag_label blue_bg"> <?php echo esc_html($table['ribbon_label']) ?> </div>
                            <?php
                        }
                        if (!empty($table['icon_bg']['url'])) { ?>
                            <img class="shape_img" src="<?php echo esc_url($table['icon_bg']['url']) ?>" alt="<?php echo esc_attr($table['title']) ?>">
                            <?php
                        } ?>
                        <div class="s_price_icon p_icon1">
                            <i <?php echo $icon_color; ?> class="<?php echo $icon; ?>"></i>
                        </div>
                        <?php
                        if (!empty( $table['title'] )) {
                            echo '<'. $title_tag .' class="f_p f_500 f_size_18 t_color mb-0 mt_40">'. esc_html( $table['title'] ).' </'. $title_tag .'>';
                        }
                        if (!empty($table['subtitle'])) { ?>
                            <p class="f_p f_300"> <?php echo esc_html($table['subtitle']) ?> </p>
                            <?php
                        } ?>
                        <?php echo !empty($table['titles']) ? wp_kses_post($table['titles']) : ''; ?>
                        <?php if(!empty($table['price'])): ?>
                            <div class="price f_size_40 f_p f_600">
                                <?php if(!empty($price_tag)){ echo '<'.$price_tag.'class="d-inline-flex">'. esc_html($table['price']). '</'.$price_tag.'>';} ?>
                                <?php if (!empty($table['duration'])) : ?>
                                    <sub class="f_300 f_size_16"> / <?php echo esc_html($table['duration']) ?> </sub>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <ul class="list-unstyled mt_30">
                            <?php echo wp_kses_post($table['contents']) ?>
                        </ul>
                        <?php if (!empty($table['btn_label'])) :
                            $btn_id = !empty( $table['pricing_btn_id'] ) ? 'id='.esc_attr( $table['pricing_btn_id'] ).'' : '';
                            ?>
                            <a <?php saasland_el_btn($table['btn_url']) ?> class="btn-saasland btn_three btn_hover" <?php echo esc_attr($btn_id) ?>>
                                <?php echo esc_html($table['btn_label']) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
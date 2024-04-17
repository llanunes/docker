<section class="pos_developer_product_area sec_pad ht-tab tabs-<?php echo $this->get_id(); ?>" id="tabs-<?php echo $this->get_id(); ?>">
    <div class="container">
        <?php if (!empty($settings['title'])) : ?>
        <div class="hosting_title text-center">
            <<?php echo $title_tag; ?> class="saasland_horizontal_tab_s wow fadeInUp" data-wow-delay="0.3s">
            <?php echo wp_kses_post( $settings['title'] ) ?>
        </<?php echo $title_tag; ?>>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="tab_img_info">
                <?php
                foreach ( $tabs2 as $index => $item ) :
                    $tab_count = $index + 1;
                    $active = $tab_count == 1 ? 'active' : '';
                    if (!empty($item['featured_image']['url'])) :
                        ?>
                        <div class="tab_img <?php echo esc_attr( $active ) ?>" id="ht2_tab_<?php echo esc_attr( $index ).'_'.$this->get_id() ?>">
                            <img class="img-fluid wow fadeInRight" data-wow-delay="0.4s" src="<?php echo esc_url($item['featured_image']['url']) ?>" alt="<?php echo esc_attr($item['tab_title']); ?>">
                            <div class="square"></div>
                            <div class="bg_circle elementor-repeater-item-<?php echo $item['_id']; ?>"></div>
                            <div data-parallax='{"x": 0, "y": 100}' class="tab_round"></div>
                            <div data-parallax='{"x": 50, "y": 5}' class="tab_triangle"></div>
                            <?php if ( !empty( $item['shape_f_img']['url'] ) ) : ?>
                                <div data-parallax='{"x": 0, "y": 100}'>
                                    <div class="pattern_shap" style="background: url(<?php echo esc_url( $item['shape_f_img']['url']) ?>);"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center">
            <div class="developer_product_content">
                <ul class="nav nav-tabs develor_tab mb-30" id="myTab-<?php echo $this->get_id(); ?>" role="tablist">
                    <?php
                    $i = 0.2;
                    foreach ( $tabs2 as $index => $item ) :
                        $tab_count = $index + 1;
                        $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                        $active = $tab_count == 1 ? ' active show' : '';
                        $this->add_render_attribute( $tab_title_setting_key, [
                            'class' => [ 'nav-link', $active ],
                            'id' => 'saasland-tab-'.$id_int . $tab_count,
                            'data-bs-toggle' => 'tab',
                            'role' => 'tab',
                            'data-tab' => 'ht2_tab_'.$index.'_'.$this->get_id(),
                            'href' => '#saasland-tab-content-' . $id_int . $tab_count,
                            'aria-controls' => 'saasland-tab-content-' . $id_int . $tab_count,
                            'aria-selected' => $index == 1 ? 'true' : 'false',
                        ]);
                        ?>
                        <li class="nav-item">
                            <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                <?php echo wp_kses_post($item['tab_title']); ?>
                            </a>
                        </li>
                        <?php
                        $i = $i + 0.2;
                    endforeach;
                    ?>
                </ul>
                <div class="tab-content developer_tab_content">
                    <?php
                    foreach ( $tabs2 as $index => $item ) :
                        $tab_count = $index + 1;
                        $active = $tab_count == 1 ? ' active show' : '';
                        $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                        $this->add_render_attribute( $tab_content_setting_key, [
                            'class' => [ 'tab-pane fade', $active ],
                            'aria-labelledby' => 'saasland'.'-tab-'.$id_int . $tab_count,
                            'role' => 'tabpanel',
                            'id' => 'saasland-tab-content-' . $id_int . $tab_count,
                        ]);
                        ?>
                        <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                            <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            $("#tabs-<?php echo $this->get_id(); ?> .develor_tab li a").click(function() {
                var tab_id = $(this).attr("data-tab");
                $("#tabs-<?php echo $this->get_id(); ?> .tab_img").removeClass("active");
                $("#" + tab_id).addClass("active");
            });
        })
    })(jQuery);
</script>
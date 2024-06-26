<?php
$slides = isset($settings['slides']) ? $settings['slides'] : '';

$slider_default_setting = [];

if($settings['loop'] != '') {
    $slider_default_setting['loop'] =   $settings['loop'];
}
if($settings['slide_speed'] != ''){
    $slider_default_setting['slide_speed'] =  $settings['slide_speed'];
}
?>

<section class="saas_banner_area_three owl-carousel" data-controls="<?php echo esc_attr(json_encode($slider_default_setting)); ?>">
    <?php
    foreach ($slides as $slide) {
        $button_url = $slide['btn_url'];
        $btn_target = $button_url['is_external'] ? 'target="_blank"' : '';
        $button2_url = $slide['btn2_url'];
        $btn2_target = $button2_url['is_external'] ? 'target="_blank"' : '';
        if ($slide['style'] == '1' ) { ?>
            <div class="slider_item elementor-repeater-item-<?php echo esc_attr($slide['_id']) ?>">
                <div class="container">
                    <div class="slidet_content">
                        <?php echo (!empty($slide['content'])) ? wp_kses_post($slide['content']) : ''; ?>
                        <?php if (!empty($slide['btn_label'])) : ?>
                            <a href="<?php echo esc_url($button_url['url']) ?>" <?php echo $btn_target; ?>
                               class="slider_btn btn_hover">
                                <?php echo esc_html($slide['btn_label']) ?>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($slide['btn2_label'])) : ?>
                            <a href="<?php echo esc_url($button2_url['url']) ?>" <?php echo $btn2_target; ?>
                               class="slider_btn btn_hover">
                                <?php echo esc_html($slide['btn2_label']) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="image_mockup">
                        <?php echo !empty($slide['image1']['id']) ? wp_get_attachment_image($slide['image1']['id'], 'full', false, array( 'class' => 'watch')) : ''; ?>
                        <?php echo !empty($slide['image2']['id']) ? wp_get_attachment_image($slide['image2']['id'], 'full', false, array( 'class' => 'laptop')) : ''; ?>
                        <?php echo !empty($slide['image3']['id']) ? wp_get_attachment_image($slide['image3']['id'], 'full', false, array( 'class' => 'phone')) : ''; ?>
                    </div>
                </div>
            </div>
            <?php
        }
        elseif ( $slide['style'] == '2' ) {
            ?>
            <div class="slider_item slider_item_two elementor-repeater-item-<?php echo esc_attr($slide['_id']) ?>">
                <div class="container">
                    <div class="slidet_content_two text-center">
                        <?php echo (!empty($slide['content'])) ? wp_kses_post($slide['content']) : ''; ?>
                        <?php if (!empty($slide['btn_label'])) : ?>
                            <a href="<?php echo esc_url($button_url['url']) ?>" <?php echo $btn_target; ?>
                               class="slider_btn btn_hover">
                                <?php echo esc_html($slide['btn_label']) ?>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($slide['btn2_label'])) : ?>
                            <a href="<?php echo esc_url($button2_url['url']) ?>" <?php echo $btn_target; ?>
                               class="slider_btn btn_hover">
                                <?php echo esc_html($slide['btn2_label']) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="image_mockup">
                        <?php echo !empty($slide['image1']['id']) ? wp_get_attachment_image($slide['image1']['id'], 'full', false, array( 'class' => 'laptop')) : ''; ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</section>
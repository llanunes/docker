<div class="seo_features_img <?php echo ($settings['style'] == 'style_02' ) ? 'seo_features_img_two' : ''; ?>">
    <?php
    if ($settings['is_shape1'] == 'yes' ) { ?>
        <div class="round_circle"></div>
        <?php
    }
    if ($settings['is_shape2'] == 'yes' ) { ?>
        <div class="round_circle two"></div>
        <?php
    }
    echo wp_get_attachment_image($settings['image']['id'], 'full' );
    ?>
</div>
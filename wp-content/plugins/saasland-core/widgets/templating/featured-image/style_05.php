<?php if (!empty($settings['bg_shape']['url'])) : ?>
    <style>
        .startup_tab_img:before {
            background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center 0/contain;
        }
    </style>
<?php
endif;
?>
<div class="startup_tab_img">
    <div class="web_img">
        <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
    </div>
    <div class="phone_img">
        <?php echo wp_get_attachment_image($settings['image2']['id'], 'full' ); ?>
    </div>
</div>
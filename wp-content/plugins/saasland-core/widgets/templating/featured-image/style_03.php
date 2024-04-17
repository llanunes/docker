<?php if (!empty($settings['bg_shape']['url'])) :
    ?>
    <style>
        .stratup_service_img .shape {
            background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll left 0;
        }
    </style>
<?php endif; ?>
<div class="stratup_service_img">
    <div class="shape"></div>
    <?php echo wp_get_attachment_image($settings['image']['id'], 'full', '', array( 'class' => 'laptop_img')) ?>
    <?php echo wp_get_attachment_image($settings['image2']['id'], 'full', '', array( 'class' => 'phone_img')) ?>
</div>

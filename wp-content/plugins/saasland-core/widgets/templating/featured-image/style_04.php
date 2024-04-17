<?php if (!empty($settings['image']['url'])) :
    ?>
    <style>
        .payment_features_img:before {
            content: "";
            background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center left;
        }
    </style>
<?php endif; ?>
<div class="payment_features_img">
    <?php echo wp_get_attachment_image($settings['image']['id'], 'full' ) ?>
</div>

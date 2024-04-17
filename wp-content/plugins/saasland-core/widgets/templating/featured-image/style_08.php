<div class="expect_info">
    <div class="expect_item">
        <?php if ( !empty($settings['numbertitle']) && function_exists('saasland_kses_post')) : ?>
            <div class="number">
                <?php echo saasland_kses_post($settings['numbertitle']) ?>
            </div>
        <?php endif; ?>
        <div class="e_img">
            <div class="image_mask wow slideInLeft animated" data-wow-duration="1.8s"></div>
            <?php echo wp_get_attachment_image($settings['image']['id'], 'full') ?>
        </div>
    </div>
</div>
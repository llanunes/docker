<section class="software_featured_area <?php echo !empty($settings['subtitle']) ? 'has_subtitle' : ''; ?>">
    <div class="container">
        <?php if (!empty($settings['title'])) : ?>
        <<?php echo $title_tag; ?> class="f_600 f_size_30 t_color3 text-center l_height40 mb_70 wow fadeInUp" data-wow-delay="0.3s">
        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
    </<?php echo $title_tag; ?>>
    <?php endif; ?>
    <?php if (!empty($settings['subtitle'])) : ?>
        <p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">
            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
        </p>
    <?php endif; ?>
    <div class="row software_featured_info">
        <?php
        unset($i, $feature);
        if (is_array($features3)) {
        $i = 0.3;
        foreach ($features3 as $feature) {
        ?>
        <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i) ?>s">
            <div class="software_featured_item text-center mb_20 elementor-repeater-item-<?php echo $feature['_id']; ?>">
                <div class="s_icon">
                    <?php if (!empty($feature['icon_bg']['url'])) : ?>
                        <img src="<?php echo esc_url($feature['icon_bg']['url']) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                    <?php endif; ?>
                    <?php if (!empty($feature['image_icon']['url'])) : ?>
                        <img class="icon" src="<?php echo esc_url($feature['image_icon']['url']); ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                    <?php endif; ?>
                </div>
                <?php if (!empty($feature['title'])) : ?>
                <<?php echo $feature_item_title_tag ?> class="f_600 t_color3"><?php echo esc_html($feature['title']) ?></<?php echo $feature_item_title_tag ?>>
            <?php endif; ?>
            <?php if (!empty($feature['subtitle'])) : ?>
                <p class="f_size_15 mb-30"> <?php echo wp_kses_post(nl2br($feature['subtitle'])); ?> </p>
            <?php endif; ?>
            <?php if (!empty($feature['link_title'])) : ?>
                <a href="<?php echo esc_url($feature['link_url']['url']) ?>" class="learn_btn">
                    <?php echo esc_html($feature['link_title']) ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php
$i = $i + 0.2;
}}
?>
    </div>
    </div>
</section>
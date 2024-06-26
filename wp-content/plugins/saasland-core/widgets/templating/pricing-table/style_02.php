<section class="payment_priceing_area">
    <div class="container">
        <div class="sec_title mb_70 wow fadeInUp text-center" data-wow-delay="0.4s">
            <?php if (!empty($settings['title'])) : ?>
            <<?php echo esc_html($title_tag); ?> class="f_p f_size_30 l_height40 f_700 t_color">
            <?php echo wp_kses_post($settings['title']); ?>
        </<?php echo esc_html($title_tag); ?>>
        <?php endif; ?>
        <?php if (!empty($settings['subtitle'])) : ?>
            <p class="f_400 f_size_18 l_height34"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
        <?php endif; ?>
    </div>
    <div class="payment_price_info">
        <?php

        if ( !empty($settings['table_bg_shape']['url']) ) {
            ?>
            <style>
                .payment_priceing_area:before {
                    background: url(<?php echo esc_url($settings['table_bg_shape']['url']) ?>) no-repeat scroll center;
                }
            </style>
            <?php
        }

        foreach ( $table2 as $i => $table ) {
            ?>
            <div class="payment_price_item <?php echo ($table['is_highlighted']) == 'yes' ? 'center' : ''; ?> elementor-repeater-item-<?php echo $table['_id']; ?>">
                <?php if (!empty($table['title'])) : ?>
                    <h2 class="pricing_title"> <?php echo wp_kses_post(nl2br($table['title'])); ?> </h2>
                <?php endif; ?>
                <?php if (!empty($table['subtitle'])) : ?>
                    <p class="pricing_subtitle"> <?php echo wp_kses_post(nl2br($table['subtitle'])); ?> </p>
                <?php endif; ?>
                <div class="pricong_content_wrap">
                    <?php echo (!empty($table['contents'])) ? wp_kses_post(wpautop($table['contents'])) : ''; ?>
                </div>
                <?php if (!empty($table['btn_title'])) : ?>
                    <a class="payment_price_btn" href="<?php echo esc_url($table['btn_url']['url']); ?>">
                        <?php echo esc_html($table['btn_title']) ?> <i class="ti-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <?php
        }
        ?>
    </div>
    </div>
</section>
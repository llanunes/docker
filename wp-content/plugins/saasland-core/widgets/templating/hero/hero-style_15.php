<section class="banner_area_15 hero_bg">
    <ul class="list-unstyled banner_dot_two">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <ul class="list-unstyled banner_dot">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="banner_text_intro text-center">
            <?php
            if ( !empty($upper_title) ) { ?>
                <span class="brand_name upper-title"><?php echo esc_html($upper_title) ?></span>
                <?php
            }

            ?>
             <?php if (!empty($settings['title'])) : ?>
                <<?php echo $title_tag; ?> class="title typewrite_title wow fadeInUp" data-wow-delay="0.3s"> <?php echo saasland_hero_title($settings['title']); ?> </<?php echo $title_tag; ?>>
            <?php endif; ?>
            <?php 
            saasland_typed_words_js( $settings['title'] );
            if ( !empty($subtitle) ) { ?>
                <p class="wow fadeInUp subtitle" data-scroll-animation="0.5s">
                    <?php echo Saasland_Core_Helper()->kses_post(nl2br($subtitle)) ?>
                </p>
                <?php
            }

            if ( !empty($bottom_text_btn) ) {
                ?>
                <a <?php Saasland_Core_Helper()->the_button($bottom_btn_url) ?> class="bottom_btn button">
                    <?php echo esc_html($bottom_text_btn) ?>
                    <i class="icon-arrow-down-2"></i>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</section>
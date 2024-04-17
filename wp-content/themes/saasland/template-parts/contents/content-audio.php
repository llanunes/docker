<?php
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
?>
<div <?php post_class( 'blog_list_item blog_list_item_two' ); ?>>

    <div class="audio_player">
        <?php echo do_shortcode( '[audio]' ); ?>
    </div>

    <div class="blog_content">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
            <h3 class="blog_title fw_600"> <?php the_title() ?>  </h3>
        </a>
        <p> <?php echo strip_shortcodes(saasland_excerpt( 'blog_excerpt', false) ); ?> </p>
        <div class="post-info-bottom d-flex justify-content-between">
            <a href="<?php the_permalink() ?>" class="d-inline-block text-uppercase fw_500 text-color-black-theme position-relative">
                <?php echo esc_html($read_more) ?>
                <?php echo saasland_get_icon_svg('saasland-svg-icon', 'arrow_right', '15'); ?>
            </a>
            <a class="post-info-comments" href="<?php the_permalink() ?>#comments">
	            <?php echo saasland_get_icon_svg('saasland-svg-icon', 'comments', '15'); ?>
                <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
            </a>
        </div>
    </div>

</div>

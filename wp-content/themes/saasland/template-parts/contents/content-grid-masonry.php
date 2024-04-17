<?php
$opt = get_option( 'saasland_opt' );
$is_post_meta = isset($opt['is_post_meta']) ? $opt['is_post_meta'] : '1';
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_date = isset($opt['is_post_date']) ? $opt['is_post_date'] : '1';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
$blog_column = !empty($opt['blog_column']) ? $opt['blog_column'] : '6';
$post_title_length = isset($opt['post_title_length']) ? $opt['post_title_length'] : '';
?>

<div <?php post_class("col-lg-$blog_column") ?>>
    <div class="blog_list_item blog_list_item_two">
        <?php
        if ( has_post_thumbnail() && $is_post_date == '1' ) : ?>
            <div class="post_date position-absolute">
                <h2 class="fw_600 mb-0">
                    <?php the_time( 'd' ) ?>
                    <span class="d-block fw-normal"><?php the_time( 'M' ) ?></span>
                </h2>
            </div>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ) ?>
        </a>
        <div class="blog_content">
            <a href="<?php the_permalink() ?>" title="<?php echo the_title_attribute() ?>">
                <h5 class="blog_title">
                    <?php saasland_limit_latter(get_the_title(), $post_title_length); ?>
                </h5>
            </a>
            <p> <?php echo strip_shortcodes(saasland_excerpt( 'blog_excerpt', false)); ?> </p>
            <div class="post-info-bottom d-flex justify-content-between">
                <a href="<?php the_permalink() ?>" class="d-inline-block text-uppercase fw_500 text-color-black-theme position-relative">
                    <?php echo esc_html($read_more) ?>
                    <?php echo saasland_get_icon_svg('saasland-svg-icon', 'arrow_right', '15'); ?>
                </a>
                <a class="post-info-comments text-uppercase fw_500 text-color-black-theme position-relative" href="<?php the_permalink() ?>#comments">
	                <?php echo saasland_get_icon_svg('saasland-svg-icon', 'comments', '15'); ?>
                    <span> <?php saasland_comment_count(get_the_ID()) ?> </span>
                </a>
            </div>
        </div>
    </div>
</div>
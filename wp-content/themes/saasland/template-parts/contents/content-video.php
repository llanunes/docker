<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */
$opt = get_option( 'saasland_opt' );
$blog_excerpt = !empty($opt['blog_excerpt']) ? $opt['blog_excerpt'] : 40;
$is_post_meta = isset($opt['is_post_meta']) ? $opt['is_post_meta'] : '1';
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_date = isset($opt['is_post_date']) ? $opt['is_post_date'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
?>

<div <?php post_class( 'blog_list_item blog_list_item_two' ); ?>>
    <?php
    if (has_post_thumbnail()) :
        if ($is_post_date == '1' ) : ?>
            <div class="post_date position-absolute text-center">
                <h2 class="fw_600 mb-0">
                    <?php the_time( 'd' ) ?>
                    <span class="d-block fw-normal"><?php the_time( 'M' ) ?></span>
                </h2>
            </div>
        <?php endif; ?>
        <div class="video_post position-relative">
            <?php the_post_thumbnail( 'saasland_770x480', array( 'class' => 'img-fluid')) ?>
            <?php
            $video_url = function_exists( 'get_field' ) ? get_field( 'video_url' ) : '';
            if (!empty($video_url)) : ?>
                <a class="popup-youtube video_icon" href="<?php echo esc_url($video_url) ?>">
	                <?php echo saasland_get_icon_svg('saasland-svg-icon', 'arrow_triangle-right', '30'); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    endif;
    ?>
    <div class="blog_content">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
            <h3 class="blog_title fw_600">
                <?php the_title() ?>
            </h3>
        </a>
        <p> <?php saasland_excerpt( 'blog_excerpt' ); ?> </p>
        <div class="post-info-bottom d-flex justify-content-between">
            <a href="<?php the_permalink() ?>" class="learn_btn_two d-inline-block text-uppercase fw_500 text-color-black-theme position-relative">
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

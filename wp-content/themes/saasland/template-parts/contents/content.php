<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */
$opt = get_option( 'saasland_opt' );
$is_post_meta = isset($opt['is_post_meta']) ? $opt['is_post_meta'] : '1';
$is_post_author = isset($opt['is_post_author']) ? $opt['is_post_author'] : '1';
$is_post_date = isset($opt['is_post_date']) ? $opt['is_post_date'] : '1';
$is_post_cat = isset($opt['is_post_cat']) ? $opt['is_post_cat'] : '';
$read_more = isset($opt['read_more']) ? $opt['read_more'] : esc_html__( 'Read More', 'saasland' );
?>

<div <?php post_class( 'blog_list_item blog_list_item_two position-relative' ); ?>>
    <?php
    if ( is_sticky() ) {
        echo '<p class="sticky-label">'.esc_html__( 'Featured', 'saasland' ).'</p>';
    }
    if ( has_post_thumbnail() ) :
        if ( $is_post_date == '1' ) : ?>
            <div class="post_date position-absolute text-center">
                <h2 class="fw_600 mb-0">
                    <?php the_time( 'd' ) ?>
                    <span class="d-block fw-normal"><?php the_time( 'M' ) ?></span>
                </h2>
            </div>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail( 'saasland_770x480', array( 'class' => 'img-fluid')) ?>
        </a>
        <?php
    endif;
    ?>
    <div class="blog_content">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
            <?php the_title('<h3 class="blog_title fw_600">', '</h3>') ?>
        </a>
        <p><?php echo strip_shortcodes(saasland_excerpt( 'blog_excerpt', false)); ?></p>
        <div class="post-info-bottom d-flex justify-content-between">
            <a href="<?php the_permalink() ?>" class="learn_btn_two d-inline-block text-uppercase fw_500 text-color-black-theme position-relative">
                <?php echo esc_html($read_more) ?>
                <?php echo saasland_get_icon_svg('saasland-svg-icon', 'arrow_right', '15'); ?>
            </a>
            <a class="post-info-comments text-uppercase fw_500 text-color-black-theme d-inline-block" href="<?php the_permalink() ?>#comments">
                <?php echo saasland_get_icon_svg('saasland-svg-icon', 'comments', '15'); ?>
                <?php saasland_comment_count(get_the_ID()) ?>
            </a>
        </div>
    </div>
</div>
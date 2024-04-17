<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */
?>
<div <?php post_class( 'blog_list_item qutoe_post' ); ?>>
    <div class="blog_content">
        <i class="fa fa-quote-left"></i>
        <?php saasland_get_html_tag( 'blockquote', get_the_content()); ?>
    </div>
</div>
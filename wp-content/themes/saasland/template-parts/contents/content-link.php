<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package saasland
 */
?>
<div <?php post_class( 'blog_list_item qutoe_post qutoe_post_two' ); ?>>
    <div class="blog_content">
            <i class="icon_link"></i>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                <h5 class="blog_title fw_600"><?php the_title() ?></h5>
            </a>
    </div>
</div>

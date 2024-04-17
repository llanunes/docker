<?php
/**
 * Template Name: Saasland Full-width
 */

get_header();
do_action( 'saaland_after_header');
?>

<div class="full-width-page">
    <?php
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
    ?>
</div>
<?php
get_footer();
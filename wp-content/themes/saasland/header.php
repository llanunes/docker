<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package saasland
 */

// Theme settings options
$opt = get_option( 'saasland_opt' );
$body_class = function_exists('get_field') ? get_field('body_class') : '';

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">

        <!-- For Responsive Device -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <?php wp_head(); ?>
    </head>

    <body <?php body_class($body_class); ?>>
    <?php
    if ( function_exists('wp_body_open') ) {
        wp_body_open();
    }
    /**
     * Saasland Header hook
     * @hooked saasland_header_content_display -- 10
     */
   do_action('saasland_header_content');

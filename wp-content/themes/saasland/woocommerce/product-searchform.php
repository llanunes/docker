<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form role="search" method="get" class="search-form input-group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" name="s" value="<?php echo get_search_query(); ?>" class="form-control search-field" id="search" placeholder="<?php esc_attr_e( 'Search', 'saasland' ) ?>">
    <span class="input-group-addon"><button type="submit"><?php echo saasland_get_icon_svg('saasland-svg-icon', 'ti-search', '14') ?></button></span>
    <input type="hidden" name="post_type" value="product" />
</form>

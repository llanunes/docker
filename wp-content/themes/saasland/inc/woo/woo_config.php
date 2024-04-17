<?php
$opt = get_option( 'saasland_opt' );

// Re-arrange the product tabs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action( 'woocommerce_single_product_after_main_content', 'woocommerce_output_product_data_tabs', 15);

// Re-arrange the related products, upsell product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_single_product_after_main_content', 'woocommerce_upsell_display', 20);
add_action( 'woocommerce_single_product_after_main_content', 'woocommerce_output_related_products', 25);


/**
 * Checkout form fields customizing
 */
add_filter( 'woocommerce_checkout_fields' , function ( $fields ) {

    $woocommerce_checkout_company_field = get_option('woocommerce_checkout_company_field');

    $woocommerce_checkout_phone_field = get_option('woocommerce_checkout_phone_field');
    $woocommerce_checkout_phone_required = ($woocommerce_checkout_phone_field == 'required') ? true : false;

    // Billing Fields
    $fields['billing']['billing_first_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'First name *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-6' ),
        'clear'         => true,
        'required'      => true
    );

    $fields['billing']['billing_last_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Last name *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-6' ),
        'clear'         => true,
        'required'      => true
    );

    $fields['billing']['billing_company'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( "Company name", 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12', $woocommerce_checkout_company_field ),
        'clear'         => true,
        'required'      => ( $woocommerce_checkout_company_field == 'required' ) ? true : false
    );

    $fields['billing']['billing_city'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Town / City *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['billing']['billing_postcode'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Postcode / ZIP (optional)', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['billing']['billing_phone'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Phone', 'placeholder', 'saasland' ),
        'required'      => $woocommerce_checkout_phone_required,
        'class'         => array( 'col-md-6', $woocommerce_checkout_phone_field ),
        'clear'         => true
    );

    $email_column = $woocommerce_checkout_phone_field=='hidden' ? '12' : '6';
    $fields['billing']['billing_email'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Email address *', 'placeholder', 'saasland' ),
        'required'      => true,
        'class'         => array( "col-md-".$email_column ),
        'clear'         => true
    );

    // Shipping Fields
    $fields['shipping']['shipping_first_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'First name *', 'placeholder', 'saasland' ),
        'required'      => false,
        'class'         => array( 'col-md-6' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_last_name'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Last name *', 'placeholder', 'saasland' ),
        'required'      => false,
        'class'         => array( 'col-md-6' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_company'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Company name (optional)', 'placeholder', 'saasland' ),
        'required'      => false,
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_city'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Town / City *', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_postcode'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Postcode / ZIP (optional)', 'placeholder', 'saasland' ),
        'class'         => array( 'col-md-12' ),
        'clear'         => true
    );

    $fields['shipping']['shipping_phone'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Phone', 'placeholder', 'saasland' ),
        'required'      => $woocommerce_checkout_phone_required,
        'class'         => array( 'col-md-6 '.$woocommerce_checkout_phone_field ),
        'clear'         => true
    );

    $fields['shipping']['shipping_email'] = array(
        'label'         => '',
        'placeholder'   => esc_html_x( 'Email address *', 'placeholder', 'saasland' ),
        'required'      => true,
        'class'         => array( 'col-md-6' ),
        'clear'         => true
    );

    return $fields;
});


// Enabling the gallery in themes that declare
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );


// Product Gallery thumbnail size
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 120,
        'height' => 140,
        'crop' => 1,
    );
} );


// WooCommerce review list
function saasland_woocommerce_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    ?>
    <li class="post-comment" id="comment-<?php comment_ID() ?>">
        <div class="comment-content">
            <a href="#" class="avatar">
                <?php echo get_avatar($comment, 70); ?>
            </a>
            <div class="post-body">
                <div class="comment-header">
                    <a href="#"> <?php comment_author(); ?> </a>
                    <?php echo get_comment_time(get_option( 'date_format')); ?>
                </div>
                <div class="rating">
                    <?php woocommerce_review_display_rating() ?>
                </div>
                <?php comment_text() ?>
                <div class="hr mt_30 mb-0"></div>
            </div>
        </div>
    </li>
    <?php
}


// Ajax mini cart update
add_filter( 'woocommerce_add_to_cart_fragments', 'saasland_add_to_cart_fragment', 30, 1 );
function saasland_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start(); ?>

    <a class="cart-btn nav-link dropdown-toggle" href="<?php echo wc_get_cart_url() ?>" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo saasland_get_icon_svg('saasland-svg-icon', 'ti-bag', '20') ?>
        <span class="num">
            <?php echo esc_html( $woocommerce->cart->cart_contents_count); ?>
        </span>
    </a>
    <?php
    $fragments['a.cart-btn'] = ob_get_clean();

    return $fragments;
}


add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start(); ?>

    <ul class="dropdown-menu saasland_ajax_minicart">
        <?php woocommerce_mini_cart(); ?>
    </ul>
    <?php $fragments['ul.dropdown-menu.saasland_ajax_minicart'] = ob_get_clean();

    return $fragments;

} );


/**
 * AJAX Quick View function for products.
 */
add_action('wp_ajax_saasland_product_quick_view', 'product_quick_view_ajax');
add_action('wp_ajax_nopriv_saasland_product_quick_view','product_quick_view_ajax');

function product_quick_view_ajax() {
    if(! isset($_REQUEST['product_id'])) {
        die();
    }

    $product_id = intval($_REQUEST['product_id']);
    wp('p='.$product_id.'&post_type=product');
    ob_start();

    while (have_posts()) : the_post();
        global $product;
        $sku = $product->get_sku() ? $product->get_sku() : esc_html__( 'N/A', 'saasland' ); ?>
        <div id="product-<?php the_ID(); ?>" <?php post_class('row product'); ?>>
            <div class="col-lg-6">
                <div class="product_slider">
                    <?php the_post_thumbnail('saasland_455x600', array('class' => 'img-fluid')); ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="pr_details">
                    <?php do_action( 'woocommerce_single_product_summary' ); ?>
                </div>
            </div>
        </div>
        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {

                    $(".ar_top").on("click", function () {
                        var getID = $(this).next().attr("id");
                        var result = document.getElementById(getID);
                        var qty = result.value;
                        if (!isNaN(qty)) {
                            result.value++;
                            $('.cart_btn.ajax_add_to_cart').attr('data-quantity', result.value )
                        } else {
                            return false;
                        }

                    });

                    $(".ar_down").on("click", function () {
                        var getID = $(this).prev().attr("id");
                        var result = document.getElementById(getID);
                        var qty = result.value;

                        if (!isNaN(qty) && qty > 0) {
                            result.value--;
                            $('.cart_btn.ajax_add_to_cart').attr('data-quantity', result.value )
                        } else {
                            return false;
                        }

                    });

                });
            })(jQuery);
        </script>
    <?php
    endwhile;

    echo ob_get_clean();

    die();
}

add_action('init', 'dl_clean_output_buffer');
function dl_clean_output_buffer() {
    ob_start();
}
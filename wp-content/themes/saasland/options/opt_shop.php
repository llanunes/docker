<?php
// Shop page
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Shop', 'saasland' ),
    'id'               => 'shop_opt',
    'icon'             => 'dashicons dashicons-cart',
    'fields'           => array(

        array(
            'title'     => esc_html__( 'Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the product view layout', 'saasland' ),
            'id'        => 'shop_layout',
            'type'      => 'image_select',
            'options'   => array(
                'shop_list' => array(
                    'alt' => esc_html__( 'List Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/list.jpg'
                ),
                'shop_grid' => array(
                    'alt' => esc_html__( 'Grid Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/grid.jpg'
                ),
            ),
            'default' => 'shop_grid'
        ),

        array(
            'title'     => esc_html__( 'Sidebar', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the sidebar position of Shop page', 'saasland' ),
            'id'        => 'shop_sidebar',
            'type'      => 'image_select',
            'options'   => array(
                'left' => array(
                    'alt' => esc_html__( 'Left Sidebar', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/sidebar_left.jpg'
                ),
                'right' => array(
                    'alt' => esc_html__( 'Right Sidebar', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/sidebar_right.jpg',
                ),
                'full' => array(
                    'alt' => esc_html__( 'Full Width', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/fullwidth.png',
                ),
            ),
            'default' => 'left'
        ),

        array(
            'title'     => esc_html__( 'Add to Cart Icon', 'saasland' ),
            'id'        => 'is_add_to_cart',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'title'     => esc_html__( 'Light-box Icon', 'saasland' ),
            'id'        => 'is_product_lightbox',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
    ),
));


// Product Single Options
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Product Archive', 'saasland' ),
    'id'               => 'product_archive_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Product Archive Title', 'saasland' ),
            'id'        => 'product_archive_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Product Archive', 'saasland' ),
        ),


    )
));

// Product Single Options
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Product Single', 'saasland' ),
    'id'               => 'product_single_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Related Products Title', 'saasland' ),
            'id'        => 'related_products_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Related products', 'saasland' ),
        ),

        array(
            'title'     => esc_html__( 'Related Products Subtitle', 'saasland' ),
            'id'        => 'related_products_subtitle',
            'type'      => 'textarea',
        ),
        array(
            'title'     => esc_html__( 'Product Category', 'saasland' ),
            'id'        => 'is_product_category',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'title'     => esc_html__( 'Product Tags', 'saasland' ),
            'id'        => 'is_product_tags',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'title'     => esc_html__( 'Product Share', 'saasland' ),
            'id'        => 'is_product_share',
            'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
        ),
        array(
            'id'       => 'is_product_social_share_links',
            'type'     => 'checkbox',
            'title'    => __('Checked Share Links', 'saasland'),
            'options'  => array(
                'facebook' => __('Facebook', 'saasland'),
                'twitter'  => __('Twitter', 'saasland'),
                'pinterest'=> __('Pinterest', 'saasland'),
                'linkedin' => __('Linkedin', 'saasland')
            ),
            'default' => array(
                'facebook'  => '1', 
                'twitter'   => '1', 
                'pinterest' => '0',
                'linkedin' => '1'
            ),
            'required' => ['is_product_share', '=', '1']
        ),

    )
));
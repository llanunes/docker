<?php
// Header Section
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Header', 'saasland' ),
    'id'               => 'header_sec',
    'customizer_width' => '400px',
    'icon'             => 'el el-arrow-up',
));

/**
 * Logo
 */
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Logo', 'saasland' ),
    'id'               => 'logo_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Main Logo', 'saasland' ),
            'subtitle'  => esc_html__( 'Upload here a image file for your logo', 'saasland' ),
            'id'        => 'main_logo',
            'type'      => 'media',
            'compiler'  => true,
            'default'   => array(
                'url'   => SAASLAND_DIR_IMG.'/logo.png'
            )
        ),

        array(
            'title'     => esc_html__( 'Sticky Logo', 'saasland' ),
            'id'        => 'sticky_logo',
            'type'      => 'media',
            'compiler'  => true,
            'default'   => array(
                'url'   => SAASLAND_DIR_IMG.'/logo2.png'
            )
        ),

        array(
            'title'     => esc_html__( 'Main Retina Logo', 'saasland' ),
            'subtitle'  => esc_html__( 'The retina logo should be double (2x) of your original logo', 'saasland' ),
            'id'        => 'retina_logo',
            'type'      => 'media',
            'compiler'  => true,
            'default'   => array(
                'url'   => SAASLAND_DIR_IMG.'/logo_default_retina.png'
            )
        ),

        array(
            'title'     => esc_html__( 'Sticky Retina Logo', 'saasland' ),
            'subtitle'  => esc_html__( 'The retina logo should be double (2x) of your original logo', 'saasland' ),
            'id'        => 'retina_sticky_logo',
            'type'      => 'media',
            'compiler'  => true,
            'default'   => array(
                'url'   => SAASLAND_DIR_IMG.'/logo_sticky_retina.png'
            )
        ),

        array(
            'title'     => esc_html__( 'Logo dimensions', 'saasland' ),
            'subtitle'  => esc_html__( 'Set a custom height, width for your upload logo.', 'saasland' ),
            'id'        => 'logo_dimensions',
            'type'      => 'dimensions',
            'units'     => array( 'em','px','%' ),
            'output'    => array( '.navbar-brand>img' )
        ),

        array(
            'title'     => esc_html__( 'Padding', 'saasland' ),
            'subtitle'  => esc_html__( 'Padding around the logo. Input the padding as clockwise (Top Right Bottom Left)', 'saasland' ),
            'id'        => 'logo_padding',
            'type'      => 'spacing',
            'output'    => array( '.header_area .navbar-brand' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
        ),
    )
) );

/**
 * Header Content
 */
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Header Content', 'saasland' ),
    'id'               => 'header_content_sec',
    'customizer_width' => '400px',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Header Template', 'saasland' ),
            'subtitle'  => __( 'Navigate to Headers > Add New from your WordPress dashboard to add a new Header Template. Learn more <a href="https://is.gd/ODCIjp" target="_blank">here</a>', 'saasland' ),
            'id'        => 'header_style',
            'type'      => 'select',
            'options'   => saasland_get_postTitleArray( 'header' )
        ),

        array(
            'title'     => esc_html__( 'Navbar Type', 'saasland' ),
            'subtitle'  => __( 'Select the menu type which menu type you want to use for the whole website.', 'saasland' ),
            'id'        => 'navbar_type',
            'type'      => 'select',
            'default'   => 'classic',
            'options'   => array(
                'classic'   => esc_html__( 'Classic Default Menu', 'saasland' ),
                'hamburger' => esc_html__( 'Hamburger Overlay Menu', 'saasland' ),
            )
        ),

        array(
            'id'        => 'is_header_sticky',
            'type'      => 'switch',
            'title'     => esc_html__( 'Header Sticky', 'saasland' ),
            'on'        => esc_html__( 'Enable', 'saasland' ),
            'off'       => esc_html__( 'Disable', 'saasland' ),
            'default'   => true,
        ),

        array(
            'title'     => esc_html__( 'Mini Cart', 'saasland' ),
            'subtitle'  => esc_html__( 'Mini Cart icon visibility on the header.', 'saasland' ),
            'id'        => 'is_mini_cart',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => false,
        ),

        array(
            'id'        => 'is_search',
            'type'      => 'switch',
            'title'     => esc_html__( 'Search', 'saasland' ),
            'subtitle'     => esc_html__( 'Show/Hide the Search icon on the header.', 'saasland' ),
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => true,
        ),
    )
));

/**
 * Header Styling
 */
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Header Styling', 'saasland' ),
    'id'               => 'header_styling_sec',
    'customizer_width' => '400px',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Navbar box layout', 'saasland' ),
            'id'        => 'nav_layout',
            'type'      => 'select',
            'default'   => 'boxed',
            'options'   => array(
                'boxed' => esc_html__( 'Boxed', 'saasland' ),
                'wide' => esc_html__( 'Wide', 'saasland' ),
                'full_width' => esc_html__( 'Full Width', 'saasland' ),
            )
        ),

        array(
            'title'     => esc_html__( 'Menu Alignment', 'saasland' ),
            'id'        => 'menu_alignment',
            'type'      => 'select',
            'options'   => array(
                'menu_left'     => esc_html__( 'Left', 'saasland' ),
                'menu_center'   => esc_html__( 'Center', 'saasland' ),
                'menu_right'    => esc_html__( 'Right', 'saasland' ),
            ),
            'default'   => 'menu_center'
        ),
        array(
            'title'     => esc_html__( 'Header Background Color', 'saasland' ),
            'id'        => 'is_header_bg',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => false
        ),
        array(
            'id'        => 'header_bg_color',
            'type'      => 'color',
            'title'     => esc_html__( 'Header Background', 'saasland' ),
            'subtitle'  => esc_html__( 'Header background color', 'saasland' ),
            'mode'      => 'background',
            'output'    => array( "header.header_area.has_header_bg" ),
            'required'  => array( 'is_header_bg', '=', '1' )
        ),

        array(
            'id'        => 'header_sticky_bg_color',
            'type'      => 'color',
            'title'     => esc_html__( 'Header Sticky Background', 'saasland' ),
            'subtitle'  => esc_html__( 'Background color on Header sticky mode', 'saasland' ),
            'mode'      => 'background',
            'output'    => array( ".header_area.navbar_fixed" )
        ),
    )
));

/**
 * Header top
 */
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Header Top', 'saasland' ),
    'id'               => 'header_top_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'id'        => 'header_top_warning',
            'type'      => 'info',
            'style'     => 'warning',
            'title'      => esc_html__( 'Warning', 'saasland' ),
            'desc'      => esc_html__( 'The Header Top settings will not apply, if you select a custom Header Template from the Header Settings > Header Content.', 'saasland' ),

        ),
        array(
            'id'        => 'is_header_top',
            'type'      => 'switch',
            'title'     => esc_html__( 'Header Top Part', 'saasland' ),
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '',
        ),

        // Header Top Left Contents
        array(
            'id' => 'header_top_left_start',
            'type' => 'section',
            'title' => esc_html__( 'Left Contents', 'saasland' ),
            'indent' => true,
            'required'  => array( 'is_header_top', '=', '1' ),
        ),
        array(
            'title'     => esc_html__( 'Left Content', 'saasland' ),
            'id'        => 'header_top_left_content',
            'type'      => 'editor',
            'default'   => '<ul>
                                <li>Email:<a href="">saasland@gmail.com</a></li>
                                <li>phone:<a href="">+978 254 658 784</a></li>
                            </ul>',
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
                'quicktags'     => false,
            ),
        ),
        array(
            'id'     => 'header_top_left_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Header Top Left Contents

        array(
            'id' => 'header_top_right_start',
            'type' => 'section',
            'title' => esc_html__( 'Right Contents', 'saasland' ),
            'indent' => true,
            'required'  => array( 'is_header_top', '=', '1' ),
        ),
        
        array(
            'id'        => 'is_header_top_social',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Social Links', 'saasland' ),
            'subtitle' => sprintf(
                '%1$s <a href="%2$s"> %3$s </a> %4$s',
                esc_html__( 'Social links are getting from', 'saasland' ),
                get_admin_url(null, '?page=Saasland&tab=30' ),
                esc_html__( 'Social Links', 'saasland' ),
                esc_html__( 'Settings', 'saasland' )
            ),
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => true,
        ),

        array(
            'title'     => esc_html__( 'Right Content', 'saasland' ),
            'subtitle'  => esc_html__( 'This contents will be placed instead of the Social Links', 'saasland' ),
            'id'        => 'header_top_right_content',
            'type'      => 'editor',
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                'teeny'         => false,
                'quicktags'     => false,
            ),
            'required' => array( 'is_header_top_social', '!=', '1' )
        ),
        array(
            'id'     => 'header_top_right_end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Header Top Styling
        array(
            'id' => 'header_top_styling_start',
            'type' => 'section',
            'title' => esc_html__( 'Styling', 'saasland' ),
            'indent' => true,
            'required'  => array( 'is_header_top', '=', '1' ),
        ),
        array(
            'title'         => esc_html__( 'Typography', 'saasland' ),
            'id'            => 'header_top_text_typo',
            'type'          => 'typography',
            'text-align'    => false,
            'output'        => array( '.header_area .header_top .header_top_column, .header_area .header_top ul p, .header_area .header_top ul li' ),
        ),
        array(
            'title'     => esc_html__( 'Link Color', 'saasland' ),
            'id'        => 'header_top_link_color',
            'type'      => 'link_color',
            'output'    => array( '.header_area .header_top a' ),
        ),
        array(
            'title'     => esc_html__( 'Background Color', 'saasland' ),
            'id'        => 'header_top_bg_color',
            'type'      => 'color',
            'output'    => array( '.header_area .header_top' ),
            'mode'      => 'background'
        ),
        array(
            'title'     => esc_html__( 'Separator Color', 'saasland' ),
            'id'        => 'header_top_separator_color',
            'type'      => 'color',
            'output'    => array( '.header_area .header_top ul li:before' ),
            'mode'      => 'background'
        ),
        array(
            'id'     => 'header_top_styling_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

/**
 * Action button
 */
Redux::set_section( 'saasland_opt', array(
    'title'            => esc_html__( 'Action Button', 'saasland' ),
    'id'               => 'menu_action_btn_opt',
    'subsection'       => true,
    'icon'             => '',
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Button Visibility', 'saasland' ),
            'id'        => 'is_menu_btn',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
        ),

        array(
            'title'     => esc_html__( 'Button Style', 'saasland' ),
            'id'        => 'btn_style',
            'type'      => 'image_select',
            'required'  => array( 'is_menu_btn', '=', '1' ),
            'default'   => '1',
            'options'   => array(
                '1' => array(
                    'alt' => esc_html__( 'Button 01', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/buttons/1.jpg'
                ),
                '2' => array(
                    'alt' => esc_html__( 'Button 02', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/buttons/2.jpg'
                ),
                '3' => array(
                    'alt' => esc_html__( 'Button 03', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/buttons/3.jpg'
                ),
            )
        ),

        array(
            'title'     => esc_html__( 'Button label', 'saasland' ),
            'subtitle'  => esc_html__( 'Leave the button label field empty to hide the menu action button.', 'saasland' ),
            'id'        => 'menu_btn_label',
            'type'      => 'text',
            'default'   => esc_html__( 'Get Started', 'saasland' ),
            'required'  => array( 'is_menu_btn', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Button URL', 'saasland' ),
            'id'        => 'menu_btn_url',
            'type'      => 'text',
            'default'   => '#',
            'required'  => array( 'is_menu_btn', '=', '1' )
        ),
        array(
            'title'     => esc_html__( 'Button Target', 'saasland' ),
            'id'        => 'is_target_blank',
            'type'      => 'switch',
            'on'        => esc_html__( 'On', 'saasland' ),
            'off'       => esc_html__( 'Off', 'saasland' ),
            'required'  => array( 'is_menu_btn', '=', '1' )
        ),
        array(
            'id'          => 'header_action_btn_typo',
            'type'        => 'typography',
            'title'       => __('Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'color'       => false,
            'output'      => array('#navbarSupportedContent a.btn_get'),
            'units'       => 'px',
            'required'  => array( 'is_menu_btn', '=', '1' )
        ),
        array(
            'title'     => esc_html__( 'Button Font Size', 'saasland' ),
            'id'        => 'menu_btn_size',
            'type'      => 'spinner',
            'default'   => '14',
            'min'       => '12',
            'step'      => '1',
            'max'       => '50',
            'required'  => array( 'is_menu_btn', '=', '1' )
        ),


        /**
         * Button colors
         * Style will apply on the Non sticky mode and sticky mode of the header
         */
        array(
            'title'     => esc_html__( 'Button Colors', 'saasland' ),
            'subtitle'  => esc_html__( 'Button style attributes on normal (non sticky) mode.', 'saasland' ),
            'id'        => 'button_colors',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array( 'is_menu_btn', '=', '1' ),
        ),

        array(
            'title'     => esc_html__( 'Font color', 'saasland' ),
            'id'        => 'menu_btn_font_color',
            'type'      => 'color',
            'output'    => array( '.header_area .navbar .btn_get' ),
        ),
        
        array(
            'title'     => esc_html__( 'Border Color', 'saasland' ),
            'id'        => 'menu_btn_border_color',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.header_area .navbar .btn_get' ),
        ),
        
        array(
            'title'     => esc_html__( 'Background Color', 'saasland' ),
            'id'        => 'menu_btn_bg_color',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array( '.header_area .navbar .btn_get' ),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__( 'Hover Font Color', 'saasland' ),
            'subtitle'  => esc_html__( 'Font color on hover stats.', 'saasland' ),
            'id'        => 'menu_btn_hover_font_color',
            'type'      => 'color',
            'output'    => array( '.header_area .navbar .btn_get:hover' ),
        ),
        array(
            'title'     => esc_html__( 'Hover Border Color', 'saasland' ),
            'id'        => 'menu_btn_hover_border_color',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.header_area .navbar .btn_get:hover' ),
        ),
        array(
            'title'     => esc_html__( 'Hover background color', 'saasland' ),
            'subtitle'  => esc_html__( 'Background color on hover stats.', 'saasland' ),
            'id'        => 'menu_btn_hover_bg_color',
            'type'      => 'color',
            'output'    => array(
                'background' => '.header_area .navbar .btn_get:hover',
                'border-color' => '.navbar_fixed .header_area .navbar .btn_get:hover'
            ),
        ),
        array(
            'id'     => 'button_colors-end',
            'type'   => 'section',
            'indent' => false,
        ),

        /*
         * Button colors on sticky mode
         */
        array(
            'title'     => esc_html__( 'Sticky Button Style', 'saasland' ),
            'subtitle'  => esc_html__( 'Button colors on sticky mode.', 'saasland' ),
            'id'        => 'button_colors_sticky',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array( 'is_menu_btn', '=', '1' ),
        ),
        array(
            'title'     => esc_html__( 'Border color', 'saasland' ),
            'id'        => 'menu_btn_border_color_sticky',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.navbar_fixed.header_area .navbar .btn_get' ),
        ),
        array(
            'title'     => esc_html__( 'Font color', 'saasland' ),
            'id'        => 'menu_btn_font_color_sticky',
            'type'      => 'color',
            'output'    => array( '.navbar_fixed.header_area .navbar .btn_get' ),
        ),
        array(
            'title'     => esc_html__( 'Background color', 'saasland' ),
            'id'        => 'menu_btn_bg_color_sticky',
            'type'      => 'color',
            'mode'      => 'background',
            'output'    => array( '.navbar_fixed.header_area .navbar .btn_get' ),
        ),

        // Button color on hover stats
        array(
            'title'     => esc_html__( 'Hover font color', 'saasland' ),
            'subtitle'  => esc_html__( 'Font color on hover stats.', 'saasland' ),
            'id'        => 'menu_btn_hover_font_color_sticky',
            'type'      => 'color',
            'output'    => array( '.header_area.navbar_fixed .navbar .btn_get.btn-meta:hover' ),
        ),
        array(
            'title'     => esc_html__( 'Hover background color', 'saasland' ),
            'subtitle'  => esc_html__( 'Background color on hover stats.', 'saasland' ),
            'id'        => 'menu_btn_hover_bg_color_sticky',
            'type'      => 'color',
            'output'    => array(
                'background' => '.header_area.navbar_fixed .navbar .btn_get.btn-meta:hover',
            ),
        ),
        array(
            'title'     => esc_html__( 'Hover border color', 'saasland' ),
            'subtitle'  => esc_html__( 'Background color on hover stats.', 'saasland' ),
            'id'        => 'menu_btn_hover_border_color_sticky',
            'type'      => 'color',
            'output'    => array(
                'border-color' => '.header_area.navbar_fixed .navbar .btn_get.btn-meta:hover',
            ),
        ),

        array(
            'id'     => 'button_colors-sticky-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'title'     => esc_html__( 'Button padding', 'saasland' ),
            'subtitle'  => esc_html__( 'Padding around the menu action button.', 'saasland' ),
            'id'        => 'menu_btn_padding',
            'type'      => 'spacing',
            'output'    => array( '.btn_get' ),
            'mode'      => 'padding',
            'units'     => array( 'em', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true',
            'required'  => array( 'is_menu_btn', '=', '1' )
        ),
    )
));
<?php
// ============================= Inline Style Render ====================================//
$dynamic_css = '';
$opt = get_option( 'saasland_opt' );

/**
 * Options from Theme Settings
 */
if ( class_exists('ReduxFrameworkPlugin') ) {

    /**
     * Post banner height
     */
    if ( !empty($opt['post_banner_height']) ) {
        $dynamic_css .= ".blog_breadcrumb_area{height: {$opt['post_banner_height']}px;}";
    }

    /**
     * Mobile Menu Settings
     */
    if ( !empty($opt['mobile_menu_dropdown_bg']) ) {
        $dynamic_css .= "
            @media (max-width: 991px) {
                ul#menu-main-menu, .menu>.nav-item.submenu .dropdown-menu .nav-item {
                    background: {$opt['mobile_menu_dropdown_bg']} !important;
                }
            }";
    }
    if ( !empty($opt['mobile_menu_font_color']) ) {
        $dynamic_css .= "
            @media (max-width: 991px) {
                header.header_area .menu > .nav-item > .nav-link, 
                .header_area .navbar .navbar-nav .menu-item a, 
                .menu>.nav-item.submenu .dropdown-menu .nav-item .nav-link {
                    color: {$opt['mobile_menu_font_color']} !important;
                }
            }";
    }
    if ( !empty($opt['mobile_menu_separator_color']) ) {
        $dynamic_css .= "
            @media (max-width: 991px) {
                .menu>.nav-item {
                    border-bottom-color: {$opt['mobile_menu_separator_color']['rgba']} !important;
                }
            }";
    }

    //404 Gradient Color
    if ( !empty($opt['bg_gradient_color']['from']) ) {
        $dynamic_css .= "
            .error_area {
                background:-webkit-linear-gradient(180deg, ".esc_attr($opt['bg_gradient_color']['from'])." 0%, {$opt['bg_gradient_color']['to']} 100%);
            }";
    }

    // 404 background shape
    if ( !empty($opt['error_bg_shape_image']['url']) ) {
        $dynamic_css .= "
                .error_area {
                    background: url({$opt['error_bg_shape_image']['url']} ) no-repeat scroll center 100%;
                }";
    }

    /**
     * Preloader
     */
    // $is_preloader = !empty($opt['is_preloader'] ) ? $opt['is_preloader'] : '';
    // $preloader_image = isset($opt['preloader_image']['url'] ) ? $opt['preloader_image']['url'] : SAASLAND_DIR_IMG.'/status.gif';
    // $preloader_style = !empty($opt['preloader_style'] ) ? $opt['preloader_style'] : 'text';
    // if ( $preloader_style == 'image' && $is_preloader == '1' ) {
    //     $dynamic_css .= "
    //         #status {
    //             background-repeat: no-repeat;
    //             background-position: center;
    //             background-color: green;
                
    //         }";
    // }

    /**
     * Banner Title-bar
     */
    if ( !empty($opt['banner_overlay_color']['from']) ) {
        $dynamic_css .= "
            .breadcrumb_area:before, .breadcrumb_area_two {
                background-image: -moz-linear-gradient(180deg, " . esc_attr($opt['banner_overlay_color']['from'] ) . " 0%, {$opt['banner_overlay_color']['to']} 100%);
                background-image: -webkit-linear-gradient(180deg, " . esc_attr($opt['banner_overlay_color']['from'] ) . " 0%, {$opt['banner_overlay_color']['to']} 100%);
                background-image: -ms-linear-gradient(180deg, " . esc_attr($opt['banner_overlay_color']['from'] ) . " 0%, {$opt['banner_overlay_color']['to']} 100%);
                opacity:{$opt['banner_overlay_color_opacity']};
            }";
    }

    if ( !empty($opt['blog_banner_overlay_color']['from']) ) {
        $dynamic_css .= "
            .breadcrumb_area.blog_title_bar:before {
                background-image: -moz-linear-gradient(180deg, " . esc_attr($opt['blog_banner_overlay_color']['from'] ) . " 0%, {$opt['blog_banner_overlay_color']['to']} 100%);
                background-image: -webkit-linear-gradient(180deg, " . esc_attr($opt['blog_banner_overlay_color']['from'] ) . " 0%, {$opt['blog_banner_overlay_color']['to']} 100%);
                background-image: -ms-linear-gradient(180deg, " . esc_attr($opt['blog_banner_overlay_color']['from'] ) . " 0%, {$opt['blog_banner_overlay_color']['to']} 100%);
            }";
    }



    if ( is_singular('post') && !empty($opt['post_banner_overlay_color']['from'] && !empty($opt['post_banner_overlay_color']['to']) ) ) {
       // $pb_opacity = !empty($opt['post_banner_overlay_opacity']) ? "opacity:{$opt['post_banner_overlay_opacity']};" : '';
        $dynamic_css .= "
            .blog_breadcrumb_area {
                background-image: -moz-linear-gradient(-140deg, {$opt['post_banner_overlay_color']['to']} 0%, {$opt['post_banner_overlay_color']['from']} 100%);
                background-image: -webkit-linear-gradient(-140deg, {$opt['post_banner_overlay_color']['to']} 0%, {$opt['post_banner_overlay_color']['from']} 100%);
                background-image: -ms-linear-gradient(-140deg, {$opt['post_banner_overlay_color']['to']} 0%, {$opt['post_banner_overlay_color']['from']} 100%);
                
            }";
    }
    if ( !empty($opt['post_banner_bg']['url']) ) {
        $dynamic_css .= " .blog_breadcrumb_area{ background: url({$opt['post_banner_bg']['url']}) no-repeat scroll center 0 / cover; }";
    }

    if ( class_exists('WooCommerce') ) {
        if ( is_shop() ) {
            $shop_header_bg = !empty($opt['shop_header_bg']['url']) ? $opt['shop_header_bg']['url'] : '';
            if ( !empty($shop_header_bg) ) {
                $dynamic_css .= ".shop .breadcrumb_area::after { content: ''; position: absolute; background-color: $shop_header_bg; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; }";
            }
        }
    }

    /**
     * Footer Images
     */
    if ( !empty($opt['footer_bg_image']['url']) ) {
        $dynamic_css .= "
            .new_footer_top .footer_bg {
                background: url({$opt['footer_bg_image']['url']} ) no-repeat scroll center 0 !important;
            }
        ";
    }
    if ( !empty($opt['footer_obj_1']['url']) ) {
        $dynamic_css .= "
            .new_footer_top .footer_bg .footer_bg_one {
                background: url({$opt['footer_obj_1']['url']} ) no-repeat center center !important;
            }
        ";
    }
    if ( !empty($opt['footer_obj_2']['url']) ) {
        $dynamic_css .= "
            .new_footer_top .footer_bg .footer_bg_two {
                background: url({$opt['footer_obj_2']['url']} ) no-repeat center center !important;
            }
        ";
    }

    if( is_singular( 'portfolio' ) ){
        $color_1 = !empty( $opt['portfolio_bg_1']['rgba'] ) ? $opt['portfolio_bg_1']['rgba'] : '#00000005';
        $color_2 = !empty( $opt['portfolio_bg_2']['rgba'] ) ? $opt['portfolio_bg_2']['rgba'] : $color_1;
        $bg_image= !empty( $opt['portfolio_titlebar_bg']['url'] ) ? ' background : url( '.$opt['portfolio_titlebar_bg']['url'].' )' : '';
        $dynamic_css .= "
                .single-portfolio section.breadcrumb_area{
                    $bg_image;
                }
                .single-portfolio section.breadcrumb_area:before {
                    background-image: -webkit-linear-gradient(180deg,{$color_1} 0,{$color_2} 100%);
                }";
    }
    if( is_singular( 'service' ) ){
        $color_1 = !empty( $opt['service_bg_1']['rgba'] ) ? $opt['service_bg_1']['rgba'] : '#00000005';
        $color_2 = !empty( $opt['service_bg_2']['rgba'] ) ? $opt['service_bg_2']['rgba'] : $color_1;
        $bg_image= !empty( $opt['service_titlebar_bg']['url'] ) ? ' background : url( '.$opt['service_titlebar_bg']['url'].' )' : '';
        $dynamic_css .= "
                .single-service section.breadcrumb_area{
                    $bg_image;
                }
                .single-service section.breadcrumb_area:before {
                    background-image: -webkit-linear-gradient(180deg,{$color_1} 0,{$color_2} 100%);
                }";
    }
    if( is_singular( 'case_study' ) ){
        $color_1 = !empty( $opt['service_bg_1']['rgba'] ) ? $opt['service_bg_1']['rgba'] : '#00000005';
        $color_2 = !empty( $opt['service_bg_2']['rgba'] ) ? $opt['service_bg_2']['rgba'] : $color_1;
        $bg_image= !empty( $opt['service_titlebar_bg']['url'] ) ? ' background : url( '.$opt['service_titlebar_bg']['url'].' )' : '';
        $dynamic_css .= "
                .single-service section.breadcrumb_area{
                    $bg_image;
                }
                .single-service section.breadcrumb_area:before {
                    background-image: -webkit-linear-gradient(180deg,{$color_1} 0,{$color_2} 100%);
                }";
    }
}


/**
 * Dynamic CSS render for Page
 */
if ( function_exists('get_field') ) {
    /**
     * Banner Styling
     */
    $banner_text_color = get_field('banner_text_color');
    if ( !empty($banner_text_color) ) {
        $dynamic_css .= ".breadcrumb_content h1, .breadcrumb_content p { color: $banner_text_color; }";
    }


    // Banner Overlay Color
    $banner_bg_type = function_exists('get_field') ? get_field('banner_background_type') : '';
    $banner_overlay_color = get_field('banner_overlay_color');
    if ( !empty($banner_overlay_color) && $banner_bg_type == 'image' ) {
        $dynamic_css .= ".breadcrumb_area::after {content: ''; position: absolute; background-color: $banner_overlay_color; width: 100%; height: 100%; top: 0; left: 0; z-index: -1;}";
    }

    // Title-bar Banner Background Gradient Colors
    $banner_bg_color_right = function_exists( 'get_field' ) ? get_field( 'background_color_right' ) : '';
    if ( !empty($banner_bg_color_right) && $banner_bg_type == 'color' ) {
        $dynamic_css .= "
            .breadcrumb_area {
                background-image: -moz-linear-gradient(180deg, " . esc_attr(get_field( 'background_color_right' ) ) . " 0%, " . get_field( 'background_color_left' ) . " 100% ) !important;
                background-image: -webkit-linear-gradient(180deg, " . esc_attr(get_field( 'background_color_right' ) ) . " 0%, " . get_field( 'background_color_left' ) . " 100% ) !important;
                background-image: -ms-linear-gradient(180deg, " . esc_attr(get_field( 'background_color_right' ) ) . " 0%, " . get_field( 'background_color_left' ) . " 100% ) !important;
            }";
    }

    // Single post banner colors
    if ( is_singular( 'post' ) ) {
        $post_banner_text_color = get_field('post_banner_text_color');
        $banner_color_opacity = get_field('banner_color_opacity');
        $banner_background_color_right = get_field('background_color_right');
        $banner_background_color_left = get_field('background_color_left');
        if ( !empty($post_banner_text_color) ) {
            $dynamic_css .= ".blog_breadcrumb_area .breadcrumb_content_two h1, .blog_breadcrumb_area .breadcrumb_content_two, .blog_breadcrumb_area .breadcrumb_content_two h5 a, .blog_breadcrumb_area .breadcrumb_content_two ol li a { color: $post_banner_text_color; }";
        }
        if ( !empty($banner_color_opacity) ) {
            $dynamic_css .= ".blog_breadcrumb_area .background_overlay{opacity: 0.$banner_color_opacity;}";
        }
        if ( !empty($banner_background_color_left) && !empty($banner_background_color_right) ) {
            $dynamic_css .= "
                .blog_breadcrumb_area .background_overlay {
                    background-image: -moz-linear-gradient(-140deg, $banner_background_color_right 0%, $banner_background_color_left 100%);
                    background-image: -webkit-linear-gradient(-140deg, $banner_background_color_right 0%, $banner_background_color_left 100%);
                    background-image: -ms-linear-gradient(-140deg, $banner_background_color_right 0%, $banner_background_color_left 100%);
                }";
        }
    }

    /**
     * Customize the Action Button
     */
    $customize_button = get_field( 'customize_the_button' );
    if ( $customize_button == '1' ) {
        $btn_font_size = get_field( 'font_size' );
        $btn_border_width = get_field( 'border_width' );
        $btn_shadow = get_field( 'shadow' );
        $btn_border_radius = get_field( 'border_radious' );
        $btn_normal = get_field( 'normal' );
        $sticky_btn_normal = get_field( 'sticky_normal' );
        $btn_hover = get_field( 'hover' );
        $sticky_btn_hover = get_field( 'sticky_hover' );

        $btn_hover_background_color = !empty($btn_hover['background_color'] ) ? "background: {$btn_hover['background_color']};" : '';
        $btn_hover_font_color = !empty($btn_hover['font_color'] ) ? "color: {$btn_hover['font_color']};" : '';
        $btn_hover_border_color = !empty($btn_hover['border_color'] ) ? "border-color: {$btn_hover['border_color']};" : '';
        $btn_hover_shadow = (isset($btn_hover['box_shadow'] ) && $btn_hover['box_shadow'] == '1' ) ? "-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1); box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1);" : 'box-shadow: none;';

        $btn_normal_background_color = !empty($btn_normal['background_color'] ) ? "background: {$btn_normal['background_color']};" : '';
        $btn_normal_font_color = !empty($btn_normal['font_color'] ) ? "color: {$btn_normal['font_color']};" : '';
        $btn_normal_border_color = !empty($btn_normal['border_color'] ) ? "border-color: {$btn_normal['border_color']};" : '';
        $btn_normal_shadow = (isset($btn_normal['box_shadow'] ) && $btn_normal['box_shadow'] == '1' ) ? "-webkit-box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1); box-shadow: 0px 10px 20px 0px rgba(0, 11, 40, 0.1);" : 'box-shadow: none;';

        $btn_border_radius_top_left = !empty($btn_border_radius['top_left'] ) || $btn_border_radius['top_left'] == '0' ? "border-top-left-radius: {$btn_border_radius['top_left']}px;" : '';
        $btn_border_radius_top_right = !empty($btn_border_radius['top_right'] ) || $btn_border_radius['top_right'] == '0' ? "border-top-right-radius: {$btn_border_radius['top_right']}px;" : '';
        $btn_border_radius_bottom_right = !empty($btn_border_radius['bottom-right'] ) || $btn_border_radius['bottom-right'] == '0' ? "border-bottom-right-radius: {$btn_border_radius['bottom-right']}px;" : '';
        $btn_border_radius_bottom_left = !empty($btn_border_radius['bottom-left'] ) || $btn_border_radius['bottom-left'] == '0' ? "border-bottom-left-radius: {$btn_border_radius['bottom-left']}px;" : '';

        $btn_shadow = ($btn_shadow == '1' ) ? "-webkit-box-shadow: 0px 20px 24px 0px rgba(0, 11, 40, 0.1); box-shadow: 0px 20px 24px 0px rgba(0, 11, 40, 0.1);" : '';
        $btn_shadow = ($btn_shadow == '' ) ? "box-shadow: none;" : '';
        $btn_border_width = !empty($btn_border_width ) ? "border-width: {$btn_border_width}px;" : '';
        $btn_font_size = !empty($btn_font_size ) ? "font-size: {$btn_font_size}px;" : '';

        // Sticky button style
        $sticky_btn_hover_background_color = !empty($sticky_btn_hover['background_color'] ) ? "background: {$sticky_btn_hover['background_color']};" : '';
        $sticky_btn_hover_font_color = !empty($sticky_btn_hover['font_color'] ) ? "color: {$sticky_btn_hover['font_color']};" : '';
        $sticky_btn_hover_border_color = !empty($sticky_btn_hover['border_color'] ) ? "border-color: {$sticky_btn_hover['border_color']};" : '';

        $sticky_btn_normal_background_color = !empty($sticky_btn_normal['background_color'] ) ? "background: {$sticky_btn_normal['background_color']};" : '';
        $sticky_btn_normal_font_color = !empty($sticky_btn_normal['font_color'] ) ? "color: {$sticky_btn_normal['font_color']};" : '';
        $sticky_btn_normal_border_color = !empty($sticky_btn_normal['border_color'] ) ? "border-color: {$sticky_btn_normal['border_color']};" : '';
        $dynamic_css .= "
            .header_area .navbar .btn_get.btn-meta {
                $btn_font_size
                $btn_border_width
                $btn_shadow
                $btn_border_radius_top_left 
                $btn_border_radius_top_right
                $btn_border_radius_bottom_right
                $btn_border_radius_bottom_left 
                $btn_normal_background_color
                $btn_normal_font_color
                $btn_normal_border_color
                $btn_normal_shadow
            }
            .header_area .navbar .btn_get.btn-meta:hover {
                $btn_hover_background_color
                $btn_hover_font_color
                $btn_hover_border_color
                $btn_hover_shadow
            }
            .header_area.navbar_fixed .navbar .btn_get.btn-meta {
                $sticky_btn_normal_background_color
                $sticky_btn_normal_font_color
                $sticky_btn_normal_border_color
            }
            .header_area.navbar_fixed .navbar .btn_get.btn-meta:hover {
                $sticky_btn_hover_background_color
                $sticky_btn_hover_font_color
                $sticky_btn_hover_border_color
            }
        ";
    }

    /**
     * Menu Item Active Color
     */
    $menu_item_active_color = function_exists( 'get_field' ) ? get_field( 'menu_item_active_color' ) : '';
    $menu_color  = !empty( $menu_item_active_color ) ? 'color: '.$menu_item_active_color : '';
    $menu_border = !empty( $menu_item_active_color ) ? 'background-color: '.$menu_item_active_color : '';
    if ( !empty($menu_item_active_color) ) {
        $dynamic_css .= "
            header.header_area.navbar_fixed .navbar .navbar-nav .menu-item a.nav-link.active,
            .header_area .menu > .nav-item .nav-link:hover,
            .header_area .menu > .nav-item.active>.nav-link,
            .header_area .menu > .nav-item.submenu .dropdown-menu .nav-item.active > .nav-link,
            .header_area.navbar_fixed .menu_six .menu > .nav-item:hover > .nav-link,
            .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link span,
            .header_area .menu > .nav-item.active .nav-link+.dropdown-menu .nav-item .nav-link:hover, 
            .header_area .menu > .nav-item.submenu .dropdown-menu .nav-item:hover > .nav-link,
            .header_area .menu > .nav-item.active .nav-link+.dropdown-menu .active .nav-link {
                {$menu_color}
            }
            .header_area.navbar_fixed .menu>.nav-item>.nav-link:before{
                {$menu_border}
            }
        ";
    }

    /**
     * Page Padding controls
     */
    $page_padding = function_exists( 'get_field' ) ? get_field( 'page_content_padding' ) : '';

    // Padding top
    if ( isset($page_padding['padding_top']) ) {
        $dynamic_css .= "
                .single-product .product_details_area,
                .single section.blog_area_two,
                .elementor-template-full-width .elementor.elementor-".get_the_ID().",
                .sec_pad.page_wrapper {
                    padding-top: {$page_padding['padding_top']}px;
                }";
    }

    // Padding bottom
    if ( isset($page_padding['padding_bottom']) ) {
        $dynamic_css .= "
            .single-post section.blog_area_two,
            .elementor-template-full-width .elementor.elementor-" . get_the_ID() . ",
            .sec_pad.page_wrapper {
                padding-bottom: {$page_padding['padding_bottom']}px;
            } ";
    }

    /**
     * Page background color
     */
    $page_bg_color = function_exists( 'get_field' ) ? get_field( 'background_color' ) : '';
    if ( !empty($page_bg_color) ) {
        $dynamic_css .= "
            .elementor-template-full-width .elementor.elementor-" . get_the_ID() . ",
            .sec_pad.page_wrapper {
                background:" . $page_bg_color . ";
            }";
    }

    /**
     * Menu Item Color Options
     */
    $menu_colors = function_exists('get_field') ? get_field('menu_colors') : '';
    $item_colors = !empty($menu_colors['item_colors']) ? $menu_colors['item_colors'] : '';
    $item_hover_color = !empty($menu_colors['hover_color']) ? $menu_colors['hover_color'] : '';
    $item_bg_color = !empty($menu_colors['background_color']) ? $menu_colors['background_color'] : '';

    if ( $item_colors ) {
        $dynamic_css .= ".menu>.nav-item>.nav-link {color: $item_colors !important;}";
    }

    if ( $item_hover_color ) {
        $dynamic_css .= "
            .menu>.nav-item>.nav-link:hover,
            .menu>.nav-item>.nav-link.active{
                color: $item_hover_color !important;
            }
            .menu > .nav-item > .nav-link:before {
                background: $item_hover_color !important;
            }
        ";
    }

    if ( $item_bg_color ) {
        $dynamic_css .= "header.header_area.has_header_bg {background-color: $item_bg_color !important;}";
    }

    /**
     * Menu Sticky Colors
     */
    $menu_sticky_colors = function_exists('get_field') ? get_field('menu_sticky_colors') : '';
    $sticky_item_colors = !empty($menu_sticky_colors['item_colors']) ? $menu_sticky_colors['item_colors'] : '';
    $sticky_item_hover_color = !empty($menu_sticky_colors['hover_color']) ? $menu_sticky_colors['hover_color'] : '';
    $sticky_item_bg_color = !empty($menu_sticky_colors['background_color']) ? $menu_sticky_colors['background_color'] : '';

    if ( $sticky_item_colors ) {
        $dynamic_css .= ".navbar_fixed .menu>.nav-item>.nav-link {color: $sticky_item_colors !important;}";
    }

    if ( $sticky_item_hover_color ) {
        $dynamic_css .= "
            .navbar_fixed .menu>.nav-item>.nav-link:hover,
            .navbar_fixed .menu>.nav-item>.nav-link.active{
                color: $sticky_item_hover_color !important;
            }
            .navbar_fixed .menu > .nav-item > .nav-link:before {
                background: $sticky_item_hover_color !important;
            }
        ";
    }

    if ( $sticky_item_bg_color ) {
        $dynamic_css .= "header.header_area.has_header_bg.navbar_fixed {background-color: $sticky_item_bg_color !important;}";
    }


    /**
     * Sub Menu Item Color Options
     */
    $submenu_colors = function_exists('get_field') ? get_field('sub_menu_colors') : '';
    $submenu_item_colors = !empty($submenu_colors['item_colors']) ? $submenu_colors['item_colors'] : '';
    $submenu_item_hover_color = !empty($submenu_colors['hover_color']) ? $submenu_colors['hover_color'] : '';
    $submenu_item_bg_color = !empty($submenu_colors['background_color']) ? $submenu_colors['background_color'] : '';

    if ( $submenu_item_colors ) {
        $dynamic_css .= ".menu>.nav-item.submenu .dropdown-menu .nav-item .nav-link {color: $submenu_item_colors !important;}";
    }

    if ( $submenu_item_hover_color ) {
        $dynamic_css .= "
            .menu>.nav-item.submenu .dropdown-menu .nav-item:hover>.nav-link, 
            .menu>.nav-item.submenu .dropdown-menu .nav-item:hover>.nav-link span {
                color: $submenu_item_hover_color !important;
            }";
    }

    if ( $submenu_item_bg_color ) {
        $dynamic_css .= ".menu>.nav-item:hover .dropdown-menu {background-color: $submenu_item_bg_color !important;}";
    }


    /**
     * Sub Menu Sticky Item Color Options
     */
    $submenu_sticky_colors = function_exists('get_field') ? get_field('sub_menu_sticky_colors') : '';
    $submenu_sticky_item_colors = !empty($submenu_sticky_colors['item_colors']) ? $submenu_sticky_colors['item_colors'] : '';
    $submenu_sticky_item_hover_color = !empty($submenu_sticky_colors['hover_color']) ? $submenu_sticky_colors['hover_color'] : '';
    $submenu_sticky_item_bg_color = !empty($submenu_sticky_colors['background_color']) ? $submenu_sticky_colors['background_color'] : '';

    if ( $submenu_sticky_item_colors ) {
        $dynamic_css .= ".navbar_fixed .menu>.nav-item.submenu .dropdown-menu .nav-item .nav-link {color: $submenu_sticky_item_colors !important;}";
    }

    if ( $submenu_sticky_item_hover_color ) {
        $dynamic_css .= "
            .navbar_fixed .menu>.nav-item.submenu .dropdown-menu .nav-item:hover>.nav-link,
            .navbar_fixed .menu>.nav-item.submenu .dropdown-menu .nav-item:hover>.nav-link span {
                color: $submenu_sticky_item_hover_color !important;
            }
        ";
    }

    if ( $submenu_sticky_item_bg_color ) {
        $dynamic_css .= ".navbar_fixed .menu>.nav-item:hover .dropdown-menu {background-color: $submenu_sticky_item_bg_color !important;}";
    }

    /**
     * WooCommerce Mini Cart Color options
     */
    $mini_cart = function_exists('get_field') ? get_field( 'mini_cart' ) : '';
    $cart_color =  !empty($mini_cart['cart_color'] ) ? $mini_cart['cart_color'] : '';
    $count_text_color =  !empty($mini_cart['count_text_color'] ) ? $mini_cart['count_text_color'] : '';
    $sticky_cart_color =  !empty($mini_cart['sticky_cart_color'] ) ? $mini_cart['sticky_cart_color'] : '';
    $sticky_count_text_color =  !empty($mini_cart['sticky_count_text_color'] ) ? $mini_cart['sticky_count_text_color'] : '';

    // Normal Cart Color
    if ( $cart_color ) {
        $dynamic_css .= "
            .navbar .search_exist .search_cart li svg path {
                fill: $cart_color !important;
            }
            .navbar .search_cart .shpping-cart .num {
                background: $cart_color !important;
            }
        ";
    }

    if ( $count_text_color ) {
        $dynamic_css .= "
            .navbar .search_cart .shpping-cart .num {
                color: $count_text_color !important;
            }
        ";
    }

    // Sticky Cart Color
    if ( $sticky_cart_color ) {
        $dynamic_css .= "
            .navbar_fixed .navbar .search_exist .search_cart li svg path {
                fill: $sticky_cart_color !important;
            }
            .navbar_fixed .navbar .search_cart .shpping-cart .num {
                background: $sticky_cart_color !important;
            }
        ";
    }

    if ( $sticky_count_text_color ) {
        $dynamic_css .= "
            .navbar_fixed .navbar .search_cart .shpping-cart .num {
                color: $sticky_count_text_color !important;
            }
        ";
    }


}


wp_add_inline_style( 'saasland-responsive', $dynamic_css);



// =============================== Inline Scripts Render ======================================//
$dynamic_js = '';

/**
 * Options from Theme Settings
 */
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    $is_footer_widget_padding = !empty($opt['is_footer_widget_padding']) ? $opt['is_footer_widget_padding'] : '';
    if ($is_footer_widget_padding != '1') {
        $dynamic_js .= "
            ;(function($){
                $(document).ready(function () {
                    $( '.footer-widget .f_widget' ).removeClass( 'pl_70' ); \n
                });
            })(jQuery);";
    }

    $is_preloader = !empty($opt['is_preloader']) ? $opt['is_preloader'] : '';
    if ($is_preloader == '1') {
        $dynamic_js .= "
            //<![CDATA[
                jQuery(window).on( 'load', function() { // makes sure the whole site is loaded 
                    jQuery( '#status' ).fadeOut(); // will first fade out the loading animation 
                    jQuery( '#preloader' ).delay(350).fadeOut( 'slow' ); // will fade out the white DIV that covers the website. 
                    jQuery( 'body' ).delay(350).css({'overflow':'visible'});
                })
            //]]>"."\n";
    }

    $search_widget_style = !empty($opt['search_widget_style']) ? $opt['search_widget_style'] : '';
    if ($search_widget_style == '1') {
        $dynamic_js .= "
            ;(function($){
                $(document).ready(function () {
                    $( '.widget_search' ).removeClass( 'widget_search' ).addClass( 'search_widget_two' );
                });
            })(jQuery);";
    }
}

/**
 * Dynamic CSS render for Page
 */
if ( function_exists('get_field') ) {
    $navigation = get_field('navigation');
    if ( $navigation == 'onepage' ) {
        $dynamic_js .= "
            ;(function($){
                jQuery('.navbar-nav .nav-link').on('click', function() {
                    jQuery('.navbar-collapse').collapse('hide');
                });
            })(jQuery);";
    }
}

wp_add_inline_script( 'saasland-custom-wp', $dynamic_js);
<?php
// Banner Title Bar
Redux::set_section( 'saasland_opt', array(
	'title'            => esc_html__( 'Title Bar', 'saasland' ),
	'id'               => 'title_bar_opt',
	'customizer_width' => '400px',
	'icon'             => 'el el-arrow-up',
));


/**
 * Title-bar Page
 */
Redux::set_section( 'saasland_opt', array(
	'title'            => esc_html__( 'Page Title-bar', 'saasland' ),
	'id'               => 'page_title_bar_opt',
	'subsection'       => true,
	'icon'             => '',
	'fields'           => array(
		array(
			'title'     => esc_html__( 'Select Preset', 'saasland' ),
			'id'        => 'banner_style',
			'type'      => 'image_select',
			'default'   => '1',
			'options'   => array(
				'1' => array(
					'alt' => esc_html__( 'Title-bar 01', 'saasland' ),
					'img' => SAASLAND_DIR_IMG.'/banners/1.jpg'
				),
				'2' => array(
					'alt' => esc_html__( 'Title-bar 02', 'saasland' ),
					'img' => SAASLAND_DIR_IMG.'/banners/2.jpg'
				),
			)
		),

		array(
			'title'     => esc_html__( 'Background Image', 'saasland' ),
			'subtitle'  => esc_html__( 'The default background image. Use here a transparent png shape image. The shape will appear on the top right side of the banner.', 'saasland' ),
			'id'        => 'page_banner_bg_image',
			'type'      => 'media',
			'compiler'  => true,
			'default'   => array(
				'url'   => SAASLAND_DIR_IMG.'/banners/banner_bg.png'
			),
			'required'  => array( 'banner_style', '=', '1' )
		),

		array(
			'title'     => esc_html__( 'Shape Image', 'saasland' ),
			'subtitle'  => esc_html__( 'The default background shape image. Use here a transparent png shape image. The shape will appear on the top right side of the banner.', 'saasland' ),
			'id'        => 'banner_shape_image',
			'type'      => 'media',
			'compiler'  => true,
			'default'   => array(
				'url'   => SAASLAND_DIR_IMG.'/banners/banner_bg.png'
			),
			'required'  => array( 'banner_style', '=', '1' )
		),

		array(
			'title'     => esc_html__( 'Breadcrumb', 'saasland' ),
			'id'        => 'is_breadcrumb',
			'type'      => 'button_set',
			'options'   => [
				'1'     => 'Show',
				'2'     => 'Hide',
				'3'     => 'Force Globally Hide',
			],
			'default'   => '1',
		),

		array(
			'title'     => esc_html__( 'Background Shape', 'saasland' ),
			'subtitle'  => esc_html__( 'Upload here the default background shape image', 'saasland' ),
			'id'        => 'banner_bg2',
			'type'      => 'media',
			'compiler'  => true,
			'default'   => array(
				'url'   => SAASLAND_DIR_IMG.'/banners/banner_bg2.png'
			),
			'required'  => array( 'banner_style', '=', '2' )
		),

		array(
			'id'        => 'titlebar_title_typo',
			'type'      => 'typography',
			'title'     => esc_html__( 'Title Typography', 'saasland' ),
			'output'    => array( '.breadcrumb_content h1, .breadcrumb_content_two h1' )
		),

		array(
			'id'        => 'titlebar_subtitle_typo',
			'type'      => 'typography',
			'title'     => esc_html__( 'Subtitle Typography', 'saasland' ),
			'output'    => array( '.breadcrumb_content p' ),
			'required'  => array( 'banner_style', '=', '1' )
		),

		
		array(
			'title'     => esc_html__( 'Background Overlay Color', 'saasland' ),
			'id'        => 'banner_overlay_color',
			'type'      => 'color_gradient',
			'default'   => array(
				'from'  => '#5e2ced',
				'to'    => '#a485fd',
				'gradient-reach' => array(
					'from' => '0%',
					'to'   => '100%',
				),
			),
			'gradient-type'  => true,
			'gradient-reach' => true,
			'gradient-angle' => true,
			'output'         => '.breadcrumb_area::after'
		),

		array(
            'title'     => esc_html__( 'Background Overlay Opacity', 'saasland' ),
            'id'        => 'banner_overlay_color_opacity',
            'type'      => 'text',
            'default'   => esc_html__( '.5', 'saasland' )
        ),

		array(
			'title'     => esc_html__( 'Title-bar padding', 'saasland' ),
			'subtitle'  => esc_html__( 'Padding around the Title-bar.', 'saasland' ),
			'id'        => 'title_bar_padding',
			'type'      => 'spacing',
			'output'    => array( '.breadcrumb_area, .breadcrumb_area_two' ),
			'mode'      => 'padding',
			'units'     => array( 'em', 'px', '%' ),
			'units_extended' => 'true',
		),

		

		array(
			'id'       => 'titlebar_align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Alignment', 'saasland' ),
			'options' => array(
				'start' => esc_html__( 'Left', 'saasland' ),
				'center' => esc_html__( 'Center', 'saasland' ),
				'end' => esc_html__( 'Right', 'saasland' )
			),
			'default' => 'center'
		),
	)
));


/**
 * Title-bar Blog Archive
 */
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Title-bar', 'saasland' ),
	'id'        => 'blog_archive_title_bar_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(

		array(
			'title'     => esc_html__( 'Title Bar ON/OFF', 'saasland' ),
			'id'        => 'is_blog_title_bar',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'saasland' ),
			'off'       => esc_html__( 'Hide', 'saasland' ),
			'default'   => '1',
		),

		array(
			'title'     => esc_html__( 'Select Preset', 'saasland' ),
			'id'        => 'blog_banner_style',
			'type'      => 'image_select',
			'default'   => '1',
			'options'   => array(
				'1' => array(
					'alt' => esc_html__( 'Title-bar 01', 'saasland' ),
					'img' => SAASLAND_DIR_IMG.'/banners/1.jpg'
				),
				'2' => array(
					'alt' => esc_html__( 'Title-bar 02', 'saasland' ),
					'img' => SAASLAND_DIR_IMG.'/banners/2.jpg'
				),
			),
			'required' => array('is_blog_title_bar', '=', '1')
		),

		array(
			'title'     => esc_html__( 'Blog Title', 'saasland' ),
			'subtitle'  => esc_html__( 'Controls the title text that displays in the page title bar only if your front page displays your latest post in "Settings > Reading".', 'saasland' ),
			'id'        => 'blog_title',
			'type'      => 'text',
			'default'   => esc_html__( 'Blog List', 'saasland' ),
			'required' => array('is_blog_title_bar', '=', '1')
		),

		array(
			'title'         => esc_html__( 'Title font properties', 'saasland' ),
			'id'            => 'blog_titlebar_title_typo',
			'type'          => 'typography',
			'google'        => true,
			'text-align'    => true,
			'output'        => array( '.blog_title_bar .breadcrumb_content h1, .blog_title_bar .breadcrumb_content_two h1' ),
			'preview'       => array(
				'always_display' => false
			),
			'required' => array('is_blog_title_bar', '=', '1')
		),

		array(
			'id'        => 'blog_titlebar_subtitle_typo',
			'type'      => 'typography',
			'title'     => esc_html__( 'Subtitle Typography', 'saasland' ),
			'output'    => array( '.blog_title_bar .breadcrumb_content p' ),
			'required'  => array( 'blog_banner_style', '=', '1' )
		),

		array(
			'title'     => esc_html__( 'Breadcrumb', 'saasland' ),
			'id'        => 'is_blog_breadcrumb',
			'type'      => 'button_set',
			'options'   => [
				'1'     => 'Show',
				'2'     => 'Hide',
				'3'     => 'Force Globally Hide',
			],
			'default'   => '1',
			'required' => array('blog_banner_style', '=', '2')
		),

		array(
			'title'     => esc_html__( 'Bubbles', 'saasland' ),
			'id'        => 'is_bubbles',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'saasland' ),
			'off'       => esc_html__( 'Hide', 'saasland' ),
			'default'   => '1',
			'required' => array('blog_banner_style', '=', '2')
		),

		array(
			'title'     => esc_html__( 'Bubbles Color', 'saasland' ),
			'id'        => 'bubbles_color',
			'output'    => array( '.blog_title_bar .bubble li' ),
			'type'      => 'color',
			'mode'      => 'background',
			'required' => array('is_bubbles', '=', '1')
		),

		array(
			'title'     => esc_html__( 'Title-bar padding', 'saasland' ),
			'subtitle'  => esc_html__( 'Padding around the Title-bar.', 'saasland' ),
			'id'        => 'blog_title_bar_padding',
			'type'      => 'spacing',
			'output'    => array( '.blog_title_bar' ),
			'mode'      => 'padding',
			'units'     => array( 'em', 'px', '%' ),
			'units_extended' => 'true',
			'required' => array('is_blog_title_bar', '=', '1')
		),

		array(
			'id'       => 'blog_titlebar_align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Alignment', 'saasland' ),
			'options' => array(
				'start' => esc_html__( 'Start', 'saasland' ),
				'center' => esc_html__( 'Center', 'saasland' ),
				'end' => esc_html__( 'End', 'saasland' )
			),
			'default' => 'center',
			'required' => array('is_blog_title_bar', '=', '1')
		),

		array(
			'title'     => esc_html__( 'Background Overlay Color', 'saasland' ),
			'id'        => 'blog_banner_overlay_color',
			'type'      => 'color_gradient',
			'default'   => array(
				'from'  => '#5e2ced',
				'to'    => '#a485fd',
				'gradient-reach' => array(
					'from' => '0%',
					'to'   => '100%',
				),
			),
			'gradient-type'  => true,
			'gradient-reach' => true,
			'gradient-angle' => true,
			'output'         => '.blog_title_bar',
			'required' => array('blog_banner_style', '=', '1')
		),

		array(
			'title'     => esc_html__( 'Background Color', 'saasland' ),
			'id'        => 'blog_banner_bg_color',
			'output'    => array( '.blog_title_bar' ),
			'type'      => 'color',
			'mode'      => 'background',
			'required' => array('blog_banner_style', '=', '2')
		),

		array(
			'title'     => esc_html__( 'Background Shape', 'saasland' ),
			'subtitle'  => esc_html__( 'Upload here the background shape image for Blog page', 'saasland' ),
			'id'        => 'blog_banner_shape_img',
			'type'      => 'media',
			'compiler'  => true,
			'default'   => array(
				'url'   => SAASLAND_DIR_IMG.'/banners/banner_bg.png'
			),
			'required' => array('is_blog_title_bar', '=', '1')
		),

		array(
			'title'     => esc_html__( 'Background Images', 'saasland' ),
			'subtitle'  => esc_html__( 'Upload here the background image for Blog page', 'saasland' ),
			'id'        => 'blog_banner_section_img',
			'type'      => 'media',
			'compiler'  => true,
			'default'   => array(
				'url'   => SAASLAND_DIR_IMG.'/banners/banner_bg.png'
			),
			'required' => array('is_blog_title_bar', '=', '1')
		),

	)
));



/**
 * Title-bar Shop
 */
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Shop Title-bar', 'saasland' ),
	'id'        => 'shop_title_bar_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(

		array(
			'title'     => esc_html__( 'Page title', 'saasland' ),
			'subtitle'  => esc_html__( 'Give here the shop page title', 'saasland' ),
			'desc'      => esc_html__( 'This text will show on the shop page banner', 'saasland' ),
			'id'        => 'shop_title',
			'type'      => 'text',
			'default'   => esc_html__( 'Shop', 'saasland' ),
		),

		array(
			'title'     => esc_html__( 'Shop Page Subtitle', 'saasland' ),
			'id'        => 'shop_subtitle',
			'type'      => 'textarea',
		),

		array(
			'title'     => esc_html__( 'Title bar background', 'saasland' ),
			'subtitle'  => esc_html__( 'Upload image file as Shop page title bar background', 'saasland' ),
			'id'        => 'shop_header_bg',
			'type'      => 'media',
		),

	)
));


/**
 * Title-bar Blog Single
 */
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Single Title-bar', 'saasland' ),
	'id'        => 'blog_single_title_bar_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(

		array(
			'title'         => esc_html__( 'Title font properties', 'saasland' ),
			'id'            => 'blog_single_titlebar_title_typo',
			'type'          => 'typography',
			'google'        => true,
			'text-align'    => true,
			'output'        => array( '.blog_breadcrumb_area .breadcrumb_content_two h1' ),
			'preview'       => array(
				'always_display' => false
			)
		),

		array(
			'title'         => esc_html__( 'Breadcrumb font properties', 'saasland' ),
			'id'            => 'blog_single_titlebar_bread_typo',
			'type'          => 'typography',
			'google'        => true,
			'text-align'    => true,
			'output'        => array( '.blog_breadcrumb_area .breadcrumb_content_two ol li, .blog_breadcrumb_area .breadcrumb_content_two ol li a' ),
			'preview'       => array(
				'always_display' => false
			)
		),

		array(
			'title'     => esc_html__( 'Post meta', 'saasland' ),
			'subtitle'  => esc_html__( 'Show/hide post meta on blog single page', 'saasland' ),
			'id'        => 'is_single_post_meta',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'saasland' ),
			'off'       => esc_html__( 'Hide', 'saasland' ),
			'default'   => '1',
		),

		array(
			'title'     => esc_html__( 'Categories', 'saasland' ),
			'id'        => 'is_single_cats',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'saasland' ),
			'off'       => esc_html__( 'Hide', 'saasland' ),
			'default'   => '1',
			'required'  => array('is_single_post_meta', '=', '1' )
		),

		array(
			'title'         => esc_html__( 'Category font properties', 'saasland' ),
			'id'            => 'blog_single_titlebar_cats_typo',
			'type'          => 'typography',
			'google'        => true,
			'text-align'    => true,
			'output'        => array( '.blog_breadcrumb_area .breadcrumb_content_two h5, .blog_breadcrumb_area .breadcrumb_content_two h5 a' ),
			'preview'       => array(
				'always_display' => false
			),
			'required'  => array('is_single_post_meta', '=', '1' )
		),

		array(
			'title'     => esc_html__( 'Post Author Name', 'saasland' ),
			'id'        => 'is_single_post_author',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'saasland' ),
			'off'       => esc_html__( 'Hide', 'saasland' ),
			'default'   => '1',
			'required'  => array('is_single_post_meta', '=', '1' )
		),

		

		array(
			'title'     => esc_html__( 'Background Overlay Color', 'saasland' ),
			'id'        => 'post_banner_overlay_color',
			'type'      => 'color_gradient',
			'default'   => array(
				'from'  => '#5e2ced',
				'to'    => '#a485fd',
				'gradient-reach' => array(
					'from' => '0%',
					'to'   => '100%',
				),
			),
			'gradient-type'  => true,
			'gradient-reach' => true,
			'gradient-angle' => true,
			'output'         => '.blog_breadcrumb_area'
		),


		array(
			'title'     => esc_html__( 'Height', 'saasland' ),
			'id'        => 'post_banner_height',
			'type'      => 'slider',
			"min"       => 300,
			"default"   => 600,
			"step"      => 1,
			"max"       => 1000,
			'display_value' => 'text'
		),

		array(
			'title'     => esc_html__( 'Background Image', 'saasland' ),
			'subtitle'  => esc_html__( 'Upload here the default background image for blog single page banner', 'saasland' ),
			'id'        => 'post_banner_bg',
			'type'      => 'media',
		),

	)
));


/**
 * Title-bar Case Study
 */
/*=================== Case Study Page Title bar  =====================*/
Redux::set_section( 'saasland_opt', array(
	'title'         => esc_html__( 'Case Study', 'saasland' ),
	'id'            => '_cp_casestudy_settings',
	'icon'          => '',
	'subsection'    => true,
	'fields'        => array(

		array(
			'id'        => 'casestudy_note',
			'type'      => 'info',
			'style'     => 'success',
			'title'     => esc_html__( 'Important Note', 'saasland' ),
			'icon'      => 'dashicons dashicons-info',
			'required'  => array( 'is_case_study_cpt', '=', '' ),
			'desc'      => esc_html__( "Case Study post type is disabled that's why the case study settings are gone from here. Enable the case study post type from 'Theme Settings > Custom Post Types > Post Types' To show the case study settings.", 'saasland' )
		),

		array(
			'title'     => esc_html__( 'Page Title', 'saasland' ),
			'id'        => 'casestudy_pagetitle',
			'type'      => 'text',
			'default'   => esc_html__( 'Case Study', 'saasland' ),
		),

		array(
			'id'          => 'casestudy_titlebar_title_typo',
			'type'        => 'typography',
			'title'       => __('Page Title Typography', 'saasland'),
			'google'      => true,
			'font-backup' => true,
			'output'      => array('.post-type-archive .breadcrumb_content > h1'),
			'units'       =>'px',
		),

		array(
			'title'     => esc_html__( 'Background Image', 'saasland' ),
			'subtitle'  => esc_html__( 'Upload here the default background image for Case Study page banner', 'saasland' ),
			'id'        => 'case_study_title_bg',
			'type'      => 'media',
		),

	)
));
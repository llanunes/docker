<?php

// Color option
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Color Scheme', 'saasland' ),
	'id'        => 'color',
	'icon'      => 'dashicons dashicons-admin-appearance',
	'fields'    => array(

		array(
			'id'          => 'accent_solid_color',
			'type'        => 'color',
			'title'       => esc_html__( 'Primary Color', 'saasland' ),
			'output_variables' => true,
			'default'     => '#5e2ced'
		),
		array(
			'id'          => 'theme_secondary_color_opt',
			'type'        => 'color',
			'title'       => esc_html__( 'Secondary Color', 'saasland' ),
			'output_variables' => true,
			'default'     => '#051441'
		),
		array(
			'id'          => 'theme_body_color_opt',
			'type'        => 'color',
			'title'       => esc_html__( 'Body Color', 'saasland' ),
			'output_variables' => true,
			'default'     => '#677294'
		),
		array(
			'id'          => 'anchor_tag_color',
			'type'        => 'link_color',
			'title'       => esc_html__( 'Link Color', 'saasland' ),
			'output'      => array( 'a, .blog_list_item .blog_content a, .blog_list_item .blog_content p a, .footer_bottom a' )
		)
	)
));


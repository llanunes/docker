<?php
/**
 * Blog Pages
 */
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Pages', 'saasland' ),
	'id'        => 'blog_page',
	'icon'      => 'dashicons dashicons-admin-post',
));

/**
 * Blog Archive
 */
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Archive', 'saasland' ),
	'id'        => 'blog_meta_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(

        /**
         * Blog archive meta options
         */
        array(
            'title'     => esc_html__( 'Blog Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'The Blog layout will also apply on the blog category and tag pages.', 'saasland' ),
            'id'        => 'blog_layout',
            'type'      => 'image_select',
            'options'   => array(
                'list' => array(
                    'alt' => esc_html__( 'List Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/list.jpg'
                ),
                'grid' => array(
                    'alt' => esc_html__( 'Grid Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/grid.jpg'
                ),
                'masonry' => array(
                    'alt' => esc_html__( 'Masonry Layout', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/masonry.jpg'
                ),
            ),
            'default' => 'list'
        ),

        array(
            'title'     => esc_html__( 'Column', 'saasland' ),
            'id'        => 'blog_column',
            'type'      => 'select',
            'options'   => [
                '6' => esc_html__( 'Two', 'saasland' ),
                '4' => esc_html__( 'Three', 'saasland' ),
                '3' => esc_html__( 'Four', 'saasland' ),
            ],
            'default'   => '6',
            'required' => array (
                array ( 'blog_layout', '=', array( 'grid', 'masonry' ) ),
            )
        ),

        array(
            'title'     => esc_html__( 'Post title length', 'saasland' ),
            'subtitle'  => esc_html__( 'Blog post title length in character', 'saasland' ),
            'id'        => 'post_title_length',
            'type'      => 'slider',
            'default'   => 50,
            "min"       => 1,
            "step"      => 1,
            "max"       => 500,
            'display_value' => 'text',
            'required' => array (
                array ( 'blog_layout', '=', array( 'grid', 'masonry' ) ),
            )
        ),

        array(
            'title'     => esc_html__( 'Post word excerpt', 'saasland' ),
            'subtitle'  => esc_html__( 'If post excerpt is empty, the excerpt content will take from the post content. Define here how much word you want to show along with the each posts in the blog page.', 'saasland' ),
            'id'        => 'blog_excerpt',
            'type'      => 'slider',
            'default'   => 40,
            "min"       => 1,
            "step"      => 1,
            "max"       => 500,
            'display_value' => 'text'
        ),

        array(
            'title'     => esc_html__( 'Read More', 'saasland' ),
            'subtitle'  => esc_html__( 'Change the Read More link text', 'saasland' ),
            'id'        => 'read_more',
            'type'      => 'text',
            'default'   => esc_html__( 'Read More', 'saasland' )
        ),

		array(
			'title'     => esc_html__( 'Post meta', 'saasland' ),
			'subtitle'  => esc_html__( 'Show/hide post meta on blog archive page', 'saasland' ),
			'id'        => 'is_post_meta',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
		),

		array(
			'title'     => esc_html__( 'Post date', 'saasland' ),
			'id'        => 'is_post_date',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_post_meta', '=', 1 )
		),

		array(
			'title'     => esc_html__( 'Post category', 'saasland' ),
			'id'        => 'is_post_cat',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
            'required' => array( 'is_post_meta', '=', 1 )
		),
	)
));

/**
 * Blog Single
 */
Redux::set_section( 'saasland_opt', array(
	'title'     => esc_html__( 'Blog Single', 'saasland' ),
	'id'        => 'blog_single_opt',
	'icon'      => '',
	'subsection' => true,
	'fields'    => array(

        array(
            'title'     => esc_html__( 'Blog Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'The Blog layout will also apply on the blog category and tag pages.', 'saasland' ),
            'id'        => 'blog_single_layout',
            'type'      => 'image_select',
            'options'   => array(
                'fullwidth' => array(
                    'alt' => esc_html__( 'Full Width', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/fullwidth.png'
                ),
                'sidebar_left' => array(
                    'alt' => esc_html__( 'Sidebar Left', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/sidebar_left.jpg'
                ),
                'sidebar_right' => array(
                    'alt' => esc_html__( 'Sidebar Right', 'saasland' ),
                    'img' => SAASLAND_DIR_IMG.'/layouts/sidebar_right.jpg'
                ),
            ),
            'default' => 'sidebar_right'
        ),

		array(
			'title'     => esc_html__( 'Comment Count Text', 'saasland' ),
			'id'        => 'is_single_comment_meta',
			'type'      => 'switch',
			'on'        => esc_html__( 'Show', 'saasland' ),
			'off'       => esc_html__( 'Hide', 'saasland' ),
			'default'   => '1',
		),

		array(
			'title'     => esc_html__( 'Social Share', 'saasland' ),
			'id'        => 'is_social_share',
			'type'      => 'switch',
            'on'        => esc_html__( 'Enabled', 'saasland' ),
            'off'       => esc_html__( 'Disabled', 'saasland' ),
            'default'   => '1'
		),

        array(
            'id'       => 'is_social_share_links',
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
            'required' => array( 'is_social_share', '=', 1 )
        ),

		array(
			'title'     => esc_html__( 'Post Tag', 'saasland' ),
			'id'        => 'is_post_tag',
			'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1'
		),

        array(
            'title'     => esc_html__( 'Comment List', 'saasland' ),
            'id'        => 'is_single_comment_list',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
        ),

        array(
            'title'     => esc_html__( 'Post Date', 'saasland' ),
            'id'        => 'is_single_post_date',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'default'   => '1',
        ),

        array(
            'title'     => esc_html__( 'Related posts ', 'saasland' ),
            'id'        => 'is_related_posts',
            'type'      => 'switch',
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
        ),

        array(
            'title'     => esc_html__( 'Posts section title', 'saasland' ),
            'id'        => 'related_posts_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Related Post', 'saasland' ),
            'required'  => array( 'is_related_posts', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Title Character Limit', 'saasland' ),
            'id'        => 'rp_title_char_limit',
            'type'      => 'slider',
            'default'   => 50,
            "min"       => 1,
            "step"      => 1,
            "max"       => 1000,
            'display_value' => 'text',
            'required' => array( 'is_related_posts', '=', '1' )
        ),

        array(
            'title'     => esc_html__( 'Related posts count', 'saasland' ),
            'id'        => 'related_posts_count',
            'type'      => 'slider',
            'default'       => 3,
            'min'           => 3,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label',
            'required'  => array( 'is_related_posts', '=', '1' )
        ),
	)
));

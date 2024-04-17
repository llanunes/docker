<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Post_slider_Pro extends \Elementor\Widget_Base{

    public function get_name()
    {
        return 'droit-post-slider-pro';
    }

    public function get_title()
    {
        return esc_html__( 'Post Slider Pro', 'saasland-core' );
    }

    public function get_icon()
    {
        return ' eicon-slider-push addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'post-slider', 'slider', 'post slider' ];
    }

    public function get_style_depends() {
		return ['swiper'];
	}

    public function get_script_depends() {
        return [ 'swiper' ];
    }

    protected function register_controls()
    {
        do_action('dl_widgets/test/register_control/start', $this);

        // add content 
        $this->__setting();

        $this->__content_control();
        
        //style section
        $this->__styles_control();
        
        do_action('dl_widgets/test/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function __setting(){

        $this->start_controls_section(
            '_dl_post_settings_section',
            [
                'label' => esc_html__('Query Settings', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
			'_dl_post_blog_queryby', [
				'label'			 =>esc_html__( 'Query by', 'saasland-core' ),
				'type'			 => \Elementor\Controls_Manager::CHOOSE,
				'options'		 => apply_filters('_dl_post_blog_query_by', [
					'all'		 => [
						'title'	 =>esc_html__( 'All', 'saasland-core' ),
						'icon'	 => 'fas fa-border-none',
					],
					'categories'		 => [
						'title'	 =>esc_html__( 'By Categories', 'saasland-core' ),
						'icon'	 => 'far fa-list-alt',
					],
					'posts'		 => [
						'title'	 =>esc_html__( 'By Posts', 'saasland-core' ),
						'icon'	 => 'far fa-list-alt',
					],
                    'postype'		 => [
						'title'	 =>esc_html__( 'By Posttype', 'saasland-core' ),
						'icon'	 => 'far fa-list-alt',
					],
					
				]),
				'default'		 => 'all',
               
			]
		);

        $this->add_control(
			'_dl_post_blog_bycategories',
			[
				'label' => __( 'By Categories', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    '_dl_post_blog_queryby' => [ 'categories' ]
				],
			]
		);

        $this->add_control(
			'_dl_post_blog_categories',
			[
				'label' => __( 'Select Categories', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => self::get_category(),
				'default' => [],
				'condition' => [
                    '_dl_post_blog_queryby' => [ 'categories' ]
				],
			]
		);

        $this->add_control(
			'_dl_post_blog_byposts',
			[
				'label' => __( 'By Posts', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    '_dl_post_blog_queryby' => [ 'posts' ]
				],
			]
		);

        $this->add_control(
			'_dl_post_blog_post',
			[
				'label' => __( 'Select Posts', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => self::get_posts(),
				'default' => [],
				'condition' => [
                    '_dl_post_blog_queryby' => [ 'posts' ]
				],
			]
		);

        $this->add_control(
			'_dl_post_blog_byposttype',
			[
				'label' => __( 'By Posttype', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    '_dl_post_blog_queryby' => [ 'postype' ]
				],
			]
		);

        $this->add_control(
			'_dl_post_blog_posttype',
			[
				'label' => __( 'Select Postype', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => self::get_posttype(),
				'default' => [],
				'condition' => [
                    '_dl_post_blog_queryby' => [ 'postype' ]
				],
			]
		);
		
		$this->add_control(
			'_dl_post_blog_otherquery',
			[
				'label' => __( 'Others Filter', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'_dl_post_blog_order_by',
			[
				'label'   => esc_html__( 'Order by', 'saasland-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'          => esc_html__( 'Date', 'saasland-core' ),
					'title'         => esc_html__( 'Title', 'saasland-core' ),
					'author'        => esc_html__( 'Author', 'saasland-core' ),
					'comment_count' => esc_html__( 'Comments', 'saasland-core' ),
				],
				'default' => 'date',
			]
		);
 
		$this->add_control(
			'_dl_post_blog_order',
			[
				'label'   => esc_html__( 'Order', 'saasland-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'saasland-core' ),
					'DESC' => esc_html__( 'DESC', 'saasland-core' ),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'_dl_post_blog_offset',
			[
				'label'     => esc_html__( 'Offset', 'saasland-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 15,
				'default'   => 0,
			]
		);
 
		$this->add_control(
			'_dl_post_blog_limit',
			[
				'label'     => esc_html__( 'Limit Display', 'saasland-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 5,
			]
		);

        $this->end_controls_section();
    }

    public function __content_control(){

        $this-> option_controls();


        // $this->_dl_pro_testimonials_rating();
        $this->ordering_controls();

    }

    // Testimonial Repeater

    // Slider Option
    public function option_controls()
    {
        $this->start_controls_section(
            '_dl_pro_testimonial_options_section',
            [
                'label' => esc_html__('Settings', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'dl_testimonial_perpage',
            [
                'label' => __( 'Perpage', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'dl_testimonial_speed',
            [
                'label' => __( 'Speed', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'min' => 1,
                'max' => 1000000,
                'step' => 100,
                'default' => 1000,
            ]
        );
        
        $this->add_control(
            'dl_testimonial_autoplay',
            [
                'label' => __('Autoplay', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'true',
                'return_value' => 'true',
            ]
        );

        $this->add_control(
            'dl_testimonial_auto_delay',
            [
                'label' => __( 'Delay [autoplay]', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 500,
                'condition' => [ 'dl_testimonial_autoplay' => 'true']
            ]
        );
        $this->add_control(
            'dl_testimonial_direction',
            [
                'label' => __('Enable Vertical', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'dl_testimonial_loop',
            [
                'label' => __('Enable Loop', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        
        $this->add_control(
            'dl_testimonial_centered',
            [
                'label' => __('Centered', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_testimonial_pagination',
            [
                'label' => __('Enable Pagination', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_testimonial_pagination_type',
            [
                'label' => __( 'Pagi Type', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'bullets' => 'Bullets',
                    'fraction' => 'Fraction',
                    'progressbar' => 'Progressbar',
                ],
                'default' => 'bullets',
                'condition' => [ 'dl_testimonial_pagination' => 'yes']
            ]
        );

        $this->add_control(
            'dl_testimonial_space',
            [
                'label' => __( 'Space Between', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $this->add_control(
            'dl_testimonial_effect',
            [
                'label' => __( 'Effect', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'slide' => 'Slide',
                    'fade' => 'Fade',
                    'cube' => 'Cube',
                    'coverflow' => 'Coverflow',
                    'flip' => 'Flip',
                ],
                'default' => 'slide',
            ]
        );

        $this->add_control(
            'dl_testimonial_enable_slide_control',
            [
                'label' => __('Enable Slide Control', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dl_testimonial_nav_left_icon',
            [
                'label' => __( 'Left Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_testimonial_enable_slide_control' => 'yes']
            ]
        );

        $this->add_control(
            'dl_testimonial_nav_right_icon',
            [
                'label' => __( 'Right Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [ 'dl_testimonial_enable_slide_control' => 'yes']
            ]
        );
        
        $this->add_control(
            'dl_breakpoints_enable',
            [
                'label' => esc_html__('Responsive', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'saasland-core'),
                'label_off' => esc_html__('No', 'saasland-core'),
                'return_value' => 'yes',
                'default' => 'label_off',
                'separator' => 'before'
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'dl_breakpoints_width',
            [
                'label' => __('Max Width', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 3000,
                'step' => 1,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_perpage',
            [
                'label' => __('Slides Per View', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_space',
            [
                'label' => __('Space Between', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 1,
                'default' => 30,
            ]
        );
        $repeater->add_control(
            'dl_breakpoints_center',
            [
                'label' => esc_html__('Center', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'saasland-core'),
                'label_off' => esc_html__('No', 'saasland-core'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        do_action('dl_widgets/adslider/settings/repeater', $repeater);
        
        $this->add_control(
            'dl_breakpoints',
            [
                'label' => __('Content', 'saasland-core'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'dl_breakpoints_width' => 1440,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 1024,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 768,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],
                    [
                        'dl_breakpoints_width' => 576,
                        'dl_breakpoints_perpage' => 1,
                        'dl_breakpoints_space' => 30,
                    ],

                ],
                'title_field' => 'Max Width: {{{ dl_breakpoints_width }}}',
                'condition' => [
                    'dl_breakpoints_enable' => ['yes'],
                ],
            ]
        );


        $this->add_control(
            'dl_testimonial_mouseover',
            [
                'label' => __( 'MouseOver Settings', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dl_testimonial_mouseover_enable',
            [
                'label' => esc_html__('Enable', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'saasland-core'),
                'label_off' => esc_html__('No', 'saasland-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
    }

    // Testimonial Repeater
    
    // Ordering Repeater
    public function ordering_controls(){
        $this->start_controls_section(
            '_dl_post_repeater_order_section',
            [
                'label' => esc_html__('Content Ordering', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            '_dl_post_order_enable',
            [
                'label' => __('Enable', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            '_dl_post_order_label',
            [
                'label' => __('Label', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        $repeater->add_control(
            '_dl_post_order_id',
            [
                'label' => __('Id', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );
        
        $this->add_control(
            '_dl_post_ordering_data',
            [
                'label' => __('Re-order', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_post_order_enable' => 'yes',
                        '_dl_post_order_label' => 'Blog Title',
                        '_dl_post_order_id' => 'blog_title',
                    ],
                    [
                        '_dl_post_order_enable' => 'yes',
                        '_dl_post_order_label' => 'Blog Content',
                        '_dl_post_order_id' => 'blog_content',
                    ],
                    [
                        '_dl_post_order_enable' => 'yes',
                        '_dl_post_order_label' => 'Meta',
                        '_dl_post_order_id' => 'blog_meta',
                    ],
                    [
                        '_dl_post_order_enable' => 'yes',
                        '_dl_post_order_label' => 'Categories',
                        '_dl_post_order_id' => 'blog_cate',
                    ],
                    [
                        '_dl_post_order_enable' => 'yes',
                        '_dl_post_order_label' => 'Button',
                        '_dl_post_order_id' => 'blog_button',
                    ],
                ],
                'title_field' => '<i class="eicon-editor-list-ul"></i>{{{ _dl_post_order_label }}}',
            ]
        );
        $this->end_controls_section();
    }
    
    public function __styles_control(){
        $this->general_style();
        $this->category_style();
        $this->content_style();
        $this->button_style();
        $this->navigation_controls();
    }

    public function general_style(){
        $this->start_controls_section(
            'dl_post_slider_general_tab',
            [
                'label' => __( 'General Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'margin',
			[
				'label' => __( 'Padding', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_post_content' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'_dl_post_slider_alignment',
			[
				'label' => __( 'Alignment', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'saasland-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'saasland-core' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'saasland-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
                'default' => 'center',
				'toggle' => true,
                'selectors' => [
					'{{WRAPPER}} .dl_post_content' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'post_category_background_port',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_post_content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'boxshadow',
                'label' => __( 'Content Boxshadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_post_content',
            ]
        );


        $this->add_responsive_control(
            '_dl_post_slider_position_control',
            [
                'label' => esc_html__('Position', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'relative'  => __( 'Default', 'saasland-core' ),
                    'absolute' => __( 'Absolute', 'saasland-core' ),
                ],
                
                'default' => 'relative',
                'selectors' => [
                    '{{WRAPPER}} .dl_post_content ' => 'position: {{VALUE}}',],
                ]
        );

        $this->add_responsive_control(
            '_dl_post_slider_content_width',
            [
                'label' => __('Content Width', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '500',
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_content' =>'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_control(
            'dl_item_position',
            [
                'label' => __( '', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'Default', 'saasland-core' ),
                'label_on' => __( 'Custom', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    '_dl_post_slider_position_control' => ['absolute', 'relative']
                ]
            ]
        );

        $this->start_popover();

        $start = is_rtl() ? __( 'Right', 'saasland-core' ) : __( 'Left', 'saasland-core' );
        $end = ! is_rtl() ? __( 'Right', 'saasland-core' ) : __( 'Left', 'saasland-core' );

        $this->add_control(
            'dl_offset_orientation_h',
            [
                'label' => __( 'Horizontal Orientation', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'start' => [
                        'title' => $start,
                        'icon' => 'eicon-h-align-left',
                    ],
                    'end' => [
                        'title' => $end,
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'classes' => 'elementor-control-start-end',
                'render_type' => 'ui',
               
            ]
        );

        $this->add_responsive_control(
            'dl_offset_x',
            [
                'label' => __( 'Offset', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => '0',
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh' ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .dl_post_content' => 'left: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .dl_post_content' => 'right: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_h!' => 'end',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_offset_x_end',
            [
                'label' => __( 'Offset', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'size' => '0',
                ],
                'size_units' => [ 'px', '%', 'vw', 'vh' ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .dl_post_content' => 'right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .dl_post_content' => 'left: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_h' => 'end',
                ],
            ]
        );

        $this->add_control(
            'dl_offset_orientation_v',
            [
                'label' => __( 'Vertical Orientation', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'start' => [
                        'title' => __( 'Top', 'saasland-core' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'end' => [
                        'title' => __( 'Bottom', 'saasland-core' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'dl_offset_y',
            [
                'label' => __( 'Offset', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', '%', 'vh', 'vw' ],
                'default' => [
                    'size' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_content' => 'top: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_v!' => 'end',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_offset_y_end',
            [
                'label' => __( 'Offset', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vh' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'size_units' => [ 'px', '%', 'vh', 'vw' ],
                'default' => [
                    'size' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_content' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_v' => 'end',
                ],
            ]
        );
       
        $this-> end_popover();


		$this->end_controls_tab();
				
		$this->end_controls_tabs();

        $this-> end_controls_section();
    }

    public function category_style(){
        $this->start_controls_section(
            'dl_post_slider_category_tab',
            [
                'label' => __( 'Category Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'category_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_post_category a',
            ]
        );

        $this->add_control(
            'dl_post_categories_color',
            [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_post_category a' => 'color: {{VALUE}}'],
            ]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'post_slider_category',
                'label' => __('Category Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_post_category a',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'fun_fact_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            '_dl_post_category_item_radius',
            [
                'label' => __('Border radius', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_category a' =>'border-radius: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_control(
			'_dl_post_category_item_margin',
			[
				'label' => __( 'Category Item Margin', 'saasland-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .dl_post_category a' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();
    }

    public function content_style(){
        $this->start_controls_section(
            'dl_post_slider_content',
            [
                'label' => __( 'Content Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'post_slider_Content_title',
                'label' => __('Title Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_post_content h2',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'fun_fact_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
			'dl_title_margin',
			[
				'label' => __( 'Margin', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_post_content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'post_slider_Content_description',
                'label' => __('Description Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_post_content p',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'fun_fact_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            '_dl_post_description_text',
            [
                'label' => __('Margin', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'post_slider_meta',
                'label' => __('Meta Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_entry_meta li, .dl_entry_meta li a',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'fun_fact_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            '_dl_post_meta_gap',
            [
                'label' => __('Margin', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_entry_meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_control(
            '_dl_post_meta_before',
            [
                'label' => __( 'Before Background', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_entry_meta li:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this-> end_controls_section();
    }

    public function button_style(){
        $this-> start_controls_section(
            '_dl_post_slider_button',
            [
                'label' => __( 'Button Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
			'dl_post_button_style_tabs'
		);

        $this->start_controls_tab(
			'dl_post_button_normal_tab',
			[
				'label' => __( 'Normal', 'saasland-core' ),
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_post_slider_button',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_post_details',
            ]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'post_slider_button',
                'label' => __('Button Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_post_details',
                'fields_options' => [
                    'typography' => [
                        'default' => '',
                    ],
                    'fun_fact_style' => 'custom',
                    'font_family' => [
                        'default' => '',
                    ],
                    'font_color' => [
                        'default' => '',
                    ],
                    'font_size' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '',
                    ],
                    'text_transform' => [
                        'default' => '', // uppercase, lowercase, capitalize, none
                    ],
                    'font_style' => [
                        'default' => '', // normal, italic, oblique
                    ],
                    'text_decoration' => [
                        'default' => '', // underline, overline, line-through, none
                    ],
                    'line_height' => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                            'size' => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
			'_dl_post_slider_button_padding',
			[
				'label' => __( 'Padding', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_post_details' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            '_dl_post_slider_button_gap',
            [
                'label' => __('Margin', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_details' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_post_details',
            ]
        );

        $this->add_control(
            '_dl_post_slider_button_radius',
            [
                'label' => __('Border Radius', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_post_details' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_boxshadow',
                'label' => __( 'Button Boxshadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_post_details',
            ]
        );

        $this-> end_controls_tab();

        $this->start_controls_tab(
			'dl_post_button_hover_tab',
			[
				'label' => __( 'Hover', 'saasland-core' ),
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_post_slider_button_hover',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_post_details:hover',
            ]
        );

        $this->add_control(
            '_dl_post_button_hover_color',
            [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_post_details:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            '_dl_post_button_border_color',
            [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_post_details:hover' => 'border: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_boxshadow_hover',
                'label' => __( 'Button Boxshadow Hover', 'saasland-core' ),
                'selector' => '{{WRAPPER}} dl_post_details:hover',
            ]
        );
        $this-> end_controls_tab();

        $this-> end_controls_tabs();

        $this-> end_controls_section();
    }

    public function navigation_controls()
    {
        $this->start_controls_section(
            'testimonial_btn_navigation_style_content',
            [
                'label' => __( 'Navigation', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'dl_testimonial_enable_slide_control' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_nav_button_icon_alignment',
            [
                'label' => __( 'Position', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'relative' => __( 'Normal', 'saasland-core' ),
                    'absolute' => __( 'Fixed', 'saasland-core' ),
                ],
                'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .swiper_testimonial_nav_button' => 'position: {{VALUE}}'
                ],
                
            ]
        );

        $this->add_control(
            'swiper_testimonial_next_nav_button_inner',
            [
                'label' => __( 'Next', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_control(
            'swiper_testimonial_next_nav_button_align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_nav_button_top_spacing',
            [
                'label' => __( 'Top', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-next ' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_nav_button_left_spacing',
            [
                'label' => __( 'Left', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-next ' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_next_nav_button_align' => ['left'],
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_nav_button_right_spacing',
            [
                'label' => __( 'Right', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-next ' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                    'swiper_testimonial_next_nav_button_align' => ['right'],
                ],
            ]
        );
        
        $this->add_control(
            'swiper_testimonial_prev_nav_button_section',
            [
                'label' => __( 'Previous', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_control(
            'swiper_testimonial_prev_nav_button_align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_prev_nav_button_top_spacing',
            [
                'label' => __( 'Top', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_prev_nav_button_left_spacing',
            [
                'label' => __( 'Left', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_prev_nav_button_align' => ['left'],
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_prev_nav_button_right_spacing',
            [
                'label' => __( 'Right', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .dl-slider-prev' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['absolute'],
                    'swiper_testimonial_prev_nav_button_align' => ['right'],
                ],
            ]
        );	

        $this->add_control(
            '_dl_post_navigation_section',
            [
                'label' => __( 'Button', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_navigation_height',
            [
                'label' => __( 'Height', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'height: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_navigation_width',
            [
                'label' => __( 'Width', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 50,
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'width: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_navigation_button_Horizontal_spacing',
            [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['relative'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_navigation_button_Vartical_spacing',
            [
                'label' => __( 'Vartical Position', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_nav_button_icon_alignment' => ['relative'],
                ],
            ]
        );

        $this->add_control(
            'testimonial_btn_navigation_Typography_border_radius',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_navigation_Typography',
            [
                'label' => __( 'Font Size', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button ' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_btn_navigation_Box_Shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button',
            ]
        );

        $this->start_controls_tabs(
            'testimonial_btn_navigation_style_tabs'
        );

        $this->start_controls_tab(
            'testimonial_btn_navigation_style_normal_tab',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_navigation_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_btn_navigation_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button',
            ]
        );

        $this->add_control(
            'testimonial_btn_navigation_icon_color',
            [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button' => 'color: {{VALUE}}'],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'testimonial_btn_navigation_style_hover_tab',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_navigation_hover_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover',
            ]
        );

        $this->add_control(
            'testimonial_btn_navigation_hover_icon_color',
            [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover' => 'color: {{VALUE}}'],
            ]
        );

        $this->add_control(
            'testimonial_btn_navigation_hover_border',
            [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover' => 'border-color: {{VALUE}}'],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_btn_navigation_hover_Box_Shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_testimonial_swiper_navigation .swiper_testimonial_nav_button:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_tab_pagination_style_section',
            [
                'label' => __( 'Pagination', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [ 'dl_testimonial_pagination' => 'yes']
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_button_alignment_Position',
            [
                'label' => __( 'Position', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'relative'  => __( 'Normal', 'saasland-core' ),
                    'absolute' => __( 'absolute', 'saasland-core' ),
                    'fixed' => __( 'Fixed', 'saasland-core' ),
                ],
                'default' => 'relative',
                'selectors' => [
                    '{{wrapper}} .dl_swiper_testimonial_pagination' => 'position: {{VALUE}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_top_position',
            [
                'label' => __( 'Top', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 120,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_pagination_button_alignment_Position' => ['absolute'],
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_left_position',
            [
                'label' => __( 'Left', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'swiper_testimonial_pagination_button_alignment_Position' => ['absolute'],
                ],
            ]
        );

        $this->add_control(
            '_dl_post_slider_pagination_title',
            [
                'label' => __( 'Pagination', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_dot_alignment',
            [
                'label' => __( 'Pagination Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'saasland-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'saasland-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'saasland-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_button_Horizontal_spacing',
            [
                'label' => __( 'Horizontal Spacing', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet:not(:first-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'swiper_testimonial_pagination_button_Vartical_spacing',
            [
                'label' => __( 'Vartical Spacing', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_swiper_testimonial_pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_btn_pagination_border_radius',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->start_controls_tabs(
            'testimonial_tab_pagination_style_tabs'
        );

        $this->start_controls_tab(
            'testimonial_tab_pagination_style_normal_tab',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );
        
        $this->add_responsive_control(
            'testimonial_btn_pagination_height',
            [
                'label' => __( 'Height', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_pagination_width',
            [
                'label' => __( 'Width', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{VALUE}}px',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_pagination_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_btn_pagination_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'testimonial_tab_pagination_style_active_tab',
            [
                'label' => __( 'Active', 'saasland-core' ),
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_active_pagination_height',
            [
                'label' => __( 'Height', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{VALUE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_btn_active_pagination_width',
            [
                'label' => __( 'Width', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{VALUE}}px',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'testimonial_btn_active_pagination_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_btn_active_pagination_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        do_action('dl_pro_testimonial_navigation', $this);
    }  

    //Html render
    protected function render() {   
        $settings = $this->get_settings_for_display();
        extract($settings);

        $testimonial_id = $this->get_id();

        $testimonial_settings = [];
        $testimonial_settings['slidesPerView'] = $dl_testimonial_perpage;
        $testimonial_settings['loop'] = ($dl_testimonial_loop == 'yes') ? true : false;
        $testimonial_settings['speed'] = $dl_testimonial_speed;
		if( $dl_testimonial_autoplay == true){
            $testimonial_settings['autoplay']['delay'] = $dl_testimonial_auto_delay;
        } 
        
        $testimonial_settings['effect'] = $dl_testimonial_effect;
        $testimonial_settings['spaceBetween'] = $dl_testimonial_space;
        $testimonial_settings['slidesPerColumnFill'] = 'column';
        $testimonial_settings['centeredSlides'] = ($dl_testimonial_centered == 'no') ? false : true;
        $testimonial_settings['centeredSlides'] = ($dl_testimonial_centered == 'yes') ? true : false;
        $testimonial_settings['direction'] = ($dl_testimonial_direction == 'yes') ? 'vertical' : 'horizontal';
        if( $dl_testimonial_enable_slide_control == 'yes'){
            $testimonial_settings['navigation']['nextEl'] = '.dl-slider-next'.$testimonial_id;
            $testimonial_settings['navigation']['prevEl'] = '.dl-slider-prev'.$testimonial_id;
        }
        if( $dl_testimonial_pagination == 'yes'){
            $testimonial_settings['pagination']['el'] = '.dl_testimonial_pag'.$testimonial_id;
            $testimonial_settings['pagination']['type'] = $dl_testimonial_pagination_type;
            $testimonial_settings['pagination']['clickable'] = '!0';
        }
        if( $dl_breakpoints_enable == 'yes'){
            foreach($dl_breakpoints as $k=>$v){
                $width = $v['dl_breakpoints_width'];
                $testimonial_settings['breakpoints'][$width]['slidesPerView'] = $v['dl_breakpoints_perpage'];
                $testimonial_settings['breakpoints'][$width]['spaceBetween'] = $v['dl_breakpoints_space'];
                $testimonial_settings['breakpoints'][$width]['centeredSlides'] = $v['dl_breakpoints_center'];
            }
        }
        $testimonial_settings['dl_mouseover'] = ($dl_testimonial_mouseover_enable == 'yes') ? true : false;
        $testimonial_settings['dl_autoplay'] = $dl_testimonial_autoplay;

        // query part
        $query['post_status'] = 'publish';
		$query['suppress_filters'] = false;
		if($_dl_post_blog_queryby == 'postype'){
			$query['post_type'] = isset($_dl_post_blog_posttype) ? $_dl_post_blog_posttype : ['post'];
		}else{
			$query['post_type'] = ['post'];
		}
		
		$query['orderby'] = $_dl_post_blog_order_by;

		if( !empty($_dl_post_blog_order) ){
			$query['order'] = $_dl_post_blog_order;
		}

		if( !empty($_dl_post_blog_limit) ){
			$query['posts_per_page'] = (int) $_dl_post_blog_limit;
		}
        
		if( !empty($_dl_post_blog_offset) ){
			$query['offset'] = (int) $_dl_post_blog_offset;
		}

		if($_dl_post_blog_queryby == 'categories'){
			if( is_array($_dl_post_blog_categories) && sizeof($_dl_post_blog_categories) > 0){
				$cate_query = [
					[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $_dl_post_blog_categories, 
					],			
					'relation' => 'AND',
				];
				$query['tax_query'] = $cate_query;
			}
		}

		if($_dl_post_blog_queryby == 'posts'){
			if( is_array($_dl_post_blog_post) && sizeof($_dl_post_blog_post) > 0){
				$query['post__in'] = $_dl_post_blog_post;
			}
		}

		$post_query = new \WP_Query( $query );

        ?>
    
        <div class="dl_pro_testimonial_wrapper dl-slider-<?php echo esc_attr($testimonial_id);?>">  
            <div class="dl_pro_post_slider swiper-container" data-settings='<?php echo json_encode($testimonial_settings, true);?>'>
                <div class="swiper-wrapper">
                    <?php 
                    if ( $post_query->have_posts() ) {
                        while ( $post_query->have_posts() ) : 
                            $post_query->the_post();
                    ?>
                    <div class="swiper-slide">
                        <div class="dl_post_slider_item">

                            <div class="dl_post_carousel_thumb">
                                <a href="<?php the_permalink();?>" class="droit-image-link">
                                   <?php the_post_thumbnail(); ?>
                                </a>
                            </div>
                            <div class="dl_post_content">
                            <?php
                                foreach($_dl_post_ordering_data as $order){
                                    
                                    $id_order = isset($order['_dl_post_order_id']) ? $order['_dl_post_order_id'] : '';

                                    if('yes' !== $order['_dl_post_order_enable'] ){
                                        continue;
                                    }

                                    switch( $id_order ){
                                        case 'blog_title':
                                            ?>
                                                <a href="<?php the_permalink();?>"><h2><?php echo get_the_title();?></h2></a>
                                            <?php
                                        break;

                                        case 'blog_content':
                                             ?>
                                             <p><?php echo wp_trim_words(get_the_content(), '55', ''); ?></p>
                                             <?php   
                                        break;

                                        case 'blog_meta':
                                            ?>
                                            <ul class="dl_entry_meta">
                                                <li><?php echo esc_html(get_the_date())?></li>
                                                <li><a href="#0"><?php echo esc_html(get_the_author())?></a></li>
                                            </ul>
                                            <?php
                                        break;    

                                        case 'blog_cate':
                                            ?>
                                            <div class="dl_post_category">
                                                <?php the_category( ' ' ); ?>
                                            </div>
                                            <?php
                                        break;  

                                        case 'blog_button':
                                            ?>
                                            <a href="<?php the_permalink();?>" class="dl_post_details"><?php echo esc_html__('Load More', 'saasland-core')?></a>
                                            <?php
                                        break;
                                    }

                                } 
                                
                            ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                    endwhile;
                    }
                    ?>
                </div>
            </div>
            <?php if( $dl_testimonial_enable_slide_control == 'yes'){?>
                <div class="dl_testimonial_swiper_navigation">
                    <div class="swiper_testimonial_nav_button dl-slider-prev dl-slider-prev<?php echo esc_attr($testimonial_id) ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['dl_testimonial_nav_left_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                    <div class="swiper_testimonial_nav_button dl-slider-next dl-slider-next<?php echo esc_attr($testimonial_id) ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['dl_testimonial_nav_right_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                </div>
            <?php }
            
            if( $dl_testimonial_pagination == 'yes'){?>
            <div class="dl_swiper_testimonial_pagination dl_testimonial_pag<?php echo esc_attr($testimonial_id) ?>"></div>
            <?php } ?>
        </div>

        <?php
    }

    protected function content_template()
    {}

    public static function get_posts(){
        $post_args = array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post_type'        => 'post',
        );
        $_posts = get_posts($post_args);
        $posts_list = [];
        foreach ($_posts as $_key => $object) {
            $posts_list[$object->ID] = $object->post_title;
        }
        return $posts_list;
    }

    public static function get_category( $cate = 'post' ){
        $post_cat = self::_get_terms($cate);
        
        $taxonomy	 = isset($post_cat[0]) && !empty($post_cat[0]) ? $post_cat[0] : ['category'];
        $query_args = [
            'taxonomy'      => $taxonomy,
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ];
        $terms = get_terms( $query_args );

        $options = [];
        $count = count( (array) $terms);
        if($count > 0):
            foreach ($terms as $term) {
                if( $term->parent == 0 ) {
                    $options[$term->term_id] = $term->name;
                    foreach( $terms as $subcategory ) {
                        if($subcategory->parent == $term->term_id) {
                            $options[$subcategory->term_id] = $subcategory->name;
                        }
                    }
                }
            }
        endif;      
        return $options;
    }
    
    public static function get_taxonomies( $cate = 'post', $type = 0){
        $post_cat = self::_get_terms($cate);
        
        $tag	 = isset($post_cat[$type]) && !empty($post_cat[$type]) ? $post_cat[$type] : 'category';
        $terms = get_terms( array(
            'taxonomy' => $tag, 
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ) );
      
        return $terms;
    }

    public static function  _get_terms( $post = 'post'){
        $taxonomy_objects = get_object_taxonomies( $post );
     return $taxonomy_objects;
    }

    public static function get_posttype(){
        $post_types = get_post_types(
            array(
                'public' => true,
            ),
            'objects'
        );

        $options = array();

        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->label;
        }

        return $options;
    }
}
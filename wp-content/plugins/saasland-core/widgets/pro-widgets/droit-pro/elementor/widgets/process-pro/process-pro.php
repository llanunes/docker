<?php
namespace DROIT_ELEMENTOR_PRO\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Process_Pro extends \Elementor\Widget_Base{

    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    
    public function get_name()
    {
        return 'dladdons-process-pro';
    }

    public function get_title()
    {
        return esc_html__( 'Process Pro', 'saasland-core' );
    }

    public function get_icon()
    {
        return 'dlicons-process addons-icon';
    }

    public function get_categories()
    {
        return ['droit_addons_pro'];
    }

    public function get_keywords()
    {
        return [ 'process', 'timer' ];
    }

    protected function register_controls()
    {
        do_action('dl_widgets/process_pro/register_control/start', $this);

        // add content 
        $this->__content_control();
        
        //style section
        $this->__styles_control();
        
        do_action('dl_widgets/process_pro/register_control/end', $this);

        // by default
        do_action('dl_widget/section/style/custom_css', $this);
        
    }

    public function __content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_dl_pro_process_content_section',
            [
                'label' => __('Content', 'saasland-core'),
            ]
        );

        $this->content_repeater_controls();

        $this->end_controls_section();
        //start subscribe layout end

        $this->process_show();

    }

    // Process Repeater
    protected function content_repeater_controls()
    {
        $repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( '_dl_process_repeat_tabs' );

		$repeater->start_controls_tab( '_dl_process_repeat_content',
			[ 
				'label' => esc_html__( 'Content', 'saasland-core'),
			] 
		);
        $repeater->add_control(
            '_dl_pro_process_title', [
                'label' => __('Title', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Title', 'saasland-core'),
                'default' => __('Enter Title', 'saasland-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            '_dl_pro_process_title_link',
            [
                'label' => __('Link', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'saasland-core'),
                'show_external' => true,
                'default' => [
                    'url' => 'https://your-link.com',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            '_dl_pro_process_text', [
                'label' => __('Content', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter Content', 'saasland-core'),
                'default' => __('Enter Content', 'saasland-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
			'_dl_pro_process_icon',
			[
				'label' => __( 'Icon', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

        $repeater->end_controls_tab();

		$repeater->start_controls_tab( '_dl_process_repeat_style',
			[ 
				'label' => esc_html__( 'Style', 'saasland-core')
			] 
		);
		$repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_process_circle_bg_color',
                'label' => 'Circle Background',
                'types' => ['classic', 'gradient'],
				'selector' => 
					'{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box .dl_icon',
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_process_circlebox_hsadow',
                'label' => __('Box Shadow', 'saasland-core'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box .dl_icon',
            ]
        );
        $repeater->add_responsive_control(
            '_dl_pro_process_icon_width',
            [
                'label' => __('Icon Circle Width', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box .dl_icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $repeater->add_responsive_control(
            '_dl_pro_process_icon_height',
            [
                'label' => __('Icon Circle Height', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box .dl_icon' =>'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $repeater->add_responsive_control(
			'__dl_pro_process_after_border_rotate',
			[
				'label' => __( 'Border Rotate', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box:after' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
	    $repeater->add_responsive_control(
            '_dl_pro_process_after_border_position',
            [
                'label' => __('Border Position', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box:after' =>'top: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $repeater->add_control(
            '_dl_pro_process_position_control',
            [
                'label' => esc_html__('Position', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'relative'  => __( 'Default', 'saasland-core' ),
                    'absolute'  => __( 'Absolute', 'saasland-core' ),
                    'fixed'     => __( 'Fixed', 'saasland-core' ),
                ],
                'default' => 'relative',
                'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box ' => 'position: {{VALUE}}',],
            ]
        );

        $repeater->add_control(
            'dl_item_position',
            [
                'label' => __( '', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'Default', 'saasland-core' ),
                'label_on' => __( 'Custom', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    '_dl_pro_process_position_control' => ['absolute', 'relative', 'fixed']
                ]
            ]
        );

        $repeater->start_popover();

        $start = is_rtl() ? __( 'Right', 'saasland-core' ) : __( 'Left', 'saasland-core' );
        $end = ! is_rtl() ? __( 'Right', 'saasland-core' ) : __( 'Left', 'saasland-core' );

        $repeater->add_control(
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

        $repeater->add_responsive_control(
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
                    'body:not(.rtl) {{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box' => 'left: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box' => 'right: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_h!' => 'end',
                ],
            ]
        );

        $repeater->add_responsive_control(
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
                    'body:not(.rtl) {{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box' => 'right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box' => 'left: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_h' => 'end',
                ],
            ]
        );

        $repeater->add_control(
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

        $repeater->add_responsive_control(
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box' => 'top: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_v!' => 'end',
                ],
            ]
        );

        $repeater->add_responsive_control(
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} .dl_single_process_box' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'dl_offset_orientation_v' => 'end',
                ],
            ]
        );
       
        $repeater->end_popover();


		$repeater->end_controls_tab();
				
		$repeater->end_controls_tabs();

        do_action('dl_pro_process', $repeater);
        $this->add_control(
            '_dl_pro_process_list',
            [
                'label' => __('Process', 'saasland-core'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_dl_pro_process_title' => __('Droitthemes', 'saasland-core'),
                        '_dl_pro_process_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'saasland-core'),
                    ],
                    [
                        '_dl_pro_process_title' => __('Droitthemes', 'saasland-core'),
                        '_dl_pro_process_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'saasland-core'),
                    ],
                    [
                        '_dl_pro_process_title' => __('Droitthemes', 'saasland-core'),
                        '_dl_pro_process_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'saasland-core'),
                    ],
                    [
                        '_dl_pro_process_title' => __('Droitthemes', 'saasland-core'),
                        '_dl_pro_process_text' => __(' “Droitadons presents your services with flexible, convenient and multipurpose layouts. You can select your favorite.“', 'saasland-core'),
                    ],

                ],
                'title_field' => '{{{ _dl_pro_process_title }}}',
            ]
        );
    }

    // process show
    protected function process_show()
    {
        $this->start_controls_section(
			'droit_section_process',
			[
				'label' => __( 'Process Content Show Button', 'saasland-core' ),
			]
		);

        $this->add_control(
			'dl_pro_process_titel',
			[
				'label' => __( 'Show Title', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'saasland-core' ),
				'label_off' => __( 'Hide', 'saasland-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'dl_pro_process_content',
			[
				'label' => __( 'Show Content', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'saasland-core' ),
				'label_off' => __( 'Hide', 'saasland-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->end_controls_section();
    }

    public function __styles_control(){
        $this->layout_style_controls();
        $this->general_style_controls();
        $this->style_before_controls();
        $this->style_one_controls();
        $this->style_two_controls();
    }

    public function layout_style_controls(){
        $this->start_controls_section(
            '_dl_pro_process_style_layout',
            [
                'label' => esc_html__('Layout ', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'_dl_pro_process_alignment',
			[
				'label' => __( 'Alignment', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'mr-auto' => [
						'title' => __( 'Left', 'saasland-core' ),
						'icon' => 'fa fa-align-left',
					],
					'm-auto' => [
						'title' => __( 'Center', 'saasland-core' ),
						'icon' => 'fa fa-align-center',
					],
					'ml-auto' => [
						'title' => __( 'Right', 'saasland-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
                'default' => 'm-auto',
				'toggle' => true,
			]
		);
        $this->end_controls_section();
    }

    //General
    public function general_style_controls(){
        $this->start_controls_section(
            '_dl_pro_process_style_general',
            [
                'label' => esc_html__('General', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            '_dl_process_box_width',
            [
                'label' => __('Width', 'saasland-core'),
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
                    '{{WRAPPER}} .dl_process_box_container' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            '_dl_process_box_height',
            [
                'label' => __('Height', 'saasland-core'),
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
                    '{{WRAPPER}} .dl_process_box_container' =>'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
			'_dl_process_box_v_alignment',
			[
				'label' => __( 'Icon Vertical Position', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex-start',
				'options' => [
					'flex-start' => __( 'Left', 'saasland-core' ),
					'center' => __( 'Center', 'saasland-core' ),
					'flex-end' => __( 'Right', 'saasland-core' ),
					'space-between' => __( 'Space', 'saasland-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .dl_process_box_container' => 'justify-content: {{VALUE}};',	
				],
				'toggle' => false,
			]
		);
        $this->add_control(
            '_dl_process_box_radius',
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
                    '{{WRAPPER}} .dl_process_box_container' =>'border-radius: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_process_box_border_controls',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_process_box_container',
            ]
        );
        
        $this->add_control(
			'_dl_pro_process_box',
			[
				'label' => __( 'Show Before', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'saasland-core' ),
				'label_off' => __( 'Hide', 'saasland-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->end_controls_section();
    }

    public function style_before_controls()
    {
        $this->start_controls_section(
            '_dl_pro_process_box_before',
            [
                'label' => esc_html__('Box Before', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => ['_dl_pro_process_box' => 'yes']
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_process_circle_bg_color',
                'label' => 'Circle Background',
                'types' => ['classic', 'gradient'],
				'selector' => 
					'{{WRAPPER}} .dl_process_box_container:before',
            ]
        );
        
        $this->add_responsive_control(
            '_dl_pro_process_box_before_width',
            [
                'label' => __('Width', 'saasland-core'),
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
                    '{{WRAPPER}} .dl_process_box_container:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            '_dl_pro_process_box_before_height',
            [
                'label' => __('Height', 'saasland-core'),
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
                    '{{WRAPPER}} .dl_process_box_container:before' =>'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->end_controls_section();
    }


    //Icon Style
    public function style_one_controls()
    {
        $this->start_controls_section(
            '_dl_pro_process_icon_style',
            [
                'label' => esc_html__('Icon Box Style', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
			'_dl_pro_process_icon_size',
			[
				'label' => __( 'Icon Size', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box .dl_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dl_single_process_box .dl_icon svg' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            '_dl_pro_process_icon_color',
            [
                'label' => esc_html__('Icon Color', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_single_process_box .dl_icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dl_single_process_box .dl_icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_process_after_border_controls',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_single_process_box:after',
            ]
        );

        $this->add_control(
            '_dl_pro_process_icon_border_radius',
            [
                'label' => __('Border Radius', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_single_process_box .dl_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //Content Style
    public function style_two_controls()
    {
        $this->start_controls_section(
            '_dl_pro_process_content_style',
            [
                'label' => esc_html__('Content Style', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'process_title_style',
                'label' => __('Title Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_single_process_box .dl_title a',
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
			'_dl_pro_process_heading_Spacing',
			[
				'label' => __( 'Title Spacing', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box .dl_title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \DROIT_ELEMENTOR_PRO\Content_Typography::get_type(),
            [
                'name' => 'process_content_style',
                'label' => __('Content Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .dl_single_process_box .dl_desc',
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
			'_dl_pro_process_content_Spacing',
			[
				'label' => __( 'Content Spacing', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .dl_single_process_box .dl_desc' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }


    //Html render
    protected function render()
    {   
        $settings = $this->get_settings_for_display();
        extract($settings);
        ?>
            <div class="dl_process_box_container <?php echo esc_attr($settings['_dl_pro_process_alignment'])?>">
                <?php foreach($_dl_pro_process_list as $v){?>
                <div class="dl_process_box_four_colum <?php echo esc_attr_e('elementor-repeater-item-'.$v['_id']);?>">
                    <div class="dl_single_process_box dl_style_07">
                        <div class="dl_icon">
                            <?php \Elementor\Icons_Manager::render_icon( $v['_dl_pro_process_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        <?php if ( $dl_pro_process_titel == 'yes' ) : ?>
                            <h4 class="dl_title"> <a href="<?php echo esc_html_e( $v['_dl_pro_process_title_link']['url'] ); ?>"><?php echo esc_html_e($v['_dl_pro_process_title'], 'saasland-core');?></a> </h4>
                        <?php endif; ?>
                        <?php if ( $dl_pro_process_content == 'yes' ) : ?>
                            <p class="dl_desc"><?php echo esc_html_e($v['_dl_pro_process_text'], 'saasland-core')?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php }?>
            </div>
        <?php
    }
    

    protected function content_template()
    {}
}


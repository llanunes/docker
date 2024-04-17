<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Hero_Section
 * @package SaaslandCore\Widgets
 */
class Hero_Section extends Widget_Base {
    public function get_name() {
        return 'saasland_hero';
    }  

    public function get_title() {
        return __( 'Hero Section', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'splitting', 'hero-event', 'hero-chat', 'saasland-hero' ];
    }

    public function get_script_depends() {
        return [ 'parallax', 'typed', 'splitting', 'parallaxie' ];
    }

    public function get_keywords() {
        return [ 'landing hero', 'Mail', 'Digital Marketing', 'Payment Processing', 'Hosting', 'Cloud', 'Background Slide Show', 'Chat', 'Event', 'Demo landing' ];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'hero_preset', [
                'label' => __( 'Hero Presets', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Select Banner Style', 'kidzo-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    'style_01' => 'Style 1',
                    'style_02' => 'Style 2',
                    'style_03' => 'Style 3',
                    'style_04' => 'Style 4',
                    'style_05' => 'Style 5',
                    'style_06' => 'Style 6',
                    'style_07' => 'Style 7',
                    'style_08' => 'Style 8',
                    'style_09' => 'Style 9',
                    'style_10' => 'Style 10',
                    'style_11' => 'Style 11',
                    'style_12' => 'Style 12',
                    'style_13' => 'Style 12',
                    'style_14' => 'Style 14',
                    'style_15' => 'Style 15',
                    'style_16' => 'Style 16',

                ],
                'default' => 'style_01'
            ]
        );

        // $this->add_control(
        //     'style', [
        //         'label' => esc_html__( 'Skin', 'saasland-core' ),
        //         'type' => \Elementor\Controls_Manager::CHOOSE,
        //         'options' => [
        //             'style_01' => [
        //                 'title' => __( '01: Mail', 'saasland-core' ),
        //                 'icon' => 'hero1',
        //             ],
        //             'style_02' => [
        //                 'title' => __( '02: Digital Marketing', 'saasland-core' ),
        //                 'icon' => 'hero2',
        //             ],
        //             'style_03' => [
        //                 'title' => __( '03: Cloud', 'saasland-core' ),
        //                 'icon' => 'hero3',
        //             ],
        //             'style_04' => [
        //                 'title' => __( '04: Dark', 'saasland-core' ),
        //                 'icon' => 'hero4',
        //             ],
        //             'style_05' => [
        //                 'title' => __( '05: Startup', 'saasland-core' ),
        //                 'icon' => 'hero5',
        //             ],
        //             'style_06' => [
        //                 'title' => __( '06: Payment Processing', 'saasland-core' ),
        //                 'icon' => 'hero6',
        //             ],
        //             'style_07' => [
        //                 'title' => __( '07: HR Management', 'saasland-core' ),
        //                 'icon' => 'hero7',
        //             ],
        //             'style_08' => [
        //                 'title' => __( '08: Hosting', 'saasland-core' ),
        //                 'icon' => 'hero8',
        //             ],
        //             'style_09' => [
        //                 'title' => __( '09: Background Slide Show', 'saasland-core' ),
        //                 'icon' => 'hero9',
        //             ],
        //             'style_10' => [
        //                 'title' => __( '10: Analytics', 'saasland-core' ),
        //                 'icon' => 'hero10',
        //             ],
        //             'style_11' => [
        //                 'title' => __( '11: Demo Landing', 'saasland-core' ),
        //                 'icon' => 'hero11',
        //             ],
        //             'style_12' => [
        //                 'title' => __( '12: Chat', 'saasland-core' ),
        //                 'icon' => 'hero12',
        //             ],
        //             'style_13' => [
        //                 'title' => __( '13: Event', 'saasland-core' ),
        //                 'icon' => 'hero13',
        //             ],
        //             'style_14' => [
        //                 'title' => __( '14: Digital Agency', 'saasland-core' ),
        //                 'icon' => 'hero14',
        //             ],
        //             'style_15' => [
        //                 'title' => __( '15: Digital Agency', 'saasland-core' ),
        //                 'icon' => 'hero15',
        //             ],
        //             'style_16' => [
        //                 'title' => __( '16: Education', 'saasland-core' ),
        //                 'icon' => 'hero16',
        //             ],
        //         ],
        //         'default' => 'style_01'
        //     ]
        // );

        $this->end_controls_section();
        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content', [
                'label' => __( 'Hero content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'title_note', [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Input the Typed words within curly braces. <br>Eg Title, True Multi-Purpose Theme for {Saas, Startup, Business} and more.', 'saasland-core' ),
                'content_classes' => 'elementor-warning',
            ]
        );

        $this->add_control(
            'title_html_tag', [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_el_select_title_tag(),
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'condition' => [
                    'style!' => [ 'style_11', 'style_12'] //Is Not Equal
                ]
            ]
        );

        $this->end_controls_section(); // End Hero content


        // ---------------------------------------- Upper Title Home Chat --------------------------------
        $this->start_controls_section(
            'upper_title_sec', [
                'label' => __( 'Upper Title', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_12', 'style_13', 'style_15' ]
                ]
            ]
        );

        $this->add_control(
            'upper_title_img', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_12'
                ]
            ]
        );

        $this->add_control(
            'upper_title', [
                'label' => esc_html__( 'Upper Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Live chat'
            ]
        );

        $this->add_control(
            'upper_title_color_style', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upper-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'upper_title_bg_color_style', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .chat_banner_content .c_tag' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .upper-title' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_12', 'style_15']
                ]
            ]
        );

        $this->add_responsive_control(
            'badge_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .banner_text_intro .brand_name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'style_15'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'upper_title_typo',
                'selector' => '{{WRAPPER}} .upper-title',
            ]
        );

        $this->end_controls_section(); // End Upper Title

        // ----------------------------------  Featured Images (style 11) -----
        $this->start_controls_section(
            'df_images_sec', [
                'label' => __( 'Featured Images', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_11']
                ]
            ]
        );

        $df_images = new \Elementor\Repeater();
        $df_images->add_control(
            'df_items', [
                'label' => __( 'View', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HIDDEN,
            ]
        );

        $df_images->add_control(
            'df_image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $df_images->add_responsive_control(
            'df_horizontal', [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1920,
                        'max' => 1920,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $df_images->add_responsive_control(
            'df_vertical', [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1900,
                        'max' => 1900,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $df_images->add_responsive_control(
            'df_delay', [
                'label' => __( 'Delay Time', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0.2',
            ]
        );

        $df_images->add_responsive_control(
            'df_depth', [
                'label' => __( 'Data Depth', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0.2',
            ]
        );

        $df_images->add_responsive_control(
            'df_z_index', [
                'label' => __( 'Z-Index', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'demo_feature_images', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ df_items }}}',
                'fields' => $df_images->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->add_control(
            'is_parallax_f_images', [
                'label' => __( 'Parallax on Featured Images', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->end_controls_section(); // End Demo Featured Images

        // -------------------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage1_sec', [
                'label' => __( 'Featured Image/Video', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_07', 'style_10', 'style_14']
                ]
            ]
        );

        $this->add_control(
			'feature_style',
			[
				'label' => esc_html__( 'Feature Type', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'images',
				'options' => [
					'images'  => esc_html__( 'Images', 'saasland-core' ),
					'video' => esc_html__( 'Video', 'saasland-core' ),
				],
			]
		);

        $this->add_control(
            'fimage1', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'feature_style' => 'images',
                ],
                'default' => [
                    'url' => plugins_url( 'hero/images/women.png', __FILE__)
                ]
            ]
        );
        $this->add_responsive_control(
            'fimage1_size', [
                'label' => __( 'Image max width', 'saasland-core' ),
                'condition' => [
                    'feature_style' => 'images',
                ],
                'description' => esc_html__( 'Default image width is 100% and height is auto. Input the size in pixel unit.', ''),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mobile_img .women_img' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stratup_app_screen .phone' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .banner_image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'feature_video',
            [
                'label' => esc_html__( 'Youtube Video Code', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'OZRWcCsvOXQ', 'saasland-core' ),
                'condition' => [
                    'feature_style' => 'video',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
			'feature_video_height',
			[
				'label' => __( 'Video Height', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'feature_style' => 'video',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'height: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        $this->add_control(
			'feature_video_width',
			[
				'label' => __( 'Video Width', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'feature_style' => 'video',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'width: {{SIZE}}{{UNIT}}',
                ],
			]
		);
        $this->add_responsive_control(
            'feature_video__margin',
            [
                'label'      => esc_html__('Margin', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style' => 'video',
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .video_popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_video_padding',
            [
                'label'      => esc_html__('Padding', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style' => 'video',
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .video_popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'feature_video_border',
                'condition' => [
                    'feature_style' => 'video',
                ],
                'label' => __('Box Border', 'saasland-core'),
                'selector' => '{{WRAPPER}} .video_popup',
            ]
        );

        $this->add_responsive_control(
            'feature_video_border_radius',
            [
                'label' => __('Border Radius', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style' => 'video',
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section(); // End Featured image

        //------------------------------------ Second Featured image -----------------------------------//
        $this->start_controls_section(
            'fimage2_sec', [
                'label' => __( 'Second Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_07']
                ]
            ]
        );

        $this->add_control(
            'fimage2', [
                'label' => esc_html__( 'Upload the image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/mobile.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image

        // -------------------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage3_sec', [
                'label' => __( 'Featured image/Video', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04', 'style_05', 'style_06', 'style_08', 'style_12']
                ]
            ]
        );

        $this->add_control(
			'feature_style2',
			[
				'label' => esc_html__( 'Feature Type', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'images',
				'options' => [
					'images'  => esc_html__( 'Images', 'saasland-core' ),
					'video' => esc_html__( 'Video', 'saasland-core' ),
				],
			]
		);

        $this->add_control(
            'fimage3', [
                'label' => esc_html__( 'The Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'feature_style2' => 'images',
                ],
                'default' => [
                    'url' => plugins_url( 'hero/images/banner_img.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'feature_video2',
            [
                'label' => esc_html__( 'Youtube Video Code', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'OZRWcCsvOXQ', 'saasland-core' ),
                'condition' => [
                    'feature_style2' => 'video',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
			'feature_video_height2',
			[
				'label' => __( 'Video Height', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'feature_style2' => 'video',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'height: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        $this->add_control(
			'feature_video_width2',
			[
				'label' => __( 'Video Width', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'feature_style2' => 'video',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'width: {{SIZE}}{{UNIT}}',
                ],
			]
		);
        $this->add_responsive_control(
            'feature_video__margin2',
            [
                'label'      => esc_html__('Margin', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style2' => 'video',
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .video_popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_video_padding2',
            [
                'label'      => esc_html__('Padding', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style2' => 'video',
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .video_popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'feature_video_border2',
                'condition' => [
                    'feature_style2' => 'video',
                ],
                'label' => __('Box Border', 'saasland-core'),
                'selector' => '{{WRAPPER}} .video_popup',
            ]
        );

        $this->add_responsive_control(
            'feature_video_border_radius2',
            [
                'label' => __('Border Radius', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style2' => 'video',
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        /**
         * Featured Image for Home Chat
         */
        $this->add_control(
            'chat_fimage1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' =>  'style_12'
                ]
            ]
        );

        $this->add_control(
            'chat_fimage2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' =>  'style_12'
                ]
            ]
        );

        $this->add_control(
            'chat_fimage3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' =>  'style_12'
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image


        /// -----------------------------  Hero POS Slide Images ----------------------------------//
        $this->start_controls_section(
            'bg_slide-show_sec',
            [
                'label' => __( 'Background Slide Show', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_09'
                ]
            ]
        );

        $this->add_control(
            'bg_overlay_color', [
                'label' => __( 'Overlay Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .pos_slider:before' => 'background: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'pos_slide_images', [
                'label' => __( 'Slides', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->end_controls_section();


        // ------------------------------ Logos ------------------------------//
        $this->start_controls_section(
            'btm_logos', [
                'label' => __( 'Bottom Logos', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'logos', [
                'label' => esc_html__( 'Upload Logos', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->end_controls_section(); // End Featured image


        //============================== Buttons ===============================//
        $this->start_controls_section(
            'buttons_sec', [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        //======== Repeater Buttons
        $buttons = new \Elementor\Repeater();
        $buttons->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $buttons->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $buttons->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $buttons->start_controls_tab(
            'style_normal_btn', [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $buttons->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $buttons->end_controls_tab();

        /// Hover Button Style
        $buttons->start_controls_tab(
            'style_hover_btn', [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $buttons->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $buttons->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '.header_area.navbar_fixed {{WRAPPER}} .nav_right_btn {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $buttons->end_controls_tab();
        $buttons->end_controls_tabs();

        $buttons->add_responsive_control(
            'btn_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_responsive_control(
            'btn_margin', [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_responsive_control(
            'btn_border_radius', [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $buttons->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'btn_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $buttons->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'btn_typo',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        // Buttons repeater field
        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $buttons->get_controls(),
                'condition' => [
                    'style!' => 'style_15' // is not equal
                ]
            ]
        );

        //============= Bottom Text Home Chat
        $this->add_control(
            'is_bottom_text_btn', [
                'label' => __( 'Bottom Button Text', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => [ 'style_12']
                ]
            ]
        );

        $this->add_control(
            'bottom_text_btn', [
                'label' => __( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'style',
                            'operator' => 'in',
                            'value' => ['style_15']
                        ],
                        [
                            'name' => 'is_bottom_text_btn',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ],
            ]
        );

        $this->add_control(
            'bottom_btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'condition' => [
                    'style' => 'style_15'
                ],
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'bottom_text_btn_color_style', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button' => 'color: {{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'style',
                            'operator' => 'in',
                            'value' => ['style_15']
                        ],
                        [
                            'name' => 'is_bottom_text_btn',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'bottom_text_btn_content_typo',
                'selector' => '{{WRAPPER}} .button',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'style',
                            'operator' => 'in',
                            'value' => ['style_15']
                        ],
                        [
                            'name' => 'is_bottom_text_btn',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ],
            ]
        );

        $this->add_control(
            'is_play_btn', [
                'label' => __( 'Play Button', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => ['style_03', 'style_07', 'style_09', 'style_13', 'style_14']
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'play_btn_title', [
                'label' => __( 'Play Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Watch Video',
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_url', [
                'label' => __( 'Video URL', 'saasland-core' ),
                'description' => __( 'Enter here a YouTube video URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_color', [
                'label' => __( 'Play Button Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .video_btn .icon, {{WRAPPER}} .video_btn span:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .video_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} a.popup-youtube.btn_six.slider_btn:hover' => 'background-color: {{VALUE}}; color: #fff;',
                    '{{WRAPPER}} a.popup-youtube.btn_six.slider_btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .event_btn_two' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .banner_content .play_btn span' => 'color: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .banner_content .play_btn span' => 'background: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_hover_text_color', [
                'label' => __( 'Hover Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .event_btn_two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .banner_content .play_btn span:hover' => 'color: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_hover_color', [
                'label' => __( 'Hover Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .event_btn_two:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .banner_content .play_btn span:hover' => 'background: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->end_controls_section(); // End Buttons

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .l_height60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.t_color3.mb_40' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_500.f_size_50.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_size_40.w_color.mb-0' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .l_height50.w_color.mb_20' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.f_size_50.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_color_s.wow' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pos_banner_text .saasland_hero_pos' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saasland_html_class_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner_text h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .startup_content_three h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner_text_intro h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'selector' => '
                    {{WRAPPER}} .l_height50.w_color.mb_20,
                    {{WRAPPER}} .l_height60,
                    {{WRAPPER}} .f_700.t_color3.mb_40,
                    {{WRAPPER}} .f_500.f_size_50.w_color,
                    {{WRAPPER}} .f_size_40.w_color.mb-0,
                    {{WRAPPER}} .f_700.f_size_50.w_color,
                    {{WRAPPER}} .hosting_color_s.wow,
                    {{WRAPPER}} .pos_banner_text .saasland_hero_pos,
                    {{WRAPPER}} .saasland_html_class_color,
                    {{WRAPPER}} .banner_text h2,
                    {{WRAPPER}} .banner_text_intro h2,
                    {{WRAPPER}} .startup_content_three h2,
                    {{WRAPPER}} .title
                ',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_prefix',
                'selector' => '
                    {{WRAPPER}} .l_height60,
                    {{WRAPPER}} .l_height50.w_color.mb_20,
                    {{WRAPPER}} .f_700.t_color3.mb_40,
                    {{WRAPPER}} .f_500.f_size_50.w_color,
                    {{WRAPPER}} .f_size_40.w_color.mb-0,
                    {{WRAPPER}} .f_700.f_size_50.w_color,
                    {{WRAPPER}} .hosting_color_s.wow,
                    {{WRAPPER}} .pos_banner_text .saasland_hero_pos,
                    {{WRAPPER}} .saasland_html_class_color,
                    {{WRAPPER}} .banner_text h2,
                    {{WRAPPER}} .banner_text_intro h2,
                    {{WRAPPER}} .startup_content_three h2,
                    {{WRAPPER}} .title
                ',
            ]
        );

        $this->add_control(
            'color_typed_text', [
                'label' => __( 'Typed Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} h2 mark' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style!' => [ 'style_14', 'style_15', 'style_16' ]
                ]
            ]
        );

        $this->add_control(
            'color_underline_typed_text', [
                'label' => __( 'Typed Text Underline Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .typewrite_title mark:after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style!' => [ 'style_14', 'style_15', 'style_16' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'title_border_height',
            [
                'label' => __( 'Underline Height', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .typewrite_title mark:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style!' => [ 'style_14', 'style_15', 'style_16' ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typewrite_title_typo',
                'selector' => '{{WRAPPER}} .typewrite_title mark span',
                'condition' => [
                    'style!' => [ 'style_14', 'style_15', 'style_16' ]
                ]
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style!' => [ 'style_12', 'style_13' ]
                ]
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .startup_content_three p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_300.l_height28' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_banner_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_banner_content.text-center p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .payment_banner_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pos_banner_text h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .h_analytics_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner_text_intro p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner_text p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .corporate_banner_text p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'selector' => '
                {{WRAPPER}} .slider_content p,
                {{WRAPPER}} .startup_content_three p,
                {{WRAPPER}} .f_300.l_height28,
                {{WRAPPER}} .software_banner_content p,
                {{WRAPPER}} .saas_banner_content.text-center p,
                {{WRAPPER}} .payment_banner_content p,
                {{WRAPPER}} .hosting_content p,
                {{WRAPPER}} .pos_banner_text h6,
                {{WRAPPER}} .h_analytics_content p,
                {{WRAPPER}} .banner_text_intro p,
                {{WRAPPER}} .banner_text p,
                {{WRAPPER}} .corporate_banner_text p,
                {{WRAPPER}} .content
                ',
            ]
        );

        $this->end_controls_section(); // End Subtitle

        /**
         * Shape Images (Style 01)
         **/
        $this->start_controls_section(
            'mail_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_01', 'style_14' ]
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'mail_shape_img4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 04)
         **/
        $this->start_controls_section(
            'dark_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_04']
                ]
            ]
        );

        $this->add_control(
            'dark_shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape-1.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'dark_shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape2.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 06)
         **/
        $this->start_controls_section(
            'payment_pro_shape_sec', [
                'label' => __( 'Shape Image', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06'
                ]
            ]
        );

        $this->add_control(
            'payment_pro_shape_img', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/shape_home9.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 07)
         **/
        $this->start_controls_section(
            'hr_management_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_07'
                ]
            ]
        );

        $this->add_control(
            'hr_management_shape', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/startup_shap.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 08)
         **/
        $this->start_controls_section(
            'hosting_shape_img_sec',
            [
                'label' => esc_html__( 'Shape Images', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_08'
                ]
            ]
        );

        $this->add_control(
            'hos_shape1', [
                'label' => esc_html__( 'Shape One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_01.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape2', [
                'label' => esc_html__( 'Shape Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape3', [
                'label' => esc_html__( 'Shape Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape4', [
                'label' => esc_html__( 'Shape Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape5', [
                'label' => esc_html__( 'Shape Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape6', [
                'label' => esc_html__( 'Shape Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_06.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape7', [
                'label' => esc_html__( 'Shape Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_07.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'hos_shape8', [
                'label' => esc_html__( 'Shape Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( '/hero/images/home-hosting/line_08.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Hosting Shape Images


        /**
         * Shape Images (Style 10)
         **/
        $this->start_controls_section(
            'analytics_shape_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_10'
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img1', [
                'label' => esc_html__( 'Image One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_one.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img2', [
                'label' => esc_html__( 'Image Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_two.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img3', [
                'label' => esc_html__( 'Image Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_three.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img4', [
                'label' => esc_html__( 'Image Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_four.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img5', [
                'label' => esc_html__( 'Image Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_five.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'analytics_shape_img6', [
                'label' => esc_html__( 'Image Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/home-analytics/elements_six.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Shape Images (Style 11)
         **/
        $this->start_controls_section(
            'demo_shape_images_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_11']
                ]
            ]
        );

        $this->add_control(
            'demo_shape1', [
                'label' => esc_html__( 'Shape One', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/circle-2.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape2', [
                'label' => esc_html__( 'Shape Two', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_02.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape3', [
                'label' => esc_html__( 'Shape Three', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_03.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape4', [
                'label' => esc_html__( 'Shape Four', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_04.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape5', [
                'label' => esc_html__( 'Shape Five', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_05.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape6', [
                'label' => esc_html__( 'Shape Six', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_06.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape7', [
                'label' => esc_html__( 'Shape Seven', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_07.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape8', [
                'label' => esc_html__( 'Shape Eight', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/shape_08.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'demo_shape9', [
                'label' => esc_html__( 'Shape Nine', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/demo-landing/dot.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Shape Images (Style 12)
         **/
        $this->start_controls_section(
            'chat_shape_images_sec', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_12']
                ]
            ]
        );

        $this->add_control(
            'chat_shape1', [
                'label' => esc_html__( 'Moving Cloud Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'chat/img/cloud.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'chat_shape2', [
                'label' => esc_html__( 'Left Corner Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'chat/img/left_leaf.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'chat_shape3', [
                'label' => esc_html__( 'Right Corner Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'chat/img/right_leaf.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Background Style
         */
        //------------------------------ Background Color ------------------------------
        $this->start_controls_section(
            'hr_bg_color_sec', [
                'label' => __( 'Style Section Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_07', 'style_11', 'style_12'],
                ]
            ]
        );

        $this->add_control(
            'hr_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .startup_banner_area_three' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .banner_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .chat_banner_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Gradient Background Section ------------------------------
        $this->start_controls_section(
            'background_style',
            [
                'label' => esc_html__( 'Background Gradient Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_04', 'style_05', 'style_06', 'style_10', 'style_13'],
                ]
            ]
        );

        $this->add_control(
            'bg_image_stl2', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'hero/images/banner_bg_stl2.png', __FILE__)
                ],
                'condition' => [
                    'style' => [ 'style_02', 'style_13' ]
                ]
            ]
        );

        $this->add_control(
            'event_round_box_color', [
                'label'     => esc_html__( 'Round Box Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_banner_content .round' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_13'
                ]
            ]
        );

        $this->add_control(
            'section_color_left', [
                'label'     => esc_html__( 'Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_10', 'style_13'],
                ]
            ]
        );

        $this->add_control(
            'section_color_right', [
                'label'     => esc_html__( 'Background Color 02', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .slider_area'      => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .saas_banner_area' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .agency_banner_area_two' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .payment_banner_area' => 'background-image: -webkit-linear-gradient(86deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .software_banner_area' => 'background: -webkit-linear-gradient( 140deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .home_analytics_banner_area' => 'background: -webkit-linear-gradient(-50deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '{{WRAPPER}} .event_banner_area' => 'background-image: -webkit-linear-gradient(-120deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_10', 'style_13'],
                ]
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Gradient Background Section ------------------------------
        $this->start_controls_section(
            'pos_bg_color_sec',
            [
                'label' => esc_html__( 'Background Overlay', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  'style_09'
                ]
            ]
        );

        $this->add_control(
            'pos_bg_overlay_color', [
                'label' => __( 'Background Overlay', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pos_slider:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_bg_shape_sec', [
                'label' => __( 'Background Right Corner Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_05',
                ]
            ]
        );

        $this->add_control(
            'shape_color', [
                'label' => __( 'Shape Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dot_shap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape1_position', [
                'label' => __( 'Shape One Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px',
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.one' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->add_responsive_control(
            'shape2_position', [
                'label' => __( 'Shape Two Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px',
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.two' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->add_responsive_control(
            'shape3_position', [
                'label' => __( 'Shape Three Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.three' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Shape one gradient ------------------------------
        $this->start_controls_section(
            'style_bg_gradient_sec', [
                'label' => __( 'Background Gradient Shape One', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06',
                ]
            ]
        );

        $this->add_control(
            'shape_bg_color', [
                'label' => esc_html__( 'Color One', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'shape_bg_color2', [
                'label' => esc_html__( 'Color Two', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area .shape' => 'background-image: -webkit-linear-gradient(-57deg, {{shape_bg_color2.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Shape Two gradient ------------------------------
        $this->start_controls_section(
            'style_bg_gradient_sec2', [
                'label' => __( 'Background Gradient Shape Two', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06',
                ]
            ]
        );

        $this->add_control(
            'shape2_bg_color', [
                'label' => esc_html__( 'Color One', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'shape2_bg_color2', [
                'label' => esc_html__( 'Color Two', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area .shape.two' => 'background-image: -webkit-linear-gradient(-75deg, {{shape2_bg_color2.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Section Background ------------------------------ //
        $this->start_controls_section(
            'sec_bg_style', [
                'label' => __( 'Section Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_08', 'style_14', 'style_16' ],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'bg_color',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '
                    {{WRAPPER}} .banner_section.home_one_banner,
                    {{WRAPPER}} .hosting_banner_area
                ',
                'condition' => [
                    'style' => [ 'style_08', 'style_14' ],
                    'style!' => 'style_16'
                ]
            ]
        );

        $this->add_responsive_control(
			'seccc_padding',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Padding', 'saasland-core' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .home_one_banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        // Triangle Image
        $this->add_control(
            'triangle_overlay_color', [
                'label' => esc_html__( 'Triangle Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => 'style_16',
                ]
            ]
        );

        $this->add_control(
            'triangle_image', [
                'label' => esc_html__( 'Triangle Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_16'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); //Array to variable conversation

        $buttons = $settings['buttons'];
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( is_readable( __DIR__ . '/templating/hero/hero-'.$style.'.php' ) ) {
            include ( __DIR__ . '/templating/hero/hero-'.$style.'.php' );
        }

    }
}
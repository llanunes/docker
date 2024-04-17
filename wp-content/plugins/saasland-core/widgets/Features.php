<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Features
 */
class Features extends Widget_Base {

    public function get_name() {
        return 'saasland_main_features';
    }

    public function get_title() {
        return __( 'Features', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_style_depends() {
		return ['chat-features','slick', 'slick-theme' ];
	}

    public function get_script_depends() {
        return [ 'slick' ];
    }

	public function get_categories() {
		return [ 'saasland-elements' ];
	}


    protected function register_controls() {

        //------------------------------ Select Style ------------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( '01: Icon with Background Color', 'saasland-core' ),
                    'style_02' => esc_html__( '02: Font Icon with Background Image', 'saasland-core' ),
                    'style_03' => esc_html__( '03: Image Icon with Image Background', 'saasland-core' ),
                    'style_04' => esc_html__( '04: Image Icon with Background', 'saasland-core' ),
                    'style_05' => esc_html__( '05: Image Icon', 'saasland-core' ),
                    'style_06' => esc_html__( '06: Image Rotate Animation', 'saasland-core' ),
                    'style_07' => esc_html__( '07: Unique Features', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( 'Two', 'saasland-core' ),
                    '4' => esc_html__( 'Three', 'saasland-core' ),
                    '3' => esc_html__( 'Four', 'saasland-core' ),
                ],
                'default' => '4'
            ]
        );

        $this->end_controls_section(); // End Style


        // ------------------------------  Title  ------------------------------//
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_02', 'style_03', 'style_04', 'style_05','style_07' ]
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Awesome Features'
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
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prototype_service_info h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .text-center.mb_90' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_area h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.f_size_30.t_color3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sl_color_s.wow' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '
                    {{WRAPPER}} .text-center.mb_90, 
                    {{WRAPPER}} .prototype_service_info h2, 
                    {{WRAPPER}} .software_featured_area h2,
                    {{WRAPPER}} .f_600.f_size_30.t_color3,
                    {{WRAPPER}} .section_title h2 span,
                    {{WRAPPER}} .sl_color_s.wow,
                    {{WRAPPER}} .title
                ',
            ]
        );
        $this->add_responsive_control(
            'sec_margin', [
                'label' => __( 'Section Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .h_features_right_title .sec_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04']
                ]
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .software_featured_area .container > p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'selector' => '
                    {{WRAPPER}} .software_featured_area .container > p,
                    {{WRAPPER}} .hosting_title p
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        //========= Features 01
        $feature_1 = new \Elementor\Repeater();
        $feature_1->add_control(
			'title', [
				'label' => __( 'Feature Title', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

        $feature_1->add_control(
			'subtitle', [
				'label' => __( 'Subtitle', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

        $feature_1->add_control(
			'icon_type', [
				'label' => __( 'Icon Type', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'ti',
				'options' => [
					'ti' => __( 'Themify Icon', 'saasland-core' ),
                    'image_icon' => __( 'Image icon', 'saasland-core' ),
				],
			]
		);

        $feature_1->add_control(
            'tic', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'ti-panel',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'ti'
                ]
            ]
        );

        $feature_1->add_control(
            'icon_bg_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'icon_type' => 'ti'
                ]
            ]
        );

        $feature_1->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'bg_color',
                'label' => __( 'Icon Background Color', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '
                    {{WRAPPER}} .p_service_item {{CURRENT_ITEM}}.icon,
                    {{WRAPPER}} .p_service_item {{CURRENT_ITEM}}.icon:before
                ',
                'condition' => [
                    'icon_type' => 'ti'
                ]
            ]
        );

        $feature_1->add_control(
            'image_icon', [
                'label' => __( 'Image icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'icon_type' => 'image_icon'
                ]
            ]
        );

        $this->add_control(
            'features', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $feature_1->get_controls(),
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_01']
                ],
            ]
        ); //End Features 01


        //Features style 02
        $feature_2 = new \Elementor\Repeater();
        $feature_2->add_control(
            'title', [
                'label' => __( 'Feature Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $feature_2->add_control(
            'subtitle', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $feature_2->add_control(
            'tic', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'ti-panel',
                    'library' => 'solid',
                ],
            ]
        );


        $feature_2->add_control(
            'icon_bg_two', [
                'label' => __( 'Icon Background', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $feature_2->add_control(
            'bg_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'color: {{VALUE}};'
                ],
            ]
        );

        $feature_2->add_control(
            'link_title', [
                'label' => __( 'Read More', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $feature_2->add_control(
            'link_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        $this->add_control(
            'features2', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $feature_2->get_controls(),
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_02']
                ],
            ]
        );//End Features style 02


        //=========== Features style 03
        $feature_3 = new \Elementor\Repeater();
        $feature_3->add_control(
			'title', [
				'label' => __( 'Feature Title', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default Title' , 'saasland-core' ),
				'label_block' => true,
			]
		);
        $feature_3->add_responsive_control(
			'margin_features',
			[
				'label' => esc_html__( 'Margin', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .software_featured_info .software_featured_item .t_color3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $feature_3->add_control(
			'subtitle', [
				'label' => __( 'Description', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
			]
		);

        $feature_3->add_control(
			'image_icon', [
                'label' => __( 'Icon', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( 'images/icon1.png', __FILE__)
				],
			]
		);

        $feature_3->add_control(
			'icon_bg', [
                'label' => __( 'Icon Background Image', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( 'images/icon_shape.png', __FILE__)
				],
			]
		);

        $feature_3->add_control(
			'link_title', [
				'label' => __( 'Link Title', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More' , 'saasland-core' ),
				'label_block' => true,
			]
		);

        $feature_3->add_control(
			'link_url', [
				'label' => __( 'Link URL', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'saasland-core' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);

        $feature_3->add_control(
			'button_link_color', [
				'label' => __( 'link text color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
				],
			]
		);

        $feature_3->add_control(
			'button_link_hv_color', [
				'label' => __( 'link text hover color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .learn_btn:before' => 'background: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'features3', [
				'label' => __( 'Features', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $feature_3->get_controls(),
				'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_03']
                ],
			]
		); //End Features style 03


        //========= Features style 04, 05
        $features4 = new \Elementor\Repeater();
        $features4->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shared Hosting'
            ]
        );

        $features4->add_control(
            'link_url', [
                'label' => esc_html__( 'Title URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        $features4->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $features4->add_control(
            'f_img', [
                'label' => esc_html__( 'Icon Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        $features4->add_control(
            'icon_bg_color', [
                'label' => __( 'Icon Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hosting_service_item .icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $features4->add_control(
            'top_border_color', [
                'label' => __( 'Hover Border Top', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .hosting_service_item:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pos_service_info .hosting_service_item:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pos_service_info .hosting_service_item h4:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} a .h_head:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'features4', [
                'label' => esc_html__( 'Feature', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $features4->get_controls(),
                'condition' => [
                    'style' => [ 'style_04', 'style_05', 'style_07' ]
                ],
            ]
        );


        //========== Features Style 06
        $features5 = new \Elementor\Repeater();
        $features5->add_control(
            'fimage', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $features5->add_control(
            'rotate_img', [
                'label' => esc_html__( 'Rotate Animation Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $features5->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $features5->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $features5->add_control(
            'bg_box_color', [
                'label' => __( 'Item Box Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $features5->add_control(
            'bg_box_color2', [
                'label' => __( 'Item Box Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-image: -webkit-linear-gradient(-140deg, {{bg_box_color.VALUE}} 0%, {{VALUE}} 100%);',
                )
            ]
        );

        $this->add_control(
            'features5', [
                'label' => esc_html__( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $features5->get_controls(),
                'condition' => [
                    'style' => [ 'style_06' ]
                ],
            ]
        ); //End Features Style 06

        $this->end_controls_section(); //End Features Style


        //============================ Feature Item Title ==============================//
        $this->start_controls_section(
            'style_feature_item_title', [
                'label' => __( 'Feature Item Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'feature_item_title_tag', [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_el_select_title_tag(),
                'default' => 'h5',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'color_feature_item_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_service_item h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.t_color3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .h_head' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .chat_features_item h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_features_item h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_title',
                'selector' => '
                    {{WRAPPER}} .p_service_item h5,
                    {{WRAPPER}} .f_600.t_color3,
                    {{WRAPPER}} .h_head,
                    {{WRAPPER}} .agency_features_item h3,
                    {{WRAPPER}} .chat_features_item h4
                    ',
            ]
        );

        $this->end_controls_section(); //End Feature Item Title


        // ----------- Feature Item Description
        $this->start_controls_section(
            'style_feature_item_subtitle', [
                'label' => __( 'Feature Item Description', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_item_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p_service_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_service_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .chat_features_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_features_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_subtitle',
                'selector' => '
                    {{WRAPPER}} .p_service_item p, 
                    {{WRAPPER}} .software_featured_item p,
                    {{WRAPPER}} .hosting_service_item p,
                    {{WRAPPER}} .agency_features_item p,
                    {{WRAPPER}} .chat_features_item p
                    ',
            ]
        );

        $this->end_controls_section();


        /** === Read More Styling === **/
        $this->start_controls_section(
            'style_read_more', [
                'label' => __( 'Style Read More', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'read_more_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_service_item a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item p i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item .feature_button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item a:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '', [
                'label' => __( 'Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_service_item p:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item p:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item .feature_button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_service_item p:hover a:before' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

	    $this->add_group_control(
		    \Elementor\Group_Control_Typography::get_type(), [
			    'name' => 'item_read_more_typo',
			    'selector' => '{{WRAPPER}} .agency_service_item a',
		    ]
	    );

        $this->end_controls_section();


        //------------------------------ Section Background Styling ------------------------------//
        $this->start_controls_section(
            'bg_styling_section', [
                'label' => __( 'Background Styling', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pattern_shape_img', [
                'label' => esc_html__( 'Shape Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-pos/pattern_02.png', __FILE__)
                ],
                'condition' => [
                    'style' =>  'style_05'
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_service_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .prototype_service_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .software_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sec_pad' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .agency_features_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_control(
            'wave_color', [
                'label' => __( 'Wave Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'wave_color_02', [
                'label' => __( 'Wave Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .symbols-pulse > div' => 'background-image: linear-gradient(-180deg, {{wave_color.VALUE}} 0%, {{VALUE}} 65%, rgba(227, 221, 246, 0.1) 100%);',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_responsive_control(
            'col_padding', [
                'label' => __( 'Column Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .software_featured_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
                'condition' => [
                    "style" => ['style_03']
                ]
            ]
        );

        $this->end_controls_section(); //End Section Background

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); //Array to variable conversation

        $features = is_array($settings['features']) ? $settings['features'] : '';
        $features2 = is_array($settings['features2']) ? $settings['features2'] : '';
        $features3 = is_array($settings['features3']) ? $settings['features3'] : '';
        $features4 = is_array($settings['features4']) ? $settings['features4'] : '';
        $features5 = is_array($settings['features5']) ? $settings['features5'] : '';
        $column = isset($settings['column']) ? $settings['column'] : 'style_03';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        $feature_item_title_tag = !empty($settings['feature_item_title_tag']) ? $settings['feature_item_title_tag'] : 'h5';


        //Include Template parts
        include "templating/features/{$settings['style']}.php";
    }
}
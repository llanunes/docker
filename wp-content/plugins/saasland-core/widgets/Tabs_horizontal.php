<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Tabs_horizontal
 * @package SaaslandCore\Widgets
 */
class Tabs_horizontal extends Widget_Base {
    public function get_name() {
        return 'Saasland_tabs_horizontal';
    }

    public function get_title() {
        return __( 'Horizontal Tabs', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }


    public function get_style_depends() {
        return [ 'saasland-tabs' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {

        // ---------------------------------------- Select Style  ------------------------------ //
        $this->start_controls_section(
            'select_tab_style',
            [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section(); // End Select Style

        // ---------------------------------------- Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t_color3.mb_50' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title.text-center .saasland_horizontal_tab_s' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '
                    {{WRAPPER}} .t_color3.mb_50,
                    {{WRAPPER}} .hosting_title.text-center .saasland_horizontal_tab_s
                    ',
            ]
        );

        $this->end_controls_section(); // End Hero content


        // ------------------------------ Feature list Style 01 ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'tab_instructions',
            [
                'label' => '',
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Insert this widget in a fullwidth section. ', 'saasland-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'saasland-core' ),
                'placeholder' => __( 'Tab Title', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'default' => __( 'Tab Content', 'saasland-core' ),
                'placeholder' => __( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'featured_image',
            [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'description' => __( 'The featured image will show on the half column width.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __( 'Tabs Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // ------------------------------ Feature list Style 02 ------------------------------
        $this->start_controls_section(
            'section_tabs2',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );

        $this->add_control(
            'tab_instructions2',
            [
                'label' => '',
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Insert this widget in a fullwidth section. ', 'saasland-core' ),
            ]
        );

        $tabs2 = new Repeater();

        $tabs2->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'saasland-core' ),
                'placeholder' => __( 'Tab Title', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $tabs2->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'default' => __( 'Tab Content', 'saasland-core' ),
                'placeholder' => __( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $tabs2->add_control(
            'featured_image',
            [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'description' => __( 'The featured image will show on the half column width.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $tabs2->add_control(
            'shape_f_img',
            [
                'label' => __( 'Pattern Image', 'saasland-core' ),
                'description' => __( 'The featured image will show on the half column width.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-pos/tab_pattern.png', __FILE__)
                ]
            ]
        );

        $tabs2->add_control(
            'circle_shape_color', [
                'label' => esc_html__( 'Circle Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabs2',
            [
                'label' => __( 'Tabs Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $tabs2->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // Repeater
    

        // ------------------------------ Tab Title Color ------------------------------
        $this->start_controls_section(
            'tabs2_title_style_sec',
            [
                'label' => __( 'Tab Items', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tabs2_title_normal_color', [
                'label' => esc_html__( 'Regular Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabs2_title_active_color', [
                'label' => esc_html__( 'Active Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nav-item .nav-link:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .developer_product_content .develor_tab .nav-item .nav-link:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .multitask_tab .nav-item .nav-link:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .developer_product_content .develor_tab .nav-item .nav-link.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'tabs3_style_sec',
            [
                'label' => __( 'Tab Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .tab_img_info:before',
            ]
        );
        $this->end_controls_section();


        /*Section Style ----------------------------------------*/
        $this->start_controls_section(
            'horizontal_tab_sec_style',
            [
                'label' => __( 'Section Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'horizontal_tab_margin',
            [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .product_multitask_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'horizontal_tab_padding',
            [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .product_multitask_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'horizontal_tab_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .product_multitask_area',
            ]
        );
        $this->end_controls_section();
        $this-> tab_repetar_controls();
        $this-> tab_nav_style_control();
        $this-> se_tab_content_control();
    }

    public function tab_repetar_controls(){
        $this->start_controls_section(
            'tab_repeater_section',
            [
                'label' => esc_html__('Tabs', 'saasland-core'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'style' => [ 'style_04']
                ]
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tab_selected_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-solid',
                ]
            ]
        );
        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Website Development', 'saasland-core' ),
                'label_block' => true,
                'separator' => 'after',
            ]
        );
        $repeater->add_control(
            'se_tab_image_one',
            [
                'label' => __( 'Tab Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'se_tab_image_two',
            [
                'label' => __( 'Tab Image Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'se_description_title',
            [
                'label' => esc_html__( 'Tab Content Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'se_description',
            [
                'label' => esc_html__( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );
        
        $this->add_control(
            'tab_list',
            [
                'label' => __('tab', 'saasland-core'),
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => __('Big Data Consulting', 'saasland-core'),
                    ],
                    [
                        'tab_title' => __('Machine Learning', 'saasland-core'),
                    ],
                    [
                        'tab_title' => __('Data Analytics', 'saasland-core'),
                    ],
                    [
                        'tab_title' => __('Artificial Intelligence', 'saasland-core'),
                    ],
                    [
                        'tab_title' => __('Business Analysis', 'saasland-core'),
                    ],
                ],
                'title_field' => '{{{ tab_title}}}',
            ]
        );
        $this-> end_controls_section();
    }

    public function tab_nav_style_control(){
        $this->start_controls_section(
            'se_nav_style',
            [
                'label' => esc_html__('Tab Nav Style', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_04']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'se_nav_item_style',
                'label' => __('Nav Item Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .se_tab_nav .nav-item .nav-link h5',
            ]
        );
        $this->add_control(
            'se_nav_item_color',
            [
                'label' => esc_html__('Nav Item Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .se_tab_nav .nav-item .nav-link h5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this-> end_controls_section();
    }

    public function se_tab_content_control(){
        $this->start_controls_section(
            'se_content_style',
            [
                'label' => esc_html__('Tab Content Style', 'saasland-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_04']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'se_title_style',
                'label' => __('Content Title Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .se_tab_content h2',
            ]
        );
        $this->add_control(
            'se_title_color',
            [
                'label' => esc_html__('Content Title Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .se_tab_content h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'se_content_style',
                'label' => __('Content Typography', 'saasland-core'),
                'selector' => '{{WRAPPER}} .se_tab_content p',
            ]
        );
        $this->add_control(
            'se_content_color',
            [
                'label' => esc_html__('Content Color', 'saasland-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .se_tab_content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this-> end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $tabs2 = $this->get_settings_for_display( 'tabs2' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        extract($settings);

        //==== Templating parts
        include "templating/tab/tab-{$settings['style']}.php";


    }
}
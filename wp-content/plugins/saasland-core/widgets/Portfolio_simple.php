<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filterable Portfolio
 */
class Portfolio_simple extends Widget_Base {

    public function get_name() {
        return 'saasland_portfolio_simple';
    }

    public function get_title() {
        return __( 'Portfolio (Saasland)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-masonry';
    }

    public function get_style_depends() {
        return [ 'slick', 'slick-theme', 'saasland-core-portfolio' ];
    }

    public function get_script_depends() {
        return [ 'slick' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {
        $this->saasland_elementor_content_control();
        $this->saasland_elementor_style_control();
    }

    /**
     * Name: saasland_elementor_content_control
     * Desc: Register content
     * Params: no params
     * Return: @void
     * Since: @4.0.4
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    public function saasland_elementor_content_control() {

        //========================= Preset Skins ========================//
        $this->start_controls_section(
            'preset_skins_sec', [
                'label' => __( 'Preset Skins', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Skin', 'saasland-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __( '01 : Two Column Portfolio', 'saasland-core' ),
                        'icon' => 'portfolio1',
                    ],
                    '2' => [
                        'title' => __( '02 : Slider Portfolio', 'saasland-core' ),
                        'icon' => 'portfolio2',
                    ],
                    '3' => [
                        'title' => __( '03 : Architecture Homepage', 'saasland-core' ),
                        'icon' => 'portfolio3',
                    ],
                ],
                'default' => '1'
            ]
        );

        $this->end_controls_section(); //End Preset


        //========================= Section Contents ===========================//
        $this->start_controls_section(
            'sec_contents', [
                'label' => __( 'Contents', 'saasland-core' ),
                'condition' => [
                    'style!' => '3'
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Work'
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => __( 'Title HTML Tag', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_el_select_title_tag(),
                'default' => 'h2',
            ]
        );

        $this->end_controls_section();// End Section Contents


        //========================= Query Settings ===========================//
        $this->start_controls_section(
            'portfolio_query', [
                'label' => __( 'Query Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'select_cat', [
                'label' => __( 'Select Categories', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => Saasland_Core_Helper()->get_category_array('portfolio_cat'),
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Posts Per Page', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '4'
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'description' => esc_html__( '‘ASC‘ – ascending order from lowest to highest values (1, 2, 3; a, b, c). ‘DESC‘ – descending order from highest to lowest values (3, 2, 1; c, b, a).', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Name (by post slug)',
                    'date' => 'Date',
                    'rand' => 'Random',
                    'comment_count' => 'Comment Count',
                ],
                'default' => 'none'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(), [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__('Button Label', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Discover More',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section(); //End Query Filter;


        //================ View All Button ========================//
        $this->start_controls_section(
            'button_style', [
                'label' => __( 'Button', 'saasland-core' ),
            ]
        );

        //============ See All Post
        $this->add_control(
            'all_btn_label', [
                'label' => esc_html__('Button Label', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See all Work',
                'condition' => [
                    'style' => '3'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'all_btn_url', [
                'label' => esc_html__('View All URL', 'saasland-core'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        /*
         * Colors
         */
        $this->start_controls_tabs(
            'all_btn_style_tabs'
        );

        $this->start_controls_tab(
            'all_btn_normal_tab', [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_btn_normal_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .arch_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'all_btn_normal_bg_color',
                'label' => esc_html__( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .arch_work_content .arch_btn::after',
            ]
        );

        $this->end_controls_tab(); //End Normal Tabs


        //========= Hover Color
        $this->start_controls_tab(
            'all_btn_hover_tab', [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_btn_hover_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .arch_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'all_btn_hover_bg_color',
                'label' => esc_html__( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .arch_work_content .arch_btn::after',
            ]
        );

        $this->add_control(
            'all_btn_hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .arch_btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); //End Hover

        $this->end_controls_tabs(); // End Tabs

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'all_btn_normal_border',
                'label' => esc_html__( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .arch_work_content .arch_btn',
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'all_btn_typo',
                'selector' => '{{WRAPPER}} .arch_work_content .arch_btn',
            ]
        );

        $this->add_responsive_control(
            'all_btn_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .arch_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'all_btn_border_radius', [
                'label' => esc_html__( 'Border Radius', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .arch_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'all_btn_border_spacing', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .arch_work_more_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // End Button section

    }


    /**
     * Name: saasland_elementor_style_control
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @4.0.4
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    public function saasland_elementor_style_control() {

        //========================= Post Thumbnail =========================//
        $this->start_controls_section(
            'portfolio_image', [
                'label' => __( 'Featured Thumbnail', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ '1' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'img_space_bottom', [
                'label' => __( 'Space Bottom', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .simple-portfolio-wrapper .portfolio .portfolio-img img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name' => 'box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .simple-portfolio-wrapper .portfolio .portfolio-img img',
            ]
        );

        $this->end_controls_section(); //End Post Thumbnail


        //======================== Style Contents =====================//
        $this->start_controls_section(
            'portfolio_content', [
                'label' => __( 'Content', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ '1', '3' ]
                ]
            ]
        );

        $this->add_control(
            'alignment_options', [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_responsive_control(
			'horizontal_alignment',
			[
				'label' => esc_html__( 'Horizontal Alignment', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [  '%' ],
				'selectors' => [
					'{{WRAPPER}} .arch_work_content' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
                'condition' => [
                    'style' => '1'
                ]
			]
		);

        $this->add_responsive_control(
			'vertical_alignment',
			[
				'label' => esc_html__( 'Vertical Alignment', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [  '%' ],
				'selectors' => [
					'{{WRAPPER}} .arch_work_content' => 'transform: translateY({{SIZE}}{{UNIT}});',
				],
                'condition' => [
                    'style' => '1'
                ]
			]
		);

        //======= Category Options
        $this->add_control(
            'cats_options', [
                'label' => __( 'Category', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'category_typography',
                'selector' => '
                    {{WRAPPER}} .simple-portfolio-wrapper .portfolio-meta span, 
                    {{WRAPPER}} .arch_work_content .location
                ',
            ]
        );

        $this->add_responsive_control(
            'cat_space_left', [
                'label' => __( 'Space between', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .simple-portfolio-wrapper .portfolio-meta span:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .arch_work_content .location' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cat_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simple-portfolio-wrapper .portfolio-meta span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .arch_work_content .location' => 'color: {{VALUE}}',
                ],
            ]
        ); //End Category Options


        //=========== Heading Options
        $this->add_control(
            'title_options', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'item_title_typo',
                'selector' => '
                    {{WRAPPER}} .simple-portfolio-wrapper .portfolio-title h3, 
                    {{WRAPPER}} .arch_work_content .image_name h3
                ',
            ]
        );

        $this->add_control(
            'item_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .simple-portfolio-wrapper .portfolio-title h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .arch_work_content .image_name h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_title_space_top', [
                'label' => __( 'Space Top', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .simple-portfolio-wrapper .portfolio-title h3' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .arch_work_content .image_name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //================== Serial Number Options
        $this->add_control(
            'number_heading_options', [
                'label' => __( 'Number Options', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'number_item_title_typo',
                'selector' => '{{WRAPPER}} .arch_work_content .number',
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_control(
            'number_item_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .number' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_responsive_control(
            'number_item_margin', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .arch_work_content .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //================== Read More Options
        $this->add_control(
            'read_more_btn_heading', [
                'label' => __( 'Button Options', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'item_btn_typo',
                'selector' => '{{WRAPPER}} .rave_btn ',
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_control(
            'item_btn_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rave_btn, {{WRAPPER}} .rave_btn_effect i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_control(
            'item_btn_hover_color', [
                'label' => __( 'Hover Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rave_btn_effect:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rave_btn_effect::before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rave_btn_effect:hover i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => '3'
                ]
            ]
        );

        $this->add_responsive_control(
            'btn_icon_size', [
                'label' => esc_html__( 'Icon Size', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .rave_btn_effect i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); //End Style Contents


        //====================== Style Layout ============================//
        $this->start_controls_section(
            'style_layout', [
                'label' => __( 'Layout', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ '1', '3' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'layout_space_two_column', [
                'label' => __( 'Space Two Column', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .saasland-d-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .arch_work_item + .arch_work_item' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => [ '1', '3' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'layout_space_two_row', [
                'label' => __( 'Space Two Row', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .saasland-d-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_responsive_control(
            'layout_2nd_space_top', [
                'label' => __( '2nd Column Space Top', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .simple-portfolio-wrapper .portfolio:nth-child(2n)' => 'transform: translateY( {{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->end_controls_section(); //End Style Layout

    }


    /**
     * Name: render
     * Desc: Widgets Render
     * Params: no params
     * Return: @void
     * Since: @4.0.4
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        extract($settings); //Array to variable conversation

        $btn_label      = !empty($settings['btn_label']) ? $settings['btn_label'] : '';
        $all_btn_label  = !empty($settings['all_btn_label']) ? $settings['all_btn_label'] : '';
        $all_btn_url    = !empty($settings['all_btn_url']) ? $settings['all_btn_url'] : '';

        $args = [
            'post_type'   => 'portfolio',
            'post_status' => 'publish'
        ];

        if ( $show_count != '' ) {
            $args['posts_per_page']  = $show_count;
        }
        if ( $order != '' ) {
            $args['order']  = $order;
        }
        if ( $orderby != '' ) {
            $args['orderby']  = $orderby;
        }

        if ( is_array($select_cat) && !empty($select_cat) ) {
            $args['tax_query']  = [
                [
                    'taxonomy' => 'portfolio_cat',
                    'field' => 'slug',
                    'terms' => $select_cat,
                ]
            ];
        }

        $portfolios = new \WP_Query( $args );

        $get_portfolios = get_posts($args);

        //=========== Template Parts
        include "templating/portfolio-simple/portfolio-{$settings['style']}.php";

    }

}
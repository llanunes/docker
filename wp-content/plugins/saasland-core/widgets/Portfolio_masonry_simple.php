<?php
namespace SaaslandCore\Widgets;

use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filterable Portfolio
 */
class Portfolio_masonry_simple extends Widget_Base {

    public function get_name() {
        return 'saasland_portfolio_masonry_simple';
    }

    public function get_title() {
        return __( 'Portfolio Masonry (Saasland)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-masonry';
    }

    public function get_style_depends() {
        return [ 'saasland-core-portfolio' ];
    }

    public function get_script_depends() {
        return [ 'imagesloaded', 'isotope', 'parallax-scroll' ];
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
                'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => __('Style 01', 'saasland-core'),
					'2' => __('Style 02', 'saasland-core'),
				],
                'default' => '1'
            ]
        );

        $this->end_controls_section(); //End Preset


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

        // Read More Button
        $this->add_control(
            'read_more_btn', [
                'label' => esc_html__('Read More Button', 'saasland-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Find Out More',
                'condition' => [
                    'style' => '2',
                ]
            ]
        );

        $this->end_controls_section(); //End Query Filter;


        // =============================== Masonry Layout ==================================//
        $this->start_controls_section(
            'masonry_layout', [
                'label' => __( 'Masonry Layout', 'saasland-core' ),
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        //=== Masonry Metro Style 02
        $layout_repeater = new \Elementor\Repeater();
        $layout_repeater->add_control(
            'align_items', [
                'label'   => esc_html__( 'Item Size', 'saasland-core' ),
                'type'    => Controls_Manager::HIDDEN,
            ]
        );

        $layout_repeater->add_control(
            'size', [
                'label'   => esc_html__( 'Item Size', 'saasland-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'col-lg-4 col-md-6',
                'options' => [
                    'col-lg-4 col-md-6' => __( 'Normal', 'saasland-core' ),
                    'col-lg-8 col-md-12'  => __( 'Big', 'saasland-core' ),
                ],
            ]
        );

        $this->add_control(
            'grid_metro_layout', [
                'label'       => esc_html__( 'Metro Layout', 'saasland-core' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $layout_repeater->get_controls(),
                'title_field' => '{{{ align_items }}}',
                'prevent_empty' => false,
            ]
        );

        $this->end_controls_section();//End Metro Layout

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
        $this->start_controls_section(
            'masonry_portfolio_color', [
                'label' => __( 'Contents', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        //========== Title
        $this->add_control(
            'item_title_heading', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
			'masonry_title_color',
			[
				'label' => esc_html__( 'Title Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .h_work_area_portfolio_masonry .work_item .content .agency_learn_btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cons_projects_item .content h3' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_title_typo',
                'selector' => '{{WRAPPER}} .cons_projects_item .content h3'
            ]
        );


        //========== Category
        $this->add_control(
            'item_cats_heading',
            [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
			'masonry_cat_color',
			[
				'label' => esc_html__( 'Text Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .h_work_area_portfolio_masonry .work_item .content .categorie' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
            'read_more_btn_heading',
            [
                'label' => esc_html__( 'Read More Button', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'read_more_btn_color',
            [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cons_projects_item .content a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'read_more_btn_typo',
                'selector' => '
                    {{WRAPPER}} .cons_projects_item .content a'
            ]
        );

        $this->end_controls_section();
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

        $args = [
            'post_type'     => 'portfolio',
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

        //=========== Template Parts
        include "templating/portfolio-masonry-simple/portfolio-{$settings['style']}.php";


    }

}
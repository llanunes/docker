<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Blog Posts
 */
class Blog extends Widget_Base {

    public function get_name() {
        return 'saasland_blog';
    }

    public function get_title() {
        return __( 'Blog Posts [Saasland]', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_style_depends() {
        return [ 'owl-carousel', 'saasland-blog' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /**
     * Name: register_controls
     * Desc: Register controls for these widgets
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    protected function register_controls() {
        $this-> saasland_elementor_content_control();
        $this-> saasland_elementor_style_control();
    }

    /**
     * Name: saasland_elementor_content_control
     * Desc: Register content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    public function saasland_elementor_content_control() {

        // ---------------------------------------- Select Style  ------------------------------ //
        $this->start_controls_section(
            'blog_select_sec', [
                'label' => __( 'Blog Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Skin', 'saasland-core' ),
                // 'type' => Controls_Manager::CHOOSE,
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => [
                        'title' => __( '01: Category Posts Carousel', 'saasland-core' ),
                        'icon'  => 'blog1',
                    ],
                    'style_02' => [
                        'title' => __( '02: Column Grid', 'saasland-core' ),
                        'icon'  => 'blog2',
                    ],
                    'style_03' => [
                        'title' => __( '03: Horizontal Row Blog', 'saasland-core' ),
                        'icon'  => 'blog3',
                    ],
                    'style_04' => [
                        'title' => __( '04: Horizontal Row', 'saasland-core' ),
                        'icon'  => 'blog4',
                    ],
                    'style_05' => [
                        'title' => __( '05: Grid Blog', 'saasland-core' ),
                        'icon'  => 'blog5',
                    ],
                    'style_06' => [
                        'title' => __( '06: Grid Blog', 'saasland-core' ),
                        'icon'  => 'blog6',
                    ],
                    'style_07' => [
                        'title' => __( '07: Blog Tab', 'saasland-core' ),
                        'icon'  => 'blog7',
                    ],
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section(); //End Select Style


        //----------------------------------------- Featured Post ID ---------------------------------------//
        $this->start_controls_section(
            'featured_post_sec', [
                'label' => __( 'Featured Post', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'featured_post', [
                'label' => esc_html__( 'Featured Post ID', 'saasland-core' ),
                'description' => __( '<a href="https://pagely.com/blog/find-post-id-wordpress/" target="_blank">How to Find the Post ID?</a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section(); //End Featured Post ID

        //------------------------------------- Buttons ----------------------------------------//
        $this->start_controls_section(
            'button_sec', [
                'label' => __( 'Read More Button', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_07']
                ]
            ]
        );

        $this->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
            ]
        );

        $this->add_responsive_control(
            'btn_icon_f_size', [
                'label' => __( 'Icon Size', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => 'px',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .learn_btn_two i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'btn_style_normal', [
                'label' => __( 'Normal', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]

            ]
        );

        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'btn_style_hover', [
                'label' => __( 'Hover', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ],
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section(); //End Buttons


        // ----------------------------- Posts Carousel ----------------------
        $this->start_controls_section(
            'posts_carousel', [
                'label' => __( 'Posts Carousel', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $slider = new \Elementor\Repeater();
        $slider->add_control(
            'cat', [
                'label' => __( 'Category Name', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => saasland_cat_array(),
            ]
        );

        $this->add_control(
            'slide_cats', [
                'label' => __( 'Slide Category', 'saasland-core' ),
                'description' => __( 'The slide items are category based. You have to choose a post category to show a slide item and make sure it contains at least 3 posts.', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $slider->get_controls(),
                'default' => [
                    [
                        'cat' => __( 'all', 'saasland-core' ),
                    ],
                ],
                'title_field' => '{{{ cat }}}',
	            'prevent_empty' => false
            ]
        );

        $this->end_controls_section();

        //===================================== Read More Button ==============================//
        $this->start_controls_section(
            'read_more_button_sec', [
                'label'     => __('Read More Link', 'saasland-core'),
                'condition' => [
                    'style' => ['style_06']
                ]
            ]
        );

        $this->add_control(
            'btn_title_two', [
                'label'       => __('Button Title', 'saasland-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Read More'
            ]
        );


        // Button Settings
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_btn_typo',
                'selector' => '{{WRAPPER}} .agency_learn_btn',
            ]
        );

        $this->start_controls_tabs('read_more_btn_style');

        $this->start_controls_tab(
            'read_more_btn_normal', [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'read_more_btn_font_color',
            [
                'label'                                  => __( 'Text Color', 'rave-core' ),
                'type'                                   => \Elementor\Controls_Manager::COLOR,
                'selectors'                              => [
                    '{{WRAPPER}} .agency_learn_btn'      => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();


        $this->start_controls_tab(
            'read_more_btn_hover', [
                'label' => __( 'Hover', 'text-domain' ),
            ]
        );

        $this->add_control(
            'read_more_btn_hover_font_color',
            [
                'label'  => __( 'Text Color', 'rave-core' ),
                'type'   => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_learn_btn:hover'        => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Icon Settings
        $this->add_control(
            'is_btn_icon',
            [
                'label' => __( 'Show Icon', 'rave-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rave-core' ),
                'label_off' => __( 'Hide', 'rave-core' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'is_btn_icon' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'read_more_icon_color',
            [
                'label' => __( 'Icon Color', 'rave-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_learn_btn i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'is_btn_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_size',
            [
                'label' => __( 'Size', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
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
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'selectors' => [
                    '{{WRAPPER}} .agency_learn_btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'is_btn_icon' => 'yes',
                ]
            ]
        );

        $this->end_controls_section(); // End Read More Button

        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02', 'style_03', 'style_04', 'style_05','style_06','style_07']
                ]
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
            ]
        );

        $this->add_control(
            'cats', [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => saasland_cat_array(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'title_limit_char', [
                'label' => esc_html__( 'Title Character Limit', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
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
                ],
                'default' => 'none'
            ]
        );

        $this->add_control(
            'is_post_excerpt', [
                'label' => __( 'Post Excerpt', 'rave-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'rave-core' ),
                'label_off' => __( 'Hide', 'rave-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => ['style_07']
                ],
            ]
        );

        $this->add_control(
            'excerpt_length', [
                'label' => esc_html__('Excerpt Word Length', 'rave-core'),
                'type' => Controls_Manager::NUMBER,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'style',
                            'operator' => 'in',
                            'value' => ['07']
                        ],
                        [
                            'name' => 'is_post_excerpt',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ],
                'default' => 12,
            ]
        );

        $this->add_control(
            'exclude', [
                'label' => esc_html__( 'Exclude Blog', 'saasland-core' ),
                'description' => esc_html__( 'Enter the Blog post IDs to hide/exclude. Input the multiple ID with comma separated', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(), [
                'name' => 'thumbnail_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'show_pagination', [
                'label' => __( 'Show Pagination', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'pagination_align', [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'condition' => [
                    'show_pagination' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- Column Grid Section ---------------------------------//
        $this->start_controls_section(
            'column_sec', [
                'label' => __( 'Grid Column', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02','style_06']
                ]
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '6',

            ]
        );

        $this->end_controls_section();

    }


    /**
     * Name: saasland_elementor_style_control
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    public function saasland_elementor_style_control() {

        //----------------------------- Style Title Section --------------------------------//
        $this->start_controls_section(
            'style_title_sec', [
                'label' => __( 'Title Section', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .f_size_30.f_700.l_height45.mb_20' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .f_size_30.f_700.l_height45.mb_20',
            ]
        );

        $this->end_controls_section(); //End Section Title


        //----------------------------- Style Subtitle Section --------------------------------//
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Subtitle Section', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'subtitle_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.f_size_15.f_300.mb_40' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} p.f_size_15.f_300.mb_40',
            ]
        );

        $this->end_controls_section(); //Section Subtitle


        //----------------------------- Item Post Content --------------------------------//
        $this->start_controls_section(
            'item_content_style', [
                'label' => __( 'Post Content', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_03', 'style_05','style_06']
                ]
            ]
        );

        //=========== Post Title
        $this->add_control(
            'item_title_heading', [
                'label'     => esc_html__( 'Title', 'saasland-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'item_title_color', [
                'label'     => esc_html__( 'Text Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_blog_item .post_content h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content h5' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .corporate_blog_item .content h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_title_hover_color', [
                'label'     => esc_html__( 'Text Hover Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_blog_item:hover .post_content h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .content h5:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .corporate_blog_item .content h2:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_title_typo',
                'selector' => '
                    {{WRAPPER}} .arch_blog_item .post_content a h3,
                    {{WRAPPER}} .content h5,
                    {{WRAPPER}} .corporate_blog_item .content h2
                ',
            ]
        );

        //=========== Post Date
        $this->add_control(
            'item_date_heading', [
                'label'     => esc_html__( 'Date', 'saasland-core' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'style' => 'style_03'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'item_date_color', [
                'label'     => esc_html__( 'Text Color 01', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_blog_item .arch_post_date h3' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_03'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_date_typo1',
                'selector' =>  '{{WRAPPER}} .arch_blog_item .arch_post_date h3',
                'separator' => 'before',
                'condition' => [
                    'style' => 'style_03'
                ],
            ]
        );

        $this->add_control(
            'item_date_color2', [
                'label'     => esc_html__( 'Text Color 02', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_blog_item .arch_post_date h3 span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_03'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_date_typo',
                'selector' =>  '{{WRAPPER}} .arch_blog_item .arch_post_date h3 span',
                'condition' => [
                    'style' => 'style_03'
                ],
            ]
        );

        //=========== Read More Button
        $this->add_control(
            'item_btn_heading', [
                'label'     => esc_html__( 'Button', 'saasland-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'item_btn_color', [
                'label'     => esc_html__( 'Text Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_blog_item .rave_btn, {{WRAPPER}} .arch_blog_item .rave_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .education_learn_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_btn_hover_color', [
                'label'     => esc_html__( 'Text Hover Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .arch_blog_item .rave_btn:hover, {{WRAPPER}} .rave_btn_effect:hover::before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .education_learn_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_btn_typo',
                'selector' => '
                    {{WRAPPER}} .arch_blog_item .rave_btn,
                    {{WRAPPER}} .arch_blog_item .rave_btn,
                    {{WRAPPER}} .education_learn_btn
                ',
            ]
        );


        //=========== Read More Button
        $this->add_control(
            'item_sec_padding', [
                'label'     => esc_html__( 'Section Padding', 'saasland-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'item_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .education_program_gallery_info .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();//End Item Contents


        //----------------------------- Style Background Gradient --------------------------------//
        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Left Gradient Color', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'fpb_color_left', [
                'label'     => esc_html__( 'Color One', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'fpb_color_right', [
                'label'     => esc_html__( 'Color Two', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.about_content' => 'background-image: -webkit-linear-gradient(40deg, {{fpb_color_left.VALUE}} 0%, {{VALUE}} 100%)'
                ],
            ]
        );

        $this->end_controls_section();//End Background Color


        //----------------------------- Style Blog Title --------------------------------//
        $this->start_controls_section(
            'style_blog_title_sec', [
                'label' => __( 'Title Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_title_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .h_blog_item .h_blog_content h3',
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- Accent Color  ---------------------------------//
        $this->start_controls_section(
            'accent_color_sec', [
                'label' => __( 'Accent Color', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'accent_style_tabs'

        );
        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'accent_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'accent_normal_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post_time' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .post-info-comments' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'accent_normal_icon_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post_time i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .post-info-comments i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:before' => 'background: {{VALUE}}',

                ],
            ]
        );

        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'accent_hover_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'accent_hover_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .h_blog_content h3:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:hover:before' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        //==================================== Post content =====================================//
        $this->start_controls_section(
            'style_post_content_sec', [
                'label' => __('Post Content Style', 'rave-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_06','style_07']
                ]
            ]
        );

        $this->add_control(
            'post_content_color',
            [
                'label' => __('Text Color', 'rave-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content p' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deal_item  .post-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'post_content_typography',
                'selector' => '
                    {{WRAPPER}} .corporate_blog_item .content p,{{WRAPPER}} .deal_item .post-content
                    ',
            ]
        );

        $this->add_responsive_control(
            'bottom_space_post_content',
            [
                'label' => __( 'Bottom Spacing', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deal_item  .post-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section(); // End Post Content


        //==================================== Post Category =====================================//
        $this->start_controls_section(
            'style_post_category_sec', [
                'label' => __('Post Category', 'rave-core'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_06','style_07']
                ]
            ]
        );

        $this->add_control(
            'post_cats_color',
            [
                'label' => __('Text Color', 'rave-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content .category' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deal_tab .nav-item .nav-link' => 'color: {{VALUE}}'
                ],
            ]
        );


        $this->add_control(
            'post_cats_hover_color',
            [
                'label' => __('Hover Color', 'rave-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content .category:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deal_tab .nav-item .nav-link:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deal_tab .nav-item .nav-link:before' => 'background: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_cats_typos',
                'selector' => '
                    {{WRAPPER}} .corporate_blog_item .content .category,
                    {{WRAPPER}} .deal_tab .nav-item .nav-link
                ',
            ]
        );

        $this->add_responsive_control(
            'bottom_space_post_category',
            [
                'label' => __( 'Bottom Spacing', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deal_tab .nav-item .nav-link' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section(); //End Post Category



        //=========================== Post Title Style ========================= //
        $this->start_controls_section(
            'style_post_title_sec', [
                'label'                       => __('Post Title', 'rave-core'),
                'tab'                         => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_07']
                ]
            ]
        );

        $this->add_control(
            'post_title_color', [
                'label'                       => __('Text Color', 'rave-core'),
                'type'                        => Controls_Manager::COLOR,
                'selectors'                   => [
                    '{{WRAPPER}} .deal_item .post-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'post_title_hover_color', [
                'label' => __('Hover Color', 'rave-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deal_item .post-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'post_title_typography',
                'selector' => '{{WRAPPER}} .deal_item .post-title',
            ]
        );

        $this->end_controls_section();

        // ---------------------------------------- Style Content Box ------------------------------ //
        $this->start_controls_section(
            'style_content_box_sec',
            [
                'label' => __('Content Box', 'rave-core'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ 'style_06']
                ]
            ]
        );

        $this->add_responsive_control(
            'style_content_box_margin', [
                'label' => esc_html__('Item Margin', 'rave-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'style_content_box_padding', [
                'label' => esc_html__('Padding', 'rave-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_box_border_radius', [
                'label' => esc_html__('Border Radius', 'rave-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .corporate_blog_item .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_box_border',
                'label' => __( 'Border', 'rave-core' ),
                'selector' => '{{WRAPPER}} .corporate_blog_item .content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_box_shadow',
                'label' => __( 'Box Shadow', 'rave-core' ),
                'selector' => '{{WRAPPER}} .corporate_blog_item .content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_box_background',
                'label' => __( 'Background', 'rave-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .corporate_blog_item .content',
            ]
        );

        $this->end_controls_section();
    }



    protected function render() {

        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        extract($settings); //Array to variable conversation

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'paged' => $paged
        ];

        if ( !empty($show_count) ) {
            $args['posts_per_page'] = $show_count;
        }

        if ( !empty($order) ) {
            $args['order'] = $order;
        }

        if ( !empty($orderby) ) {
            $args['orderby'] = $orderby;
        }

        if ( !empty($exclude ) ) {
            $args['post__not_in'] = $exclude;
        }

        if ( !empty($cats && $cats != '') ) {
            $args['tax_query'] = [
                [
                    'taxonomy'  => 'category',
                    'field'     => 'slug',
                    'terms'     => $cats,
                ]
            ];
        }

        // $cat_ids =  $settings['cats'];
        $blog_post = new \WP_Query( $args );

        $data_wow_delay = '0.2';

        //=== Include Template Parts
        include "templating/blog/{$settings['style']}.php";

    }

}
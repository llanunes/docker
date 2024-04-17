<?php
namespace SaaslandCore\Widgets;

// Exit if accessed directly
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial
 * @package SaaslandCore\Widgets
 */
class Testimonial extends \Elementor\Widget_Base {

    public function get_name() {
        return 'saasland_testimonial';
    }

    public function get_title() {
        return __( 'Testimonials (Saasland)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel', 'slick', 'slick-theme', 'saasland-testimonials' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel', 'slick' ];
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
     * Developer: Droitlab Developer
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
                    'style_01' => [
                        'title' => __( '01: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial1',
                    ],
                    'style_02' => [
                        'title' => __( '02: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial2',
                    ],
                    'style_03' => [
                        'title' => __( '03: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial3',
                    ],
                    'style_04' => [
                        'title' => __( '04: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial4',
                    ],
                    'style_05' => [
                        'title' => __( '05: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial5',
                    ],
                    'style_06' => [
                        'title' => __( '06: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial6',
                    ],
                    'style_07' => [
                        'title' => __( '07: Carousel:', 'saasland-core' ),
                        'icon' => 'testimonial7',
                    ],
                    'style_08' => [
                        'title' => __( '08: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial8',
                    ],
                    'style_09' => [
                        'title' => __( '09: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial9',
                    ],
                    'style_10' => [
                        'title' => __( '10: Testimonials:', 'saasland-core' ),
                        'icon' => 'testimonial10',
                    ],
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section(); //End Preset


        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_06']
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => "We've heard things like"
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
                    '{{WRAPPER}} .text-center.mb_60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sec_title .f_600.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item .a_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '
                    {{WRAPPER}} .text-center.mb_60,
                    {{WRAPPER}} .sec_title .f_600.w_color,
                    {{WRAPPER}} .item .a_title
                ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Description  ------------------------------
        $this->start_controls_section(
            'desc_sec', [
                'label' => __( 'Description', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'desc', [
                'label' => esc_html__( 'Description Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_desc', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_desc',
                'selector' => '{{WRAPPER}} .sec_title p',
            ]
        );

        $this->end_controls_section(); // End description section


        // ------------------------------ Testimonials ------------------------------ //
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Testimonials', 'saasland-core' ),
            ]
        );

        //======== Testimonials 01, 03, 04, 05, 06, 08
        $testimonials_1 = new \Elementor\Repeater();
        $testimonials_1->add_control(
            'testimonial_image', [
                'label' => __( 'Author image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $testimonials_1->add_control(
            'name', [
                'label' => __( 'Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Mark Tony' , 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $testimonials_1->add_control(
            'designation', [
                'label' => __( 'Designation', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Software Developer' , 'saasland-core' ),
            ]
        );

        $testimonials_1->add_control(
            'content', [
                'label' => __( 'Content', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $testimonials_1->add_control(
			'rating',
			[
				'label' => __( 'Rating', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 5,
			]
		);

        $this->add_control(
            'testimonials', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $testimonials_1->get_controls(),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_08', 'style_09','style_10']
                ],
                'title_field' => '{{{ name }}}',
                'prevent_empty' => false
            ]
        ); //End Testimonials 01, 03, 04, 05, 06, 08


        //========= Testimonials 02
        $testimonials_2 = new \Elementor\Repeater();
        $testimonials_2->add_control(
            'name', [
                'label' => __( 'Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Mark Tony' , 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $testimonials_2->add_control(
            'designation', [
                'label' => __( 'Designation', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Software Developer' , 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $testimonials_2->add_control(
            'date', [
                'label' => __( 'Date', 'saasland-core' ),
                'type' => Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false,
                    'dateFormat' => 'M d, Y'
                ]
            ]
        );

        $testimonials_2->add_control(
            'content', [
                'label' => __( 'Content', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $testimonials_2->add_control(
            'testimonial_image', [
                'label' => __( 'Author image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'testimonials2', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $testimonials_2->get_controls(),
                'condition' => [
                    'style' => 'style_02'
                ],
                'title_field' => '{{{ name }}}',
                'prevent_empty' => false
            ]
        ); //End Testimonials 02



        //======== Testimonials 07
        $testimonials_3 = new \Elementor\Repeater();
        $testimonials_3->add_control(
            'name', [
                'label' => __( 'Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Arif Rahman',
            ]
        );

        $testimonials_3->add_control(
            'designation', [
                'label' => __( 'Designation', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Software Developer' , 'saasland-core' ),
            ]
        );

        $testimonials_3->add_control(
            'content', [
                'label' => __( 'Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'testimonials3', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $testimonials_3->get_controls(),
                'condition' => [
                    'style' => ['style_07']
                ],
                'title_field' => '{{{ name }}}',
                'prevent_empty' => false
            ]
        ); //End Testimonials 07


        $this->end_controls_section(); //End Testimonials

        /**
         * Slider Settings
         */
        $this->start_controls_section(
            'slider_settings', [
                'label' => __( 'Slider Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'loop', [
                'label' => __( 'Loop', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__( 'True', 'saasland-core' ),
                    'false' => esc_html__( 'False', 'saasland-core' ),
                ],
                'default' => 'true',
                'condition' => [
                    'style!' => 'style_06'
                ]
            ]
        );

        $this->add_control(
            'autoplay', [
                'label' => __( 'Autoplay', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__( 'True', 'saasland-core' ),
                    'false' => esc_html__( 'False', 'saasland-core' ),
                ],
                'default' => 'true'
            ]
        );

        $this->add_control(
            'slide_speed', [
                'label' => __( 'Slide Speed', 'saasland-core' ),
                'description' => __( 'Set the slide speed in millisecond', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500
            ]
        );

        $this->add_control(
            'slide_delay', [
                'label' => __( 'Slide Delay', 'saasland-core' ),
                'description' => __( 'Set the slide delay in millisecond', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'style!' => 'style_06'
                ]
            ]
        );

        $this->end_controls_section();
    }


    /**
     * Name: saasland_elementor_style_control
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @4.0.4
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Developer
     */
    public function saasland_elementor_style_control() {

        /**
         * Style Tabs
         * */
        //------------------------------ Style Title Content ------------------------------
        $this->start_controls_section(
            'style_counter_sec', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //========= Author Names
        $this->add_control(
            'author_name_heading', [
                'label' => __( 'Author Name', 'saasland-core' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'counter_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_item .feed_back_author h5.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .author_info h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ata_style_1_title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .const_testimonial_thumbnil .slick-list .item .content h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_counter_title',
                'selector' => '
                    {{WRAPPER}} .feedback_item .feed_back_author h5.w_color,
                    {{WRAPPER}} .app_testimonial_item .author_info h6,
                    {{WRAPPER}} .const_testimonial_thumbnil .slick-list .item .content h4,
                    {{WRAPPER}} .name
                    ',
            ]
        );

        //========= Author Designation
        $this->add_control(
            'author_designation_heading', [
                'label' => __( 'Designation', 'saasland-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_item .media .media-body h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .author_info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .const_testimonial_thumbnil .slick-list .item .content h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_designation',
                'selector' => '
                    {{WRAPPER}} .feedback_item .media .media-body h6,
                    {{WRAPPER}} .app_testimonial_item .author_info p,
                    {{WRAPPER}} .const_testimonial_thumbnil .slick-list .item .content h6,
                    {{WRAPPER}} .designation
                ',
            ]
        );


        //========= Contents
        $this->add_control(
            'contents_heading', [
                'label' => __( 'Contents', 'saasland-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'content_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_testimonial_item .f_300' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .shop_testimonial_slider h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_contents',
                'selector' => '
                    {{WRAPPER}} .app_testimonial_item .f_300,
                    {{WRAPPER}} .agency_testimonial_info .testimonial_item p,
                    {{WRAPPER}} .photography_testimonial_slider .item p,
                    {{WRAPPER}} .shop_testimonial_slider h2,
                    {{WRAPPER}} .content
                ',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_bg_title', [
                'label' => __( 'Style Background Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'bg_title', [
                'label' => esc_html__( 'Background Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Feedback"
            ]
        );

        $this->add_control(
            'color_bg_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_testimonial_area .text_shadow:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'typography_bg_title',
                'selector' => '{{WRAPPER}} .app_testimonial_area .text_shadow:before',
            ]
        );

        $this->end_controls_section(); //End Item style


        /*---------------------------- Testimonial item shape ---------------------------*/
        $this->start_controls_section(
            'testimonial_item_shape', [
                'label' => __( 'Shape Images', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'shape_1', [
                'label' => esc_html__( 'shape 1', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'shape_2', [
                'label' => esc_html__( 'shape 2', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'shape_3', [
                'label' => esc_html__( 'shape 3', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
            'shape_4', [
                'label' => esc_html__( 'shape 4', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section(); //End Shape Images


        //======================== Carousel Settings ==========================//
        $this->start_controls_section(
            'testimonial_carousel_style', [
                'label' => __( 'Carousel Settings', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('carousel_style_tabs');

        $this->add_control(
            'carousel_arrow_heading', [
                'label' => __( 'Arrow Style', 'saasland-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->start_controls_tab('carousel_style_tab_normal', [
            'label' => __('Normal', 'saasland-core')
        ]);

        $this->add_control(
            'carousel_arrow_color', [
                'label' => __( 'Arrow Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-next' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-next' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-prev' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'carousel_arrow_bg_color', [
                'label' => __( 'Arrow Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-next' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-next' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-prev' => 'background: {{VALUE}};',
                ]

            ]
        );

        $this->add_control(
            'carousel_arrow_border_color', [
                'label' => __( 'Arrow Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-next' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-next' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-prev' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'carousel_arrow_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '
                    {{WRAPPER}} .agency_testimonial_info .owl-next,
                    {{WRAPPER}} .agency_testimonial_info .owl-prev,
                    {{WRAPPER}} .nav_container .owl-next,
                    {{WRAPPER}} .nav_container .owl-prev,
                '
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('carousel_style_tab_hover', [
            'label' => __('Hover', 'saasland-core')
        ]);

        $this->add_control(
            'carousel_arrow_hover_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-next:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-next:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-prev:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'carousel_arrow_hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-next:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-next:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-prev:hover' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'carousel_arrow_hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-next:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-next:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .nav_container .owl-prev:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'carousel_arrow_hover_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '
                    {{WRAPPER}} .agency_testimonial_info .owl-next:hover,
                    {{WRAPPER}} .agency_testimonial_info .owl-prev:hover
                    {{WRAPPER}} .nav_container .owl-next:hover
                    {{WRAPPER}} .nav_container .owl-prev:hover
                '
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'carousel_sec_padding_heading', [
                'label' => __( 'Testimonial Content Style', 'saasland-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .support_testimonial_info .testimonial_slider .testimonial_item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'carousel_content_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '
                    {{WRAPPER}} .support_testimonial_info .testimonial_slider .testimonial_item,
                    {{WRAPPER}} .app_testimonial_item
                '
            ]
        );

        $this->add_responsive_control(
            'style_item_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .support_testimonial_info .testimonial_slider .testimonial_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); //Carousel Settings


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .feedback_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_center_box_color', [
                'label' => __( 'Testimonial Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_slider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'accent_color', [
                'label' => __( 'Accent Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev:hover, .agency_testimonial_info .owl-next:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_slider .owl-dots .owl-dot.active' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .feedback_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .app_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .agency_testimonial_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial_section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section(); //End Background Style

    }


    /**
     * Name: render
     * Desc: Widgets Render
     * Params: no params
     * Return: @void
     * Since: @4.0.4
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Developer
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); //Array to variable conversation

        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';
        $testimonials2 = isset($settings['testimonials2']) ? $settings['testimonials2'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';


        //Slick Slider Settings
        $slick_default_settings = [];
        if ( $settings['loop'] != '' ) {
            $slick_default_settings['loop'] = $settings['loop'];
        }
        if ( $settings['autoplay'] != '' ) {
            $slick_default_settings['autoplay'] = $settings['autoplay'];
        }
        if ( $settings['slide_speed'] != '' ) {
            $slick_default_settings['slide_speed'] = $settings['slide_speed'];
        }
        if ( $settings['slide_delay'] != '' ) {
            $slick_default_settings['slide_delay'] = $settings['slide_delay'];
        }

        //============ Include Template Parts
        include "templating/testimonials/{$settings['style']}.php";

    }
}
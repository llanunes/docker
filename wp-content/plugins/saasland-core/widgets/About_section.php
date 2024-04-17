<?php
namespace SaaslandCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor about widget.
 *
 * Elementor widget that displays a collapsible display of content in an toggle
 * style, allowing the user to open multiple items.
 *
 * @since 1.0.0
 */
class About_section extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve about widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'saasland_about';
    }

    /**
     * Get widget title.
     *
     * Retrieve about widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Saasland About', 'saasland-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve about widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-info-box';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'about' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /**
     * Register about widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        //======================== Contents Area =============================//
        $this->start_controls_section(
            'saasland_about', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'about_title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Best Selling Product of the month'
            ]
        );
        $this->add_control(
            'about_description', [
                'label' => esc_html__( 'Description', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => ''
            ]
        );
        $this->add_control(
            'about_btn_label', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => ''
            ]
        );
        $this->add_control(
            'about_btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,

            ]
        );

        $this->end_controls_section(); //End Contents Area


        //======================== Featured Images =============================//
        $this->start_controls_section(
            'featured_img_sec', [
                'label' => __( 'Featured Images', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'about_feature_img1', [
                'label' => esc_html__( 'Feature image', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'about_feature_img2', [
                'label' => esc_html__( 'Feature image 02', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'about_background_text', [
                'label' => esc_html__( 'Background Text', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'about_bg_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text_shadow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'about_background_text_typo',
                'selector'  => '{{WRAPPER}} .text_shadow',
            ]
        );

        $this->end_controls_section(); // End Featured Images


        /*--------------------------Style------------------------*/
        $this->start_controls_section(
            'about_styling', [
                'label' => esc_html__( 'Contents', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'about_title_margin', [
                'label' => __( 'Title Margin', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .gadget_details h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'about_title_color', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_details h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'about_title_typo',
                'label' => __( 'Title Typography', 'saasland-core' ),
                'selector'  => '{{WRAPPER}} .gadget_details h2',
            ]
        );

        //======== Description Style
        $this->add_control(
            'desc_heading', [
                'label' => __( 'Description', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'about_desc_margin', [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .gadget_details p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'about_desc_color', [
                'label' => __( 'Description Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_details p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'about_desc_typo',
                'label' => __( 'Description Typography', 'saasland-core' ),
                'selector'  => '{{WRAPPER}} .gadget_details p',

            ]
        );

        //========= Button Style
        $this->add_control(
            'about_button_heading', [
                'label' => __( 'Button Style', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'about_btn_typo',
                'selector'  => '{{WRAPPER}} .gadget_btn',
            ]
        );

        $this->start_controls_tabs( 'about_button_style_tab' );
        $this->start_controls_tab(
            'about_btn_style_normal', [
                'label' => esc_html__( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'about_btn_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_btn' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'about_btn_bg_color',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .gadget_btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name' => 'about_btn_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .gadget_btn',
            ]
        );

        $this->end_controls_tab();

        //======= Hover
        $this->start_controls_tab(
            'about_btn_style_hover', [
                'label' => esc_html__( 'Hover', 'saasland-core' )
            ]
        );

        $this->add_control(
            'btn_hover_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'about_btn_hover_bg_color',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .gadget_btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name' => 'about_btn_hover_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .gadget_btn:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section(); //End Contents Style

    }

    /**
     * Render about widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="gadget_about_area sec_pad">
            <?php
            if( !empty( $settings['about_background_text'] ) ){
                echo '<div class="text_shadow wow" data-splitting>'. esc_html( $settings['about_background_text'] ) .'</div>';
            } ?>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="gadget_about_img">
                            <?php
                            if( !empty( $settings['about_feature_img1']['id'] ) ){
                                echo wp_get_attachment_image( $settings['about_feature_img1']['id'], 'full', '', array( 'class'=>'one_img' ) );
                            }
                            if( !empty( $settings['about_feature_img2']['id'] ) ){
                                echo wp_get_attachment_image( $settings['about_feature_img2']['id'], 'full', '', array( 'class'=>'two_img wow fadeInRight' ) );
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="gadget_details pl_70">
                            <?php
                            if( !empty( $settings['about_title'] ) ){
                                echo '<h2 class="wow" data-splitting>'. wp_kses_post( $settings['about_title'] ) .'</h2>';
                            }
                            if( !empty( $settings['about_description'] ) ){
                                echo '<p data-splitting class="wow">'. wp_kses_post( $settings['about_description'] ) .'</p>';
                            }
                            if( !empty( $settings['about_btn_label'] ) ){
                                echo '<a href="'. esc_url( $settings['about_btn_url']['url'] ) .'" '. saasland_is_external_return( $settings['about_btn_url'] ) .' class="gadget_btn wow fadeInUp" data-wow-delay="0.7s">'. esc_html( $settings['about_btn_label'] ) .'</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php

    }
}

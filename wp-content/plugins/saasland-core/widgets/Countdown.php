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
 * Class Countdown
 * @package SaaslandCore\Widgets
 */
class Countdown extends Widget_Base {

    public function get_name() {
        return 'saasland_countdown';
    }

    public function get_title() {
        return __( 'Date Countdown', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return ['date-countdown'];
    }

    protected function register_controls() {

        // ------------------------------------- Select Style -----------------------------------------//
        $this->start_controls_section(
            'select_style', [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Style 01', 'saasland-core' ),
                    '2' => __( 'Style 02', 'saasland-core' ),
                ],
                'default' => '1',
                'label_block' => true
            ]
        );

        $this->end_controls_section();//End Select Style


        //================================== Contents ================================//
        $this->start_controls_section(
            'date_count_down_sec', [
                'label' => __( 'Contents', 'saasland-core' ),
                'condition' => [
                    'style' => [ '1', '2' ]
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_control(
            'date_count_down', [
                'label' => __( 'Date Time Picker', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => array(
                    'enableTime' => false,
                    'dateFormat' => "d/m/Y"
                ),
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_control(
            'date_count_down2', [
                'label' => __( 'Date Time Picker', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => array(
                    'enableTime' => false,
                    'dateFormat' => "Y-m-d"
                ),
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->end_controls_section(); //End Contents


        //----------------------------------------- Style Title ----------------------------------------//
        $this->start_controls_section(
            'title_style_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_text h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .event_text h3',
            ]
        );

        $this->end_controls_section(); //End Style Title


        //---------------------------------------- Style Contents --------------------------------------------//
        $this->start_controls_section(
            'countdown_content_style', [
                'label' => __( 'Contents', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'timer_color', [
                'label' => __( 'Timer Number Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_discount_info .discount-time .clock .timer span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .gadget_discount_info .discount-time .clock .timer:before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Timer Number Typography', 'saasland-core' ),
                'name' => 'timer_number_typo',
                'selector' => '
                    {{WRAPPER}} .gadget_discount_info .discount-time .clock .timer span,
                    {{WRAPPER}} .gadget_discount_info .discount-time .clock .timer:before
                ',
            ]
        );
        $this->add_control(
            'timer_text_color', [
                'label' => __( 'Timer Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_discount_info .discount-time .clock .timer .smalltext' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Timer Text Typography', 'saasland-core' ),
                'name' => 'timer_text_typo',
                'selector' => '
                    {{WRAPPER}} .gadget_discount_info .discount-time .clock .timer .smalltext',
            ]
        );
        $this->end_controls_section();//End stye contents


        //--------------------------------- Section Background Style ------------------------------//
        $this->start_controls_section(
            'sec_bg_style', [
                'label' => __( 'Section Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_counter_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event_counter_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section(); //End Section Background style

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $title = !empty( $settings['title'] ) ? $settings['title'] : '';

        $date_count_down = !empty( $settings['date_count_down'] ) ? $settings['date_count_down'] : '';
        $date_count_down2 = !empty( $settings['date_count_down2'] ) ? $settings['date_count_down2'] : '';


        //=== Include Template parts
        include "templating/countdown/countdown-{$settings['style']}.php";

    }
}
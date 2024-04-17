<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Subscriber;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \DROIT_ELEMENTOR_PRO\Button;
use \DROIT_ELEMENTOR_PRO\Button_Hover;
use \DROIT_ELEMENTOR_PRO\Content_Typography;

if (!defined('ABSPATH')) {exit;}

abstract class Subscriber_Control extends Widget_Base
{

    // Get Control ID
    protected function get_control_id($control_id)
    {
        return $control_id;
    }
    public function get_pro_subscriber_settings($control_key)
    {
        $control_id = $this->get_control_id($control_key);
        return $this->get_settings($control_id);
    }
   
    //Preset
    public function _dl_pro_subscriber_preset_controls()
    {
        $this->start_controls_section(
            '_dl_pr_subscriber_layout_section',
            [
                'label' => __('Layout', 'saasland-core'),
            ]
        );

        $this->add_control(
            '_dl_pro_subscriber_skin',
            [
                'label' => esc_html__('Preset', 'saasland-core'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => apply_filters('dl_widgets/pro/subscriber/control_presets', [
                    '' => 'Default',
                ]),
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    /** subscriber content style controls function list wrapper **/
    protected function _dl_pro_subscriber_content_controls()
    {
        $this->start_controls_section(
            '_dl_pro_subs_from_content',
            [
                'label' => __( 'Genaral', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_wrapper_style();

        $this->end_controls_section();
    }

    protected function _dl_pro_subscriber_btn_controls() {
        $this->start_controls_section(
            '_dl_pro_subs_from_btn_content', [
                'label' => __( 'Button Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_btn_style();

        $this->add_control(
            '_dl_pro_btn_icon_size', [
                'label' => esc_html__( 'Icon Size', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            '_dl_pro_btn_icon_spacing', [
                'label' => esc_html__( 'Icon Spacing', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => saasland_el_slider_range(),
                'selectors' => [
                    '{{WRAPPER}} .dl_cu_btn i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function _dl_pro_subscriber_input_style_controls()
    {
        $this->start_controls_section(
            '_dl_pro_subs_from_input_content',
            [
                'label' => __( 'Input Style', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->_dl_pro_subs_from_input_style();

        $this->end_controls_section();
    }

    //advance tab general Style
    public function _dl_pro_subs_from_wrapper_style()
    {
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => '_dl_pro_subs_from_content_bg_controls',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form',
            ]
        );
        $this->add_responsive_control(
			'_dl_pro_subs_from_padding_controls',
			[
				'label' => __( 'Padding', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => '_dl_pro_subs_from_border_controls',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form',
            ]
        );
        $this->add_responsive_control(
			'_dl_pro_subs_from_border_radius_controls',
			[
				'label' => __( 'Border Radius', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    }

    //advance tab btn Style
    public function _dl_pro_subs_from_btn_style()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_tabs('_dl_pro_buttons_tabs');

        $this->start_controls_tab('_dl_pro_adv_tab_normal', [
                'label' => esc_html__('Normal', 'saasland-core'),
            ]
        );
        $this->add_group_control(
            Button::get_type(),
            [
                'name' => '_dl_pro_subs_from_btn_normal_controls',
                'label' => __( 'Button style', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn ',
            ]
        );
        $this->add_group_control(
            Content_Typography::get_type(),
            [
                'name' => '_dl_pro_subs_from_btn_normal_controls',
                'label' => __( 'Button Typography', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn ',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_dl_pro_adv_tab_hover',
            [
                'label' => esc_html__('Hover', 'saasland-core'),
            ]
        );
        $this->add_group_control(
            Button_Hover::get_type(),
            [
                'name' => '_dl_pro_subs_from_btn_hover_controls',
                'label' => __( 'Button style', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn:hover',
            ]
        );
        $this->add_control(
            '_dl_pro_subs_from_btn_hover_color_controls',
            [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form .dl_cu_btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

    }

    //advance tab general input Style
    public function _dl_pro_subs_from_input_style()
    {
        do_action('dl_widgets/button/pro/section/style/before', $this);
        $this->start_controls_tabs('_dl_pro_subs_form_input');

        $this->start_controls_tab('_dl_pro_search_form_normal',
            [
                'label' => esc_html__('Normal', 'saasland-core'),
            ]
        );
        
        $this->add_control(
			'por_subs_input_color',
			[
				'label' => __( 'Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'por_subs_input_paceholder_color',
			[
				'label' => __( 'Paceholder Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'por_subs_input_content_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control',
			]
		);
        $this->add_responsive_control(
			'por_subs_input_padding',
			[
				'label' => __( 'Padding', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'por_subs_input_margin',
			[
				'label' => __( 'Margin', 'saasland-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            '_dl_pro_subs_from_input_border_radius_controls',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control_wrap input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'por_subs_input_width',
			[
                'label' => __( 'Width', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 1,
				'default' => 100,
                'selectors' => [
                    '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control, .dl_pro_subscribe_form .dl_cu_btn' => 'width: {{VALUE}}%;',
				],
                'condition' => [
                    $this->get_control_id('_dl_pro_subscriber_skin') => ['dl-pro-sub-block'],
                ],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name' => 'pro_subs_input_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control',
			]
		);
        

        $this->end_controls_tab();


        $this->start_controls_tab('_dl_pro_search_form_hover',
            [
                'label' => esc_html__('Focus', 'saasland-core'),
            ]
        );

        $this->add_control(
			'por_subs_input_focus_color',
			[
				'label' => __( 'Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control:focus' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'por_subs_input_focus_paceholder_color',
			[
				'label' => __( 'Paceholder Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control:focus::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
                'name' => 'pro_subs_focus_input_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .dl_pro_subscribe_form .dl_form_control:focus',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

    }
}

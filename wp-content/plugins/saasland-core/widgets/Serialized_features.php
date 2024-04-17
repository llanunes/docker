<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Serialized Features
 */
class Serialized_features extends Widget_Base {
    public function get_name() {
        return 'saasland_serialized_features';
    }

    public function get_title() {
        return __( 'Serialized Features', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-number-field';
    }

    public function get_style_depends() {
        return [ 'saasland-features' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
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

        //========================= Select Style =====================//
        $this->start_controls_section(
            'sec', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Style One', 'saasland-core' ),
                    '2' => __( 'Style Two', 'saasland-core' ),
                ],
                'default' => '1',
                'label_block' => true
            ]
        );

        $this->end_controls_section();//End Style


        //************************************** Feature List ********************************//
        $this->start_controls_section(
            'feature_sec', [
                'label' => esc_html__( 'Features', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'default' => 'Awesome design',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'contents',
            [
                'label' => esc_html__( 'Content', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'img_icon', [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
                'type' =>Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'feature_list', [
                'label' => esc_html__( 'Feature list', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}'
            ]
        );

        $this->end_controls_section(); //End Features

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

        //=========================== Serial Number =======================//
        $this->start_controls_section(
            'serial_number_sec', [
                'label' => esc_html__( 'Serial Number', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'serial_no_typo',
                'selector' => '{{WRAPPER}} .number',
            ]
        );

        $this->start_controls_tabs(
            'serial_num_tabs'
        );

        //== Normal Tabs
        $this->start_controls_tab(
            'serial_num_normal_tab', [
                'label' => esc_html__( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'serial_no_font_color', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'serial_no_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'serial_no_border_color', [
                'label' => esc_html__( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); //End Normal Tabs

        //== Hover Tabs
        $this->start_controls_tab(
            'serial_num_hover_tab', [
                'label' => esc_html__( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_serial_color_bg_sec', [
                'label' => esc_html__( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_features_item:hover .number' => 'background: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_color', [
                'label' => esc_html__( 'Separator Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .separator:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_serial_font_color', [
                'label' => esc_html__( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_features_item:hover .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'hover_serial_number_box-shadow',
                'type' => Controls_Manager::BOX_SHADOW,
                'selector' => '{{WRAPPER}} .saas_features_item:hover .number'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); //End Serial Number


        //============================== Feature Item ============================//
        $this->start_controls_section(
            'feature_item_style', [
                'label' => esc_html__( 'Feature Contents', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'feature_item_style_tabs'
        );

        $this->start_controls_tab(
            'feature_item_normal_tab', [
                'label' => esc_html__( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'item_title_color', [
                'label' => esc_html__( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_subtitle_color', [
                'label' => esc_html__( 'Content Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control (
            'item_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_features_item .new_service_content' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'feature_item_shadow',
                'type' => Controls_Manager::BOX_SHADOW,
                'selector' => '{{WRAPPER}} .saas_features_item:hover .new_service_content',
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->end_controls_tab(); //End Features Item

        //==== Hover
        $this->start_controls_tab(
            'feature_item__hover_tab', [
                'label' => esc_html__( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_fitem_title_color', [
                'label' => esc_html__( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-center:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_fitem_subtitle_color', [
                'label' => esc_html__( 'Content Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-center:hover .content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control (
            'hover_fitem_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .saas_features_item:hover .new_service_content' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'hover_feature_item_shadow',
                'type' => Controls_Manager::BOX_SHADOW,
                'selector' => '{{WRAPPER}} .new_service .saas_features_item:hover .new_service_content',
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'item_title_spacing', [
                'label' => esc_html__( 'Title Spacing', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'item_title_typo',
                'label' => __( 'Title Typography', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'item_content_typo',
                'label' => __( 'Content Typography', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .content',
            ]
        );

        $this->end_controls_section(); //End Feature Item

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        $features = $settings['feature_list'];
        ?>

        <section class="<?php echo esc_attr($style == '1' ? 'new_service' : 'business_info') ?>">
            <div class="row">
                <?php
                $i = 1;
                if (!empty( $features )) {
                    foreach ( $features as $feature ) {
                        ?>
                        <div class="col-lg-4 col-sm-6 <?php echo esc_attr($style == '1' ? '' : 'work_steps_item ' ) ?>elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                            <div class="<?php echo esc_attr($style == '1' ? 'saas_features_item ' : ''); ?>text-center wow fadeInUp" data-wow-delay="0.3s">
                                <div class="number"><?php echo esc_attr($i) ?></div>
                                <div class="separator"></div>
                                <div class="new_service_content">
                                    <?php if (!empty($feature['img_icon']['url'])) : ?>
                                        <img src="<?php echo esc_url($feature['img_icon']['url']) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($feature['title'])) : ?>
                                        <h4 class="f_size_20 f_p t_color f_500 title"><?php echo esc_html($feature['title']) ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($feature['contents'])) : ?>
                                        <p class="f_400 f_size_15 mb-0 content"><?php echo wp_kses_post($feature['contents']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i ++;
                    }}
                ?>
            </div>
        </section>
        <?php
    }
}
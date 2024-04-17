<?php
namespace SaaslandCore\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Featured_image_with_shape
 * @package SaaslandCore\Widgets
 */
class Featured_image_with_shape extends Widget_Base {

    public function get_name() {
        return 'saasland_featured_image';
    }

    public function get_title() {
        return __( 'Image with Shape', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {

        //------------------------------ Select Style ------------------------------ //
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        // Style
        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default'=> esc_html__( 'Default', 'saasland-core' ),
                    'style_01' => esc_html__( '01: (single image)', 'saasland-core' ),
                    'style_02' => esc_html__( '02: (single image)', 'saasland-core' ),
                    'style_03' => esc_html__( '03: (two images)', 'saasland-core' ),
                    'style_04' => esc_html__( '04: (single image)', 'saasland-core' ),
                    'style_05' => esc_html__( '05: (two images)', 'saasland-core' ),
                    'style_06' => esc_html__( '06: (single image)', 'saasland-core' ),
                    'style_07' => esc_html__( '07: (Three images with layer)', 'saasland-core' ),
                    'style_08' => esc_html__( '08: (Images with Title)', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section(); //End Select Style


        // --------------------------------- Featured Images ------------------------------ //
        $this->start_controls_section(
            'contents_sec', [
                'label' => __( 'Image', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'numbertitle', [
                'label' => __( 'Number Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '01',
                'condition' => [
                    'style' => 'style_08'
                ]
            ]
        );

        // $this->add_control(
        //     'link',
        //     [
        //         'label' => __( 'Link', 'rave-core' ),
        //         'type' => Controls_Manager::URL,
        //         'dynamic' => [
        //             'active' => true,
        //         ],
        //         'placeholder' => __( 'https://your-link.com', 'rave-core' ),
        //         'condition' => [
        //             'style' => 'style_08'
        //         ],
        //         'show_label' => false,
        //     ]
        // );

        $this->add_control(
            'btn_label', [
                'label' => __( 'Button Label', 'rave-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Shop Now',
                'condition' => [
                    'type' => 'product_image'
                ]
            ]
        );

        $this->add_control(
            'link_to',
            [
                'label' => __( 'Link', 'rave-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'rave-core' ),
                    'file' => __( 'Media File', 'rave-core' ),
                    'custom' => __( 'Custom URL', 'rave-core' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'rave-core' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'rave-core' ),
                'condition' => [
                    'link_to' => 'custom',
                ],
                'show_label' => false,
            ]
        );

        $this->add_control(
            'open_lightbox',
            [
                'label' => __( 'Lightbox', 'rave-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'rave-core' ),
                    'yes' => __( 'Yes', 'rave-core' ),
                    'no' => __( 'No', 'rave-core' ),
                ],
                'condition' => [
                    'link_to' => 'file',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name' => 'image_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .typgraphy_img img',
                'condition' => [
                    'style' => 'style_06'
                ]
            ]
        );

        $this->add_control(
            'image2', [
                'label' => __( 'Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => [ 'style_03', 'style_05' ]
                ]
            ]
        );

        $this->add_control(
            'bg_shape', [
                'label' => __( 'Background Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/new_shape.png', __FILE__)
                ],
                'condition' => [
                    'style' => [ 'style_03', 'style_04', 'style_05' ]
                ]
            ]
        );

        $this->end_controls_section(); //End Featured Images


        //------------------------------ Style Shape ----------------------------//
        $this->start_controls_section(
            'shape_section', [
                'label' => __( 'Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        // Shape 01
        $this->add_control(
            'is_shape1', [
                'label' => __( 'Shape 01', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape1_color', [
                'label'     => esc_html__( 'Shape 01 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .seo_features_img .round_circle' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .typgraphy_img .circle_shape_1' => 'background: {{VALUE}};',
                ),
                'condition' => [
                    'is_shape1' => ['yes'],
                ],
            ]
        );

        // Shape 2
        $this->add_control(
            'is_shape2', [
                'label' => __( 'Shape 02', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'shape2_color', [
                'label'     => esc_html__( 'Shape 02 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .round_circle.two' => 'background: {{VALUE}};',
                ),
                'condition' => [
                    'is_shape2' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section(); //End Style Shape

        $this->start_controls_section(
            'dimension_section', [
                'label' => __( 'Dimension', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_responsive_control(
			'img_dimension_width',
			[
				'label' => esc_html__( 'Width', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .seo_features_img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'img_dimension_height',
			[
				'label' => esc_html__( 'Height', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .seo_features_img img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);



        $this->end_controls_section(); //End Style Shape


        //------------------------------ Style Shape 06 ------------------------------
        $this->start_controls_section(
            'shape_section6', [
                'label' => __( 'Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_06']
                ]
            ]
        );

        $this->add_control(
            'shape_color', [
                'label'     => esc_html__( 'Shape 01 Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .typgraphy_img .circle_shape_1' => 'background: {{VALUE}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'shape_x_position', [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .circle_shape_1' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_y_position', [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .circle_shape_1' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_round', [
                'label' => __( 'Shape Round', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .circle_shape_1' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); //End Style Shape 06


        /**
         * Style Image style 8
         */
        $this->start_controls_section(
            'style_title_opt', [
                'label' => __( 'Style Title', 'rave-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_08','default']
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Stroke Color', 'rave-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .expect_info .expect_item .number' => '-webkit-text-stroke: 1px {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Style Image style 8
         */
        $this->start_controls_section(
            'style_image_opt', [
                'label' => __( 'Style Image', 'rave-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_08','default']
                ]
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => __( 'Overlay Color', 'rave-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rave-single-image.image-overlay::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'rave-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .expect_item img,{{WRAPPER}} .rave-single-image.image-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_contrast',
            [
                'label' => __( 'Image Contrast', 'rave-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} expect_item img,{{WRAPPER}} .rave-single-image.image-overlay' => 'filter: contrast({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->start_controls_tabs( 'image_effects' );

        $this->start_controls_tab( 'normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label' => __( 'Opacity', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .expect_item img,{{WRAPPER}} .rave-single-image.image-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters',
                'selector' => '{{WRAPPER}} .expect_item img,{{WRAPPER}} .rave-single-image.image-overlay',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'opacity_hover',
            [
                'label' => __( 'Opacity', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .expect_item:hover img,{{WRAPPER}} .rave-single-image.image-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .expect_item:hover img,{{WRAPPER}} .rave-single-image.image-overlay',
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'saasland-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section(); // End Buttons


        //========================= Feature Image with layer =========================//
        $this->start_controls_section(
            'image_with_layer_sec', [
                'label' => __( 'Feature Image with layer', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_07']
                ]
            ]
        );

        $this->add_control(
            'feature_image_01', [
                'label' => __( 'Feature Image 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'feature_image_02', [
                'label' => __( 'Feature Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'feature_image_03', [
                'label' => __( 'Feature Image 03', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $layers = new Repeater();
        $layers->add_control(
            'feature_image_layer', [
                'label' => __( 'Feature Image Layer', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'layers_label', [
                'label' => __( 'Layer Labels', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $layers->get_controls(),
                'title_field' => '{{{ feature_image_layer }}}',
            ]
        );

        $this->end_controls_section(); //End Feature Image with layer

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $link = $this->get_link_url( $settings );
        if ( $link ) {
            $this->add_link_attributes( 'link', $link );

            if ( Plugin::$instance->editor->is_edit_mode() ) {
                $this->add_render_attribute( 'link', [
                    'class' => 'elementor-clickable rave-single-image image-overlay',
                ] );
            }

            if ( 'custom' !== $settings['link_to'] ) {
                $this->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
            }
        }

        //===== Include Templates Parts
        if ( $settings['style'] == 'style_02' ) {
            include "templating/featured-image/style_01.php";
        }
        elseif ( $settings['style'] == 'default' ) {
            ?>
                <a <?php echo $this->get_render_attribute_string( 'link' ); ?> class="rave-single-image image-overlay">
                    <?php echo wp_get_attachment_image($settings['image']['id'], 'full'); ?>
                </a>
            <?php

        } 
        else {
            include "templating/featured-image/{$settings['style']}.php";
        }

    }

    /**
     * Retrieve image widget link URL.
     *
     * @since 1.0.0
     * @access private
     *
     * @param array $settings
     *
     * @return array|string|false An array/string containing the link URL, or false if no link.
     */
    private function get_link_url( $settings ) {
        if ( 'none' === $settings['link_to'] ) {
            return false;
        }

        if ( 'custom' === $settings['link_to'] ) {
            if ( empty( $settings['link']['url'] ) ) {
                return false;
            }

            return $settings['link'];
        }

        return [
            'url' => $settings['image']['url'],
        ];
    }
}
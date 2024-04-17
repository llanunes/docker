<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Animated_icon extends \Elementor\Widget_Base {


    public function get_name() {
        return 'saasnald_animated_icon';
    }

    public function get_title() {
        return __( 'Animated Icon', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-favorite';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_keywords() {
        return [ 'icon', 'animate' ];
    }


    protected function register_controls() {


        //===================== Lord Icon ======================//
        $this->start_controls_section(
            'section_icon', [
                'label' => __( 'Icon', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'lordicons', [
                'label'      => __( 'LordIcon', 'saasland-core' ),
                'type'       => Controls_Manager::SELECT,
                'options'    => saasland_loard_icons(),
                'default'    => 'lupuorrc',
                'label_block'=> true,
            ]
        );

        $this->add_control(
            'icon_animation', [
                'label'      => __( 'Animation', 'saasland-core' ),
                'type'       => Controls_Manager::SELECT,
                'options'    => saasland_lord_icon_animation(),
                'label_block'=> true,
                'default'    => 'none',

            ]
        );

        $this->add_control(
            'duration', [
                'label' => esc_html__( 'Animation Delay (ms)', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 10,
            ]
        );

        $this->add_responsive_control(
            'align', [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .lordicon_wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); //End Lord Icons


        //======================= Icon Settings ===========================//
        $this->start_controls_section(
            'lordicon_styleddfd', [
                'label' => __( 'Icon Settings', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'strock_width', [
                'label' => __( 'STROKE WIDTH', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'scale', [
                'label' => __( 'SCALE', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],

            ]
        );

        $this->add_responsive_control(
            'height_width', [
                'label' => __( 'Size', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1500,
                    ],

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '100',
                ],
            ]
        );

        $this->end_controls_section();


        //========================== Icon Colors =============================//
        $this->start_controls_section(
            'lordicon_style_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'lord_icon_color1', [
                'label' => __( 'Primary', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'lord_icon_color2', [
                'label' => __( 'Secondary', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} lord-icon',
            ]
        );

        $this->end_controls_section(); //End Icon Colors


        //============================ Icon Style =========================//
        $this->start_controls_section(
            'lordicon_style_bg', [
                'label' => __( 'Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(), [
                'name' => 'lordicon_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} lord-icon',
            ]
        );
        $this->add_responsive_control(
            'lordicon_border_radius', [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} lord-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name' => 'lordicon_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} lord-icon',
            ]
        );
        $this->add_control(
            'lordicon_margin', [
                'label' => __( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} lord-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'lordicon_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} lord-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); //End Icon Style


    }

    /**
     * Render icon widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $icon       = !empty( $settings['lordicons'] ) ? $settings['lordicons'] : 'akbjoiow';
        $icon_size  = !empty( $settings['icon_size']['size'] ) ? $settings['icon_size']['size'] : '';
        $animation  = !empty( $settings['icon_animation'] ) ? $settings['icon_animation'] : 'auto';

        //  generate url
        $base = 'https://cdn.lordicon.com/';
        $extension  = '.json';
        $src = $base.$icon.$extension;

        // color option
        $color = [
            'primary' => '#121331',
            'secondary' => '#08a88a'
        ];

        if (!empty($settings['lord_icon_color1']) && $settings['lord_icon_color1'] != '') {
            $color['primary'] = $settings['lord_icon_color1'];
        }

        if (!empty($settings['lord_icon_color2']) && $settings['lord_icon_color2'] != '') {
            $color['secondary'] = $settings['lord_icon_color2'];
        }

        // icon size
        $icon_size = [
            'height' => '250',
            'width' =>'250'
        ];

        if(!empty($settings['height_width']) && $settings['height_width'] != '') {
            $icon_size['width'] = $settings['height_width']['size'].'px';
            $icon_size['height'] = $settings['height_width']['size'].'px';
        }
        ?>
        <div class="lordicon_wrap">
            <lord-icon
                    src= <?php echo esc_url( $src); ?>
                    stroke =  <?php echo esc_attr($settings['strock_width']['size']); ?>
                    scale = <?php echo esc_attr($settings['scale']['size']); ?>
                    trigger=<?php echo esc_attr($settings['icon_animation']); ?>
                    colors= <?php  echo esc_attr( saasland_loard_icons_get_attr( $color)); ?>
                    delay = <?php echo esc_attr($settings['duration']); ?>
                    style=<?php  echo esc_attr( saasland_loard_icons_get_attr( $icon_size, ';')); ?>
                    >
            </lord-icon>
        </div>
        <?php
    }
}

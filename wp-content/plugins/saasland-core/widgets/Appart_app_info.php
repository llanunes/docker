<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_app_info extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_app_info';
    }

    public function get_title() {
        return __( 'App info', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-column';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Find Our App On'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem '
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Buttons ------------------------------
        $this->start_controls_section(
            'info_sec', [
                'label' => __( 'Info columns', 'saasland-core' ),
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'title',
			[
                'label' => esc_html__( 'Title', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'App Store Features',
			]
		);
        $repeater->add_control(
			'icon_type',
			[
                'label' => __( 'Icon type', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'font_icon',
                'options' => [
                    'font_icon' => __( 'Font icon', 'saasland-core' ),
                    'image_icon' => __( 'Image icon', 'saasland-core' ),
                ],
			]
		);

        $repeater->add_control(
			'font_icon',
			[
				'label' => __( 'Icon', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => 'ti-apple',
                'default' => [
					'value' => 'ti-apple',
				],
                'condition' => [
                    'icon_type' => 'font_icon'
                ]
			]
		);
		$repeater->add_control(
			'image_icon',
			[
				'label' => __( 'Choose Image', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'icon_type' => 'image_icon'
                ]
			]
		);
        $repeater->add_control(
			'rating',
			[
                'label' => __( 'Star rating', 'saasland-core' ),
                'description' => __( 'Select the star rating of your app out of five star rating.', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '5',
                'options' => [
                    '1' => '1',
                    '1.5' => '1.5',
                    '2' => '2',
                    '2.5' => '2.5',
                    '3' => '3',
                    '3.5' => '3.5',
                    '4' => '4',
                    '4.5' => '4.5',
                    '5' => '5',
                ]
			]
		);
        $repeater->add_control(
			'rating_label',
			[
                'label' => esc_html__( 'Title', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'App Store Features',
			]
		);
        $repeater->add_control(
			'info_items',
			[
                'label' => __( 'Info items', 'saasland-core' ),
                'description' => esc_html__( 'Input the info based on <tr><td>Key</td></tr> <tr><td>Value</td></tr>', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
                'default' => '<tr>
                            <td>Category:</td>
                            <td>Health & Fitness</td>
                        </tr>
                        <tr>
                            <td>Updated:</td>
                            <td>Oct 19, 2017</td>
                        </tr>
                        <tr>
                            <td>Version:</td>
                            <td>5.5.1</td>
                        </tr>
                        <tr>
                            <td>Size:</td>
                            <td>65.2 MB</td>
                        </tr>
                        <tr>
                            <td>Language:</td>
                            <td>English</td>
                        </tr>
                        <tr>
                            <td>Seller: </td>
                            <td>Skyfit Sports Inc.</td>
              </tr>',
			]
		);

		$this->add_control(
			'infos',
			[
                'label' => __( 'App info', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'App Store Features', 'saasland-core' ),
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

        $this->end_controls_section(); // End Buttons

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                ],
                'default' => '#1a264a'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '{{WRAPPER}} .title-four h2',
            ]
        );
        $this->end_controls_section();

        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle',
            [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_suffix',
            [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_subtitle',
                'selector' => '{{WRAPPER}} .title-four p',
            ]
        );
        $this->end_controls_section();

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app-deatails-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'style_section_icon', [
                'label' => __( 'Icon Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'saasland-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 70,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .app-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'icon_lineheight',
			[
				'label' => __( 'Icon Line Height', 'saasland-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
						'step' => 1,
					]
				],

				'selectors' => [
					'{{WRAPPER}} .app-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs(
			'icon_style_tabs'
		);

		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'saasland-core' ),
			]
		);
        $this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .app-icon i' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Icon Border Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .app-details .app-icon' => 'border-color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'app_icon_bg',
				'label' => __( 'Background', 'saasland-core' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .app-icon',
			]
		);


        $this->end_controls_tab();
        $this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'saasland-core' ),
			]
		);
            $this->add_control(
                'icon_color_hover',
                [
                    'label' => __( 'Color', 'saasland-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .app-details:hover .app-icon i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'icon_border_color_hv',
                [
                    'label' => __( 'Icon Border Color', 'saasland-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .app-details:hover .app-icon' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'app_icon_bg_hv',
                    'label' => __( 'Background', 'saasland-core' ),
                    'types' => [ 'classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .app-details:hover .app-icon:before',
                ]
            );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'style_content',
            [
                'label' => __( 'Style Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'headding',
			[
				'label' => __( 'Heading', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Heading Color', 'saasland-core' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .app-details .app-title h5' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __( 'Typography', 'saasland-core' ),
                    'selector' => '{{WRAPPER}} .app-details .app-title h5',
                ]
            );

            $this->add_control(
                'headding_rating',
                [
                    'label' => __( 'Rating', 'saasland-core' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
                $this->add_control(
                    'rating_color',
                    [
                        'label' => __( 'Rating Color', 'saasland-core' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .app-details .user-info .star-rating i' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_control(
                    'rating_text_color',
                    [
                        'label' => __( 'Text Color', 'saasland-core' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .app-details .user-info span' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_control(
                    'content_title',
                    [
                        'label' => __( 'Details', 'saasland-core' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $this->add_control(
                    'title_text_color',
                    [
                        'label' => __( 'Title Color', 'saasland-core' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .app-details .customer_table table td' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_title_typography',
                        'label' => __( 'Typography', 'saasland-core' ),
                        'selector' => '{{WRAPPER}} .app-details .customer_table table td',
                    ]
                );
                $this->add_control(
                    'details_text_color',
                    [
                        'label' => __( 'Title Color', 'saasland-core' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .app-details .customer_table table td + td' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_details_typography',
                        'label' => __( 'Typography', 'saasland-core' ),
                        'selector' => '{{WRAPPER}} .app-details .customer_table table td + td',
                    ]
                );
    
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $infos = isset($settings['infos']) ? $settings['infos'] : '';
        ?>
        <section class="app-deatails-area">
            <div class="container">
                <div class="title-four text-center">
                    <?php if (!empty($settings['title_text'])) : ?>
                        <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle_text'])) : ?>
                        <div class="wow fadeInUp" data-wow-delay="300ms"><?php echo wpautop($settings['subtitle_text']); ?></div>
                    <?php endif;?>
                </div>
                <div class="app_info">
                    <div class="row m0">
                        <?php
                        if (is_array($infos)) {
                            foreach ( $infos as $info ) {
                                ?>
                                <div class="col-md-6 col-sm-12 p0">
                                    <div class="app-details">
                                        <div class="app-icon">
                                            <?php
                                            if ( $info['icon_type'] == 'image_icon' ) { ?>
                                                <?php echo wp_get_attachment_image($info['image_icon']['id'], 'full' ); ?>
                                                <?php
                                            } elseif ($info['icon_type']=='font_icon' ) { ?>
                                                <i class="<?php echo esc_attr($info['font_icon']['value']) ?>"></i>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="app-title">
                                            <h5> <?php echo esc_html($info['title']); ?> </h5>
                                            <div class="user-info">
                                                <div class="star-rating">
                                                    <?php saasland_reviews($info['rating']); ?>
                                                </div>
                                                <?php if (!empty($info['rating_label'])) ?> <span> <?php echo esc_html($info['rating_label']); ?> </span>
                                            </div>
                                        </div>
                                        <div class="table-responsive customer_table">
                                            <table class="table">
                                                <tbody>
                                                <?php echo $info['info_items']; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}
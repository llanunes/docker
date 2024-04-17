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
class Appart_features extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_features';
    }

    public function get_title() {
        return __( 'Features section', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
                'default' => 'Exclusive Features'
            ]
        );

        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'We’re a team of creative and make amazing site in ecommerce from Unite States. We love colour pastel, highlight and simple, its make our design look so awesome'
            ]
        );

        $this->add_responsive_control(
            'title_sec_margin', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'description' => esc_html__( 'Margin around title section', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .title-four' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'feature_list', [
                'label' => __( 'Feature list', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'title', [
				'label' => __( 'Feature name', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'desc',
			[
				'label' => __( 'Feature description', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'placeholder' => __( 'Feature description', 'saasland-core' ),
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
				'label'               => __( 'Social Icons', 'saasland-core' ),
				'type'                => \Elementor\Controls_Manager::ICON,
				'options'             => saasland_themify_icons(),
                'default'       => 'ti-ruler-pencil',
                'condition'     => [
                    'icon_type' => 'font_icon'
                ]
			]
		);
        $repeater->add_control(
			'icon_color',
			[
				'label' => __(  'Icon Color', 'saasland-core'),
				'type' => \Elementor\Controls_Manager::COLOR,
				// 'selectors' => [
				// 	'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				// ],
			]
		);

        $repeater->add_control(
			'image_icon',
			[
				'label' => __( 'Image icon', 'saasland-core'  ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'icon_type' => 'image_icon'
                ]
			]
		);
		$this->add_control(
			'features',
			[
				'label' => __( 'Features', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);
        $this->end_controls_section(); // End Buttons


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Section Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_prefix', [
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
                'name' => 'typography_prefix',
                'selector' => '{{WRAPPER}} .title-four h2',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle',
            [
                'label' => __( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_suffix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
                'default' => '#585e68'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_subtitle',
                'selector' => '{{WRAPPER}} .title-four p',
            ]
        );
        $this->add_responsive_control(
            'margin_around_subtitle', [
                'label' => __( 'Margin around the subtitle', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '15',
                    'bottom' => '50',
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );
        $this->end_controls_section();

        // ------------------------------------ Style Feature List
        $this->start_controls_section(
            'style_feature_list',
            [
                'label' => __( 'Style Feature List', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'column', [
                'label' => esc_html__( 'Show in column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '6' => 'Two',
                    '4' => 'Three',
                    '3' => 'Four',
                    '2' => 'Six',
                ]
            ]
        );
        $this->add_control(
            'feature_item_color', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-area-five .feature-five-item h2' => 'color: {{VALUE}};',
                ],
                'default' => '#404040'
            ]
        );
        $this->add_responsive_control(
            'feature_icon_size', [
                'label' => __( 'Icon size', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Title Typography', 'saasland-core' ),
                'name' => 'feature_item_title_typography',
                'selector' => '{{WRAPPER}} h2',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Subtitle Typography', 'saasland-core' ),
                'name' => 'feature_item_desc_typography',
                'selector' => '{{WRAPPER}} p',
            ]
        );
        $this->add_control(
            'feature_item_align', [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left align', 'saasland-core' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'left_icon'    => [
                        'title' => __( 'Left icon', 'saasland-core' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'center' => [
                        'title' => __( 'Center align', 'saasland-core' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                ],
                'default' => 'center'
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
                    '{{WRAPPER}} .features-area-six' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );
        $this->add_control(
            'is_circle', [
                'label' => __( 'Show/hide circles', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'left_circle_color', [
                'label' => __( 'Left circle color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-area-five .f-round.circle-one' => 'background: {{VALUE}};',
                ],
                'default' => '#9ce7c0',
                'condition' => [
                    'is_circle' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'left_circle_size', [
                'label' => __( 'Left circle size', 'saasland-core' ),
                'description' => __( 'Left circle size in pixel (px)', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '69',
                'condition' => [
                    'is_circle' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'right_circle_color', [
                'label' => __( 'Right circle color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-area-five .f-round.circle-two' => 'background: {{VALUE}};',
                ],
                'default' => '#ffe4f1',
                'condition' => [
                    'is_circle' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'right_circle_size', [
                'label' => __( 'Right circle size', 'saasland-core' ),
                'description' => __( 'Right circle size in pixel (px)', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '32',
                'condition' => [
                    'is_circle' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        ?>
        <section class="features-area-five features-area-six">
            <?php if ( $settings['is_circle']=='yes' ) : ?>
                <div class="f-round circle-one" style="height: <?php echo esc_attr($settings['left_circle_size']); ?>px; width: <?php echo esc_attr($settings['left_circle_size']); ?>px;"></div>
                <div class="f-round circle-two" style="height: <?php echo esc_attr($settings['right_circle_size']); ?>px; width: <?php echo esc_attr($settings['right_circle_size']); ?>px;"></div>
            <?php endif; ?>
            <div class="container">
                <div class="title-four text-center">
                    <?php if (!empty($settings['title_text'])) : ?> <h2> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                    <?php if (!empty($settings['subtitle_text'])) : ?> <?php echo wpautop($settings['subtitle_text']); endif; ?>
                </div>
                <div class="row <?php echo ($settings['feature_item_align']=='left_icon' ) ? 'more_features exclusive_features-two' : '' ?>">
                    <?php
                    if ($features) {
                        foreach ($features as $feature) {
                            ?>
                            <div class="col-md-<?php echo esc_attr($settings['column']) ?> col-sm-6 <?php echo ($settings['feature_item_align']!='left_icon' ) ? 'feature-five-item' : ''; echo $settings['feature_item_align']=='left' ? ' align_left' : ''; ?>">
                                <?php
                                if ( $settings['feature_item_align']=='left_icon' ) {
                                    ?>
                                    <div class="media d-flex">
                                        <div class="media-left">
                                            <?php
                                            if ($feature['icon_type'] == 'font_icon' ) : ?>
                                                <i class="<?php echo $feature['font_icon']; ?>" style="color: <?php echo $feature['icon_color'] ?>;"></i>
                                            <?php else: ?>
                                                <img src="<?php echo $feature['image_icon']['url'] ?>" alt="<?php echo esc_html($feature['title']) ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="media-body">
                                            <h2> <?php echo esc_html($feature['title']) ?> </h2>
                                            <?php echo (!empty($feature['desc'])) ? '<p>'.$feature['desc'].'</p>' : ''; ?>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if ($feature['icon_type'] == 'font_icon' ) : ?>
                                        <div class="round">
                                            <i class="<?php echo $feature['font_icon']; ?>" style="color: <?php echo $feature['icon_color'] ?>;"></i>
                                        </div>
                                    <?php else: ?>
                                        <img src="<?php echo $feature['image_icon']['url'] ?>" alt="<?php echo esc_html($feature['title']) ?>">
                                    <?php endif; ?>
                                    <h2> <?php echo esc_html($feature['title']) ?> </h2>
                                    <?php echo (!empty($feature['desc'])) ? '<p>'.$feature['desc'].'</p>' : ''; ?>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }}
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}

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
 * Hero Mobile
 */
class Hero_app extends Widget_Base {

    public function get_name() {
        return 'saasland-hero-app';
    }

    public function get_title() {
        return __( 'Hero Mobile', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'typed' ];
    }

    protected function register_controls() {

        // ----------------------------------------  Hero Title  -------------------------------------------//
        $this->start_controls_section(
            'hero_title', [
                'label' => __( 'Hero Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'title_note', [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Input the Typed words within curly braces. <br>Eg Title, True Multi-Purpose Theme for {Saas, Startup, Business} and more.', 'saasland-core' ),
                'content_classes' => 'elementor-warning',
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

        $this->end_controls_section();


        // ----------------------------------------  Hero Subtitle  -------------------------------------------//
        $this->start_controls_section(
            'hero_subtitle', [
                'label' => __( 'Hero Subtitle', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section(); // End Hero content


        // --------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage_sec', [
                'label' => __( 'Featured image/Video', 'saasland-core' ),
            ]
        );


        $this->add_control(
			'feature_style',
			[
				'label' => esc_html__( 'Feature Style', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'images',
				'options' => [
					'images'  => esc_html__( 'Images', 'saasland-core' ),
					'video' => esc_html__( 'video', 'saasland-core' ),
				],
			]
		);

        $this->add_control(
            'fimage', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'feature_style' => 'images',
                ],
            ]
        );

        $this->add_control(
            'fimage_size', [
                'label' => __( 'Image max width', 'saasland-core' ),
                'description' => esc_html__( 'Default image width is 100% and height is auto. Input the size in pixel unit.', ''),
                'type' => Controls_Manager::NUMBER,
                'condition' => [
                    'feature_style' => 'images',
                ],
                'size_units' => [ 'px', '%', 'rem' ],
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
                'selectors' => [
                    '{{WRAPPER}} img.mobile' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'feature_video',
            [
                'label' => esc_html__( 'Youtube Video Code', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'OZRWcCsvOXQ', 'saasland-core' ),
                'condition' => [
                    'feature_style' => 'video',
                ],
                'label_block' => true,
            ]
        );
        
        $this->add_control(
			'feature_video_height',
			[
				'label' => __( 'Video Height', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'feature_style' => 'video',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'height: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        $this->add_control(
			'feature_video_width',
			[
				'label' => __( 'Video Width', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
                'condition' => [
                    'feature_style' => 'video',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'width: {{SIZE}}{{UNIT}}',
                ],
			]
		);
        $this->add_responsive_control(
            'feature_video__margin',
            [
                'label'      => esc_html__('Margin', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style' => 'video',
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .video_popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_video_padding',
            [
                'label'      => esc_html__('Padding', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style' => 'video',
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .video_popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'feature_video_border',
                'condition' => [
                    'feature_style' => 'video',
                ],
                'label' => __('Box Border', 'saasland-core'),
                'selector' => '{{WRAPPER}} .video_popup',
            ]
        );

        $this->add_responsive_control(
            'feature_video_border_radius',
            [
                'label' => __('Border Radius', 'saasland-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'condition' => [
                    'feature_style' => 'video',
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .video_popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section(); // End Featured image


        // --------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'images_sec', [
                'label' => __( 'Animated Images', 'saasland-core' ),
            ]
        );

        $repeater_animated_img = new \Elementor\Repeater();
        $repeater_animated_img->add_control(
			'image_title', [
				'label' => __( 'Image alt text', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Animated image' , 'saasland-core' ),
				'label_block' => true,
			]
		);
        $repeater_animated_img->add_control(
			'image', [
				'label' => __( 'Image', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'animated_images', [
				'label' => __( 'Animated Images', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater_animated_img->get_controls(),
				'title_field' => '{{{ image_title }}}',
			]
		);

        $this->end_controls_section(); // End Animated Images


        /// --------------------  Buttons ----------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );


        $repeater->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $repeater->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        /// ----------------------------- Hover Button Style
        $repeater->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array (
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array (
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}'
                )
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .f_size_50.w_color.mb_20' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'selector' => '
                {{WRAPPER}} .f_size_50.w_color.mb_20',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_title',
                'selector' => '
                    {{WRAPPER}} .f_size_50.w_color.mb_20',
            ]
        );

        $this->add_control(
            'color_typed_text', [
                'label' => __( 'Typed Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} h2 mark' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_underline_typed_text', [
                'label' => __( 'Typed Text Underline Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2 mark:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();



        //--------------------------- Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_banner_contentmt p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'selector' => '
                {{WRAPPER}} .app_banner_contentmt p',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app_banner_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        ?>
        <section class="app_banner_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="app_banner_contentmt mt_40">
                            <?php if (!empty($settings['title'])) : ?>
                                <<?php echo $title_tag; ?> class="f_p f_700 f_size_50 w_color mb_20 wow fadeInLeft">
                                    <?php echo saasland_hero_title($settings['title']); ?>
                                </<?php echo $title_tag ?>>
                            <?php endif; ?>
                            <?php if (!empty($settings['subtitle'])) : ?>
                                <p class="f_300 f_size_18 l_height30 w_color wow fadeInLeft">
                                    <?php echo wp_kses_post($settings['subtitle']); ?>
                                </p>
                            <?php endif; ?>
                            <?php
                            foreach ($buttons as $button) {
                                echo "<a ".saasland_el_btn($button['btn_url'], false)." class='btn_hover mt_30 app_btn wow fadeInLeft elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="app_img">
                            <?php
                            if (!empty($settings['animated_images'])) {
                                foreach ($settings['animated_images'] as $i => $image) {
                                    switch ($i) {
                                        case 0:
                                            $ii = 'one';
                                            break;
                                        case 1:
                                            $ii = 'two';
                                            break;
                                        case 2:
                                            $ii = 'three';
                                            break;
                                        default:
                                            $ii = 'one';
                                            break;
                                    }
                                    echo wp_get_attachment_image($image['image']['id'], 'full', '', array( 'class' => 'app_screen '.$ii.' wow fadeInDown' ));
                                }
                            }
                            ?>
                            <?php if($settings['feature_style'] =='images' ){ ?>
                            <?php 
                            if (!empty($settings['fimage']['url'])) :
                            ?>
                                <img class="mobile" data-wow-delay="0.1s" src="<?php echo esc_url($settings['fimage']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                            <?php
                            endif; 
                            }else{ 
                            ?>
                            <?php 
                            if (!empty($settings['feature_video'])):
                            ?>
                            <iframe width="420" height="315" class="video_popup" src="https://www.youtube.com/embed/<?php echo $settings['feature_video']; ?>"></iframe>
                            <?php 
                            endif;
                            } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        saasland_typed_words_js($settings['title']);
    }
}

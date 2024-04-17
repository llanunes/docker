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
class Image_slideshow extends Widget_Base {
	public function get_name() {
		return 'saasland-image-slideshow';
	}

	public function get_title() {
		return __( 'Image Slideshow (Saasland)', 'saasland-core' );
	}

	public function get_icon() {
		return 'eicon-slider-3d';
	}

	public function get_style_depends() {
		return [ 'slick', 'slick-theme', 'saasland-images' ];
	}

    public function get_script_depends() {
        return [ 'slick' ];
    }

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	public function get_keywords() {
		return [ 'Image Slideshow' ];
	}

    protected function register_controls() {

        $this-> saasland_register_contents();
        $this-> saasland_register_styles();

    }

    public function saasland_register_contents() {
        // ----------------------------------------  Title Section  ------------------------------ //
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Architecture <span>Studio</span>',
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => __( 'Title HTML Tag', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_el_select_title_tag(),
                'default' => 'h2',
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'gallery_slideshow', [
                'label' => __( 'Add Images', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section(); // End Title Section

    }

    public function saasland_register_styles() {

        // ----------------------------------------  Style Title  ------------------------------ //
        $this->start_controls_section(
            'style_title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .architecture_hero_area .architecture_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'style_title_typo',
                'selector' => '{{WRAPPER}} .architecture_hero_area .architecture_text h2',
            ]
        );

        $this->end_controls_section(); // End Style Title

        // ----------------------------------------  Style Section Background  ------------------------------ //
        $this->start_controls_section(
            'style_sec_bg',
            [
                'label' => __( 'Section Background', 'saasland-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_margin', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .architecture_hero_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .architecture_header + section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .architecture_hero_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section(); // End Style Section Background
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);//Array to variable conversation
        ?>
        <section class="architecture_hero_area">
            <?php if ( $title ) : ?>
                <div class="architecture_text">
                    <?php echo sprintf('<%1$s> %2$s </%1$s>', $title_tag, $title ) ?>
                </div>
                <?php
            endif; ?>
            <div class="hero_img">
                <div class="resturent_img_slider" id="kenburnslider">
                    <?php
                    if ( $gallery_slideshow ) {
                        foreach ( $gallery_slideshow as $image ) {
                            ?>
                            <div class="item">
                                <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
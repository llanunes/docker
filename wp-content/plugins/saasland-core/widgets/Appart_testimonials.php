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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_testimonials extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_testimonials';
    }

    public function get_title() {
        return __( 'Testimonials Style', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive', 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel', 'slick' ];
    }

    protected function register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Users Review'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut<br> fugit, sed consequuntur magni dolores ratione voluptatem sequi nesciunt.'
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Testimonial items ------------------------------
        $this->start_controls_section(
            'testimonial_sec', [
                'label' => __( 'Testimonial items', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'author_name',
			[
				'label' => __( 'Quote Author Name', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Quote Author Name', 'saasland-core' ),
			]
		);

        $repeater->add_control(
			'author_url',
			[
				'label' => __( 'Quote Author URL', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Quote Author URL', 'saasland-core' ),
			]
		);
        $repeater->add_control(
			'author_designation',
			[
				'label' => __( 'Author Designation', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Author Designation', 'saasland-core' ),
			]
		);

        $repeater->add_control(
			'quote',
			[
				'label' => __( 'Quote Text', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Quote Text', 'saasland-core' ),
			]
		);
        $repeater->add_control(
			'author_image',
			[
				'label' => __( 'Quote Author image', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'testimonials',
			[
				'label' => __( 'Repeater List', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'author_name' => __( 'Mark M. Hayes', 'saasland-core' ),
						'author_url' =>  '#',
						'author_designation' =>  'Programmer @ DroitLab',
						'quote' => 'Sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
					],
					[
						'author_name' => __( 'Joseph M. Lankford', 'saasland-core' ),
						'author_url' =>  '#',
						'author_designation' =>  'Business management consultant',
						'quote' => 'Dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
					],
					[
						'author_name' => __( 'John T. Sloan', 'saasland-core' ),
						'author_url' =>  '#',
						'author_designation' =>  'Web Developer',
						'quote' => 'Ipsum dolor sit amet consectetur adipiscing elit donec tempus pellentesque dui vel tristique purus justo vestibulum eget lectus non gravida ultrices',
					],
				],
				'title_field' => '{{{ author_name }}}',
			]
		);
        $this->end_controls_section();


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style title', 'saasland-core' ),
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
            'style_subtitle', [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
                'default' => '#585e68'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
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
        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style one ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two ', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style three', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );
        $this->add_control(
            'sec_bg_image', [
                'label' => esc_html__( 'Background image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );
        $this->add_responsive_control (
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $quotes = isset($settings['testimonials']) ? $settings['testimonials'] : '';

        if ( $settings['style'] == 'style_01' ) {
            ?>
            <section class="testimonial_area">
                <div class="container">
                    <div class="title-four text-center">
                        <?php if (!empty($settings['title_text'])) : ?>
                            <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?>
                            <div class="wow fadeInUp" data-wow-delay="300ms"><?php echo wpautop($settings['subtitle_text']); ?></div>
                        <?php endif;?>
                    </div>
                    <div class="row">
                       <?php $is_rtl = 'false';
                       if ( is_rtl() ) {
                           $is_rtl = 'true';
                       }
                       ?>
                        <div class="testimonial-carousel owl-carousel" data-rtl="<?php echo esc_attr($is_rtl); ?>">
                            <?php
                            if (is_array($quotes)) {
                                foreach ($quotes as $quote) {
                                    ?>
                                    <div class="testimonial-item">
                                        <?php if (!empty($quote['author_image']['url'])) : ?>
                                            <div class="icon">
                                                <?php echo wp_get_attachment_image($quote['author_image']['id'], 'full' ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <p> <?php echo $quote['quote'] ?> </p>
                                        <div class="media d-flex">
                                            <div class="media-body">
                                                <h2> <?php echo $quote['author_name']; ?> </h2>
                                                <h6> <?php echo $quote['author_designation']; ?> </h6>
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

        elseif ( $settings['style']=='style_02' ) {
            ?>
            <section class="testimonial_area_two">
                <div class="container">
                    <div class="title-four h_color text-center">
                        <?php if (!empty($settings['title_text'])) : ?> <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?>
                            <?php echo '<p class="p_color wow fadeInUp" data-wow-delay="300ms">'.$settings['subtitle_text']."</p>";
                        endif; ?>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide testimonial_info" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            if (is_array($quotes)) {
                                $count  = 0;
                                foreach ($quotes as $quote) {
                                    ?>
                                    <div class="carousel-item <?php if ($count === 1){echo esc_attr( 'active' );}?>">
                                        <div class="carousel_text">
                                            <img src="<?php echo plugin_dir_url(__FILE__).'images/appart-new/quote2.png'; ?>" alt="f_img">
                                            <?php echo "<pre>";
                                            print_r( plugin_dir_url(__FILE__));
                                            echo "</pre>"; ?>
                                            <?php if (!empty($quote['quote'])) : ?>
                                                <p><?php echo $quote['quote']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }}
                            ?>
                        </div>
                        <ol class="carousel-indicators">
                            <?php
                            if (is_array($quotes)) {
                                $count  = 0;
                                foreach ($quotes as $quote) {
                                    ?>
                                    <li data-bs-target="#carouselExampleIndicators" data-slide-to="<?php echo $count ?>" class="<?php if ($count === 1){echo esc_attr( 'active' );}?>">
                                        <div class="slider_thumbs">
                                            <?php if (!empty($quote['author_image']['url'])) : ?>
                                                <img src="<?php echo esc_url($quote['author_image']['url']); ?>" alt="<?php echo $quote['author_name']; ?>">
                                            <?php endif; ?>
                                            <div class="thumbs_text">
                                                <h2><?php echo $quote['author_name']; ?></h2>
                                                <p><?php echo $quote['author_designation']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    $count++;
                                }}
                            ?>
                        </ol>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <i class="ti-arrow-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <i class="ti-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style']=='style_03' ) {
            wp_enqueue_style( 'slick' );
            wp_enqueue_style( 'slick-theme' );
            if (!empty($settings['sec_bg_image']['url'])) : ?>
                <style>
                    .testimonial-area:before {
                        background: url(<?php echo esc_url($settings['sec_bg_image']['url']) ?>) no-repeat center 0/cover;
                    }
                </style>
            <?php endif; ?>
            <section class="testimonial-area testimonial-three">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <div class="slick testimonial-img">
                                <?php
                                if (is_array($quotes)) {
                                    $count  = 0;
                                    foreach ($quotes as $quote) {
                                        ?>
                                        <div class="item">
                                            <?php if (!empty($quote['author_image']['url'])) : ?>
                                                <img src="<?php echo esc_url($quote['author_image']['url']); ?>" alt="<?php echo $quote['author_name']; ?>">
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    }}
                                ?>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="slick testimonial_slider_five">
                                <?php
                                if (is_array($quotes)) {
                                    $count  = 0;
                                    foreach ($quotes as $quote) {
                                        ?>
                                        <div class="testimonial-content flex">
                                            <img class="quote" src="<?php echo plugin_dir_url(__FILE__).'images/appart-new/quote2.png'; ?>" alt="<?php esc_attr_e( 'quot icon', 'saasland-core' ) ?>">
                                            <?php if (!empty($quote['quote'])) : ?>
                                                <p>“<?php echo $quote['quote']; ?>”</p>
                                            <?php endif; ?>
                                            <h5><a href="#"> <?php echo $quote['author_name']; ?> </a> <?php echo $quote['author_designation']; ?> </h5>
                                        </div>
                                        <?php
                                    }}
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <?php
        }
    }
}
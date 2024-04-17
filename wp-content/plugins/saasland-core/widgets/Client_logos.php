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
class Client_logos extends Widget_Base {

    public function get_name() {
        return 'saasland_client_logos';
    }

    public function get_title() {
        return __( 'Client Logos', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_style_depends() {
        return [ 'saasland-images' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

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

        // ------------------------------ Select Style  ------------------------------//
        $this->start_controls_section(
            'select_style', [
                'label' => __( 'Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( '01: Client Logo', 'saasland-core' ),
                    '2' => esc_html__( '02: Hover logo', 'saasland-core' ),
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section(); //End Style


        // ------------------------------ Clients Logos ------------------------------//
        $this->start_controls_section(
            'logo_carousel', [
                'label' => __( 'Clients Logos', 'saasland-core' ),
            ]
        );
        
        //===== Clients Logo Style 01
        $client_logo = new \Elementor\Repeater();
        $client_logo->add_control(
			'align_items', [
				'type' => \Elementor\Controls_Manager::HIDDEN,
			]
		);

        $client_logo->add_control(
			'logo_image', [
				'label' => __( 'Logo', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        $client_logo->add_control(
            'logo_url', [
                'label' => __( 'Url', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'saasland-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
			'logos', [
				'label' => __( 'Add Logo', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $client_logo->get_controls(),
				'title_field' => '{{{ align_items }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '1'
                ]
			]
		);

        //===== Clients Logo Style 02
        $this->add_control(
            'logo_img', [
                'label' => __( 'Logo', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_control(
            'logo_img2', [
                'label' => __( 'Logo 02', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_control(
            'logo_url', [
                'label' => __( 'Logo Url', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'saasland-core' ),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->end_controls_section(); // End Clients logo

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

        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Section Style Options', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-center .partner_logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_responsive_control(
            'margin', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'description' => esc_html__( 'Margin around single image item', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .partner_logo .p_logo_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $this->add_control(
            'align', [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .startup_clients_logo' => 'justify-content: {{VALUE}}',
                    
                ]
            ]
        );

        $this->add_responsive_control(
            'image_contrast',
            [
                'label' => __( 'Image Contrast', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => saasland_el_slider_range(),
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .partner_logo .p_logo_item img' => 'filter: contrast({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_contrast_hover', [
                'label' => __( 'Image Contrast on Hover', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => saasland_el_slider_range(),
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .partner_logo .p_logo_item:hover img' => 'filter: brightness({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section(); // End Buttons

    }

    protected function render() {
        $settings = $this->get_settings();
        $logos = isset($settings['logos']) ? $settings['logos'] : '';

        if ( !empty($settings['style'] == '1') ) {
            ?>
<section class="protype_clients_logo <?php echo ($settings['align'] == 'center' ) ? 'logo-center' : ''; ?>">
    <div class="container">
        <div class="partner_logo">
            <?php
                        if ( is_array($logos) ) {
                            foreach ($logos as $i => $logo) {
                                ?>
            <div class="p_logo_item wow fadeInLeft" data-wow-delay="0.<?php echo esc_attr($i); ?>s">
                <a <?php Saasland_Core_Helper()->the_button($logo['logo_url']) ?>>
                    <?php echo wp_get_attachment_image($logo['logo_image']['id'], 'full') ?>
                </a>
            </div>
            <?php
                            }
                        }
                        ?>
        </div>
    </div>
</section>
<?php
        } elseif ( !empty($settings['style'] == '2' ) ) {
            ?>
<a <?php Saasland_Core_Helper()->the_button($settings['logo_url']) ?> class="startup_clients_logo">
    <?php echo !empty($settings['logo_img']['id']) ? wp_get_attachment_image( $settings['logo_img']['id'], 'full', '', array('class' => 'img1') ) : ''; ?>
    <?php echo !empty($settings['logo_img2']['id']) ? wp_get_attachment_image( $settings['logo_img2']['id'], 'full', '', array('class' => 'img2') ) : ''; ?>
</a>
<?php
        }
    }
}
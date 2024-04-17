<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Button
 * @package RaveCore\Widgets
 */
class Bubble extends Widget_Base {

    public function get_name() {
        return 'bubble_animation';
    }

    public function get_title() {
        return __( 'Saasland Bubble Animation', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_style_depends() {
        return [ 'appart-style' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_btn', [
                'label' => __( 'Button', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_responsive_control(
			'height_width',
			[
				'label' => __( 'Width', 'saasland-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $repeater->add_responsive_control(
			'bubble_pos_x',
			[
				'label' => __( 'X position', 'saasland-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -500,
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
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $repeater->add_responsive_control(
			'bubble_pos_y',
			[
				'label' => __( 'Y position', 'saasland-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'saasland-core' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
        $this->add_control(
			'bubble_animation_generate',
			[
				'label' => __( 'Bubble Animation', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'height_width' => '130',
						'bubble_pos_x' => '-50',
						'bubble_pos_y' => '-53',
					],
					[
						'height_width' => '44',
						'bubble_pos_x' => '88',
						'bubble_pos_y' => '-53',
					],
				],
			]
		);
        $this->end_controls_section();
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

        $this->add_render_attribute('wrapper', 'class', 'travel_banner_text');
        $this->add_render_attribute('wrapper', 'class', 'elementor_bubble');

      ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
           <?php if(!empty($settings['bubble_animation_generate'])){
			   
			  foreach($settings['bubble_animation_generate'] as $key=>$bubble){ 
				   $wrapper_class = 'bubble one'.' '.'elementor-repeater-item-'.$bubble['_id'];
				   if($key > 0) {
					$wrapper_class = 'bubble two'.' '.'elementor-repeater-item-'.$bubble['_id'];
				   }
				 ?>
                <div class="<?php echo esc_attr($wrapper_class); ?>"></div>
            <?php  }} ?>
        </div>
      <?php 
        
    }

}
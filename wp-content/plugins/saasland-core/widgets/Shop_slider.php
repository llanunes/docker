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
 * Class Slider
 * @package SaaslandCore\Widgets
 */
class Shop_slider extends Widget_Base {

    public function get_name() {
        return 'rave_slider';
    }

    public function get_title() {
        return __( 'Rave Slider', 'rave-core' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'rave-elements' ];
    }

    public function get_style_depends() {
        return [ 'slick', 'slick-theme' ];
    }

    public function get_script_depends() {
        return [ 'slick' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'slider_sec',
            [
                'label' => __( 'Slider', 'rave-core' ),
            ]
        );

        //  Home style shop 

        $slides_shop = new \Elementor\Repeater();

        $slides_shop->add_control(
            'rave_slider_shop', [
                'label' => __( 'Background Image', 'rave-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $slides_shop->add_control(
            'rave_slider_shop_title', [
                'label' => __( 'Title', 'rave-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => ''
            ]
        );

        $slides_shop->add_control(
            'rave_slider_shop_subtitle', [
                'label' => __( 'Subtitle', 'rave-core' ),
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
        $slides_shop->add_control(
            'rave_slider_btn_lable', [
                'label' => __( 'Button Label', 'rave-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Go to shop',
            ]
        );
        
        $slides_shop->add_control(
            'rave_slider_btn_url', [
                'label' => __( 'Button URL', 'rave-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'rave_slider_item_shop', [
                'label' => __( 'Slide Items', 'rave-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ rave_slider_shop_title }}}',
                'fields' => $slides_shop->get_controls(),
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

            
        $this->start_controls_section(
            'slider_settings', [
                'label' => __( 'Slider Settings', 'rave-core' ),
            ]
        );

        $slides_setting = new \Elementor\Repeater();

        $slides_setting->add_control(
            'slider_loop', [
                'label' => __( 'Loop', 'rave-core' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $slides_setting->add_control(
            'slider_delay_duration', [
                'label' => __( 'Delay Duration', 'rave-core' ),
                'description' => __( 'Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled.', 'rave-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000
            ]
        );

        $this->add_control(
            'rave_slider_setting', [
                'type' => Controls_Manager::REPEATER,
                'fields' => $slides_setting->get_controls(),
                'separator' => 'before',
                'title_field' => 'Slider Settings',
                'item_actions' =>[
                    'duplicate' => false,
                    'add' => false,
                    'remove' => false
                ],
                'default' => [
					[
						'slider_loop' => 'yes',
						'slider_delay_duration' => '5000'
					],
	
				],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        extract($settings);
        $slider_configure = isset($settings['rave_slider_setting']) ? $settings['rave_slider_setting'] : '';
        ?>
            <section class="shop_slider_area">
            <div class="shop_slider site-slider slide2" data-slider="<?php echo esc_attr( json_encode($slider_configure[0]) ); ?>">
            
            <?php if(!empty($rave_slider_item_shop)) { 
                
                 foreach($rave_slider_item_shop as $key=>$slider) {  ?>

                <div class="slider_item parallaxie" style=" background-image: url('<?php echo esc_url($slider['rave_slider_shop']['url']) ?>'); ">
                        <div class="container">
                            <div class="shop_slider_text text-center">
                                <h6 data-animation="fadeInUp" data-delay="0.1s">
                                <?php echo esc_html($slider['rave_slider_shop_subtitle']); ?>
                                </h6>
                                <h2 data-animation="fadeInUp" data-delay="0.3s">
                                    <?php echo esc_html($slider['rave_slider_shop_title']); ?>
                                </h2>
                                <a href="<?php echo esc_url($slider['rave_slider_btn_url']['url']) ?>" class="shop_btn hover_style1" data-animation="fadeInUp" data-delay="0.5s">
                                  <?php echo esc_html($slider['rave_slider_btn_lable']); ?>
                                </a>
                                
                            </div>
                        </div>
                </div>
               
             <?php }} ?>

            </div>
           
            <div class="slider_nav main_slider_nav">
                <i class="icon-arrow-left left_arrow"></i>
                <i class="icon-arrow-right right_arrow"></i>
            </div>
        </section>
        <?php
    }
}

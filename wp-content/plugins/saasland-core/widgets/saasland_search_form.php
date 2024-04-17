<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Processes
 */
class Saasland_search_form extends Widget_Base {

    public function get_name() {
        return 'saasland_search_form';
    }

    public function get_title() {
        return __( 'Saasland Search Form', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {

        // ---------------------------------------- Search Form ------------------------------
        $this->start_controls_section(
            'search_form', [
                'label' => __( 'Search Form', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'placeholder_text', [
                'label' => esc_html__( 'Text Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Enter your keyword here',
            ]
        );

        $this->end_controls_section(); // End Search Form


        /**
         * @@
         * Style Tab
         * @@
         */
        //============================== Style Search Form ================================//
        $this->start_controls_section(
            'style_search_form', [
                'label' => __( 'Search Form', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'placeholder_text_color', [
                'label' => __( 'Placeholder Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq_search .form-control' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tavel_search .form-control' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'form_bg_style',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => ['image'],
                'selector' => '
                    {{WRAPPER}} .faq_search .form-control,
                    {{WRAPPER}} .tavel_search .form-control
                ',
            ]
        );

        $this->end_controls_section(); //End Search Form
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="faq_search">
    <input type="text" class="form-control" name="s" value="<?php the_search_query(); ?>"
        placeholder="<?php echo esc_attr($settings['placeholder_text']) ?>">
    <button class="btn"><i class="icon-search"></i></button>
    <input type="hidden" name="post_type" value="<?php echo esc_attr($settings['custom_pt_search_query']) ?>" />
    <!-- // hidden 'post type' value -->
</form>
<?php 
    }
}
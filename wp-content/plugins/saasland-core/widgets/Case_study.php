<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Blog Posts
 */
class Case_study extends Widget_Base {

    public function get_name() {
        return 'saasland_case_study';
    }

    public function get_title() {
        return __( 'Case Study [Saasland]', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid addons-icon';
    }

    public function get_style_depends() {
        return [ 'owl-carousel', 'saasland-blog' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /**
     * Name: register_controls
     * Desc: Register controls for these widgets
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    protected function register_controls() {

        // ---Start Blog Setting
        $this->start_controls_section(
            'Blog_filter', [
                'label' => __( 'Case Study Settings', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All'
            ]
        );
        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 8
            ]
        );
        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'case_section_style', [
                'label' => __( 'Case Study Item', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'case_background',
				'label' => esc_html__( 'Background', 'saasland-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .case_study_item .text',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'case_border',
				'label' => esc_html__( 'Border', 'saasland-core' ),
				'selector' => '{{WRAPPER}} .case_study_item .text',
			]
		);

        $this->add_responsive_control(
            'case_item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .case_study_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'case_item_margin',
            [
                'label'      => esc_html__('Margin', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .case_study_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'case_item_paddidng',
            [
                'label'      => esc_html__('Padding', 'saasland-core'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .case_study_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
            'case_style', [
                'label' => __( 'Case Study  Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => __( 'Title Text Color', 'appart-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case_study_item h3' => 'color: {{VALUE}};', 
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => 'Typography',
                'name' => 'sec_typography_title',
                'selector' => '{{WRAPPER}} .case_study_item h3',
                
            ]
        );

        $this->end_controls_section();  


        $this->start_controls_section(
            'case_style_date', [
                'label' => __( 'Style Date', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'date_color', [
                'label' => __( 'Date Color', 'appart-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case_study_item p' => 'color: {{VALUE}};', 
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => 'Typography',
                'name' => 'sec_typography_date',
                'selector' => '{{WRAPPER}} .case_study_item p',
                
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'case_style_excerpt', [
                'label' => __( 'Style Excerpt', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'excerpt_color', [
                'label' => __( 'Excerpt Color', 'appart-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .case_study_item p' => 'color: {{VALUE}};', 
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => 'Typography',
                'name' => 'sec_typography_excerpt',
                'selector' => '{{WRAPPER}} .case_study_item p',
                
            ]
        );

        $this->end_controls_section();
       
    }



    protected function render() {

    $settings = $this->get_settings_for_display();
    extract($settings); //Array to variable conversation

    $blogPost = new WP_Query( array(
        'post_type'      => 'case_study',
        'posts_per_page' => $settings['show_count'],
        'order'          => $settings['order'],
        'post__not_in'   => ! empty( $settings['exclude'] ) ? explode( ',', $settings['exclude'] ) : ''
    ) );

    ?>
    <section class="case_study_area">
    <div class="container">
        <div class="row">
        <?php
            while ( $blogPost->have_posts() ) :
                $blogPost->the_post();
            ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="case_study_item">
                        <?php the_post_thumbnail( 'saasland_370x350' ) ?>
                        <div class="text">
                            <p class="date"><?php echo get_the_date() ?></p>
                            <a href="<?php the_permalink() ?>">
                                <h3><?php the_title() ?></h3>
                            </a>
                            <?php echo wp_trim_words( get_the_excerpt(), 5, '...' ); ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>    
        

    
    <?php 
    }

}
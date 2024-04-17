<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Portfolio_masonry
 * @package SaaslandCore\Widgets
 */
class Tour_booking_activities extends Widget_Base {

    public function get_name() {
        return 'rave_tour_booking_activities';
    }

    public function get_title() {
        return __( 'Tour Booking Activities', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-masonry';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'isotope', 'magnific-popup','imagesLoaded' ];
    }
    protected function register_controls() {


        // ---------------------------------------- Style ------------------------------ //
        $this->start_controls_section(
            'tour_booking_activities',
            [
                'label' => __( 'Select Activities', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'activities', [
                'label' => esc_html__( 'Categories', 'saasland-core' ),
                'description' => esc_html__( 'Display Trip by categories', 'saasland-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => saasland_cat_array_by_slug('activities'),
                'label_block' => true,
                'multiple' => false,
            ]
        );

        $repeater->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View Tours'
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'include' => [],
                'default' => 'full',
            ]
        );

        $repeater->add_control(
            'column_grid',
            [
                'label' => __( 'Column Grid', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-lg-3 col-sm-6' => __( 'Small', 'saasland-core' ),
                    'col-lg-6'  => __( 'Big', 'saasland-core' ),
                ],
                'default' => 'col-lg-3 col-sm-6',
            ]
        );

        $this->add_control(
			'activities_lists',
			[
				'label' => __( 'Activities List', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ activities }}}',
                'prevent_empty' => false
			]
		);
        
        $this->end_controls_section(); // start Style

        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'saasland-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .travel_gallery_content .content a h3' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .travel_gallery_content .content a h3',
			]
		);
        // end title
        $this->add_control(
			'button_options',
			[
				'label' => esc_html__( 'Button', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Text Color', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .travel_gallery_content .content .travel_btn_two' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .travel_gallery_content .content .travel_btn_two',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .travel_gallery_content .content .travel_btn_two',
			]
		);
        $this->add_responsive_control(
			'btn_padding',
			[
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Padding', 'plugin-name' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .travel_gallery_content .content .travel_btn_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);
        ?>
<section class="travel_gallery_area">
    <div class="row travel_gallery_info">
        <?php
                $data_wow_delay = 0.1;
                $get_activities = $settings['activities_lists'];
                foreach ( $get_activities as $list ) {

                    $meta_id = get_term_by('slug',  $list['activities'], 'activities' );
                    $meta = get_term_meta( $meta_id->term_id );
                    $cat_url = get_category_link( $meta_id->term_id );

                    $list['thumbnail_size'] = [
                        'id' => ($meta['category-image-id'][0]),
                    ];
                    $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $list, 'thumbnail_size' );

                    switch($list['column_grid']) {
                        case 'col-lg-6':
                            $item_class = 'col-lg-6';
                            break;
                        case 'col-lg-3 col-sm-6' :
                            $item_class = 'col-lg-3 col-sm-6';
                            break;
                        default:
                            $item_class = 'col-lg-3 col-sm-6';
                    }
                    ?>

        <div class="<?php echo esc_attr($item_class) ?>">
            <div class="travel_gallery_item wow fadeInUp" data-wow-delay="<?php echo esc_attr($data_wow_delay) ?>s">
                <?php echo saasland_core_return($thumbnail_html); ?>
                <div class="overlay_bg"></div>
                <div class="travel_gallery_content">
                    <div class="content">
                        <?php
                                    if ( !empty($list['activities']) ) {
                                        ?>
                        <a href="<?php echo esc_url($cat_url) ?>">
                            <h3><?php echo $list['activities'] ?></h3>
                        </a>
                        <?php
                                    }
                                    if ( !empty($meta['wte-shortdesc-textarea']) ) {
                                        ?>
                        <p><?php echo $meta['wte-shortdesc-textarea'][0]; ?></p>
                        <?php
                                    }
                                    if ( !empty($list['btn_label']) ) {
                                        ?>
                        <a href="<?php echo esc_url($cat_url) ?>" class="travel_btn_two hover_style1">
                            <?php echo esc_html($list['btn_label']) ?>
                        </a>
                        <?php
                                    }
                                    ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
                    $data_wow_delay = $data_wow_delay + 0.2;
                }
                ?>
    </div>
</section>
<?php

    }
}
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
 * Class Portfolio_masonry
 * @package SaaslandCore\Widgets
 */
class Tour_booking extends Widget_Base {

    public function get_name() {
        return 'rave_tour_booking';
    }

    public function get_title() {
        return __( 'Tour Booking', 'rave-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'slick', 'slick-theme', 'hero-event' ];
    }

    public function get_script_depends() {
        return [ 'slick'];
    }

    protected function register_controls() {


        // ---------------------------------------- Style ------------------------------ //
        $this->start_controls_section(
            'blog_select_sec',
            [
                'label' => __( 'Preset Skin', 'rave-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__('Skins', 'rave-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __('1 : Tour Booking', 'rave-core'),
                        'icon' => 'tour_booking1',
                    ],
                    '2' => [
                        'title' => __('2 : Best Selling Tour', 'rave-core'),
                        'icon' => 'tour_booking2',
                    ],
                ],
                'default' => '1'
            ]
        );

        $this->end_controls_section(); // End Style

        //============================ Title Section ============================== //
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'rave-core' ),
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' =>esc_html__('Category', 'rave-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Best-Selling Tours'
            ]
        );

        $this->end_controls_section(); //End Title Section


        //============================ Filtering Settings ============================== //
        $this->start_controls_section(
            'booking_filter', [
                'label' => __( 'Filter', 'rave-core' ),
            ]
        );

        $this->add_control(
            'tour_destinations',
            [
                'label' =>esc_html__('Destinations', 'rave-core'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => saasland_cat_array('destination'),
                'multiple'  => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tour_activities',
            [
                'label' =>esc_html__('Activities', 'rave-core'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => saasland_cat_array('activities'),
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'tour_trip_types',
            [
                'label' =>esc_html__('Trip Types', 'rave-core'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => saasland_cat_array('trip_types'),
                'multiple'  => true,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show count', 'rave-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'rave-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'rave-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Name (by post slug)',
                    'date' => 'Date',
                    'rand' => 'Random',
                ],
                'default' => 'none'
            ]
        );

        $this->add_control(
            'excerpt_length', [
                'label' => esc_html__('Excerpt Word Length', 'rave-core'),
                'type' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'exclude', [
                'label' => esc_html__( 'Exclude Trip', 'rave-core' ),
                'description' => esc_html__( 'Enter the Trip post IDs to hide/exclude. Input the multiple ID with comma separated', 'rave-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); //End Filter


        //============================ Button ============================== //
        $this->start_controls_section(
            'button_sec', [
                'label' => __( 'Button', 'rave-core' ),
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->add_control(
            'btn_label',
            [
                'label' =>esc_html__('Button Label', 'rave-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Book the Tour'
            ]
        );

        $this->end_controls_section(); //End Title Section


        // ======================== Layout ============================ //
        $this->start_controls_section(
            'booking_layout', [
                'label' => __( 'Layout', 'rave-core' ),
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid column', 'rave-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'rave-core' ),
                    '4' => __( 'Three column', 'rave-core' ),
                    '3' => __( 'Four column', 'rave-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->end_controls_section();

        /*
         * Style Tabs
         */
        //----------------------------- Style Item Title ------------------------------------//
        $this->start_controls_section(
            'post_style', [
                'label' => __( 'Post Style', 'rave-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //================= Item Title
        $this->add_control(
            'item_title_style', [
                'label' => __( 'Title', 'rave-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_title_color', [
                'label' => __( 'Text Color', 'rave-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_title_hover_color', [
                'label' => __( 'Hover Color', 'rave-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .travel_package_item:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_title_typo',
                'selector' => '{{WRAPPER}} .title',
            ]
        ); // End Item Title


        //================= Item Category
        $this->add_control(
            'item_cats_style', [
                'label' => __( 'Category', 'rave-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'item_category_color', [
                'label' => __( 'Text Color', 'rave-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .place_name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'item_category_typo',
                'selector' => '{{WRAPPER}} .place_name',
            ]
        );

        $this->end_controls_section(); // End Post Style

        


    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $args = [
            'post_type' => 'trip',
            'post_status' => 'publish',
        ];
        if ( !empty($show_count)) {
            $args['posts_per_page'] = $settings['show_count'];
        }
        if ( !empty($order) ) {
            $args['order'] = $settings['order'];
        }

        if ( !empty($orderby) ) {
            $args['orderby'] = $settings['orderby'];
        }
        if ( !empty($exclude) ) {
            $args['post__not_in'] = $settings['exclude'];
        }

        if ( !empty( ($tour_destinations && $tour_destinations != '' ) || ($tour_activities && $tour_activities != '' ) || ($tour_trip_types && $tour_trip_types != '' ) ) ) {
            $args['tax_query'] = [
                'relation' => 'OR',
                [
                    'taxonomy' => 'destination',
                    'field' => 'slug',
                    'terms' => $tour_destinations
                ],
                [
                    'taxonomy' => 'activities',
                    'field' => 'slug',
                    'terms' => $tour_activities
                ],
                [
                    'taxonomy' => 'trip_types',
                    'field' => 'slug',
                    'terms' => $tour_trip_types
                ]
            ];
        }

        $hotel_booking = new \WP_Query($args);

        //=========== Include Parts
        include "templating/tour-booking/tour-booking-{$settings['style']}.php";
    }
}
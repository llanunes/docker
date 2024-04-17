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
* Class Event
 * @package RaveCore\Widgets
 */
class Event extends Widget_Base {
    public function get_name() {
        return 'saasland_event';
    }

    public function get_title() {
        return __( 'Events (Saasland)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-calendar';
    }

    public function get_style_depends() {
        return [ 'event-schedule' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {


        //====================== Select Style =====================//
        $this->start_controls_section(
            'sec', [
                'label' => esc_html__( 'Features', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Style One', 'saasland-core' ),
                    '2' => __( 'Style Two', 'saasland-core' ),
                ],
                'default' => '1',
                'label_block' => true
            ]
        );

        $this->end_controls_section(); //End Style


        // ---------------------------------- Filter Options ------------------------ //
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'cats', [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => Saasland_Core_Helper()->get_category_array('events_cat'),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
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

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'saasland-core' ),
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
            'read_more_title', [
                'label' => __( 'Read More Button', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        /**
         * Style Post Title
         */
        $this->start_controls_section(
            'style_title_sec', [
                'label' => __( 'Style Post Title', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured_event h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .event_list_item .media-body h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typography',
                'selector' => '
                    {{WRAPPER}} .featured_event h2,
                    {{WRAPPER}} .event_list_item .media-body h3
                ',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $args = [
            'post_type'   => 'events',
            'post_status' => 'publish'
        ];

        if ( $show_count != '' ) {
            $args['posts_per_page']  = $show_count;
        }
        if ( $order != '' ) {
            $args['order']  = $order;
        }
        if ( $orderby != '' ) {
            $args['orderby']  = $orderby;
        }

        if ( is_array($cats) && !empty($cats) ) {
            $args['tax_query']  = [
                [
                    'taxonomy' => 'events_cat',
                    'field' => 'slug',
                    'terms' => $cats,
                ]
            ];
        }

        $events = new \WP_Query( $args );

        if ( !empty($settings['style'] == '1' ) ) {
            ?>
            <div class="education_event_area">
                <div class="row">
                    <?php
                    while ( $events->have_posts() ) : $events->the_post();
                        ?>
                        <div class="col-lg-12">
                            <div class="featured_event">
                                <?php the_post_thumbnail('rave_470x470'); ?>
                                <div class="event_date"><?php the_time('M d'); ?></div>
                                <a href="<?php the_permalink(); ?>" class="title">
                                    <?php the_title('<h2>', '</h2>') ?>
                                </a>
                                <a href="<?php the_permalink(); ?>" class="education_learn_btn">
                                    <?php echo esc_html($settings['read_more_title']) ?><i class="icon-arrow-double"></i>
                                </a>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        } elseif ( $settings['style'] == '2' ) {
            ?>
            <div class="education_event_area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="event_list_info">
                            <ul class="list-unstyled event_list">
                                <?php
                                while ( $events->have_posts() ) : $events->the_post();
                                    ?>
                                    <li>
                                        <div class="media d-flex event_list_item">
                                            <div class="event_date">
                                                <?php the_time('M'); ?><span><?php the_time('d'); ?></span>
                                            </div>
                                            <div class="media-body">
                                                <a href="<?php the_permalink(); ?>" class="title">
                                                    <?php the_title('<h3>', '</h3>') ?>
                                                </a>
                                                <a href="<?php the_permalink(); ?>" class="education_learn_btn">
                                                    <?php echo esc_html($settings['read_more_title']) ?><i class="icon-arrow-double"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
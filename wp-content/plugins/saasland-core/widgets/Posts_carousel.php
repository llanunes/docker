<?php
namespace SaaslandCore\Widgets;

// Exit if accessed directly
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Posts Carousel
 */
class Posts_carousel extends \Elementor\Widget_Base {
    public function get_name() {
        return 'saasland_posts_carousel';
    }

    public function get_title() {
        return __( 'Posts Carousel', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'posts_carousel_settings', [
                'label' => __( 'Posts Carousel', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title_limit_car', [
                'label' => esc_html__( 'Title Character Limit', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10
            ]
        );

        $this->add_control(
			'show_feature_image', [
				'label' => __( 'Show Feature Image?', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'saasland-core' ),
				'label_off' => __( 'Hide', 'saasland-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'cat_pos', [
				'label' => __( 'Category Position', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'top'  => __( 'Top', 'saasland-core' ),
					'bottom' => __( 'Bottom', 'saasland-core' ),
					'none' => __( 'Hide', 'saasland-core' ),
				],
			]
		);

        $this->end_controls_section(); //


        //======================== Carousel Settings =======================//
        $this->start_controls_section(
            'carousel', [
                'label' => __( 'Carousel Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'item_to_display', [
                'label' => __( 'Item To Display', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'show_nav', [
                'label' => __( 'Show Nav', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'nav_horizontal_pos', [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition'=> [
                        'show_nav' => ['yes']
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .owl-nav' => 'transform: translateX( {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_vertical_pos', [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'condition'=> [
                    'show_nav' => ['yes']
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 10000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .owl-nav' => 'transform: translateY( {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'show_nav_dot', [
                'label' => __( 'Show Nav Dot?', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); //End Carousel Settings


        // ---------------------------------- Filter Options ------------------------ //
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'post_type', [
                'label' => esc_html__( 'Post Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post' => 'Post',
                    'case_study' => 'Case Study',
                ],
                'default' => 'post'
            ]
        );

        $this->add_control(
            'blog_cats', [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT2,
                'options'   => Saasland_Core_Helper()->get_category_array(),
                'label_block' => true,
                'multiple'  => true,
                'condition' => [
                    'post_type' => 'post',
                ]
            ]
        );

        $this->add_control(
            'cs_cats', [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT2,
                'options'   => Saasland_Core_Helper()->get_category_array('case_study_cat'),
                'label_block' => true,
                'multiple'  => true,
                'condition' => [
                    'post_type' => 'case_study',
                ]
            ]
        );


        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
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
                'type' => \Elementor\Controls_Manager::SELECT,
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
            'exclude', [
                'label' => esc_html__( 'Exclude', 'saasland-core' ),
                'description' => esc_html__( 'Enter the Blog post IDs to hide/exclude. Input the multiple ID with comma separated', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(), [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->end_controls_section(); //End Filter Options


        //----------------------------- Style Blog Title --------------------------------//
        $this->start_controls_section(
            'post_carousel_style', [
                'label' => __( 'Style', 'saasland-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'post_carousel_title_color', [
                'label'     => esc_html__( 'Title Color', 'saasland-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .studies_item .text h4' => 'color: {{VALUE}}'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'post_carousel_title_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .studies_item .text h4',
            ]
        );

        $this->add_control(
            'post_carousel_cat_color', [
                'label'     => esc_html__( 'Category Color', 'saasland-core' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .studies_item .text p a' => 'color: {{VALUE}}'
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'post_carousel_cat_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .studies_item .text p a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(), [
                'name' => 'item_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .studies_item',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); //Array to variable conversion

        if ( !empty($settings['post_type']) ) {
            $args = [
                'post_type' => $settings['post_type'],
                'post_status' => 'publish',
            ];
        }

        if ( !empty($show_count) ) {
            $args['posts_per_page'] = $show_count;
        }

        if ( !empty($order) ) {
            $args['order'] = $order;
        }

        if ( !empty($orderby) ) {
            $args['orderby'] = $orderby;
        }

        if ( !empty($exclude ) ) {
            $args['post__not_in'] = $exclude;
        }

        if ( !empty($blog_cats && $blog_cats != '' ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy'  => 'category',
                    'field'     => 'slug',
                    'terms'     => $blog_cats,
                ]
            ];
        }

        if ( !empty($cs_cats && $cs_cats != '' ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy'  => 'case_study_cat',
                    'field'     => 'slug',
                    'terms'     => $cs_cats,
                ]
            ];
        }

        $posts = new \WP_Query( $args );

        ?>
        <div class="case_studies_slider owl-carousel">
            <?php
            while($posts->have_posts()) : $posts->the_post();
                $limit_char = isset( $settings['title_limit_car'] ) ? $settings['title_limit_car'] : '10';
                ?>
                <div class="studies_item">
                    <?php
                    if ( $settings['cat_pos'] == 'top' ) { ?>
                        <p><?php the_category( ' ' ) ?></p>
                        <?php
                    }
                    if ( has_post_thumbnail() && $settings['show_feature_image'] == 'yes' ) {
                        the_post_thumbnail($settings['thumbnail_size']);
                    }
                    ?>
                    <div class="text">
                        <a href="<?php the_permalink() ?>">
                            <h4 title="<?php the_title_attribute() ?>">
                                <?php saaslandCore_limit_latter( get_the_title(), $limit_char, '' ) ?>
                            </h4>
                        </a>
                        <?php if ( $settings['cat_pos'] == 'bottom' ) : ?>
                            <p><?php the_category( ', ' ) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php
    }
}
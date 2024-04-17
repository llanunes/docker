<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use WP_Query;
global $product;
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
class Appart_products extends Widget_Base {

    public function get_name() {
        return 'Saasland_appart_products';
    }

    public function get_title() {
        return __( 'Products (Grid View)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }
    public function get_script_depends() {
        return [ 'imagesloaded', 'isotope' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'select_sec',
            [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_01'  => __( 'Style One', 'saasland-core' ),
                    'style_02'  => __( 'Style Two', 'saasland-core' ),
                    'style_03'  => __( 'Style Three', 'saasland-core' ),
                ],
                'default' => 'style_01',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All',
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );
        $this->add_control(
            'cats', [
                'label' => esc_html__( 'Filter Category', 'saasland-core' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => saasland_cat_array('product_cat'),
                'label_block' => true,
                'multiple'  => true,
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );
        $this->add_control(
            'is_filter', [
                'label' => __( 'Filter Show', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show products', 'saasland-core' ),
                'description' => esc_html__( 'How much featured products do you want to show in this section?', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 6
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
            'excerpt', [
                'label' => esc_html__( 'Excerpt Limit', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 7
            ]
        );
        $this->end_controls_section();


        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => __( 'Button', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Learn More',
            ]
        );
        $this->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );
        $this->end_controls_section(); // End the Button

        $this->start_controls_section(
			'products_filter_style_contorl',
			[
				'label' => __( 'Filter style', 'rave-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_03'
                ]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'label' => __( 'Typography', 'rave-core' ),
				'selector' => '{{WRAPPER}} .product_filter_new .product_filter_item',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_filter_new .product_filter_item' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
            'filter_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'description' => __( 'Padding Filter', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .product_filter_new .product_filter_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .product_filter_new .product_filter_item',
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_filter_new .product_filter_item:hover,{{WRAPPER}} .product_filter_new .product_filter_item.active' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'rave_products_style_contorl',
			[
				'label' => __( 'Title', 'rave-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02', 'style_03']
                ]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'rave-core' ),
				'selector' => '{{WRAPPER}} .shop_product_item .content h3',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_product_item .content h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_product_item .content a:hover h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'rave_products_style_cat',
			[
				'label' => __( 'Category', 'rave-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => __( 'Typography', 'rave-core' ),
				'selector' => '{{WRAPPER}} .shop_product_item .content .shop_category a',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_product_item .content .shop_category a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'rave_products_style_pricing',
			[
				'label' => __( 'Pricing', 'rave-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_typography',
				'label' => __( 'Typography', 'rave-core' ),
				'selector' => '{{WRAPPER}} .shop_product_item .product-prices',
			]
		);

		$this->add_control(
			'pricing_color',
			[
				'label' => __( 'Color', 'rave-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_product_item .product-prices' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'saasland_products_style_box',
			[
				'label' => __( 'Contenc Box', 'saasland-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_03'
                ]
			]
		);

		$this->add_control(
            'content_box_color', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop_product_item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'description' => __( 'Padding around the featured image', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .shop_product_item .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_margin', [
                'label' => __( 'Margin', 'saasland-core' ),
                'description' => __( 'Mrgin', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .shop_product_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

        //------------------------------ Style button ------------------------------
        $this->start_controls_section(
            'style_button', [
                'label' => __( 'Style button', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color_btn', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending_product_area .new_banner_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_btn', [
                'label' => __( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending_product_area .new_banner_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'selector' => '{{WRAPPER}} .trending_product_area .new_banner_btn',
            ]
        );
        $this->end_controls_section();

        // -------------------------------------- Column Grid Section ---------------------------------//
        $this->start_controls_section(
            'product_column_sec', [
                'label' => __( 'Grid Column', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'grid_column', [
                'label' => __( 'Grid Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '4',

            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $query = new WP_Query( array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => !empty($settings['show_count']) ? $settings['show_count'] : -1,
            'order'               => !empty($settings['order']) ? $settings['order'] : 'DESC',
        ) );
        $product_cats = get_terms( array (
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
            'field'     => 'slug',
        ));



        $excerpt = !empty($settings['excerpt']) ? $settings['excerpt'] : 7;
        if($settings['style']=='style_01'){
            ?>
                <section class="trending_product_area post-type-archive-product woocommerce">
                    <div class="container custom_container">
                        <div class="row">
                            <?php
                            while($query->have_posts()) : $query->the_post(); ?>
                                <div <?php wc_product_class( 'col-lg-3 col-md-4 col-sm-6' ) ?>>
                                    <div class="tr_product_item">
                                        <?php the_post_thumbnail( 'saasland_350x360', array( 'class'=>'img-fluid')) ?>
                                        <div class="prduct_details">
                                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                                <h5> <?php echo wp_trim_words(get_the_title(), 3, '') ?> </h5>
                                            </a>
                                            <a href="<?php the_permalink() ?>" class="price">
                                                <?php woocommerce_template_loop_price(); ?>
                                            </a>

                                            <?php if ($excerpt > 0) : ?>
                                                <p> <?php echo wp_trim_words(get_the_excerpt(), $excerpt, '') ?> </p>
                                            <?php endif; ?>

                                            <?php woocommerce_template_single_rating() ?>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata(); ?>

                            <?php
                            if (!empty($settings['btn_label'])) :
                                $is_external = $settings['btn_url']['is_external'] == true ? 'target="_blank"' : ''; ?>
                                <div class="col-lg-12 text-center">
                                    <a href="<?php echo esc_url($settings['btn_url']['url']) ?>"
                                    class="new_banner_btn" <?php echo $is_external; ?>>
                                        <?php echo esc_html($settings['btn_label']) ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </section>
            <?php
        }
        elseif($settings['style'] == 'style_02'){
            ?>
                <div class="row">
                    <?php
                    while($query->have_posts()): $query->the_post();
                        global $product;
                        ?>
                        <div <?php wc_product_class('col-lg-3 col-md-4 col-sm-6')?>>
                            <div class="shop_product_item rave_product">
                                <div class="shop_product_img">
                                    <a href="<?php the_permalink(); ?>" class="img_hover">
                                        <?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID()), 'full' ); ?>
                                    </a>
                                    <div class="product_nav_action">
                                        <?php
                                            woocommerce_template_loop_add_to_cart();
                                        ?>
                                        <a class="saasland-quick-view" id="product_id_<?php echo esc_attr( $product->get_id() ) ?>" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>" data-bs-toggle="modal"
                                        data-bs-target=".product_compair_modal" aria-label="Quickview" href="#"
                                        target="_blank" rel="nofollow">
                                            <?php echo saasland_get_icon_svg('saasland-svg-icon', 'ti-eye', '16' ); ?>
                                        </a> 
                                        <?php echo shortcode_exists('ti_wishlists_addtowishlist') ? do_shortcode('[ti_wishlists_addtowishlist]') : '';?>  
                                    </div>
                                </div>
                                <div class="content">
                                    <?php
                                    echo ' <div class="shop_category">'. wc_get_product_category_list($query->get_id()) .'</div>';?>
                                    <?php
                                        the_title('<a href="'.get_the_permalink().'"><h3>', '</h3></a>');
                                    ?>
                                    <div class="product-prices">
                                    <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php
        }
        elseif($settings['style'] == 'style_03'){?>
                <?php if($settings['is_filter'] == 'yes'){?>
                    <div id="product_filter" class="product_filter_new mb_50">
                        <?php if ( !empty($settings['all_label'] ) ) : ?>
                            <div data-filter="*" class="product_filter_item active">
                                <?php echo esc_html($settings['all_label']); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                        if ( is_array($product_cats) ) {
                            foreach ( $product_cats as $product_cat ) {
                                ?>
                                <div data-filter=".item_filter_id_<?php echo esc_attr($product_cat->term_id ) ?>" class="product_filter_item">
                                    <?php echo $product_cat->name ?>
                                    
                                </div>                                        
                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php } ?> 
            
                <div class="row" id="product_gallery">
                    <?php
                    while($query->have_posts()): $query->the_post();
                        global $product;
                        $cats = get_the_terms( get_the_ID(), 'product_cat' );
                        $cat_slug = '';
                        if (is_array($cats)) {
                            foreach ( $cats as $cat ) {
                                $cat_slug .= ' item_filter_id_'. esc_attr( $cat->term_id );
                            }
                        }
                        ?>
                        <div class="col-lg-<?php echo esc_attr( $settings['grid_column'] ) ?> col-sm-6<?php echo esc_attr($cat_slug); ?> product_box_item">
                            <div class="shop_product_item rave_product">
                                <div class="shop_product_img">
                                    <a href="<?php the_permalink(); ?>" class="img_hover">
                                        <?php echo wp_get_attachment_image( get_post_thumbnail_id( get_the_ID()), 'full' ); ?>
                                    </a>
                                    <div class="product-prices">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                    <div class="product_nav_action">
                                        <?php
                                            woocommerce_template_loop_add_to_cart();
                                        ?>
                                        <a class="saasland-quick-view" id="product_id_<?php echo esc_attr( $product->get_id() ) ?>" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>" data-bs-toggle="modal"
                                        data-bs-target=".product_compair_modal" aria-label="Quickview" href="#"
                                        target="_blank" rel="nofollow">
                                            <?php echo saasland_get_icon_svg('saasland-svg-icon', 'ti-eye', '16' ); ?>
                                        </a> 
                                        <?php echo shortcode_exists('ti_wishlists_addtowishlist') ? do_shortcode('[ti_wishlists_addtowishlist]') : '';?>  
                                    </div>
                                </div>
                                <div class="content">
                                    <?php
                                    echo ' <div class="shop_category">'. wc_get_product_category_list($query->get_id()) .'</div>';?>
                                    <?php
                                        the_title('<a href="'.get_the_permalink().'"><h3>', '</h3></a>');
                                    ?>
                                </div>
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

}
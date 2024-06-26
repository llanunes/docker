<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * FAQ with Tabs
 */
class Faq_advance extends Widget_Base {

    public function get_name() {
        return 'saasland_faq_advance';
    }

    public function get_title() {
        return esc_html__( 'Advance FAQ with Tabs', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }


    protected function register_controls() {

        // ------------------------------  Category Title ------------------------------
        $this->start_controls_section(
            'filter_options_sec',
            [
                'label' => __( 'Filter Options', 'saasland-core' ),
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
            'faq_post_show', [
                'label' => esc_html__( 'Post per tab', 'saasland-core' ),
                'description' => esc_html__( '-1 means all post', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => -1,
            ]
        );


        $this->end_controls_section();
        
        
        // Category Settings -------------------------------------------------
        $this->start_controls_section(
            'category_items', [
                'label' => __( 'Category Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Categories', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
			'faq_catagory_select',
			[
				'label' => __( 'FAQ Category', 'saasland-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->getCategories(),
			]
		);

        $this->add_control(
            'cat_orderby', [
                'label' => esc_html__( 'Orderby', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'name' => __('Name', 'saasland-core'),
                    'slug' => __('Slug', 'saasland-core'),
                    'term_group' => __('Term Group', 'saasland-core'),
                    'term_id' => __('Term ID', 'saasland-core'),
                    'id' => __('ID', 'saasland-core'),
                    'description' => __('Description', 'saasland-core'),
                ],
                'default' => 'name'
            ]
        );
        $this->add_control(
            'cat_order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'description' => esc_html__( '‘ASC‘ – ascending order from lowest to highest values (1, 2, 3; a, b, c). ‘DESC‘ – descending order from highest to lowest values (3, 2, 1; c, b, a).', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );


        $this->end_controls_section();
        

        // ------------------------------  Category Title ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Tabs Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Quick Navigation',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .faq_tab h4',
            ]
        );

        $this->add_control(
            'faq_cat_title_color', [
                'label'     => esc_html__( 'Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .faq_tab h4' => 'color: {{VALUE}};',
                ),
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab
         * @ Tab Items
         */
        $this->start_controls_section(
            'style_tab_items',
            [
                'label' => __( 'Tab Items', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'doc', [
                'label' => '',
                'type'  => Controls_Manager::RAW_HTML,
                'raw'   => '<a href="https://is.gd/DRicLW" target="_blank">How to add FAQs </a>'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'tab_items_typo',
                'selector' => '{{WRAPPER}} .faq_tab .nav-item .nav-link',
            ]
        );

        $this->add_control(
            'tab_items_color', [
                'label'     => esc_html__( 'Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .faq_tab .nav-item .nav-link' => 'color: {{VALUE}};',
                ),
            ]
        );

        $this->end_controls_section();


        /**
         * Style Tab
         * @ FAQ Item
         */
        $this->start_controls_section(
            'style_faq_item',
            [
                'label' => __( 'FAQ Items', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'faq_item_typo',
                'selector' => '{{WRAPPER}} .faq_content .tab-pane .card .card-header .btn',
            ]
        );

        $this->add_control(
            'faq_item_color', [
                'label'     => esc_html__( 'Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .faq_content .tab-pane .card .card-header .btn' => 'color: {{VALUE}} !important;',
                ),
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab
         * @ FAQ Content
         */
        $this->start_controls_section(
            'style_faq_content',
            [
                'label' => __( 'FAQ Contents', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'faq_content_typo',
                'selector' => '{{WRAPPER}} .faq_content .tab-pane .card .card-body',
            ]
        );

        $this->add_control(
            'faq_content_color', [
                'label'     => esc_html__( 'Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .faq_content .tab-pane .card .card-body' => 'color: {{VALUE}};',
                ),
            ]
        );

        $this->end_controls_section();


        /**
         * Style Section
         */
        $this->start_controls_section(
            'style_sec',
            [
                'label' => __( 'Style Section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'faq_cat_bg', [
                'label'     => esc_html__( 'Tabs Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .faq_tab' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label'     => esc_html__( 'Section Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} section.faq_area' => 'background-color: {{VALUE}};',
                ),
            ]
        );

        $this->add_control(
            'accent_color', [
                'label'     => esc_html__( 'Accent Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .faq_tab .nav-item .nav-link:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .faq_tab .nav-item .nav-link.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .faq_content .tab-pane .card .card-header .btn' => 'color: {{VALUE}};',
                ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $cats = get_terms(array(
            'taxonomy' => 'faq_cat',
            'hide_empty' => false,
            'orderby'   => !empty($settings['cat_orderby']) ? $settings['cat_orderby'] : 'name',
            'order'     => !empty($settings['cat_order']) ? $settings['cat_order'] : 'DESC',
            'include'   => !empty($settings['faq_catagory_select']) ? $settings['faq_catagory_select'] : '',
            'number'    => !empty( $settings['show_count'] ) ? $settings['show_count'] : 4,
        ));

        ?>

        <section class="faq_area bg_color sec_pad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 pr_50">
                        <div class="faq_tab">
                            <?php if ( !empty($settings['title']) ) : ?>
                                <h4 class="f_p t_color3 f_600 f_size_22 mb_40"><?php echo esc_html($settings['title']) ?></h4>
                            <?php endif; ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php
                                foreach ( $cats as $index => $cat ) :
                                    $tab_count = $index + 1;
                                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_li', '', $index );
                                    $active = $tab_count == 1 ? 'active' : '';
                                    $this->add_render_attribute( $tab_title_setting_key, [
                                        'class' => [ 'nav-link', $active ],
                                        'id' => $cat->slug.'-tab-'.$cat->term_id,
                                        'data-bs-toggle' => 'tab',
                                        'role' => 'tab',
                                        'aria-controls' => $cat->slug,
                                        'href' => '#'.$cat->slug,
                                    ]);
                                    ?>
                                    <li class="nav-item">
                                        <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                            <?php echo $cat->name; ?>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="tab-content faq_content" id="myTabContent">
                        <?php
                        foreach ( $cats as $index => $cat ) :
                            $tab_count = $index + 1;
                            $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', '', $index );
                            $active = $tab_count == 1 ? 'show active' : '';
                            $this->add_render_attribute( $tab_content_setting_key, [
                                'class' => [ 'tab-pane fade', $active ],
                                'id' => $cat->slug,
                                'aria-labelledby' => $cat->slug.'-tab',
                                'role' => 'tabpanel',
                            ]);
                            ?>
                            <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                                    <h3 class="f_p f_size_22 f_500 t_color3 mb_20">
                                        <?php echo esc_html( $cat->name ) ?>
                                    </h3>
                                <div id="accordion-<?php echo esc_attr($tab_count); ?>">
                                    <?php
                                    $faqs = new WP_Query( array(
                                        'post_type'      => 'faq',
                                        'posts_per_page' => !empty( $settings['faq_post_show'] ) ? $settings['faq_post_show'] : -1,
                                        'order' => $settings['order'],
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'faq_cat',
                                                'field'    => 'slug',
                                                'terms'    => $cat->slug,
                                            ),
                                        ),
                                    ));
                                    $faq_i = 0;
                                    while ($faqs->have_posts()) : $faqs->the_post();

                                        $tab_btn_setting_key = $this->get_repeater_setting_key( 'faq_btn', '', $cat->slug.$faq_i );
                                        $this->add_render_attribute( $tab_btn_setting_key, [
                                            'class' => [ $faq_i == 0 ? 'btn btn-link' : 'btn btn-link collapsed' ],
                                            'data-bs-toggle' => 'collapse',
                                            'data-bs-target' => '#'.$cat->slug.'-collapse-'.$faq_i,
                                            'aria-expanded' => $faq_i == 0 ? 'true' : 'false',
                                            'aria-controls' => esc_attr($cat->slug).'-collapse-'.$faq_i,
                                        ]);

                                        $tab_body_setting_key = $this->get_repeater_setting_key( 'faq_body', '', $cat->slug.$faq_i );
                                        $this->add_render_attribute( $tab_body_setting_key, [
                                            'id' => $cat->slug.'-collapse-'.$faq_i,
                                            'class' => [ $faq_i == 0 ? 'collapse show' : 'collapse' ],
                                            'aria-labelledby' => $cat->slug . $faq_i,
                                            'data-parent' => "#accordion-$tab_count"
                                        ]);
                                        ?>
                                        <div class="card">
                                            <div class="card-header" id="<?php echo esc_attr($cat->slug) . $faq_i; ?>">
                                                <h5 class="mb-0">
                                                    <button <?php echo $this->get_render_attribute_string( $tab_btn_setting_key ); ?>>
                                                        <?php the_title(); ?>
                                                        <i class="ti-plus"></i>
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div <?php echo $this->get_render_attribute_string( $tab_body_setting_key ); ?>>
                                                <div class="card-body">
                                                    <?php the_content() ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        ++$faq_i;
                                        endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    public function getCategories(){
        $terms = get_terms( array(
            'taxonomy'    => 'faq_cat',
            'hide_empty'  => false,
            'posts_per_page' => -1,
        ) );


        $cat_list = [];
        if(is_array($terms) && '' != $terms) :
        foreach($terms as $post) {

            $cat_list[$post->term_id]  = [$post->name];
        }
       endif;
        return $cat_list;
    }

}
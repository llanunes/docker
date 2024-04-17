<?php
namespace SaaslandCore\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Tabs
 * @package SaaslandCore\Widgets
 */
class Tabs extends Widget_Base {

    public function get_name() {
        return 'saasland_tabs';
    }

    public function get_title() {
        return __( 'Saasland Tabs', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Tab Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => __( 'Select Tab Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Style 01',
                    '2' => 'Style 02',
                ],
                'default' => '1',
            ]
        );
        $this->end_controls_section();


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'saasland-core' ),
                'placeholder' => __( 'Tab Title', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_custom_id',
            [
                'label' => __( 'Custom ID', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'saasland-tab-content', 'saasland-core' ),
                'placeholder' => __( 'saasland-tab-content', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h5',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tab_subtitle',
            [
                'label' => __( 'Tab Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'default' => __( 'Tab Content', 'saasland-core' ),
                'placeholder' => __( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __( 'Tabs Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // ---------------------
        $this->start_controls_section(
            'vertical_tabs',
            [
                'label' => __( 'Tab Items', 'saasland-core' ),
                'condition' => [
                    'style' => '2'
                ]
            ]
        );
        $vtabs = new Repeater();
        $vtabs->add_control(
            'vtab_cat',
            [
                'label' => __( 'Tab Item Category', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Saasland',
                'label_block' => true,
            ]
        );
        $vtabs->add_control(
            'vtab_feature_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_themify_icons(),
                'default' => 'ti-user'
            ]
        );
        $vtabs->add_control(
            'vtab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'saasland-core' ),
                'placeholder' => __( 'Tab Title', 'saasland-core' ),
                'label_block' => true,
            ]
        );
        $vtabs->add_control(
            'vtab_content',
            [
                'label' => __( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'vtabs',
            [
                'label' => __( 'Tabs Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $vtabs->get_controls(),
                'title_field' => '{{vtab_cat}} - {{vtab_title}}',
            ]
        );
        $this->end_controls_section();


    //--------------------- Section Color-----------------------------------//

    $this->start_controls_section(
        'style_tabs_sec',
        [
            'label' => __( 'Tabs Style', 'saasland-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'style' => '1'
            ]
        ]
    );

    $this->start_controls_tabs(
    'style_tabs'
    );

    /// Normal  Style
    $this->start_controls_tab(
        'style_normal',
        [
            'label' => __( 'Normal', 'saasland-core' ),
        ]
    );

    $this->add_control(
        'normal_title_font_color', [
            'label' => __( 'Title Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.normal_color .title_color' => 'color: {{VALUE}}',
            )
        ]
    );

    $this->add_control(
        'normal_subtitle_font_color', [
            'label' => __( 'Subtitle Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.normal_color p' => 'color: {{VALUE}}',
            )
        ]
    );

    $this->add_control(
        'normal_bg_color', [
            'label' => __( 'Background Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link' => 'background: {{VALUE}};',
            )
        ]
    );
    $this->add_responsive_control(
        'border_radius', [
            'label' => esc_html__( 'Radius', 'saasland-core' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .design_tab .nav-item .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    /// ----------------------------- Active Style--------------------------//
    $this->start_controls_tab(
        'style_active_btn',
        [
            'label' => __( 'Active', 'saasland-core' ),
        ]
    );

    $this->add_control(
        'active_title_font_color', [
            'label' => __( 'Title Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.active .title_color' => 'color: {{VALUE}};',
            )
        ]
    );
    
    $this->add_control(
        'active_subtitle_font_color', [
            'label' => __( 'Subtitle Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.active p' => 'color: {{VALUE}};',
            )
        ]
    );

    $this->add_control(
        'active_bg_color', [
            'label' => __( 'Background Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.active' => 'background: {{VALUE}};',
            )
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    //------------------------------------ Tab Border Radius -------------------------------------------//
    $this->start_controls_section(
        'tab_style_2', [
            'label' => __( 'Tab Style', 'saasland-core' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'style' => '2'
            ]
        ]
    );
    $this->start_controls_tabs(
        'tabs_style_2'
    );
    $this->start_controls_tab(
        'tab2_style_normal',
        [
            'label' => __( 'Normal', 'saasland-core' ),
        ]
    );
    $this->add_control(
        'tab2_title_normal', [
            'label' => __( 'Title & Border Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .software_service_tab .nav-item .nav-link' => 'color: {{VALUE}}; border-color: {{VALUE}}',
            )
        ]
    );

    $this->end_controls_tab();

    /// ----------------------------- Active Style--------------------------//
    $this->start_controls_tab(
        'tab2_style_active',
        [
            'label' => __( 'Active', 'saasland-core' ),
        ]
    );
    $this->add_control(
        'tab2_title_active', [
            'label' => __( 'Title & Border Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .software_service_tab .nav-item .nav-link.active' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                '{{WRAPPER}} .software_service_tab .nav-item .nav-link:before' => 'border-color: transparent transparent transparent {{VALUE}}',
            )
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    $this->start_controls_section(
        'tab_content_style_2', [
            'label' => __( 'Tab Content Style', 'saasland-core' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'style' => '2'
            ]
        ]
    );
    $this->add_control(
        'tab2_icon_color', [
            'label' => __( 'Icon Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .software_service_tab_content .software_service_item i' => 'color: {{VALUE}}',
            )
        ]
    );
    $this->add_responsive_control(
        'tab2_icon_size',
        [
            'label' => __( 'Icon Size', 'saasland-core' ),
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
                'size' => 30,
            ],
            'selectors' => [
                '{{WRAPPER}} .software_service_tab_content .software_service_item i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after'
        ]
    );
    $this->add_control(
        'tab2_title', [
            'label' => __( 'Title Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .software_service_tab_content .software_service_item h5' => 'color: {{VALUE}}',
            )
        ]
    );
    $this->add_group_control(
        Group_Control_Typography::get_type(), [
            'name' => 'tab2_title_typo',
            'selector' => '{{WRAPPER}} .software_service_tab_content .software_service_item h5',
        ]
    );

    $this->add_control(
        'tab2_desc', [
            'label' => __( 'Description Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .software_service_tab_content .software_service_item p' => 'color: {{VALUE}}',
            ),
            'separator' => 'before'
        ]
    );
    $this->add_group_control(
        Group_Control_Typography::get_type(), [
            'name' => 'tab2_desc_typo',
            'selector' => '{{WRAPPER}} .software_service_tab_content .software_service_item p',
        ]
    );
    $this->end_controls_section();

    $this->start_controls_section(
        'tab_style_2_bg', [
            'label' => __( 'Tab Style Background', 'saasland-core' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'style' => '2'
            ]
        ]
    );
    $this->add_responsive_control(
        'tab2_sec_margin',
        [
            'label' => __( 'Margin', 'saasland-core' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .software_service_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'tab2_sec_padding',
        [
            'label' => __( 'Padding', 'saasland-core' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .software_service_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'tab2_background',
            'label' => __( 'Background', 'saasland-core' ),
            'types' => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .software_service_area',
        ]
    );
    $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        
        if( $settings['style'] == '1' ){ ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-center">
                        <ul class="nav nav-tabs design_tab" role="tablist">
                            <?php
                            $i = 0.2;
                            foreach ( $tabs as $index => $item ) :
                                $tab_count = $index + 1;
                                $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                                $active = $tab_count == 1 ? 'active' : '';
                                $title_tag = !empty($item['title_html_tag']) ? $item['title_html_tag'] : 'h5';
                                $id_link = isset( $item['tab_custom_id'] ) ? $item['tab_custom_id'] : 'saasland-tab-content';
                                $this->add_render_attribute( $tab_title_setting_key, [
                                    'class' => [ 'nav-link normal_color', $active ],
                                    'id' => 'saasland'.'-tab-'.$id_int . $tab_count,
                                    'data-bs-toggle' => 'tab',
                                    'role' => 'tab',
                                    'href' => '#' . $id_link . '-' .$id_int . $tab_count,
                                    'aria-controls' => 'saasland-tab-content-' . $id_int . $tab_count,
                                ]);
                            
                                ?>
                                <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                    <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                        <<?php echo $title_tag; ?> class="title_color"><?php echo wp_kses_post($item['tab_title']); ?></<?php echo $title_tag; ?>>
                                        <p><?php echo wp_kses_post(nl2br($item['tab_subtitle'])); ?></p>
                                    </a>
                                </li>
                                <?php
                            $i = $i + 0.2;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content">
                            <?php
                            foreach ( $tabs as $index => $item ) :
                                $tab_count = $index + 1;
                                $active = $tab_count == 1 ? 'show active' : '';
                                $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                                $this->add_render_attribute( $tab_content_setting_key, [
                                    'class' => [ 'tab-pane', 'fade', $active ],
                                    'aria-labelledby' => 'saasland'.'-tab-'.$id_int . $tab_count,
                                    'role' => 'tabpanel',
                                    'id' => 'saasland-tab-content-' . $id_int . $tab_count,
                                ]);
                                ?>
                                <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                                    <div class="tab_img">
                                        <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        elseif( $settings['style'] == '2' ){
            $vertical_tabs = $settings['vtabs'];
            $cats       = array_column( $vertical_tabs, 'vtab_cat' );
            $getCats    = array_unique( $cats );
            $tab_data   = return_tab_data2( $getCats, $vertical_tabs );
            ?>
            <section class="software_service_area sec_pad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs software_service_tab" id="myTab" role="tablist">
                                <?php
                                if( is_array( $vertical_tabs ) && count( $vertical_tabs ) > 0 ){
                                    $tabs   = '';
                                    $i      = 0;
                                    foreach ( $getCats as $cat ){
                                        $catForFilter = sanitize_title_with_dashes( $cat );
                                        $i++;
                                        $active = $i==1 ? 'active' : '';
                                        $tabs .= '<li class="nav-item"><a class="nav-item nav-link '. esc_attr( $active ) .'" data-bs-toggle="tab" href="#'.esc_attr( $catForFilter ).'">'. esc_html( $cat ) .'</a></li>';
                                    }
                                    echo $tabs;
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="tab-content software_service_tab_content">
                                <?php
                                if( !empty( $tab_data ) ){
                                    $i = 0;
                                    foreach ($tab_data as $key => $val) {
                                        $tagforfilter = sanitize_title_with_dashes($key);
                                        $i++;
                                        $active = $i == 1 ? 'show active' : ''; ?>
                                        <div class="tab-pane fade <?php echo esc_attr( $active ) ?>" id="<?php echo esc_attr( $tagforfilter ) ?>" role="tabpanel" aria-labelledby="de-tab">
                                            <div class="row">
                                                <?php
                                                $even_number = 0;
                                                foreach ($val as $data) {
                                                    $even_number++;
                                                    $offset_class = '';
                                                    if( $even_number % 2 == 0 ){
                                                        $offset_class = 'offset-lg-2';
                                                    }
                                                    ?>
                                                    <div class="col-lg-5 col-md-6 <?php echo esc_attr( $offset_class ) ?>">
                                                        <div class="software_service_item mb_70 wow fadeInUp" data-wow-delay="0.2s">
                                                            <?php
                                                            if( !empty( $data['vtab_feature_icon'] ) ){
                                                                echo '<i class="'. esc_attr( $data['vtab_feature_icon'] ) .'"></i>';
                                                            }
                                                            if( !empty( $data['vtab_title'] ) ){
                                                                echo '<h5 class="mt_30 mb_15">'. esc_html( $data['vtab_title'] ) .'</h5>';
                                                            }
                                                            if( !empty( $data['vtab_content'] ) ) {
                                                                echo wp_kses_post( wpautop( $data['vtab_content'] ) );
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

    }
}
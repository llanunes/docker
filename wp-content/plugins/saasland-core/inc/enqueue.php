<?php

class Saasland_Enqueue_Scripts {

    private static $_instance = null;
    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
    }

    public function on_plugins_loaded() {
        add_action( 'init', [$this, 'register_scripts'] );
    }

    public function register_scripts () {

        // Register Widget Style's
        add_action( 'elementor/frontend/before_enqueue_styles', [ $this, 'elementor_register_widget_styles' ] );
        add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'elementor_register_widget_styles' ] );

        // Register Widget Script's
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'elementor_register_widget_scripts' ] );
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'elementor_register_widget_scripts' ] );

        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_elementor_scripts' ]);
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_elementor_scripts' ]);

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

    }

    /**
     *
     */
    function elementor_register_widget_styles() {
        $opt = get_option( 'saasland_opt' );

        wp_register_style( 'slick', SAASLAND_CORE_DIR_VEND . '/slick/slick.min.css');
        wp_register_style( 'slick-theme', SAASLAND_CORE_DIR_VEND . '/slick/slick-theme.css');
        wp_register_style( 'owl-carousel', SAASLAND_CORE_DIR_VEND .  '/owl-carousel/css/owl.carousel.min.css' );
        wp_register_style( 'splitting', SAASLAND_CORE_DIR_VEND . '/splitting/splitting.css' );
        wp_register_style( 'appart-style', SAASLAND_CORE_DIR_CSS . '/appart-style.css' );
        wp_register_style( 'appart-responsive', SAASLAND_CORE_DIR_CSS . '/appart-responsive.min.css' );
        wp_register_style( 'saasland-demo', SAASLAND_CORE_DIR_CSS . '/saasland-demo.css', array('slick', 'slick-theme') );

        // Section Dependency CSS
        wp_register_style( 'hero-chat', SAASLAND_CORE_DIR_CSS . '/widgets/hero-chat.css' );
        wp_register_style( 'hero-event', SAASLAND_CORE_DIR_CSS . '/widgets/hero-event.css' );
        wp_register_style( 'saasland-hero', SAASLAND_CORE_DIR_CSS . '/widgets/hero.css' );
        wp_register_style( 'price-table-event', SAASLAND_CORE_DIR_CSS . '/widgets/price-table-event.css' );
        wp_register_style( 'parallax-image', SAASLAND_CORE_DIR_CSS . '/widgets/parallax-image.css' );
        wp_register_style( 'curve-counter-event', SAASLAND_CORE_DIR_CSS . '/widgets/curve-counter-event.css' );
        wp_register_style( 'date-countdown', SAASLAND_CORE_DIR_CSS . '/widgets/date-countdown.css' );
        wp_register_style( 'event-schedule', SAASLAND_CORE_DIR_CSS . '/widgets/event-schedule.css' );
        wp_register_style( 'team', SAASLAND_CORE_DIR_CSS . '/widgets/team.css' );
        wp_register_style( 'tilt-image2', SAASLAND_CORE_DIR_CSS . '/widgets/tilt-images2.css' );
        wp_register_style( 'chat-features', SAASLAND_CORE_DIR_CSS . '/widgets/chat-features.css' );
        wp_register_style( 'saasland-testimonials', SAASLAND_CORE_DIR_CSS . '/widgets/testimonials.css' );
        wp_register_style( 'saasland-core-portfolio', SAASLAND_CORE_DIR_CSS . '/widgets/portfolio.css' );
        wp_register_style( 'saasland-images', SAASLAND_CORE_DIR_CSS . '/widgets/images.css' );
        wp_register_style( 'saasland-features', SAASLAND_CORE_DIR_CSS . '/widgets/features.css' );
        wp_register_style( 'saasland-tabs', SAASLAND_CORE_DIR_CSS . '/widgets/tabs.css' );
        wp_register_style( 'saas-button', SAASLAND_CORE_DIR_CSS . '/widgets/button.css' );
        wp_register_style( 'saasland-blog', SAASLAND_CORE_DIR_CSS . '/widgets/blog-style.css' );

        wp_enqueue_style( 'simple-line-icon', SAASLAND_CORE_DIR_VEND . '/simple-line-icon/simple-line-icons.min.css' );
        wp_enqueue_style( 'themify-icons', SAASLAND_CORE_DIR_VEND . '/themify-icon/themify-icons.css');
        wp_enqueue_style( 'saasland-flaticons', SAASLAND_CORE_DIR_VEND . '/flaticon/flaticon.css');
        wp_enqueue_style( 'saasland-icomoon', SAASLAND_CORE_DIR_VEND . '/icomoon/style.css' );
	    wp_enqueue_style( 'elegant-icon', SAASLAND_CORE_DIR_VEND . '/elagent/style.min.css' );

        if ( is_rtl() ) {
            wp_enqueue_style( 'appart-rtl', SAASLAND_CORE_DIR_CSS . '/appart-rtl.min.css', array('appart-style') );
        }

        /**
         * Enqueue Style's
         */
        if ( defined( 'ELEMENTOR_VERSION') ) {
            if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                wp_enqueue_style( 'owl-carousel' );
                wp_enqueue_style( 'appart-style' );
                wp_enqueue_style( 'appart-responsive' );
                wp_enqueue_style( 'saasland-digital-agency' );
            }
        }

        //Direct Enqueue form theme css merge
        wp_register_style( 'saasland-animations',  SAASLAND_CORE_DIR_CSS . '/saasland-animations.css');
        wp_register_style( 'saasland-remove-animation',  SAASLAND_CORE_DIR_CSS . '/remove-animation.css');
        wp_register_style( 'saasland-animate', SAASLAND_CORE_DIR_VEND . '/merge/animation/animate.css' );
        wp_enqueue_style( 'magnify-pop', SAASLAND_CORE_DIR_VEND . '/merge/magnify-pop/magnific-popup.min.css' );
        wp_enqueue_style( 'magnifier', SAASLAND_CORE_DIR_VEND . '/merge/magnify-pop/magnifier.min.css' );

        // Agency Colorful page
        if ( is_page_template( 'page-agency-colorful.php' ) ) {
            wp_enqueue_style('slick');
            wp_enqueue_style( 'pagepiling', SAASLAND_CORE_DIR_VEND . '/pagepiling/jquery.pagepiling.css' );
            wp_enqueue_style( 'saasland-colorful-agency', SAASLAND_CORE_DIR_VEND . '/pagepiling/colorful-agency.css' );
            wp_enqueue_style('slick-theme');
            wp_enqueue_script('slick');
            wp_enqueue_script( 'pagepiling', SAASLAND_CORE_DIR_VEND . '/pagepiling/jquery.pagepiling.js', ['jquery'], '1.5.4', true );
        }

        //End Direct Enqueue form theme css merge


        /**
         * Animation Library
         */
        $is_animation = isset($opt['is_anim']) ? $opt['is_anim'] : '1';

        if ( $is_animation == '1' ) {
            wp_enqueue_style( 'saasland-animate' );
            wp_enqueue_style( 'saasland-animations' );
        } else {
            wp_enqueue_style('saasland-remove-animation');
        }

    }


    /**
     * Register Widget Scripts
     *
     * Register custom scripts required to run Saasland Core.
     *
     * @access public
     */
    function elementor_register_widget_scripts() {
        wp_register_script( 'slick', SAASLAND_CORE_DIR_VEND . '/slick/slick.min.js', ['jquery'], '1.9.0', true );
        wp_register_script( 'owl-carousel', SAASLAND_CORE_DIR_VEND . '/owl-carousel/owl.carousel.min.js', ['jquery'], '2.3.4', true );
        wp_register_script( 'waypoints', SAASLAND_CORE_DIR_VEND . '/counterup/jquery.waypoints.min.js', ['jquery'], '4.0.1', true );
        wp_register_script( 'counterup', SAASLAND_CORE_DIR_VEND . '/counterup/jquery.counterup.min.js', ['jquery'], '1.0', true );
        wp_register_script( 'appear', SAASLAND_CORE_DIR_VEND . '/counterup/appear.js', ['jquery'], '1.0', true );
        wp_register_script( 'parallaxie', SAASLAND_CORE_DIR_VEND . '/parallax/parallaxie.js', ['jquery'], '0.5', true );
        wp_register_script( 'parallax-scroll', SAASLAND_CORE_DIR_VEND . '/parallax/parallax-scroll.js', ['jquery'], '1.0', true );
        wp_register_script( 'parallax', SAASLAND_CORE_DIR_VEND . '/parallax/parallax.js', ['jquery'], '1.0', true );
        wp_register_script( 'stellar', SAASLAND_CORE_DIR_VEND . '/stellar/jquery.stellar.js', ['jquery'], '1.0', true );
        wp_register_script( 'circle-progress', SAASLAND_CORE_DIR_VEND . '/circle-progress/circle-progress.js', ['jquery'], '1.1.3', true );
        wp_register_script( 'isotope', SAASLAND_CORE_DIR_VEND . '/isotope/isotope-min.js', ['jquery'], '3.0.1', true );
        wp_register_script( 'splitting', SAASLAND_CORE_DIR_VEND . '/splitting/splitting.min.js', ['jquery'], '3.0.1', true );

        // Event Date Count Down Js
        wp_register_script( 'knob', SAASLAND_CORE_DIR_VEND . '/red-countdown/knob.js', ['jquery'], '1.2.11', true );
        wp_register_script( 'throttle', SAASLAND_CORE_DIR_VEND . '/red-countdown/throttle.js', ['jquery'], '1.1', true );
        wp_register_script( 'moment', SAASLAND_CORE_DIR_VEND . '/red-countdown/moment.js', ['jquery'], '2.9.0', true );
        wp_register_script( 'redcountdown', SAASLAND_CORE_DIR_VEND . '/red-countdown/redcountdown.js', ['jquery'], '1.0', true );
        wp_register_script( 'red-countdown-settings', SAASLAND_CORE_DIR_VEND . '/red-countdown/red-countdown-settings.js', ['jquery'], '1.0', true );

        wp_register_script( 'typed', SAASLAND_CORE_DIR_JS . '/typed.min.js', ['jquery'], '1.0.0', true );
        wp_register_script( 'ajax-chimp', SAASLAND_CORE_DIR_JS . '/ajax-chimp.js', ['jquery'], '1.0', true );


        //Direct Enqueue form theme js merge
        wp_enqueue_script( 'magnify-pop', SAASLAND_CORE_DIR_VEND . '/merge/magnify-pop/jquery.magnific-popup.min.js', ['jquery'], '1.1.0', true );
        wp_enqueue_script( 'magnifier', SAASLAND_CORE_DIR_VEND . '/merge/magnify-pop/magnifier.js', ['jquery'], '1.0', true );
        // End Direct Enqueue form theme js merge

        wp_enqueue_script( 'wow', SAASLAND_CORE_DIR_VEND . '/wow/wow.min.js', ['jquery'], '1.1.3', true );

        if ( is_rtl() ) {
            wp_enqueue_script( 'saasland-main-rtl', SAASLAND_CORE_DIR_JS . '/main-rtl.js', ['jquery'], '1.0', true);
        } else {
            wp_enqueue_script( 'saasland-main', SAASLAND_CORE_DIR_JS . '/main.js', ['jquery'], '1.0', true);
        }
    }

    /**
     * Register Widget Styles
     *
     * Register custom styles required to run Saasland Core.
     *
     * @access public
     */

    function enqueue_elementor_scripts() {
        if ( is_rtl() ) {
            wp_enqueue_script( 'saasland-elementor-rtl', SAASLAND_CORE_DIR_JS . '/saasland-elementor-rtl.js', ['jquery', 'elementor-frontend'], '1.0', true);
        } else {
            wp_enqueue_script( 'saasland-elementor', SAASLAND_CORE_DIR_JS . '/saasland-elementor.js', ['jquery', 'elementor-frontend'], '1.0', true);
        }
    }

    public function enqueue_scripts() {

        //Check Thumbnails Mega Menu
        $mega_menus = new WP_Query(array(
            'post_type' => 'megamenu',
            'posts_per_page' => -1,
        ));

        $mega_menu_count = $mega_menus->post_count;
        if ( $mega_menu_count > 0  ) {
            wp_enqueue_style( 'mCustomScrollbar', SAASLAND_CORE_DIR_VEND . '/scroll/jquery.mCustomScrollbar.min.css' );
            wp_enqueue_script( 'mCustomScrollbar', SAASLAND_CORE_DIR_VEND . '/scroll/jquery.mCustomScrollbar.concat.min.js', ['jquery'], '3.1.13', true );
        }

        /**
         * Dark mode support css & js
         */
        if ( did_action('droitDark/loaded') ) {
            wp_enqueue_style( 'saasland-dark-support',  SAASLAND_CORE_DIR_VEND . '/dark-mode/saasland-dark-support.css' );
            wp_enqueue_script( 'saasland-dark-support', SAASLAND_CORE_DIR_VEND . '/dark-mode/saasland-dark-support.js', ['jquery'], '1.0', true );
        }

        // Split Screen Page
        if ( is_page_template( 'page-split.php' ) ) {
            wp_enqueue_style( 'multiscroll',  SAASLAND_CORE_DIR_VEND . '/multiscroll/jquery.multiscroll.css' );
            wp_enqueue_style( 'saasland-split-page',  SAASLAND_CORE_DIR_VEND . '/multiscroll/split-page.css' );
            wp_enqueue_script( 'jquery-easings', SAASLAND_CORE_DIR_VEND . '/multiscroll/jquery.easings.min.js', ['jquery'], '1.9.2', true);
            wp_enqueue_script( 'multiscroll', SAASLAND_CORE_DIR_VEND . '/multiscroll/multiscroll.responsiveExpand.min.js', ['jquery'], '0.0.4', true);
            wp_enqueue_script( 'multiscroll-extensions', SAASLAND_CORE_DIR_VEND . '/multiscroll/jquery.multiscroll.extensions.min.js', ['jquery'], '0.1.5', true);
            wp_enqueue_script( 'saasland-multi', SAASLAND_CORE_DIR_VEND . '/multiscroll/multi.js', ['jquery'], '1.0', true);
        }

        wp_enqueue_script( 'lord-icon', 'https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"', array(), '2.1.0', true );
	    //wp_enqueue_style( 'saasland-fontawesome', SAASLAND_CORE_DIR_VEND . '/fontawesome/css/all.min.css' );
        wp_enqueue_style( 'saasland-hero', SAASLAND_CORE_DIR_CSS . '/widgets/hero.css' );
		wp_enqueue_style('saasland-override-elementor', SAASLAND_CORE_DIR_CSS . '/elementor-override.css' );
        wp_enqueue_style('saasland-custom', SAASLAND_CORE_DIR_CSS . '/custom.css' );
        wp_enqueue_style('saasland-customizer', SAASLAND_CORE_DIR_CSS . '/customizer.css' );

        //New from theme
        wp_enqueue_style('saasland-core-main', SAASLAND_CORE_DIR_CSS . '/main.css', ['bootstrap'] );
        wp_enqueue_style('saasland-core-responsive', SAASLAND_CORE_DIR_CSS . '/responsive.css' );

    }

}
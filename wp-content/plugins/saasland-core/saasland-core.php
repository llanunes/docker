<?php
/**
 * Plugin Name: Saasland Core
 * Plugin URI: https://themeforest.net/user/droitthemes/portfolio
 * Description: This plugin adds the core features to the Saasland WordPress theme. You must have to install this plugin to get all the features included with the Saasland theme.
 * Version: 4.1.11
 * Author: DroitThemes
 * Requires PHP: 7.0
 * Author URI: https://themeforest.net/user/droitthemes/portfolio
 * Text domain: saasland-core
 */

if ( !defined( 'ABSPATH') )
    die( '-1');

// Saasland Core Directories
define( 'SC_IMAGES', plugins_url( 'widgets/images/', __FILE__));

/**
 * Constant for the plugins
 */
define( 'SAASLAND_CORE_URL', plugins_url() . '/saasland-core/' );
define( 'SAASLAND_CORE_DIR_CSS', plugins_url() . '/saasland-core/assets/css' );
define( 'SAASLAND_CORE_DIR_FONT', plugins_url() . '/saasland-core/assets/fonts' );
define( 'SAASLAND_CORE_DIR_JS', plugins_url() . '/saasland-core/assets/js' );
define( 'SAASLAND_CORE_DIR_VEND', plugins_url() . '/saasland-core/assets/vendors' );
define ( 'SAASLAND_CORE_DIR_PATH', plugin_dir_path( __FILE__ ) );

// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'Saasland_core' ) ) {
	/**
	 * Main Saasland Core Class
	 *
	 * The main class that initiates and runs the Saasland Core plugin.
	 *
	 */
	class Saasland_core {
		/**
		 * Saasland Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '4.1.11' ;

		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.6.0';

		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.4' ;

        /**
         * Plugin's directory paths
         * @since 1.0
         */
        const CSS = null;
        const JS = null;
        const VEND = null;

		/**
		 * Instance
		 *
		 * Holds a single instance of the `Saasland_Core` class.
		 *
		 * @access private
		 * @static
		 *
		 * @var Saasland_Core A single instance of the class.
		 */
		private static  $_instance = null ;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.\
		 *
		 * @access public
		 * @static
		 *
		 * @return Saasland_Core An instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'saasland-core' ), '1.7.0' );
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'saasland-core' ), '1.7.0' );
		}

		/**
		 * Constructor
		 *
		 * Initialize the Saasland Core plugins.
		 *
		 * @access public
		 */
		public function __construct() {
            $opt = get_option('saasland_opt');
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';
            if ( $is_mega_menu_cpt == '1' ) {
                add_action( 'init', [$this, 'mega_menu_include'] );
            }

            // Saasland Core Icons
            add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'saasland_themify_icons']);
            add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'saasland_icons']);
            // self :: generate_custom_font_icons();

            $this->init_hooks();
			$this->core_includes();
			do_action( 'saasland_core_loaded' );
		}


        /***
         * Custom Font Icon Integrated with Elementor Icon Library
         */

        // Register Themify Icons

        public function saasland_icons( $custom_fonts ) {

            $css_data = SAASLAND_CORE_DIR_VEND . '/icomoon/style.css';
            $json_data = SAASLAND_CORE_DIR_FONT . '/icon-json/saasland-custom.json';

            $custom_fonts['saasland_icons'] = [
                'name'          => 'saasland_custom_icons',
                'label'         => __( 'Saasland Icons', 'saasland-core' ),
                'url'           => $css_data,
                'prefix'        => 'icon-',
                'displayPrefix' => 'icon',
                'labelIcon'     => 'eicon-filter',
                'ver'           => '',
                'fetchJson'     => $json_data,
                'native'        => true,
            ];
            return $custom_fonts;
        }

        // Register Themify Icons
        public function saasland_themify_icons( $custom_fonts ) {

            $css_data = SAASLAND_CORE_DIR_VEND . '/themify-icon/themify-icons.css';
            $json_data = SAASLAND_CORE_DIR_FONT . '/icon-json/themify-icons.json';

            $custom_fonts['saasland_themify_icons'] = [
                'name'          => 'saasland_core_themify_icons',
                'label'         => __( 'Themify Icons', 'saasland-core' ),
                'url'           => $css_data,
                'prefix'        => 'ti-',
                'displayPrefix' => 'ti',
                'labelIcon'     => 'eicon-filter',
                'ver'           => '',
                'fetchJson'     => $json_data,
                'native'        => true,
            ];
            return $custom_fonts;
        }


        /**
         * Custom font generator with elementor library
         */
        public static function generate_custom_font_icons(){
            $css_source = '';
            global $wp_filesystem;
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
            $css_file =  SAASLAND_CORE_DIR_PATH . '/assets/vendors/icomoon/style.css';
            if ( $wp_filesystem->exists( $css_file ) ) {
                $css_source = $wp_filesystem->get_contents( $css_file );
            }
            preg_match_all( "/\.(icon-.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
            $iconList = [];
            foreach ( $matches as $match ) {
                $icon = str_replace('icon-', '', $match[1]);
                $icons = explode(' ', $icon);
                $iconList[] = current($icons);
            }
            $icons = new \stdClass();
            $icons->icons = $iconList;
            $icon_data = json_encode($icons);
            $file = SAASLAND_CORE_DIR_PATH . '/assets/fonts/icon-json/saasland-custom.json';
            global $wp_filesystem;
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
            if ( $wp_filesystem->exists( $file ) ) {
                $content =  $wp_filesystem->put_contents( $file, $icon_data) ;
            }
        }

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @access public
		 */
		public function core_includes() {
		    $opt = get_option('saasland_opt');
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';
		    $is_service_cpt = isset($opt['is_service_cpt']) ? $opt['is_service_cpt'] : '1';
		    $is_portfolio_cpt = isset($opt['is_portfolio_cpt']) ? $opt['is_portfolio_cpt'] : '1';
		    $is_team_cpt    = isset($opt['is_team_cpt']) ? $opt['is_team_cpt'] : '1';
		    $is_case_study_cpt = isset($opt['is_case_study_cpt']) ? $opt['is_case_study_cpt'] : '1';
		    $is_faq_cpt     = isset($opt['is_faq_cpt']) ? $opt['is_faq_cpt'] : '1';
		    $is_job_cpt     = isset($opt['is_job_cpt']) ? $opt['is_job_cpt'] : '1';
		    $is_header_cpt  = isset($opt['is_header_cpt']) ? $opt['is_header_cpt'] : '1';
		    $is_footer_cpt  = isset($opt['is_footer_cpt']) ? $opt['is_footer_cpt'] : '1';
			$is_event_cpt = isset($opt['is_event_cpt']) ? $opt['is_event_cpt'] : '1';

		    // Extra functions
			require_once __DIR__ . '/inc/extra.php';

            /**
             * Register Enqueue file's
             */
			require_once __DIR__ . '/inc/enqueue.php';
            Saasland_Enqueue_Scripts::instance();

			// Plugin's helper classes
            require_once __DIR__ . '/inc/classes/class-plugins-helper.php';

		
            //  add droitaddons pro widgets

             require_once __DIR__.'/widgets/pro-widgets/droit-pro/th-essential.php';

			// Custom post types
            if ( $is_service_cpt == '1' ) {
                require_once __DIR__ . '/post-type/service.pt.php';
            }
            if ( $is_portfolio_cpt == '1' ) {
                require_once __DIR__ . '/post-type/portfolio.pt.php';
            }
            if ( $is_team_cpt == '1' ) {
                require_once __DIR__ . '/post-type/team.pt.php';
            }
            if ( $is_case_study_cpt == '1' ) {
                require_once __DIR__ . '/post-type/case_study.pt.php';
            }
            if ( $is_faq_cpt == '1' ) {
                require_once __DIR__ . '/post-type/faq.pt.php';
            }
            if ( $is_job_cpt == '1' ) {
                require_once __DIR__ . '/post-type/job.pt.php';
            }
            if ( $is_mega_menu_cpt == '1' ) {
                require_once __DIR__ . '/post-type/Saasland_mega_menu.pt.php';
            }
			if ( $is_header_cpt == '1' ) {
                require_once __DIR__ . '/post-type/header.pt.php';
            }
			if ( $is_footer_cpt == '1' ) {
                require_once __DIR__ . '/post-type/footer.pt.php';
            }
			if ( $is_event_cpt == '1' ) {
                require_once __DIR__ . '/post-type/events.pt.php';
            }

            require_once __DIR__ . '/post-type/none.pt.php';
			/**
			 * Load template models
			 * @scince 4.0.6
			 * @package header, footer,  banner,  404 page builder,  mega menu builder 
			 */

			require_once __DIR__ . '/template-modules/template-modules.php';

            /**
             * Register widget area.
             *
             * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
             */
			require_once __DIR__ . '/wp-widgets/widgets.php';

			// Elementor custom field icons
			require_once __DIR__ . '/fields/icons.php';

            // RGBA color picker field for ACF
            require plugin_dir_path(__FILE__) . '/inc/acf-rgba-color-picker/acf-rgba-color-picker.php';


            /**
             * Saving automatically the ACF group fields json files
             */
            add_filter('acf/settings/save_json', function ( $path ) {

                // update path
                $path = plugin_dir_path(__FILE__) . 'inc/acf-json';

                // return
                return $path;

            });

            /**
             * Loading the saved ACF fields
             */
            add_filter('acf/settings/load_json', function ( $paths ) {
                // append path
                $paths[] = plugin_dir_path(__FILE__) . 'inc/acf-json';

                // return
                return $paths;
            });

            //Added Mailchimp dashboard by Redux
            if ( class_exists('Redux') ) {
                require_once __DIR__ . '/inc/redux/custom_field/extension_custom_field.php';
            }

            // Parallax
            if ( is_readable( __DIR__ . '/inc/parallax/class-parallax.php') ) {
                if ( !class_exists('\DROIT_ELEMENTOR_PRO\Parallax') ) {
                    require_once __DIR__ . '/inc/parallax/class-parallax.php';
                    \DROIT_ELEMENTOR_PRO\Parallax::instance()->init();
                }
            }

		}

		function mega_menu_include() {
            // Mega Menu
            $mega_menus = new WP_Query(array(
                'post_type' => 'megamenu',
                'posts_per_page' => -1,
            ));
            $mega_menu_count = $mega_menus->post_count;
            if ( $mega_menu_count > 0 && has_nav_menu('main_menu') ) {
                require plugin_dir_path(__FILE__) . '/inc/mega-menu/mega_menu.php';
            }
        }

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @access private
		 */
		private function init_hooks() {
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'saasland-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}


		/**
		 * Init Saasland Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @access public
		 */
		public function init() {
			if ( !did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}

            // Check for required Elementor version
			if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}

			// Check for required PHP version

			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}

			// Add new Elementor Categories
			add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

			// Register New Widgets
			add_action( 'elementor/widgets/register', [ $this, 'on_widgets_register' ] );

            add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
		}

        /**
         * Integrate WPML
         */
        public function wpml_widgets_to_translate_filter( $widgets ) {
            require_once __DIR__ . '/wpml/WPML_Fields.php';
            return $widgets;
        }

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'saasland-core' ) . '</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland Core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'saasland-core' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {
			$message = sprintf(
			/* translators: 1: Saasland Core 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saasland-core' ),
				'<strong>' . esc_html__( 'Saasland Core', 'saasland-core' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'saasland-core' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Add new Elementor Categories
		 *
		 * Register new widget categories for Saasland Core widgets.
		 *
		 * @access public
		 */
		public function add_elementor_category() {
			\Elementor\Plugin::instance()->elements_manager->add_category( 'saasland-elements', [
				'title' => __( 'Saasland Elements', 'saasland-core' ),
			], 1 );
		}

		/**
		 * Register New Widgets
		 *
		 * Include Saasland Core widgets files and register them in Elementor.
		 *
		 * @access public
		 */
		public function on_widgets_register() {
			$this->include_widgets();
			$this->register_widgets();
		}

		/**
		 * Include Widgets Files
		 *
		 * Load Saasland Core widgets files.
		 *
		 * @access private
		 */
		private function include_widgets() {
            require_once __DIR__ . '/vendor/autoload.php';
        }

		/**
		 * Register Widgets
		 *
		 * Register Saasland Core widgets.
		 *
		 * @access private
		 */
		private function register_widgets() {
            // Site Elements
            $widgets = array(
                'Subscribe_Form', 'Services_shapes', 'Solar_Integration', 'Integrations', 'Integrations_row', 'Pricing_table', 'Pricing_table_tabs',
                'Pricing_table_tabs_carousel','Navbar', 'Hero_Section', 'Hero_crm', 'Two_column_features', 'Services', 'Call_to_Action', 'Footer',
                'Client_logos', 'Features', 'Bubble_features', 'Features_vertical', 'Prototype_features', 'Features_vertical', 'Prototype_features',
                'Tabs', 'Tabs_with_icon', 'Blog', 'Case_study', 'Testimonial', 'Testimonial_bubble', 'Testimonial_ratting', 'Testimonial_single', 'Paired_images',
                'Tabs_horizontal', 'Features_with_shapes', 'Features_with_image', 'Features_with_image_white', 'Counter', 'Curve_counter', 'Circle_counter',
                'Hero_app', 'Hero_seo', 'Hero_integration', 'Hero_videos', 'Hero_with_bg_img', 'Image_carousels', 'Downloads', 'Team', 'Map',
                'Processes', 'Hotspot', 'Portfolio', 'Portfolio_masonry', 'Login_form', 'Signup_form', 'Jobs', 'Icon_boxes', 'Single_video',
                'Single_feature', 'Single_feature', 'Icons', 'Icon_dual', 'Seo_check_form', 'Posts_carousel', 'Featured_image_with_shape', 'Slider',
                'Serialized_features', 'Alerts_box', 'Faq', 'Faq_advance', 'Pricing_table_comparison', 'Appart_hero', 'Appart_c2a', 'Appart_screen_feature',
                'Appart_pricing_table', 'Appart_app_info', 'Appart_testimonials', 'Appart_features', 'Appart_single_video', 'Appart_parallax_hero',
                'Appart_parallax_hero', 'Appart_single_info_with_icon', 'Appart_shop_categories','Appart_products', 'Ticket_plan', 'Hero_erp',
                'Icon_with_featured_img', 'Domain_form', 'Locations', 'Table_tabs', 'Button_icons', 'Parallax_img_effect', 'Countdown', 'Event_schedule',
                'Progress_bar', 'About_section', 'Saasland_product', 'Saasland_heading', 'Animated_icon', 'Portfolio_simple', 'Button', 'Gallery',
                'Image_slideshow', 'Portfolio_masonry_simple', 'Event', 'Shop_slider', 'Tour_booking', 'Tour_booking_activities', 'saasland_search_form','Testimonial_pro',
				'Bubble',
            );

            foreach ( $widgets as $widget ) {
                $classname = "\\SaaslandCore\\Widgets\\$widget";
                \Elementor\Plugin::instance()->widgets_manager->register( new $classname() );
            }
        }

	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if ( !function_exists( 'saasland_core_load' ) ) {
	/**
	 * Load Saasland Core
	 *
	 * Main instance of Saasland_Core.
	 */
	function saasland_core_load() {
		return Saasland_core::instance();
	}

	// Run Saasland Core
    saasland_core_load();
}

function saasland_admin_cpt_script( $hook ) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'service' === $post->post_type ) {
            wp_enqueue_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ));
        }
    }
}
add_action( 'admin_enqueue_scripts', 'saasland_admin_cpt_script', 10, 1 );

//  display admin notice 

function saasland_admin_banner() {

   $screen = get_current_screen();
   if ( $screen->base == 'toplevel_page_Saasland' || $screen->base == 'toplevel_page_saasland' ) { ?>

<div class="notice is-dismissible" style="padding:0; border:0; background: transparent; margin-top:30px">
    <a target="_blank" href="https://www.hubspot.com/marketing/free/wordpress-intro">
        <img style="max-width: 100%"
            src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'assets/img/hubspot-banner.png'); ?>"
            alt="<?php esc_attr_e('Banner', 'saasland-core'); ?>">
    </a>
</div>

<div class="notice is-dismissible" style="padding:0; border:0; background: transparent; margin-top: 15px">
    <a
        href="https://droitthemes.com/droit-elementor-addons/?ref=5&utm_source=Saasland_Theme&utm_medium=SL_ThemeSettings&utm_campaign=Saasland">
        <img style="max-width: 100%" src="https://saasland.droitlab.com/image/addons-banner.png"
            alt="<?php esc_attr_e('Banner', 'saasland-core'); ?>">
    </a>
</div>
<?php
   }
}
add_action('admin_notices', 'saasland_admin_banner');
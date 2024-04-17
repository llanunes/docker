<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
class saasland_Register_Plugins {

	public function __construct() {
		add_filter( 'insight_core_tgm_plugins', [ $this, 'register_required_plugins' ] );

		//add_filter( 'insight_core_compatible_plugins', [ $this, 'register_compatible_plugins' ] );
	}

	public function register_required_plugins( $plugins ) {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$new_plugins = array(

			array(
				'name'               => esc_html__( 'Saasland Core', 'saasland' ), // The plugin names.
				'slug'               => 'saasland-core', // The plugin slug (typically the folder name).
				'source'             => 'https://saasland.droitlab.com/downloadfile/saasland-core_4.1.11.zip', // The plugin sources.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
				'version'            => '4.1.11'
			),
	
			array(
				'name'               => esc_html__( 'Advanced Custom Fields Pro', 'saasland' ), // The plugin names.
				'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
				'source'             => 'https://plugindownload.droitlab.com/advanced-custom-fields-pro.zip', // The plugin sources.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => esc_html__( 'Droit Elementor Templating', 'saasland' ), // The plugin names.
				'slug'               => 'droit-elementor-templating', // The plugin slug (typically the folder name).
				'source'             => 'https://saasland.droitlab.com/downloadfile/droit-elementor-templating.zip', // The plugin sources.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
				'version'            => ''
			),
	
			array(
				'name'               => esc_html__( 'Slider Revolution', 'saasland' ), // The plugin name.
				'slug'               => 'revslider', // The plugin slug (typically the folder name).
				'source'             => 'https://plugindownload.droitlab.com/revslider.zip', // The plugin sources.
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'              => esc_html__( 'Elementor', 'saasland' ),
				'slug'              => 'elementor',
				'required'          => true,
			),
	
			array(
				'name'               => esc_html__( 'Redux Framework', 'saasland' ),
				'slug'               => 'redux-framework',
				'required'           => true,
			),
	
			array(
				'name'      => esc_html__( 'Droit Dark Mode', 'saasland' ),
				'slug'      => 'droit-dark-mode',
				'required'  => true,
			),
	
			array(
				'name'      => esc_html__( 'Droit Addons For Elementor', 'saasland' ),
				'slug'      => 'droit-elementor-addons',
				'required'  => true,
			),
	
			array(
				'name'      => esc_html__( 'HubSpot – CRM, Email Marketing', 'saasland' ),
				'slug'      => 'leadin',
				'required'  => true,
			),
	
			array(
				'name'      => esc_html__( 'Custom Fonts', 'saasland' ),
				'slug'      => 'custom-fonts',
				'required'  => true,
			),
	
			array(
				'name'      => esc_html__( 'WooCommerce', 'saasland' ),
				'slug'      => 'woocommerce',
				'required'  => false,
			),
	
			array(
				'name'      => esc_html__( 'WooCommerce Wishlist', 'saasland' ),
				'slug'      => 'ti-woocommerce-wishlist',
				'required'  => false,
			),
	
			array(
				'name'      => esc_html__( 'WordPress Travel Booking Plugin – WP Travel Engine', 'rave' ), // The plugin name.
				'slug'      => 'wp-travel-engine', // The plugin slug (typically the folder name).
				'required'  => false,
			),
	
			array(
				'name'      => esc_html__( 'Contact Form 7', 'saasland' ),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
	
			array(
				'name'      => esc_html__( 'One Click Demo Import', 'saasland' ),
				'slug'      => 'one-click-demo-import',
				'required'  => false,
			),
		);

		return array_merge( $plugins, $new_plugins );
	}
}

new saasland_Register_Plugins();

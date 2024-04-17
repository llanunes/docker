<?php
/**
 * @package droithead
 * @developer DroitLab Team
 */

// define the main file 
define( 'DROIT_HEAD_FILE_', __FILE__ );

// controller page
include 'controller.php';

// load of controller files
// after theme switch
add_action( 'after_switch_theme', 'drdt_head_active' );
// when plugin active
register_activation_hook(__FILE__, 'drdt_head_active');

/**
* Name: add_cpt_support
* Desc: Support custom posttype 
* Params: no params
* Return: @void
* version: 1.0.0
* Package: @droitedd
* Author: DroitThemes
* Developer: Hazi
*/

if ( ! function_exists('drdt_head_active') ) {
    function drdt_head_active(){
        $cpt_support = get_option( 'elementor_cpt_support', [ 'page', 'post', 'portfolio' ] );
        foreach ( $cpt_support as $cpt_slug ) {
            add_post_type_support( $cpt_slug, 'elementor' );
        }
        // add custom posttype
        if( !in_array('droit-templates', $cpt_support) ){
            add_post_type_support( 'droit-templates', 'elementor' );
            $cpt_support[] = 'droit-templates';
            update_option('elementor_cpt_support', $cpt_support);
            flush_rewrite_rules();
        }

    }
}

if ( ! function_exists('drdt_kses_html') ) {
    function drdt_kses_html( $content = '') {
        return $content;
    }
}

// load plugin
add_action( 'plugins_loaded', function(){
	// load text domain
	load_plugin_textdomain( 'droithead', false, basename( dirname( __FILE__ ) ) . '/languages'  );
	// load plugin instance
    \DroitHead\Dtdr_Controller::instance()->load();

    // load include
    \DroitHead\Includes\Dtdr_Load::_instance()->_init();

}, 10); 
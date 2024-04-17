<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab team
 *
 */
namespace DROIT_ELEMENTOR_PRO\Modules\Widgets\Subscriber;

if (!defined('ABSPATH')) {exit;}

class Subscriber_Module{
    
    public static function get_name() {
        return 'droit-subscriber';
    }
    
    public static function get_title() {
        return esc_html__( 'Subscriber', 'saasland-core' );
    }

    public static function get_icon() {
        return 'eicon-mailchimp addons-icon';
    }

    public static function get_keywords() {
       return [ 
        'image compare',
        'compare',
        'image',
        'before',
        'after',
        'droit',
        'dl',
        'droit elementor addons',
        'pro',
       ];
    }
    
    public static function get_categories() {
        return ['droit_addons_pro'];
    }
 
}
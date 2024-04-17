<?php
// Require widget files
require plugin_dir_path(__FILE__) . 'class-widget-recent-posts.php';
require plugin_dir_path(__FILE__) . 'class-widget-subscribe.php';
require plugin_dir_path(__FILE__) . 'class-widget-social.php';
require plugin_dir_path(__FILE__) . 'class-widget-search-form.php';

// Register Widgets
add_action( 'widgets_init', function() {
    register_widget('SaaslandCore\WP_Widgets\Widget_Recent_posts');
    register_widget('SaaslandCore\WP_Widgets\Widget_Subscribe');
    register_widget('SaaslandCore\WP_Widgets\Widget_Social');
    register_widget('SaaslandCore\WP_Widgets\Widget_Search_form');
});
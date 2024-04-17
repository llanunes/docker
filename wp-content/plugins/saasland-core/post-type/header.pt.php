<?php
// event.pt.php

/**
 * Use namespace to avoid conflict
 */
namespace PostType;

/**
 * Class Event
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class Header {

    /**
     * @var string
     *
     * Set post type params
     */
    private $type               = 'header';
    private $slug               = 'header';
    private $name               = 'Headers';
    private $singular_name      = 'Header';
    private $icon               = 'dashicons-arrow-up-alt2';

    /**
     * Register post type
     */
    public function register() {
        $labels = array(
            'name'                  => $this->name,
            'singular_name'         => $this->singular_name,
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New '   . $this->singular_name,
            'edit_item'             => 'Edit '      . $this->singular_name,
            'new_item'              => 'New '       . $this->singular_name,
            'all_items'             => 'All '       . $this->name,
            'view_item'             => 'View '      . $this->singular_name,
            'view_items'            => 'View '      . $this->name,
            'search_items'          => 'Search '    . $this->name,
            'not_found'             => 'No '        . strtolower($this->name) . ' found',
            'not_found_in_trash'    => 'No '        . strtolower($this->name) . ' found in Trash',
            'parent_item_colon'     => '',
            'menu_name'             => $this->name
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'exclude_from_search'   => true,
            'rewrite'               => array( 'slug' => $this->slug ),
            'capability_type'       => 'post',
            'has_archive'           => false,
            'hierarchical'          => true,
            'menu_position'         => 8,
            'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail'),
            'yarpp_support'         => true,
            'menu_icon'             => $this->icon
        );

        register_post_type( $this->type, $args );
    }

    /**
     * Event constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
        // Register the post type
        add_action( 'init', array($this, 'register'));
    }
}

/**
 * Instantiate class, creating post type
 */
new Header();
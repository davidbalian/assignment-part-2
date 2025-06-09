<?php
/**
 * Custom Post Types
 *
 * @package Custom_Bootstrap_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register Game Custom Post Type
 */
function register_game_post_type() {
    $labels = array(
        'name'               => 'Games',
        'singular_name'      => 'Game',
        'menu_name'          => 'Games',
        'add_new'           => 'Add New',
        'add_new_item'      => 'Add New Game',
        'edit_item'         => 'Edit Game',
        'new_item'          => 'New Game',
        'view_item'         => 'View Game',
        'search_items'      => 'Search Games',
        'not_found'         => 'No games found',
        'not_found_in_trash'=> 'No games found in Trash'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'game'),
        'capability_type'    => 'post',
        'supports'           => array('title', 'editor'),
        'menu_icon'          => 'dashicons-games'
    );

    register_post_type('game', $args);
}
add_action('init', 'register_game_post_type');

/**
 * Register Casino Custom Post Type
 */
function register_casino_post_type() {
    $labels = array(
        'name'               => 'Casinos',
        'singular_name'      => 'Casino',
        'menu_name'          => 'Casinos',
        'add_new'           => 'Add New',
        'add_new_item'      => 'Add New Casino',
        'edit_item'         => 'Edit Casino',
        'new_item'          => 'New Casino',
        'view_item'         => 'View Casino',
        'search_items'      => 'Search Casinos',
        'not_found'         => 'No casinos found',
        'not_found_in_trash'=> 'No casinos found in Trash'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'casino/%postname%'),
        'capability_type'    => 'post',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-store',
        'taxonomies'         => array('category', 'post_tag')
    );

    register_post_type('casino', $args);
}
add_action('init', 'register_casino_post_type'); 
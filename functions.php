<?php
/**
 * Theme functions and definitions
 */

 if (! function_exists('custom_bootstrap_theme_setup')) :
    function custom_bootstrap_theme_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
        add_theme_support('custom-background');
        add_theme_support('custom-logo');
        add_theme_support('custom-header');
        add_theme_support('custom-background');
        add_theme_support('custom-logo');
        add_theme_support('custom-header');
    }
endif;

 add_action('after_setup_theme', 'custom_bootstrap_theme_setup');

// Enqueue styles, scripts, and register sidebars
function custom_bootstrap_theme_scripts() {
    wp_enqueue_style('custom_bootstrap_theme_style', get_stylesheet_uri());

    // Enqueue Bootstrap CSS and JS from CDN
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    wp_enqueue_script( 'bootstrap-bundle-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );
    
    register_sidebar(array(
        'name' => __('Sidebar', 'custom_bootstrap_theme'),
        'id' => 'sidebar-1',
        'description' => __('Sidebar for the theme', 'custom_bootstrap_theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('wp_enqueue_scripts', 'custom_bootstrap_theme_scripts');

function customtheme_register_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'custom-bootstrap-theme'),
            'footer'  => __('Footer Menu', 'custom-bootstrap-theme'),
        )
    );
}
add_action('after_setup_theme', 'customtheme_register_menus');

add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
    if ($args->theme_location === 'primary') {
        $atts['class'] = (isset($atts['class']) ? $atts['class'] . ' ' : '') . 'nav-link';
    }
    return $atts;
}, 10, 3);

// Register footer widget areas
function custom_bootstrap_theme_footer_widgets() {
    register_sidebar(array(
        'name'          => __('Footer About', 'custom-bootstrap-theme'),
        'id'            => 'footer-about',
        'description'   => __('Add widgets here to appear in the footer about section.', 'custom-bootstrap-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => __('Footer News', 'custom-bootstrap-theme'),
        'id'            => 'footer-news',
        'description'   => __('Add widgets here to appear in the footer news section.', 'custom-bootstrap-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Menu', 'custom-bootstrap-theme'),
        'id'            => 'footer-menu',
        'description'   => __('Add widgets here to appear in the footer menu section.', 'custom-bootstrap-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Newsletter', 'custom-bootstrap-theme'),
        'id'            => 'footer-newsletter',
        'description'   => __('Add widgets here to appear in the footer newsletter section.', 'custom-bootstrap-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'custom_bootstrap_theme_footer_widgets');
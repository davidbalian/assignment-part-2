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

// Register Game Custom Post Type
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

// Register Casino Custom Post Type
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

// Add Casino Meta Boxes
function add_casino_meta_boxes() {
    add_meta_box(
        'casino_details',
        'Casino Details',
        'render_casino_meta_box',
        'casino',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_casino_meta_boxes');

// Render Casino Meta Box
function render_casino_meta_box($post) {
    wp_nonce_field('casino_meta_box', 'casino_meta_box_nonce');

    $official_site = get_post_meta($post->ID, 'official_site', true);
    $year_established = get_post_meta($post->ID, 'year_of_establishment', true);
    $contact_email = get_post_meta($post->ID, 'contact_email', true);
    $loyalty = get_post_meta($post->ID, 'loyalty', true);
    $live_casino = get_post_meta($post->ID, 'live_casino', true);
    $mobile_casino = get_post_meta($post->ID, 'mobile_casino', true);
    $games = get_post_meta($post->ID, 'games', true);
    $rating = get_post_meta($post->ID, 'rating', true);

    // Rating fields
    $rating_fields = array(
        'games' => 'Games',
        'live_casino' => 'Live Casino',
        'payout' => 'Payout',
        'licensing' => 'Licensing',
        'payment_methods' => 'Payment Methods',
        'withdrawal_speed' => 'Withdrawal Speed',
        'support' => 'Support',
        'offers' => 'Offers',
        'mobile' => 'Mobile',
        'website' => 'Website'
    );

    ?>
    <div class="casino-meta-box">
        <p>
            <label for="official_site">Official Site URL:</label>
            <input type="url" id="official_site" name="official_site" value="<?php echo esc_attr($official_site); ?>" class="form-control">
        </p>
        <p>
            <label for="year_of_establishment">Year of Establishment:</label>
            <input type="text" id="year_of_establishment" name="year_of_establishment" value="<?php echo esc_attr($year_established); ?>" class="form-control">
        </p>
        <p>
            <label for="contact_email">Contact Email:</label>
            <input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr($contact_email); ?>" class="form-control">
        </p>
        <p>
            <label>
                <input type="checkbox" name="loyalty" value="1" <?php checked($loyalty, '1'); ?>>
                Loyalty Program
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" name="live_casino" value="1" <?php checked($live_casino, '1'); ?>>
                Live Casino
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" name="mobile_casino" value="1" <?php checked($mobile_casino, '1'); ?>>
                Mobile Casino
            </label>
        </p>
        <p>
            <label>Available Games:</label>
            <?php
            $all_games = get_posts(array('post_type' => 'game', 'posts_per_page' => -1));
            if ($all_games) {
                echo '<div class="games-checkbox-list">';
                foreach ($all_games as $game) {
                    $checked = is_array($games) && in_array($game->ID, $games) ? 'checked' : '';
                    echo '<label class="d-block">';
                    echo '<input type="checkbox" name="games[]" value="' . $game->ID . '" ' . $checked . '>';
                    echo esc_html($game->post_title);
                    echo '</label>';
                }
                echo '</div>';
            }
            ?>
        </p>
        <div class="rating-fields">
            <h4>Rating Components</h4>
            <?php
            foreach ($rating_fields as $key => $label) {
                $value = isset($rating[$key]) ? $rating[$key] : '';
                echo '<p>';
                echo '<label for="rating_' . $key . '">' . $label . ':</label>';
                echo '<input type="number" id="rating_' . $key . '" name="rating[' . $key . ']" value="' . esc_attr($value) . '" min="1" max="10" step="0.1" class="form-control">';
                echo '</p>';
            }
            ?>
        </div>
    </div>
    <?php
}

// Save Casino Meta Box Data
function save_casino_meta_box($post_id) {
    if (!isset($_POST['casino_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['casino_meta_box_nonce'], 'casino_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'official_site',
        'year_of_establishment',
        'contact_email',
        'loyalty',
        'live_casino',
        'mobile_casino',
        'games'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $_POST[$field]);
        } else {
            delete_post_meta($post_id, $field);
        }
    }

    // Handle rating fields
    if (isset($_POST['rating'])) {
        $ratings = $_POST['rating'];
        $total = 0;
        $count = 0;
        foreach ($ratings as $rating) {
            if ($rating >= 1 && $rating <= 10) {
                $total += floatval($rating);
                $count++;
            }
        }
        $average = $count > 0 ? $total / $count : 0;
        update_post_meta($post_id, 'rating', $ratings);
        update_post_meta($post_id, 'rating_average', $average);
    }
}
add_action('save_post_casino', 'save_casino_meta_box');

// Casino Shortcode
function casinos_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Best Casino',
        'template' => '1',
        'second_col' => 'loyalty'
    ), $atts);

    $args = array(
        'post_type' => 'casino',
        'posts_per_page' => -1
    );

    $casinos = get_posts($args);
    $output = '';

    if ($atts['template'] == '2') {
        $output .= '<div class="casino-dropdown mb-3">';
        $output .= '<select class="form-select" id="casino-column-selector">';
        $output .= '<option value="loyalty">Loyalty</option>';
        $output .= '<option value="live_casino">Live Casino</option>';
        $output .= '<option value="mobile_casino">Mobile Casino</option>';
        $output .= '<option value="year_of_establishment">Year of Establishment</option>';
        $output .= '<option value="contact_email">Contact Email</option>';
        $output .= '<option value="games">Games</option>';
        $output .= '</select>';
        $output .= '</div>';
    }

    $output .= '<h2 class="mb-4">' . esc_html($atts['title']) . '</h2>';
    $output .= '<div class="table-responsive">';
    $output .= '<table class="table table-hover">';
    $output .= '<thead><tr>';
    $output .= '<th>Casino</th>';
    $output .= '<th class="d-none d-md-table-cell">' . esc_html(ucfirst(str_replace('_', ' ', $atts['second_col']))) . '</th>';
    $output .= '<th>Action</th>';
    $output .= '</tr></thead><tbody>';

    foreach ($casinos as $casino) {
        $logo = get_the_post_thumbnail($casino->ID, 'medium', array('class' => 'img-fluid'));
        $official_site = get_post_meta($casino->ID, 'official_site', true);
        $rating = get_post_meta($casino->ID, 'rating_average', true);
        $second_col_value = get_post_meta($casino->ID, $atts['second_col'], true);

        $output .= '<tr>';
        $output .= '<td>';
        if ($logo) {
            $output .= '<a href="' . esc_url($official_site) . '" target="_blank">' . $logo . '</a>';
        }
        if ($rating) {
            $output .= '<div class="rating mt-2">';
            $output .= '<span class="rating-value">' . number_format($rating, 1) . '/10</span>';
            $output .= '<div class="stars">' . str_repeat('★', round($rating)) . str_repeat('☆', 10 - round($rating)) . '</div>';
            $output .= '</div>';
        }
        $output .= '</td>';

        $output .= '<td class="d-none d-md-table-cell">';
        if ($atts['second_col'] == 'games') {
            $games = get_post_meta($casino->ID, 'games', true);
            if (is_array($games)) {
                $output .= '<ul class="list-unstyled">';
                foreach ($games as $game_id) {
                    $game = get_post($game_id);
                    if ($game) {
                        $output .= '<li>' . esc_html($game->post_title) . '</li>';
                    }
                }
                $output .= '</ul>';
            }
        } else {
            $output .= $second_col_value ? 'YES' : 'NO';
        }
        $output .= '</td>';

        $output .= '<td>';
        $output .= '<a href="' . esc_url($official_site) . '" class="btn btn-primary" target="_blank">Review</a>';
        $output .= '</td>';
        $output .= '</tr>';
    }

    $output .= '</tbody></table></div>';

    if ($atts['template'] == '2') {
        $output .= '<script>
            jQuery(document).ready(function($) {
                $("#casino-column-selector").on("change", function() {
                    var selected = $(this).val();
                    $.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: {
                            action: "update_casino_column",
                            column: selected,
                            nonce: "' . wp_create_nonce('update_casino_column') . '"
                        },
                        success: function(response) {
                            if (response.success) {
                                $(".table th:nth-child(2)").text(response.data.title);
                                $(".table td:nth-child(2)").each(function() {
                                    $(this).html(response.data.content);
                                });
                            }
                        }
                    });
                });
            });
        </script>';
    }

    return $output;
}
add_shortcode('casinos', 'casinos_shortcode');

// Include shortcodes
require get_template_directory() . '/shortcodes.php';

// Register Casino Listings Widget
class Casino_Listings_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'casino_listings_widget',
            'Casino Listings',
            array('description' => 'Displays popular and recent casinos')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        echo '<ul class="nav nav-tabs" id="casinoTabs" role="tablist">';
        echo '<li class="nav-item" role="presentation">';
        echo '<button class="nav-link active" id="popular-tab" data-bs-toggle="tab" data-bs-target="#popular" type="button" role="tab">Popular</button>';
        echo '</li>';
        echo '<li class="nav-item" role="presentation">';
        echo '<button class="nav-link" id="recent-tab" data-bs-toggle="tab" data-bs-target="#recent" type="button" role="tab">Recent</button>';
        echo '</li>';
        echo '</ul>';

        echo '<div class="tab-content" id="casinoTabsContent">';
        
        // Popular Casinos
        echo '<div class="tab-pane fade show active" id="popular" role="tabpanel">';
        $popular_args = array(
            'post_type' => 'casino',
            'posts_per_page' => 3,
            'meta_key' => 'rating_average',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
        $popular_casinos = get_posts($popular_args);
        foreach ($popular_casinos as $casino) {
            $logo = get_the_post_thumbnail($casino->ID, 'thumbnail', array('class' => 'img-fluid'));
            echo '<div class="casino-item mb-3">';
            echo '<a href="' . get_permalink($casino->ID) . '">' . $logo . '</a>';
            echo '<h6 class="mt-2">' . get_the_title($casino->ID) . '</h6>';
            echo '</div>';
        }
        echo '</div>';

        // Recent Casinos
        echo '<div class="tab-pane fade" id="recent" role="tabpanel">';
        $recent_args = array(
            'post_type' => 'casino',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $recent_casinos = get_posts($recent_args);
        foreach ($recent_casinos as $casino) {
            $logo = get_the_post_thumbnail($casino->ID, 'thumbnail', array('class' => 'img-fluid'));
            echo '<div class="casino-item mb-3">';
            echo '<a href="' . get_permalink($casino->ID) . '">' . $logo . '</a>';
            echo '<h6 class="mt-2">' . get_the_title($casino->ID) . '</h6>';
            echo '</div>';
        }
        echo '</div>';

        echo '</div>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

// Register Casino Listings Widget
function register_casino_listings_widget() {
    register_widget('Casino_Listings_Widget');
}
add_action('widgets_init', 'register_casino_listings_widget');

// AJAX handler for casino column updates
function update_casino_column() {
    check_ajax_referer('update_casino_column', 'nonce');
    
    $column = sanitize_text_field($_POST['column']);
    $title = ucfirst(str_replace('_', ' ', $column));
    
    wp_send_json_success(array(
        'title' => $title,
        'content' => 'Loading...' // This will be updated via JavaScript
    ));
}
add_action('wp_ajax_update_casino_column', 'update_casino_column');
add_action('wp_ajax_nopriv_update_casino_column', 'update_casino_column');
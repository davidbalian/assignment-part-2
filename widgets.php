<?php
/**
 * Custom Widgets
 *
 * @package Custom_Bootstrap_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Casino Listings Widget
 */
class Casino_Listings_Widget extends WP_Widget {
    /**
     * Register widget with WordPress
     */
    public function __construct() {
        parent::__construct(
            'casino_listings_widget',
            'Casino Listings',
            array('description' => 'Displays popular and recent casinos')
        );
    }

    /**
     * Front-end display of widget
     *
     * @param array $args     Widget arguments
     * @param array $instance Saved values from database
     */
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

    /**
     * Back-end widget form
     *
     * @param array $instance Previously saved values from database
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved
     *
     * @param array $new_instance Values just sent to be saved
     * @param array $old_instance Previously saved values from database
     * @return array Updated safe values to be saved
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

/**
 * Register Casino Listings Widget
 */
function register_casino_listings_widget() {
    register_widget('Casino_Listings_Widget');
}
add_action('widgets_init', 'register_casino_listings_widget'); 
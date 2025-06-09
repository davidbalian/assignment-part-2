<?php
/**
 * Custom Meta Boxes
 *
 * @package Custom_Bootstrap_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Add Casino Meta Boxes
 */
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

/**
 * Render Casino Meta Box
 *
 * @param WP_Post $post The post object
 */
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
    <div class="casino-meta-box pt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="mb-3 border-bottom pb-2">Casino Details</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="official_site" class="form-label">Official Site URL:</label>
                    <input type="url" id="official_site" name="official_site" value="<?php echo esc_attr($official_site); ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="year_of_establishment" class="form-label">Year of Establishment:</label>
                    <input type="text" id="year_of_establishment" name="year_of_establishment" value="<?php echo esc_attr($year_established); ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Contact Email:</label>
                    <input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr($contact_email); ?>" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <h6 class="mb-2">Features</h6>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="loyalty" id="loyalty" value="1" <?php checked($loyalty, '1'); ?>>
                        <label class="form-check-label" for="loyalty">Loyalty Program</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="live_casino" id="live_casino" value="1" <?php checked($live_casino, '1'); ?>>
                        <label class="form-check-label" for="live_casino">Live Casino</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="mobile_casino" id="mobile_casino" value="1" <?php checked($mobile_casino, '1'); ?>>
                        <label class="form-check-label" for="mobile_casino">Mobile Casino</label>
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="mb-2">Available Games</h6>
                    <div class="row g-2">
                        <?php
                        $all_games = get_posts(array('post_type' => 'game', 'posts_per_page' => -1));
                        if ($all_games) {
                            foreach ($all_games as $game) {
                                $checked = is_array($games) && in_array($game->ID, $games) ? 'checked' : '';
                                echo '<div class="col-12 col-sm-6 col-lg-4">';
                                echo '<div style="display: flex; align-items: center; gap: 0.5em;">';
                                echo '<input class="align-middle" type="checkbox" name="games[]" id="game_' . $game->ID . '" value="' . $game->ID . '" ' . $checked . '>';
                                echo '<label class="align-middle" for="game_' . $game->ID . '" style="margin-bottom: 0;">' . esc_html($game->post_title) . '</label>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="rating-fields mt-4 p-3 border rounded bg-light">
            <h5 class="mb-3">Rating Components</h5>
            <div class="row">
                <?php
                foreach ($rating_fields as $key => $label) {
                    $value = isset($rating[$key]) ? $rating[$key] : '';
                    echo '<div class="col-md-4 mb-3">';
                    echo '<label for="rating_' . $key . '" class="form-label">' . $label . ':</label>';
                    echo '<input type="number" id="rating_' . $key . '" name="rating[' . $key . ']" value="' . esc_attr($value) . '" min="1" max="10" step="0.1" class="form-control">';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Save Casino Meta Box Data
 *
 * @param int $post_id The post ID
 */
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
<?php
/**
 * Theme Shortcodes
 *
 * @package Custom_Bootstrap_Theme
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Casino Shortcode
 * 
 * Usage: [casinos title="Best Casino" template="1" second_col="loyalty"]
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
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
    $output .= '<div class="table-responsive" style="background:#f7f7f7; padding:1.5rem; border-radius:8px;">';
    $output .= '<table class="table mb-0" style="background:#f7f7f7; border-collapse:separate; border-spacing:0;">';
    $output .= '<thead>';
    $output .= '<tr style="background:#18344a; color:#fff;">';
    $output .= '<th style="font-weight:600; font-size:1.1em; padding:0.75em 1em;">Casino</th>';
    $output .= '<th class="d-none d-md-table-cell" style="font-weight:600; font-size:1.1em; padding:0.75em 1em;">' . esc_html(ucfirst(str_replace('_', ' ', $atts['second_col']))) . '</th>';
    $output .= '<th style="font-weight:600; font-size:1.1em; padding:0.75em 1em;"></th>';
    $output .= '</tr></thead><tbody>';

    foreach ($casinos as $casino) {
        $logo = get_the_post_thumbnail($casino->ID, 'medium', array('class' => 'img-fluid'));
        $official_site = get_post_meta($casino->ID, 'official_site', true);
        $rating = get_post_meta($casino->ID, 'rating_average', true);
        $second_col_value = get_post_meta($casino->ID, $atts['second_col'], true);

        $output .= '<tr style="background:#f7f7f7; border-bottom:4px solid #fff;">';
        $output .= '<td style="vertical-align:top; text-align:left; padding:1.2em 1em;">';
        if ($logo) {
            $output .= '<a href="' . esc_url($official_site) . '" target="_blank">'
                . '<span style="display:inline-block; aspect-ratio:3/2; max-height:64px; width:auto; overflow:hidden; vertical-align:top;">'
                . preg_replace('/<img /', '<img style="height:64px; max-width:100%; object-fit:cover; aspect-ratio:3/2; background:#fff; border-radius:4px;" ', $logo)
                . '</span></a>';
        }
        if ($rating) {
            $rating_out_of_5 = $rating / 2;
            $output .= '<div class="rating mt-2" style="text-align:left;">';
            $output .= '<div class="stars" style="font-size:1.1em; display:flex; gap:2px; justify-content:flex-start;">';
            $full_stars = floor($rating_out_of_5);
            $partial = $rating_out_of_5 - $full_stars;
            for ($i = 0; $i < 5; $i++) {
                if ($i < $full_stars) {
                    $output .= '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="#ffc107" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                } elseif ($i == $full_stars && $partial > 0) {
                    $percent = round($partial * 100);
                    $output .= '<span style="position:relative; display:inline-block; width:1em; height:1em;">';
                    $output .= '<svg width="1em" height="1em" viewBox="0 0 24 24" style="position:absolute;top:0;left:0;z-index:1;" fill="#ffc107" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="starGrad' . $casino->ID . $i . '" x1="0" x2="1" y1="0" y2="0"><stop offset="' . $percent . '%" stop-color="#ffc107"/><stop offset="' . $percent . '%" stop-color="#e4e5e9"/></linearGradient></defs><path fill="url(#starGrad' . $casino->ID . $i . ')" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                    $output .= '</span>';
                } else {
                    $output .= '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="#e4e5e9" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                }
            }
            $output .= '</div>';
            $output .= '<span class="rating-value" style="display:block; text-align:left; font-size:1em; color:#444;">' . number_format($rating_out_of_5, 2) . '/5</span>';
            $output .= '</div>';
        }
        $output .= '</td>';
        $output .= '<td class="d-none d-md-table-cell" style="vertical-align:middle; background:#f7f7f7; padding:1.2em 1em;">';
        if ($atts['second_col'] == 'games') {
            $games = get_post_meta($casino->ID, 'games', true);
            if (is_array($games)) {
                $output .= '<ul class="list-unstyled mb-0">';
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
        $output .= '<td style="vertical-align:middle; text-align:right; background:#f7f7f7; padding:1.2em 1em;">';
        $output .= '<a href="' . esc_url($official_site) . '" class="btn btn-dark d-inline-flex align-items-center w-100 justify-content-center" target="_blank"><span style="display:flex;justify-content:center;align-items:center;margin-right:.4rem;">'
            . '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>'
            . '</span>Review</a>';
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

/**
 * AJAX handler for casino column updates
 */
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
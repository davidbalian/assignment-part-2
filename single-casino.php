<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Custom_Bootstrap_Theme
 */

get_header();
?>

<div class="row site-body">
    <main class="col-md-8" role="main">
        <?php
        while ( have_posts() ) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail mb-4">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                    </div>
                <?php endif; ?>

                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>

                <div class="entry-content">
                    <?php
                    $total_rating = get_post_meta(get_the_ID(), 'total_rating', true);
                    if ($total_rating) {
                        $rating_out_of_5 = $total_rating / 2;
                        echo '<div class="rating mb-3" style="text-align:left;">';
                        echo '<div class="stars" style="font-size:1.5em; display:flex; gap:2px; justify-content:flex-start;">';
                        $full_stars = floor($rating_out_of_5);
                        $partial = $rating_out_of_5 - $full_stars;
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $full_stars) {
                                echo '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="#ffc107" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                            } elseif ($i == $full_stars && $partial > 0) {
                                $percent = round($partial * 100);
                                echo '<span style="position:relative; display:inline-block; width:1em; height:1em;">';
                                echo '<svg width="1em" height="1em" viewBox="0 0 24 24" style="position:absolute;top:0;left:0;z-index:1;" fill="#ffc107" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="starGrad' . get_the_ID() . $i . '" x1="0" x2="1" y1="0" y2="0"><stop offset="' . $percent . '%" stop-color="#ffc107"/><stop offset="' . $percent . '%" stop-color="#e4e5e9"/></linearGradient></defs><path fill="url(#starGrad' . get_the_ID() . $i . ')" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                                echo '</span>';
                            } else {
                                echo '<svg width="1em" height="1em" viewBox="0 0 24 24" fill="#e4e5e9" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                            }
                        }
                        echo '</div>';
                        echo '<span class="rating-value" style="display:block; text-align:left; font-size:1.1em; color:#444;">' . number_format($rating_out_of_5, 1) . '/5</span>';
                        echo '</div>';
                    }

                    the_content();
                    
                    $meta_fields = [
                        'official_site' => 'Official Site',
                        'year_of_establishment' => 'Year of Establishment',
                        'contact_email' => 'Contact Email',
                        'loyalty' => 'Loyalty Program',
                        'live_casino' => 'Live Casino',
                        'mobile_casino' => 'Mobile Casino',
                        'games' => 'Available Games'
                    ];

                    echo '<h3 class="mt-5">Casino Details</h3>';
                    echo '<table class="table table-bordered table-striped mt-3">';
                    echo '<tbody>';

                    foreach ($meta_fields as $key => $label) {
                        $value = get_post_meta(get_the_ID(), $key, true);
                        if (!empty($value)) {
                            echo '<tr>';
                            echo '<th scope="row" style="width: 30%;">' . esc_html($label) . '</th>';
                            echo '<td>';
                            if ($key === 'official_site') {
                                echo '<a href="' . esc_url($value) . '" target="_blank">' . esc_html($value) . '</a>';
                            } elseif ($key === 'games') {
                                if (is_array($value)) {
                                    $game_titles = array_map(function($game_id) {
                                        return get_the_title($game_id);
                                    }, $value);
                                    echo implode(', ', $game_titles);
                                }
                            } elseif (is_bool($value) || in_array($key, ['loyalty', 'live_casino', 'mobile_casino'])) {
                                echo $value ? 'Yes' : 'No';
                            } else {
                                echo esc_html($value);
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    }

                    echo '</tbody>';
                    echo '</table>';
                    
                    ?>
                </div>

            </article>

        <?php
        endwhile;
        ?>
    </main>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer(); 
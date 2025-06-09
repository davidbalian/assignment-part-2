<?php
/**
 * Template part for displaying posts
 * Markup for a single post item within a WordPress loop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card bg-light mb-4 rounded p-3' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <figure class="d-flex justify-content-center mb-3">
            <div class="post-thumbnail-container rounded-circle overflow-hidden d-flex justify-content-center align-items-center">
                <?php the_post_thumbnail( 'medium', array(
                    'class' => 'img-fluid',
                    'alt' => get_the_title() . ' - Featured Image'
                )); ?>
            </div>
        </figure>
    <?php endif; ?>

    <div class="card-body text-center">
        <header>
            <h2 class="card-title text-dark">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none" rel="bookmark"><?php the_title(); ?></a>
            </h2>
            <p class="card-text">
                <small class="text-muted">
                    <?php echo sprintf(
                        /* translators: %1$s: post date, %2$s: post author */
                        esc_html__( '%1$s by %2$s', 'your-theme-textdomain' ),
                        get_the_time( 'F j, Y' ),
                        get_the_author()
                    ); ?>
                </small>
            </p>
        </header>

        <hr class="my-3 border-secondary-subtle">
        
        <div class="card-text text-start">
            <?php the_excerpt(); ?>
        </div>
        
        <footer class="d-flex justify-content-end">
            <a href="<?php the_permalink(); ?>" class="btn btn-success mt-3 rounded" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'your-theme-textdomain' ), get_the_title() ) ); ?>">
                <?php esc_html_e( 'Read More', 'your-theme-textdomain' ); ?>
            </a>
        </footer>
    </div>
</article>

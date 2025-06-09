<?php
get_header();
?>

<div class="row site-body">
    <main class="col-md-8" role="main">
        <div class="row">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    ?>
                    <div class="col-md-6">
                        <?php
                        get_template_part( 'template-parts/content', get_post_type() );
                        ?>
                    </div>
                    <?php
                endwhile;
            else :
                ?>
                <div class="col-12">
                    <p>No content found.</p>
                </div>
                <?php
            endif;
            ?>
        </div>
    </main>
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
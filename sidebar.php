<aside class="col-md-4 site-sidebar sticky-top sticky-offset">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>

    <!-- Read Next Widget -->
    <section class="widget read-next-widget mb-4">
        <div>
            <h5 class="card-title">Read next...</h5>
            <ul>
                <li><a href="#">Email Encryption Explained</a></li>
                <li><a href="#">Selling a Function of Design</a></li>
                <li><a href="#">It's Hard To Come Up With Dummy Titles</a></li>
                <li><a href="#">Why the Internet is Full of Cats</a></li>
                <li><a href="#">Last Made-Up Headline, I Swear!</a></li>
            </ul>
        </div>
    </section>

    <!-- Tabbed Content Widget: Recent & Popular -->
    <section class="widget tabbed-widget mb-4">
        <div>
            <div class="tabbed-widget-header">Casino Listings</div>
            <ul class="nav nav-tabs" id="casinoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="highest-rated-tab" data-bs-toggle="tab" data-bs-target="#highest-rated" type="button" role="tab">Highest Rated</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="recent-tab" data-bs-toggle="tab" data-bs-target="#recent" type="button" role="tab">Recent</button>
                </li>
            </ul>
            <div class="tab-content" id="casinoTabsContent">
                <div class="tab-pane fade show active" id="highest-rated" role="tabpanel" aria-labelledby="highest-rated-tab">
                    <ul class="tabbed-widget-list">
                        <?php
                        $highest_rated_args = array(
                            'post_type' => 'casino',
                            'posts_per_page' => 3,
                            'meta_key' => 'total_rating',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                        );
                        $highest_rated_query = new WP_Query($highest_rated_args);
                        if ($highest_rated_query->have_posts()) :
                            while ($highest_rated_query->have_posts()) : $highest_rated_query->the_post(); ?>
                                <li class="tabbed-widget-list-item d-flex mb-3">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="tabbed-widget-thumb me-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid rounded')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="tabbed-widget-info">
                                        <a class="tabbed-widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                                        <small class="tabbed-widget-date text-muted">Total Rating: <?php $tr = get_post_meta(get_the_ID(), 'total_rating', true); echo $tr !== '' ? number_format($tr/2, 1) . '/5' : 'N/A'; ?></small>
                                    </div>
                                </li>
                            <?php endwhile; wp_reset_postdata();
                        else : ?>
                            <li class="text-muted">No highly rated casinos found.</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                    <ul class="tabbed-widget-list">
                        <?php
                        $recent_args = array(
                            'post_type' => 'casino',
                            'posts_per_page' => 3,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );
                        $recent_query = new WP_Query($recent_args);
                        if ($recent_query->have_posts()) :
                            while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
                                <li class="tabbed-widget-list-item d-flex mb-3">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="tabbed-widget-thumb me-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid rounded')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="tabbed-widget-info">
                                        <a class="tabbed-widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                                        <small class="tabbed-widget-date text-muted"><?php echo get_the_date('F j, Y'); ?></small>
                                    </div>
                                </li>
                            <?php endwhile; wp_reset_postdata();
                        else : ?>
                            <li class="text-muted">No recent casinos found.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Tags Widget -->
    <section class="widget tags-widget">
        <div>
            <h5 class="tags-widget-title">Tags</h5>
            <div class="tags-widget-list d-flex flex-wrap">
                <?php
                $tags = get_tags(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'hide_empty' => false,
                    'number' => 20
                ));
                
                if ($tags) :
                    foreach ($tags as $tag) : ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-badge m-1 text-decoration-none">
                            <?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach;
                else : ?>
                    <span class="text-muted">No tags found</span>
                <?php endif; ?>
            </div>
        </div>
    </section>
</aside>

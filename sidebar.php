<aside class="col-md-4 site-sidebar sticky-top sticky-offset">
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
            <div class="tabbed-widget-header">Tabbed Content Widget</div>
            <ul class="tabbed-widget-tabs" id="myTab" role="tablist">
                <li class="tabbed-widget-tab" role="presentation">
                    <button class="tabbed-widget-link active" id="recent-tab" data-bs-toggle="tab" data-bs-target="#recent" type="button" role="tab" aria-controls="recent" aria-selected="true">Recent</button>
                </li>
                <li class="tabbed-widget-tab" role="presentation">
                    <button class="tabbed-widget-link" id="popular-tab" data-bs-toggle="tab" data-bs-target="#popular" type="button" role="tab" aria-controls="popular" aria-selected="false">Popular</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                    <ul class="tabbed-widget-list">
                        <?php
                        $recent_query = new WP_Query(array(
                            'posts_per_page' => 3,
                            'post_status' => 'publish',
                        ));
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
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                    <ul class="tabbed-widget-list">
                        <?php
                        $popular_query = new WP_Query(array(
                            'posts_per_page' => 3,
                            'post_status' => 'publish',
                            'orderby' => 'comment_count',
                            'order' => 'DESC',
                        ));
                        while ($popular_query->have_posts()) : $popular_query->the_post(); ?>
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
                        <?php endwhile; wp_reset_postdata(); ?>
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

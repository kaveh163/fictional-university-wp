
<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
            <?php
            $today = date('Ymd');
            $homepageEvents = new WP_Query(
                array(
                    //Default posts_per_pagee is 10
                    'posts_per_page' => 2,
                    'post_type' => 'event',
                    'order' => 'ASC',
                    'orderby' => 'meta_value_num',
                    'meta_key' => 'event_date',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'NUMERIC'
                        )
                    )
                )
            );
            while ($homepageEvents->have_posts()) {
                $homepageEvents->the_post();
                get_template_part('template-parts/content', 'event');
            }
            ?>

            <!-- <div class="event-summary">
                <a class="event-summary__date t-center" href="#">
                    <span class="event-summary__month">Apr</span>
                    <span class="event-summary__day">02</span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="#">Quad Picnic Party</a></h5>
                    <p>Live music, a taco truck and more can found in our third annual quad picnic day. <a href="#"
                            class="nu gray">Learn more</a></p>
                </div>
            </div> -->

            <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>"
                    class="btn btn--blue">View All Events</a></p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
            <?php
            $homepagePosts = new WP_Query(
                array(
                    'posts_per_page' => 2,
                    /*'category_name' => 'awards'
                    'post_type' => 'page'*/
                )
            );
            while ($homepagePosts->have_posts()) {
                $homepagePosts->the_post(); ?>
                <div class="event-summary">
                    <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month">
                            <?php the_time('M'); ?>
                        </span>
                        <span class="event-summary__day">
                            <?php the_time('d'); ?>
                        </span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php
                          the_title(); ?></a>
                        </h5>
                        <p>
                            <?php if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 18);
                            }
                            ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                        </p>
                    </div>
                </div>
            <?php } //use this function for cleaning up and returning to state before custom query (reseting the global and data variables)
            wp_reset_postdata();
            ?>

           

            <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All
                    Blog Posts</a></p>
        </div>
    </div>
</div>
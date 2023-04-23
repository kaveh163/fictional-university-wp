<?php
// name of this file is the name appended with -(post_type). Here for event post type;
// the_ID();
get_header();
while (have_posts()) {
    the_post();
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i
                        class="fa fa-home" aria-hidden="true"></i> All Campuses

                </a> <span class="metabox__main">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>
        <div class="generic-content">
            <?php the_content(); ?>
        </div>
        <?php
        $mapLocation = get_field('map_location');
        ?>
        <div class="acf-map">
            
                <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
                    <h3><?php the_title(); ?></h3>
                    <?php echo $mapLocation['address']; ?>
                </div>
            
        </div>




        <?php

        $relatedPrograms = new WP_Query(
            array(
                //Default posts_per_pagee is 10
                'posts_per_page' => -1,
                'post_type' => 'program',
                'order' => 'ASC',
                'orderby' => 'title',
                'meta_query' => array(
                    array(
                        'key' => 'related_campus',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            )
        );
        if ($relatedPrograms->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Programs Available At This Campus</h2>';
            echo '<ul class="min-list link-list">';
            while ($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post(); ?>
                <li>
                    <a  href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </li>
            <?php }
            echo '</ul>';
        }

        // This function resets the global post object back to the url based query.
        // when using multiple custom queries use the functio below between them.
        wp_reset_postdata();
        

        ?>
    </div>
<?php }
get_footer();
?>
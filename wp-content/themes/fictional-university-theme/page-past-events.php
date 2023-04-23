<?php
// name of this file should be page- followed by the slug of the page created;
get_header(); 
pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events.'
))
?>
<div class="container container--narrow page-section">
    <?php
    $today = date('Ymd');
    // custom query for past events
    $pastEvents = new WP_Query(
        array(
            'paged' => get_query_var('paged', 1),
            // default post per page is 10
            //'posts_per_page' => 1,
            'post_type' => 'event',
            'order' => 'ASC',
            'orderby' => 'meta_value_num',
            'meta_key' => 'event_date',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '<',
                    'value' => $today,
                    'type' => 'NUMERIC'
                )
            )
        )
    );

    while ($pastEvents->have_posts()) {
        $pastEvents->the_post();
        get_template_part('template-parts/content-event');
   }
    // By default paginate_links works with default queries which wordpress makes by its own that are tied to the current url.
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
    ?>

</div>
<?php get_footer();
?>
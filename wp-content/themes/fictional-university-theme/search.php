<?php
// wordpress will use this file (search.php) to display the results of the default traditional search
// get_search_query escapes code into simple text instead of html or javascript that can be executed
get_header();
pageBanner(
    array(
        'title' => 'Search Results',
        'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
    )
)
    ?>
<div class="container container--narrow page-section">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            get_template_part('template-parts/content', get_post_type());
        }
        echo paginate_links();
    } else {
        echo "<h2 class='headline headline--small-plus'>No results match that search</h2>";
    }
    get_search_form();
    ?>

</div>
<?php get_footer();
?>
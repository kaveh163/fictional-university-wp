<?php

pageBanner(
    array(
        'title' => 'Search Results',
        'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'
    )
);
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
        echo '<h2 class="headline headline--small-plus">No results match that search.</h2>';
    }

    //   get_search_form();
    
    ?>
    <form class="search-form" method="get" action="<?php echo esc_url(site_url('/')); ?>">
        <label class="headline headline--medium" for="s">Perform a New Search:</label>
        <div class="search-form-row">
            <input placeholder="What are you looking for?" class="s" id="s" type="search" name="s">
            <input class="search-submit" type="submit" value="Search">
        </div>
    </form>
</div>
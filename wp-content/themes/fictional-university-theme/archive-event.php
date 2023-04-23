<?php
// name of this file is the name appended with -(post_type). Here for event post type;
get_header(); 
pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'See what is going on in our world.'
))
?>
<!-- <div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php //echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            <?php /*if (is_category()) {
             single_cat_title();
             }
             if(is_author()) {
             echo "Posts by "; the_author();
             }
             */?>
            All Events
        </h1>
        <div class="page-banner__intro">
            <p>See what is going on in our world. </p>
        </div>
    </div>
</div> -->
<div class="container container--narrow page-section">
    <?php
    // The query is default wordpress query based on the current url of the page
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content-event');
     }
    echo paginate_links();
    ?>
    <hr class="section-break">
<p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events')?>">Check out our past events archive</a></p>
</div>
<?php get_footer();
?>
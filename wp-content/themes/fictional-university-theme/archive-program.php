<?php
// name of this file is the name appended with -(post_type). Here for event post type;
get_header(); 
pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone. Have a look around.'
))
?>

<div class="container container--narrow page-section">
    <ul class="link-list min-list">
    <?php
    // The query is default wordpress query based on the current url of the page

    while (have_posts()) {
        the_post(); ?>
        <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
    <?php }
    echo paginate_links();
    ?>
    </ul>
    
</div>
<?php get_footer();
?>
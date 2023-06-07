<?php
// name of this file is the name appended with -(post_type). Here for event post type;
get_header();
pageBanner(
    array(
        'title' => 'Our Campuses',
        'subtitle' => 'We have several conveniently located campuses.'
    )
)
    ?>

<div class="container container--narrow page-section">
    <div class="acf-map">
        <?php
        // The query is default wordpress query based on the current url of the page
        
        while (have_posts()) {
            the_post();
            $mapLocation = get_field('map_location');
            ?>
            <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <?php echo $mapLocation['address'];?>
            </div>
        <?php }?>
    </div>

</div>
<?php get_footer();
?>
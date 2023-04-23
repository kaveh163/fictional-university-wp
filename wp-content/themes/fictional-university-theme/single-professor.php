<?php
// name of this file is the name appended with -(post_type). Here for event post type;
get_header();
while (have_posts()) {
    the_post();
    pageBanner();
    ?>
    <div class="container container--narrow page-section">
        <div class="generic-content">
            <div class="row group">
                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait'); ?>
                </div>
                <div class="two-thirds">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <?php
        //Uses 
        $relatedPrograms = get_field('related_programs');
        // print_r($relatedPrograms);
        // $program object variable is of WP_Post type
        //get_the_title can get WP_Post objects
        if ($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
            echo '<ul class="link-list min-list">';
            foreach ($relatedPrograms as $program) { ?>
                <li><a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program); ?></a> </li>

            <?php }
            echo '</ul>';
        }


        ?>
    </div>
<?php }
get_footer();
?>
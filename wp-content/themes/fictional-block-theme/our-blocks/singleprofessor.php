<?php
while (have_posts()) {
    the_post();
    pageBanner();
    ?>
    <div class='container container--narrow page-section'>
        <div class='generic-content'>
            <div class='row group'>
                <div class='one-third'>
                    <?php the_post_thumbnail('professorPortrait');
                    ?>
                </div>
                <div class='two-thirds'>
                    <?php
                    $likeCount = new WP_Query(
                        array(
                            'post_type' => 'like',
                            'meta_query' => array(
                                array(
                                    'key' => 'liked_professor_id',
                                    'comare' => '=',
                                    'value' => get_the_ID()
                                )
                            )
                        )
                    );
                    $existStatus = 'no';
                    if (is_user_logged_in()) {
                        // This query object will only contains results if the current user has liked the professor
                        $existQuery = new WP_Query(
                            array(
                                // if the user isn't logged in '0' is returned from get_current_user_id
                                // Equivalent of not having the 'author' line below 
                                'author' => get_current_user_id(),
                                'post_type' => 'like',
                                'meta_query' => array(
                                    array(
                                        'key' => 'liked_professor_id',
                                        'comare' => '=',
                                        'value' => get_the_ID()
                                    )
                                )
                            )
                        );
                        if ($existQuery->found_posts) {
                            $existStatus = 'yes';
                        }
                    }

                    ?>
                    <span class='like-box' data-like="<?php if (isset($existQuery->posts[0]->ID)) echo $existQuery->posts[0]->ID; ?>" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
                        <i class='fa fa-heart-o' aria-hidden='true'></i>
                        <i class='fa fa-heart' aria-hidden='true'></i>
                        <span class='like-count'>
                            <?php echo $likeCount->found_posts ?>
                        </span>
                    </span>
                    <?php the_content();
                    ?>
                </div>
            </div>
        </div>
        <?php
        //Uses
        $relatedPrograms = get_field('related_programs');
        // print_r( $relatedPrograms );
        // $program object variable is of WP_Post type
        //get_the_title can get WP_Post objects
        if ($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
            echo '<ul class="link-list min-list">';
            foreach ($relatedPrograms as $program) {
                ?>
                <li><a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program);
                   ?></a> </li>

            <?php }
            echo '</ul>';
        }

        ?>
    </div>
<?php }
<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes()
{
    // create restapi endpoints for POST and DELETE likes.
    register_rest_route("university/v1", 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    )
    );
    register_rest_route("university/v1", 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    )
    );
}
// below: the contents the two restapi endpoints return
// register_rest_route provides the $data argument to createLike
// Nonce code should be sent with our javascript code
function createLike($data)
{
    // The user must be logged in to create posts
    if (is_user_logged_in()) {
        $professor = sanitize_text_field($data['professorId']);
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
                        'value' => $professor
                    )
                )
            )
        );
        // check $professor id is for professor post types
        if($existQuery->found_posts == 0  AND get_post_type($professor) == 'professor') {
            return wp_insert_post(
                array(
                    'post_type' => 'like',
                    'post_status' => 'publish',
                    'post_title' => '2nd PHP Test',
                    'meta_input' => array(
                        'liked_professor_id' => $professor
                    )
                )
            );
        } else {
            die('Invalid professor id');
        }
       
    } else {
        die('Only logged in users can create a like.');
    }

}
function deleteLike($data)
{
    $likeId = sanitize_text_field($data['like']);
    // setting the second argument of wp_delete_post to true skips the trash and completely deletes it.
    if(get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like'){
        wp_delete_post($likeId, true);
        return 'Congrats, like deleted.';
    } else {
        die('You do not have permission to delete that.');
    }
}
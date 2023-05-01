<?php
// MU Plugins: Must Use Plugins

function university_post_types()
{
    // Campus Post Type
    register_post_type(
        'campus',
        array(
            //value of capability_type should be unique
            // doesn't need to be the campus post type name
            'capability_type' => 'campus',
            'map_meta_cap' => true,
            //visible to editors and viewers of the website
            'show_in_rest' => true,
            //to use the modern block editor in the supports key add 'editor'
            //if the editor is deleted, the classic editor will show
            'supports' => array('title', 'editor', 'excerpt'),
            'rewrite' => array(
                'slug' => 'campuses'
            ),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Campuses',
                'add_new_item' => 'Add New Campus',
                'edit_item' => 'Edit Campus',
                'all_items' => 'All Campuses',
                'singular_name' => 'Campus'
            ),
            'menu_icon' => 'dashicons-location-alt'
        )
    );

    // Event Post Type
    register_post_type(
        'event',
        array(
            // code below, for telling event post not to behave
            // like blog posts when it comes to permission and
            // capabilities, instead it should have its unique
            // permissions and capabilites
            'capability_type' => 'event',
            // to enforce and require the permissions
            // filter that maps meta capabilities for custom post types 
            // automatically require the event permissions in order to 
            // manage and edit the event posts at the right time.
            'map_meta_cap' => true,
            //visible to editors and viewers of the website
            'show_in_rest' => true,
            //to use the modern block editor in the supports key add 'editor'
            //if the editor is deleted, the classic editor will show
            'supports' => array('title', 'editor', 'excerpt'),
            'rewrite' => array(
                'slug' => 'events'
            ),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Events',
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'
            ),
            'menu_icon' => 'dashicons-calendar'
        )
    );
    // Program Post Type
    register_post_type(
        'program',
        array(
            //visible to editors and viewers of the website
            'show_in_rest' => true,
            //to use the modern block editor in the supports key add 'editor'
            //if the editor is deleted, the classic editor will show
            //editor is main default content field
            'supports' => array('title'),
            'rewrite' => array(
                'slug' => 'programs'
            ),
            'has_archive' => true,
            'public' => true,
            'labels' => array(
                'name' => 'Programs',
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Programs',
                'singular_name' => 'Program'
            ),
            'menu_icon' => 'dashicons-awards'
        )
    );
    // Professor Post Type
    register_post_type(
        'professor',
        array(
            //visible to editors and viewers of the website
            'show_in_rest' => true,
            //to use the modern block editor in the supports key add 'editor'
            //if the editor is deleted, the classic editor will show
            'supports' => array('title', 'editor','thumbnail'),
            'public' => true,
            'labels' => array(
                'name' => 'Professors',
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All Professors',
                'singular_name' => 'Professor'
            ),
            'menu_icon' => 'dashicons-welcome-learn-more'
        )
    );

}
add_action('init', 'university_post_types');
<?php

add_action('rest_api_init', 'universityRegisterSearch');
function universityRegisterSearch() {
    register_rest_route('university/v1', 'search', array(
        //READABLE evaluates to GET in CRUD
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResults'
    ));
}
function universitySearchResults() {
    return 'Congratulations, you created your first route.';
}
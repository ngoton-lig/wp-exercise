<?php
function featured_services() {
    $args = array(
        'post_type' => SERVICES_POST_TYPE,
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
    return new WP_Query($args);
}
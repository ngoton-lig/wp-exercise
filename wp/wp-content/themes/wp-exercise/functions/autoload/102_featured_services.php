<?php
function featured_services() {
    $args = array(
        'post_type' => SERVICES_POST_TYPE,
        'post_status' => 'publish',
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
    return new WP_Query($args);
}
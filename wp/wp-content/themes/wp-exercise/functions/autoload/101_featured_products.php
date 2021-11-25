<?php
function featured_products() {
    $args = array(
        'post_type' => PRODUCTS_POST_TYPE,
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
    return new WP_Query($args);
}
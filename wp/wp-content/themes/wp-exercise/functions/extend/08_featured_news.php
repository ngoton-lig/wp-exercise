<?php
function featured_news() {
    $featured_args = array(
        'post_type' => 'news',
        'meta_key' => '_featured-post',
        'meta_value' => 1,
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
    $featured_query = new WP_Query( $featured_args );
    return $featured_query;
}
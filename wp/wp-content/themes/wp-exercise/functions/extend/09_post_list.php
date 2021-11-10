<?php
function post_list($post_type, $post_number) {
    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $post_number,
        'paged' => get_query_var( 'paged', 1),
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
    $query = new WP_Query( $args );
    return $query;
}
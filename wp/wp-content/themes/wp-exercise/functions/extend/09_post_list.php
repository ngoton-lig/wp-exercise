<?php
function post_list($post_type, $post_number, $taxonomy, $term = null, $year = null) {
    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $post_number,
        'paged' => get_query_var( 'paged', 1),
        'orderby' => 'post_date',
        'order' => 'DESC',
    );
    if ($term) {
        $args['tax_query'] = [[
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => [$term],
        ]];
    }
    if ($year) {
        $args['date_query'] = [[
            'year' => $year,
        ]];
    }
    $query = new WP_Query( $args );
    return $query;
}
<?php
function register_custom_post_type() {
    $args = array(
        'label' => 'News',
        'labels' => array(
            'singular_name' => 'News',
            'menu_name' => 'News',
            'all_items' => 'All news',
            'add_new_item' => 'Add new post',
            'add_new' => 'Add new',
            'new_item' => 'New post',
            'edit_item'=>'Edit post',
            'view_item' => 'View post',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'search_items' => 'Search posts',
        ),

        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        //'map_meta_cap' => true,
        'menu_icon' => 'dashicons-media-document',
        'capability_type' => 'page',
        'rewrite' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),
    );
    register_post_type('news', $args);

    $args = array(
        'label' => 'Events',
        'labels' => array(
            'singular_name' => 'Events',
            'menu_name' => 'Events',
            'all_items' => 'All events',
            'add_new_item' => 'Add new post',
            'add_new' => 'Add new',
            'new_item' => 'New post',
            'edit_item'=>'Edit post',
            'view_item' => 'View post',
            'not_found' => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'search_items' => 'Search posts',
        ),

        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        //'map_meta_cap' => true,
        'menu_icon' => 'dashicons-tickets',
        'capability_type' => 'page',
        'rewrite' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' ),
    );
    register_post_type('events', $args);
}
add_action('init', 'register_custom_post_type');

function register_custom_post_type_taxonomy() {
    $args = array(
        'label' => 'Categories',
        'labels' => array(
            'name' => 'News categories',
            'singular_name' => 'Category',
            'search_items' => 'Search categories',
            'popular_items' => 'Popular categories',
            'all_items' => 'All categories',
            'parent_item' => 'Parent category',
            'edit_item' => 'Edit category',
            'update_item' => 'Update category',
            'add_new_item' => 'Add new category',
            'new_item_name' => 'New category',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'rewrite' => true,
    );
    register_taxonomy('news-category', array('news'), $args );

    $args = array(
        'label' => 'Tags',
        'labels' => array(
            'name' => 'News tags',
            'singular_name' => 'Tag',
            'search_items' => 'Search tags',
            'popular_items' => 'Popular tags',
            'all_items' => 'All tags',
            'parent_item' => 'Parent tag',
            'edit_item' => 'Edit tag',
            'update_item' => 'Update tag',
            'add_new_item' => 'Add new tag',
            'new_item_name' => 'New tag',
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'rewrite' => true,
    );
    register_taxonomy('news-tag', array('news'), $args );


    $args = array(
        'label' => 'Categories',
        'labels' => array(
            'name' => 'Event categories',
            'singular_name' => 'Category',
            'search_items' => 'Search categories',
            'popular_items' => 'Popular categories',
            'all_items' => 'All categories',
            'parent_item' => 'Parent category',
            'edit_item' => 'Edit category',
            'update_item' => 'Update category',
            'add_new_item' => 'Add new category',
            'new_item_name' => 'New category',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'rewrite' => true,
    );
    register_taxonomy('events-category', array('events'), $args );

    $args = array(
        'label' => 'Tags',
        'labels' => array(
            'name' => 'Event tags',
            'singular_name' => 'Tag',
            'search_items' => 'Search tags',
            'popular_items' => 'Popular tags',
            'all_items' => 'All tags',
            'parent_item' => 'Parent tag',
            'edit_item' => 'Edit tag',
            'update_item' => 'Update tag',
            'add_new_item' => 'Add new tag',
            'new_item_name' => 'New tag',
        ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'rewrite' => true,
    );
    register_taxonomy('events-tag', array('events'), $args );
}
add_action('init', 'register_custom_post_type_taxonomy');
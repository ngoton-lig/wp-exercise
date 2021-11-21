<?php

/**
 * Register post_type and taxonomy
 */

add_action('init', 'add_post_type_and_taxonomy');

function add_post_type_and_taxonomy()
{
    $default_post_type_args = array(
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
    );

    $default_term_args = array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
    );

    $args = array_merge($default_post_type_args, array(
        'label' => PRODUCTS_POST_TYPE_LABEL,
        'rewrite' => array('slug' => PRODUCTS_POST_TYPE)
    ));
    register_post_type(PRODUCTS_POST_TYPE, $args);


    $args = array_merge($default_term_args, array(
        'label' => PRODUCTS_TAX_CATEGORY_LABEL,
        'rewrite' => array('slug' => PRODUCTS_TAX_CATEGORY)
    ));
    register_taxonomy(PRODUCTS_TAX_CATEGORY, array(PRODUCTS_POST_TYPE), $args);

    $args = array_merge($default_post_type_args, array(
        'label' => SERVICES_POST_TYPE_LABEL,
        'rewrite' => array('slug' => SERVICES_POST_TYPE)
    ));
    register_post_type(SERVICES_POST_TYPE, $args);


    $args = array_merge($default_term_args, array(
        'label' => SERVICES_TAX_CATEGORY_LABEL,
        'rewrite' => array('slug' => SERVICES_TAX_CATEGORY)
    ));
    register_taxonomy(SERVICES_TAX_CATEGORY, array(SERVICES_POST_TYPE), $args);
}

<?php

add_action('init', 'remove_default_taxonomy', 99);
function remove_default_taxonomy()
{
    global $wp_rewrite;
    if (!empty($wp_rewrite->extra_permastructs["category"])) unset($wp_rewrite->extra_permastructs["category"]);
    if (!empty($wp_rewrite->extra_permastructs["post_tag"])) unset($wp_rewrite->extra_permastructs["post_tag"]);
    unregister_taxonomy_for_object_type('category', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'post');
    return $wp_rewrite;
}

add_filter('rewrite_rules_array', 'delete_default_post_type_rewrite_rules');
function delete_default_post_type_rewrite_rules($rules)
{
    foreach ([
                 '([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$',
                 '([^/]+)/(feed|rdf|rss|rss2|atom)/?$',
                 '([^/]+)/page/?([0-9]{1,})/?$',
                 '([^/]+)/-([0-9]{1,})/?$',
                 '([^/]+)(?:/([0-9]+))?/?$'
             ] as $rule) if (array_key_exists($rule, $rules)) unset($rules[$rule]);
    return $rules;
}

add_action('template_redirect', 'redirect_default_post_type_404');
function redirect_default_post_type_404()
{
    global $wp_query;
    switch (true) {
        case is_post_type_archive('post'):
        case is_category():
        case is_tag():
        case is_singular('post'):
            $wp_query->set_404();
            status_header(404);
            break;
    }
}


add_action('admin_menu', 'hide_default_post_type_menus');
function hide_default_post_type_menus()
{
    remove_menu_page('edit.php');
}
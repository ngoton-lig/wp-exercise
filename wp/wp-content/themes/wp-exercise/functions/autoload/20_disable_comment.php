<?php

/**
 * Disable comment
 */
add_filter('comments_open', '__return_false');

/**
 * Remove comment page rewrite rules
 */
add_action('init', 'remove_comment_rewrite_rule');
function remove_comment_rewrite_rule()
{
    global $wp_rewrite;
    if (!empty($wp_rewrite->comments_base)) unset($wp_rewrite->comments_base);
    if (!empty($wp_rewrite->comments_pagination_base)) unset($wp_rewrite->comments_pagination_base);
    return $wp_rewrite;
}

add_filter('rewrite_rules_array', 'delete_comment_rewrite_rules');
function delete_comment_rewrite_rules($rules)
{
    foreach ([
                 'comments/feed/(feed|rdf|rss|rss2|atom)/?$',
                 'comments/(feed|rdf|rss|rss2|atom)/?$',
                 'comments/embed/?$',
                 'comments/page/?([0-9]{1,})/?$'
             ] as $rule) if (!empty($rules[$rule])) unset($rules[$rule]);
    return $rules;
}

/**
 * Hide comment menu on dashboard menu
 */
add_action('admin_menu', 'hide_comment_menus');
function hide_comment_menus()
{
    remove_menu_page('edit-comments.php');
}

/**
 * Hide comment column on dashboard post list
 */
add_filter('manage_posts_columns', 'customize_admin_manage_posts_comment_column');
function customize_admin_manage_posts_comment_column($columns)
{
    if (!empty($columns['comments'])) unset($columns['comments']);
    return $columns;
}

/**
 * Remove comment menu from admin bar
 */
function remove_comment_bar_menus($wp_admin_bar)
{
    $wp_admin_bar->remove_menu('comments');
}

add_action('admin_bar_menu', 'remove_comment_bar_menus', 200);
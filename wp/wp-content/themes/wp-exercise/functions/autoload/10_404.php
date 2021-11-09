<?php
/**
 * 404 Redirect
 */
add_action('template_redirect', 'redirect_404');
function redirect_404()
{
    global $wp_query;
    switch (true) {
        #case is_post_type_archive('post_type_name'):
        #case is_tax('tax_name'):
        #case is_category():
        #case is_tag():
        #case is_search():
        #case is_date():
        #case is_feed():
        case is_attachment():
        case is_trackback():
        case is_embed():
        case is_author():
            $wp_query->set_404();
            status_header(404);
            break;
    }
}

add_filter('rewrite_rules_array', 'delete_unnecessary_rewrite_rules');
function delete_unnecessary_rewrite_rules($rules)
{
    foreach ($rules as $k => $rule) if (preg_match('/(embed=true|attachment=|tb=1|register=true)/', $rule)) unset($rules[$k]);
    return $rules;
}
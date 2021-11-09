<?php
/**
 * カスタム投稿タイプのpermalinkをpost_nameからpost_idに変更する
 */
//add_action('registered_post_type', 'replace_permalink_from_name_to_id',1);

function replace_permalink_from_name_to_id()
{
    // 変更したい投稿タイプを配列にセット
    $post_types = [
        ''
    ];

    if ( empty($post_types) ) return;

    foreach( $post_types as $pt ) {
        add_action('registered_post_type', function ($post_type) use ($pt) {
            if ($pt === $post_type) {
                add_rewrite_tag("%${pt}_id%", '([0-9]+)', "post_type=${pt}&p=");
                add_permastruct($pt, "${pt}/%${pt}_id%", []);
            }
        }, 10);

        add_filter('post_type_link', function ($post_link, $post) use ($pt) {
            if ($pt === $post->post_type) {
                $post_link = str_replace("%${pt}_id%", $post->ID, $post_link);
            }
            return $post_link;
        }, 10, 2);
    }
}

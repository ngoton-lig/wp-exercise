<?php
if (!function_exists('add_post_thumbnail_no_image')) {
    function add_post_thumbnail_no_image($thumbnail_html) {
        if (!is_single() && empty($thumbnail_html)) {
            return '<img src="'.URL_NO_IMAGE.'">';
        }
        return $thumbnail_html;
    }
}
add_filter('post_thumbnail_html', 'add_post_thumbnail_no_image');

if (!function_exists('add_post_thumbnail_size')) {
    function add_post_thumbnail_size($size)
    {
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'post-thumb', 620, 207, true );
        add_image_size( 'home-thumb', 220, 180, true );
    }
}
add_filter('after_setup_theme', 'add_post_thumbnail_size');
<?php
if (!function_exists('register_menus')) {
    function register_menus() {
        register_nav_menus(
            array(
                'header' => __('Header Menu'),
                'footer'  => __('Footer Menu'),
            )
        );
    }
}
add_action('init', 'register_menus');
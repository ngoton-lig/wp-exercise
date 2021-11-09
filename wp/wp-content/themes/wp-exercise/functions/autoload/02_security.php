<?php

/**
 * Hide PHP version
 */
header_register_callback(function(){
    header_remove('X-Powered-By');
});

/**
 * Hide WP version
 */
remove_action('wp_head', 'wp_generator');

/**
 * Disable auto update
 */
define('AUTOMATIC_UPDATER_DISABLED', true);

/**
 * Disable xmlrpc.php
 */
add_filter('xmlrpc_enabled', '__return_false');

function remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'remove_x_pingback');

/**
 * Disable redirect to wp-login.php
 */
remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );

/**
 * Disable author page
 */
add_filter( 'author_rewrite_rules', '__return_empty_array' );

/**
 * Disable REST API link in HTTP headers
 */
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
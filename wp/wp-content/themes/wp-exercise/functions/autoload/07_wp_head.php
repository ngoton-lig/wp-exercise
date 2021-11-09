<?php

/**
 * Disable emoji
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

/**
 * Hide xmlrpc link
 */
remove_action('wp_head', 'rsd_link');

/**
 * Hide Windows Live Writer manifest link
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Hide short link
 */
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Disable REST API link tag
 */
remove_action('wp_head', 'rest_output_link_wp_head', 10);

/**
 * Disable oEmbed Discovery Links
 */
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

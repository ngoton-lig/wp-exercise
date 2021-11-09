<?php
if (!function_exists('add_new_label_event_post')) {
    function add_new_label_event_post($post) {
        if (!is_single() && get_post_type($post) == 'events') {
            $post_date = get_the_date('Y-m-d', $post);
            $time = date('Y-m-d', strtotime('- 7days'));
            if (strtotime($post_date) > strtotime($time))
                echo '<div class="ribbon"><span class="ribbon__content">New</span></div>';
        }
    }
}
add_action('add_new_label_event_post', 'add_new_label_event_post');
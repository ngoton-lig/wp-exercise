<?php
function add_new_label_service($title, $id) {
    if (get_post_type($id) == SERVICES_POST_TYPE) {
        $latest_post_date = date('Y-m-d', strtotime(get_lastpostdate('blog', 'post')));
        $post_date = get_the_date('Y-m-d', $id);
        if ($post_date == $latest_post_date) {
            $title .= '<div class="ribbon"><span class="ribbon__content">New</span></div>';
        }
    }
    return $title;
}
add_filter('the_title', 'add_new_label_service', 10, 2);
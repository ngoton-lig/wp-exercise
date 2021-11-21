<?php
function add_new_label_product($title, $id) {
    if (get_post_type($id) == PRODUCTS_POST_TYPE) {
        $post_date = get_the_date('Y-m-d', $id);
        $time = date('Y-m-d', strtotime('- 7days'));
        if (strtotime($post_date) > strtotime($time)) {
            $title .= '<div class="ribbon"><span class="ribbon__content">New</span></div>';
        }
    }
    return $title;
}
add_filter('the_title', 'add_new_label_product', 10, 2);
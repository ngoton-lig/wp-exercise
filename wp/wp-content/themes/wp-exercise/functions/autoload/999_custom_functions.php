<?php
function is_new_product() {
    return get_the_date('Y-m-d') >= date('Y-m-d', strtotime('- 7days'));
}

function is_new_service() {
    return get_the_date('Y-m-d') == date('Y-m-d', strtotime(get_lastpostdate('server', SERVICES_POST_TYPE)));
}
<?php
$breadcrumbs = [
    [
        'text' => NAME_HOME,
        'href' => URL_HOME
    ],
    [
        'text' => get_the_title(),
        'href' => null
    ],
];

$page_header = [
    'title' => get_the_title(),
    'modifier' => $post->post_name,
];

get_header();
import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
?>
<?php the_content() ?>
<?php
get_footer();
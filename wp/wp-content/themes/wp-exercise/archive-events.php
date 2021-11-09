<?php
$queried_object = get_queried_object();
$breadcrumbs = [
    [
        'text' => NAME_HOME,
        'href' => URL_HOME
    ],
    [
        'text' => $queried_object->label,
        'href' => null
    ],
];

$page_header = [
    'title' => get_the_title(),
    'modifier' => $post->post_name,
];

get_header();
?>
<main class="l-index">
    <div class="l-container">
        <?php import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>
        <div class="main-content">
            <?php
            import_part('post-list', ['post_type' => 'events', 'is_paging_show' => true]);
            ?>
        </div>
    </div>
</main>
<?php
get_footer();
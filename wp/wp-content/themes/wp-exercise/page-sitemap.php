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
?>
<main class="l-index">
    <div class="l-container">
        <?php import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>
        <div class="main-content">
            Sitemap
        </div>
    </div>
</main>
<?php
get_footer();
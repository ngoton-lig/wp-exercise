<?php
$queried_object = get_queried_object();

$breadcrumbs = [
    [
        'text' => NAME_HOME,
        'href' => URL_HOME
    ],
    [
        'text' => $queried_object->label,
        'href' => get_post_type_archive_link($queried_object->name)
    ],
];

$article = [
    'taxonomy' => 'category',
    'tag_taxonomy' => 'post_tag',
    'modifier' => 'index'
];

get_header();

import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
?>
    <ul class="article-list">
        <?php if (have_posts()) while (have_posts()): the_post(); ?>
            <li class="article-list__item">
                <?php
                import_part('article', array_merge($article, ['post' => $post]));
                ?>
            </li>
        <?php endwhile; ?>
    </ul>
<?php import_part('pagination') ?>
<?php
get_footer();

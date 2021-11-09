<?php
$post_type_object = get_post_type_object($post->post_type);

$breadcrumbs = [
    [
        'text' => NAME_HOME,
        'href' => URL_HOME
    ],
    [
        'text' => $post_type_object->label,
        'href' => get_post_type_archive_link($post->post_type)
    ],
    [
        'text' => get_the_title(),
        'href' => null
    ],
];

$title = get_the_title();
$datetime = get_the_date('Y-m-d H:i:s');
$date = get_the_date('Y.m.d');
$cat = get_first_term(get_the_ID(), $post->post_type . '-category');
$tags = get_the_terms($post, $post->post_type . '-tag');
$modifier = $post->post_type;

get_header();
import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
?>
<div class="single-header">
    <h1 class="single-header__title"><?= $title ?></h1>
    <time class="single-header__time" datetime="<?= $datetime ?>"><?= $date ?></time>
    <?php
    if ($cat) :
    ?>
        <a class="single-header__term href=" <?= get_term_link($cat) ?>"><?= $cat->name ?></a>
    <?php
    endif;
    ?>
    <?php
    if (!empty($tags)) :
        import_part('tag-list', ['tags' => $tags]);
    endif;
    ?>
</div>

<div class="single-body">
    <?= get_the_thumb_with_srcset_webp($post, 'single-body__thumb') ?>
    <?php the_content(); ?>
</div>

<?php import_part('sns-share') ?>

<?php
get_footer();

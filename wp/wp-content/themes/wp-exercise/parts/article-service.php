<?php

/**
 * args:
 * 'post' => WP_Post object,
 * 'taxonomy' => string(Optional)
 * 'tag_taxonomy' => string(Optional)
 */

$default_vars = [
    'post' => $GLOBALS['post'],
    'taxonomy' => '',
    'tag_taxonomy' => '',
];
extract(import_vars_whitelist(get_defined_vars(), $default_vars));

$title = get_the_title();
$datetime = get_the_date('Y-m-d H:i:s', $post);
$date = get_the_date('Y.m.d', $post);
$href = get_permalink($post);
$excerpt = get_the_excerpt();

if ($taxonomy) {
    $cat = get_first_term($post->ID, $taxonomy);
}
if ($tag_taxonomy) {
    $tags = get_the_terms($post, $tag_taxonomy);
}

?>
<article class="<?= get_modified_class('article', $modifier) ?><?= get_additional_class($additional) ?>">
    <a class="article__link" href="<?= $href ?>">
        <?php if(is_new_service()):?>
            <div class="ribbon"><span class="ribbon__content">New</span></div>
        <?php endif; ?>
        <div class="article__thumb">
            <?php the_post_thumbnail('home-thumb') ?>
        </div>
        <div class="article__main">
            <h2 class="article__title">
                <?= $title ?>
            </h2>
            <time class="article__time" datetime="<?= $datetime ?>"><?= $date ?></time>
            <?php
            if (!empty($cat)) :
            ?>
                <a href="<?= get_term_link($cat) ?>">
                    <span class="article__term article__term--<?= $taxonomy ?> article__term--<?= $cat->slug ?>"><?= $cat->name ?></span>
                </a>
            <?php
            endif;
            ?>
            <?php
            if (!empty($tags)) :
                import_part('tag-list', ['tags' => $tags, 'link' => true, 'modifier' => [$tag_taxonomy]]);
            endif;
            ?>
            <p class="article__excerpt">
                <?= $excerpt ?>
            </p>
        </div>
    </a>
</article>
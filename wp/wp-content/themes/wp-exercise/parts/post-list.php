<?php
$default_vars = [
    'post_number' => get_option('posts_per_page'),
    'post_type' => 'post',
    'is_paging_show' => false,
];
extract(import_vars_whitelist(get_defined_vars(), $default_vars));
$article = [
    'taxonomy' => $post_type.'-category',
    'tag_taxonomy' => $post_type.'-tag',
];

global $wp_query;
$wp_query = post_list($post_type, $post_number);

if ($wp_query->have_posts()):
?>
    <ul class="article-list">
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <li class="article-list__item">
                <?php
                import_part('article', array_merge($article, ['post' => $post]));
                ?>
            </li>
        <?php endwhile; ?>
    </ul>
    <?php
    if($is_paging_show) {
        import_part('pagination');
    }
    ?>
<?php
    wp_reset_postdata();
endif;
wp_reset_query();
?>
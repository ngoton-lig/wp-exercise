<?php
$post_type_object = get_post_type_object($post->post_type);
$title = get_the_title();
$datetime = get_the_date('Y-m-d H:i:s');
$date = get_the_date('Y.m.d');
$cat_taxonomy = $post->post_type . '-category';
$tag_taxonomy = $post->post_type . '-tag';
$cat = get_first_term(get_the_ID(), $cat_taxonomy);
$tags = get_the_terms($post, $tag_taxonomy);
$modifier = $post->post_type;

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

get_header();
?>
<main class="l-index">
    <div class="l-container">
        <?php import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>
        <div class="single-header">
            <h1 class="single-header__title"><?= $title ?></h1>
            <time class="single-header__time" datetime="<?= $datetime ?>"><?= $date ?></time>
            <?php the_terms($post, $cat_taxonomy) ?>
            <?php
            if (!empty($tags)) :
                import_part('tag-list', ['tags' => $tags, 'link' => true]);
            endif;
            ?>
        </div>

        <div class="single-body">
            <div class="thumbnail">
                <?php the_post_thumbnail('post-thumb'); ?>
            </div>
            <div class="content">
                <?php the_content(); ?>
            </div>
            <div class="gallery">
                <?php
                $gallery = get_post_meta( get_the_ID(), 'gallery_data', true );

                if ($gallery) :
                ?>
                <ul class="gallery-list">
                    <?php
                    for( $i = 0; $i < count( $gallery['image_url'] ); $i++ ) {
                        if ($gallery['image_url'][$i] ) {
                            echo "<li>";
                            echo "<span>".$gallery['image_desc'][$i]."</span>";
                            echo "<img width='50' height='50' src='".$gallery['image_url'][$i]."' />";
                            echo "</li>";
                        }
                    }
                    ?>
                </ul>
                <?php
                endif;
                ?>
            </div>
            <div class="author">
                <span class="author__name"><?php the_author() ?></span>
                <picture class="author__image">
                    <?= get_avatar( get_the_author_meta( 'ID' ), 32 ) ?>
                </picture>
            </div>
            <div class="related-post">
                <?php
                    if($cat) :
                        $query_args = array(
                            'post_type'      => $post->post_type,
                            'post__not_in'    => array(get_the_ID()),
                            'posts_per_page'  => '3',
                            'tax_query' => [
                                [
                                    'taxonomy' => $cat_taxonomy,
                                    'terms' => $cat->term_id,
                                ],
                            ],
                        );

                        $related_cats_post = new WP_Query( $query_args );

                        if($related_cats_post->have_posts()): ?>
                            <h3 class="related-post__title">Related posts</h3>
                            <ul class="article-list">
                                <?php while ($related_cats_post->have_posts()) : $related_cats_post->the_post(); ?>
                                    <li class="article-list__item">
                                        <?php
                                        import_part('article', ['post' => $post]);
                                        ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                <?php
                        wp_reset_postdata();
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();

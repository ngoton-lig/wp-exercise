<?php
extract(import_vars_whitelist(get_defined_vars()));
?>

<section class="<?= get_modified_class('featured-news', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="l-container">
        <a href="/news"><h2 class="news-heading">FEATURED NEWS</h2></a>
        <?php
        $featured_query = featured_news();

        if ($featured_query->have_posts()):
        ?>
            <ul class="article-list">
                <?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
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
        ?>
    </div>
</section>
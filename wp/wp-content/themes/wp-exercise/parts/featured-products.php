<?php
extract(import_vars_whitelist(get_defined_vars()));
?>

<section class="<?= get_modified_class('featured-products', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="l-container">
        <a href="/products"><h2 class="featured-products-heading">FEATURED PRODUCTS</h2></a>
        <?php
        $featured_query = featured_products();

        if ($featured_query->have_posts()):
            if ($featured_query->post_count >= 3):
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
            endif;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>
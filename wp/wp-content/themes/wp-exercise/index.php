<?php
get_header();
?>
<main class="l-index">
    <div class="l-index-featured-products-section">
        <?php import_part('featured-products') ?>
    </div>
    <div class="l-index-featured-services-section">
        <?php import_part('featured-services') ?>
    </div>
</main>
<?php
get_footer();

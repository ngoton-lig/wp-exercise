<?php
get_header();
?>
<main class="l-index">
    <div class="l-index-featured-news-section">
        <?php import_part('featured-news') ?>
    </div>
    <div class="l-index-news-section">
        <?php import_part('news') ?>
    </div>
    <div class="l-index-event-section">
        <?php import_part('event') ?>
    </div>
</main>
<?php
get_footer();

<?php
extract(import_vars_whitelist(get_defined_vars()));
?>

<section class="<?= get_modified_class('news', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="l-container">
        <a href="/news"><h2 class="news-heading">NEWS</h2></a>
        <?php
        import_part('post-list', ['post_number' => 3, 'post_type' => 'news']);
        ?>
    </div>
</section>
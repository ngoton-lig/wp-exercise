<?php
extract(import_vars_whitelist(get_defined_vars()));
?>

<section class="<?= get_modified_class('event', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="l-container">
        <a href="/events"><h2 class="event-heading">EVENTS</h2></a>
        <?php
        import_part('post-list', ['post_number' => 3, 'post_type' => 'events']);
        ?>
    </div>
</section>
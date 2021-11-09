<?php

/**
 * args:
 * 'breadcrumbs' => Array,
 */

$default_vars = [
    'breadcrumbs' => [],
];
extract(import_vars_whitelist(get_defined_vars(), $default_vars));

if (!count($breadcrumbs)) return;
?>
<nav class="<?= get_modified_class('breadcrumbs', $modifier) ?><?= get_additional_class($additional) ?>">
    <ol class="breadcrumbs__list">
    <?php
    foreach ($breadcrumbs as $k => $b) :
    ?>
        <li class="breadcrumbs__item<?php if (count($breadcrumbs) === $k + 1) echo ' is-last' ?>">
            <?php
            if (count($breadcrumbs) > $k + 1) :
            ?>
                <a class="breadcrumbs__link" href="<?= $b['href'] ?>">
                    <?= $b['text'] ?>
                </a>
            <?php
            else :
            ?>
                <span class="breadcrumbs__link">
                    <?= $b['text'] ?>
                </span>
            <?php
            endif;
            ?>
        </li>
    <?php
    endforeach;
    ?>
    </ol>
</nav>
<?php

/**
 * args:
 * 'text' => 'もっと見る',
 * 'href' => URL_HOME,
 * 'is_blank' => bool,
 */

$default_vars = [
    'text' => 'ボタンのテキスト',
    'href' => '#',
    'is_blank' => false,
];
extract(import_vars_whitelist(get_defined_vars(), $default_vars));
?>
<div class="<?= get_modified_class('button', $modifier) ?><?= get_additional_class($additional) ?>">
    <a class="button__link" href="<?= $href ?>" <?= is_blank($is_blank) ?>>
        <span class="button__text">
            <?= $text ?>
        </span>
    </a>
</div>
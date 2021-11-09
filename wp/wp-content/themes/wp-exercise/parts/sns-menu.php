<?php
extract(import_vars_whitelist(get_defined_vars()));
$sns = [
    'twitter',
    'facebook',
    'instagram',
    'youtube',
    'linked_in',
    'hatebu',
    'pinterest'
];
?>
<nav class="<?= get_modified_class('sns-menu', $modifier) ?><?= get_additional_class($additional) ?>">
    <ul class="sns-menu__list">
        <?php foreach ($sns as $s) : ?>
            <li class="sns-menu__item">
                <a class="sns-menu__link" href="<?= constant(strtoupper('URL_' . $s)) ?>" <?= is_blank(true) ?>>
                    <div class="sns-menu__svg">
                        <?= get_svg_sprite('icon-' . $s) ?>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
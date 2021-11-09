<?php
extract(import_vars_whitelist(get_defined_vars()));
$menu_items = wp_get_nav_menu_items('footer');
$menu_items = $menu_items ? $menu_items : [];
$menu = [];
foreach ($menu_items as $menu_item) {
    $menu[$menu_item->ID] = [];
    $menu[$menu_item->ID]['text'] = $menu_item->title;
    $menu[$menu_item->ID]['href'] = $menu_item->url;
}
?>
<nav class="<?= get_modified_class('footer-menu', $modifier) ?><?= get_additional_class($additional) ?>">
    <ul class="footer-menu__list">
        <?php foreach ($menu as $m) : ?>
            <li class="footer-menu__item">
                <a class="footer-menu__link
                            <?php if (array_key_exists('modifier', $m)) echo get_modified_class('footer-menu__link', $m['modifier']) ?>" href="<?= $m['href'] ?>" <?php if (array_key_exists('is-blank', $m)) echo is_blank($m['is-blank']) ?>>
                    <span class="footer-menu__text">
                        <?= $m['text'] ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
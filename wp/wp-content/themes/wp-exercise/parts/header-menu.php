<?php
extract(import_vars_whitelist(get_defined_vars()));
$menu_items = wp_get_nav_menu_items('header');
$menu_items = $menu_items ? $menu_items : [];
$menu = [];
foreach ($menu_items as $menu_item) {
    $menu[$menu_item->ID] = [];
    $menu[$menu_item->ID]['text'] = $menu_item->title;
    $menu[$menu_item->ID]['href'] = $menu_item->url;
    $menu[$menu_item->ID]['is-current'] = is_page($menu_item->object_id) || is_singular($menu_item->object);
}
?>
<nav id="header-menu" class="<?= get_modified_class('header-menu', $modifier) ?><?= get_additional_class($additional) ?>">
    <ul class="header-menu__list">
        <?php foreach ($menu as $m) : ?>
            <li class="header-menu__item">
                <a class="header-menu__link
                                <?php if (array_key_exists('modifier', $m)) echo get_modified_class('header-menu__link', $m['modifier']) ?>
                                <?php if (array_key_exists('is-current', $m)) echo is_current($m['is-current']) ?>" href="<?= $m['href'] ?>" <?php if (array_key_exists('is-blank', $m)) echo is_blank($m['is-blank']) ?>>
                    <span class="header-menu__text">
                        <?= $m['text'] ?>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
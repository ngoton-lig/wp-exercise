<?php
extract(import_vars_whitelist(get_defined_vars()));
$title_tag = is_front_page() ? 'h1' : 'span';
?>

<header id="header" class="<?= get_modified_class('header', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="header__main l-container">
        <<?= $title_tag ?> class="header__title">
            <a class="header__title-link" href="<?= URL_HOME ?>">
                <span class="header__title-logo">
                    <?= get_svg_img('logo', ['class' => 'header-title__logo-image', 'base64' => true, 'alt' => NAME_SITE]) ?>
                </span>
            </a>
        </<?= $title_tag ?>>
        <?php import_part('header-menu', array('additional'=> 'is-pc-show')) ?>
        <?php import_part('hamburger', array('additional'=> 'is-sp-show')) ?>
    </div>
</header>
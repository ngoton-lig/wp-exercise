<?php

/**
 * 'tags' => array,
 * 'link' => bool,
 */
$default_vars = [
    'cats' => [],
    'link' => false,
];
extract(import_vars_whitelist(get_defined_vars(), $default_vars));

if (!count($cats)) return;
?>
<div class="<?= get_modified_class('cat-list', $modifier) ?><?= get_additional_class($additional) ?>">
    <ul class="cat-list__list">
        <?php
        foreach ($cats as $cat) :
        ?>
            <li class="cat-list__item">
                <?php
                if (!empty($link)) :
                ?>
                    <a class="cat-list__link" href="<?= get_term_link($cat) ?>">
                        <span class="cat-list__text">
                            <?= $cat->name ?>
                        </span>
                    </a>
                <?php
                else :
                ?>
                    <span class="cat-list__text">
                        <?= $cat->name ?>
                    </span>
                <?php
                endif;
                ?>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
</div>
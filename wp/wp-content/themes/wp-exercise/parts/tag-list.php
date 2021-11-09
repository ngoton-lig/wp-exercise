<?php

/**
 * 'tags' => array,
 * 'link' => bool,
 */
$default_vars = [
    'tags' => [],
    'link' => false,
];
extract(import_vars_whitelist(get_defined_vars(), $default_vars));

if (!count($tags)) return;
?>
<div class="<?= get_modified_class('tag-list', $modifier) ?><?= get_additional_class($additional) ?>">
    <ul class="tag-list__list">
        <?php
        foreach ($tags as $tag) :
        ?>
            <li class="tag-list__item">
                <?php
                if (!empty($link)) :
                ?>
                    <a class="tag-list__link" href="<?= get_term_link($tag) ?>">
                        <span class="tag-list__text">
                            <?= $tag->name ?>
                        </span>
                    </a>
                <?php
                else :
                ?>
                    <span class="tag-list__text">
                        <?= $tag->name ?>
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
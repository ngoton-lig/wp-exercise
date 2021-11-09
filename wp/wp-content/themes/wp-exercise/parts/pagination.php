<?php
extract(import_vars_whitelist(get_defined_vars()));

$range = 2;
$min_number = 5;
$add_first_and_last = true;

$pagination_array = get_pagination_array($range, $add_first_and_last);

if (!$pagination_array) return;
?>
<nav id="pagination" class="<?= get_modified_class('pagination', $modifier) ?><?= get_additional_class($additional) ?>">
    <ul class="pagination__list">
        <?php
        if ($pagination_array['prev']) :
        ?>
            <li class="pagination__item pagination__item--prev">
                <a class="pagination__link pagination__arrow pagination__arrow--prev" href="<?= get_pagenum_link($pagination_array['prev']) ?>">
                    <?= get_svg_sprite('icon-angle') ?>
                </a>
            </li>
        <?php
        endif;

        foreach ($pagination_array['numbers'] as $k => $i) :
        ?>
            <li class="pagination__item">
                <?php if ($i !== $pagination_array['current']) : ?>
                    <a class="pagination__link pagination__number" href="<?= get_pagenum_link($i) ?>">
                        <?= $i ?>
                    </a>
                <?php else : ?>
                    <span class="pagination__link pagination__number is-current">
                        <?= $i ?>
                    </span>
                <?php endif; ?>
            </li>
            <?php
            if (
                $add_first_and_last &&
                array_key_exists($k + 1, $pagination_array['numbers']) &&
                $pagination_array['numbers'][$k + 1] - $i > 1
            ) :
            ?>
                <li class="pagination__item">
                    <span class="pagination__leader">
                        ...
                    </span>
                </li>
            <?php
            endif; ?>
        <?php
        endforeach;

        if ($pagination_array['next']) :
        ?>
            <li class="pagination__item pagination__item--next">
                <a class="pagination__link pagination__arrow pagination__arrow--next" href="<?= get_pagenum_link($pagination_array['next']) ?>">
                    <?= get_svg_sprite('icon-angle') ?>
                </a>
            </li>
        <?php
        endif;
        ?>
    </ul>
</nav>
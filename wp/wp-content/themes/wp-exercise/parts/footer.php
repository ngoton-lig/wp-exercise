<?php
extract(import_vars_whitelist(get_defined_vars()));
?>
<footer id="footer" class="<?= get_modified_class('footer', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="footer__main l-container">
        <div class="footer__copy">
            <div class="footer__logo">
                <?= get_svg_sprite('logo') ?>
            </div>
            <small class="footer__copy-text">
                &copy; <?= the_time('Y') ?> All Rights Reserved.
            </small>
        </div>
        <?php import_part('footer-menu') ?>
    </div>
</footer>
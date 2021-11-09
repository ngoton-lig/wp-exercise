<?php
extract(import_vars_whitelist(get_defined_vars()));
?>
<button id="hamburger" class="<?= get_modified_class('hamburger', $modifier) ?><?= get_additional_class($additional) ?>">
    <div class="hamburger__main">
        <div class="hamburger__line hamburger__line--1"></div>
        <div class="hamburger__line hamburger__line--2"></div>
        <div class="hamburger__line hamburger__line--3"></div>
    </div>
</button>
<?php
foreach (glob(TEMPLATEPATH . '/functions/autoload/*.php') as $file) {
    require_once $file;
}

foreach (glob(TEMPLATEPATH . '/functions/class/*.php') as $file) {
    require_once $file;
}

foreach (glob(TEMPLATEPATH . '/functions/config/*.php') as $file) {
    require_once $file;
}

foreach (glob(TEMPLATEPATH . '/functions/extend/*.php') as $file) {
    require_once $file;
}
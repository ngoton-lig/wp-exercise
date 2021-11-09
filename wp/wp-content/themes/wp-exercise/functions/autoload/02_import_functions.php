<?php

/**
 * Import templates
 */
function import_template($tpl, $vars = array())
{
    $tpl = ltrim($tpl, '/') . '.php';
    $path = locate_template(array($tpl));
    if (empty($path)) {
        throw new LogicException("Cannot locate the template '$tpl'.");
    }
    extract($vars);
    include $path;
}

function import_part($tpl, $vars = array())
{
    import_template('parts/' . ltrim($tpl, '/'), $vars);
}

/**
 * $whitelistのキーは変数名、値はデフォルト値
 */
function import_vars_whitelist(array $vars, array $whitelist = [])
{
    $default_whitelist = [
        'modifier' => '',
        'additional' => '',
    ];
    $whitelist = array_merge($whitelist, $default_whitelist);
    $rtn = [];
    foreach ($whitelist as $k => $default_value) {
        $rtn[$k] = (array_key_exists($k, $vars)) ? $vars[$k] : $whitelist[$k];
    }
    return $rtn;
}

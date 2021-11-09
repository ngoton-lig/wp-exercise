<?php

/**
 * MW WP Formの各要素を置換する際に使用
 *
 * wp-content/plugins/mw-wp-form/classes/models/class.form.php
 * _render()内にあるlocate_templateによって呼び出される
 *
 * Usage
 * テーマディレクトリにmw-wp-form/form-fieldsディレクトリを設置
 * 必要な要素のファイル（mwform_selectならselect.php）を作成し、lig_mw_input_html_filter(basename(__FILE__, ".php"), get_defined_vars());の１行を記述
 * classにlig_mw_callback_xxを指定するとコールバック関数が有効化される
 *
 */
function lig_mw_input_html_filter($type, $attr = [])
{
    $path = WP_PLUGIN_DIR . '/mw-wp-form/templates/form-fields/' . $type . '.php';


    if (!is_file($path)) {
        throw new Exception('MW WP Form template does not exit');
        return;
    }

    extract($attr);

    $classes = (empty($fields)) ? $class : $fields[0]['class'];

    if (isset($classes)) foreach (explode(' ', $classes) as $cl) if (strpos($cl, 'lig_mw_callback_') === 0 && function_exists($cl)) {
        $callbacks[] = $cl;
        $class = preg_replace('/' . $cl . '/', '', $class);
    }

    ob_start();
    include($path);
    $buffer = ob_get_contents();
    ob_end_clean();

    if (!empty($callbacks)) {
        foreach ($callbacks as $callback) $buffer = $callback($buffer);
    }

    echo $buffer;
}

function lig_mw_callback_required($html)
{
    return preg_replace('/^<(\S+?) /', '<$1 required ', $html);
}

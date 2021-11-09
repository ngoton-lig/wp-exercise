<?php

if (wp_get_environment_type() === 'local') {
    add_action('acf/update_field_group', 'lig_acf_auto_export');
    add_action('acf/untrash_field_group', 'lig_acf_auto_export');
    add_action('acf/trash_field_group', 'lig_acf_auto_export');
    add_action('acf/delete_field_group', 'lig_acf_auto_export');
    add_action('acf/include_fields', 'lig_acf_auto_export');
} else {
    //メニュー非表示
    add_action('admin_menu', function () {
        remove_menu_page('edit.php?post_type=acf-field-group');
    }, 999);
}

function lig_acf_auto_export()
{
    $selected = [];

    /**
     * quote from
     * class-acf-admin-tool-export.php
     * function html_field_selection()
     */
    $field_groups = acf_get_field_groups();
    // loop
    if ($field_groups) {
        foreach ($field_groups as $field_group) {
            //modified
            $selected[] = esc_html($field_group['key']);
        }
    }

    /**
     * quote from
     * class-acf-admin-tool-export.php
     * function get_selected
     */
    $json = array();

    // bail early if no keys
    if (!$selected) return false;


    // construct JSON
    foreach ($selected as $key) {

        // load field group
        $field_group = acf_get_field_group($key);


        // validate field group
        if (empty($field_group)) continue;


        // load fields
        $field_group['fields'] = acf_get_fields($field_group);


        // prepare for export
        $field_group = acf_prepare_field_group_for_export($field_group);


        // add to json array
        $json[] = $field_group;
    }


    /**
     * quote from
     * class-acf-admin-tool-export.php
     * function html_generate
     */

    $str_replace = array(
        "  " => "\t",
        "'!!__(!!\'" => "__('",
        "!!\', !!\'" => "', '",
        "!!\')!!'" => "')",
        "array (" => "array("
    );
    $preg_replace = array(
        '/([\t\r\n]+?)array/' => 'array',
        '/[0-9]+ => array/' => 'array'
    );

    // add condition local or not
    $data = "<?php if( strpos(\$_SERVER['HTTP_HOST'], 'localhost') !== 0 && function_exists('acf_add_local_field_group') ):" . "\r\n" . "\r\n";

    foreach ($json as $field_group) {

        // code
        $code = var_export($field_group, true);


        // change double spaces to tabs
        $code = str_replace(array_keys($str_replace), array_values($str_replace), $code);


        // correctly formats "=> array("
        $code = preg_replace(array_keys($preg_replace), array_values($preg_replace), $code);


        // echo
        $data .= "acf_add_local_field_group({$code});" . "\r\n" . "\r\n";
    }

    $data .= "endif;";

    if (is_writable(__DIR__)) {
        file_put_contents(__DIR__ . '/99_acf_setting.php', $data);
    }
}

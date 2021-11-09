<?php

add_action('admin_init', 'lig_admin_utility');

function lig_admin_utility()
{
    /**
     * Hide dashboard menu items
     */
    function lig_wp_remove_menus()
    {
        remove_menu_page('upload.php');
        if (!is_super_admin()) {
            remove_menu_page('tools.php');
            remove_submenu_page('index.php', 'update-core.php');
        }
    }
    add_action('admin_menu', 'lig_wp_remove_menus');

    /**
     * Disable quick edit
     */
    function hide_quickedit($actions)
    {
        unset($actions['inline hide-if-no-js']);
        return $actions;
    }
    add_filter('post_row_actions', 'hide_quickedit');
    add_filter('page_row_actions', 'hide_quickedit');

    /**
     * Remove Dashboard Widgets
     */
    function remove_dashboard_widgets()
    {
        remove_action('welcome_panel', 'wp_welcome_panel'); // ようこそ
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // 概要
        //remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // アクティビティ
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // クイックドラフト
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPressニュース
        remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // サイトヘルスステータス
    }
    add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

    /**
     * Modify admin footer credit
     */
    function modify_admin_footer_credit()
    {
        echo ' <a href="https://liginc.co.jp" target="_blank">Powered by LIG inc</a>';
    }
    add_filter('admin_footer_text', 'modify_admin_footer_credit');
}
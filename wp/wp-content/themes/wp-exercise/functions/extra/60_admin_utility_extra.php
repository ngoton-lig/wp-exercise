<?php

/**
 * Add Custom Dashboard Widget
 */
function add_custom_widget()
{
    wp_add_dashboard_widget('custom_widget', 'Title', function () {
        echo <<<EOF
/* Type widget content here */
EOF;

    });
}
//add_action( 'wp_dashboard_setup', 'add_custom_widget' );

/**
 * ログイン画面のスタイルシートを変更する場合に利用します。
 */
function lig_wp_change_admin_css()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/custom-login-page.css" />';
}
//add_action( 'login_head', 'lig_wp_change_css_admin' );

/**
 * ログインメッセージを変更する場合に利用します。
 *
 * @param object $wp_admin_bar
 */
function lig_wp_replace_hello_text($wp_admin_bar)
{
    $my_account = $wp_admin_bar->get_node('my-account');
    $newtitle = str_replace('こんにちは、', 'お疲れさまです！', $my_account->title);
    $wp_admin_bar->add_menu(array(
        'id' => 'my-account',
        'title' => $newtitle,
        'meta' => false,
    ));
}
//add_filter( 'admin_bar_menu', 'lig_wp_replace_hello_text', 25 );
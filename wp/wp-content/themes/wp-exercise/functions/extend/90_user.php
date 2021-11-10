<?php
function remove_menus(){
    if (!is_super_admin() && !is_user_admin()) {
        remove_menu_page('upload.php');
        remove_menu_page( 'edit.php?post_type=page' );
        remove_menu_page('themes.php');
        remove_menu_page('plugins.php');
        remove_menu_page('user-new.php');
        remove_menu_page('users.php');
        remove_menu_page('tools.php');
        remove_menu_page('options-general.php');
        remove_submenu_page('index.php', 'update-core.php');
    }
}
add_action( 'admin_menu', 'remove_menus' );
<?php
add_action('admin_init', function () {
    global $pagenow;
    if (!is_blog_admin() || wp_get_environment_type() === 'local' || $pagenow !== 'index.php') {
        return;
    }
    $err = [];
    $err = array_merge(
        $err,
        lig_admin_user_name_check(),
        lig_404_check(),
        lig_noindex_check(),
        lig_wp_debug_check(),
        lig_wpform_debug_check(),
        lig_basic_auth_check(),
        lig_wp_config_check(),
        lig_salt_check(),
        lig_uploads_is_writerble_check(),
        lig_htaccess_check()
    );
    if (!empty($err)) {
        add_action('admin_notices', function () use ($err) {
            echo '<style>#wpadminbar,#wpwrap,#adminmenuback,#adminmenuwrap,#adminmenu,.wp-submenu,.wp-has-current-submenu{background-color:red !important;}</style><div class="notice notice-error"><h2>重大なエラーがあります。リリース前に修正してください。</h2><ul>';
            foreach ($err as $e) {
                echo '<li>' . $e . '</li>';
            }
            echo '</ul></div>';
        });
    }
});

function lig_get_development_msg()
{
    return "開発環境の場合はwp-config.phpに`define('WP_ENVIRONMENT_TYPE', 'development');`(または'local')を追記してください。";
}

// admin、rootユーザーの存在チェック
function lig_admin_user_name_check()
{
    $users = get_users();
    $rtn = [];
    if (!empty($users)) foreach ($users as $user) {
        if (in_array($user->data->user_login, ['admin', 'root'])) {
            $rtn[] = 'ユーザー「<strong>' . $user->data->user_login . '</strong>」が存在します。削除してください。';
        }
    }
    return $rtn;
}

// 404ページのテンプレートファイルチェック
function lig_404_check()
{
    return (!file_exists(STYLESHEETPATH . '/404.php')) ? ['404ページのテンプレートファイルが存在しません。'] : [];
}

// noindexチェック
function lig_noindex_check()
{
    return (!in_array(wp_get_environment_type(), ['local', 'development']) && get_option('blog_public') === "0") ? ['noindexからチェックを外してください' . lig_get_development_msg()] : [];
}

// WP_DEBUGチェック
function lig_wp_debug_check()
{
    return (WP_DEBUG === true) ? ['WP_DEBUGをfalseにしてください。'] : [];
}

// MWFORM_DEBUGチェック
function lig_wpform_debug_check()
{
    return (defined('MWFORM_DEBUG') && MWFORM_DEBUG === true) ? ['MWFORM_DEBUGをfalseにしてください。'] : [];
}

// BASIC認証チェック
function lig_basic_auth_check()
{
    $rtn = [];
    if (in_array(wp_get_environment_type(), ['local', 'development'])) {
        return $rtn;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URL_HOME);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    if (!empty($info['http_code']) && $info['http_code'] === 401) {
        $rtn[] = 'Basic認証がかかっています。' . lig_get_development_msg();
    }
    return $rtn;
}

// wp-config.phpのパーミッションチェック
function lig_wp_config_check()
{
    $rtn = [];
    if (file_exists(ABSPATH . 'wp-config-sample.php')) {
        $rtn[] = 'wp-config-sample.phpが存在しています。削除してください。';
    }
    if (file_exists(ABSPATH . 'wp-config.php') && !in_array(substr(sprintf('%o', fileperms(ABSPATH . 'wp-config.php')), -4), ['0400', '600'])) {
        $rtn[] = 'wp-config.phpのパーミッションを400または600に設定してください。';
    }
    return $rtn;
}

// saltチェック
function lig_salt_check()
{
    $keys = [
        'AUTH_KEY',
        'SECURE_AUTH_KEY',
        'LOGGED_IN_KEY',
        'NONCE_KEY',
        'AUTH_SALT',
        'SECURE_AUTH_SALT',
        'LOGGED_IN_SALT',
        'NONCE_SALT'
    ];
    foreach ($keys as $key) {
        if (!(defined($key) && !empty(constant($key)) && constant($key) !== 'put your unique phrase here')) {
            return ['wp-config.phpにsaltsを定義してください。ユニークな値を<a href="https://api.wordpress.org/secret-key/1.1/salt/" target="_blank">こちら</a>から取得できます。'];
        }
    }
    return [];
}

// uploads書き込み可否チェック
function lig_uploads_is_writerble_check()
{
    $uploads = wp_upload_dir();
    return (!is_writable($uploads['basedir'])) ? ['uploadsディレクトリの書き込み権限がありません。'] : [];
}

// .htaccess権限チェック
function lig_htaccess_check()
{
    global $is_apache;
    return ($is_apache && file_exists(ABSPATH . '.htaccess') && !in_array(substr(sprintf('%o', fileperms(ABSPATH . 'wp-config.php')), -4), ['604', '606'])) ? ['.htaccessのパーミッションを604または606に設定してください。'] : [];
}

<?php
/**
 * ログイン画面のスタイルシートを変更する場合に利用します。
 */
add_action('login_head', function () {
    $logo = URL_COMPANY_LOGO;
    $bg = URL_IMAGES . 'login.jpg';
    $key_color = KEY_COLOR;
    echo <<<EOF
        <style>
        .login {
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url($bg);
        background-size: cover;
        background-position: center center;
        position: relative;
        }
        #login {
        background: rgba(255,255,255,0.8);
        padding: 36px 18px;
        border-radius: 15px;
        box-shadow: 2px 4px 8px rgba(0,0,0,.25);
        }
        #login h1 a {
        background-image: url($logo);
        background-size: contain;
        width: 100%;
        height: auto;
        margin-bottom: 0;
        }
        .login form {
        border: none;
        background: transparent;
        box-shadow: none;
        margin-top: 0;
        padding-bottom: 0;
        padding-top: 20px;
        }
        .forgetmenot {
        float: none;
        }
        .login .button-primary {
        float: none;
        width: 100%;
        margin-top: 16px;
        height: 48px;
        background: $key_color;
        border-color: #888888;
        filter: brightness(100%);
        transition: filter ease 0.8s;
        }
        .login .button-primary:hover {
        filter: brightness(138%);
        transition: filter ease 0.6s;
        background: $key_color;
        border-color: #888888;
        }
        #backtoblog {
        display: none;;
        }
        .login #nav {
        text-align: right;
        margin-top: 16px;
        }
        .dashicons-visibility:before {
        color: $key_color;
        }
        input[type=checkbox]:focus, input[type=color]:focus, input[type=date]:focus, input[type=datetime-local]:focus, input[type=datetime]:focus, input[type=email]:focus, input[type=month]:focus, input[type=number]:focus, input[type=password]:focus, input[type=radio]:focus, input[type=search]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=time]:focus, input[type=url]:focus, input[type=week]:focus, select:focus, textarea:focus {
            border-color: $key_color;
        }
        .login #login_error {
        margin-bottom: 0;
        margin-top:  16px;
        }
        .login_copy {
        position:absolute;
        right: 20px;
        bottom: 16px;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0,0,0,.5);
        font-weight: 500;
        font-size: 14px;
        letter-spacing: .06em;
        }
        .login_copy a {
        color: #ffffff;
        }
</style>
<p class="login_copy"><a href="https://liginc.co.jp/">Powered by LIG Inc</a>.</p>
EOF;
});

add_filter('login_headerurl', function ($url) {
    return URL_HOME;
});
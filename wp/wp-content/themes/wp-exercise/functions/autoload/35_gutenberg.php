<?php

add_filter('allowed_block_types', 'block_types_white_list');
function block_types_white_list($allowed_block_types)
{
    $allowed_block_types = [
        // 一般ブロック
        'core/paragraph', // 段落
        'core/heading', // 見出し
        'core/image', // 画像
        'core/quote', // 引用
//        'core/gallery', // ギャラリー
        'core/list', // リスト
//        'core/audio', // 音声
//        'core/cover', // カバー
        'core/file', // ファイル
//        'core/video', // 動画

        // フォーマット
//        'core/code', // ソースコード
//        'core/freeform', // クラシック
//        'core/html', // カスタムHTML
//        'core/preformatted', // 整形済み
//        'core/pullquote', // プルクオート
        'core/table', // テーブル
//        'core/verse', // 詩

        // レイアウト要素
//        'core/buttons', // ボタン
        'core/columns', // カラム
//        'core/media-text', // メディアと文章
//        'core/more', // 続きを読む
//        'core/nextpage', // 改ページ
//        'core/separator', // 区切り
//        'core/spacer', // スペーサー

        // ウィジェット
//        'core/shortcode', // ショートコード
//        'core/archives', // アーカイブ
//        'core/categories', // カテゴリー
//        'core/latest-comments', // 最新のコメント
//        'core/latest-posts', // 最新の記事

        // 埋め込み
//        'core/embed', // 埋め込み
//        'core-embed/twitter', // Twitter
        'core-embed/youtube', // YouTube
//        'core-embed/facebook', // Facebook
//        'core-embed/instagram', // Instagram
//        'core-embed/wordpress', // WordPress
//        'core-embed/soundcloud', // SoundCloud
//        'core-embed/spotify', // Spotify
//        'core-embed/flickr', // Flickr
//        'core-embed/vimeo', // Viemo
//        'core-embed/animoto', // Animoto
//        'core-embed/cloudup', // Cloudup
//        'core-embed/collegehumor', // CollegeHumor
//        'core-embed/dailymotion', // Dailymotion
//        'core-embed/funnyordie', // Funny or Die
//        'core-embed/hulu', // Hulu
//        'core-embed/imgur', // Imgur
//        'core-embed/issuu', // Issuu
//        'core-embed/kickstarter', // Kickstarter
//        'core-embed/meetup-com', // Meetup.com
//        'core-embed/mixcloud', // Mixcloud
//        'core-embed/photobucket', // Photobucket
//        'core-embed/polldaddy', // Polldaddy
//        'core-embed/reddit', // Reddit
//        'core-embed/reverbnation', // ReverbNation
//        'core-embed/screencast', // Screencast
//        'core-embed/scribd', // Scribd
//        'core-embed/slideshare', // Slideshare
//        'core-embed/smugmug', // SmugMug
//        'core-embed/speaker-deck', // Speaker Deck
//        'core-embed/ted', // TED
//        'core-embed/tumblr', // Tumblr
//        'core-embed/videopress', // VideoPress
//        'core-embed/wordpress-tv', // WordPress.tv
    ];

    return $allowed_block_types;
}


add_action('after_setup_theme', function () {
    /**
     * 色設定を無効化
     */
    add_theme_support('editor-color-palette');
    add_theme_support('disable-custom-colors');
    /**
     * フォントサイズ変更を無効化
     */
    add_theme_support('editor-font-sizes');
    add_theme_support('disable-custom-font-sizes');

    /**
     * ボタンの配色禁止
     */
    add_theme_support('editor-gradient-presets', array());
    add_theme_support('disable-custom-gradients');

    add_theme_support('disable-custom-colors');

    /**
     * エディタにスタイルを適用
     */
//    add_theme_support('editor-styles');
//    add_editor_style('functions/lib/admin/css/gutenberg.css');

//    unregister_block_pattern( $pattern_name );


});

/**
 * パターン削除
 */
add_filter('block_editor_settings', function ($editor_settings) {
    if (array_key_exists('__experimentalBlockPatterns', $editor_settings)) unset($editor_settings['__experimentalBlockPatterns']);
    if (array_key_exists('__experimentalBlockPatternCategories', $editor_settings)) unset($editor_settings['__experimentalBlockPatternCategories']);
    return $editor_settings;
});

/**
 * デフォルトスタイル削除
 */
add_filter('block_editor_settings', 'remove_default_editor_style', 10, 2);
function remove_default_editor_style($editor_settings, $post)
{
    unset($editor_settings['styles'][0]);

    return $editor_settings;
}

/**
 * Gutenbergのcss読み込み無効化
 */
add_action('wp_enqueue_scripts', 'disable_block_style', 9999);
//add_action('admin_enqueue_scripts', 'disable_block_style', 9999);
function disable_block_style()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}

//Gutenbergハック用CSS
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('gutenberg_hack', get_template_directory_uri() . '/functions/lib/admin/css/gutenberg_hack.css');
});


//JS読み込み
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script('gb-classes', get_template_directory_uri() . '/functions/lib/admin/js/gutenberg_filters.js', ['wp-blocks']);
});

 

# Docker

## Environment Setup

Copy `.env-sample` to `.env`.

## Environment Variables

**PHP_VER:** PHPバージョン（8.0, 7.4, 7.3）

**MYSQL_VER:** PHPバージョン（8.0, 5.7, 5.6） 

**MYSQL_ROOT_PASSWORD:** WordPressをインストールするデータベースのユーザーパスワード 

**MYSQL_PASSWORD:**  

**MYSQL_DATABASE:** WordPressをインストールするデータベース名 

**MYSQL_USER:** WordPressをインストールするデータベースのユーザー名 

**SQL_DUMP_DATA:** コンテナ起動時にロードされるSQLファイル（.gzを推奨） 

**WP_VERSION:** インストールするWordPressのバージョン 

**WP_URL:** 初回起動時にWP_SITEURL、WP_HOMEに設定されるURL

**WP_ROOT:** WordPressがインストールされるdocker上の絶対パス 

**WP_DB_PREFIX:** 初回起動時に設定されるWordPressがインストールされるテーブルのプリフィックス 

**WP_ADMIN_USER:** 初回起動時に設定されるWordPressの管理者ユーザー名 

**WP_ADMIN_PASSWORD:** 初回起動時に設定されるWordPressの管理者ユーザーパスワード 

**WP_ADMIN_EMAIL:** 初回起動時に設定されるWordPressの管理者ユーザーemailアドレス 

**WP_INSTALL_PLUGINS:** 初回起動時にインストールされるプラグイン（半角スペースで複数設定できる） 

**WP_ACTIVATE_PLUGINS:** 初回起動時に有効化されるプラグイン（半角スペースで複数設定できる）

**WP_THEME_NAME:** 使用するテーマのディレクトリ名 

## Commands

### docker-compose build

`docker-compose.yml`と`.env`の設定に基づきdockerイメージを作成する

### docker-compose up

コンテナを作成、起動する

### npm run sqldump

`bash scripts/mysqldump.sh`を実行する

コンテナ削除時にSQLの内容が消失してしまう為、保存が必要な変更がある場合は当該コマンドを実行する

## Note

### Debugログ 
初回起動時に`wp-config.php`にデバッグ用の定数が設定される

#### /wp/wp-content/debug.log 
apacheのデバッグログ

#### /wp/wp-content/uploads/mw-wp-form_uploads/mw-wp-form-debug.log
MW WP Form利用時にメールの送信をキャンセルし、送信内容のログを残す


### WP_ENVIRONMENT_TYPE
初回起動時、`wp-config.php`に`WP_ENVIRONMENT_TYPE`が`local`の直で設定される

`wp_get_environment_type()`を利用して現在の環境を取得できる



---
 

# SCSS

## Structure

```
├── 00_constants
│   ├── _00_break-point.scss // ブレークポイントを定義
│   ├── _01_color.scss // 色を定義
│   ├── _02_easing.scss // イージングを定義
│   └── _03_font.scss // フォントを定義
├── 01_functions
│   ├── _00_functions.scss // funtionを定義
│   ├── _01_mixins.scss // mixinを定義
│   └── _02_extends.scss // extendを定義
├── 02_settings
│   ├── _00_reset-extra.scss // sanitize.cssとreset.cssで解消できない問題をリセット
│   └── _02_keyframes.scss // キーフレームを定義
├── 03_parts
│   ├── _breadcrumbs.scss
│   ├── _button.scss
│   ├── _hamburger.scss
│   ├── _pagination.scss
│   ├── _sns-menu.scss
│   ├── _sns-share.scss
│   ├── _tag-list.scss
│   ├── footer
│   │   ├── _footer-menu.scss
│   │   └── _footer.scss
│   └── header
│       ├── _header-menu.scss
│       └── _header.scss
├── 04_pages
│   ├── 00_global
│   │   ├── _00_base.scss
│   │   ├── _01_form.scss
│   │   └── _03_editor.scss // Goutenbergで出力されるタグのスタイリング
│   └── index
│       └── _index.scss
├── 99_utilities
│   ├── _00_class.scss
│   ├── _01_is-status.scss
│   ├── _02_utilities.scss
│   └── _03_font.scss
└── app.scss

```

## BreakPoint 

`00_constants/00_easing.scss` の連想配列`$break-point` に各イージングのパターンを定義する 

呼び出しはfunction`bp($mode)` $modeにキーを渡す

## MediaQuery

### mixins
`01_functions/01_mixins.scss` にMediaQuery用のmixinが定義されている

#### mq($mode:break, $type: max)

$modeに$break-pointのキー、$typeに`max`または`min`を指定する

デフォルトの挙動は`max-width:767px`

使用例：

```scss
// 768以下はフォントサイズを小さくする
h1 {
  font-size: 24px;
  @include mq() {
    font-size: 18px;
  }
}
```

#### mq_min($mode:break)
mixin`mq()`の第二引数がデフォルトで`min`にセットされているショートハンド

`mq_min(break)`と`mq(break,min)`は同じ

#### min($mode:break)
`mq_min()`のエイリアス

#### mq_max($mode:break)
mixin`mq()`の第二引数がデフォルトで`max`にセットされているショートハンド

`mq_max(break)`と`mq(break,max)`は同じ

#### max($mode:break)
`mq_max()`のエイリアス

#### mq_between($min-mode,$max-mode)
`(min-width: px) and (max-width: px)`を出力する

引数には$break-pointのキーを渡す

#### between($min-mode,$max-mode)
`mq_between()`のエイリアス

#### pc($mode:break)
引数を渡さない場合、`min-width:768px`を出力する

#### sp($mode:break)
引数を渡さない場合、`man-width:767px`を出力する

使用例：

```scss
// 768のbreakpointで.wrapperのスタイルを変更する
.wrapper {
  // pc min-width:768px
  @include pc() {
    max-width: 80vw;
    margin: 0 auto;
  }
  // sp max-width:767px
  @include sp() {
    padding: 0 20px;
  }
}

// リキッドのカラムの数とmargin-rightを画面幅で変更する
$margin:20px;
.article-item {
  margin-right: $margin;
  
  // 1440以上は4カラム min-width: 1440
  @include min(pc) {
    width: calc(( 100% - ($margin * 3 ) / 4 );
    &:nth-child(4n) {
      margin-right: 0;
    }
  }
  
  // 1024以上、1439以下は3カラム  min-width: 1024 and max-width: 1439
  @include between(tab,pc) {
    width: calc(( 100% - ($margin * 2 ) / 3 );
    &:nth-child(3n) {
      margin-right: 0;
    }
  }
  
  // 768以上、1023以下は2カラム  min-width: 768 and max-width: 1023
  @include between(break,tab) {
    width: calc(( 100% - ($margin * 1 ) / 2 );
    &:nth-child(2n) {
      margin-right: 0;
    }
  }
  
  // 767以下は1カラム max-width: 767
  @include sp() {
    width: 100%;
    margin-right: 0;
  }
}

```

## Fonts

### Constants

`00_constants/03_font.scss` の連想配列`$font` に各フォントのパターンを定義する 

キー`sp` 内はmedia_queryでラップされたデータが出力される

また、パターン`base` はHTML要素に適用される（`04_pages/00_global/00_base.scss`内）

### mixin

#### font($type:base)

使用例：

```scss
.index__heading {
  @include font(heading_01);
}
```

## Sizes

### mixins
`01_functions/00_functions.scss` にfunctionが定義されている

ベストビューデザインのピクセルから、vw・vhを算出するのに使用する

#### vw($size, $mode:pc)
デフォルトでは1440px幅時のvwを返す

#### vw_sp($size,$mode:sp)
デフォルトでは375px幅時のvwを返す

#### vh($size,$height:$pc-bestview-height)
デフォルトでは900px高時のvhを返す

#### vh_sp($size,$height:$sp-bestview-height)
デフォルトでは667px高時のvhを返す

使用例：
```scss
// デザイン上、上下30px、左右60pxのpaddingを持つデザインを、同じ比率のまま画面幅に応じて可変させたい時
.l-main {
  padding: vh(30) vw(60);
  @include sp() {
    // レスポンシブ
    padding: vh_sp(20) vw_sp(30);
  }
}
```

## Easing

### Constants

`00_constants/02_easing.scss` の連想配列`$easing` に各イージングのパターンを定義する 

デフォルトでは https://easings.net/ja のパターンが用意されている

### Function

#### ease($type:$base-ease)

使用例：
```scss
.index__heading {
  transition: all .5s ease(easeInOutBack) 1s;
}
```

## Utility

### Lineclamp

記事などのタイトル、本文が長い時に省略させるために使用する。

使用例：
```scss
.index__article {
  @include line-clamp(3);
}
```


---


# WordPress Functions

## Structure

```
├── autoload
│   ├── 00_laravel-mix-boilerplate.php // mix関数
│   ├── 01_constants.php // 定数を定義
│   ├── 02_import_functions.php // テンプレート読み込みを定義
│   ├── 03_utitility.php //
│   ├── 04_security.php //
│   ├── 05_posttype_taxonomy.php //
│   ├── 07_wp_head.php
│   ├── 09_mutibyte_patch.php
│   ├── 10_404.php
│   ├── 11_media.php
│   ├── 11_pagination.php
│   ├── 12_json-ld.php
│   ├── 20_disable_comment.php
│   ├── 25_admin_bar_menus.php
│   ├── 30_admin_utility.php
│   ├── 35_gutenberg.php
│   ├── 50_login.php
│   └── 99_acf_auto_export_import.php
├── class
│   └── LIG_YOAST_SETTINGS.php
├── config
│   └── LIG_YOAST_CONFIG.php
├── extra
│   ├── 04_utility_extra.php
│   ├── 06_query_hooks.php
│   ├── 31_disable_default_post_type.php
│   ├── 55_acf.php
│   ├── 55_yoast.php
│   ├── 60_admin_utility_extra.php
│   ├── 9999_dummy_post.php
│   ├── 99_category_pages.php
│   ├── 99_excerpt.php
│   ├── 99_html_compression.php
│   ├── 99_lightsail_cdn.php
│   ├── 99_mw_form.php
│   ├── 99_rewrite_hooks.php
│   └── 99_yoast_settings.php
├── lib
│   └── admin
│       ├── css
│       │   ├── gutenberg.css
│       │   └── gutenberg_hack.css
│       └── js
│           ├── gutenberg_filters.js
│           ├── lightsail_cdn.js
│           └── yoast_cache_clear.js
└── vender.php
```

## 00_laravel-mix-boilerplate.php

### mix

laravel-mix-boilerplate でのビルドが出力する manifest.json を元にキャッシュバスティングされたパスを返す

#### function mix($path, $manifestDirectory = '')

$path はプロトコルから指定する

#### resolve_uri($path, $manifestDirectory = '')

mix のショートハンド

$path にはテーマディレクトリからのパスを渡す

使用例

```php
<?= mix('/assets/images/logo.png') ?>
```

## 01_constants.php

各種定数を定義

init にフックしているため、それ以前の呼び出しではエラーになる

## 02_import_functions.php

テンプレート読み込みの関数・そのヘルパー関数を定義

#### import_template(string $tpl, array $vars = [])

$tpl はテーマからの相対パスを指定する

拡張子は自動で php がつくため不要

`$vars`にはパーツ内に渡したい変数を配列で指定する

キーが変数名、値が値となる

使用例

```php
<?php
import_template('modules/two-column',[
    'modifier' => 'wide',
    'post' => $post
]);
?>
```

#### import_part(string $tpl, array $vars = [])

`import_template()`のショートハンド

$tpl はテーマ直下の parts ディレクトリからの相対パスを指定する

拡張子は自動で php がつくため不要

使用例

```php
<?php import_part('article') ?>
```

#### import_vars_whitelist(array $vars, array $whitelist = [])

`$vars`のキーを`$whitelist`でフィルタリングする

`$whitelist`にはデフォルト値を指定する

主に、読み込まれたパーツ側で使用する

デフォルトで`modifier`と`additional`が付与される

使用例

```php
<?php
/**
 * parts/article.php
 *
 * 呼び出し元から$post, $taxonomyが渡される想定
 *
 * 定義されている変数をホワイトリストでフィルタリング
 * ホワイトリストに存在しない変数は$defaultに指定した値をセット
 * キー名を変数名として展開する
 */
$default = [
     'post' => $_GLOBALS['post'], // $postが空だった場合は$_GLOBALS['post']を参照する
     'taxonomy' => ''
];
extract(import_vars_whitelist(get_defined_vars(),$default));
?>
```

## 03_utitility.php

ユーティリティ関数群を定義

#### is_blank(?bool $bool = false)

`$bool`に`true`を渡すと`target="_blank" rel="noopener noreferrer"`が返却される

使用例

```php
<a href="https://example.com"<?= is_blank(true) ?>>google</a>
```

#### is_current(?bool $bool = false)

`$bool`に`true`を渡すと` is-current`が返却される

使用例

```php
<?php
// TOPページだったらis-currentを付与する
?>
<a href="<?= URL_HOME ?>" class="<?= is_current(is_front_page()) ?>">TOP</a>
```

#### get_modified_class(string $class_name, $modifier)

`$class_name`にベースとなるクラス名、`$modifier`にモディファイヤを文字列または配列で指定する

使用例

```php
<p class="<?= get_modified_class('text', 'blue') ?>">hoge</p>
<?php
// 出力結果
// <p class="text text--blue">hoge</p>
?>

<p class="<?= get_modified_class('text', ['red','bold']) ?>">fuga</p>
<?php
// 出力結果
// <p class="text text--red text--bold">fuga</p>
?>
```

#### get_additional_class($additional)

`$additional`に追加したいクラス名を文字列または配列で指定する

主にインポートされたパーツの中で使用する

使用例

```php
<p class="<?= get_additional_class('hoge') ?>">hoge</p>
<?php
// 出力結果
// <p class="hoge">hoge</p>
?>

<p class="<?= get_additional_class(['hoge','fuga']) ?>">fuga</p>
<?php
// 出力結果
// <p class="hoge fuga">fuga</p>
?>
```

#### add_filter('body_class', クロージャ)

`body_class`にフィルターをかける

### 環境判定

`wp-config.php`に定義した定数`WP_ENVIRONMENT_TYPE`を判定し、ブール値を返却する

#### is_local()

`WP_ENVIRONMENT_TYPE`が`local`の場合 true を返却

#### is_development()

`WP_ENVIRONMENT_TYPE`が`development`の場合 true を返却

#### is_staging()

`WP_ENVIRONMENT_TYPE`が`staging`の場合 true を返却

#### is_production()

`WP_ENVIRONMENT_TYPE`が`production`の場合 true を返却

## 04_security.php

セキュリティ周りのヘルパー関数軍、及びフックなど

#### xss($str = null)

`$str`を HTML エンティティして返却

#### header_register_callback(closure)

レスポンスヘッダーから PHP バージョンを削除

#### add_filter('wp_headers',closure)

レスポンスヘッダーから、X-Pingback を削除

#### remove_action('template_redirect', 'rest_output_link_header', 11, 0)

レスポンスヘッダーから REST API のエンドポイントを削除 Ï

#### remove_action('wp_head', 'wp_generator');

`wp_head`から WordPress のバージョン情報を削除

#### add_filter('xmlrpc_enabled', '\_\_return_false');

XML-RPC 機能を無効化

#### remove_action('template_redirect', 'wp_redirect_admin_locations', 1000)

ログイン URL の自動リダイレクトを禁止

#### remove_action('template_redirect'、'\_\_return_empty_array')

著者アーカイブページを無効化

#### define('AUTOMATIC_UPDATER_DISABLED', false);

開発版、マイナー、メジャー、すべての WordPress の自動更新を無効化

## 05_posttype_taxonomy.php

投稿タイプやタクソノミーの登録など

#### add_action('after_setup_theme',closure)

カスタム投稿タイプで title-tag とアイキャッチを有効化させる

#### add_post_type_and_taxonomy()

カスタム投稿タイプ・カスタムタクソノミーを追加する

## 07_wp_head.php
wp_headのフィルター用


## 11_media.php

### SVG

#### get_svg(string $name);

`/assets/svg/`内の svg ファイルをインラインで返却

```php
// /assets/svg/logo.svg をインラインで出力
<?= get_svg('logo') ?>
```

#### get_svg_img(string $name, array $opt = []);

`/assets/svg/`内の svg ファイルを img タグとして返却

$opt に`'base64'=>true`を渡すことにより`src="{base64化されたsvg}"`として出力することもできる

`width`と`height`を指定しないと、svg の viewBox から取得しようと試みる

$opt のデフォルト

```php
$default_opt = [
        'base64' => false,
        'alt' => '',
        'class' => '',
        'id' => '',
        'widht' => '',
        'height' => '',
    ];
```

```php
// /assets/svg/logo.svg をimgタグとして出力
// svgはbase64化することによりhttpリクエストを発生させない
<?= get_svg_img('logo',[
    'base64' => true,
    'alt' => 'ロゴ',
    'class' => 'logo-img',
    'id' => 'logo',
    'widht' => '200'
    'height' => '100',
]) ?>
```

#### get_svg_sprite(string $name);

svg スプライトの指定された箇所を use で返却する

第一引数に svg-sprite.svg の id 名を指定する

```php
// svg-sprite.svg#logoを出力
<?= get_svg_sprite('logo') ?>
```


---

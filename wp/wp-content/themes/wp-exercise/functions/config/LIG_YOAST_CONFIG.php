<?php
/**
 * Created by PhpStorm.
 * User: ryota
 * Date: 2020/11/11
 * Time: 12:45
 */

class LIG_YOAST_CONFIG
{

    public $site_settings = [];
    public $page = [];
    public $post_type = [];
    public $taxonomy = [];
    public $option_wpseo = [];
    public $option_wpseo_titles = [];
    public $option_wpseo_social = [];

    public function __construct()
    {

        //一般設定
        $this->site_settings = [
            'front-page-title' => '株式会社LIG公式サイト', //TOPページタイトル
            'site-description' => '株式会社LIGのWEBサイトです', //TOPページ及び、descriptionが指定されていないページの説明文
            'site-title' => '株式会社LIG',
            'separator' => '｜',
            '404-title' => 'Page not Found',
        ];


        //固定ページ
        $this->page = [
            'about' => [
                'metadesc' => 'ABOUTの説明文です'
            ],
            'confirm' => [
                /**
                 * 同じslugを持つページが複数ある場合は配列にする。
                 * descendantsには子孫側から親のslugを入れる。（ex: confirmの場合、['enrty','career','recruit']）
                 * descendantsに入れられるslugは固定ページのものに限られる。
                 * descendantsの値の数が多い順に設置する。
                 * frontpage直下の場合、descendantsには空の配列を指定する。
                 */
                [
                    'descendants' => ['entry','career'],
                    'metadesc' => 'career/entry配下のconfirmの説明文です'
                ],
                [
                    'descendants' => ['entry','new-grad'],
                    'metadesc' => 'new-grad/entry配下のconfirmの説明文です'
                ],
                [
                    'descendants' => ['contact'],
                    'metadesc' => 'contact配下のconfirmの説明文です'
                ],
            ]
        ];

        //投稿タイプ
        $this->post_type = [
            'default' => [
                'single-title' => "%%title%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'archive-title' => "%%pt_plural%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'metadesc' => $this->site_settings['site-description'],
            ],
            'news' => [
                'single-title' => "%%title%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'archive-title' => "%%pt_plural%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'metadesc' => 'ニュース一覧の説明文です'
            ],
            'case' => [
                'single-title' => "%%pt_plural%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'archive-title' => "事例" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'metadesc' => '事例一覧の説明文です'
            ],
        ];

        //タクソノミーアーカイブページ
        $this->taxonomy = [
            'default' => [
                'title' => "%%term_title%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'metadesc' => $this->site_settings['site-description'],
            ],
            'news-category' => [
                'title' => "%%term_title%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],
                'metadesc' => "%%term_title%% のカテゴリー一覧ページです。",
            ]
        ];

        $this->option_wpseo = [
            'enable_xml_sitemap' => false, //Yoastによる
        ];

        $this->option_wpseo_titles = [
            "title-home-wpseo" => $this->site_settings['front-page-title'],
            "website_name" => $this->site_settings['site-title'], //サイト名
            "alternate_website_name" => $this->site_settings['site-title'], //サイト名
            "title-page" => "%%title%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],//固定ページのタイトル
            "title-post" => "%%title%%" . $this->site_settings['separator'] . $this->site_settings['site-title'],//記事詳細ページのタイトル
            "title-404-wpseo" => $this->site_settings['404-title'] . $this->site_settings['separator'] . $this->site_settings['site-title'], //404ページのタイトル
            "title-search-wpseo" => "「%%searchphrase%%」の検索結果" . $this->site_settings['separator'] . $this->site_settings['site-title'], //検索ページのタイトル
            "forcerewritetitle" => true,//titleタグ強制書き換え
            "metadesc-home-wpseo" => $this->site_settings['site-description'],
            "noindex-author-wpseo" => true,//著者ページをnoindex
            "disable-author" => true,//著者ページ無効
            "disable-date" => true,//日付アーカイブ無効
            "disable-post_format" => true,//投稿フォーマットページ無効
            "disable-attachment" => true,//attachmentページ無効
            "is-media-purge-relevant" => false,
            "breadcrumbs-404crumb" => $this->site_settings['404-title'], // パンクずの404
            "breadcrumbs-home" => NAME_HOME, //パンクズなどのTOPページの文字列
            "company_logo" => URL_COMPANY_LOGO,
            "company_name" => URL_COMPANY_NAME,
            "company_or_person" => "company",
        ];

        $this->option_wpseo_social = [
            "facebook_site" => (defined('URL_FACEBOOK')) ? URL_FACEBOOK : "",
            "instagram_url" => (defined('URL_INSTAGRAM')) ? URL_INSTAGRAM : "",
            "linkedin_url" => (defined('URL_LINKED_IN')) ? URL_LINKED_IN : "",
            "myspace_url" => "",
            "og_default_image" => (defined('URL_OGIMAGE')) ? URL_OGIMAGE : "",
            "og_default_image_id" => "",
            "og_frontpage_title" => $this->site_settings['front-page-title'],
            "og_frontpage_desc" => $this->site_settings['site-description'],
            "og_frontpage_image" => (defined('URL_OGIMAGE')) ? URL_OGIMAGE : "",
            "og_frontpage_image_id" => "",
            "opengraph" => true,
            "pinterest_url" => (defined('URL_PINTEREST')) ? URL_PINTEREST : "",
            "pinterestverify" => "",
            "twitter" => true, //twitter user namne
            "twitter_site" => (defined('URL_TWITTER')) ? URL_TWITTER : "",
            "twitter_card_type" => "summary_large_image",
            "summary_large_image" => (defined('URL_OGIMAGE')) ? URL_OGIMAGE : "",
            "youtube_url" => (defined('URL_YOUTUBE')) ? URL_YOUTUBE : "",
            "wikipedia_url" => "",
            "fbadminapp" => "",
        ];
    }
}
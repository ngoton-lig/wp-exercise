<?php
/**
 *  メインクエリーとかクエリー系処理を記載します。
 */
function change_posts_per_page($query)
{
    //管理画面のメインクエリーとメインクエリーじゃないときは処理しない
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    //ホーム画面のメインクエリー処理
    if ($query->is_home()) {
        $query->set('posts_per_page', '10'); //件数変更
        $query->set( 'category_name', 'topics' );//カテゴリ指定
        $query->set('orderby', 'post_date'); //ソート指定
        $query->set('order', 'DESC'); //ソート順番
        $query->set('post_status', 'publish'); //公開状態
    }
}
// add_action( 'pre_get_posts', 'change_posts_per_page' );

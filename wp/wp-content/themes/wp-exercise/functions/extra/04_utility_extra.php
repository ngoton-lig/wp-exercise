<?php
/**
 * ユーザページ等でログインIDではなくニックネームを取得する.
 */
add_filter('get_the_author_display_name', 'change_display_dame', 10, 2);
function change_display_dame($value, $user_id)
{
    // ニックネームを取得して、あればそちらを出力する
    $nickname = get_the_author_meta('nickname', $user_id);

    if (!empty($nickname)) {
        return $nickname;
    } else {
        return $value;
    }
}


/**
 * 投稿が指定期間以内かチェックする.
 *
 * @param type $post_id 記事ID
 * @param type $time    期間指定　strtotimeのフォーマットを指定
 *
 * @return bool
 */
function is_newpost($post_id = null, $time = NEW_POST_TIME)
{
    $dt = new DateTime();
    $dt->setTimeZone(new DateTimeZone('Asia/Tokyo'));
    $today = get_post_time('Y-m-d', false, $post_id);
    $limit_day = date('Y-m-d', strtotime($time));
    if (strtotime($today) >= strtotime($limit_day)) :
        return true;
    endif;

    return false;
}
<?php
add_action( 'init', 'add_news_rules' );
function add_news_rules()
{
    add_rewrite_rule('news/([0-9]+)?$', 'index.php?post_type=news&p=$matches[1]', 'top');
}
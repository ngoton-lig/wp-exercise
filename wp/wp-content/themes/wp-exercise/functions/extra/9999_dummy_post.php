<?php
add_filter('the_title', 'dummy_title');
function dummy_title($title)
{
    $dummies = [
        'ダミーニュース１',
        'ダミーニュース２',
        'ダミーニュース３',
        'ダミーニュース４',
    ];
    return $dummies[rand(0,3)];
}

add_filter('get_the_date', 'dummy_date',0,3);
function dummy_date($the_date, $d, $post)
{
    $dummy_time = mktime(0, 0, 0, date("m"), date("d")-rand(0,60),   date("Y"));
    return date($d,$dummy_time);
}

add_filter('the_content', 'dummy_content',0,3);
function dummy_content($content)
{
    $dummy = <<<EOF

EOF;

    return $content;
}
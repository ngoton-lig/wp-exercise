<?php
$queried_object = get_queried_object();
$breadcrumbs = [
    [
        'text' => NAME_HOME,
        'href' => URL_HOME
    ],
    [
        'text' => $queried_object->label,
        'href' => get_post_type_archive_link($queried_object->name)
    ],
];

if (get_query_var('paged')) {
    $breadcrumbs = array_merge($breadcrumbs, [['text' => 'page '.get_query_var('paged'), 'href' => null]]);
}

$page_header = [
    'title' => get_the_title(),
    'modifier' => $post->post_name,
];

get_header();
?>
<main class="l-index">
    <div class="l-container">
        <?php import_part('breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>
        <div class="filter-bar">
            <form id="js-news-filter">
                <?php wp_dropdown_categories(
                        ['taxonomy' => 'news-category',
                        'show_option_all' => 'Category',
                        'value_field' => 'slug', 'name' => 'select-category',
                        'id' => 'js-select-category']); ?>
                <select name="select-year" id="js-select-year">
                    <option>Year</option>
                    <?php wp_get_archives(['post_type' => 'news', 'type' => 'yearly', 'format' => 'option']); ?>
                </select>
                <input type="submit" name="submit" value="View" />
            </form>
        </div>
        <div class="main-content">
            <?php
            import_part('post-list', ['post_type' => 'news', 'is_paging_show' => true]);
            ?>
        </div>
    </div>
</main>
<?php
get_footer();
<?php
/**
 * Created by PhpStorm.
 * User: ryota
 * Date: 2020/11/11
 * Time: 12:49
 */

class LIG_YOAST_SETTINGS
{
    public $config;
    public $current_page_desc;

    public function __construct()
    {
        $this->config = new LIG_YOAST_CONFIG();

        $this->filter_options();

        $this->set_page_settings();
        $this->set_post_type_settings();
        $this->set_taxonomy_settings();

        $this->set_og_site_name();
        $this->set_json_ld_website_description();

        $this->ajax_cache_clear();
        $this->dashboard_display();
    }

    public function filter_options()
    {
        foreach (['option_wpseo', 'option_wpseo_titles', 'option_wpseo_social'] as $name) {
            if (empty($this->config->$name)) continue;
            add_filter($name, function ($options, $name) {
                $name = 'option_' . $name;
                foreach ($this->config->$name as $k => $v) {
                    $options[$k] = $v;
                }
                return $options;
            }, 10, 3);
        }
    }

    public function set_page_settings()
    {
        add_action('parse_query', function () {
            if (!is_page()) return;
            $queried_object = get_queried_object();
            if (!array_key_exists($queried_object->post_name, $this->config->page)) return;
            if (array_key_exists('metadesc', $this->config->page[$queried_object->post_name])) {
                $this->current_page_desc = $this->config->page[$queried_object->post_name]['metadesc'];
            } else {
                foreach ($this->config->page[$queried_object->post_name] as $current_num => $page) {
                    if (!$this->check_descendants($page['descendants'], $current_num)) continue;
                }
            }
            if (empty($this->current_page_desc)) $this->current_page_desc = $this->config->site_settings['site-description'];
            add_filter('wpseo_metadesc', [$this, 'set_page_description']);
            add_filter('wpseo_opengraph_desc', [$this, 'set_page_description']);
        });
    }

    public function set_post_type_settings()
    {
        $post_types = get_post_types([
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            '_builtin' => false
        ]);
        $post_type[] = 'post';
        foreach ($post_types as $post_type) {
            $this->option_wpseo_titles["title-" . $post_type] = $this->config->post_type[((!empty($this->config->post_type[$post_type]['single-title'])) ? $post_type : 'default')]['single-title'];
            $this->config->option_wpseo_titles["title-ptarchive-" . $post_type] = $this->config->post_type[((!empty($this->config->post_type[$post_type]['archive-title'])) ? $post_type : 'default')]['archive-title'];
            $this->config->option_wpseo_titles["metadesc-ptarchive-" . $post_type] = $this->config->post_type[((!empty($this->config->post_type[$post_type]['metadesc'])) ? $post_type : 'default')]['metadesc'];
        }
    }

    public function set_taxonomy_settings()
    {
        $taxonomies = get_taxonomies(['public' => true]);
        foreach ($taxonomies as $taxonomy) {
            $this->config->option_wpseo_titles["title-tax-" . $taxonomy] = $this->config->taxonomy[((!empty($this->config->taxonomy[$taxonomy]['title'])) ? $taxonomy : 'default')]['title'];
            $this->config->option_wpseo_titles["metadesc-tax-" . $taxonomy] = $this->config->taxonomy[((!empty($this->config->taxonomy[$taxonomy]['metadesc'])) ? $taxonomy : 'default')]['metadesc'];
        }
    }

    public function set_page_description($desc)
    {
        return $this->current_page_desc;
    }

    public function check_descendants($descendants, $current_num)
    {
        $queried_object = get_queried_object();
        $child = $queried_object;
        if ($queried_object->post_parent === 0 && count($descendants) === 0) {
            $this->current_page_desc = $this->config->page[$queried_object->post_name][0]['metadesc'];
            return true;
        }
        foreach ($descendants as $i => $d) {
            $parent = get_post($child->post_parent);
            if (count($descendants) === $i + 1) {
                $this->current_page_desc = $this->config->page[$queried_object->post_name][$current_num]['metadesc'];
                return true;
            }
            if ($parent->post_name !== $d) return false;
            $child = $parent;
        }
    }

    public function set_og_site_name()
    {
        add_filter('wpseo_opengraph_site_name', function () {
            return $this->config->site_settings['site-title'];
        });
    }

    public function set_json_ld_website_description()
    {
        add_filter('wpseo_schema_website', function ($schema_pieces) {
            $schema_pieces['description'] = $this->config->site_settings['site-description'];
        }, 10, 3);
    }

    public function ajax_cache_clear() {
        add_action('wp_ajax_lig_yoast_cache_clear', function () {
            global $wpdb;
            $res = $wpdb->query(
                "TRUNCATE TABLE ".$wpdb->prefix."yoast_indexable"
            );
            echo ($res) ? "0" : "1"; //成功だと0、失敗だと1
            die();
        });
    }

    public function dashboard_display()
    {
        if (!is_admin()) return;
        add_action('wp_dashboard_setup', function () {
            wp_add_dashboard_widget('lig_yoast_cache_clear_widget', 'Yoast キャッシュクリア', function(){
                echo '<button id="lig-yoast-clear-cache">キャッシュクリア</button>';
            });
        });
        add_action('admin_enqueue_scripts', function () {
            $handle = 'lig_yoast_cache_clear_manually';

            wp_register_script($handle, get_stylesheet_directory_uri() . '/functions/lib/admin/js/yoast_cache_clear.js', ['jquery'], '', true);
            $localize = [
                'ajax_url' => admin_url('admin-ajax.php'),
                'action' => 'lig_yoast_cache_clear',
            ];
            wp_localize_script($handle, 'localize_lig_yoast_cache_clear', $localize);

            wp_enqueue_script($handle);
        });
    }

}
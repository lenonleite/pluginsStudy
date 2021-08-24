<?php

if (!defined('ABSPATH')) {
    exit;
}

class Elex_manage_feeds_ajax_function {

    function __construct() {
        add_action('wp_ajax_elex_gpf_manage_feed_remove_file', array($this, 'elex_gpf_manage_feed_remove_file'));
        add_action('wp_ajax_elex_gpf_manage_feed_refresh_file', array($this, 'elex_gpf_manage_feed_refresh_file'));
    }

    function elex_gpf_manage_feed_remove_file() {
        check_ajax_referer('ajax-elex-gpf-manage-feed-nonce', '_ajax_elex_gpf_manage_feed_nonce');
        $settings_tag_fields = get_option( 'elex_settings_tab_fields_data' );
        if($settings_tag_fields && isset($settings_tag_fields['file_path']) && $settings_tag_fields['file_path'] != '') {
            $path = $settings_tag_fields['file_path'].'/';
        }
        else {
            $upload_dir = wp_upload_dir();
            $base = $upload_dir['basedir'];
            $path = $base . "/elex-product-feed/";
        }
        unlink($path . $_POST['file_to_delete']);
        $cron_projects = get_option('elex_gpf_cron_projects');
        foreach ($cron_projects as $key => $value) {
            if (isset($value['file']) && $_POST['file_to_delete'] == $value['file']) {
                unset($cron_projects[$key]);
            }
        }
        update_option('elex_gpf_cron_projects', $cron_projects);
        die();
    }

    function elex_gpf_manage_feed_refresh_file() {
        $cron_jobs = get_option('elex_gpf_cron_projects');
        foreach ($cron_jobs as $key => $value) {
            if(isset($value['file'])) {
                if ($value['file'] == $_POST['file_to_refresh']) {
                    $generate_feed_obj = new Elex_gpf_ajax_call();
                    $project_title = trim($value['name']);
                    $project_desc = trim($value['description']);
                    $project_title = str_replace(' ', '_', $project_title);
                    $autoset_identifier_exists = isset($value['autoset_identifier_exists']) ? $value['autoset_identifier_exists'] : FALSE;

                    $product_ids = array();
                    foreach ($value['categories_choosen'] as $key => $categories) {
                        $cat_cond = '';
                            if ($cat_cond == "") {
                                $cat_cond = "'" . $categories . "'";
                            } else {
                                $cat_cond = $cat_cond . ",'" . $categories . "'";
                            }
                            $ids_to_update = array();
                            if(isset($product_ids[$value['sel_google_cats'][$key]]) && is_array($product_ids[$value['sel_google_cats'][$key]])) {
                                $ids_to_update = $generate_feed_obj->elex_gpf_get_product_ids($cat_cond);
                                if($ids_to_update) {
                                    $product_ids[$value['sel_google_cats'][$key]]  = array_unique(array_merge($product_ids[$value['sel_google_cats'][$key]],$ids_to_update));
                                }
                                
                            }
                            else {
                                 $product_ids[$value['sel_google_cats'][$key]] = $generate_feed_obj->elex_gpf_get_product_ids($cat_cond);
                            }
                       
                    }
                    $condition = array();
                    $prepend_attr = array();
                    $append_attr = array();
                    if(isset($value['conditions'])) {
                        $condition = $value['conditions'];
                    }
                    if(isset($value['prepend_attr'])) {
                        $prepend_attr = $value['prepend_attr'];
                    }
                    if(isset($value['append_attr'])) {
                        $append_attr = $value['append_attr'];
                    }
                    if ($value['feed_file_type'] == 'xml') {
                        $generate_feed_obj->elex_gpf_create_project($project_title, $project_desc, $product_ids, $value['prod_attr'], $value['google_attr'], $value['exclude_ids'], $autoset_identifier_exists, $condition, $prepend_attr, $append_attr);
                    }
                    else {
                        $tsv = false;
                        if($value['feed_file_type'] == 'tsv') {
                            $tsv = true;
                        }
                        $generate_feed_obj->elex_gpf_create_csv_project($project_title, $product_ids, $value['prod_attr'], $value['google_attr'], $value['exclude_ids'], $autoset_identifier_exists, $condition, $prepend_attr, $append_attr,$tsv);
                    }
                    $cron_jobs[$key]['modified_date'] = current_time('d-m-Y H:i:s');
                    update_option('elex_gpf_cron_projects', $cron_jobs);
                }
            }
        }
        die();
    }

}

new Elex_manage_feeds_ajax_function();

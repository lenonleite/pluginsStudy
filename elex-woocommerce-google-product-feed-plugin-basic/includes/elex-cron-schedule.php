<?php

if (!defined('ABSPATH')) {
    exit;
}

class Elex_cron_schedule {

    function __construct() {
        $this->elex_gpf_update_cron_jobs();
    }

    function elex_gpf_update_cron_jobs() {
        $cron_jobs = get_option('elex_gpf_cron_projects');
        if (!empty($cron_jobs)) {
            foreach ($cron_jobs as $key => $value) {
                if (isset($value['file']) && $value['pause_schedule'] == 'ready') {
                    $run = false;

                    if($value['refresh_schedule'] == 'weekly') {
                        $today = strtolower(current_time('l'));
                        if(is_array($value['refresh_days']) && in_array($today, $value['refresh_days']) && current_time('G') >= $value['refresh_hour'] ) {
                            $run = true;
                            if(isset($value['modified_date']) && !(abs(strtotime($value['modified_date']) - strtotime(current_time('d-m-Y')))/(60*60*24)) ) {
                                $run = false;
                            }
                        }

                    }
                    else if($value['refresh_schedule'] == 'monthly') {
                         $today = current_time('j');
                        if(is_array($value['refresh_days']) && in_array($today, $value['refresh_days']) && current_time('G') >= $value['refresh_hour'] ) {
                            if(isset($value['modified_date']) && !(abs(strtotime($value['modified_date']) - strtotime(current_time('d-m-Y')))/(60*60*24)) ) {
                                $run = false;
                            }
                        }

                    }
                    else if($value['refresh_schedule'] == 'daily') {

                        if(current_time('G') >= $value['refresh_hour'] ) {
                            $run = true;
                            if(isset($value['modified_date']) && !(abs(strtotime($value['modified_date']) - strtotime(current_time('d-m-Y')))/(60*60*24)) ) {
                                $run = false;
                            }
                        }

                    }

                    if($run) {
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
                             $generate_feed_obj->elex_gpf_create_csv_project($project_title, $product_ids, $value['prod_attr'], $value['google_attr'], $value['exclude_ids'], $autoset_identifier_exists, $condition, $prepend_attr, $append_attr, $tsv);
                        }
                        
                        $cron_jobs[$key]['modified_date'] = current_time('d-m-Y H:i:s');
                        update_option('elex_gpf_cron_projects', $cron_jobs);
                    }
                }
            }
        }
    }

}

new Elex_cron_schedule();

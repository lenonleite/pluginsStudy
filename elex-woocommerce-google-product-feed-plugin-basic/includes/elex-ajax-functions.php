<?php

if (!defined('ABSPATH')) {
    exit;
}

class Elex_gpf_ajax_call {

    function __construct() {
        add_action('wp_ajax_elex_gpf_show_mapping_fields', array($this, 'elex_gpf_mapping_settings_field'));
        add_action('wp_ajax_elex_gpf_generate_feed', array($this, 'elex_gpf_generate_feed'));
        add_action('wp_ajax_elex_gpf_manage_feed_edit_file', array($this, 'elex_gpf_manage_feed_edit_file'));
        add_action('wp_ajax_elex_gpf_get_exclude_prod_option', array($this, 'elex_gpf_get_exclude_prod_option'));
        add_action('wp_ajax_elex_gpf_pause_schedule', array($this, 'elex_gpf_pause_schedule'));
        $this->setting_tab_fields = get_option( 'elex_settings_tab_fields_data' );

    }

    function elex_gpf_pause_schedule() {
        $saved_projects = get_option('elex_gpf_cron_projects');
        if (!empty($saved_projects)) {
            foreach ($saved_projects as $key => $value) {
                if (isset($value['file']) && $value['file'] == $_POST['file']) {
                    if($_POST['feed_action'] == 'pause') {
                        $saved_projects[$key]['pause_schedule'] = 'paused';
                    }
                    else {
                        $saved_projects[$key]['pause_schedule'] = 'ready';
                    }
                    update_option('elex_gpf_cron_projects', $saved_projects);
                }
            }
        }
        die();
    }

    function elex_gpf_get_exclude_prod_option() {
        $options = '';
        foreach ($_POST['exclude_prod_ids'] as $product_id) {
            $product = wc_get_product($product_id);
            if (is_object($product)) {
                $options .= '<option value="' . esc_attr($product_id) . '"' . selected(true, true, false) . '>' . wp_kses_post($product->get_formatted_name()) . '</option>';
            }
        }
        die($options);
    }

    function elex_gpf_generate_feed() {
        exit('aaaaa');
//        check_ajax_referer('ajax-elex-gpf-nonce', '_ajax_elex_gpf_nonce');
        $product_ids = array();
        foreach ($_POST['categories_choosen'] as $key => $categories) {
            $cat_cond = '';
                if ($cat_cond == "") {
                    $cat_cond = "'" . $categories . "'";
                } else {
                    $cat_cond = $cat_cond . ",'" . $categories . "'";
                }
                $ids_to_update = array();
                if(isset($product_ids[$_POST['sel_google_cats'][$key]]) && is_array($product_ids[$_POST['sel_google_cats'][$key]])) {
                    $ids_to_update = $this->elex_gpf_get_product_ids($cat_cond);
                    if($ids_to_update) {
                        $product_ids[$_POST['sel_google_cats'][$key]]  = array_unique(array_merge($product_ids[$_POST['sel_google_cats'][$key]],$ids_to_update));
                    }
                    
                }
                else {
                     $product_ids[$_POST['sel_google_cats'][$key]] = $this->elex_gpf_get_product_ids($cat_cond);
                }
           
        }
        $project_title = trim(sanitize_text_field($_POST['project_title']));
        $project_desc = sanitize_text_field($_POST['description']);
        $project_title = str_replace(' ', '_', $project_title);
        $condition = array();
        $prepend_attr = array();
        $append_attr = array();
        if(isset($_POST['conditions'])) {
            $condition = $_POST['conditions'];
        }
        if(isset($_POST['prepend_attr'])) {
            $prepend_attr = $_POST['prepend_attr'];
        }
        if(isset($_POST['append_attr'])) {
            $append_attr = $_POST['append_attr'];
        }

        if ($_POST['feed_file_type'] == 'xml') {
            $this->elex_gpf_create_project($project_title, $project_desc, $product_ids, $_POST['prod_attr'], $_POST['google_attr'], $_POST['exclude_ids'], $_POST['autoset_identifier_exists'], $condition, $prepend_attr, $append_attr);
        }
        else {

            $tsv = false;
            if($_POST['feed_file_type'] == 'tsv') {
                $tsv = true;
            }
            $this->elex_gpf_create_csv_project($project_title, $product_ids, $_POST['prod_attr'], $_POST['google_attr'], $_POST['exclude_ids'], $_POST['autoset_identifier_exists'], $condition, $prepend_attr, $append_attr,$tsv);
        }
        $temp_arr = [];
        $temp_arr['name'] = sanitize_text_field($_POST['project_title']);
        $temp_arr['description'] = sanitize_text_field($_POST['description']);
        $temp_arr['file'] = $project_title . '.' .$_POST['feed_file_type'];
        $temp_arr['ids'] = $product_ids;
        $temp_arr['sel_google_cats'] = $_POST['sel_google_cats'];
        $temp_arr['google_attr'] = $_POST['google_attr'];
        $temp_arr['prod_attr'] = $_POST['prod_attr'];
        if(!empty($condition)) {
             $temp_arr['conditions'] = $condition;
        }
        if(!empty($prepend_attr)) {
             $temp_arr['prepend_attr'] = $prepend_attr;
        }
        if(!empty($append_attr)) {
             $temp_arr['append_attr'] = $append_attr;
        }
        $temp_arr['refresh_schedule'] = $_POST['refresh_schedule'];
        $temp_arr['refresh_hour'] = $_POST['refresh_hour'];
        $temp_arr['include_variation'] = $_POST['include_variation'];
        $temp_arr['categories_choosen'] = $_POST['categories_choosen'];
        $temp_arr['sale_country'] = sanitize_text_field($_POST['sale_country']);
        $temp_arr['exclude_ids'] = $_POST['exclude_ids'];
        $temp_arr['autoset_identifier_exists'] = $_POST['autoset_identifier_exists'];
        $temp_arr['feed_file_type'] = $_POST['feed_file_type'];
        $temp_arr['refresh_days'] = $_POST['refresh_days'];

        $temp_arr['pause_schedule'] = 'ready';
        if (isset($_POST['is_edit_project']) && $_POST['is_edit_project'] != 'true') {
            $temp_arr['created_date'] = current_time('d-m-Y H:i:s');

        }
        $temp_arr['modified_date'] = current_time('d-m-Y H:i:s');

            $cron_projects = get_option('elex_gpf_cron_projects');
            if (!empty($cron_projects)) {
                foreach ($cron_projects as $key => $value) {
                    if (isset($value['name']) && sanitize_text_field($_POST['project_title']) == $value['name']) {
                        if (isset($_POST['is_edit_project']) && $_POST['is_edit_project'] == 'true') {
                            $temp_arr['created_date'] = $value['created_date'];
                            $temp_arr['pause_schedule'] = $temp_arr['pause_schedule'];
                        }
                        unset($cron_projects[$key]);
                    }
                }
            }
            if ($cron_projects != '') {
                array_unshift($cron_projects, $temp_arr);
                update_option('elex_gpf_cron_projects', $cron_projects);
            } else {
                $arr = [];
                array_unshift($arr, $temp_arr);
                update_option('elex_gpf_cron_projects', $arr);
            }
        die();
    }
    

    function elex_gpf_create_csv_project($project_title, $product_ids, $prod_attr, $google_attr, $exclude_ids, $autoset_identifier_exists, $condition, $prepend_attr, $append_attr, $tsv) {
//        exit('bbbbb');
        $seperated_value = ",";
        $file_mime_type = '.csv';
        if($tsv) {
            $seperated_value = "\t";
            $file_mime_type = '.tsv';
        }
        if($this->setting_tab_fields && isset($this->setting_tab_fields['file_path']) && $this->setting_tab_fields['file_path'] != '') {
            $path = $this->setting_tab_fields['file_path'];
        }
        else {
            $upload_dir = wp_upload_dir();
            $base = $upload_dir['basedir'];
            $path = $base . "/elex-product-feed/";
        }
//        exit('bbbbb');

        if (isset($_POST['is_edit_project']) && $_POST['is_edit_project'] != 'true') {
            $cron_jobs = get_option('elex_gpf_cron_projects');
            if (!empty($cron_jobs)) {
                foreach ($cron_jobs as $key => $value) {
                    if (isset($value['name']) && $project_title == str_replace(' ', '_', $value['name'])) {
                        die('same_name');
                    }
                }
            }
        }
        else {
            if(isset($_POST['file_to_edit']) && $project_title.$file_mime_type != $_POST['file_to_edit']) {
                exit($path . $_POST['file_to_edit']);
                unlink($path . $_POST['file_to_edit']);
            }
        }
        
        $file = $path . "/" . $project_title . $file_mime_type;
        if (!file_exists($path)) {
            wp_mkdir_p($path);
        }

        $csv = '';
        $ship_tax_details = array();
        $ship_or_tax = array();
        foreach ($google_attr as $key => $value) {
            if(substr($value, 0, 8) == 'shipping') {
            array_push($ship_tax_details, $value);
            array_push($ship_or_tax, 'shipping');
            
            }
            elseif(substr($value, 0, 3) == 'tax') {
                array_push($ship_tax_details, $value);
                array_push($ship_or_tax, 'tax');
            }
            else {
                 $csv .= $value . $seperated_value;
            }
        }
        if(!empty($ship_or_tax)) {
            if(sizeof($ship_or_tax) > 1) {
                $csv .= 'shipping,tax,';
            }
            else {
                $csv .= $ship_or_tax[0].$seperated_value;
            }
        }
        $identifier_set = false;
        if(!in_array('identifier_exists', $google_attr) && $autoset_identifier_exists == 'true') {
            $csv .= 'identifier_exists,';
             $identifier_set = true;
        }
        $csv = substr($csv, 0, -1);
        $csv .= "\n";
       
        $product_attributes = $this->elex_gpf_get_product_attributes();
        $updated_ids = array();
        foreach ($product_ids as $key => $val) {
            $temp_cat = explode('-', $key);
            $google_cat = trim($temp_cat[0]);
            foreach ($val as $ids) {
                if (!in_array($ids, $updated_ids)) {
                    array_push($updated_ids, $ids);
                } else {
                    continue;
                }
                if (!is_array($exclude_ids) || !in_array($ids, $exclude_ids)) {
                    $product = wc_get_product($ids);
                    $product_details = $product->get_data();
                    if ($product->is_type('simple')) {
                        $identifiers_exists = 'no';
                        // $add_items = $xml->channel->addChild('item');
                        $shipping_data = array();
                        $tax_data = array();
                        $is_gtin_empty = false;
                        for ($i = 0; $i < count($google_attr); $i++) {
                            $map_prod_attr_val = '';
                            $value_from_condition = '';

                            if(isset($condition[$i])) {
                                $value_from_condition = $this->elex_gpf_get_value_from_condition_simple($condition[$i],$google_attr[$i],$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,'',$add_items);
                            }

                            if($value_from_condition) {
                                $map_prod_attr_val = $value_from_condition;
                            }
                            else {
                       
                                $map_prod_attr_val = $this->elex_gpf_get_simple_product_attr_values($prod_attr[$i],$google_attr[$i],$ids,$product,$product_details,'',$google_cat,$product_attributes,'','');

                                $prepend_text= '';
                                if(isset($prepend_attr[$i])) {
                                        foreach ($prepend_attr[$i] as $prepend_key => $prepend_value) {
                                            $prep_val = $this->elex_gpf_get_simple_product_attr_values($prepend_value[0],$google_attr[$i],$ids,$product,$product_details,'',$google_cat,$product_attributes,'','');

                                            $prepend_result = $this->elex_gpf_prepend_append_value($prep_val,$prepend_value[1],'prepend');
                                            $prepend_text .= $prepend_result;
                                        }
                                        $map_prod_attr_val = $prepend_text . $map_prod_attr_val;
                                    }
                               
                                $append_text = '';
                                if(isset($append_attr[$i])) {
                                        foreach ($append_attr[$i] as $append_key => $append_value) {
                                            $app_val = $this->elex_gpf_get_simple_product_attr_values($append_value[0],$google_attr[$i],$ids,$product,$product_details,'',$google_cat,$product_attributes,'','');

                                            $append_result = $this->elex_gpf_prepend_append_value($app_val,$append_value[1],'append');
                                            $append_text .= $append_result;
                                        }
                                        $map_prod_attr_val = $map_prod_attr_val . $append_text;
                                    }
                                
                            }

                            if ($google_attr[$i] == 'price') {
                                $map_prod_attr_val = $map_prod_attr_val . ' ' . get_woocommerce_currency();
                            }
                            if ($google_attr[$i] == 'shipping-price') {
                                $shipping_data['price'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'shipping-country') {
                                $shipping_data['country'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'shipping-region') {
                                $shipping_data['region'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'shipping-service') {
                                $shipping_data['service'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-rate') {
                                $tax_data['rate'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-country') {
                                $tax_data['country'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-region') {
                                $tax_data['region'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-tax_ship') {
                                $tax_data['tax_ship'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] != 'item_group_id') {
                               $csv .= '"'.htmlspecialchars($map_prod_attr_val).'"' . $seperated_value;
                            }
                            else {
                                 $csv .=  $seperated_value;
                            }
                            if($google_attr[$i] == 'gtin' && $map_prod_attr_val == '') {
                                $is_gtin_empty = true;
                            }
                        }
                        
                            $csv = $this->elex_get_tax_and_ship_details_csv($shipping_data,$tax_data,$csv,$seperated_value);
                            if($identifier_set && $is_gtin_empty) {
                                $csv .= $identifiers_exists.$seperated_value;
                            }
                            $csv = substr($csv, 0, -1);
                            $csv .= "\n";
                    }
                }
            }
        }
       $csv_handler = fopen ($file,'w');
        fwrite ($csv_handler,$csv);
        fclose ($csv_handler);
    }

    function elex_get_tax_and_ship_details_csv ($shipping_data,$tax_data,$csv,$seperated_value) {
        if (!empty($shipping_data)) {
                $ship_keys = array_keys($shipping_data);
                if(in_array('country', $ship_keys)) {
                    $csv .= $shipping_data['country'].':';
                }
                else {
                    $csv .= ':';
                }
                if(in_array('region', $ship_keys)) {
                    $csv .= $shipping_data['region'].':';
                }
                else {
                    $csv .= ':';
                }
                if(in_array('service', $ship_keys)) {
                    $csv .= $shipping_data['service'].':';
                }
                else {
                    $csv .= ':';
                }
                if(in_array('price', $ship_keys)) {
                    $csv .= $shipping_data['price'].$seperated_value;
                }
                else {
                    $csv .= $seperated_value;
                }
            }
            if (!empty($tax_data)) {
                $tax_keys = array_keys($tax_data);
                if(in_array('country', $tax_keys)) {
                    $csv .= $tax_data['country'].':';
                }
                else {
                    $csv .= ':';
                }
                if(in_array('region', $tax_keys)) {
                    $csv .= $tax_data['region'].':';
                }
                else {
                    $csv .= ':';
                }
                if(in_array('rate', $tax_keys)) {
                    $csv .= $tax_data['rate'].':';
                }
                else {
                    $csv .= ':';
                }
                if(in_array('tax_ship', $tax_keys)) {
                    $csv .= $tax_data['tax_ship'].$seperated_value;
                }
                else {
                    $csv .= $seperated_value;
                }
            }
            return $csv;
    }

    function elex_gpf_get_value_from_condition_simple($conditions,$google_attr,$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items) {
        $success = false;
        $map_attr_val = '';
        foreach ($conditions as  $condition) {
            foreach ($condition[0] as $value) {
                if($value[0] && $value[2]) {
                    $attr_val = $this->elex_gpf_get_simple_product_attr_values ($value[0],$google_attr,$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);
                    if($attr_val) {
                        $check_cond = $this->elex_gpf_check_condition($attr_val,$value[1],$value[2]);
                        $success = $check_cond;
                        if($check_cond && $condition[1] == 'OR') {
                            $success = true;
                            break;
                        }
                        else if(!$check_cond && $condition[1] == 'AND') {
                            $success = false;
                            break;
                        }

                    }
                }
            }
            if($success) {
                if($condition[2]) {
                    $map_attr_val = $this->elex_gpf_get_simple_product_attr_values ($condition[2],$google_attr,$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);
                }
                if(isset($condition[3]) && is_array($condition[3])) {
                    $prepend_value = '';
                    foreach ($condition[3] as $value) {
                        if($value[0]) {
                            $value_to_prepend = $this->elex_gpf_get_simple_product_attr_values ($value[0],$google_attr,$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);

                            if($value_to_prepend)
                            $prepend_value .= $this->elex_gpf_prepend_append_value($value_to_prepend,$value[1],'prepend');
                        }
                    }
                    $map_attr_val = $prepend_value .' '. $map_attr_val;
                }
                if(isset($condition[4]) && is_array($condition[4])) {
                    $append_value = '';
                    foreach ($condition[4] as $value) {
                        if($value[0]) {
                            $value_to_append = $this->elex_gpf_get_simple_product_attr_values ($value[0],$google_attr,$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);

                            if($value_to_append)
                            $append_value .= $this->elex_gpf_prepend_append_value($value_to_append,$value[1],'append');
                        }
                        
                    }
                    $map_attr_val .= ' '.$append_value;
                }

                break;
            }
        }
        return $map_attr_val;
    }


    function elex_gpf_check_condition ($attr_val,$condition_param,$compare_with) {
        $check_cond = false;
        switch ($condition_param) {
            case 'contains':
               if(strpos($attr_val, $compare_with) !== false){
                $check_cond = true;
               }
                break;
            case 'string_equals':
                if($attr_val == $compare_with){
                    $check_cond = true;
                }
            break;
            case 'starts_with':
                if(substr($attr_val, 0, strlen($compare_with)) === $compare_with) {
                    $check_cond = true;
                }
            break;
            case 'ends_with':
                if(substr($attr_val, -strlen($compare_with)) === $compare_with) {
                    $check_cond = true;
                }
            break;
            case 'less_than':
                if($attr_val < $compare_with) {
                    $check_cond = true;
                }
            break;
            case 'less_than_equal':
                if($attr_val <= $compare_with) {
                    $check_cond = true;
                }
            break;
            case 'greater_than':
                if($attr_val > $compare_with) {
                    $check_cond = true;
                }
            break;
            case 'greater_than_equal':
                if($attr_val >= $compare_with) {
                    $check_cond = true;
                }
            break;
            case 'arith_equals':
                if($attr_val == $compare_with) {
                    $check_cond = true;
                }
            break;
            
            default:
            $check_cond = false;
                break;
        }
        return $check_cond;
    }

    function elex_gpf_prepend_append_value ($attr_val, $delimeter, $action) {
        $add_delimeter = '';
        switch ($delimeter) {
            case 'space':
                $add_delimeter .= ' ';
                break;
            case 'comma':
                $add_delimeter .= ',';
            break;
            case 'dot':
                $add_delimeter .= '.';
            break;
            case 'less_than':
                $add_delimeter .= '<';
            break;
            case 'greater_than':
                $add_delimeter .= '>';
            break;
            case 'equals':
                $add_delimeter .= '=';
            break;
            case 'double_equals':
                $add_delimeter .= '==';
            break;
            case 'semicolon':
                $add_delimeter .= ';';
            break;
            case 'pipe':
                $add_delimeter .= '|';
            break;
            case 'backslash':
                $add_delimeter .= "\'";
            break;
            case 'forward_slash':
                $add_delimeter .= '/';
            break;
            
            default:
                $add_delimeter .= '';
                break;
        }
        if($action == 'prepend') {
            $attr_val .= $add_delimeter;
        }
        else {
            $attr_val = $add_delimeter.$attr_val;
        }
        return $attr_val;
    }


    function elex_gpf_get_simple_product_attr_values($prod_attr,$google_attr,$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items) {
        $map_prod_attr_val = '';
         $prod_attr_key = $prod_attr;
        $recom_values = explode("_",$prod_attr);
            if($recom_values[0] == 'rec') {
                $map_prod_attr_val = $recom_values[1];
            }
        else if ((strpos($prod_attr, 'elex_text_val', 0) === 0)) {
            $map_prod_attr_val = str_replace('elex_text_val', '', $prod_attr);
        } else if (isset($product_attributes[$prod_attr_key]) && $product_attributes[$prod_attr_key]['type'] == 'meta') {
            $map_prod_attr_val = get_post_meta($ids, $prod_attr, true);
            if($prod_attr == '_tax_class' && $map_prod_attr_val == '') {
                $map_prod_attr_val = 'standard';
            }
            if($google_attr == 'gtin' && $prod_attr == '_elex_gpf_gtin' && $map_prod_attr_val=='' && $autoset_identifier_exists == 'true'){
                $add_items->addChild('identifier_exists', 'no', $prefix['g']);
            }
        } else if ($prod_attr == 'ID') {
            $map_prod_attr_val = $ids;
        } else if ($prod_attr == '_stock_status') {
            $map_prod_attr_val = get_post_meta($ids, $prod_attr, true);
            if($map_prod_attr_val == 'instock') {
                $map_prod_attr_val = 'in stock';
            }
            if($map_prod_attr_val == 'outofstock') {
                $map_prod_attr_val = 'out of stock';
            }
            if($map_prod_attr_val == 'onbackorder') {
                $map_prod_attr_val = 'preorder';
            }
        } else if ($prod_attr == 'post_title') {
            $map_prod_attr_val = $product->get_name();
        } else if ($prod_attr == 'post_content') {
            $map_prod_attr_val = $product_details['description'];
        } else if ($prod_attr == 'post_excerpt') {
            $map_prod_attr_val = $product_details['short_description'];
        } else if ($prod_attr == 'price') {
            $map_prod_attr_val = $product->get_price();
        } else if ($prod_attr == 'attachment_url') {
            $map_prod_attr_val = wp_get_attachment_url(get_post_thumbnail_id($ids));
        } else if ($prod_attr == 'menu_order') {
            $map_prod_attr_val = get_post_field('menu_order', $ids);
        } else if ($prod_attr == 'post_author') {
            $author_id = get_post_field('post_author', $ids);
            $map_prod_attr_val = get_the_author_meta('user_nicename', $author_id);
        } else if ($prod_attr == 'post_date') {
            $time = get_the_time('', $ids);
            $map_prod_attr_val = get_the_date('', $ids) . ' ' . $time;
        } else if ($prod_attr == 'post_date_gmt') {
            $time = get_post_time('', $ids, true);
            $map_prod_attr_val = get_the_date('', $ids);
        } else if ($prod_attr == 'post_modified') {
            $time = get_the_modified_time('', $ids);
            $map_prod_attr_val = get_the_modified_date('', $ids) . ' ' . $time;
        } else if ($prod_attr == 'post_modified_gmt') {
            $map_prod_attr_val = get_the_modified_date('', $ids);
        } else if ($prod_attr == 'permalink') {
            $map_prod_attr_val = get_permalink($ids);
        } else if ($prod_attr == 'google_category') {
            $map_prod_attr_val = $google_cat;
        } elseif ($prod_attr == 'main_image') {
            $image_details = wp_get_attachment_image_src(get_post_thumbnail_id($ids), 'single-post-thumbnail');
            if($image_details) {
                $map_prod_attr_val = $image_details[0];
            }
        } elseif ($prod_attr == 'wc_currency') {
            $map_prod_attr_val = get_woocommerce_currency();
        } else if ($prod_attr == 'product_type') {
            $map_prod_attr_val = 'simple';
        }
        elseif ($prod_attr == 'product_tags') {
            $terms = get_the_terms($ids, 'product_tag');
            if($terms) {
                $map_prod_attr_val = $terms[0]->name;
            }
        }
        elseif ($prod_attr == 'review_comment') {
            $args = array ('post_type' => 'product', 'post_id' => $ids);
            $comments = get_comments( $args );
            if($comments) {
                $map_prod_attr_val = $comments[0]->comment_content;
            }
        }
        elseif ($prod_attr == 'review_count') {
            $map_prod_attr_val = get_post_meta( $ids, '_wc_average_rating', true );
        }

        return $map_prod_attr_val;
    }


    function elex_gpf_create_project($project_title, $project_desc, $product_ids, $prod_attr, $google_attr, $exclude_ids, $autoset_identifier_exists, $condition, $prepend_attr, $append_attr) {
        
        if($this->setting_tab_fields && isset($this->setting_tab_fields['file_path']) && $this->setting_tab_fields['file_path'] != '') {
            $path = $this->setting_tab_fields['file_path'];
        }
        else {
            $upload_dir = wp_upload_dir();
            $base = $upload_dir['basedir'];
            $path = $base . "/elex-product-feed/";
        }
        if (isset($_POST['is_edit_project']) && $_POST['is_edit_project'] != 'true') {
            $cron_jobs = get_option('elex_gpf_cron_projects');
            if (!empty($cron_jobs)) {
                foreach ($cron_jobs as $key => $value) {
                    if (isset($value['name']) && $project_title == str_replace(' ', '_', $value['name'])) {
                        die('same_name');
                    }
                }
            }
        }
        else {
            if(isset($_POST['file_to_edit']) && $project_title.'.xml' != $_POST['file_to_edit']) {
                unlink($path . $_POST['file_to_edit']);
            }
        }
        
        $file = $path . "/" . $project_title . ".xml";
        if (!file_exists($path)) {
            wp_mkdir_p($path);
        }

        $prefix = array(
            'g' => 'http://base.google.com/ns/1.0'
        );
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss xmlns:g="http://base.google.com/ns/1.0"></rss>');
        $xml->addAttribute('version', '2.0');
        $xml->addChild('channel');
        $xml->channel->addChild('title', htmlspecialchars($project_title));
        $xml->channel->addChild('link', site_url());
        if($project_desc =='') {
            $project_desc = $project_title;
        }
        $xml->channel->addChild('description', htmlspecialchars($project_desc));
        $product_attributes = $this->elex_gpf_get_product_attributes();
        $updated_ids = array();
        foreach ($product_ids as $key => $val) {
            $temp_cat = explode('-', $key);
            $google_cat = trim($temp_cat[0]);
            foreach ($val as $ids) {
                if (!in_array($ids, $updated_ids)) {
                    array_push($updated_ids, $ids);
                } else {
                    continue;
                }
                if (!is_array($exclude_ids) || !in_array($ids, $exclude_ids)) {
                    $product = wc_get_product($ids);
                    $product_details = $product->get_data();
                    if ($product->is_type('simple')) {
                        $add_items = $xml->channel->addChild('item');
                        $shipping_data = array();
                        $tax_data = array();
                        for ($i = 0; $i < count($google_attr); $i++) {
                            $map_prod_attr_val = '';
                            $value_from_condition = '';

                            if(isset($condition[$i])) {
                                    $value_from_condition = $this->elex_gpf_get_value_from_condition_simple($condition[$i],$google_attr[$i],$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);
                                }

                                if($value_from_condition) {
                                    $map_prod_attr_val = $value_from_condition;
                                }
                                else {
                           
                                    $map_prod_attr_val = $this->elex_gpf_get_simple_product_attr_values($prod_attr[$i],$google_attr[$i],$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);
                                    $prepend_text = '';
                                    if(isset($prepend_attr[$i])) {
                                        foreach ($prepend_attr[$i] as $prepend_key => $prepend_value) {
                                            $prep_val = $this->elex_gpf_get_simple_product_attr_values($prepend_value[0],$google_attr[$i],$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);

                                            $prepend_result = $this->elex_gpf_prepend_append_value($prep_val,$prepend_value[1],'prepend');
                                            $prepend_text .= $prepend_result;
                                        }
                                        $map_prod_attr_val = $prepend_text . $map_prod_attr_val;
                                    }
                                
                                $append_text = '';
                                if(isset($append_attr[$i])) {
                                        foreach ($append_attr[$i] as $append_key => $append_value) {
                                            $app_val = $this->elex_gpf_get_simple_product_attr_values($append_value[0],$google_attr[$i],$ids,$product,$product_details,$prefix,$google_cat,$product_attributes,$autoset_identifier_exists,$add_items);

                                            $append_result = $this->elex_gpf_prepend_append_value($app_val,$append_value[1],'append');
                                            $append_text .= $append_result;
                                        }
                                        $map_prod_attr_val = $map_prod_attr_val . $append_text;
                                    }
                                }
                            


                            if ($google_attr[$i] == 'price') {
                                $map_prod_attr_val = $map_prod_attr_val . ' ' . get_woocommerce_currency();
                            }
                            if ($google_attr[$i] == 'shipping-price') {
                                $shipping_data['price'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'shipping-country') {
                                $shipping_data['country'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'shipping-region') {
                                $shipping_data['region'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'shipping-service') {
                                $tax_data['service'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-rate') {
                                $tax_data['rate'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-country') {
                                $tax_data['country'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-region') {
                                $tax_data['region'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] == 'tax-tax_ship') {
                                $tax_data['tax_ship'] = $map_prod_attr_val;
                                continue;
                            }
                            if ($google_attr[$i] != 'item_group_id' && $map_prod_attr_val != '') {
                                $add_items->addChild($google_attr[$i], htmlspecialchars($map_prod_attr_val), $prefix['g']);
                            }
                        }
                        if (!empty($shipping_data)) {
                            $shipping = $add_items->addChild('shipping', '', $prefix['g']);
                            foreach ($shipping_data as $key => $val) {
                                $shipping->addChild($key, $val, $prefix['g']);
                            }
                        }
                        if (!empty($tax_data)) {
                            $tax = $add_items->addChild('tax', '', $prefix['g']);
                            foreach ($tax_data as $key => $val) {
                                $tax->addChild($key, $val, $prefix['g']);
                            }
                        }
                    }
                }
            }
        }
        $xml->asXML($file);
    }

    function elex_gpf_mapping_settings_field() {
        check_ajax_referer('ajax-elex-gpf-nonce', '_ajax_elex_gpf_nonce');
        $mapping_attr = $this->elex_gpf_get_mapping_attr($_POST['google_cats'], $_POST['country_of_sale']);
        die(json_encode($mapping_attr));
    }

    function elex_gpf_get_mapping_attr($google_cats, $country) {
        $google_attr = $this->elex_gpf_get_google_attributes();
        $required_attr = array();
        $required_attr['id'] = $google_attr['Basic product data']['id'];
        $required_attr['title'] = $google_attr['Basic product data']['title'];
        $required_attr['description'] = $google_attr['Basic product data']['description'];
        $required_attr['link'] = $google_attr['Basic product data']['link'];
        $required_attr['image_link'] = $google_attr['Basic product data']['image_link'];
        $required_attr['availability'] = $google_attr['Price & availability']['availability'];
        $required_attr['price'] = $google_attr['Price & availability']['price'];
        $required_attr['gtin'] = $google_attr['Product identifiers']['gtin'];
        $required_attr['mpn'] = $google_attr['Product identifiers']['mpn'];
        $required_attr['condition'] = $google_attr['Detailed product description']['condition'];
        $required_attr['adult'] = $google_attr['Detailed product description']['adult'];

        unset($google_attr['Basic product data']['id']);
        unset($google_attr['Basic product data']['title']);
        unset($google_attr['Basic product data']['description']);
        unset($google_attr['Basic product data']['link']);
        unset($google_attr['Basic product data']['image_link']);
        unset($google_attr['Price & availability']['availability']);
        unset($google_attr['Price & availability']['price']);
        unset($google_attr['Product identifiers']['gtin']);
        unset($google_attr['Product identifiers']['mpn']);
        unset($google_attr['Detailed product description']['condition']);
        unset($google_attr['Detailed product description']['adult']);

        if ($country == 'australia' || $country == 'czechia' || $country == 'france' || $country == 'germany' || $country == 'israel' || $country == 'italy' || $country == 'netherlands' || $country == 'spain' || $country == 'switzerland' || $country == 'united_kingdom' || $country == 'united_states') {
            $required_attr['shipping-price'] = $google_attr['Shipping']['shipping-price'];
            unset($google_attr['Shipping']['shipping-price']);
            if ($country == 'united_states') {
                $required_attr['tax-rate'] = $google_attr['Tax']['tax-rate'];
                unset($google_attr['Tax']['tax-rate']);
            }
        }
        if ($country == 'australia' || $country == 'brazil' || $country == 'czechia' || $country == 'france' || $country == 'germany' || $country == 'italy' || $country == 'japan' || $country == 'netherlands' || $country == 'spain' || $country == 'switzerland' || $country == 'united_kingdom' || $country == 'united_states') {
            $required_attr['is_bundle'] = $google_attr['Detailed product description']['is_bundle'];
            unset($google_attr['Detailed product description']['is_bundle']);
        }
        foreach ($google_cats as $google_category) {
            $check = explode('-', $google_category);
            $cat = trim($check[1]);
            if ((strpos($cat, 'Media', 0) !== 0)) {
                if (isset($google_attr['Product identifiers']['brand'])) {
                    $required_attr['brand'] = $google_attr['Product identifiers']['brand'];
                    unset($google_attr['Product identifiers']['brand']);
                }
            }
            if ((strpos($cat, 'Apparel', 0) === 0) || (strpos($cat, 'Media', 0) === 0) || (strpos($cat, 'Software', 0) === 0)) {
                if (isset($google_attr['Product category']['google_product_category'])) {
                    $required_attr['google_product_category'] = $google_attr['Product category']['google_product_category'];
                    unset($google_attr['Product category']['google_product_category']);
                }

                if (strpos($cat, 'Apparel', 0) === 0) {
                    if ($country == 'germany' || $country == 'brazil' || $country == 'japan' || $country == 'france' || $country == 'united_kingdom' || $country == 'united_states') {
                        if (isset($google_attr['Detailed product description']['age_group'])) {
                            $required_attr['age_group'] = $google_attr['Detailed product description']['age_group'];
                            unset($google_attr['Detailed product description']['age_group']);
                        }
                    }
                }
            }

            if ((strpos($cat, 'Apparel & Accessories > Clothing', 0) === 0) || (strpos($cat, 'Apparel & Accessories > Shoe', 0) === 0)) {
                if ($country == 'germany' || $country == 'brazil' || $country == 'france' || $country == 'japan' || $country == 'united_kingdom' || $country == 'united_states') {
                    if (isset($google_attr['Detailed product description']['size'])) {
                        $required_attr['size'] = $google_attr['Detailed product description']['size'];
                        unset($google_attr['Detailed product description']['size']);
                    }
                }
            }
        }

        $product_attr = $this->elex_gpf_get_product_attributes();
        $mapping_attr = array('required_attr' => $required_attr, 'optional' => $google_attr, 'product_attr' => $product_attr);
        return $mapping_attr;
    }

    function elex_gpf_manage_feed_edit_file() {
        $cron_jobs = get_option('elex_gpf_cron_projects');
        $prefill_values = '';
        $mapping_attr = '';
        foreach ($cron_jobs as $key => $value) {
            if (isset($value['file']) && $value['file'] == $_POST['file_to_edit']) {
                $prefill_values = $value;
                $mapping_attr = $this->elex_gpf_get_mapping_attr($value['sel_google_cats'], $value['sale_country']);
                break;
            }
        }
        $mapping_attr['prefill_val'] = $prefill_values;
        die(json_encode($mapping_attr));
    }

    function elex_gpf_get_product_attributes() {
        $prod_meta = array(
            "" =>array("label"=>"-- Choose --","type"=>"","grp_type" => ""),
            "ID" => array("label" => "Product Id", "type" => "","grp_type" => "General"),
            "price" => array("label" => "Price", "type" => "","grp_type" => "General"),
            "_regular_price" => array("label" => "Regular Price", "type" => "meta","grp_type" => "General"),
            "_sale_price" => array("label" => "Sale Price", "type" => "meta","grp_type" => "General"),
            "_tax_class" => array("label" => "Tax Class", "type" => "meta","grp_type" => "General"),
            "_tax_status" => array("label" => "Tax Status", "type" => "meta","grp_type" => "General"),
            "post_title" => array("label" => "Product Title", "type" => "","grp_type" => "General"),
            "_elex_gpf_brand" => array("label" => "Brand", "type" => "meta","grp_type" => "General"),
            "_elex_gpf_gtin" => array("label" => "GTIN", "type" => "meta","grp_type" => "General"),
            "_elex_gpf_mpn" => array("label" => "MPN", "type" => "meta","grp_type" => "General"),
            "post_content" => array("label" => "Product Description", "type" => "","grp_type" => "General"),
            "post_excerpt" => array("label" => "Product Short Description", "type" => "","grp_type" => "General"),
            "post_author" => array("label" => "Post Author", "type" => "","grp_type" => "General"),
            "product_tags" => array("label" => "Product Tags", "type" => "","grp_type" => "General"),
            "product_type" => array("label" => "Product Type", "type" => "","grp_type" => "General"),
            "permalink" => array("label" => "Permalink", "type" => "","grp_type" => "General"),
            "main_image" => array("label" => "Main Image", "type" => "","grp_type" => "General"),
            "wc_currency" => array("label" => "Woocommerce Shop Currency", "type" => "","grp_type" => "General"),
            "_virtual" => array("label" => "Virtual", "type" => "meta","grp_type" => "General"),
            "review_comment" => array("label" => "Review Comment", "type" => "","grp_type" => "General"),
            "review_count" => array("label" => "Average Review Count", "type" => "","grp_type" => "General"),
            
            "_sku" => array("label" => "SKU", "type" => "meta","grp_type" => "Inventory"),
            "_manage_stock" => array("label" => "Manage Stock", "type" => "meta","grp_type" => "Inventory"),
            "_stock" => array("label" => "Stock Quantity", "type" => "meta","grp_type" => "Inventory"),
            "_stock_status" => array("label" => "Stock Status", "type" => "","grp_type" => "Inventory"),
            "_sold_individually" => array("label" => "Sold Individually", "type" => "meta","grp_type" => "Inventory"),
            "_backorders" => array("label" => "Allow Backorders", "type" => "meta","grp_type" => "Inventory"),
            
            "_height" => array("label" => "Height", "type" => "meta","grp_type" => "Shipping"),
            "_width" => array("label" => "Width", "type" => "meta","grp_type" => "Shipping"),
            "_length" => array("label" => "Length", "type" => "meta","grp_type" => "Shipping"),
            "_weight" => array("label" => "Weight", "type" => "meta","grp_type" => "Shipping"),
            
            "menu_order" => array("label" => "Menu Order", "type" => "","grp_type" => "Advanced"),
            "item_group_id" => array("label" => "Item group ID", "type" => "","grp_type" => "Advanced"),
            "google_category" => array("label" => "Google Category", "type" => "","grp_type" => "Advanced"),
        );
        $custom_meta = $this->elex_gpf_get_custom_meta_keys();
        $product_metas = array_merge($prod_meta, $custom_meta);
        return $product_metas;
    }

    function elex_gpf_get_custom_meta_keys() {
        global $wpdb;
        $sql = "SELECT  meta.meta_key  FROM " . $wpdb->prefix . "postmeta" . " AS meta, " . $wpdb->prefix . "posts" . " AS posts WHERE meta.post_id = posts.id AND posts.post_type LIKE '%product%'
    AND (meta.meta_key NOT LIKE '\_%' OR meta.meta_key='_product_attributes') GROUP BY meta.meta_key ORDER BY meta.meta_key ASC;";
        $data = $wpdb->get_results($sql);
        $temp_arr = array();
        $custom_metas = array();
        foreach ($data as $key) {
            $temp_arr = array();
            $temp_arr["label"] = $key->meta_key;
            $temp_arr["type"] = "meta";
            $temp_arr["grp_type"] = "Meta Values";
            $custom_metas[$key->meta_key] = $temp_arr;
        }

        //Get meta keys from settings tab
        $setting_tab_fields = $this->setting_tab_fields;
        if ( $setting_tab_fields && isset( $setting_tab_fields['custom_meta'] ) ) {
            foreach ( $setting_tab_fields[ 'custom_meta' ] as $key => $value ) {
                $custom_metas[ $value ] = array( 'label' => $value, 'type' => 'meta','grp_type' => 'Meta Values' );
            }
        }
        return $custom_metas;
    }

    function elex_gpf_get_google_attributes() {
        return array(
            "Basic product data" => array(
                "id" => array(
                    "label" => "Product ID",
                    "feed_name" => "g:id",
                ),
                "title" => array(
                    "label" => "Product title",
                    "feed_name" => "g:title",
                ),
                "description" => array(
                    "label" => "Product description",
                    "feed_name" => "g:description",
                ),
                "link" => array(
                    "label" => "Product link",
                    "feed_name" => "g:link",
                ),
                "image_link" => array(
                    "label" => "Main image link",
                    "feed_name" => "g:image_link",
                ),
                "additional_image_link" => array(
                    "label" => "Additional image link",
                    "feed_name" => "g:additional_image_link",
                ),
                "mobile_link" => array(
                    "label" => "Product mobile link",
                    "feed_name" => "g:mobile_link",
                ),
            ),
            "Price & availability" => array(
                "availability" => array(
                    "label" => "Stock status",
                    "feed_name" => "g:availability",
                ),
                "availability_date" => array(
                    "label" => "Availability date",
                    "feed_name" => "g:availability_date",
                ),
                "cost_of_goods_sold" => array(
                    "label" => "Cost of goods sold",
                    "feed_name" => "g:cost_of_goods_sold",
                ),
                "expiration_date" => array(
                    "label" => "Expiration date",
                    "feed_name" => "g:expiration_date",
                ),
                "price" => array(
                    "label" => "Price",
                    "feed_name" => "g:price",
                ),
                "sale_price" => array(
                    "label" => "Sale price",
                    "feed_name" => "g:sale_price",
                ),
                "sale_price_effective_date" => array(
                    "label" => "Sale price effective date",
                    "feed_name" => "g:sale_price_effective_date",
                ),
                "unit_pricing_measure" => array(
                    "label" => "Unit pricing measure",
                    "feed_name" => "g:unit_pricing_measure",
                ),
                "unit_pricing_base_measure" => array(
                    "label" => "Unit pricing base measure",
                    "feed_name" => "g:unit_pricing_base_measure",
                ),
                "installment" => array(
                    "label" => "Installment",
                    "feed_name" => "g:installment",
                ),
                "loyalty_points" => array(
                    "label" => "Loyalty points",
                    "feed_name" => "g:loyalty_points",
                ),
            ),
            "Product category" => array(
                "google_product_category" => array(
                    "label" => "Google product category",
                    "feed_name" => "g:google_product_category",
                ),
                "product_type" => array(
                    "label" => "Product type",
                    "feed_name" => "g:product_type",
                ),
            ),
            "Product identifiers" => array(
                "brand" => array(
                    "label" => "Brand",
                    "feed_name" => "g:brand",
                ),
                "gtin" => array(
                    "label" => "GTIN",
                    "feed_name" => "g:gtin",
                ),
                "mpn" => array(
                    "label" => "MPN",
                    "feed_name" => "g:mpn",
                ),
                "identifier_exists" => array(
                    "label" => "Identifier exists",
                    "feed_name" => "g:identifier_exists",
                ),
            ),
            "Detailed product description" => array(
                "condition" => array(
                    "label" => "Condition",
                    "feed_name" => "g:condition",
                ),
                "adult" => array(
                    "label" => "Adult",
                    "feed_name" => "g:adult",
                ),
                "multipack" => array(
                    "label" => "Multipack",
                    "feed_name" => "g:multipack",
                ),
                "is_bundle" => array(
                    "label" => "Is bundle",
                    "feed_name" => "g:is_bundle",
                ),
                "energy_efficiency_class" => array(
                    "label" => "Energy efficiency class",
                    "feed_name" => "g:energy_efficiency_class",
                ),
                "min_energy_efficiency_class" => array(
                    "label" => "Minimum energy efficiency class",
                    "feed_name" => "g:min_energy_efficiency_class",
                ),
                "max_energy_efficiency_class" => array(
                    "label" => "Maximum energy efficiency class",
                    "feed_name" => "g:max_energy_efficiency_class",
                ),
                "age_group" => array(
                    "label" => "Age group",
                    "feed_name" => "g:age_group",
                ),
                "color" => array(
                    "label" => "Color",
                    "feed_name" => "g:color",
                ),
                "gender" => array(
                    "label" => "Gender",
                    "feed_name" => "g:gender",
                ),
                "material" => array(
                    "label" => "Material",
                    "feed_name" => "g:material",
                ),
                "pattern" => array(
                    "label" => "Pattern",
                    "feed_name" => "g:pattern",
                ),
                "size" => array(
                    "label" => "Size",
                    "feed_name" => "g:size",
                ),
                "size_type" => array(
                    "label" => "Size type",
                    "feed_name" => "g:size_type",
                ),
                "size_system" => array(
                    "label" => "Size system",
                    "feed_name" => "g:size_system",
                ),
                "item_group_id" => array(
                    "label" => "Item group ID",
                    "feed_name" => "g:item_group_id",
                ),
            ),
            "Shopping campaigns and other configurations" => array(
                "adwords_redirect" => array(
                    "label" => "Adwords redirect",
                    "feed_name" => "g:adwords_redirect",
                ),
//				"ads_redirect" => array(
//				"label" =>"Ads redirect (new)",
//					"feed_name" => "g:ads_redirect",
//				),
                "excluded_destination" => array(
                    "label" => "Excluded destination",
                    "feed_name" => "g:excluded_destination",
                ),
                "custom_label_0" => array(
                    "label" => "Custom label 0",
                    "feed_name" => "g:custom_label_0",
                ),
                "custom_label_1" => array(
                    "label" => "Custom label 1",
                    "feed_name" => "g:custom_label_1",
                ),
                "custom_label_2" => array(
                    "label" => "Custom label 2",
                    "feed_name" => "g:custom_label_2",
                ),
                "custom_label_3" => array(
                    "label" => "Custom label 3",
                    "feed_name" => "g:custom_label_3",
                ),
                "custom_label_4" => array(
                    "label" => "Custom label 4",
                    "feed_name" => "g:custom_label_4",
                ),
                "promotion_id" => array(
                    "label" => "Promotion ID",
                    "feed_name" => "g:promotion_id",
                ),
                "included_destination" => array(
                    "label" => "Included destination",
                    "feed_name" => "included_destination",
                ),
                "excluded_destination" => array(
                    "label" => "Excluded destination",
                    "feed_name" => "g:excluded_destination",
                ),
            ),
            "Shipping" => array(
                "shipping-price" => array(
                    "label" => "Shipping - Price",
                    "feed_name" => "g:price",
                ),
                "shipping-country" => array(
                    "label" => "Shipping - Country",
                    "feed_name" => "g:country",
                ),
                "shipping-region" => array(
                    "label" => "Shipping - Region",
                    "feed_name" => "g:region",
                ),
                "shipping-service" => array(
                    "label" => "Shipping - Service",
                    "feed_name" => "g:service",
                ),
                "shipping_label" => array(
                    "label" => "Shipping label",
                    "feed_name" => "g:shipping_label",
                ),
                "shipping_weight" => array(
                    "label" => "Shipping weight",
                    "feed_name" => "g:shipping_weight",
                ),
                "shipping_length" => array(
                    "label" => "Shipping length",
                    "feed_name" => "g:shipping_length",
                ),
                "shipping_width" => array(
                    "label" => "Shipping width",
                    "feed_name" => "g:shipping_width",
                ),
                "shipping_height" => array(
                    "label" => "Shipping height",
                    "feed_name" => "g:shipping_height",
                ),
                "min_handling_time" => array(
                    "label" => "Minimum handling time",
                    "feed_name" => "g:min_handling_time",
                ),
                "max_handling_time" => array(
                    "label" => "Maximum handling time",
                    "feed_name" => "g:max_handling_time",
                ),
            ),
            "Tax" => array(
                "tax-rate" => array(
                    "label" => "Tax - Rate",
                    "feed_name" => "g:rate",
                ),
                "tax-country" => array(
                    "label" => "Tax - Country",
                    "feed_name" => "g:country",
                ),
                "tax-region" => array(
                    "label" => "Tax - Region",
                    "feed_name" => "g:region",
                ),
                "tax-tax_ship" => array(
                    "label" => "Tax - Tax on Shipping",
                    "feed_name" => "g:tax_ship",
                ),
                "tax_category" => array(
                    "label" => "Tax category",
                    "feed_name" => "g:tax_category",
                ),
            ),
        );
    }

    function elex_gpf_get_product_ids($cat_cond) {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sql = "SELECT 
                    DISTINCT ID 
                FROM {$prefix}posts 
                    LEFT JOIN {$prefix}term_relationships on {$prefix}term_relationships.object_id={$prefix}posts.ID 
                    LEFT JOIN {$prefix}term_taxonomy on {$prefix}term_taxonomy.term_taxonomy_id  = {$prefix}term_relationships.term_taxonomy_id 
                    LEFT JOIN {$prefix}terms on {$prefix}terms.term_id  ={$prefix}term_taxonomy.term_id 
                WHERE  post_type = 'product' AND post_status='publish'";

        $category_condition = " taxonomy='product_cat' AND slug  in ({$cat_cond}) ";
        $product_type_condition = " taxonomy='product_type'  AND slug  in ('simple') ";
        $main_query = $sql . " AND " . $category_condition . " AND ID IN (" . $sql . " AND " . $product_type_condition . ")";
        $result = $wpdb->get_results($main_query, ARRAY_A);
        $ids = wp_list_pluck($result, 'ID');
        return $ids;
    }

}

new Elex_gpf_ajax_call();

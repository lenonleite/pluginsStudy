<?php


namespace WPDM\Category;


use WPDM\__\Template;
use WPDM\__\Query;

class Shortcodes
{
    function __construct()
    {
        add_shortcode("wpdm_category", [$this, 'listPackages']);
        add_shortcode('wpdm_category_link', [$this, 'categoryLink']);
    }

    function listPackages($params = array('id' => '', 'operator' => 'IN', 'items_per_page' => 10, 'title' => false, 'desc' => false, 'orderby' => 'create_date', 'order' => 'desc', 'paging' => false, 'toolbar' => 1, 'template' => '', 'cols' => 3, 'colspad' => 2, 'colsphone' => 1, 'morelink' => 1))
    {
        /*extract($params);
        $fnparams = $params;
        if (!isset($id)) return '';
        if (!isset($items_per_page)) $items_per_page = 10;
        if (!isset($template)) $template = 'link-template-calltoaction3.php';
        if (!isset($cols)) $cols = 3;
        if (!isset($colspad)) $colspad = 2;
        if (!isset($colsphone)) $colsphone = 1;
        $toolbar = isset($toolbar) ? $toolbar : 0;
        $scid = isset($scid) ? $scid : md5($id);
        $taxo = 'wpdmcategory';
        if (isset($tag) && $tag == 1) $taxo = 'wpdmtag';
        $css_class = isset($css_class) ? $css_class : '';
        $cwd_class = "col-lg-" . (int)(12 / $cols);
        $cwdsm_class = "col-md-" . (int)(12 / $colspad);
        $cwdxs_class = "col-" . (int)(12 / $colsphone);

        $id = trim($id, ", ");
        $cids = explode(",", $id);

        global $wpdb, $current_user, $post, $wp_query;

        $orderby = isset($orderby) ? $orderby : 'publish_date';
        $orderby = in_array(wpdm_query_var('orderby'), array('title', 'publish_date', 'updates', 'download_count', 'view_count')) ? wpdm_query_var('orderby') : $orderby;

        $order = isset($fnparams['order']) ? $fnparams['order'] : 'desc';
        $order = wpdm_query_var('order') ? wpdm_query_var('order') : $order;
        $operator = isset($operator) ? $operator : 'IN';
        //$cpvid = str_replace(",", "_", $id);
        //$cpvar = 'cp_'.$cids[0];
        $term = get_term_by('slug', $cids[0], 'wpdmcategory');
        if(!$term) return apply_filters("wpdm_category_not_found", __( "Category doesn't exist", 'download-manager' ));
        $cpvar = 'cp_' . $term->term_id;
        $cp = wpdm_query_var($cpvar, 'num');
        if (!$cp) $cp = 1;

        $query = new Query();
        $query->items_per_page($items_per_page);
        $query->paged($cp);
        $query->sort($orderby, $order);
        $query->categories($cids, 'slug', $operator, wpdm_valueof($params, 'include_children', false));

        if (get_option('_wpdm_hide_all', 0) == 1) {
            $query->meta("__wpdm_access", '"guest"');

            if (is_user_logged_in()) {
                foreach ($current_user->roles as $role) {
                    $query->meta("__wpdm_access", $role);
                }
                $query->meta_relation('OR');
            }
        }

        if (wpdm_query_var('skw', 'txt') != '') {
            $query->s(wpdm_query_var('skw', 'txt'));
        }

        $query->process();
        $total = $query->count;
        $packs = $query->packages();
        $pages = ceil($total / $items_per_page);
        $burl = get_permalink();

        $html = '';
        $templates = maybe_unserialize(get_option("_fm_link_templates", true));

        if (isset($templates[$template])) $template = $templates[$template]['content'];

        foreach ($packs as $pack) {
            $pack = (array)$pack;
            $thtml = WPDM()->package->fetchTemplate($template, $pack);
            $repeater = '';
            if ($thtml != '')
                $repeater = "<div class='{$cwd_class} {$cwdsm_class} {$cwdxs_class}'>" . $thtml . "</div>";
            $html .= $repeater;

        }

        wp_reset_postdata();

        $html = "<div class='row'>{$html}</div>";
        $cname = array();
        foreach ($cids as $cid) {
            $cat = get_term_by('slug', $cid, $taxo);
            if ($cat)
                $cname[] = $cat->name;

        }
        $cats = implode(", ", $cname);

        //Added from v4.2.1
        $desc = '';
        $category = new Category($cids[0]);  //get_term_by('slug', $cids[0], 'wpdmcategory');

        if (isset($fnparams['title']) && $fnparams['title'] != false && intval($fnparams['title']) != 1) $cats = $fnparams['title'];
        if (isset($fnparams['desc']) && $fnparams['desc'] != false && intval($fnparams['desc']) != 1) $desc = $fnparams['desc'];
        if (isset($fnparams['desc']) && (int)$fnparams['desc'] == 1) $desc = $category->description;

        $cimg = '';


        $subcats = '';
        if (function_exists('wpdm_ap_categories') && $subcats == 1) {
            $schtml = wpdm_ap_categories(array('parent' => $id));
            if ($schtml != '') {
                $subcats = "<fieldset class='cat-page-tilte'><legend>" . __("Sub-Categories", "download-manager") . "</legend>" . $schtml . "<div style='clear:both'></div></fieldset>" . "<fieldset class='cat-page-tilte'><legend>" . __("Downloads", "download-manager") . "</legend>";
                $efs = '</fieldset>';
            }
        }
        $pagination = "";
        if (!isset($paging) || intval($paging) == 1) {
            $pag_links = wpdm_paginate_links($total, $items_per_page, $cp, $cpvar, array('container' => '#content_' . $scid, 'async' => (isset($async) && $async == 1 ? 1 : 0), 'next_text' => ' <i style="display: inline-block;width: 8px;height: 8px;border-right: 2px solid;border-top: 2px solid;transform: rotate(45deg);margin-left: -2px;margin-top: -2px;"></i> ', 'prev_text' => ' <i style="display: inline-block;width: 8px;height: 8px;border-right: 2px solid;border-bottom: 2px solid;transform: rotate(135deg);margin-left: 2px;margin-top: -2px;"></i> '));
            $pagination = "<div style='clear:both'></div>" . $pag_links . "<div style='clear:both'></div>";
        } else
            $pgn = "";

        global $post;

        $sap = get_option('permalink_structure') ? '?' : '&';
        $burl = $burl . $sap;
        if (isset($_GET['p']) && $_GET['p'] != '') $burl .= 'p=' . esc_attr($_GET['p']) . '&';
        if (isset($_GET['src']) && $_GET['src'] != '') $burl .= 'src=' . esc_attr($_GET['src']) . '&';
        $order = ucfirst($order);
        $orderby_label = " " . __(ucwords(str_replace("_", " ", $orderby)), "wpdmpro");
        $ttitle = __("Title", "download-manager");
        $tdls = __("Downloads", "download-manager");
        $tcdate = __("Publish Date", "download-manager");
        $tudate = __("Update Date", "download-manager");
        $tasc = __("Asc", "download-manager");
        $tdsc = __("Desc", "download-manager");
        $tsrc = __("Search", "download-manager");
        $ord = __("Order", "download-manager");
        $order_by_label = __("Order By", "download-manager");
        $hasdesc = $desc != '' ? 'has-desc' : '';

        $icon = $category->icon;
        if(!isset($iconw)) $iconw = $desc != '' ? 64 : 32;
        if ($icon != '') $icon = "<div class='pull-left mr-3'><img class='category-icon m-0 category-{$category->ID}' style='max-width: {$iconw}px' src='{$icon}' alt='{$category->name}' /></div>";

        $title = $cats;

        ob_start();
        include Template::locate("category-shortcode.php", __DIR__.'/views');
        $content = ob_get_clean();
        return $content;*/
        $params['categories'] = $params['id'];
        unset($params['id']);
        return WPDM()->package->shortCodes->packages($params);

    }

    function categoryLink($params)
    {
        $category = new Category(wpdm_valueof($params, 'id'));
        if(!$category->ID) return '';
        $cat = (array)$category;
        $cat['icon'] = $category->icon ? "<img src='{category->icon}' alt='{$category->name}' />" : "";
        $template = isset($params['template']) && $params['template'] != '' ? $params['template'] : 'category-link-shortcode.php';
        return Template::output($template, $cat, __DIR__.'/views');
    }

}

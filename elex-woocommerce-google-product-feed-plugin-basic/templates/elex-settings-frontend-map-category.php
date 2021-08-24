<?php
if (!defined('ABSPATH')) {
    exit;
}
                $cat_args = array(
                    'hide_empty' => 0,
                    'taxonomy' => 'product_cat',
                    'hierarchical' => 1,
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'child_of' => 0,
                );
                $cat_hierarchy = elex_gpf_get_cat_hierarchy(0, $cat_args);
                $cat_rows = elex_gpf_category_rows($cat_hierarchy, 0, 'elex_cat_filter');
?>
<div id="settings_map_category" class="wrap postbox elex-gpf-table-box elex-gpf-table-box-main ">
    <table>
        <tr>
            <td>
                <h1><?php _e('Map Category', 'elex-product-feed'); ?></h1>
            </td>
            <td>
                 <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Map your WooCommerce product categories with corresponding Google categories. Start typing in the Google category field to get options to map. Please make sure to enable mapping by clicking the corresponding checkbox.', 'elex-product-feed'); ?>'></span>
            </td>
        </tr>
    </table>
    
    <table id="elex_cat_table" class="widefat">
       
        <thead>
            <tr>
                <th class="elex-gpf-catmap-checkbox check-column" style="padding-left: inherit;"><input type="checkbox" /></th>
                <th class="elex-gpf-settings-table-cat-map-left"> <?php _e('<b>Product Category</b>', 'elex-product-feed'); ?></th>
                <th class="elex-gpf-settings-table-cat-map-middle"> <?php _e('<b>Google Category</b>', 'elex-product-feed'); ?></th>
            </tr>
        </thead>
    
    <?php
        foreach ($cat_rows as $cat_slug => $cat_name) {
           ?>
            <tr>
                <td class="elex-gpf-catmap-checkbox check-column"><input value="<?php echo $cat_slug; ?>" type="checkbox" /></td>
                <td class="elex-gpf-settings-table-cat-map-left"> <?php echo $cat_name; ?></td>
                <td class="elex-gpf-settings-table-cat-map-middle"><div class="elex_google_cats_auto"><input class="typeahead" id="elex_google_cats_<?php echo $cat_slug; ?>" style="width: 100%;" type="text" placeholder="Google Categories"></div> </td>
            </tr>
           <?php
        }
    ?>
   
    </table>
    <div style="margin-top: 1%;">
        <button id="category_back_button" class="botton button-large button-primary" ><?php _e('Back', 'elex-product-feed'); ?></button>
        <button id="elex_map_cat_nochange" class="botton button-large button-primary" ><?php _e('Skip & Continue', 'elex-product-feed'); ?></button>
        <button id="save_settings_cat_map" class="botton button-large button-primary" style="float: right;"><?php _e('Save & Continue', 'elex-product-feed'); ?></button>
    </div>
    
</div>
<?php
include_once ELEX_PRODUCT_FEED_TEMPLATE_PATH . "/elex-settings-frontend-map-attributes.php";

function elex_gpf_get_cat_hierarchy($parent, $args) {
    $cats = get_categories($args);
    $ret = new stdClass;
    foreach ($cats as $cat) {
        if ($cat->parent == $parent) {
            $id = $cat->cat_ID;
            $ret->$id = $cat;
            $ret->$id->children = elex_gpf_get_cat_hierarchy($id, $args);
        }
    }
    return $ret;
}

function elex_gpf_category_rows($categories, $level, $name) {
    $html_code = array();
    $level_indicator = '';
    for ($i = 0; $i < $level; $i++) {
        $level_indicator .= '- ';
    }
    if ($categories) {
        foreach ($categories as $category) {
            $html_code[$category->slug] =  $level_indicator . $category->name . ' <a target = "_blank" href= '.home_url().'/wp-admin/edit.php?product_cat='.$category->slug.'&post_type=product>(' .$category->count. ')</a>' ;
            if ($category->children && count((array) $category->children) > 0) {
                $html_code = array_merge($html_code,elex_gpf_category_rows($category->children, $level + 1, $name));
            }
        }
    } else {
        $html_code = esc_html__('No categories found.', 'eh_bulk_edit');
    }
    return $html_code;
}

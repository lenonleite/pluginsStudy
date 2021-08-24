<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="exclude_include" class="wrap postbox elex-gpf-table-box elex-gpf-table-box-main ">
    <h1>
        <?php _e('Exclusion', 'elex-product-feed'); ?>
    </h1>
    <table id="elex_exclusion_inclusion" class="elex-gpf-settings-table">
        <tr>
            <td class="elex-gpf-settings-table-exclude-left">
                <?php _e('Exclude Products', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-exclude-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Start typing in the field to choose product(s) to exclude.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-exclude-right">
                <select class="wc-product-search" multiple="multiple" style="width: 50%;height:30px" id="elex_exclude_products" data-placeholder="<?php esc_attr_e('Search for a product&hellip;', 'elex-product-feed'); ?>" data-action="woocommerce_json_search_products_and_variations"></select>
            </td>
        </tr>
    </table>
    <button id="exclude_back_button" class="botton button-large button-primary">Back</button>
    <button id="generate_feed_button" class="botton button-large button-primary">Generate Feed</button>
</div>
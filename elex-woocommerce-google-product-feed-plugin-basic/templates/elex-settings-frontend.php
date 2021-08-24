<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="elex-gpf-loader"></div>
<div id="settings_first_section" class="wrap postbox elex-gpf-table-box elex-gpf-table-box-main ">
    <h1>Google Product Feed</h1>
    <table>
        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('Project Name <span style="color:red;">*</span>', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Enter a name for the product feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <input type="text" id="elex_project_title" style="width:25%;">
            </td>
        </tr>
        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('Project Description', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Enter a description for the product feed. Leave it blank to use Project Name as Project Description.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <input type="text" id="elex_project_description" style="width:25%;">
            </td>
        </tr>
        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('Select Country <span style="color:red;">*</span>', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the country where you want to market the products in this feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <?php
                $countries = include ELEX_PRODUCT_FEED_PLUGIN_PATH . 'includes/elex-country-of-sale.php';
                ?>
                <select id="country_of_sale" style="width:25%;">
                    <option value="">--Select Country--</option>
                    <?php
                    foreach ($countries as $key => $val) {
                        echo "<option value=$key>$val</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('Include Variations <span style="vertical-align: super;color:green;font-size:12px">Premium</span>', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Enable this field to include variable products in the feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <input id="include_variation" type="checkbox" disabled>
            </td>
        </tr>

        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('Default Category', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Choose a Google category. This category will be mapped to all the product categories on your WooCommerce store by default.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <div class="elex_google_cats_auto">
                    <input class="typeahead" id="elex_default_google_category" type="text" placeholder="Default Google Category">
                </div>
            </td>
        </tr>

        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('File Format', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the file format to create the feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <select id="feed_file_type" style="width:25%;">
                    <option value="xml">XML</option>
                    <option value="csv">CSV</option>
                    <option value="tsv">TSV</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="elex-gpf-settings-table-left">
                <?php _e('Refresh Schedule', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select a time interval to refresh the product feed. This will help to update the feed with any changes you make on your WooCommerce store.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <select id="refresh_schedule" style="width:25%;">
                    <option value="no_refresh">No Refresh</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
            </td>
        </tr>
        <tr id="elex_select_weekly_day">
            <td class="elex-gpf-settings-table-left">
                <?php _e('Select Days', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the days on which you want to refresh the feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <select id="elex_weekly_days" multiple class='elex-gpf-multiple-chosen'>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                </select>
            </td>
        </tr>

        <tr id="elex_select_monthly_day">
            <td class="elex-gpf-settings-table-left">
                <?php _e('Select Days', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the days on which you want to refresh the feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <select id="elex_monthly_days" multiple class='elex-gpf-multiple-chosen'>
                   <?php 
                            for($flag=1;$flag<32;$flag++) {
                                 echo "<option value='$flag'>$flag</option>";
                            }
                    ?>
                </select>
            </td>
        </tr>

        <tr id="refresh_time_field">
            <td class="elex-gpf-settings-table-left">
                <?php _e('Select Time', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Select the time to refresh the feed.', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <select id="refresh_hour">
                    <option value="0">12 AM</option>
                    <option value="1">1 AM</option>
                    <option value="2">2 AM</option>
                    <option value="3">3 AM</option>
                    <option value="4">4 AM</option>
                    <option value="5">5 AM</option>
                    <option value="6">6 AM</option>
                    <option value="7">7 AM</option>
                    <option value="8">8 AM</option>
                    <option value="9">9 AM</option>
                    <option value="10">10 AM</option>
                    <option value="11">11 AM</option>
                    <option value="12">12 PM</option>
                    <option value="13">1 PM</option>
                    <option value="14">2 PM</option>
                    <option value="15">3 PM</option>
                    <option value="16">4 PM</option>
                    <option value="17">5 PM</option>
                    <option value="18">6 PM</option>
                    <option value="19">7 PM</option>
                    <option value="20">8 PM</option>
                    <option value="21">9 PM</option>
                    <option value="22">10 PM</option>
                    <option value="23">11 PM</option>
                </select>
            </td>
        </tr>
 <table>
        <tr>
            <td class="elex-gpf-settings-table-left" id="elex_gpf_advanced_settings_div">
                <a href="javaScript:void(0)" id="elex_gpf_advanced_settings"><h3><?php _e('Advanced Options', 'elex-product-feed'); ?><span class="elex-gpf-icon-arrow-down"  title="View Feed" onclick="" style="display: inline-block; margin: 0px 2px 0px;"></span></h3></a>
                
            </td>
            <td class="elex-gpf-settings-table-left" id="elex_gpf_advanced_settings_div2">
                <a href="javaScript:void(0)" id="elex_gpf_advanced_settings2"><h3><?php _e('Advanced Options', 'elex-product-feed'); ?><span class="elex-gpf-icon-arrow-up"  title="View Feed" onclick="" style="display: inline-block; margin: 0px 2px 0px;"></span></h3></a>
            </td>
        </tr>
        <tr id="elex_gpf_advanced_div">
            <td class="elex-gpf-settings-table-left">
                <?php _e('Auto-set identifier_exists', 'elex-product-feed'); ?>
            </td>
            <td class='elex-gpf-settings-table-middle'>
                <span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Enable this field when you have some products without unique product identifiers (gtin, mpn, brand). This will create the feed with "identifier_exists" set to "no".', 'elex-product-feed'); ?>'></span>
            </td>
            <td class="elex-gpf-settings-table-right">
                <input id="autoset_identifier_exists" type="checkbox">
            </td>
        </tr>
         </table>
    </table>
    <div style="margin-bottom: 2%;">

    <button id="elex_settings_nochange" class="botton button-large button-primary" >Skip & Continue</button>
    <button id="save_settings_first_page" class="botton button-large button-primary" style="float: right;">Save & Continue</button>
</div>
</div>
<?php
include_once ELEX_PRODUCT_FEED_TEMPLATE_PATH . "/elex-settings-frontend-map-category.php";

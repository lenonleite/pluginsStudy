<?php
if (!defined('ABSPATH')) {
    exit;
}

class Elex_manage_feeds {

    function __construct() {
        $this->elex_gpf_manage_feeds_tabs();
        $this->elex_gpf_register_styles_scripts();
    }

    function elex_gpf_manage_feeds_tabs() {
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="admin.php?page=elex-product-feed-manage" class="nav-tab  nav-tab-active"><?php esc_html_e('Manage Feeds', 'elex-product-feed'); ?></a>
            <a href="admin.php?page=elex-product-feed" class="nav-tab"><?php esc_html_e('Create Feed', 'elex-product-feed'); ?></a>
            <a href='admin.php?page=elex-product-feed-settings' class='nav-tab'><?php esc_html_e('Settings', 'elex-product-feed'); ?></a>
            <a href="admin.php?page=elex-product-feed-go-premium" style="color:red;"  class="nav-tab"><?php esc_html_e('Go Premium', 'elex-product-feed'); ?></a>
        </h2>

        <div class="elex-gpf-steps-navigator">
            <div id ="elex_gpf_step1" class="elex-gpf-steps active">
                <?php _e('START', 'elex-product-feed'); ?>
            </div>
            <div id ="elex_gpf_step2" class="elex-gpf-steps">
                <?php _e('MAP CATEGORY', 'elex-product-feed'); ?>
            </div>
            <div id ="elex_gpf_step3" class="elex-gpf-steps ">
                <?php _e('MAP ATTRIBUTES', 'elex-product-feed'); ?>
            </div>
            <div id ="elex_gpf_step4" class="elex-gpf-steps">
                <?php _e('EXCLUSIONS', 'elex-product-feed'); ?>
            </div>
        </div>
        <?php
    }

    function elex_gpf_register_styles_scripts() {
        wp_nonce_field('ajax-elex-gpf-manage-feed-nonce', '_ajax_elex_gpf_manage_feed_nonce');
        wp_register_style('elex-manage-feed-style', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/css/elex-manage-feed-styles.css');
        wp_enqueue_style('elex-manage-feed-style');
        wp_register_script('elex-manage-feed-script', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/elex-manage-feed-scripts.js');
        wp_enqueue_script('elex-manage-feed-script');
        wp_nonce_field('ajax-elex-gpf-nonce', '_ajax_elex_gpf_nonce');
        wp_register_style('elex-setting-style', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/css/elex-setting-styles.css');
        wp_enqueue_style('elex-setting-style');
        wp_register_script('elex-setting-script', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/elex-setting-scripts.js');
        wp_enqueue_script('elex-setting-script');

        wp_register_script('elex-edit-feeds', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/elex-edit-feeds.js');
        wp_enqueue_script('elex-edit-feeds');

        wp_register_script('elex-typeahead-script', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/elex-typeahead.js');
        wp_enqueue_script('elex-typeahead-script');
		
		$saved_settings_tab_data = get_option('elex_settings_tab_fields_data');
        $language_selected = isset($saved_settings_tab_data['cat_language']) ? $saved_settings_tab_data['cat_language'] : 'en';
        wp_register_script('elex-load-cat-language', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/elex-load-google-categories-in-"'.$language_selected.'".js');
        wp_enqueue_script('elex-load-cat-language');
        wp_register_script('elex-cats-auto-complete-script', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/elex-cats-auto-complete.js');
        wp_enqueue_script('elex-cats-auto-complete-script');

        wp_register_script('elex-multiple-chosen-script', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/js/chosen.jquery.js');
        wp_enqueue_script('elex-multiple-chosen-script');
        
        global $woocommerce;
        $woocommerce_version = function_exists('WC') ? WC()->version : $woocommerce->version;
        wp_enqueue_style('woocommerce_admin_styles', $woocommerce->plugin_url() . '/assets/css/admin.css', array(), $woocommerce_version);
        wp_register_style('elex-gpf-plugin-bootstrap', plugins_url('/assets/css/bootstrap.css', dirname(__FILE__)));
        wp_enqueue_style('elex-gpf-plugin-bootstrap');
        wp_register_script('elex-gpf-tooltip-jquery', plugins_url('/assets/js/tooltip.js', dirname(__FILE__)));
        wp_enqueue_script('elex-gpf-tooltip-jquery');
        wp_enqueue_script('wc-enhanced-select');
    }

}

new Elex_manage_feeds();
include_once ELEX_PRODUCT_FEED_TEMPLATE_PATH . "/elex-manage-feed-template.php";

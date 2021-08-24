<?php

/*
  Plugin Name: ELEX WooCommerce Google Shopping (Google Product Feed) - Basic
  Plugin URI: https://elextensions.com/plugin/elex-woocommerce-google-product-feed-plugin-free/
  Description: Google product feed
  Version: 1.1.6
  WC requires at least: 2.6.0
  WC tested up to: 4.9
  Author: ELEXtensions
  Author URI: https://elextensions.com/plugin/elex-woocommerce-google-product-feed-plugin-free/
  Developer: ELEXtensions
  Developer URI: https://elextensions.com
  Text Domain: elex-product-feed
 */

if (!defined('ABSPATH')) { 
    exit;
}
// Check if woocommerce is active
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    return;
}
if (!defined('ELEX_PRODUCT_FEED_PLUGIN_PATH')) {
    define('ELEX_PRODUCT_FEED_PLUGIN_PATH', plugin_dir_path(__FILE__));
}
if (!defined('ELEX_PRODUCT_FEED_TEMPLATE_PATH')) {
    define('ELEX_PRODUCT_FEED_TEMPLATE_PATH', ELEX_PRODUCT_FEED_PLUGIN_PATH . 'templates');
}
if (!defined('ELEX_PRODUCT_FEED_MAIN_URL_PATH')) {
    define('ELEX_PRODUCT_FEED_MAIN_URL_PATH', plugin_dir_url(__FILE__));
}
add_action('admin_menu', 'elex_gpf_basic_add_menu');

function elex_gpf_basic_add_menu() {
    add_menu_page('ELEX Product Feed', 'ELEX Product Feed', 'manage_options', 'elex-product-feed-manage', 'elex_gpf_basic_sub_menu');
    add_submenu_page('elex-product-feed-manage', 'ELEX Product Feed', 'Manage Feeds', 'manage_options', 'elex-product-feed-manage', 'elex_gpf_basic_sub_menu');
    add_submenu_page('elex-product-feed-manage', 'ELEX Product Feed', 'Create Feed', 'manage_options', 'elex-product-feed', 'elex_gpf_basic_product_feed_actions');
    add_submenu_page('elex-product-feed-manage', 'ELEX Product Feed', 'Settings', 'manage_options', 'elex-product-feed-settings', 'elex_gpf_basic_settings_tab_content');
    add_submenu_page('elex-product-feed-manage', 'ELEX Product Feed', 'Go Premium', 'manage_options', 'elex-product-feed-go-premium', 'elex_gpf_basic_go_premium');
}

function elex_gpf_basic_settings_tab_content() {
    ?>
        <h2 class='nav-tab-wrapper'>
        <a href='admin.php?page=elex-product-feed-manage' class='nav-tab  '><?php esc_html_e('Manage Feeds', 'elex-product-feed'); ?></a>
        <a href='admin.php?page=elex-product-feed' class='nav-tab'><?php esc_html_e('Create Feed', 'elex-product-feed'); ?></a>
        <a href='admin.php?page=elex-product-feed-settings' class='nav-tab nav-tab-active'><?php esc_html_e('Settings', 'elex-product-feed'); ?></a>
        <a href="admin.php?page=elex-product-feed-go-premium" style="color:red;"  class="nav-tab"><?php esc_html_e('Go Premium', 'elex-product-feed'); ?></a>
        </h2>
    <?php

    include_once( 'templates/class-elex-settings-tab-fields.php' );
   
}


function elex_gpf_basic_sub_menu() {
    if ( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    include_once( 'includes/elex-manage-feeds-tab.php' );
}

register_activation_hook(__FILE__, 'elex_gpf_activate_basic_plugin');
if (!function_exists('elex_gpf_activate_basic_plugin')) {
    function elex_gpf_activate_basic_plugin() {
        if (is_plugin_active('elex-product-feed/elex-product-feed.php')) {
            deactivate_plugins(basename(__FILE__));
            wp_die(__("Oops! You tried installing the Basic version without deactivating and deleting the Premium version. Kindly deactivate and delete ELEX Product Feed and then try again", "elex-product-feed"), "", array('back_link' => 1));
        }
    }
}


function elex_gpf_basic_product_feed_actions() {
    include_once('includes/elex-settings-section.php');
}
function elex_gpf_basic_go_premium () {
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="admin.php?page=elex-product-feed-manage" class="nav-tab  "><?php esc_html_e('Manage Feeds', 'elex-product-feed'); ?></a>
        <a href="admin.php?page=elex-product-feed" class="nav-tab"><?php esc_html_e('Create Feed', 'elex-product-feed'); ?></a>
        <a href='admin.php?page=elex-product-feed-settings' class='nav-tab '><?php esc_html_e('Settings', 'elex-product-feed'); ?></a>
        <a href="admin.php?page=elex-product-feed-go-premium" style="color:red;"  class="nav-tab nav-tab-active"><?php esc_html_e('Go Premium', 'elex-product-feed'); ?></a>
    </h2>
    <br>
<?php
    wp_enqueue_style('elex-gpf-bootstrap', ELEX_PRODUCT_FEED_MAIN_URL_PATH . 'resources/css/market-bootstrap.css');
     include_once("includes/market.php");
}

add_filter('cron_schedules', 'elex_gpf_basic_custom_schedules');

function elex_gpf_basic_custom_schedules($schedules) {
    $schedules['every_thirty_minutes'] = array(
        'interval' => 1800,
        'display' => __('Every thirty minutes', 'textdomain')
    );
    return $schedules;
}

if (!wp_next_scheduled('elex_run_every_thirty_minutes')) {
    wp_schedule_event(time(), 'every_thirty_minutes', 'elex_run_every_thirty_minutes');
}
add_action('elex_run_every_thirty_minutes', 'elex_gpf_basic_cron_function');

function elex_gpf_basic_cron_function() {
    include_once('includes/elex-cron-schedule.php');
}
add_action('init', 'elex_gpf_basic_include_files');

function elex_gpf_basic_include_files() {
    include_once('includes/elex-ajax-functions.php');
    include_once('includes/elex-manage-feed-ajax.php');
    include_once('includes/elex-add-custom-fields.php');
    include_once('includes/elex-save-settings-tab-fields.php');
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'elex_gpf_basic_product_feed_action_links');

function elex_gpf_basic_product_feed_action_links($links) {
    $plugin_links = array(
        '<a href="' . admin_url('admin.php?page=elex-product-feed') . '">' . __('Settings', 'elex-product-feed') . '</a>',
        '<a href="https://elextensions.com/documentation/" target="_blank">' . __('Documentation', 'elex-product-feed') . '</a>',
        '<a href="https://elextensions.com/support/" target="_blank">' . __('Support', 'elex-product-feed') . '</a>',
        '<a href="https://elextensions.com/plugin/woocommerce-google-product-feed-plugin/" target="_blank">' . __('Premium Upgrade', 'elex-product-feed') . '</a>'
    );
    return array_merge($plugin_links, $links);
}
function elex_gpf_basic_load_plugin_textdomain() {
    load_plugin_textdomain( 'elex-product-feed', FALSE, basename( dirname( __FILE__ ) ) . '/language/' );
}
add_action( 'plugins_loaded', 'elex_gpf_basic_load_plugin_textdomain' );

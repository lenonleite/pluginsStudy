<?php

/**
 * Plugin Name:       Paypal Donation Block
 * Plugin URI:        https://about.me/bharatkambariya
 * Description:       Create your own PayPal block as many as you want as per your need in simple way.
 * Version:           1.0.2
 * Author:            bharatkambariya
 * Author URI:        https://profiles.wordpress.org/bharatkambariya/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       paypal-donation-block
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}


if (!class_exists('Paypal_Donation_Block')) {

    /**
     * Plugin main class.
     *
     * @package Paypal_Donation_Block
     */
    class Paypal_Donation_Block {

        /**
         * Plugin version.
         *
         * @var string
         */
        const VERSION = '1.0.0';

        /**
         * Instance of this class.
         *
         * @var object
         */
        protected static $instance = null;

        /**
         * Initialize the plugin public actions.
         */
        private function __construct() {
            add_action('init', array($this, 'pdb_load_plugin_textdomain'));
            add_shortcode('paypal_donation_block', array($this, 'create_donation_block_shortcode'));
            add_filter('widget_text', 'do_shortcode');
        }

        /**
         * Return an instance of this class.
         *
         * @return object A single instance of this class.
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Load the plugin text domain for translation.
         */
        public function pdb_load_plugin_textdomain() {
            load_plugin_textdomain('paypal-donation-block', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }

        public function create_donation_block_shortcode($atts) {
            $admin_email = get_option('admin_email');
            $atts = shortcode_atts(
                    array(
                'email' => $admin_email,
                'currency' => 'USD',
                'purpose' => '',
                'amount' => '',
                'size' => 'large',
                'mode' => ''
                    ), $atts, 'bartag');


            switch ($atts['size']) {
                case 'small':
                    $imgurl = 'https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif';
                    break;
                case 'medium':
                    $imgurl = 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif';
                    break;
                case 'large':
                    $imgurl = 'https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif';
                    break;
                default:
                    $imgurl = 'https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif';
            }
            $paypal_form_url = ( $atts['mode'] == "sandbox") ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr";

            return '<form  target="_blank" action="'.$paypal_form_url.'" method="post">
    			<div class="paypal_donation_block">
			        <input type="hidden" name="cmd" value="_donations">
                                <input type="hidden" name="item_name" value="' . $atts['purpose'] . '">
                                <input type="hidden" name="amount" value="' . $atts['amount'] . '">
			        <input type="hidden" name="business" value="' . $atts['email'] . '">
			        <input type="hidden" name="rm" value="0">
			        <input type="hidden" name="currency_code" value="' . $atts['currency'] . '">
			        <input type="image" src="' . $imgurl . '" name="submit" alt="PayPal - The safer, easier way to pay online.">
			        <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			    </div>
			</form>';
        }

    }

    add_action('plugins_loaded', array('Paypal_Donation_Block', 'get_instance'));
}


/**
 * Enqueue the block's assets for the editor.
 *
 * @since 1.0.0
 */
function paypal_donation_block_enqueue() {
    wp_register_script(
        'paypal-donation-block-block-script',
        plugins_url( 'js/block.build.js', __FILE__ ),
        array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components') // Dependencies, defined above.
    );
    wp_register_style(
        'paypal-donation-block-block-style',
        plugins_url( '/css/admin-block.css', __FILE__ )
    );

    register_block_type('bk-block/paypal-donation-block', array(
        'editor_script' => 'paypal-donation-block-block-script',

        'editor_style' => 'paypal-donation-block-block-style',
    ));
}

/**
 * Action for the register gutenberg custom block
 */
add_action('admin_init', 'paypal_donation_block_enqueue');
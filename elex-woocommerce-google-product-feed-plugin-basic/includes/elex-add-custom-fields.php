<?php

if (!defined('ABSPATH')) {
    exit;
}

class Elex_add_custom_fields {

    function __construct() {
        add_action('woocommerce_product_options_general_product_data', array($this, 'elex_gpf_custom_meta_fields'));
        add_action('woocommerce_process_product_meta', array($this, 'elex_gpf_save_metas'));
    }

    function elex_gpf_custom_meta_fields() {
        global $post;
        echo '<div id="elex_custom_metas" class="show_if_simple">';
        echo '<h4 style="text-align: left;">Google Product Feed</h4>';
        woocommerce_wp_text_input(
                array(
                    'id' => '_elex_gpf_gtin',
                    'label' => __('GTIN', 'elex-product-feed'),
                    'desc_tip' => 'true',
                    'description' => __('The Global Trade Item Number (GTIN) is an identifier for trade items', 'woocommerce'),
                )
        );
        woocommerce_wp_text_input(
                array(
                    'id' => '_elex_gpf_mpn',
                    'label' => __('MPN', 'woocommerce'),
                    'desc_tip' => 'true',
                    'description' => __('A manufacturer part number (MPN) is a series of numbers and/or letters given to a part by its manufacturer', 'woocommerce'),
                )
        );
        woocommerce_wp_text_input(
                array(
                    'id' => '_elex_gpf_brand',
                    'label' => __('Brand', 'woocommerce'),
                    'desc_tip' => 'true',
                    'description' => __('Required for each product with a clearly associated brand or manufacturer', 'woocommerce'),
                )
        );
        echo '</div>';
    }

    function elex_gpf_save_metas($post_id) {
        $elex_gpf_brand = sanitize_text_field($_POST['_elex_gpf_brand']);
        $elex_gpf_gtin = sanitize_text_field($_POST['_elex_gpf_gtin']);
        $elex_gpf_mpn = sanitize_text_field($_POST['_elex_gpf_mpn']);

        if (isset($elex_gpf_brand)) {
            update_post_meta($post_id, '_elex_gpf_brand', $elex_gpf_brand);
        }

        if (isset($elex_gpf_mpn)) {
            update_post_meta($post_id, '_elex_gpf_mpn', esc_attr($elex_gpf_mpn));
        }

        if (isset($elex_gpf_gtin)) {
            update_post_meta($post_id, '_elex_gpf_gtin', esc_attr($elex_gpf_gtin));
        }
    }

}

new Elex_add_custom_fields();

<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 */
class Elex_save_settings_tab_fields {
	
	function __construct() {
		add_action('wp_ajax_elex_gpf_save_settings_tab_field', array($this, 'elex_gpf_save_settings_tab_field_callback'));
	}
	function elex_gpf_save_settings_tab_field_callback () {
		$save_setting_tab_fields = array();
		if ( isset( $_POST['custom_meta'] ) ) {
			foreach ( $_POST['custom_meta'] as $key=>$value ) {
			    if ( is_null( $value ) || $value == '' )
			        unset( $_POST['custom_meta'][ $key ] );
			}
			$save_setting_tab_fields['custom_meta'] = $_POST['custom_meta'];
		}
		if(isset($_POST['file_path']) && $_POST['file_path'] != '') {
			$save_setting_tab_fields['file_path'] = realpath($_POST['file_path']);
		}
		if(isset($_POST['cat_language']) && $_POST['cat_language'] != '') {
			$save_setting_tab_fields['cat_language'] = $_POST['cat_language'];
		}

		update_option('elex_settings_tab_fields_data',$save_setting_tab_fields);
	}
}
new Elex_save_settings_tab_fields();
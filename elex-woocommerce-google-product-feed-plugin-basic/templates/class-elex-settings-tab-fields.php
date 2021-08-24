<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 */
class Elex_settings_tab_fields {
	
	function __construct() {
		$this -> elex_gpf_load_script_and_styles();
		$this -> elex_gpf_add_setting_fields();
	}


	function elex_gpf_load_script_and_styles () {
		 global $woocommerce;
		$woocommerce_version = function_exists('WC') ? WC()->version : $woocommerce->version;
		wp_enqueue_style('woocommerce_admin_styles', $woocommerce->plugin_url() . '/assets/css/admin.css', array(), $woocommerce_version);
		wp_register_style('elex-gpf-plugin-bootstrap', plugins_url('/assets/css/bootstrap.css', dirname(__FILE__)));
		wp_enqueue_style('elex-gpf-plugin-bootstrap');
		wp_register_script('elex-gpf-tooltip-jquery', plugins_url('/assets/js/tooltip.js', dirname(__FILE__)));
		wp_enqueue_script('elex-gpf-tooltip-jquery');
		wp_register_script('elex-gpf-settings-tab', plugins_url('/assets/js/elex-settings-tab-script.js', dirname(__FILE__)));
		wp_enqueue_script('elex-gpf-settings-tab');
		 wp_register_style('elex-setting-style', ELEX_PRODUCT_FEED_MAIN_URL_PATH . '/assets/css/elex-setting-styles.css');
		 wp_enqueue_style('elex-setting-style');
	}

	function elex_gpf_add_setting_fields () {
		$saved_data = get_option('elex_settings_tab_fields_data');
		$meta_keys = '';
		$file_path = '';
	 	$upload_dir = wp_upload_dir();
        $base = $upload_dir['basedir'];
        $path = realpath( $base . "/elex-product-feed/" );

		if( isset( $saved_data['custom_meta'] ) ) {
			$meta_keys = implode(',', $saved_data['custom_meta']);
		}
		if( isset( $saved_data['file_path'] ) ) {
			$file_path = $saved_data['file_path'];
		}

		$category_languages = array('en' => __('English', 'elex-product-feed'), 'ru' => __('Russian', 'elex-product-feed'), 'es' => __('Spanish', 'elex-product-feed'), 'de' => __('German', 'elex-product-feed'), 'fr' => __('French', 'elex-product-feed'));
		?>
			<div class="elex-gpf-loader"></div>
			<div class="wrap postbox elex-gpf-table-box elex-gpf-table-box-main ">
			<h1>
				<?php _e('Settings', 'elex-product-feed'); ?>
			</h1>
			<table class="elex-gpf-settings-table">
				<tr>
					<td class="elex-gpf-settings-table-left">
						<?php _e('Meta keys', 'elex-product-feed'); ?>
					</td>
					<td class='elex-gpf-settings-table-middle'>
						<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('If you are using external plugins to create additional product fields, you can map them to Google Attributes. Enter the specific meta keys that you want to map. You can find the meta keys using the Inspect option of your browser.', 'elex-product-feed'); ?>'></span>
					</td>
					<td class="elex-gpf-settings-table-right">
						<textarea rows="4" cols="50" id="elex_custom_meta_keys"><?php echo $meta_keys; ?></textarea>
					</td>
				</tr>
				<tr>
					<td class="elex-gpf-settings-table-left">
						<?php _e('File Path', 'elex-product-feed'); ?>
					</td>
					<td class='elex-gpf-settings-table-middle'>
						<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Specify the file path to save the product feed in the server. If left blank, the feed will be saved in the default path specified in the placeholder.', 'elex-product-feed'); ?>'></span>
					</td>
					<td class="elex-gpf-settings-table-right">
						<input type="text" id="elex_feed_files_path" placeholder="<?php echo $path;?>" value="<?php echo $file_path;?>" style="width: 100%;" >
					</td>
				</tr>
				<tr>
					<td class="elex-gpf-settings-table-left">
						<?php _e('Google Product Category Language', 'elex-product-feed'); ?>
					</td>
					<td class='elex-gpf-settings-table-middle'>
						<span class='woocommerce-help-tip tooltip' data-tooltip='<?php _e('Change the language used for google product category taxonomy. The default will be set as English regardless of any country chosen while creating the feed.', 'elex-product-feed'); ?>'></span>
					</td>
					<td class="elex-gpf-settings-table-right">
						<select id="elex_google_cat_language_selector">
							<?php
								$selected_value = isset($saved_data['cat_language']) ? $saved_data['cat_language'] : 'en';
								foreach ($category_languages as $key => $value) {
									if ($key == $selected_value) {
		                        		echo '<option value="' . $key . '" selected="true">' . $value . '</option>';
		                        	} else {
		                        		echo '<option value="' . $key . '">' . $value . '</option>';
		                        	}
								}
							?>
						</select>
					</td>
				</tr>
			</table>
			<div style="margin-bottom: 4%;">
			<button class="botton button-large button-primary" id="elex_save_settings_tab_data" style="float: right; width: 10%;">Save</button>
			</div>
			</div>

		<?php
	}
}

new Elex_settings_tab_fields();
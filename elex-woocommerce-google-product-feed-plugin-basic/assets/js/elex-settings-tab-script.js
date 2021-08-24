jQuery(function () {
	jQuery('.tooltip').darkTooltip();
	
	jQuery('#elex_save_settings_tab_data').on('click', function () {

		var meta_keys = [];
		var file_path = '';
		var google_cat_language = 'en';

		if(jQuery('#elex_custom_meta_keys').val().trim() != '') {
			meta_keys = jQuery('#elex_custom_meta_keys').val().split(',');
		}
		file_path = jQuery('#elex_feed_files_path').val();
		google_cat_language = jQuery('#elex_google_cat_language_selector').val();
		jQuery(".elex-gpf-loader").css("display", "block");

		jQuery.ajax({
	        type: 'post',
	        url: ajaxurl,
	        data: {
	            action: 'elex_gpf_save_settings_tab_field',
	            custom_meta: meta_keys,
	            file_path : file_path,
	            cat_language : google_cat_language
	        },
	        success: function (response) {
	        	jQuery('<div style="color:green;">Settings saved!</div>').insertBefore('#elex_save_settings_tab_data').delay(1000).fadeOut();
	           jQuery(".elex-gpf-loader").css("display", "none");
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	            console.log(textStatus, errorThrown);
	        }
    	});
	});

});
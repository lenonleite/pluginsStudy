<?php
// powerpressadmin-tools.php

	function powerpress_admin_tools()
	{
		$General = get_option('powerpress_general');

        // If we have powerpress credentials, check if the account has been verified
        $creds = get_option('powerpress_creds');
        powerpress_check_credentials($creds);
        wp_enqueue_script('powerpress-admin', powerpress_get_root_url() . 'js/admin.js', array(), POWERPRESS_VERSION );
?>
<h2><?php echo __('PowerPress Tools', 'powerpress'); ?></h2>

<p style="margin-bottom: 0;"><?php echo __('Useful utilities and tools.', 'powerpress'); ?></p>


<table class="form-table">
<tr valign="top">
    <th scope="row"><?php echo __('Multi-Program Mode', 'powerpress'); ?></th>
    <td>
        <?php
            if (isset($General['network_mode']) && $General['network_mode'] == 1) { ?>
                <a style="float: left; text-decoration: none; color: white; background-color: #d21919;" class="powerpress_save_button_other" href="<?php echo admin_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-network-mode-off"); ?>">

                <?php
                echo __('Turn OFF multi-program mode', 'powerpress');?>
                </a><p style="margin: 7px 0 0 5px;"> - <?php
                echo __('This feature allows you to publish to multiple Blubrry-hosted shows from a single user account.', 'powerpress');
                ?> </p><?php
            } else { ?>
                <a style="float: left; text-decoration: none; color: white;" class="powerpress_save_button_other" href="<?php echo admin_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-network-mode-on"); ?>">

                <?php
                echo __('Turn ON multi-program mode', 'powerpress');?>
                </a><p style="margin: 7px 0 0 5px;"> - <?php
                echo __('This feature allows you to publish to multiple Blubrry-hosted shows from a single user account.', 'powerpress');
                ?> </p> <?php
            }
            ?>
    </td>
</tr>
<tr valign="top">
<th scope="row"><?php echo __('Podcasting Resources', 'powerpress'); ?></th> 
<td>
	<p style="margin-top: 5px;"><strong><a href="http://create.blubrry.com/manual/"><?php echo __('Podcasting Manual', 'powerpress'); ?></a></strong>
	- <?php echo __('Everything you need to know about podcasting.', 'powerpress'); ?></p>
	
	<p style="margin-top: 5px;"><strong><a href="http://create.blubrry.com/resources/"><?php echo __('Blubrry Resources', 'powerpress'); ?></a></strong>
	- <?php echo __('Learn more about PowerPress and Blubrry services.', 'powerpress'); ?></p>
	
	<p style="margin-top: 5px;"><strong><a href="http://create.blubrry.com/support/"><?php echo __('Blubrry Support', 'powerpress'); ?></a></strong>
	- <?php echo __('Get support for your podcast!', 'powerpress'); ?></p>
	
	<p style="margin-top: 5px;"><strong><a href="https://wordpress.org/support/plugin/powerpress"><?php echo __('Blubrry PowerPress Forum', 'powerpress'); ?></a></strong>
	- <?php echo __('PowerPress support forum on WordPress.org.', 'powerpress'); ?></p>
</td>
</tr>



<!--  ping_sites -->
<tr valign="top">
<th scope="row"><?php echo __('Add Update Services', 'powerpress'); ?></th> 
<td>
	
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-ping-sites"); ?>"><?php echo __('Add Update Services / Ping Sites', 'powerpress'); ?></a></strong> <?php echo __('(notify podcast directories when you publish new episodes)', 'powerpress'); ?></p>
	<p><?php echo __('Add Update Services / Ping Sites geared towards podcasting.', 'powerpress'); ?></p>
	
</td>
</tr>

<!--  find_replace -->
<tr valign="top">
<th scope="row"><?php echo __('Find and Replace Media', 'powerpress'); ?></th>
<td>
	
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-find-replace"); ?>"><?php echo __('Find and Replace for Episode URLs', 'powerpress'); ?></a></strong></p>
	<p>
		<?php echo __('Find and replace complete or partial segments of media URLs. Useful if you move your media to a new web site or service.', 'powerpress'); ?>
	</p>
	
</td>
</tr>

<!-- use_caps -->
<tr valign="top">
<th scope="row"><?php echo __('User Capabilities', 'powerpress'); ?></th> 
<td>
<?php
	if( !empty($General['use_caps']) )
	{
?>
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url() . wp_nonce_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-remove-caps", 'powerpress-remove-caps'); ?>"><?php echo __('Remove PowerPress Podcasting Capabilities for User Role Management', 'powerpress'); ?></a></strong></p>
	<p>
	<?php echo __('Podcasting capability allows administrators, editors and authors access to create and configure podcast episodes. 
	Only administrators will be able to view media statistics from the WordPress Dashboard. Contributors, subscribers and other
	custom users will not have access to create podcast episodes or view statistics from the dashboard. Due to this feature\'s
	complexity, it is not supported by Blubrry.com.', 'powerpress'); ?>
	</p>
	
<?php
	}
	else
	{
?>
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url() . wp_nonce_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-add-caps", 'powerpress-add-caps'); ?>">
		<?php echo __('Add PowerPress Podcasting Capabilities for User Role Management', 'powerpress'); ?></a></strong></p>
	<p>
	<?php echo __('Adding podcasting capability will allow administrators, editors and authors access to create and configure podcast episodes. 
	Only administrators will be able to view media statistics from the WordPress Dashboard. Contributors, subscribers and other
	custom users will not have access to create podcast episodes or view statistics from the dashboard. Due to this feature\'s
	complexity, it is not supported by Blubrry.com.', 'powerpress'); ?>
	</p>
<?php
	}
	
	if( !empty($General['premium_caps']) )
	{
?>
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url() . wp_nonce_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-remove-feed-caps", 'powerpress-remove-feed-caps'); ?>"><?php echo __('Remove Password Protection Capabilities for Control of Which Users can Access Your Podcasts', 'powerpress'); ?></a></strong>  (<?php echo __('Also kown as Premium Content', 'powerpress'); ?>)</p>
	<p>
	<?php
		echo sprintf( __("To use this feature, go to %s and create a new custom podcast channel. In the Edit Podcast Channel page, click the last tab labeled 'Other Settings'. Place a check in the box labled 'Protect Content' and then click 'Save Changes'.", 'powerpress'),
			'<a href="'. admin_url("admin.php?page=powerpressadmin_customfeeds.php") .'" title="'. __('Podcast Channels', 'powerpress') .'">'. __('Podcast Channels', 'powerpress') .'</a>' );
	?>
	</p>
	<p>
		<?php echo __('Password protection capabilities for custom podcast channel feeds lets you control who can listen and view your 
		podcast. This feature allows you to password-protect custom podcast channels by adding a new role called "Premium 
		Subscriber." Only users with the "Premium Subscriber" role have access to your password protected custom podcast
		channels. Due to this feature\'s complexity, it is not supported by Blubrry.com.', 'powerpress'); ?>
	</p>
<?php
	}
	else
	{
?>
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url() . wp_nonce_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-add-feed-caps", 'powerpress-add-feed-caps'); ?>"><?php echo __('Add Password Protection Capabilities for Control of Which Users can Access Your Podcasts', 'powerpress'); ?></a></strong> (<?php echo __('Also kown as Premium Content', 'powerpress'); ?>)</p>
	<p>
		<?php echo __('Adding password protection capabilities for custom podcast channel feeds lets you control who can listen and view your 
		podcast. This feature allows you to password-protect custom podcast channels by adding a new role called "Premium 
		Subscriber." Only users with the "Premium Subscriber" role have access to your password protected custom podcast
		channels. Due to this feature\'s complexity, it is not supported by Blubrry.com.', 'powerpress'); ?>
	</p>
<?php
	}
?>

	<p><strong><?php echo __('What are Roles and Capabilities?', 'powerpress'); ?></strong></p>
	<p>
		<?php
		echo sprintf( __("The WordPress %s feature gives the blog owner the ability to control what users can and 
			cannot do in the blog. You will most likely need a roles and capabilities plugin such as %s, %s, or %s
			to take advantage of these features. Due to this feature's complexity, it is not supported by Blubrry.com.", 'powerpress'),
			'<a href="http://codex.wordpress.org/Roles_and_Capabilities" target="_blank">'. __('Roles and Capabilities', 'powerpress') .'</a>',
			'<a href="http://www.im-web-gefunden.de/wordpress-plugins/role-manager/" target="_blank">'. __('Role Manager', 'powerpress') .'</a>',
			'<a href="http://alkivia.org/wordpress/capsman/" target="_blank">'. __('Capability Manager', 'powerpress') .'</a>',
			'<a href="http://agapetry.net/category/plugins/role-scoper/" target="_blank">'. __('Role Scoper', 'powerpress') .'</a>'
			);
		?>
	</p>
	
</td>
</tr>


<tr valign="top">
<th scope="row"><?php echo __('Update Plugins Cache', 'powerpress'); ?></th> 
<td>
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url() . wp_nonce_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-clear-update_plugins", 'powerpress-clear-update_plugins'); ?>"><?php echo __('Clear Plugins Update Cache', 'powerpress'); ?></a></strong></p>
	<p>
	<?php
		echo sprintf( __('The list of plugins on the plugins page will cache the plugin version numbers for up to 24 hours. Click the link above to clear the cache to get the latest versions of plugins listed on your %s page.', 'powerpress'),
			'<a href="'. admin_url(). 'plugins.php' .'" title="Plugins">'. __('plugins', 'powerpress') .'</a>');
		?>
	</p>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php echo __('Translations', 'powerpress'); ?></th> 
<td>
	<p style="margin-top: 5px;"><strong>
		<a href="https://create.blubrry.com/resources/powerpress/powerpress-language/translate-powerpress/" target="_blank"><?php echo __('Translate PowerPress to your language', 'powerpress'); ?></a>
	</strong></p>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php echo __('iOS 11 Fields', 'powerpress'); ?></th> 
<td>
	<?php
	$ios11_fields_url = admin_url() . wp_nonce_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-ios11-fields", 'powerpress-ios11-fields');
	
	?>
	<p>
		Since PowerPress 7.1 and the addition of 3 new fields for iOS 11, some web sites that use PHP in FastCGI mode are experiencing 404 or 500 error pages when saving PowerPress settings.
	  Use the options below to turn off these fields to avoid the errors and help us determine which of the new fields is causing the issue.
	</p>
	<p style="margin-top: 5px;">&bull; <strong><a href="<?php echo $ios11_fields_url; ?>&amp;variation=0"><?php echo __('Show all iOS 11 program fields', 'powerpress'); ?></a></strong> <?php echo (empty($General['ios11_fields'])? ' (selected)' : '' ); ?></p>
	<p style="margin-top: 5px;">&bull; <strong><a href="<?php echo $ios11_fields_url; ?>&amp;variation=1"><?php echo __('Show itunes type field only', 'powerpress'); ?></a></strong><?php echo (!empty($General['ios11_fields']) && $General['ios11_fields'] == 1? ' (selected)' : '' ); ?></p>
	<p style="margin-top: 5px;">&bull; <strong><a href="<?php echo $ios11_fields_url; ?>&amp;variation=2"><?php echo __('Show itunes title episode box field only', 'powerpress'); ?></a></strong><?php echo (!empty($General['ios11_fields']) && $General['ios11_fields'] == 2? ' (selected)' : '' ); ?></p>
	<p style="margin-top: 5px;">&bull; <strong><a href="<?php echo $ios11_fields_url; ?>&amp;variation=4"><?php echo __('Show itunes number, season and episode type episode box field only', 'powerpress'); ?></a><?php echo (!empty($General['ios11_fields']) && $General['ios11_fields'] == 4? ' (selected)' : '' ); ?></strong></p>
	<p style="margin-top: 5px;">&bull; <strong><a href="<?php echo $ios11_fields_url; ?>&amp;variation=8"><?php echo __('Show no iOS 11 program fields', 'powerpress'); ?></a></strong><?php echo (!empty($General['ios11_fields']) && $General['ios11_fields'] == 8? ' (selected)' : '' ); ?></p>
	
</td>
</tr>

<tr valign="top">
<th scope="row"><?php echo __('Diagnostics', 'powerpress'); ?></th> 
<td>
	<p style="margin-top: 5px;"><strong><a href="<?php echo admin_url("admin.php?page=powerpress/powerpressadmin_tools.php&amp;action=powerpress-diagnostics"); ?>"><?php echo __('Diagnose Your PowerPress Installation', 'powerpress'); ?></a></strong></p>
	<p>
	<?php echo __('The Diagnostics page checks to see if your server is configured to support all of the available features in Blubrry PowerPress.', 'powerpress'); ?>
	</p>
</td>
</tr>

</table>
<?php  
	
	}

?>
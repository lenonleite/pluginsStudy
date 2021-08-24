<?php
if (!defined('ABSPATH')) {
    exit;
}

$setting_tab_fields = get_option( 'elex_settings_tab_fields_data' );
if($setting_tab_fields && isset($setting_tab_fields['file_path']) && $setting_tab_fields['file_path'] != '') {
    $path = $setting_tab_fields['file_path'];
    global $wpdb;
    $dir_path = explode($wpdb->dbname, $path);
    if(isset($dir_path[1])) {
        $sub_directory = explode($dir_path[1][0], $dir_path[1]);
        $dir_url = home_url();
        foreach ($sub_directory as $key => $value) {
            if($value)
            $dir_url .= '/'.$value ;
        }
    }
    else {
        $dir_url = home_url();
    }
    $dir_url .= '/';
}
else {
    $upload_dir = wp_upload_dir();
    $base = $upload_dir['basedir'];
    $path = $base . "/elex-product-feed/";
    $dir_url = $upload_dir['baseurl'] . '/elex-product-feed/';
}


?>
<div id="elex_manage_feed" class="wrap postbox elex-gpf-manage-feed-table-box elex-gpf-manage-feed-table-box-main ">
    <h1><?php _e('Manage Feeds', 'elex-product-feed'); ?></h1>
    <table id="elex_manage_feed_files" class="elex-gpf-manage-feed-settings-table">
        <tr>
            <th class='elex-gpf-manage-feed-settings-table-name'>
                <?php _e('Name', 'elex-product-feed'); ?>
            </th>
            <th class='elex-gpf-manage-feed-settings-table-url'>
                <?php _e('URL', 'elex-product-feed'); ?>
            </th>
            <th class='elex-gpf-manage-feed-settings-created-date'>
                <?php _e('Created', 'elex-product-feed'); ?>
            </th>
            <th class='elex-gpf-manage-feed-settings-modified-datel'>
                <?php _e('Modified', 'elex-product-feed'); ?>
            </th>
            <th class='elex-gpf-manage-feed-settings-modified-datel'>
                <?php _e('Next schedule', 'elex-product-feed'); ?>
            </th>
            <th class='elex-gpf-manage-feed-settings-table-actions'>
                <?php _e('Actions', 'elex-product-feed'); ?>
            </th>
        </tr>
        <tr></tr>
        <?php
        if( is_dir($path) ) {
        $files = array_diff(scandir($path), array('..', '.'));
        $i = 0;
        $saved_projects = get_option('elex_gpf_cron_projects');
        foreach ($saved_projects as $key => $val) {
            $file_name = '';
            $created_date = '';
            $modified_date = '';
            $pause_or_play = '';
            $next_schedule = '-';

            foreach ($files as $file) {
                if (isset($val['file']) && $file == $val['file']) {
                    $file_name = $val['name'];
                    $created_date = $val['created_date'];
                    if(isset($val['modified_date'])) {
                    $modified_date = $val['modified_date'];
                    }
                    $pause_or_play = $val['pause_schedule'];

                    if($val['refresh_schedule'] != 'no_refresh') {
                        if($val['refresh_schedule'] == 'weekly') {
                            $str_next_day = "";
                            $today = strtolower(current_time('l'));
                            if(in_array($today, $val['refresh_days'])) {
                                if(current_time('G') >= $val['refresh_hour']) {
                                    $index = array_search($today,$val['refresh_days']);
                                    if(isset($val['refresh_days'][$index+1])) {
                                        $str_next_day = "next ".$val['refresh_days'][$index+1];
                                    }
                                    else {
                                        $str_next_day = "next ".$val['refresh_days'][0];
                                    }
                                }
                                else {
                                    $str_next_day = 'today';
                                }
                            }
                            else {
                                foreach ($val['refresh_days'] as $day_index => $day_value) {
                                    if(date('w', strtotime($day_value)) > date('w', strtotime($today))) {
                                        $str_next_day = "next ".$day_value;
                                        break;
                                    }
                                }
                                    $str_next_day = "next ".$val['refresh_days'][0];
                            }
                                $next_schedule = date("d-m-Y", strtotime($str_next_day));
                                
                        }
                        elseif ($val['refresh_schedule'] == 'monthly') {
                            $today = current_time('j');
                            $next_day = '';
                            $number_of_days = current_time('t');
                            $next_month = false;
                            
                            if(in_array($today, $val['refresh_days'])) {
                                if(current_time('G') >= $val['refresh_hour']) {
                                    $index = array_search($today,$val['refresh_days']);
                                    if(isset($val['refresh_days'][$index+1]) && $val['refresh_days'][$index+1] <= $number_of_days) {
                                    $next_day = $val['refresh_days'][$index+1];
                                    }
                                    else {
                                        $next_day = $val['refresh_days'][0];
                                        $next_month = true;
                                    }

                                }
                                else {
                                    $next_day = $today;
                                }
                            }
                            else {
                                foreach ($val['refresh_days'] as $day_index => $day_value) {
                                    if(($day_value > $today) && ($day_value <= $number_of_days)) {
                                        $next_day = $day_value;
                                        break;
                                    }
                                    $next_day = $val['refresh_days'][0];
                                    $next_month = true;
                                }

                            }
                            $next_day = sprintf("%02d", $next_day);
                            $next_schedule = $next_day.'-'.current_time('m-Y');
                            if($next_month) {
                                $next_schedule = date('d-m-Y', strtotime($next_schedule.'+1 month'));
                            }
                            
                        }
                        else {
                            if(current_time('G') >= $val['refresh_hour']) {
                                $next_schedule = date("d-m-Y", strtotime('tomorrow'));
                            }
                            else {
                                $next_schedule = date("d-m-Y", strtotime('today'));
                            }
                        }
                        $next_schedule .= '<br><span style="font-size: 10px;">'.sprintf("%02d", $val['refresh_hour']).':00:00</span>';
                        if($val['pause_schedule'] == 'paused') {
                            $next_schedule .= '<br><span style="color:red;font-size: 10px;">(Paused)</span>';
                        }
                    }
                    break;
                }
            }
            if(! $file_name) {
                continue;
            }
            ?>
            <tr>
                <td class="elex-gpf-manage-feed-settings-table-name">
                    <?php echo esc_html($file_name) ?>
                </td>
                <td class="elex-gpf-manage-feed-settings-table-url">
                    <?php echo esc_html($dir_url . $file) ?>
                </td>
                <td class="elex-gpf-manage-feed-settings-created-date">
                    <?php 
                        $created_date = explode(' ', $created_date);
                        echo $created_date[0]; 
                        if(isset($created_date[1])) {
                            echo '<br><span style="font-size: 10px;">'.$created_date[1].'</span>';
                        }
                    ?>
                </td>
                <td class="elex-gpf-manage-feed-settings-modified-date">
                    <?php 
                        $modified_date = explode(' ', $modified_date);
                        echo $modified_date[0]; 
                        if(isset($modified_date[1])) {
                            echo '<br><span style="font-size: 10px;">'.$modified_date[1].'</span>';
                        }
                    ?>
                </td>
                <td class="elex-gpf-manage-feed-settings-modified-date">
                    <?php echo  $next_schedule; ?>
                </td>
                <td class="elex-gpf-manage-feed-settings-table-actions">
                    <span class=" elex-gpf-icon4 elex-gpf-icon4-edit"  title="Edit Project" onclick="elex_edit_file('<?php echo $file ?>')"   style="display: inline-block;"></span>
                    <span class=" elex-gpf-icon2 elex-gpf-icon2-view"  title="Copy Project" onclick="elex_copy_file('<?php echo $file ?>')"   style="display: inline-block;"></span>
                    <?php if($pause_or_play == 'ready') { ?>
                    <span class="elex-gpf-icon-pause"  title="Pause Schedule" onclick="elex_pause_schedule('<?php echo $file ?>')"   style="display: inline-block;"></span>
                <?php } else {?>
                    <span class="elex-gpf-icon-play"  title="Resume Schedule" onclick="elex_play_schedule('<?php echo $file ?>')"   style="display: inline-block;"></span>
                    <?php }?>
                    <span class=" elex-gpf-icon3 elex-gpf-icon3-refresh"  title="Regenerate Feed" onclick="update_file_to_latest('<?php echo $file ?>', '<?php echo $file_name ?>')" style="display: inline-block; margin: 2px 3px -2px;"></span>
                    <a href=<?php echo $dir_url . $file ?> download=<?php echo $file; ?> target="_blank" id="<?php echo $file; ?>"></a>
                        <span class=" elex-gpf-icon-download"  title="Download Feed" onclick="document.getElementById('<?php echo $file; ?>').click();" download="<?php echo $file; ?>"style="display: inline-block; margin: 2px 3px 1px;"></span>
                    
                        <span class="elex-gpf-icon-view"  title="View Feed" onclick="window.open('<?php echo $dir_url . $file ?>','_blank')" style="display: inline-block; margin: 0px 2px 0px;"></span>
                    <span class=" elex-gpf-icon elex-gpf-icon-delete" onclick="elex_remove_file('<?php echo $file ?>', '<?php echo $file_name ?>')"   title="Delete Project" style="display: inline-block; margin: 0px 2px 1px;"></span>
                </td>
            </tr>
            <?php
            $i++;
        }
    }
        ?>
    </table>
</div>
<?php
include_once ELEX_PRODUCT_FEED_TEMPLATE_PATH . "/elex-settings-frontend.php";

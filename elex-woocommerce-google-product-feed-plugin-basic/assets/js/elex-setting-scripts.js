var temp_arr = [];
var dom3 = '';
var dom2 = '';
var attr_row_count = 0;
var prod_attr_row = 0;
var selected_google_attr = [];
var selected_product_attr = [];
var count = 1;
var selected_google_cats = [];
var google_prod_cats_pair = {};
var edit_project = false;
var edit_file = '';

var selected_google_category = [];
var selected_product_category = [];

jQuery(function () {
    jQuery('.tooltip').darkTooltip();
    jQuery('.elex-gpf-multiple-chosen').chosen();
    jQuery('#elex_settings_nochange').hide();
    jQuery('#elex_map_cat_nochange').hide();
    jQuery('#elex_map_attr_nochange').hide();
    jQuery('#settings_map_category').hide();
    jQuery('#settings_map_attributes').hide();
    jQuery("#exclude_include").hide();
    jQuery("#refresh_time_field").hide();
    jQuery('#elex_select_weekly_day').hide();
    jQuery('#elex_select_monthly_day').hide();
    jQuery("#elex_cat_action").hide();
    jQuery('#elex_gpf_advanced_settings_div2').hide();
    jQuery('#elex_gpf_advanced_div').hide();

    jQuery('#elex_gpf_advanced_settings').on('click', function(){
        jQuery('#elex_gpf_advanced_div').show(500);
        
               jQuery("elex_gpf_advanced_div").css("opacity", "1");
               window.setTimeout(function () {
                   jQuery("elex_gpf_advanced_div").fadeTo(500, 0).slideUp(500, function () {
                       jQuery(this).css("display", "none");
                   });
               }, 40);
               jQuery('#elex_gpf_advanced_settings_div').hide();
               jQuery('#elex_gpf_advanced_settings_div2').show();
               
    });
        jQuery('#elex_gpf_advanced_settings2').on('click', function(){
        jQuery('#elex_gpf_advanced_div').hide(300);
        
               jQuery("elex_gpf_advanced_div").css("opacity", "1");
               window.setTimeout(function () {
                   jQuery("elex_gpf_advanced_div").fadeTo(500, 0).slideUp(500, function () {
                       jQuery(this).css("display", "block");
                   });
               }, 40);
               jQuery('#elex_gpf_advanced_settings_div2').hide();
               jQuery('#elex_gpf_advanced_settings_div').show();
    });
    
    jQuery('#save_settings_first_page, #elex_settings_nochange').on('click', function () {
        if (jQuery('#elex_project_title').val() == '') {
            alert('Enter Project Name');
            return;
        }
        if (jQuery('#country_of_sale').val() == '') {
            alert('Select Country');
            return;
        }

         
        jQuery('#elex_gpf_step1').removeClass('active');
        jQuery('#elex_gpf_step2').addClass('active');
        jQuery('#settings_first_section').hide();
        jQuery('#settings_map_category').show();

        if(selected_google_category == '' && jQuery('#elex_default_google_category').val()) {
            jQuery('#settings_map_category').find('.typeahead').val(jQuery('#elex_default_google_category').val());
            jQuery('#settings_map_category').find('[type=checkbox]').prop('checked', true);
        }
        else {
            jQuery.each(selected_google_category, function (index, google_cat) {
                jQuery('#elex_google_cats_'+selected_product_category[index]).val(google_cat);
                jQuery('input[value="'+selected_product_category[index]+'"]').attr('checked', true);
            });
        }
        selected_google_category = [];
        selected_product_category = [];


    });
    jQuery('#settings_map_category').find('.typeahead').on("input",function() {
        if(jQuery(this).val() != '') {
            jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
        }
        else {
            jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', false);
        }
    });
    jQuery('#refresh_schedule').change(function () {
        switch(jQuery(this).val()) {
            case 'daily' :
                jQuery("#refresh_time_field").show();
                jQuery('#elex_select_weekly_day').hide();
                jQuery('#elex_select_monthly_day').hide();
                break;

            case 'weekly' :
                jQuery("#refresh_time_field").show();
                jQuery('#elex_select_weekly_day').show();
                jQuery('#elex_select_monthly_day').hide();
                break;

            case 'monthly' :
                jQuery("#refresh_time_field").show();
                jQuery('#elex_select_weekly_day').hide();
                jQuery('#elex_select_monthly_day').show();
                break;

            default :
                jQuery("#refresh_time_field").hide();
                jQuery('#elex_select_weekly_day').hide();
                jQuery('#elex_select_monthly_day').hide();
                break;
        }

        if (jQuery(this).val() != 'no_refresh') {
            jQuery("#refresh_time_field").show();
        } else {
            jQuery("#refresh_time_field").hide();
        }
    });


    jQuery('#save_settings_cat_map').on('click', function () {
       
        jQuery(".elex-gpf-loader").css("display", "block");
        var country = jQuery('#country_of_sale').val();
        selected_google_attr = [];
        selected_google_cats = [];
        var selected_prod_cats = [];
         jQuery('#elex_cat_table').find('tbody').find('.check-column input:checked').each(function() {
            selected_prod_cats.push(jQuery(this).val());
            selected_google_cats.push(jQuery("#elex_google_cats_"+jQuery(this).val()).val());
        });

         if((selected_google_cats.length == 0) || (selected_prod_cats.length == 0)) {
            alert('Please choose atleast one product category to continue');
            jQuery(".elex-gpf-loader").css("display", "none");
            return;
         }
         
        var include_var = false;
        
        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                _ajax_elex_gpf_nonce: jQuery('#_ajax_elex_gpf_nonce').val(),
                action: 'elex_gpf_show_mapping_fields',
                country_of_sale: country,
                google_cats: selected_google_cats,
                include_variation: include_var
            },
            success: function (response) {
                jQuery(".elex-gpf-loader").css("display", "none");
                jQuery('#elex_gpf_step2').removeClass('active');
                jQuery('#elex_gpf_step3').addClass('active');
                dom3 = '';
                attr_row_count = 0;
                prod_attr_row = 0;
                response = JSON.parse(response);
                temp_arr = response;
                var required_attr = temp_arr['required_attr'];
                var optional_attr = temp_arr['optional'];
                var product_attr = temp_arr['product_attr'];
                var dom = '<tr><td class="elex-gpf-settings-table-map-attr-left2"><h4>Google Attributes</h4></td><td class="elex-gpf-settings-table-map-attr-middle2"><h4>Set Attribute Value</h4></td></tr>';

                jQuery.each(required_attr, function (index, value) {
                    dom2 = '';
                    var grp_type = '';
                    
                    jQuery.each(product_attr, function (index2, value2) {
                       
                         var selected = '';
                        if (index == 'id' && index2 == 'ID') {
                            selected = 'selected';
                        }
                        else if (index == 'title' && index2 == 'post_title') {
                            selected = 'selected';
                        }
                        else if (index == 'description' && index2 == 'post_content') {
                            selected = 'selected';
                        }
                        else if (index == 'link' && index2 == 'permalink') {
                            selected = 'selected';
                        }
                        else if (index == 'availability' && index2 == '_stock_status') {
                            selected = 'selected';
                        }
                        else if (index == 'gtin' && index2 == '_elex_gpf_gtin') {
                            selected = 'selected';
                        }
                        else if (index == 'brand' && index2 == '_elex_gpf_brand') {
                            selected = 'selected';
                        }
                        else if (index == 'mpn' && index2 == '_elex_gpf_mpn') {
                            selected = 'selected';
                        }
                        else if (index == 'price' && index2 == 'price') {
                            selected = 'selected';
                        }
                        else if (index == 'image_link' && index2 == 'main_image') {
                            selected = 'selected';
                        }
                        else if (index == 'item_group_id' && index2 == 'item_group_id') {
                            selected = 'selected';
                        }
                        else if (index == 'google_product_category' && index2 == 'google_category') {
                            selected = 'selected';
                        }
                        
                        var prefill = elex_preselect_attributes(index,index2);
                        if(prefill) {
                            
                            if(product_attr[index2]['grp_type'] != grp_type) {
                                if(grp_type !='') {
                                    dom2 += '</optgroup>';
                                }
                                dom2 += '<optgroup label="' + product_attr[index2]['grp_type'] + '">';
                                grp_type = product_attr[index2]['grp_type'];
                            }
                            dom2 += '<option value=' + index2 + ' ' + selected + '>' + product_attr[index2]['label'] + '</option>';
                        }
                        if (index == 'condition' && grp_type == '') {
                            dom2 += '<optgroup label="Supported Values">';
                            dom2 += '<option value="rec_new">[new]</option><option value="rec_refurbished">[refurbished]</option><option value="rec_used">[used]</option>';
                            dom2 += '</optgroup>';
                        }
                        else if ((index == 'adult' || index == 'is_bundle') && grp_type == '') {
                            dom2 += '<optgroup label="Supported Values">';
                            dom2 += '<option value="rec_yes">[yes]</option><option value="rec_no">[no]</option>';
                            dom2 += '</optgroup>';
                        }
                        else if (index == 'age_group' && grp_type == '') {
                            dom2 += '<optgroup label="Supported Values">';
                            dom2 += '<option value="rec_newborn">[newborn]</option><option value="rec_infant">[infant]</option><option value="rec_toddler">[toddler]</option><option value="rec_kids">[kids]</option><option value="rec_adult">[adult]</option>';
                            dom2 += '</optgroup>';
                        }
                        else if (index == 'availability' && grp_type == '') {
                            dom2 += '<optgroup label="Supported Values">';
                            dom2 += '<option value="rec_in stock">[in stock]</option><option value="rec_out of stock">[out of stock]</option><option value="rec_preorder">[preorder]</option>';
                            dom2 += '</optgroup>';
                            grp_type = '-';
                        }
                        
                    });
                    dom2 += '</optgroup>';
                    dom += '<tr>';
                    dom += '<td class="elex-gpf-settings-table-map-attr-left2">' + required_attr[index]['label'] ;
                    dom += '</td>';
                    dom += '<td class="elex-gpf-settings-table-map-attr-middle2">';
                    dom += '<div id="elex_set_condition_div_' + prod_attr_row + '"></div>';
                    dom += '<div id="elex_prepend_attr_div_' + prod_attr_row + '" ><p id="default_text_display_' + prod_attr_row + '"><br><b style="font-size:20px;">Set Default Values</b></p></div>';
                    dom += '<div><select  id="sample_name2' + prod_attr_row + '" style="width:46%;">' + dom2 + '</select>';
                    dom += '<a href="javascript:void(0)" id="text_field' + prod_attr_row + '" <span class="elex-gpf-icon elex-gpf-icon-text" title="Enter a text value" onclick="elex_add_text_field(' + prod_attr_row + ')" style="display: inline-block;" ></span></a>';
                    dom += '<a href="javascript:void(0)" id="select_field' + prod_attr_row + '" <span class="elex-gpf-icon elex-gpf-icon-select" title="Select value" onclick="elex_add_select_field(' + prod_attr_row + ')" style="display: inline-block;" ></span></a>';
                    dom += '<a onclick="elex_prepend_field_fun('+prod_attr_row+')"  href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-prepend" title="Prepend value" style="display: inline-block;" ></span></a>';
                    dom += ' ';
                    dom += '<a onclick="elex_append_field_fun('+prod_attr_row+')" href="javascript:void(0)"<span class="elex-gpf-icon elex-gpf-icon-append" title="Append value" style="display: inline-block;" ></span></a>';
                    dom += ' ';
                    dom += '<button onclick="elex_set_condition_fun('+prod_attr_row+')" class = "button button-primary" href="javascript:void(0)" >Set Rules</button>';
                    dom += '</div>';
                    dom += '<div id="elex_append_attr_div_' + prod_attr_row + '"></div>';
                    dom += '</td>';
                    dom += '</tr>';
                    selected_google_attr.push(index);
                    prod_attr_row++;
                }
                );
                dom2 = '';
                var grp_type_all = '';
                jQuery.each(product_attr, function (index, value) {
                    if (product_attr[index]['grp_type'] != grp_type_all) {
                        if (grp_type_all != '') {
                            dom2 += '</optgroup>';
                        }
                        dom2 += '<optgroup label="' + product_attr[index]['grp_type'] + '">';
                        grp_type_all = product_attr[index]['grp_type'];
                    }
                    dom2 += '<option value=' + index + '>' + product_attr[index]['label'] + '</option>';
                });
                dom2 += '</optgroup>';
                jQuery.each(optional_attr, function (index2, value2) {
                    dom3 += '<optgroup label="' + index2 + '">';
                    jQuery.each(optional_attr[index2], function (index3, value3) {
                        dom3 += '<option value="' + index3 + '">' + optional_attr[index2][index3]['label'] + '</option>';
                    });
                    dom3 += '</optgroup>';
                });
                jQuery('#elex_required_attr_map').empty();
                jQuery('#elex_required_attr_map').append(dom);
                for (var i = 0; i < prod_attr_row; i++) {
                    jQuery('#select_field' + i).hide();
                    jQuery('#default_text_display_'+i).hide();
                }
                jQuery('#elex_optional_attr_map').empty();
                jQuery('#settings_map_category').hide();
                jQuery('#settings_map_attributes').show();
                jQuery('#elex_settings_nochange').hide();
                jQuery('#elex_map_cat_nochange').hide();
                jQuery('#elex_map_attr_nochange').hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

        
    jQuery(document).on('click','.elex-gpf-icon-remove',function() {
        var id = (jQuery(this).closest('div').attr('id'));
        jQuery(this).closest('div').remove();
        if(id.startsWith('elex_condition_line_')) {
            arr_id = id.split('-');
            arr_id = arr_id[0].split('_');
            if(jQuery('#elex_condition_lines_'+arr_id[3]+'-'+arr_id[4]+'> div').attr('id') == undefined)  {
                jQuery('#set_cond_child_div_'+arr_id[3]+'-'+arr_id[4]).remove();

                if(jQuery('#elex_set_condition_div_'+arr_id[3]+'> div').attr('id') == undefined) {
                    jQuery('#default_text_display_'+arr_id[3]).hide();
                }
            }
        }
    });

    jQuery("#settings_map_attributes").on('click', '#save_settings_attr_map_add_new', function () {
        var optional_attr_dom = '<tr><td class="elex-gpf-settings-table-map-attr-left"><select id="sample_name' + attr_row_count + '">';
        optional_attr_dom += dom3;
        optional_attr_dom += '</select></td> ';
        optional_attr_dom += '<td class="elex-gpf-settings-table-map-attr-middle">';

        optional_attr_dom += '<div id="elex_set_condition_div_' + prod_attr_row + '"></div>';
        optional_attr_dom += '<div id="elex_prepend_attr_div_' + prod_attr_row + '" ><p id="default_text_display_' + prod_attr_row + '"><br><b style="font-size:20px;">Set Default values</b></p></div>'


        optional_attr_dom += '<select id="sample_name2' + prod_attr_row + '" style="width:230px;">' + dom2 + '</select> ';
        optional_attr_dom += '<a href="javascript:void(0)" id="text_field' + prod_attr_row + '" <span class="elex-gpf-icon elex-gpf-icon-text" title="Enter a text value" onclick="elex_add_text_field(' + prod_attr_row + ')" style="display: inline-block;" ></span></a> ';
        optional_attr_dom += '<a href="javascript:void(0)" id="select_field' + prod_attr_row + '" <span class="elex-gpf-icon elex-gpf-icon-select" title="Select value" onclick="elex_add_select_field(' + prod_attr_row + ')" style="display: inline-block;" ></span></a> ';
        optional_attr_dom += '<a onclick="elex_prepend_field_fun('+prod_attr_row+')"  href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-prepend" title="Prepend value" style="display: inline-block;" ></span></a> ';
        optional_attr_dom += ' ';
        optional_attr_dom += '<a onclick="elex_append_field_fun('+prod_attr_row+')" href="javascript:void(0)"<span class="elex-gpf-icon elex-gpf-icon-append" title="Append value" style="display: inline-block;" ></span></a> ';
        optional_attr_dom += ' ';
        optional_attr_dom += '<button onclick="elex_set_condition_fun('+prod_attr_row+')" class = "button button-primary" href="javascript:void(0)" >Set Rules</button> ';
        optional_attr_dom += '<a href="javascript:void(0)" id="remove-officer-button" <span class="elex-gpf-icon elex-gpf-icon-delete" title="Remove" style="display: inline-block;" ></span></a> ';
        optional_attr_dom += '</div>';
        optional_attr_dom += '<div id="elex_append_attr_div_' + prod_attr_row + '" ></div>';
        
        optional_attr_dom += '</td> </tr>';
        jQuery('#elex_optional_attr_map').append(optional_attr_dom);
        jQuery('#select_field' + prod_attr_row).hide();
        jQuery('#default_text_display_' + prod_attr_row).hide();
        attr_row_count++;
        prod_attr_row++;
    });

    jQuery('#attribute_back_button').on('click', function () {
        jQuery('#elex_gpf_step3').removeClass('active');
        jQuery('#elex_gpf_step2').addClass('active');
        jQuery("#settings_map_attributes").hide();
        jQuery("#settings_map_category").show();
    });

    jQuery('#category_back_button').on('click', function () {
        jQuery('#elex_gpf_step2').removeClass('active');
        jQuery('#elex_gpf_step1').addClass('active');
        jQuery("#settings_map_category").hide();
        jQuery("#settings_first_section").show();
    });

    jQuery('#exclude_back_button').on('click', function () {
        jQuery('#elex_gpf_step4').removeClass('active');
        jQuery('#elex_gpf_step3').addClass('active');
        jQuery("#exclude_include").hide();
        jQuery("#settings_map_attributes").show();
    });

    jQuery("#settings_map_attributes").on('click', '#remove-officer-button', function (e) {
        var whichtr = jQuery(this).closest("tr");
        whichtr.remove();
        attr_row_count--;
        prod_attr_row--;
    });

    jQuery('#attribute_continue, #elex_map_attr_nochange').on('click', function () {
        jQuery('#elex_gpf_step3').removeClass('active');
        jQuery('#elex_gpf_step4').addClass('active');
        jQuery('#settings_map_attributes').hide();
        jQuery('#exclude_include').show();
    });

    jQuery('#elex_map_cat_nochange').on('click', function () {
        jQuery('#elex_gpf_step2').removeClass('active');
        jQuery('#elex_gpf_step3').addClass('active');
        jQuery('#settings_map_category').hide();
        jQuery('#settings_map_attributes').show();
        // selected_google_cats = [];
        for (var i = 0; i < count; i++) {
            var google_id = '#elex_google_cats_value' + i;
            var cat_val = jQuery(google_id).val();
            var prod_id = '#elex_tr_cat_id' + i;
            category_data = [];
            jQuery.each(jQuery(prod_id).find(".elex_cat_filter"), function () {
                if (jQuery(this).prop("checked") == true)
                    category_data.push(jQuery(this).val());
            });
            if (category_data.length != 0) {
                selected_google_cats.push(cat_val);
                google_prod_cats_pair[cat_val] = category_data;
            }
        }
    });

    jQuery("#settings_map_category").on('click', '#remove_category_mapping_tr', function (e) {
        var whichtr = jQuery(this).closest("tr");
        whichtr.remove();
    });

    jQuery('#generate_feed_button').on('click', function () {
        jQuery(".elex-gpf-loader").css("display", "block");
        var project_name = jQuery('#elex_project_title').val();
        var project_desc = jQuery('#elex_project_description').val();
        var ids_to_exclude = jQuery('#elex_exclude_products').val();
        
           
        for (var j = 0; j < attr_row_count; j++) {
            if (jQuery('#sample_name' + j).val() != undefined) {
                selected_google_attr.push(jQuery('#sample_name' + j).val());
            }
        }
         var cond = {};
         var prepend_value_to_prod_attr = {};
         var append_value_to_prod_attr = {};
        for (var j = 0; j < prod_attr_row; j++) {

            if (jQuery('#sample_name2' + j).val() != undefined) {
                var temp_arr3 = [];
                    var child_count = 0;
                jQuery('#elex_set_condition_div_'+j+' > div').map(function() {
                    
                    var temp_arr2 = [];
                   
                    jQuery('#'+this.id+' > div').map(function() {

                    if((this.id).startsWith('elex_condition_lines_')) {
                        var temp = 0;
                        var sample_arr = [];
                        jQuery('#'+this.id+' > div').map(function() {
                            var temp_arr = [];
                            temp_arr[0] = jQuery('#'+this.id+'_product_attr').val();
                            temp_arr[1] = jQuery('#'+this.id+'_elex_condition_options').val();
                            temp_arr[2] = jQuery('#'+this.id+'_text_value').val();
                            sample_arr[temp] = temp_arr;

                            temp++;
                        });
                        temp_arr2['0'] = sample_arr;
                    }
                    else if((this.id).startsWith('set_cond_select_operation_')) {
                        temp_arr2['1'] = jQuery('#'+this.id+'_option').val();
                    }

                    
                    else if((this.id).startsWith('select_prod_attr_for_cond_')) {
                        temp_arr2['2'] = jQuery('#'+this.id+'_product_attr').val();
                            jQuery('#'+this.id+' > div').map(function() {
                                if((this.id).startsWith('select_prod_attr_prepend_conditions_')) {
                                    var temp = 0;
                                    var sample_arr = [];
                                    jQuery('#'+this.id+' > div').map(function() {
                                        var temp_arr = [];
                                        temp_arr['0'] = jQuery('#'+this.id+'_product_attr').val();
                                        temp_arr['1'] = jQuery('#'+this.id+'_elex_delimeter_options').val();
                                        sample_arr[temp] = temp_arr;
                                        temp++;
                                    });
                                    temp_arr2['3'] = sample_arr;
                                }
                                else if((this.id).startsWith('select_prod_attr_append_conditions_')) {
                                    var temp = 0;
                                    var sample_arr = [];
                                    jQuery('#'+this.id+' > div').map(function() {
                                        var temp_arr = [];
                                        temp_arr['0'] = jQuery('#'+this.id+'_product_attr').val();
                                        temp_arr['1'] = jQuery('#'+this.id+'_elex_delimeter_options').val();
                                        sample_arr[temp] = temp_arr;
                                        temp++;
                                    });
                                    temp_arr2['4'] = sample_arr;
                                }
                            });
                            
                    }

                });
                     temp_arr3[child_count] = temp_arr2;

                    child_count++;

                });
                        cond[j] = temp_arr3;

                        var temp_arr = [];
                         var temp = 0;
                        jQuery('#elex_prepend_attr_div_'+j+' > div').map(function() {
                            var sample_arr = [];
                            sample_arr[0] = jQuery('#'+this.id+'_product_attr').val();
                            sample_arr[1] = jQuery('#'+this.id+'_elex_delimeter_options').val();
                            temp_arr[temp] = sample_arr;
                            temp++;
                        });
                        prepend_value_to_prod_attr[j] = temp_arr;

                        var temp_arr = [];
                         var temp = 0;
                        jQuery('#elex_append_attr_div_'+j+' > div').map(function() {
                            var sample_arr = [];
                            sample_arr[0] = jQuery('#'+this.id+'_product_attr').val();
                            sample_arr[1] = jQuery('#'+this.id+'_elex_delimeter_options').val();
                            temp_arr[temp] = sample_arr;
                            temp++;
                        });
                        append_value_to_prod_attr[j] = temp_arr;
            }


            if (jQuery('#sample_name2' + j).val() != undefined) {
                var prefix = '';
                if (jQuery('#sample_name2' + j).attr('type') == 'text') {
                    prefix = 'elex_text_val';
                }
                selected_product_attr.push(prefix + jQuery('#sample_name2' + j).val());
            }
        }
        var file_type = jQuery('#feed_file_type').val();

        //Schedule
        var refresh_type = jQuery('#refresh_schedule').val();
        var refresh_days = '';
        if(refresh_type == 'weekly') {
            refresh_days = jQuery('#elex_weekly_days').val();
        }
        else if(refresh_type == 'monthly') {
            refresh_days = jQuery('#elex_monthly_days').val();
        }

        var refresh_hours = jQuery('#refresh_hour').val();

        var include_var = false;
        
        var enable_identifier_exists = false;
        if (jQuery("#autoset_identifier_exists").attr("checked")) {
            enable_identifier_exists = true;
        }
        var country = jQuery('#country_of_sale').val();
        var selected_prod_cats = [];
        jQuery('#elex_cat_table').find('tbody').find('.check-column input:checked').each(function() {
            selected_prod_cats.push(jQuery(this).val())
        });

        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                _ajax_elex_gpf_nonce: jQuery('#_ajax_elex_gpf_nonce').val(),
                action: 'elex_gpf_generate_feed',
                project_title: project_name,
                description : project_desc,
                sel_google_cats: selected_google_cats,
                categories_choosen: selected_prod_cats,
                google_attr: selected_google_attr,
                sale_country: country,
                prod_attr: selected_product_attr,
                exclude_ids: ids_to_exclude,
                refresh_schedule: refresh_type,
                feed_file_type : file_type,
                refresh_hour: refresh_hours,
                refresh_days : refresh_days,
                include_variation: include_var,
                is_edit_project :edit_project,
                file_to_edit : edit_file,
                autoset_identifier_exists : enable_identifier_exists,
                conditions:cond,
                prepend_attr : prepend_value_to_prod_attr,
                append_attr : append_value_to_prod_attr
            },
            success: function (response) {
                if(response == 'same_name') {
                    jQuery(".elex-gpf-loader").css("display", "none");
                    alert('Project already exists with the same name');
                    return;
                }
                jQuery(".elex-gpf-loader").css("display", "none");
                window.location.href = "admin.php?page=elex-product-feed-manage";
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});

function elex_return_unique_value_array (value, index, self) {
    return self.indexOf(value) === index;
}

function elex_copy_file(file) {
    elex_edit_file(file, 'Copy of ');
}

function elex_pause_schedule(file) {
    jQuery(".elex-gpf-loader").css("display", "block");
    jQuery.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
            _ajax_elex_gpf_manage_feed_nonce: jQuery('#_ajax_elex_gpf_nonce').val(),
            action: 'elex_gpf_pause_schedule',
            file: file,
            feed_action : 'pause'
        },
        success: function (response) {
            window.location.href = "admin.php?page=elex-product-feed-manage";
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function elex_play_schedule(file) {
    jQuery(".elex-gpf-loader").css("display", "block");
    jQuery.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
            _ajax_elex_gpf_manage_feed_nonce: jQuery('#_ajax_elex_gpf_nonce').val(),
            action: 'elex_gpf_pause_schedule',
            file: file,
            feed_action : 'play'
        },
        success: function (response) {
            window.location.href = "admin.php?page=elex-product-feed-manage";
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

function elex_add_text_field(attr_count) {
    jQuery("#text_field" + attr_count).hide();
    jQuery("#select_field" + attr_count).show();
    jQuery('#sample_name2' + attr_count).replaceWith('<input type="text"  id="sample_name2' + attr_count + '" style="width:230px;">');
}

function elex_add_select_field(attr_count) {
    jQuery("#select_field" + attr_count).hide();
    jQuery("#text_field" + attr_count).show();
    jQuery('#sample_name2' + attr_count).replaceWith('<select  id="sample_name2' + attr_count + '" style="width:230px;">' + dom2 + '</select>');
}

function elex_preselect_attributes(index, index2) {
    var prod_attr = ['ID', '_sku', 'price', '_regular_price', '_sale_price', 'post_title', 'review_comment', 'review_count', 'post_content', 'post_excerpt', '_backorders', '_height', '_width', '_length', '_weight', 'main_image', 'item_group_id', '_manage_stock', 'menu_order', 'post_author', 'product_tags', 'product_type', 'permalink', 'wc_currency', '_virtual', '_tax_class', '_tax_status', '_sold_individually', '_stock', '_stock_status', '_elex_gpf_brand', '_elex_gpf_mpn', '_elex_gpf_gtin', 'google_category'];
    var req_attr = [];
    switch (index) {
        case 'id':
            req_attr = ['ID', '_sku'];
            break;
        case 'price':
            req_attr = ['price', '_regular_price', '_sale_price'];
            break;
        case 'title':
            req_attr = ['post_title', 'post_content', 'post_excerpt', 'post_author'];
            break;
        case 'description':
            req_attr = ['post_title', 'post_content', 'post_excerpt', 'post_author'];
            break;
        case 'link':
            req_attr = ['permalink'];
            break;
        case 'availability':
            req_attr = ['_stock_status'];
            break;
        case 'image_link':
            req_attr = ['main_image'];
            break;
        case 'gtin':
            req_attr = ['_elex_gpf_gtin'];
            break;
        case 'brand':
            req_attr = ['_elex_gpf_brand'];
            break;
        case 'mpn':
            req_attr = ['_elex_gpf_mpn'];
            break;
        case 'item_group_id':
            req_attr = ['item_group_id'];
            break;
        case 'google_product_category':
            req_attr = ['google_category'];
            break;
        default:
            return true;
    }
    jQuery.each(req_attr, function (key, value2) {
                prod_attr = jQuery.grep(prod_attr, function (value) {
                    return value != value2;
                });
            });
            if (prod_attr.indexOf(index2) !== -1) {
                return false;
            } else {
                return true;
            }
}


function elex_append_field_fun(row_count,prod_attr_option) {
    if(prod_attr_option == undefined) {
        prod_attr_option = dom2;
    }
    var child_id = 0;
    if(jQuery('#elex_append_attr_div_'+row_count+'> div').attr('id') != undefined)  {
        child_id = parseInt((jQuery('#elex_append_attr_div_'+row_count+'> div:last-child').attr('id')).split('-')[1])+1;
    }
    var append_data = '<div id="elex_append_attr_child_div_'+row_count+'-'+child_id+'" style="padding: 1% 0px 0px 0px;">';
        append_data += elex_get_delimeters('elex_append_attr_child_div_'+row_count+'-'+child_id+'');
        append_data += '<select style="width:25%;" id="elex_append_attr_child_div_'+row_count+'-'+child_id+'_product_attr">'+prod_attr_option+'</select> ';
        append_data += '<a href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-remove" title="Remove" style="display: inline-block;" ></span></a>';
        append_data += '</div>';

    jQuery('#elex_append_attr_div_'+row_count).append(append_data);
}

function elex_prepend_field_fun(row_count,prod_attr_option) {
    if(prod_attr_option == undefined) {
        prod_attr_option = dom2;
    }
    var child_id = 0;
    if(jQuery('#elex_prepend_attr_div_'+row_count+'> div').attr('id') != undefined)  {
        child_id = parseInt((jQuery('#elex_prepend_attr_div_'+row_count+'> div:last-child').attr('id')).split('-')[1])+1;
    }
    
    var prepend_data = '<div id="elex_prepend_attr_child_div_'+row_count+'-'+child_id+'" style="padding: 1% 0px 0px 0px;">';
        prepend_data += '<select style="width:25%;" id="elex_prepend_attr_child_div_'+row_count+'-'+child_id+'_product_attr">'+prod_attr_option+'</select>';
        prepend_data += elex_get_delimeters('elex_prepend_attr_child_div_'+row_count+'-'+child_id+'');
        prepend_data += '<a href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-remove" title="Remove" style="display: inline-block;" ></span></a>';
        prepend_data += '</div>';
    jQuery('#elex_prepend_attr_div_'+row_count).append(prepend_data);
}

function elex_set_condition_fun(row_count,prod_attr_option) {
    var child_id = 0;
    if(prod_attr_option != undefined) {
    prod_attributes_options = prod_attr_option;
}
else {
    prod_attributes_options = dom2;
}
jQuery('#default_text_display_'+row_count).show();

    
    if(jQuery('#elex_set_condition_div_'+row_count+'> div').attr('id') != undefined)  {
        child_id = parseInt((jQuery('#elex_set_condition_div_'+row_count+'> div:last-child').attr('id')).split('-')[1])+1;
    }

    var set_cond = '<div id="set_cond_child_div_'+row_count+'-'+child_id+'" style="padding: 1% 0px 0px 1%;">';
        set_cond += '<div id = "elex_condition_lines_'+row_count+'-'+child_id+'">';
        set_cond += elex_get_condition_parameters (row_count,child_id,prod_attributes_options);
        set_cond += '</div>';
        set_cond += '<br><div id="select_prod_attr_for_cond_'+row_count+'-'+child_id+'"><b style="font-size:15px">Set Values for Condition '+(child_id+1)+'</b>';
        set_cond += '<div id="select_prod_attr_prepend_conditions_'+row_count+'-'+child_id+'"></div>';
        set_cond += '<br><select style="width:25%;" id="select_prod_attr_for_cond_'+row_count+'-'+child_id+'_product_attr">'+prod_attributes_options+'</select>';
        
        set_cond += '<a onclick = "elex_prepend_prod_attr_for_condition('+row_count+','+child_id+')" href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-prepend" title="Prepend value" style="display: inline-block;" ></span></a> ';
        set_cond += '<a onclick = "elex_append_prod_attr_for_condition('+row_count+','+child_id+')" href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-append" title="Append value" style="display: inline-block;" ></span></a><br>'
        set_cond += '<div id="select_prod_attr_append_conditions_'+row_count+'-'+child_id+'"></div>';
        set_cond += '</div>';
        set_cond += '</div>';

    jQuery('#elex_set_condition_div_'+row_count).append(set_cond);
    var prepend_data = "<div id = 'set_cond_select_operation_"+row_count+"-"+child_id+"'>";
    if(child_id != 0) {
        prepend_data += '<br><br>';
    }
    prepend_data += '<b style="font-size:20px;">Rule '+(child_id+1)+'</b> <a href="javascript:void(0);" onclick ="elex_add_more_conditions('+row_count+','+child_id+')" <span class="elex-gpf-icon elex-gpf-icon-add" title="Add new condition" style="display: inline-block;" ></span></a><select title="Choose the operator to execute the condition." id = "set_cond_select_operation_'+row_count+'-'+child_id+'_option" style="float:right;"><option>AND</option><option>OR</option></select></div><br>';
    jQuery('#set_cond_child_div_'+row_count+'-'+child_id).prepend(prepend_data);
}

function elex_get_condition_parameters (row_count,child_id,prod_attributes_options) {
    var cond = '';
    if(prod_attributes_options == undefined) {
        prod_attributes_options = dom2;
    }
    var next_id = 0;
    if(jQuery('#elex_condition_lines_'+row_count+'-'+child_id+'> div').attr('id') !== undefined){
        next_id = parseInt((jQuery('#elex_condition_lines_'+row_count+'-'+child_id+'> div:last-child').attr('id')).split('-')[1])+1;
    }
    cond += '<div id="elex_condition_line_'+row_count+'_'+child_id+'-'+next_id+'"><select style="width:25%;" id="elex_condition_line_'+row_count+'_'+child_id+'-'+next_id+'_product_attr">'+prod_attributes_options+'</select>';
    cond += '<select style="width:25%;" id="elex_condition_line_'+row_count+'_'+child_id+'-'+next_id+'_elex_condition_options">';
    cond += '<optgroup label="String">';
    cond += '<option value="contains">Contains</option>';
    cond += '<option value="string_equals">Equals</option>';
    cond += '<option value="starts_with">Starts with</option>';
    cond += '<option value="ends_with">Ends with</option>';
    cond += '</optgroup>';
    cond += '<optgroup label="Arithmatic">';
    cond += '<option value="less_than">Less than</option>';
    cond += '<option value="less_than_equal">Less than or equal</option>';
    cond += '<option value="greater_than">Greater than</option>';
    cond += '<option value="greater_than_equal">Greater than or equal</option>';
    cond += '<option value="arith_equals">Equals</option>';
    cond += '</optgroup>';
    cond += '</select>';
    cond += '<input id="elex_condition_line_'+row_count+'_'+child_id+'-'+next_id+'_text_value" type="text" style="width:25%;" /> <a href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-remove" title="Remove condition" style="display: inline-block;" ></span></a><br></div>';

    return cond;
}
function elex_prepend_prod_attr_for_condition (row_count,child_id,prod_attr_option) {
    if(prod_attr_option == undefined) {
        prod_attr_option = dom2;
    }
    var prepend_data = '';
    var next_id = 0;
    if(jQuery('#select_prod_attr_prepend_conditions_'+row_count+'-'+child_id+'> div').attr('id') !== undefined){
        next_id = parseInt((jQuery('#select_prod_attr_prepend_conditions_'+row_count+'-'+child_id+'> div:last-child').attr('id')).split('-')[1])+1;
    }

    prepend_data += '<div id="select_prod_attr_prepend_for_cond_'+row_count+'_'+child_id+'-'+next_id+'" style="padding: 1% 0px 0px 0px;"><select style="width:25%;" id="select_prod_attr_prepend_for_cond_'+row_count+'_'+child_id+'-'+next_id+'_product_attr">'+prod_attr_option+'</select>'+elex_get_delimeters('select_prod_attr_prepend_for_cond_'+row_count+'_'+child_id+'-'+next_id+'')+'';
    prepend_data += '<a href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-remove" title="Remove" style="display: inline-block;" ></span></a>';
    prepend_data += '</div>';
    jQuery("#select_prod_attr_prepend_conditions_"+row_count+'-'+child_id).append(prepend_data);

}
function elex_append_prod_attr_for_condition (row_count,child_id,prod_attr_option) {
    if(prod_attr_option == undefined) {
        prod_attr_option = dom2;
    }
    var append_data = '';
    var next_id = 0;
    if(jQuery('#select_prod_attr_append_conditions_'+row_count+'-'+child_id+'> div').attr('id') !== undefined){
        next_id = parseInt((jQuery('#select_prod_attr_append_conditions_'+row_count+'-'+child_id+'> div:last-child').attr('id')).split('-')[1])+1;
    }
    append_data += '<div id="select_prod_attr_append_for_cond_'+row_count+'_'+child_id+'-'+next_id+'" style="padding: 1% 0px 0px 0px;">'+elex_get_delimeters('select_prod_attr_append_for_cond_'+row_count+'_'+child_id+'-'+next_id+'')+'<select style="width:25%;" id="select_prod_attr_append_for_cond_'+row_count+'_'+child_id+'-'+next_id+'_product_attr">'+prod_attr_option+'</select>';
    append_data += '<a href="javascript:void(0);" <span class="elex-gpf-icon elex-gpf-icon-remove" title="Remove" style="display: inline-block;" ></span></a>';
    append_data += '</div>';
    jQuery("#select_prod_attr_append_conditions_"+row_count+'-'+child_id).append(append_data)

}

function elex_get_delimeters (id) {
    var cond = '';
    cond += '<select style="width:25%;" id="'+id+'_elex_delimeter_options">';
    cond += '<option value="" >- Delimeters -</option>';
    cond += '<option value="space">Space</option>';
    cond += '<option value="comma">Comma</option>';
    cond += '<option value="dot">Dot</option>';
    cond += '<option value="less_than">Less than</option>';
    cond += '<option value="greater_than">Greater than</option>';
    cond += '<option value="equals">Equals</option>';
    cond += '<option value="double_equals">Double equals</option>';
    cond += '<option value="semicolon">Semicolon</option>';
    cond += '<option value="pipe">Pipe</option>';
    cond += '<option value="backslash">Backslash</option>';
    cond += '<option value="forward_slash">Forward slash</option>';
    
    cond += '</select>';

    return cond;
}

function elex_add_more_conditions(row_count,child_id) {
    var append_data = '';
    append_data += elex_get_condition_parameters(row_count,child_id);
    jQuery('#elex_condition_lines_'+row_count+'-'+child_id).append(append_data);
}

function imtst_preview(){
    jQuery('#preview').html('');
    jQuery("#preview").html('<div style="background:#fff;width: 100%;text-align:center;"><img src="'+window.dir_url+'files/images/loading.gif" class=""/></div>');

    var show = new Array();
      if(jQuery('#show_name').is(":checked")) show.push('name');
      if(jQuery('#show_image').is(":checked")) show.push('image');
      if(jQuery('#show_quote').is(":checked")) show.push('quote');
      if(jQuery('#show_job').is(":checked")) show.push('job');
      if(jQuery('#show_client_url').is(":checked")) show.push('client_url');
      if(jQuery('#show_company').is(":checked")) show.push('company');
      if(jQuery('#show_company_url').is(":checked")) show.push('company_url');
      if(jQuery('#show_stars').is(":checked")) show.push('stars');
      if(jQuery('#show_date').is(":checked")) show.push('date');
    var show_str = show.join(',');
    var slide_opt = new Array();
        if(jQuery('#bullets').is(":checked")) slide_opt.push('bullets');
        if(jQuery('#nav_button').is(":checked")) slide_opt.push('nav_button');
        if(jQuery('#autoplay').is(":checked")) slide_opt.push('autoplay');
        if(jQuery('#stop_hover').is(":checked")) slide_opt.push('stop_hover');
        if(jQuery('#lazy_load').is(":checked")) slide_opt.push('lazy_load');
        if(jQuery('#responsive').is(":checked")) slide_opt.push('responsive');
        if(jQuery('#autoheight').is(":checked")) slide_opt.push('autoheight');
        if(jQuery('#loop').is(":checked")) slide_opt.push('loop');
    var slide_opt_str = slide_opt.join(',');
    var value = {
        group : jQuery("#group").val(),
        order_by : jQuery("#order_by").val(),
        order : jQuery("#order").val(),
        max_num_desc : jQuery('#max_num_desc').val(),
        limit : jQuery('#limit').val(),
        inside_template : jQuery('#inside_template').val(),
        theme : jQuery('#theme').val(),
        color_scheme : jQuery('#color_scheme').val(),
        disable_hover : jQuery('#disable_hover_effect').val(),
        show : show_str,
        columns : jQuery('#columns_num').val(),
        items_per_slide : jQuery('#items_per_slide').val(),
        slide_opt : slide_opt_str,
        slide_speed : jQuery('#speed').val(),
        slide_pagination_speed : jQuery('#pagination_speed').val(),
        pagination_theme : jQuery('#pagination_theme').val(),
		animation_in : jQuery('#animation_in').val(),
		animation_out : jQuery('#animation_out').val(),
    };
    
    if(jQuery('#read_more').is(':checked')) value.read_more = 1;

    if(jQuery('#page_inside').is(":checked")) value.page_inside = 1;
    else value.page_inside = 0;

    if(jQuery('#slider_set').is(":checked")) value.slider_set = 1;
    else value.slider_set = 0;
    if (jQuery('#tmst_custom_href').is(':checked') ){
    	value.tmst_custom_href = 1;
    }
    if(jQuery('#imtst_align_center').is(':checked')) value.align_center = 1;

    if(jQuery('#filtering').is(":checked")){
        value.filter_set = 1;
        value.filter_testimonials = jQuery('#filter_testimonials').val();
        value.filter_select_t = jQuery('#filter_select_t').val();
        value.filter_align = jQuery('#filter_align').val();
        value.layout_mode = jQuery('#layout_mode').val();
    }else value.filter_set = 0;
	
	 if(typeof value.group=='object'){
    	value.group = value.group.join(','); 
    }
	
    //loading data
    jQuery.get(dir_url+"includes/imtst_view.php", value, function(data) {
        jQuery("#preview").html(data);
     });
     //update shortcode
     imtst_update_shortcode(value);
}


function imtst_update_shortcode(value){
    // CREATE SHORTCODE
    var str = "[indeed-my-testimonials ";
    str += "group='"+value.group+"' ";
    str += "max_num_desc='"+value.max_num_desc+"' ";
    str += "order_by='"+value.order_by+"' ";
    str += "order='"+value.order+"' ";
    str += "limit='"+value.limit+"' ";
    str += "show='"+value.show+"' ";
    str += "page_inside='"+value.page_inside+"' ";
    str += "inside_template='"+value.inside_template+"' ";
    str += "theme='"+value.theme+"' ";
    str += "color_scheme='"+value.color_scheme+"' ";
    str += "disable_hover='"+value.disable_hover+"' ";
    str += "columns='"+value.columns+"' ";
    str += "slider_set='"+value.slider_set+"' ";
    str += "filter_set='"+value.filter_set+"' ";
	if (value.tmst_custom_href) str += "tmst_custom_href='1' ";
    if(value.slider_set==1){
		str += "items_per_slide='"+value.items_per_slide+"' ";
		str += "slide_opt='"+value.slide_opt+"' ";
		str += "slide_speed='"+value.slide_speed+"' ";
		str += "slide_pagination_speed='"+value.slide_pagination_speed+"' ";
		str += "pagination_theme='"+value.pagination_theme+"' ";
		str += "animation_in='"+value.animation_in+"' ";
		str += "animation_out='"+value.animation_out+"' ";
	}
    if(value.filter_set==1){
        str += "filter_testimonials='"+value.filter_testimonials+"' ";
        str += "filter_select_t='"+value.filter_select_t+"' ";
        str += "filter_align='"+value.filter_align+"' ";
        str += "layout_mode='"+value.layout_mode+"' ";
    }
    if(typeof value.read_more!='undefined' && value.read_more==1) str += "read_more=1 ";

    if(value.align_center==1) str += "align_center=1 ";

    str += "]";

    jQuery('.the_shortcode').html(str);
    jQuery(".php_code").html('&lt;?php echo do_shortcode("'+str+'");?&gt;');
}


//widget funcs
function make_inputh_string(divCheck, showValue, hidden_input_id){
    str = jQuery(hidden_input_id).val();
    if(str!='') show_arr = str.split(',');
    else show_arr = new Array();
    if(jQuery(divCheck).is(':checked')){
        show_arr.push(showValue);
    }else{
        var index = show_arr.indexOf(showValue);
        show_arr.splice(index, 1);
    }

    str = show_arr.join(',');
    jQuery(hidden_input_id).val(str);
}


function check_and_h(from, where) {
	if (jQuery(from).is(":checked")) {
		jQuery(where).val(1);
	} else {
		jQuery(where).val(0);
	}
}


function checkandShow(checkID, targetID, display_type){
    if(jQuery(checkID).is(':checked')){
      jQuery(targetID).css('display', display_type);
    }else jQuery(targetID).css('display', 'none');
}


function checkandModfCss(checkID, targetID, cssAttr, cssValue_true, cssValue_false){
    if(jQuery(checkID).is(':checked')){
      jQuery(targetID).css(cssAttr, cssValue_true);
      //filtering
      jQuery('#filtering_options').css('opacity', '0.5');
      jQuery('#filtering').attr('checked', false);
      jQuery('#group').removeAttr('disabled');
    }else jQuery(targetID).css(cssAttr, cssValue_false);
    jQuery('#read_more').removeAttr('disabled');
}


function changeColorScheme_widget(parentId, id, value, where ){
    jQuery(parentId+' li').each(function(){
        jQuery(this).attr('class', 'color_scheme_item');
    });
    jQuery(id).attr('class', 'color_scheme_item-selected');
    jQuery(where).val(value);
}


function changeColorScheme(id, value, where ){
    jQuery('#colors_ul li').each(function(){
        jQuery(this).attr('class', 'color_scheme_item');
    });
    jQuery(id).attr('class', 'color_scheme_item-selected');
    jQuery(where).val(value);
}


function update_stars(value, eachStarBaseID, hiddenID, classStarU, classStarS){
		starHoverSelect(value, eachStarBaseID, classStarU, classStarS);
		jQuery(hiddenID).val(value);
}


function starHoverSelect(value, eachStarBaseID, classStarU, classStarS){
	for(i=1;i<=5;i++){
		currentClass = classStarU;
    	if(value>=i) currentClass = classStarS;
    	jQuery(eachStarBaseID+i).attr('class', currentClass);
   	}
}


function updateStars(value, eachStarBaseID, hiddenID, classStarU, classStarS){
	value = jQuery(hiddenID).val();
	starHoverSelect(value, eachStarBaseID, classStarU, classStarS)
}

/////////FORM BUILDEr
function imtst_u_shortcode_form(value){
    // CREATE SHORTCODE
    var str = "[indeed-my-testimonials-form ";
    if(typeof value.client_name!='undefined') str += "client_name='"+value.client_name+"' ";
    if(typeof value.client_image!='undefined') str += "client_image='"+value.client_image+"' ";
    if(typeof value.client_job!='undefined') str += "client_job='"+value.client_job+"' ";
    if(typeof value.client_url!='undefined') str += "client_url='"+value.client_url+"' ";
    if(typeof value.company!='undefined') str += "company='"+value.company+"' ";
    if(typeof value.company_url!='undefined') str += "company_url='"+value.company_url+"' ";
    if(typeof value.quote!='undefined') str += "quote='"+value.quote+"' ";
    if(typeof value.rating!='undefined') str += "rating='"+value.rating+"' ";  
    if(typeof value.req!='undefined') str += "req='"+value.req+"' ";
    if(typeof value.s_msg!='undefined') str += "e_msg='"+value.s_msg+"' ";
    if(typeof value.err_msg!='undefined') str += "err_msg='"+value.err_msg+"' ";
    if(typeof value.capcha!='undefined') str += "capcha='"+value.capcha+"' ";
    if (typeof value.d_group!='undefined' && value.d_group!=-1) str += "d_group='"+value.d_group+"' ";
    str += "]";
    jQuery('.the_shortcode').html(str);
    jQuery(".php_code").html('&lt;?php echo do_shortcode("'+str+'");?&gt;');
}


function imtst_preview_form(){
    jQuery('#preview').html('');
    jQuery("#preview").html('<div style="background:#fff;width: 100%;text-align:center;"><img src="'+window.dir_url+'files/images/loading.gif" class=""/></div>');


    var value = {};


    if(jQuery('#client_name').is(":checked")) value.client_name = jQuery('#client_name_label').val();
    if(jQuery('#client_image').is(":checked")) value.client_image = jQuery('#client_image_label').val();
    if(jQuery('#client_job').is(":checked")) value.client_job = jQuery('#client_job_label').val();
    if(jQuery('#client_url').is(":checked")) value.client_url = jQuery('#client_url_label').val();
    if(jQuery('#company').is(":checked")) value.company = jQuery('#company_label').val();
    if(jQuery('#company_url').is(":checked")) value.company_url = jQuery('#company_url_label').val();
    if(jQuery('#quote').is(":checked")) value.quote = jQuery('#quote_label').val();
    if(jQuery('#rating').is(":checked")) value.rating = jQuery('#rating_label').val();
    if(jQuery('#capcha').is(":checked")) value.capcha = jQuery('#capcha_label').val();
    
    if (jQuery('#group').val()!=null && jQuery('#group').val()!=-1) value.d_group = jQuery('#group').val();

    value.s_msg = jQuery("#s_msg").val();
    value.err_msg = jQuery("#err_msg").val();


    req_arr = new Array();
    req_arr = addToObj("#client_name_req", req_arr, "client_name");
    req_arr = addToObj("#client_image_req", req_arr, "client_image");
    req_arr = addToObj("#client_job_req", req_arr, "client_job");
    req_arr = addToObj("#client_url_req", req_arr, "client_url");
    req_arr = addToObj("#company_req", req_arr, "company");
    req_arr = addToObj("#company_url_req", req_arr, "company_url");
    req_arr = addToObj("#quote_req", req_arr, "quote");
    req_arr = addToObj("#rating_req", req_arr, "rating");


    if(req_arr!='') value.req = req_arr.join();
    //loading data
    jQuery.get(dir_url+"includes/imtst_form_view.php", value, function(data) {
        jQuery("#preview").html(data);
     });
     //update shortcode
     imtst_u_shortcode_form(value);
}


function addToObj(checkId, arr, var_name){
    if(jQuery(checkId).is(":checked")) arr.push(var_name);
    return arr;
}


function disableOtherDD( checkInput, value,targetInput){
    if(jQuery(checkInput).val()==value) jQuery(targetInput).attr('disabled', 'disabled');
    else jQuery(targetInput).removeAttr('disabled');
}


function filtering_set_unset(checkInput){
    if(jQuery(checkInput).is(':checked')){
        jQuery('#filtering_options').css('opacity', '1');
        jQuery('#slider_options').css('opacity', '0.5');
        jQuery('#slider_set').attr('checked', false);
        jQuery('#group').attr('disabled', 'disabled');
        jQuery('#read_more').attr('checked', false);
        jQuery('#read_more').attr('disabled', 'disabled');
    }else{
        jQuery('#filtering_options').css('opacity', '0.5');
        jQuery('#group').removeAttr('disabled');
        jQuery('#read_more').removeAttr('disabled');
    }
}

function imtst_change_post_type_name(base_path){
    jQuery.ajax({
        type : "post",
        url : base_path+'/wp-admin/admin-ajax.php',
        data : {
                   action: "imtst_change_post_type",
                   post_name: jQuery('#imtst_post_type_name').val()
               },
        success: function(response){
        	if(response!='') window.location = base_path+'/wp-admin/edit.php?post_type='+response+'&page=testimonials_general_settings';
        }
     });
}
function imtst_select_group(id){
	the_value = jQuery(id).val();
	if (the_value.indexOf('all')>-1){
		jQuery(id).val('all');
	}
}
function imtst_uncheck_c(c, t){
	if (jQuery(c).is(':checked')) jQuery(t).attr('checked', false);
}
function imtstTestiCustomHref(v, t){
	if (v==-1){
		//display
		jQuery(t).fadeIn(200);
		return;
	} 
	jQuery(t).fadeOut(200);
}

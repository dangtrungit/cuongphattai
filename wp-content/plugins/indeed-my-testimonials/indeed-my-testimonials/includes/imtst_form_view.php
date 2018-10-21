<?php
if (isset($_REQUEST['imtst_button'])){
    $client_name = imtst_returnCheckString(@$_REQUEST['imtst_client_name']);
    $client_job = imtst_returnCheckString(@$_REQUEST['imtst_client_job']);
    $quote = imtst_returnCheckString(@$_REQUEST['imtst_quote']);
    $client_url = imtst_returnCheckString(@$_REQUEST['imtst_client_url']);
    $company = imtst_returnCheckString(@$_REQUEST['imtst_company']);
    $company_url = imtst_returnCheckString(@$_REQUEST['imtst_companyurl']);
    $rating = imtst_returnCheckString(@$_REQUEST['imtst_stars']);
    $err_set = FALSE;


    if(isset($_REQUEST['imtst_req']) && $_REQUEST['imtst_req']!=''){
        if(strpos($_REQUEST['imtst_req'], 'client_image')){
            if(!isset($_FILES) || !isset($_FILES['imtst_client_image']) || $_FILES['imtst_client_image']['size']===0) $err_set = TRUE;
        }
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'client_name', $client_name ) ) $err_set = TRUE;
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'client_job', $client_job ) ) $err_set = TRUE;
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'quote', $quote ) ) $err_set = TRUE;
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'client_url', $client_url ) ) $err_set = TRUE;
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'company', $company ) ) $err_set = TRUE;
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'company_url', $company_url ) ) $err_set = TRUE;
        if( imtst_ckreqpostval( $_REQUEST['imtst_req'], 'rating', $rating ) ) $err_set = TRUE;
    }
    //CAPCHA
    if(isset($_REQUEST['imtst_cp_ar_k']) && $_REQUEST['imtst_cp_ar_k']!=''){
    	$capcha = imtst_returnCheckString(@$_REQUEST['imtst_capcha']);
    	if($capcha!=imtst_return_capcha_answer( $_REQUEST['imtst_cp_ar_k'] )) $err_set = TRUE;	
    }
    
    if(!$err_set){
        $post_information = array(
            'post_title' => $client_name,
            'post_content' => $quote,
            'post_type' => IMTST_POST_TYPE,
            'post_status' => 'pending'
        );

        
        $i_post_id = wp_insert_post( $post_information );
        if (isset($i_post_id) && $i_post_id){
        	
        	//assign cpt to a group
        	if (isset($_REQUEST['d_group']) && $_REQUEST['d_group']){
        		wp_set_object_terms($i_post_id, $_REQUEST['d_group'], IMTST_TAXONOMY);
        	}
        	
            add_post_meta($i_post_id, 'imtst_jobtitle', $client_job, TRUE);
            add_post_meta($i_post_id, 'imtst_clienturl', $client_url, TRUE);
            add_post_meta($i_post_id, 'imtst_company', $company, TRUE);
            add_post_meta($i_post_id, 'imtst_companyurl', $company_url, TRUE);
            add_post_meta($i_post_id, 'imtst_stars', $rating, TRUE);
            //feature image
            $photo_set = false;
            if(isset($_FILES) && count($_FILES)>0){
                foreach ($_FILES as $file => $array){
                    if ($_FILES[$file]['error'] === UPLOAD_ERR_OK){
                        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
                        $attach_id = media_handle_upload( $file, $i_post_id );
                        if ($attach_id){
                        	update_post_meta($i_post_id,'_thumbnail_id',$attach_id);
                        	$photo_set = true;
                        }                        
                    }
        	    }
            }
            if (!$photo_set){
            	////if no photo, put the default
            	$default_photo = get_option('imtst_default_photo_attach_id');
            	if ($default_photo){
            		update_post_meta($i_post_id,'_thumbnail_id', $standard_photo);
            	}            	
            }
            
            //email notice
    	    $to = get_option( 'admin_email' );
    	    $subject = 'Notice! New testimonial on ' . get_bloginfo('url');
            $message = '';
            if($client_name!='') $message .= __('From: ', 'imtst') . $client_name . "\n";
            if($client_job!='') $message .=  __('Client Job: ', 'imtst') . $client_job . "\n";
            if($client_url!='') $message .=  __('Client URL: ', 'imtst') . $client_url . "\n";
            if($company!='') $message .=  __('Company: ', 'imtst') . $company . "\n";
            if($company_url!='') $message .=  __('Company URL: ', 'imtst') . $company_url . "\n";
            if($quote!='') $message .=  __('Quote: ', 'imtst') . $quote . "\n";
            if($rating!='') $message .=  __('Rating: ', 'imtst') . $rating . "/5 " . __('stars.', 'imtst') . " \n";
    	    $headers = __('From: Indeed Testimonials', 'imtst').' <'.$to.'>' . "\r\n";
    	    if( $to ) wp_mail( $to, $subject, $message, $headers);
            $save = TRUE;
			unset($_REQUEST);
        }
    }
}


if(!isset($attr)){
///////////////PREVIEW
    $current_path = $_SERVER['SCRIPT_FILENAME'];
    $dir_arr = explode( 'wp-content/', $current_path );
    $dir = $dir_arr[0];
    require_once( $dir . 'wp-load.php' );
    $attr = $_REQUEST;
    $disable_submit = true;
}


$str = "";
    if(isset($attr['client_name'])){
        $req_sign = imtst_check_req(@$attr['req'], 'client_name');
        $value = '';
        if(isset($_REQUEST['imtst_client_name']) && $_REQUEST['imtst_client_name']!='') $value = $_REQUEST['imtst_client_name'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['client_name'] . "$req_sign</label><input type='text' name='imtst_client_name' value='{$value}' class='imtst_input' />" . "</fieldset>";
    }
    if(isset($attr['client_image'])){
        $req_sign = imtst_check_req(@$attr['req'], 'client_image');
        $value = '';
        if(isset($_REQUEST['imtst_client_image']) && $_REQUEST['imtst_client_image']!='') $value = $_REQUEST['imtst_client_image'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['client_image'] . "$req_sign</label><input type='file' name='imtst_client_image' value='{$value}' id='imtst_file_input' class='imtst_input' />" . "</fieldset>";
    }
    if(isset($attr['client_job'])){
        $req_sign = imtst_check_req(@$attr['req'], 'client_job');
        $value = '';
        if(isset($_REQUEST['imtst_client_job']) && $_REQUEST['imtst_client_job']!='') $value = $_REQUEST['imtst_client_job'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['client_job'] . "$req_sign</label><input type='text' name='imtst_client_job' value='{$value}' class='imtst_input' />" . "</fieldset>";
    }
    if(isset($attr['client_url'])){
        $req_sign = imtst_check_req(@$attr['req'], 'client_url');
        $value = '';
        if(isset($_REQUEST['imtst_client_url']) && $_REQUEST['imtst_client_url']!='') $value = $_REQUEST['imtst_client_url'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['client_url'] . "$req_sign</label><input type='text' name='imtst_client_url' value='{$value}' class='imtst_input' />" . "</fieldset>";
    }
    if(isset($attr['company'])){
        $req_sign = imtst_check_req(@$attr['req'], 'company');
        $value = '';
        if(isset($_REQUEST['imtst_company']) && $_REQUEST['imtst_company']!='') $value = $_REQUEST['imtst_company'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['company'] . "$req_sign</label><input type='text' name='imtst_company' value='{$value}' class='imtst_input' />" . "</fieldset>";
    }
    if(isset($attr['company_url'])){
        $req_sign = imtst_check_req(@$attr['req'], 'company_url');
        $value = '';
        if(isset($_REQUEST['imtst_companyurl']) && $_REQUEST['imtst_companyurl']!='') $value = $_REQUEST['imtst_companyurl'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['company_url'] . "$req_sign</label><input type='text' name='imtst_companyurl' value='{$value}' class='imtst_input' />" . "</fieldset>";
    }
    if(isset($attr['quote'])){
        $req_sign = imtst_check_req(@$attr['req'], 'quote');
        $value = '';
        if(isset($_REQUEST['imtst_quote']) && $_REQUEST['imtst_quote']!='') $value = $_REQUEST['imtst_quote'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['quote'] . "$req_sign</label><textarea name='imtst_quote' class='imtst_input' >{$value}</textarea>" . "</fieldset>";
    }
    if(isset($attr['rating'])){
        $req_sign = imtst_check_req(@$attr['req'], 'rating');
        $value = 0;
        if(isset($_REQUEST['imtst_stars']) && $_REQUEST['imtst_stars']!='') $value = $_REQUEST['imtst_stars'];
        $str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['rating'] . "$req_sign</label>".
                    "<div class='fe_wrapp_stars'>";
                for($i=1;$i<6;$i++){
                	$class = 'unselected_star';
                	if($i<=$value) $class = "selected_star";
                   $str .= "<div class='{$class}' id='client_star_$i' onClick='update_stars($i, \"#client_star_\", \"#clients_stars\", \"unselected_star\", \"selected_star\");' onMouseOver='starHoverSelect($i, \"#client_star_\", \"unselected_star\", \"selected_star\");' onMouseOut='updateStars($i, \"#client_star_\", \"#clients_stars\", \"unselected_star\", \"selected_star\");'></div>";
                }
                $str .= "<div class='clear'></div>
                        </div>
                        <input type='hidden' value='{$value}' name='imtst_stars' id='clients_stars' />
                        </fieldset>";
    }
    if (isset($attr['capcha'])){
    	$capcha_rand_key = rand(0,5);
    	$str .= "<fieldset class='imtst_fieldset'><label class='imtst_label'>" . $attr['capcha'] . "</label>".
      			"<input type='text' name='imtst_capcha' class='imtst_input capcha_field' placeholder='".__('What is the result for ', 'imtst').imtst_return_capcha_question( $capcha_rand_key )."?'>" . 
    			"<input type='hidden' name='imtst_cp_ar_k' value='".$capcha_rand_key."' />".
    			"</fieldset>";
    }
    
    //print the destination group
    if (isset($attr['d_group']) && $attr['d_group']){
    	$str .= "<input type='hidden' value='".$attr['d_group']."' name='d_group' />";
    }


    if($str!=""){
        if(isset($attr['req']) && $attr['req']!='') $str .= "<input type='hidden' value='".$attr['req']."' name='imtst_req' />";
        if(isset($disable_submit)) $disabled = 'disabled="disabled"';
        else $disabled = "";
        $str .= "<div id='imtst_submit_wrap'>" .
                    "<input type='submit' value='".__('Save', 'imtst')."' name='imtst_button' $disabled />" .
                "</div>";
        $str = "<form id='imtst_form' class='imtst_form ictst_wrapp' method='post' action='' enctype='multipart/form-data' >" . $str . "</form>";
        if( isset($save) && $save==TRUE ){
            $msg = __("Thank you for your submitted testimonial!", 'imtst');
            if(isset($attr['s_msg']) && $attr['s_msg']!='') $msg = $attr['s_msg'];
            $str .= "<div class='imtst_return_msg' >$msg</div>";
        }
        elseif ( isset($err_set) && $err_set==TRUE ){
            $msg = __("An Error has Occurred. Please Try Again and complete all the required fields!", 'imtst');
            if(isset($attr['err_msg'])) $msg = $attr['err_msg'];
            $str .= "<div class='imtst_return_msg imtst_msg-err' >$msg</div>";
        }
    }

if(!isset($return_str) || $return_str!=true ) echo $str;// Preview
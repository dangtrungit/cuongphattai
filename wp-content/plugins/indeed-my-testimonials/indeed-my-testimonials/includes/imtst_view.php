<?php
if(!isset($attr)){
///////////////PREVIEW
    $current_path = $_SERVER['SCRIPT_FILENAME'];
    $dir_arr = explode( 'wp-content', $current_path );
    $dir = $dir_arr[0];
    require_once( $dir . '/wp-load.php' );
    $attr = $_REQUEST;
}

    $show_arr = explode(',', $attr['show']);
	
	 switch($attr['order_by']){
    	case 'name':
    		$orderby = 'title';
    	break;
    	case 'date':
    		$orderby = 'date';
    	break;
    	case 'rand':
    		$orderby = 'rand';
    	break;
    	case 'last_name':
    		$orderby = 'name';
    		$last_name = true;
    	break;    	
    }
	
    if($attr['limit']==0) $limit = -1;
    else $limit = $attr['limit'];
	
    $args = array(
    	'posts_per_page'   => $limit,
    	'orderby'          => $orderby,
    	'order'            => $attr['order'],
    	'post_type'        => IMTST_POST_TYPE,
    	'post_status'      => 'publish',
        );
	if( isset($attr['filter_set']) && $attr['filter_set']==1){	
		if(isset($attr['filter_testimonials'])){
			$terms_arr = explode(',', $attr['filter_testimonials']);
			$args['tax_query'] = array(
												array(
													'taxonomy' => IMTST_TAXONOMY,
													'field' => 'slug',
													'terms' => $terms_arr
													 )
										);
		}else{
			$terms_arr = array();
			$group_arg = array(
                    'taxonomy' => IMTST_TAXONOMY,
                    'type' => IMTST_POST_TYPE,
					'hide_empty' => 0,
					'orderby' => 'slug');
			$groups_arr = get_categories($group_arg);
			if(isset($groups_arr) && count($groups_arr) > 0 && $groups_arr !== FALSE)
			foreach($groups_arr as $val){
				$terms_arr[] = $val->slug;
			}
			$args['tax_query'] = array();
		
		}
	}
    elseif($attr['group']=='all' || $attr['group'][0]=='all') $args['tax_query'] = array();
    else {
    	if(strpos($attr['group'], ',')!==FALSE){
    		$attr['group'] = explode(',', $attr['group']);
    	}
		$args['tax_query'] = array(
                                    array(
                   			            'taxonomy' => IMTST_TAXONOMY,
                                        'field' => 'slug',
                                        'terms' => $attr['group']
                                		)
                            );
	}
    $the_posts = get_posts($args);
	
	#reorder by last name
    if(isset($last_name) && $last_name==true) $the_posts = imtst_reorder_by_last_name($the_posts, $attr['order']);
	
	
    //final_str will contain the output
    $final_str = "";

if(count($the_posts)>0){
    if($attr['slider_set']==1){
        $parent_class = 'carousel_view';
    }else    $parent_class = 'ictst_content_cl';
    $num = rand(1, 10000);
    $div_parent_id = 'indeed_carousel_view_widget_' . $num;
    $arrow_wrapp_id = 'wrapp_arrows_widget_' . $num;
    $ul_id = 'indeed_ul_' . $num;
    

    /**************************** INCLUDE THEME FILE ********************************/
    $included = false;
    $theme_file = IMTST_DIR_PATH .'themes/'. $attr['theme'] . "/index.php";
    if (file_exists($theme_file)){
    	include $theme_file;
    	$included = true;
    	$final_str .= '<link rel="stylesheet" href="'.IMTST_DIR_URL .'themes/'.$attr['theme'].'/style.css" type="text/css" media="all">';
    } else {
    	$plugins_arr = array('indeed-my-testimonials-theme-pack');//list of plugins where to search for themes
    	foreach ($plugins_arr as $name){
    		$dir = str_replace('indeed-my-testimonials', $name, IMTST_DIR_PATH );
    		$style_url = str_replace('indeed-my-testimonials', $name, IMTST_DIR_URL);
    		$theme_file = $dir .'themes/'. $attr['theme'] . "/index.php";
    		if (file_exists($theme_file)){
    			include $theme_file;
    			$final_str .= '<link rel="stylesheet" href="'.$style_url.'themes/'.$attr['theme'].'/style.css" type="text/css" media="all">';
    			$included = true;
    		}
    	}
    }
    if (!$included){
    	return '';
    }
    /**************************** INCLUDE THEME FILE ********************************/   
    
    
    if($attr['color_scheme']!=''){
        $url_path = IMTST_DIR_URL . 'layouts';
        $final_str .= '<link rel="stylesheet" href="'. $url_path . '/style_' . $attr['color_scheme'] . '.css" type="text/css" media="all">';
		$color_class = 'style_' . $attr['color_scheme'];
    }else $color_class = '';
    
    //DISABLE HOVER EFFECT
    if( isset($attr['disable_hover']) && $attr['disable_hover']==1 ){
        $final_str .= "<style>";
        if($attr['theme']=='theme_4' || $attr['theme']=='theme_5' || $attr['theme']=='theme_10'){
            $final_str .= "
                           ." . $attr['theme'] . " .testi-wrapper .quotes{
                                    padding-top: 0px !important;
                           }
                          ";
        }elseif($attr['theme']=='theme_6'){
			$final_str .= "
                           ." . $attr['theme'] . " .testi-wrapper .quotes{
                                    padding-bottom: 14px !important;
                           }
                          ";
		}elseif($attr['theme']=='theme_2' || $attr['theme']=='theme_1'){
			$final_str .= "
                           ." . $attr['theme'] . " .testi-wrapper .quotes{
                                    padding-bottom: 24px !important;
                           }
                          ";
		}else{
            $final_str .= "
                           ." . $attr['theme'] . " .testi-wrapper .quotes{
                                    padding-bottom: 0px !important;
                           }
                          ";
        }
        $final_str .= "</style>";
    }
    //RESPONSIVE
    $responsive_css = '';
	$general_settings_data = imtst_general_settings_meta();
    if($general_settings_data['imtst_responsive_settings_small']!==FALSE && $general_settings_data['imtst_responsive_settings_small']!='auto'){
    	$li_w = 100 / $general_settings_data['imtst_responsive_settings_small'];
    	$responsive_css .= '
    	@media only screen and (max-width: 479px) {
    		#'.$div_parent_id.' ul li{
    			width: calc('.$li_w.'% - 1px) !important;
    		}
    	}
    ';
    }
    if($general_settings_data['imtst_responsive_settings_medium']!==FALSE && $general_settings_data['imtst_responsive_settings_medium']!='auto'){
    	$li_w = 100 / $general_settings_data['imtst_responsive_settings_medium'];
    	$responsive_css .= '
    	@media only screen and (min-width: 480px) and (max-width: 767px){
    		#'.$div_parent_id.' ul li{
    			width: calc('.$li_w.'% - 1px) !important;
    		}
    	}
    ';
    }
    if($general_settings_data['imtst_responsive_settings_large']!==FALSE && $general_settings_data['imtst_responsive_settings_large']!='auto'){
    	$li_w = 100 / $general_settings_data['imtst_responsive_settings_large'];
    	$responsive_css .= '
    	@media only screen and (min-width: 768px) and (max-width: 959px){
    		#'.$div_parent_id.' ul li{
    			width: calc('.$li_w.'% - 1px) !important;
    		}
    	}
    ';
    }
    $css = '';
    if(isset($attr['align_center']) && $attr['align_center']==1) $css .= '#'.$div_parent_id.' ul{text-align: center;}'; # ALIGN CENTER
    //CUSTOM CSS
    if(isset($general_settings_data['imtst_custom_css']) && $general_settings_data['imtst_custom_css']!=''){
    	$css .= $general_settings_data['imtst_custom_css'];
    }    
    if($responsive_css!='' || $css!='') $final_str .= '<style>' . $responsive_css . $css . '</style>';
    
    #rich snippet
    if(isset($general_settings_data['imtst_rich_snippets']) && $general_settings_data['imtst_rich_snippets']==1){
		$total_sum_rates = 0;
		$total_count_rates = 0;
    	if(!defined('IMTST_RICH_SNIPPETS_START')){
    		$final_str .= '<div itemscope=" " itemtype="http://schema.org/Product"><meta itemprop="name" content="Testimonials Reviews">';
    		define('IMTST_RICH_SNIPPETS_START', true);
    	}    	
    }    
    if(isset($attr['color_scheme']) && $attr['color_scheme']!=''){
  	$final_str .= '<style>
					 .style_'.$attr['color_scheme'].' .owl-tst-theme .owl-tst-dots .owl-tst-dot.active span, .style_'.$attr['color_scheme'].'  .owl-tst-theme .owl-tst-dots .owl-tst-dot:hover span { background: #'.$attr['color_scheme'].' !important; }
					 .style_'.$attr['color_scheme'].' .pag-theme1 .owl-tst-theme .owl-tst-nav [class*="owl-tst-"]:hover{ background-color: #'.$attr['color_scheme'].'; }
					 .style_'.$attr['color_scheme'].' .pag-theme2 .owl-tst-theme .owl-tst-nav [class*="owl-tst-"]:hover{ color: #'.$attr['color_scheme'].'; }
					 .style_'.$attr['color_scheme'].' .pag-theme3 .owl-tst-theme .owl-tst-nav [class*="owl-tst-"]:hover{ background-color: #'.$attr['color_scheme'].';}';
  	$final_str .= '</style>'; 	
  }
  	
  	if (!isset($attr['pagination_theme'])) $attr['pagination_theme'] = '';
  
    $final_str .= "<div class='$color_class'>";
    $final_str .= "<div class='{$attr['theme']} {$attr['pagination_theme']}'>";
    $final_str .= "<div class='ictst_wrapp'>";
    $final_str .= "<div class='$parent_class' id='$div_parent_id' >";
    $default_item = $list_item_template;
    $li_width = 100 / $attr['columns'];
    $li_width = 'calc('.$li_width.'% - 1px)';
    $j = 1;
    $breaker_div = 1;
    $new_div = 1;
    $total_items = count($the_posts);
    if($attr['slider_set']==1) $items_per_slide = $attr['items_per_slide'];
    else $items_per_slide = $total_items;
	
	
if(isset($attr['filter_set']) && $attr['filter_set']==1){
  /////////////////////////////////////FILTER\\\\\\\\\\\\\\\\\\\\
  $filter_rand_num = rand(1,5000);
  //// additional STYLE
  if(isset($attr['color_scheme']) && $attr['color_scheme']!=''){
  	$final_str .= '<style>
					  	.tstFilter_'.$filter_rand_num.' .tstFilterlink-small_text:hover{
						  	color: #'.$attr['color_scheme'].';
					  	}
					  	.tstFilter-wrapper-small_text  .tstFilter_'.$filter_rand_num.' .current{
						  	color: #'.$attr['color_scheme'].';
					  	}
					  	.tstFilter_'.$filter_rand_num.' .tstFilterlink-big_text:hover{
						  	color: #'.$attr['color_scheme'].';
					  	}
					  	.tstFilter-wrapper-big_text  .tstFilter_'.$filter_rand_num.' .current{
						  	color: #'.$attr['color_scheme'].';
					  	}
					  	.tstFilter_'.$filter_rand_num.' .tstFilterlink-small_button:hover{
						  	background-color:#'.$attr['color_scheme'].';
						  	color:#fff;
					  	}
					  	.tstFilter-wrapper-small_button  .tstFilter_'.$filter_rand_num.' .current{
						  	background-color:#'.$attr['color_scheme'].';
						  	color:#fff;
					  	}
					  	.tstFilter_'.$filter_rand_num.' .tstFilterlink-big_button:hover{
						  	background-color:#'.$attr['color_scheme'].';
						  	border-color:#'.$attr['color_scheme'].';
						  	color:#fff;
					  	}
					  	.tstFilter-wrapper-big_button .tstFilter_'.$filter_rand_num.'  .current{
						  	background-color:#'.$attr['color_scheme'].';
						  	border-color:#'.$attr['color_scheme'].';
						  	color:#fff;
					  	}
					  	.tstFilter_'.$filter_rand_num.' .tstFilterlink-dropdown:hover{
						  	border-color:#'.$attr['color_scheme'].';
					  	}';
  	$final_str .= '</style>';  	
  }
  
  if (!isset($attr['layout_mode']) || !$attr['layout_mode']) $attr['layout_mode'] = 'masonry';//default
  
  //// additional JS
  $final_str .= "<script>

					jQuery(window).load(function(){
						var container = jQuery('.indeed_tst_filter_".$filter_rand_num."');
						container.isotope({
							filter: '*',
							layoutMode: '".$attr['layout_mode']."',
							transitionDuration: '1s',
						});	";
  if($attr['filter_select_t']=='dropdown'){
  	$final_str .= "
                        jQuery('.tstFilterlink-select_".$filter_rand_num."').change(function(){
							var selector = jQuery('.tstFilterlink-select_".$filter_rand_num."').val();
							container.isotope({
								filter: selector,
								layoutMode: '".$attr['layout_mode']."',
								transitionDuration: '1s',
							 });
							 return false;
                        });		
  				 ";  	
  }else{
  	$final_str .= "
						jQuery('.tstFilter_".$filter_rand_num." div').click(function(){
							jQuery('.tstFilter_".$filter_rand_num." .current').removeClass('current');
							jQuery(this).addClass('current');
							var selector = jQuery(this).attr('data-filter');
							container.isotope({
								filter: selector,
								layoutMode: '".$attr['layout_mode']."',
								transitionDuration: '1s',
							 });
							 return false;
						});
  					";
  }$final_str .= "	
					});
  				</script>";
  //// FILTER
  $attr['slider_set'] = 0;//secure slider at 0
  $final_str .= '<div class="tstFilter-wrapper tstFilter-wrapper-'.$attr['filter_select_t'].'"" style="text-align:'.$attr['filter_align'].';">';
  $final_str .= '<div class="tstFilter_'.$filter_rand_num.'">';
    if(isset($terms_arr) && count($terms_arr)>0){
            if($attr['filter_select_t']=='dropdown'){
                //DROPDOWN
                    $final_str .= '<div class="tstFilterlink-'.$attr['filter_select_t'].'">';
                    $final_str .= '<select class="tstFilterlink-select_'.$filter_rand_num.'">';
                    $final_str .= '<option  value="*">'.__('All', 'imtst').'</option>';
                    foreach($terms_arr as $term){
                        $team_name = get_term_by('slug', $term, IMTST_TAXONOMY);
                        $final_str .= '<option value=".'.$term.'">'. $team_name->name .'</option>';
                    }
                    $final_str .= '</select>';
                    $final_str .= '</div>';
            }else{
                //SMALL text,button BIG text,buttons
                    $final_str .= '<div class="tstFilterlink tstFilterlink-'.$attr['filter_select_t'].'" data-filter="*">'.__('All', 'imtst').'</div>';
                    foreach($terms_arr as $term){
                        $team_name = get_term_by('slug', $term, IMTST_TAXONOMY);
                        $final_str .= '<div class="tstFilterlink-'.$attr['filter_select_t'].'" data-filter=".'.$term.'">'. $team_name->name .'</div>';
                    }
                    $final_str .= '</div>';
            }
    }
  $final_str .= '</div>';
	/// LIST
    $final_str .= "<ul class='tstContainer indeed_tst_filter_".$filter_rand_num."'>";
    $quote_base_id = rand(1,10000);
    
    foreach($the_posts as $post){
        $terms_arr = get_the_terms( $post->ID, IMTST_TAXONOMY );
        $term_slug_str = '';
        foreach($terms_arr as $term_arr){
			if($term_slug_str!='') $term_slug_str .= ' ';
            $term_slug_str .= $term_arr->slug;
        }
        $final_str .= "<li style='width: $li_width;' class='$term_slug_str' data-category='$term_slug_str'>";
        ////NAME
        if(in_array('name', $show_arr)){
            $name = get_the_title($post->ID);
            $list_item_template = str_replace("IMTST_NAME", $name, $list_item_template);
        }else $list_item_template = str_replace("IMTST_NAME", "", $list_item_template);
        
        ////QUOTE
        if(in_array('quote', $show_arr)){
            $quote = $post->post_content;
            $quote = imtst_format_quote( $quote );
            if(isset($attr['max_num_desc'])){
            	if(strlen($quote)>$attr['max_num_desc']){
            		$length = $attr['max_num_desc'] - 3;
            		$quote = mb_substr( $quote , 0,  $length) . '...';
            	}
            }
            $list_item_template = str_replace("IMTST_QUOTE", $quote, $list_item_template);
            $list_item_template = str_replace("#SHOW_QUOTE", "", $list_item_template);   
               	
        }else { $list_item_template = str_replace("IMTST_QUOTE", "", $list_item_template);
			    $list_item_template = str_replace("#SHOW_QUOTE", "hide", $list_item_template);
     	}
        ////IMAGE
        if(in_array('image', $show_arr)){
            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' );
            if (isset($src[0])){
            	$img_src = $src[0];
            } else {
            	$img_src = get_option('default_client_img');	
            }
            $list_item_template = str_replace("IMTST_IMAGE", $img_src, $list_item_template);
        }else {$list_item_template = str_replace("IMTST_IMAGE", "", $list_item_template);
			   $list_item_template = str_replace("#SHOW_IMG", "hide", $list_item_template);
		}
        ////CLIENT JOB
        if(in_array('job', $show_arr)){
            $job = get_post_meta( $post->ID, 'imtst_jobtitle', true );
            $list_item_template = str_replace("IMTST_CLIENT_JOB", $job, $list_item_template);
			if(in_array('name', $show_arr)){$list_item_template = str_replace("#SHOW_JOB", "show", $list_item_template);}
        }else $list_item_template = str_replace("IMTST_CLIENT_JOB", "", $list_item_template);
        ////CLIENT URL
        if(in_array('client_url', $show_arr)){
            $client_url = get_post_meta( $post->ID, 'imtst_clienturl', true );
			$client_url = str_replace("http://","",$client_url);
			$client_url = str_replace("https://","",$client_url);
            $list_item_template = str_replace("#IMTST_CLIENT_URL", '<a href="http://'.$client_url.'"  target="_blank">', $list_item_template);
			$list_item_template = str_replace("#IMTST_CLIENT_END_URL", '</a>', $list_item_template);
        }else {
			$list_item_template = str_replace("#IMTST_CLIENT_URL", "", $list_item_template);
			$list_item_template = str_replace("#IMTST_CLIENT_END_URL", "", $list_item_template);
		}
        ////COMPANY
        if(in_array('company', $show_arr)){
            $company = get_post_meta( $post->ID, 'imtst_company', true );
            $list_item_template = str_replace("IMTST_COMPANY", $company, $list_item_template);
			 if(in_array('job', $show_arr)){$list_item_template = str_replace("#SHOW_COMP", "show", $list_item_template);}
        }else $list_item_template = str_replace("IMTST_COMPANY", "", $list_item_template);
        ////COMPANY URL
        if(in_array('company_url', $show_arr)){
            $company_url = get_post_meta( $post->ID, 'imtst_companyurl', true );
			$company_url = str_replace("http://","",$company_url);
			$company_url = str_replace("https://","",$company_url);
            $list_item_template = str_replace("#COMPANY_URL", '<a href="http://'.$company_url.'" target="_blank">', $list_item_template);
			$list_item_template = str_replace("#COMPANY_END_URL", '</a>', $list_item_template);
        }else {
			$list_item_template = str_replace("#COMPANY_URL", "", $list_item_template);
			$list_item_template = str_replace("#COMPANY_END_URL", "", $list_item_template);
		}
		////STARS
        if(in_array('stars', $show_arr)){
            $rating = get_post_meta( $post->ID, 'imtst_stars', true );
            $stars = imtst_return_stars($rating);
			if(isset($general_settings_data['imtst_rich_snippets']) && $general_settings_data['imtst_rich_snippets']==1){
				$total_sum_rates += $rating;
				$total_count_rates++;
			}
            $list_item_template = str_replace("IMTST_STARS", $stars, $list_item_template);
        }else $list_item_template = str_replace("IMTST_STARS", "", $list_item_template);
        ////DATE
        if(in_array('date', $show_arr)){
            $date = get_the_time('Y-m-d', $post->ID);
			$date = indeed_convert_date_to_us_format($date);
            $list_item_template = str_replace("IMTST_DATE", $date, $list_item_template);
			if(in_array('stars', $show_arr)){$list_item_template = str_replace("#SHOW_DATE", "show", $list_item_template);}
        }else $list_item_template = str_replace("IMTST_DATE", "", $list_item_template);
        ////LINKS
		unset($link);
        if($attr['page_inside']==1){
            $link = get_permalink( $post->ID );
            if($attr['inside_template']!="default"){
                $u_template = urlencode( $attr['inside_template'] );
                $link = add_query_arg( array('imtst_cpt' => $u_template ), $link );
            }
		} else {
        	if (isset($attr['tmst_custom_href']) && $attr['tmst_custom_href']){
        		$tmst_custom_href = get_post_meta($post->ID, 'imtst_testi_href', TRUE);
        		if ($tmst_custom_href){
        			if ($tmst_custom_href>0){
        				$link = get_permalink ($tmst_custom_href);
        			} elseif($tmst_custom_href==-1) {
        				//custom link
        				$link = get_post_meta($post->ID, 'imtst_testi_href-custom', TRUE);
        			}
        		}
        	}
        }
		if (isset($link)){
        	$target_blank = '';
		  if (isset($general_settings_data['imtst_target_blank']) && $general_settings_data['imtst_target_blank']) $target_blank = 'target="_blank"';	
            $list_item_template = str_replace("#IMTST_POST_LINK#", ' href="'.$link.'" '.$target_blank , $list_item_template);
        }else $list_item_template = str_replace("#IMTST_POST_LINK#", "", $list_item_template);
       
	    $final_str .= $list_item_template;
        
        #google rich snippets
        if(isset($general_settings_data['imtst_rich_snippets']) && $general_settings_data['imtst_rich_snippets']==1){
        	$rich_arr = array(
        			'title' => @$name,
        			'post_author' => get_the_author_meta( 'user_nicename', $post->post_author ),
        			'publish_date' => get_the_time('Y-m-d', $post->ID),
        			'rating' => @$rating,
        			'description' => @$quote,
        	);
        	$final_str .= imtst_return_google_rich_snippets($rich_arr);
        }
        
        $final_str .= "</li>";
        $list_item_template = $default_item;
        $j++;
    }
    $final_str .= "<div class='clear'></div></ul>";
    
}else{
  ////WITHOUT FILTER
  	$quote_base_id = rand(1,10000);
	
    foreach($the_posts as $post){
        if($new_div==1){
            $div_id = $ul_id.'_' . $breaker_div;
            $final_str .= "<ul id='$div_id' class=''>"; /////ADDING THE UL
        }
            $final_str .= "<li style='width: $li_width'>";
        ////NAME
        if(in_array('name', $show_arr)){
            $name = get_the_title($post->ID);
            $list_item_template = str_replace("IMTST_NAME", $name, $list_item_template);
        }else $list_item_template = str_replace("IMTST_NAME", "", $list_item_template);
        ////QUOTE
        if(in_array('quote', $show_arr)){
            $quote = $post->post_content;
            $quote = imtst_format_quote( $quote );
			
            if(isset($attr['max_num_desc'])){ 
            	if(strlen($quote)>$attr['max_num_desc']){
            		$length = $attr['max_num_desc'] - 3;
            		$quote = mb_substr( $quote , 0,  $length) . '...';
            		//READ MORE
					if(isset($attr['read_more']) && $attr['read_more']==1){
						$full_quote = imtst_format_quote( $post->post_content );
						$all_divs = imtst_return_read_more_cq($quote_base_id.'_'.$j, $quote, $full_quote, $attr['color_scheme']);
						$list_item_template = str_replace("IMTST_QUOTE", $all_divs, $list_item_template);
						$list_item_template = str_replace("#SHOW_QUOTE", "", $list_item_template);
					}else{
						$list_item_template = str_replace("IMTST_QUOTE", $quote, $list_item_template);
						$list_item_template = str_replace("#SHOW_QUOTE", "", $list_item_template);      	
					}			
				}else{
					$list_item_template = str_replace("IMTST_QUOTE", $quote, $list_item_template);
					$list_item_template = str_replace("#SHOW_QUOTE", "", $list_item_template);      	
				}
            }else{
				$list_item_template = str_replace("IMTST_QUOTE", $quote, $list_item_template);
				$list_item_template = str_replace("#SHOW_QUOTE", "", $list_item_template);      	
			}
            
        }else{ 
        	$list_item_template = str_replace("IMTST_QUOTE", "", $list_item_template);
			$list_item_template = str_replace("#SHOW_QUOTE", "hide", $list_item_template);
		}
        ////IMAGE
        if(in_array('image', $show_arr)){
            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' );
            if (isset($src[0])){
            	$img_src = $src[0];
            } else {
            	$img_src = get_option('default_client_img');	
            }
            $list_item_template = str_replace("IMTST_IMAGE", $img_src, $list_item_template);
        }else{
        	$list_item_template = str_replace("IMTST_IMAGE", "", $list_item_template);
			$list_item_template = str_replace("#SHOW_IMG", "hide", $list_item_template);
		}
        ////CLIENT JOB
        if(in_array('job', $show_arr)){
            $job = get_post_meta( $post->ID, 'imtst_jobtitle', true );
            $list_item_template = str_replace("IMTST_CLIENT_JOB", $job, $list_item_template);
			if(in_array('name', $show_arr)){$list_item_template = str_replace("#SHOW_JOB", "show", $list_item_template);}
        }else $list_item_template = str_replace("IMTST_CLIENT_JOB", "", $list_item_template);
        ////CLIENT URL
        if(in_array('client_url', $show_arr)){
            $client_url = get_post_meta( $post->ID, 'imtst_clienturl', true );
			$client_url = str_replace("http://","",$client_url);
			$client_url = str_replace("https://","",$client_url);
            $list_item_template = str_replace("#IMTST_CLIENT_URL", '<a href="http://'.$client_url.'"  target="_blank">', $list_item_template);
			$list_item_template = str_replace("#IMTST_CLIENT_END_URL", '</a>', $list_item_template);
        }else {
			$list_item_template = str_replace("#IMTST_CLIENT_URL", "", $list_item_template);
			$list_item_template = str_replace("#IMTST_CLIENT_END_URL", "", $list_item_template);
		}
        ////COMPANY
        if(in_array('company', $show_arr)){
            $company = get_post_meta( $post->ID, 'imtst_company', true );
            $list_item_template = str_replace("IMTST_COMPANY", $company, $list_item_template);
			 if(in_array('job', $show_arr)){$list_item_template = str_replace("#SHOW_COMP", "show", $list_item_template);}
        }else $list_item_template = str_replace("IMTST_COMPANY", "", $list_item_template);
        ////COMPANY URL
        if(in_array('company_url', $show_arr)){
            $company_url = get_post_meta( $post->ID, 'imtst_companyurl', true );
			$company_url = str_replace("http://","",$company_url);
			$company_url = str_replace("https://","",$company_url);
            $list_item_template = str_replace("#COMPANY_URL", '<a href="http://'.$company_url.'" target="_blank">', $list_item_template);
			$list_item_template = str_replace("#COMPANY_END_URL", '</a>', $list_item_template);
        }else {
			$list_item_template = str_replace("#COMPANY_URL", "", $list_item_template);
			$list_item_template = str_replace("#COMPANY_END_URL", "", $list_item_template);
		}
		////STARS
        if(in_array('stars', $show_arr)){
            $rating = get_post_meta( $post->ID, 'imtst_stars', true );
            $stars = imtst_return_stars($rating);
			if(isset($general_settings_data['imtst_rich_snippets']) && $general_settings_data['imtst_rich_snippets']==1){
				$total_sum_rates += $rating;
				$total_count_rates++;
			}
            $list_item_template = str_replace("IMTST_STARS", $stars, $list_item_template);
        }else $list_item_template = str_replace("IMTST_STARS", "", $list_item_template);
        ////DATE
        if(in_array('date', $show_arr)){
            $date = get_the_time('Y-m-d', $post->ID);
			$date = indeed_convert_date_to_us_format($date);
            $list_item_template = str_replace("IMTST_DATE", $date, $list_item_template);
			if(in_array('stars', $show_arr)){$list_item_template = str_replace("#SHOW_DATE", "show", $list_item_template);}
        }else $list_item_template = str_replace("IMTST_DATE", "", $list_item_template);
        
		////LINKS
		 unset($link);
        if($attr['page_inside']==1){
            $link = get_permalink( $post->ID );
            if($attr['inside_template']!="default"){
                $u_template = urlencode( $attr['inside_template'] );
                $link = add_query_arg( array('imtst_cpt' => $u_template ), $link );
            }
        } else {
        	if (isset($attr['tmst_custom_href']) && $attr['tmst_custom_href']){
        		$tmst_custom_href = get_post_meta($post->ID, 'imtst_testi_href', TRUE);
        		if ($tmst_custom_href){
        			if ($tmst_custom_href>0){
        				$link = get_permalink ($tmst_custom_href);
        			} elseif($tmst_custom_href==-1) {
        				//custom link
        				$link = get_post_meta($post->ID, 'imtst_testi_href-custom', TRUE);
        			}
        		}
        	}
        }

		if (isset($link)){
        	$target_blank = '';
        	if (isset($general_settings_data['imtst_target_blank']) && $general_settings_data['imtst_target_blank']) $target_blank = 'target="_blank"';
        	$list_item_template = str_replace("#IMTST_POST_LINK#", ' href="'.$link.'" '.$target_blank , $list_item_template);        	
        }else $list_item_template = str_replace("#IMTST_POST_LINK#", "", $list_item_template);
		
        $final_str .= $list_item_template;
        
        #google rich snippets
        if(isset($general_settings_data['imtst_rich_snippets']) && $general_settings_data['imtst_rich_snippets']==1){
        	$rich_arr = array(
        			'title' => @$name,
        			'post_author' => get_the_author_meta( 'user_nicename', $post->post_author ),
        			'publish_date' => get_the_time('Y-m-d', $post->ID),
        			'rating' => @$rating,
        			'description' => @$quote,
        	);
        	$final_str .= imtst_return_google_rich_snippets($rich_arr);
        }        
        
        $final_str .= "</li>";
        $list_item_template = $default_item;
      if( $j % $items_per_slide==0 || $j==$total_items ){
      	  $breaker_div++;
      	  $new_div = 1;
          $final_str .= "<div class='clear'></div></ul>";
      }else $new_div = 0;
      $j++;
    }
}//end of without filter
        $final_str .= "</div>";
        
        if($attr['slider_set']==1){
            $total_pages = $total_items / $items_per_slide;
            if($total_pages>1){
              $navigation = 'false';
              $bullets = 'false';
              $autoplay = 'false';
			  $autoheight = 'false';
              $stop_hover = 'false';
              $loop = 'false';
              $responsive = 'false';
              $lazy_load = 'false';
			  $autoplayTimeout = 5000;
              $animation_in = 'false';
              $animation_out = 'false';
			  
              if( strpos( $attr['slide_opt'], 'nav_button')!==FALSE) $navigation = 'true';
              if( strpos( $attr['slide_opt'], 'bullets')!==FALSE) $bullets = 'true';
              if( strpos( $attr['slide_opt'], 'autoplay')!==FALSE){
              	$autoplay = 'true';
				$autoplayTimeout = $attr['slide_speed'];
              }
              if( strpos( $attr['slide_opt'], 'stop_hover')!==FALSE) $stop_hover = 'true';
              
			  if( strpos( $attr['slide_opt'], 'loop')!==FALSE) $loop = 'true';
			  if( strpos( $attr['slide_opt'], 'autoheight')!==FALSE) $autoheight = 'true';
			  
              if( strpos( $attr['slide_opt'], 'responsive')!==FALSE) $responsive = 'true';
              if( strpos( $attr['slide_opt'], 'lazy_load')!==FALSE) $lazy_load = 'true';
              
              if( $attr['animation_in']!='none' ) $animation_in = "'{$attr['animation_in']}'";
			  if( $attr['animation_out']!='none' ) $animation_out = "'{$attr['animation_out']}'";
			  
               $final_str .= "<script>
                            		jQuery(document).ready(function() {
                            		  var owl = jQuery('#{$div_parent_id}');
                            		  owl.owltstCarousel({
                                            items : 1,
											mouseDrag: true,
											touchDrag: true,
											autoHeight: $autoheight,
											
											animateOut: $animation_out,
    										animateIn: $animation_in,
											
											lazyLoad : $lazy_load,
											loop: $loop,
                                			
											autoplay : $autoplay,
											autoplayTimeout: $autoplayTimeout,
											autoplayHoverPause: $stop_hover,
											autoplaySpeed: {$attr['slide_pagination_speed']},
											
											nav : $navigation,
											navSpeed : {$attr['slide_pagination_speed']},
											navText: [ '', '' ],
											
											dots: $bullets,
											dotsSpeed : {$attr['slide_pagination_speed']},
											
											responsiveClass: $responsive,
											responsive:{
											0:{
												nav:false
											},
											450:{
												nav : $navigation
											}
										}
                            		  });
                            		});    		
                               </script>";
            }
        }        
        $final_str .= "</div>";//end of ictst_wrapp
        $final_str .= "</div>";//end of theme_n
        $final_str .= "</div>";//end of style_xxxxxx
        
        #rich snippet
        if(isset($general_settings_data['imtst_rich_snippets']) && $general_settings_data['imtst_rich_snippets']==1 && !empty($total_count_rates)){
			$final_str .= '<div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
					   <meta itemprop="ratingValue" content="'.$total_sum_rates/$total_count_rates.'">
					   <meta itemprop="reviewCount" content="'.$total_count_rates.'">
				   </div>';
        	if(!defined('IMTST_RICH_SNIPPETS_END')){
        		$final_str .= '</div>';#end of rich snippet
        		define('IMTST_RICH_SNIPPETS_END', true);
        	}
        }
        
        if(!isset($return_str) || $return_str!=true ) echo $final_str;
}
?>
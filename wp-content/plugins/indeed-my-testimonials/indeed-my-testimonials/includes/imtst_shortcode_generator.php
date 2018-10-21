<?php
$shortcode_arr = imtst_init_plugin_arr();
?>
<script>
var dir_url = '<?php echo IMTST_DIR_URL;?>';
jQuery(document).ready(function(){
    imtst_preview();
});
</script>
<div id="main">
<div class="ictst_wrap">
<div>
    <h1><?php echo __('Shortcode Generator', 'imtst');?></h1>
     <div class="imtst_settings_wrapper">
        <div class="box-title">
            <h3><i class="icon-cogs"></i><?php echo __('Settings', 'imtst');?></h3>
            <div class="actions pointer">
			    <a onclick="jQuery('#the_shc_settings').slideToggle();" class="btn btn-mini content-slideUp">
                    <i class="icon-angle-down"></i>
                </a>
			</div>
            <div class="clear"></div>
        </div>
         <div id="the_shc_settings" class="imtst_settings_wrapp">
            <div class="imtst_column column_one">
                    <h4 style="background-color: rgb(66, 66, 66);"><i class="icon-imtst-dispent"></i><?php echo __('Display Entries', 'imtst');?></h4>
					<div class="imtst_settings_inner" style="padding-bottom:10px;">
                        <table style="width:100%">
                            <tr>
                                <td valign="top">
                                    <span class="imtst-strong"><?php echo __('Group:', 'imtst');?></span>
                                </td>
                                <td>
                                    <select id="group" onClick="imtst_select_group(this);imtst_preview();" class="ict_select_field_vl" multiple  style="width:100%">
                                            <?php $selected = imtst_checkIfSelected($shortcode_arr['group'], 'all', 'select');?>
                                        <option value="all" <?php echo $selected;?>><?php echo __('All', 'imtst');?></option>
                                         <?php
                                            $args = array(
                                            		       'taxonomy' => IMTST_TAXONOMY,
                                                           'type' => IMTST_POST_TYPE,
														   'hide_empty' => 0
                                            		     );
                                            $cats = get_categories($args);
											 if( isset($cats) && count($cats)>0 ){
                                            foreach($cats as $cat){
                                                $selected = imtst_checkIfSelected($shortcode_arr['group'], $cat->slug, 'select');
                                                ?>
                                              <option value="<?php echo $cat->slug;?>" <?php echo $selected;?> ><?php echo $cat->name;?></option>
                                                <?php
                                            }
											 }
                                         ?>
                                    </select>
                                </td>
                            </tr>
							<tr>
                                <td colspan="2">
                                    <span class="warning_grey_span">( <?php echo __('Select one or many Groups with Testimonials', 'imtst');?> )</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="imtst-strong"><?php echo __('Number Of Entries:', 'imtst');?></span>
                                </td>
                                <td>
                                    <input type="number" min="1" max="" id="limit" value="<?php echo $shortcode_arr['limit'];?>" onChange="imtst_preview();" onKeyup="imtst_preview();" class="ict_input_num_field"/>
                                </td>
                            </tr>
							<tr>
								<td><span class="imtst-strong"><?php echo __('Max No. Of Characters:', 'imtst');?></span></td>
								<td>
									<input type="number" min="0" max="" id="max_num_desc" value="<?php echo $shortcode_arr['max_num_desc'];?>" onChange="imtst_preview();" onKeyup="imtst_preview();" class="ict_input_num_field"/>	
								</td>
							</tr>
							<tr>
							<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td><span class="imtst-strong"><?php echo __('Enable Read More', 'imtst');?></span></td>
								<td>
									<input type="checkbox" id="read_more" onClick="imtst_preview();" /> 
								</td>
							</tr>
                            <tr>
                                 <td colspan="2">
                                 	<span class="warning_grey_span"><?php echo __('Is not available with filter display.', 'imtst');?></span>
                                 </td>
                            </tr>
                            <tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="imtst-strong">Order By:</span>
                                </td>
                                <td>
                                    <select id="order_by" onClick="imtst_preview();disableOtherDD( this, 'rand', '#order');" class="ict_select_field_vl">
                                            <?php $selected = imtst_checkIfSelected($shortcode_arr['order_by'], 'date', 'select');?>
                                        <option value="date" <?php echo $selected;?>><?php echo __('Date', 'imtst');?></option>
                                            <?php $selected = imtst_checkIfSelected($shortcode_arr['order_by'], 'name', 'select');?>
                                        <option value="name" <?php echo $selected;?>><?php echo __('Name', 'imtst');?></option>
										    <?php $selected = imtst_checkIfSelected($shortcode_arr['order_by'], 'last_name', 'select');?>
                                        <option value="last_name" <?php echo $selected;?>><?php echo __('Last Name', 'imtst');?></option>  
                                            <?php $selected = imtst_checkIfSelected($shortcode_arr['order_by'], 'rand', 'select');?>
                                        <option value="rand" <?php echo $selected;?>><?php echo __('Random', 'imtst');?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="imtst-strong"><?php echo __('Order Type:', 'imtst');?></span>
                                </td>
                                <td>
                                    <?php
                                        $disable = '';
                                        if($shortcode_arr['order_by']=='random') $disable = 'disabled="disabled"';
                                    ?>
                                    <select id="order" onClick="imtst_preview();" class="ict_select_field_vl" <?php echo $disable;?> >
                                            <?php $selected = imtst_checkIfSelected($shortcode_arr['order'], 'ASC', 'select');?>
                                        <option value="ASC" <?php echo $selected;?> ><?php echo __('ASC', 'imtst');?></option>
                                            <?php $selected = imtst_checkIfSelected($shortcode_arr['order'], 'DESC', 'select');?>
                                        <option value="DESC" <?php echo $selected;?> ><?php echo __('DESC', 'imtst');?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
                            </table>
				     </div>
				 <h4 style="margin-top:15px; background: rgba(240, 80, 80, 1.0);"><i class="icon-imtst-memlink"></i><?php echo __('Testimonial Link', 'imt');?></h4>
				  <div class="imtst_settings_inner">
				 <table style="width:100%">
				  <tr>
                                <td>
                                    <span class="imtst-strong"><?php echo __('Activate Inside Page', 'imtst');?></span>
                                </td>
								<td>
                                    <?php $selected = imtst_checkIfSelected($shortcode_arr['page_inside'], 1, 'checkbox');?>
                                    <input type="checkbox" <?php echo $selected;?> id="page_inside" onClick="imtst_uncheck_c(this, '#tmst_custom_href');imtst_preview();"/>
                                </td>
								
                            </tr>
                            <tr>
                                 <td colspan="2">
                                    <span class="imtst-strong"><?php echo __('Template', 'imtst');?></span>
                                
                                        <select id="inside_template" onChange="imtst_preview();" class="mddl_select_tag">
                                            <option value="default"><?php echo __('Default Template', 'imtst');?></option>
                                            <?php
                                                $templates = get_page_templates();
                                                $templates[ 'Indeed Custom Testimonials Page' ] = 'IMTST_PAGE_TEMPLATE';
                                                if(isset($templates) && count($templates)>0){
                                                     foreach($templates as $template_name => $template_page){
                                                        $template_page = str_replace('.php', '', $template_page);
                                                        $selected = imtst_checkIfSelected($shortcode_arr['inside_template'], $template_page, 'select');
                                                        ?>
                                                            <option value="<?php echo $template_page;?>" <?php echo $selected;?> ><?php echo $template_name;?></option>
                                                        <?php
                                                     }
                                                }
                                            ?>
                                        </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="warning_grey_span">( <?php echo __('If you want to use this options do not move theme files from their original location.', 'imtst');?> )</span>
                                </td>
                            </tr>
							<tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
							<tr>
                                <td>
                                    <span class="imtst-strong"><?php echo __('Activate Custom Link', 'imtst');?></span> 
                                </td>
                                <td>
                                    <?php $selected = imtst_checkIfSelected($shortcode_arr['tmst_custom_href'], 1, 'checkbox');?>
                                    <input type="checkbox" <?php echo $selected;?> id="tmst_custom_href" onClick="imtst_uncheck_c(this, '#page_inside');imtst_preview();"/>
                                </td>
                            </tr> 
                    </table>
					</div>
            </div><!--end of column one-->
            <div class="imtst_column column_two">
                  <h4 style="  background-color: rgb(231, 231, 231); color: #333;"><i class="icon-imtst-entryinfo"></i>Entry Information</h4>
				  <div class="imtst_settings_inner">
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['name'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_name" onClick="imtst_preview();"/> <?php echo __('Client Name', 'imtst');?>
                      </div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['quote'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_quote" onClick="imtst_preview();"/> <?php echo __('Quote', 'imtst');?>
                      </div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['image'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_image" onClick="imtst_preview();" /> <?php echo __('Client Image', 'imtst');?>
                      </div>
                      <div class="space_b_divs"></div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['job'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_job" onClick="imtst_preview();"/> <?php echo __('Client Job', 'imtst');?>
                      </div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['client_url'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_client_url" onClick="imtst_preview();"/> <?php echo __('Client URL', 'imtst');?>
                      </div>
                      <div class="space_b_divs"></div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['company'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_company" onClick="imtst_preview();"/> <?php echo __('Company', 'imtst');?>
                      </div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['company_url'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_company_url" onClick="imtst_preview();"/> <?php echo __('Company URL', 'imtst');?>
                      </div>
                      <div class="space_b_divs"></div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['stars'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_stars" onClick="imtst_preview();"/> <?php echo __('Stars', 'imtst');?>
                      </div>
                      <div class="space_b_divs"></div>
                      <div>
                          <?php $selected = imtst_checkIfSelected($shortcode_arr['date'], 1, 'checkbox');?>
                          <input type="checkbox" <?php echo $selected;?> id="show_date" onClick="imtst_preview();"/> <?php echo __('Date', 'imtst');?>
                      </div>
				</div>	  
            </div><!--end of column_two-->
             <div class="imtst_column column_three">
                <h4 style="  background: #1fb5ac;"><i class="icon-imtst-temp"></i>Template</h4>
				 <div class="imtst_settings_inner">
                     <table style="width:100%;">
                        <tr>
                            <td><span class="imtst-strong"><?php echo __('Select Theme', 'imtst');?></span></td>
                            <td>
                                <select id="theme" onChange="imtst_preview();" class="ict_select_field_m">
                                <?php
                                		$themes_arr = imtst_admin_get_all_themes();
                                        foreach ($themes_arr as $key=>$theme){
                                               $selected = imtst_checkIfSelected($shortcode_arr['theme'], $theme, 'select');
                                               $value = strtolower($theme) . '_' . $key;
                                               $label = ucfirst($theme) . ' ' . $key;
                                               ?>
                                               <option value="<?php echo $value;?>" <?php echo $selected;?> ><?php echo $label;?></option>
                                               <?php
                                        }
                                  ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="imtst-strong"><?php echo __('Color Scheme', 'imtst');?></span></td>
                            <td>
                            <ul id="colors_ul" class="colors_ul">
                                <?php
                                    $color_scheme = array('0a9fd8', '38cbcb', '27bebe', '0bb586', '94c523', '6a3da3', 'f1505b', 'ee3733', 'f36510', 'f8ba01');
                                    $i = 0;
                                    foreach($color_scheme as $color){
                                        if( $i==5 ) echo "<div class='clear'></div>";
                                        ?>
                                            <li class="color_scheme_item" onClick="changeColorScheme(this, '<?php echo $color;?>', '#color_scheme');imtst_preview();" style="background-color: #<?php echo $color;?>;"></li>
                                        <?php
                                        $i++;
                                    }
                                ?>
                            </ul>
                            <input type="hidden" id="color_scheme" value="<?php echo $shortcode_arr['color_scheme'];?>" />
                            <div class="clear"></div>
                            </td>
                        </tr>
						<tr>
                             <td colspan="2">
                             </td>
                        </tr>
                        <tr>
                            <td><span class="imtst-strong"><?php echo __('Columns:', 'imtst');?></span></td>
                            <td>
                                <select id="columns_num" onChange="imtst_preview();" class="ict_select_field_m">
                                    <?php
                                        for($i=1;$i<7;$i++){
                                            $selected = imtst_checkIfSelected($shortcode_arr['columns'], $i, 'select');
                                            ?>
                                                <option value='<?php echo $i;?>' <?php echo $selected;?>><?php echo $i;?> <?php echo __('columns', 'imtst');?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                             <td colspan="2">
                                <div class="spacewp_b_divs"></div>
                             </td>
                        </tr>
                    </table>
					<div>
					<input type="checkbox" onClick="check_and_h(this, '#disable_hover_effect');imtst_preview();" /> Disable Hover Effect
                     <input type="hidden" id="disable_hover_effect" value="<?php echo $shortcode_arr['disable_hover_effect'];?>" />
					</div>
                    <div style="margin-top:10px;">
                    	<input type="checkbox" id="imtst_align_center" onclick="imtst_preview();"> <?php echo __('Align the Items Centered', 'imtst');?>                      
                    </div>
				</div>	
             </div><!--end of column three-->
               <div class="imtst_column column_four">
			    <h4 style="background: #9972b5;"><i class="icon-imtst-slider"></i>Slider Showcase</h4>
			   <div class="imtst_settings_inner" style="padding-bottom:10px;">
                  <div class="imtst-selection">
                        <?php $selected = imtst_checkIfSelected($shortcode_arr['slider_set'], 1, 'checkbox');?>
                        <input type="checkbox" <?php echo $selected;?> id="slider_set" onClick="checkandModfCss(this, '#slider_options', 'opacity', 1, '0.5');imtst_preview();"/> <?php echo __('Show as Slider', 'imtst');?>
                  		<span class="warning_grey_span" style="display:block;"><?php echo __('If Slider Showcase is used, Filter Showcase is disabled.', 'imtst');?></span> 
				  </div>
                  <div style="opacity:0.5" id="slider_options" >
                      <table>
                          <tr>
                              <td><span class="imtst-strong"><?php echo __('Items per Slide:', 'imtst');?></span></td>
                              <td>
                                  <input type="number" min="1" id="items_per_slide" onChange="imtst_preview();" onKeyup="imtst_preview();" value="<?php echo $shortcode_arr['items_per_slide'];?>" class="ict_input_num_field"/>
                              </td>
                          </tr>
						  <tr>
                              <td>
                                  <span class="imtst-strong"><?php echo __('Slide TimeOut', 'imtst');?></span>
                              </td>
                              <td>
                                  <input type="number" value="<?php echo $shortcode_arr['speed'];?>" id="speed" onChange="imtst_preview();" onKeyup="imtst_preview();" class="ict_input_num_field" />
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <span class="imtst-strong"><?php echo __('Pagination Speed', 'imtst');?></span>
                              </td>
                              <td>
                                  <input type="number" value="<?php echo $shortcode_arr['pagination_speed'];?>" id="pagination_speed" onChange="imtst_preview();" onKeyup="imtst_preview();" class="ict_input_num_field"/>
                              </td>
                          </tr>
						  <tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
                          <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['bullets'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="bullets" onClick="imtst_preview();"/> <?php echo __('Bullets', 'imtst');?>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['nav_button'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="nav_button" onClick="imtst_preview();"/> <?php echo __('Nav Button', 'imtst');?>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['autoplay'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="autoplay" onClick="imtst_preview();"/> <?php echo __('Autoplay', 'imtst');?>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['stop_hover'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="stop_hover" onClick="imtst_preview();"/> <?php echo __('Stop Hover', 'imtst');?>
                              </td>
                          </tr>
                          
                          <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['responsive'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="responsive" onClick="imtst_preview();"/> <?php echo __('Responsive', 'imtst');?>
                              </td>
                          </tr>
						  <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['autoheight'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="autoheight" onClick="imtst_preview();"/> <?php echo __('Auto Height', 'imtst');?>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['lazy_load'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="lazy_load" onClick="imtst_preview();"/> <?php echo __('Lazy Load', 'imtst');?>
                              </td>
                          </tr>
						  <tr>
                              <td colspan="2">
                                  <?php $selected = imtst_checkIfSelected($shortcode_arr['loop'], 1, 'checkbox');?>
                                  <input type="checkbox" <?php echo $selected;?> id="loop" onClick="imtst_preview();"/> <?php echo __('Play in Loop', 'imtst');?>
                              </td>
                          </tr>
                          <tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
                          
                          <tr>
                              <td colspan="2">
                                  <span class="imtst-strong"><?php echo __('Pagination Theme', 'imtst');?></span>                      
                                  <select id="pagination_theme" onChange="imtst_preview();" style="min-width:162px;">
                                          <?php $selected = imtst_checkIfSelected($shortcode_arr['pagination_theme'], 'pag-theme1', 'select');?>
                                      <option value="pag-theme1" <?php echo $selected;?> ><?php echo __('Pagination Theme 1', 'imtst');?></option>
									  <?php $selected = imtst_checkIfSelected($shortcode_arr['pagination_theme'], 'pag-theme2', 'select');?>
                                      <option value="pag-theme2" <?php echo $selected;?> ><?php echo __('Pagination Theme 2', 'imtst');?></option>
									  <?php $selected = imtst_checkIfSelected($shortcode_arr['pagination_theme'], 'pag-theme3', 'select');?>
                                      <option value="pag-theme3" <?php echo $selected;?> ><?php echo __('Pagination Theme 3', 'imtst');?></option>
                                  </select>
                              </td>
                          </tr>
						  <tr>
                              <td colspan="2">
                                  <span class="imtst-strong"><?php echo __('Animation Slide In', 'imtst');?></span>
                                  <select onChange="imtst_preview();" id="animation_in" style="min-width:162px;">
									  <option value="none">None</option>
									  <option value="fadeIn">fadeIn</option>
									  <option value="fadeInDown">fadeInDown</option>
									  <option value="fadeInUp">fadeInUp</option>
									  <option value="slideInDown">slideInDown</option>
									  <option value="slideInUp">slideInUp</option>
									  <option value="flip">flip</option>
									  <option value="flipInX">flipInX</option>
									  <option value="flipInY">flipInY</option>
									  <option value="bounceIn">bounceIn</option>
									  <option value="bounceInDown">bounceInDown</option>
									  <option value="bounceInUp">bounceInUp</option>
									  <option value="rotateIn">rotateIn</option>
									  <option value="rotateInDownLeft">rotateInDownLeft</option>
									  <option value="rotateInDownRight">rotateInDownRight</option>
									  <option value="rollIn">rollIn</option>
									  <option value="zoomIn">zoomIn</option>
									  <option value="zoomInDown">zoomInDown</option>
									  <option value="zoomInUp">zoomInUp</option>
								  </select>
                              </td>
                          </tr>
						  <tr>
								<td colspan="2">
                                  <span class="imtst-strong"><?php echo __('Animation Slide out', 'imtst');?></span>
                                  <select onChange="imtst_preview();" id="animation_out" style="min-width:162px;">
									  <option value="none">None</option>
									  <option value="fadeOut">fadeOut</option>
									  <option value="fadeOutDown">fadeOutDown</option>
									  <option value="fadeOutUp">fadeOutUp</option>
									  <option value="slideOutDown">slideOutDown</option>
									  <option value="slideOutUp">slideOutUp</option>
									  <option value="flip">flip</option>
									  <option value="flipOutX">flipOutX</option>
									  <option value="flipOutY">flipOutY</option>
									  <option value="bounceOut">bounceOut</option>
									  <option value="bounceOutDown">bounceOutDown</option>
									  <option value="bounceOutUp">bounceOutUp</option>
									  <option value="rotateOut">rotateOut</option>
									  <option value="rotateOutUpLeft">rotateOutUpLeft</option>
									  <option value="rotateOutUpRight">rotateOutUpRight</option>
									  <option value="rollOut">rollOut</option>
									  <option value="zoomOut">zoomOut</option>
									  <option value="zoomOutDown">zoomOutDown</option>
									  <option value="zoomOutUp">zoomOutUp</option>
								  </select>
                              </td>
                          </tr>
                      </table>
                  </div>
				</div>  
               </div> <!--end of column four-->
               <div class="imtst_column column_five">
			    <h4 style="background: #fa8564;"><i class="icon-imtst-filter"></i>Filter Showcase</h4>
				<div class="imtst_settings_inner">
                    <div class="imtst-selection">
                        <input type="checkbox" id="filtering" onClick="filtering_set_unset(this);imtst_preview();" /> <?php echo __('Show as Filter:', 'imtst');?>
                    	<span class="warning_grey_span" style="display:block;"><?php echo __('If Filter Showcase is used, Slider Showcase is disabled.', 'imtst');?></span>
					</div>
                    <div id="filtering_options" style="opacity:0.5;">
                        <table>
							<tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
                            <tr>
                                 <td colspan="2"><span class="imtst-strong"><?php echo __('Groups:', 'imtst');?></span>
                                    <?php
                                      $args = array(
                                      		         'taxonomy' => IMTST_TAXONOMY,
                                                     'type' => IMTST_POST_TYPE,
			                                         'hide_empty' => 0,
													 'orderby' => 'slug'
                                      		       );
                                      $cats = get_categories($args);
                                      if(isset($cats) && count($cats)>0){
                                          foreach($cats as $cat){
                                              ?>
                                          		<div>
                                          			<input type="checkbox" value="<?php echo $cat->slug;?>" onClick="make_inputh_string(this, '<?php echo $cat->slug;?>', '#filter_testimonials');imtst_preview();" checked="checked"><?php echo $cat->name;?>
                                          		</div>
                                          	<?php
                                            $testimonials_arr_h[] = $cat->slug;
                                          }
                                          $str_hidden = implode(',', $testimonials_arr_h);
                                      }else{
                                          $str_hidden = '';
                                          echo __('Empty', 'imtst');
                                      }
                                      ?>
                                      <input type="hidden" value="<?php echo $str_hidden;?>" id="filter_testimonials"/>
                                </td>
                            </tr>
                            <tr>
                                 <td colspan="2">
                                    <div class="spacewp_b_divs"></div>
                                 </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                	<span class="imtst-strong" style="min-width:90px; display: inline-block;">Theme</span>
                                    <select id="filter_select_t" onChange="imtst_preview();">
                                        <option value="small_text"><?php echo __('Small Text', 'imtst');?></option>
                                        <option value="big_text"><?php echo __('Big Text', 'imtst');?></option>
                                        <option value="small_button"><?php echo __('Small Buttons', 'imtst');?></option>
                                        <option value="big_button"><?php echo __('Big Buttons', 'imtst');?></option>
                                        <option value="dropdown"><?php echo __('DropDown', 'imtst');?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="space_b_divs"></div></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="imtst-strong" style="min-width:90px; display: inline-block;">Align</span>
                                    <select id="filter_align" onChange="imtst_preview();">
                                        <option value="left"><?php echo __('Left', 'imtst');?></option>
                                        <option value="center"><?php echo __('Center', 'imtst');?></option>
                                        <option value="right"><?php echo __('Right', 'imtst');?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="space_b_divs"></div></td>
                                <td></td>
                            </tr>
                            <tr>
                            	<td colspan="2"><span class="imtst-strong" style="min-width:90px; display: inline-block;"><?php echo __('Layout Mode', 'imtst');?></span>
                            		<select id="layout_mode" onChange="imtst_preview();">
                            			<?php 
                            				$layout_modes = array('masonry', 'fitRows' );
                            				foreach ($layout_modes as $value){
                            					?>
                            					<option value="<?php echo $value;?>"><?php echo $value;?></option>
                            					<?php 
                            				}
                            			?>
                            		</select>
                            	</td>
                            </tr>                            
                        </table>
                    </div>
				 </div>	
               </div> <!--end of column five-->
             <div class="clear"></div>
        </div><!--end of display entrires -->
    </div>
</div>
    <div class="shortcode_wrapp">
        <div class="content_shortcode">
            <div>
                <span style="font-weight:bolder; color: #fff; font-style:italic; font-size:13px;"><?php echo __('ShortCode :', 'imtst');?> </span>
                <span class="the_shortcode"></span>
            </div>
            <div style="margin-top:10px;">
                <span style="font-weight:bolder; color: #fff; font-style:italic; font-size:13px;"><?php echo __('PHP Code:', 'imtst');?> </span>
                <span class="php_code"></span>
            </div>
        </div>
    </div>
<div class="imtst_preview_wrapp">
    <div class="box_title">
        <h2><i class="icon-eyes"></i><?php echo __('Preview', 'imtst');?></h2>
            <div class="actions_preview pointer">
			    <a onclick="jQuery('#preview').slideToggle();" class="btn btn-mini content-slideUp">
                    <i class="icon-angle-down"></i>
                </a>
			</div>
        <div class="clear"></div>
    </div>
    <div id="preview" class="imtst_preview"></div>
</div>
<div style="clear:both;"></div>
</div>
</div>
<script>
    dir_url = '<?php echo IMTST_DIR_URL;?>';
</script>
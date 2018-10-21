<?php
if(!isset($instance) || count($instance)==0){
    $instance = imtst_init_widget_arr();
}
?>
<script>
    var instance_no = '<?php echo $instance_no;?>';
</script>
<div class="widget_wrapp">
    <div class="border_bottom">
        <table>
            <tr>
                <td><b><?php echo __('Group:', 'imtst');?></b></td>
                        <?php
                                $args = array(
                                	'type'                     => IMTST_POST_TYPE,
                                	'child_of'                 => 0,
                                	'parent'                   => '',
                                	'orderby'                  => 'name',
                                	'order'                    => 'ASC',
                                	'hide_empty'               => 1,
                                	'hierarchical'             => 1,
                                	'exclude'                  => '',
                                	'include'                  => '',
                                	'number'                   => '',
                                	'taxonomy'                 => IMTST_TAXONOMY,
                                	'pad_counts'               => false
                                );
                                $categories = get_categories( $args );
                        ?>
                    <td>
                        <select name="<?php echo $this->get_field_name( 'group' );?>">
                                <?php $selected = imtst_checkIfSelected($instance['group'], 'all', 'select'); ?>
                                        <option value="all" <?php echo $selected;?> ><?php echo __('All', 'imtst');?></option>
                                <?php
                                if(isset($categories) && count($categories)>0){
                                    foreach($categories as $cat){
                                        $selected = imtst_checkIfSelected($instance['group'], $cat->slug, 'select');
                                        ?>
                                            <option value="<?php echo $cat->slug;?>" <?php echo $selected;?>><?php echo $cat->name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                        </select>
                    </td>
            </tr>
            <tr>
                <td>
                    <b><?php echo __('Number of items:', 'imtst');?></b>
                </td>
                <td>
                    <input type="number" value="<?php echo $instance['limit'];?>" min="0" name="<?php echo $this->get_field_name( 'limit' );?>" style="width: 50px;"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="space_b_divs"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <b><?php echo __('Order By:', 'imtst');?></b>
                </td>
                <td>
                     <select name="<?php echo $this->get_field_name( 'order_by' );?>" onChange="disableOtherDD( this, 'random', '#order_<?php echo $div_id_pre;?>')">
                            <?php $selected = imtst_checkIfSelected($instance['order_by'], 'date', 'select');?>
                        <option value="date" <?php echo $selected;?>><?php echo __('Date', 'imtst');?></option>
                            <?php $selected = imtst_checkIfSelected($instance['order_by'], 'name', 'select');?>
                        <option value="name" <?php echo $selected;?>><?php echo __('Name', 'imtst');?></option>
                            <?php $selected = imtst_checkIfSelected($instance['order_by'], 'random', 'select');?>
                        <option value="random" <?php echo $selected;?>><?php echo __('Random', 'imtst');?></option>
                    </select>
                 </td>
            </tr>
            <tr>
                <td>
                    <b><?php echo __('Order Type:', 'imtst');?></b>
                </td>
                <td>
                    <?php
                        $disable = '';
                        if($instance['order_by']=='random') $disable = 'disabled="disabled"';
                    ?>
                    <select name="<?php echo $this->get_field_name( 'order' );?>" id="order_<?php echo $div_id_pre;?>" <?php echo $disable;?>>
                            <?php $selected = imtst_checkIfSelected($instance['order'], 'ASC', 'select');?>
                        <option value="ASC" <?php echo $selected;?> ><?php echo __('ASC', 'imtst');?></option>
                            <?php $selected = imtst_checkIfSelected($instance['order'], 'DESC', 'select');?>
                        <option value="DESC" <?php echo $selected;?> ><?php echo __('DESC', 'imtst');?></option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="border_bottom"> 
    
        <table>
            <tr>
                <td><b><?php echo __('Maximum Number Of Characters:', 'imtst');?></b></td>
                <td>
                	<input type="number" min="0" max="" name="<?php echo $this->get_field_name( 'max_num_desc' );?>" value="<?php echo $instance['max_num_desc'];?>" class="ict_input_num_field"/>
                </td>
            </tr>
            <tr>
            	<td><?php echo __('Enable Read More', 'imtst');?></td>
                <td>
                    <?php
                        $checked = '';
                    	if(isset($instance['read_more']) && $instance['read_more']==1) $checked = 'checked="checked"';
                    ?>
                    <input type="checkbox" onClick="check_and_h(this, '#enable_read_more_<?php echo $div_id_pre;?>');" <?php echo $checked;?>/>
                	<input type="hidden" id="enable_read_more_<?php echo $div_id_pre;?>" name="<?php echo $this->get_field_name( 'read_more' );?>" value="<?php echo $instance['read_more'];?>" />
            	</td>
            </tr>
        </table>
        
    </div>
               
    <div class="border_bottom">
        <b><?php echo __('Custom Field To Show:', 'imtst');?> </b>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'name')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_name_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'name', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?>/> <?php echo __('Name', 'imtst');?>
            </div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'image')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_photo_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'image', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?>/> <?php echo __('Image', 'imtst');?>
            </div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'quote')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_quote_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'quote', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Quote', 'imtst');?>
            </div>
            <div class="space_b_divs"></div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'job')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_job_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'job', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Client Job', 'imtst');?>
            </div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'client_url')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_clienturl_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'client_url', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Client URL', 'imtst');?>
            </div>
            <div class="space_b_divs"></div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'company')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_company_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'company', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Company', 'imtst');?>
            </div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'company_url')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_company_url_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'company_url', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Company URL', 'imtst');?>
            </div>
            <div class="space_b_divs"></div>
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'stars')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_stars_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'stars', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Stars', 'imtst');?>
            </div>
            <div class="space_b_divs"></div>   
            <div>
                <?php
                    $selected = '';
                    if(strpos($instance['show'], 'date')!==false) $selected = "checked='checked'";
                ?>
                <input type="checkbox" id="show_date_<?php echo $div_id_pre;?>" onClick="make_inputh_string(this, 'date', '#show_cf_list_<?php echo $div_id_pre;?>');" <?php echo $selected;?> /> <?php echo __('Date', 'imtst');?>
            </div>
            <input type="hidden" value="<?php echo $instance['show'];?>" name="<?php echo $this->get_field_name( 'show' );?>" id="show_cf_list_<?php echo $div_id_pre;?>" />
    </div>
    <div class="border_bottom">
        <table>
            <tr>
                <td><b><?php echo __('Theme:', 'imtst');?></b></td>
                <td>
                    <?php
                        $handle = opendir( IMTST_DIR_PATH . 'themes' );
                        while (false !== ($entry = readdir($handle))) {
                            if( $entry!='.' && $entry!='..' ){
                                $arr_str = explode('_', $entry);
                                $themes_arr[$arr_str[1]] = $arr_str[0];
                            }
                        }
                        ksort($themes_arr);
                    ?>
                    <select id="theme_<?php echo $div_id_pre;?>" class="ict_select_field_m" name="<?php echo $this->get_field_name( 'theme' );?>" >
                    <?php
                        foreach($themes_arr as $key=>$theme){
                            $value = strtolower($theme) . '_' . $key;
                            $label = ucfirst($theme) . ' ' . $key;
                            $selected = imtst_checkIfSelected($instance['theme'], $value, 'select');
                            ?>
                            <option value="<?php echo $value;?>" <?php echo $selected;?> ><?php echo $label;?></option>
                            <?php
                        }
                    ?>
                    </select>
                </td>
            </tr>
                        <tr>
                             <td colspan="2">
                                <div class="space_b_divs"></div>
                             </td>
                        </tr>
            <tr>
                <td colspan="2"><?php echo __('Select Color Scheme', 'imtst');?>
                    <ul id="colors_ul_<?php echo $div_id_pre;?>" class="colors_ul">
                        <?php
                            $color_scheme = array('0a9fd8', '38cbcb', '27bebe', '0bb586', '94c523', '6a3da3', 'f1505b', 'ee3733', 'f36510', 'f8ba01');
                            $i = 0;
                            foreach($color_scheme as $color){
                                if( $i%5==0 ) echo "<div class='clear'></div>";
                                $class="color_scheme_item";
                                if($instance['color_scheme']==$color) $class = 'color_scheme_item-selected';
                                ?>
                                    <li class="<?php echo $class;?>" onClick="changeColorScheme_widget('#colors_ul_<?php echo $div_id_pre;?>', this, '<?php echo $color;?>', '#color_scheme_<?php echo $div_id_pre;?>');" style="background-color: #<?php echo $color;?>;"></li>
                                <?php
                                $i++;
                            }
                        ?>
                    </ul>
                    <input type="hidden" id="color_scheme_<?php echo $div_id_pre;?>" value="<?php echo $instance['color_scheme'];?>" name="<?php echo $this->get_field_name( 'color_scheme' );?>"/>
                    <div class="clear"></div>
                </td>
            </tr>
                        <tr>
                             <td colspan="2">
                                <div class="space_b_divs"></div>
                             </td>
                        </tr>
            <tr>
                        <tr>
                            <td><?php echo __('Disable Hover Effect:', 'imtst');?></td>
                            <td>
                                <?php
                                    $checked = '';
                                    if(isset($instance['disable_hover']) && $instance['disable_hover']==1) $checked = 'checked="checked"';
                                ?>
                                <input type="checkbox" onClick="check_and_h(this, '#disabled_hover_effect_<?php echo $div_id_pre;?>');" <?php echo $checked;?>/>
                                <input type="hidden" id="disabled_hover_effect_<?php echo $div_id_pre;?>" name="<?php echo $this->get_field_name( 'disable_hover' );?>" value="<?php echo $instance['disable_hover'];?>" />
                            </td>
                        </tr>
            </tr>
                        <tr>
                             <td colspan="2">
                                <div class="space_b_divs"></div>
                             </td>
                        </tr>
            <tr>
                <td><?php echo __('Number of Columns:', 'imtst');?></td>
                <td>
                    <select name="<?php echo $this->get_field_name( 'columns' );?>" >
                        <?php
                            for($i=1;$i<7;$i++){
                                $selected = imtst_checkIfSelected($instance['columns'], $i, 'select');
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
                                <div class="space_b_divs"></div>
                             </td>
                        </tr>
            <tr>
                <td>
                    <b><?php echo __('Show as Slider', 'imtst');?></b>
                </td>
                <td>
                    <?php $selected = imtst_checkIfSelected($instance['slider_set'], 1, 'checkbox');?>
                    <input type="checkbox" <?php echo $selected;?> onClick="check_and_h(this, '#slider_set_<?php echo $div_id_pre;?>');jQuery('#slider_options_<?php echo $div_id_pre;?>').toggle();" />
                    <input type="hidden" name="<?php echo $this->get_field_name( 'slider_set' );?>" value="<?php echo $instance['slider_set'];?>" id="slider_set_<?php echo $div_id_pre;?>" />
                </td>
            </tr>
       </table>
                <?php
                    $display = 'none';
                    if($instance['slider_set']==1) $display = 'block';
                ?>
            <div id="slider_options_<?php echo $div_id_pre;?>" style="display: <?php echo $display;?>">
                <table>
                        <tr>
                            <td>
                                <?php echo __('Items per Slide:', 'imtst');?>
                            </td>
                            <td>
                                <input type="number" min="1" id="items_per_slide_<?php echo $div_id_pre;?>" name="<?php echo $this->get_field_name( 'items_per_slide' );?>" value="<?php echo $instance['items_per_slide'];?>" style="width: 50px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo __('Bullets', 'imtst');?>
                            </td>
                            <td>
                                <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'bullets')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'bullets', '#slide_opt_list_<?php echo $div_id_pre;?>');" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('Nav Button', 'imtst');?>
                            </td>
                            <td>
                                <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'nav_button')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'nav_button', '#slide_opt_list_<?php echo $div_id_pre;?>');"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('Autoplay', 'imtst');?>
                            </td>
                            <td>
                                <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'autoplay')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'autoplay', '#slide_opt_list_<?php echo $div_id_pre;?>');"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('Stop Hover', 'imtst');?>
                            </td>
                            <td>
                                <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'stop_hover')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'stop_hover', '#slide_opt_list_<?php echo $div_id_pre;?>');" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('Speed', 'imtst');?>
                            </td>
                            <td>
                                <input type="number" value="<?php echo $instance['slide_speed'];?>" name="<?php echo $this->get_field_name( 'slide_speed' );?>" class="ict_input_num_field" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('Pagination Speed', 'imtst');?>
                            </td>
                            <td>
                                <input type="number" value="<?php echo $instance['slide_pagination_speed'];?>" name="<?php echo $this->get_field_name( 'slide_pagination_speed' );?>" class="ict_input_num_field"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo __('Responsive', 'imtst');?>
                            </td>
                            <td>
                                <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'responsive')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'responsive', '#slide_opt_list_<?php echo $div_id_pre;?>');"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo __('Lazy Load', 'imtst');?>
                            </td>
                            <td>
                                <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'lazy_load')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'lazy_load', '#slide_opt_list_<?php echo $div_id_pre;?>');" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('Lazy Effect', 'imtst');?>
                            </td>
                            <td>
                                  <?php
                                    $selected = '';
                                    if(strpos($instance['slide_opt'], 'lazy_effect')!==false) $selected = "checked='checked'";
                                ?>
                                <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'lazy_effect', '#slide_opt_list_<?php echo $div_id_pre;?>');" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo __('CSS3 Transition', 'imtst');?>
                            </td>
                            <td>
                                <select name="<?php echo $this->get_field_name( 'slide_css_transition' );?>">
                                        <?php $selected = imtst_checkIfSelected($instance['slide_css_transition'], 'none', 'select');?>
                                    <option value="none" <?php echo $selected;?> ><?php echo __('None', 'imtst');?></option>
                                        <?php $selected = imtst_checkIfSelected($instance['slide_css_transition'], 'fade', 'select');?>
                                    <option value="fade" <?php echo $selected;?> ><?php echo __('fade', 'imtst');?></option>
                                        <?php $selected = imtst_checkIfSelected($instance['slide_css_transition'], 'backSlide', 'select');?>
                                    <option value="backSlide" <?php echo $selected;?> ><?php echo __('backSlide', 'imtst');?></option>
                                        <?php $selected = imtst_checkIfSelected($instance['slide_css_transition'], 'goDown', 'select');?>
                                    <option value="goDown" <?php echo $selected;?> ><?php echo __('goDown', 'imtst');?></option>
                                        <?php $selected = imtst_checkIfSelected($instance['slide_css_transition'], 'fadeUp', 'select');?>
                                    <option value="fadeUp" <?php echo $selected;?> ><?php echo __('fadeUp', 'imtst');?></option>
                                </select>
                            </td>
                        </tr>
                </table>
                <input type="hidden" value="<?php echo $instance['slide_opt'];?>" name="<?php echo $this->get_field_name( 'slide_opt' );?>" id="slide_opt_list_<?php echo $div_id_pre;?>" />
            </div>
    </div>
    <div>
            <div>
                <?php $selected = imtst_checkIfSelected($instance['page_inside'], 1, 'checkbox');?>
                <input type="checkbox" <?php echo $selected;?> onClick="check_and_h(this, '#show_inside_page_<?php echo $div_id_pre;?>')" /> <b>Show Inside Page</b>
                <input type="hidden" value="<?php echo $instance['page_inside'];?>" name="<?php echo $this->get_field_name( 'page_inside' );?>" id="show_inside_page_<?php echo $div_id_pre;?>" />
            </div>
            <div>
                <b>Template</b>
                <select name="<?php echo $this->get_field_name( 'inside_template' );?>" style="max-width: 215px;">
                	
                    <option value="default"><?php echo __('Default Template', 'imtst');?></option>
                    <?php
                        $templates = get_page_templates();
                        $templates[ 'Indeed Custom Testimonials Page' ] = 'IMTST_PAGE_TEMPLATE';
                        if(isset($templates) && count($templates)>0){
                             foreach($templates as $template_name => $template_page){
                                $template_page = str_replace('.php', '', $template_page);
                                $selected = imtst_checkIfSelected($instance['inside_template'], $template_name, 'select');
                                ?>
                                    <option value="<?php echo $template_page;?>" <?php echo $selected;?> ><?php echo $template_name;?></option>
                                <?php
                             }
                        }
                    ?>
                </select>
            </div>
            <div>
                <span class="warning_grey_span">( <?php echo __('If you want to use this options do not move theme files from their original location.', 'imtst');?> )</span>
            </div>
    </div>
</div>
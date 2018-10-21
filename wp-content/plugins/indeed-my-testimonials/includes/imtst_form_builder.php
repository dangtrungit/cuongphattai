<script>
    var dir_url = '<?php echo IMTST_DIR_URL;?>';
    jQuery(document).ready(function(){
        imtst_preview_form();
    });
</script>
<div  class="ictst_wrap">
    <h1>Form Builder</h1>
     <div class="imtst_settings_wrapper">
        <div class="box-title">
            <h3><i class="icon-cogs"></i><?php echo __('Settings', 'imtst');?></h3>
            <div class="actions pointer">
			    <a onclick="jQuery('#the_formb_settings').slideToggle();" class="btn btn-mini content-slideUp">
                    <i class="icon-angle-down"></i>
                </a>
			</div>
            <div class="clear"></div>
        </div>
     </div>
     <div id="the_formb_settings" class="the_formb_settings">
	      <div style="margin-bottom: 15px;">
	     	  <b>
	     	  	<?php echo __('Destination Grup:', 'imtst');?>
	     	  </b>
              <select id="group" onClick="imtst_preview_form();" class="ict_select_field_vl" style=" width: 338px;">
              	  <option value="-1">...</option>
	               <?php
                	$args = array(
                    		      'taxonomy' => IMTST_TAXONOMY,
                                  'type' => IMTST_POST_TYPE,
								   'hide_empty' => 0
                                 );
                    $cats = get_categories($args);
					if (isset($cats) && count($cats)>0){
                    	foreach ($cats as $cat){
                    		?>                   	
                           		<option value="<?php echo $cat->slug;?>" ><?php echo $cat->name;?></option>
                        	<?php 
                        }
					}
                    ?>
              </select>
	      </div>
	               
          <table>
                <tr class="imtst-table-header">
                    <td>
                        <b><?php echo __('Show', 'imtst');?></b>
                    </td>
                    <td>
                        <b><?php echo __('Option Name', 'imtst');?></b>
                    </td>
                    <td>
                        <b><?php echo __('Label', 'imtst');?></b>
                    </td>
                    <td>
                        <b><?php echo __('Required', 'imtst');?></b>
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_name" onClick="imtst_preview_form();"  checked />
                    </td>
                    <td style="font-weight:bold;">
                        <?php echo __('Client Name', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Name', 'imtst');?>" id="client_name_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_name_req" onClick="imtst_preview_form();" checked/>
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_image" onClick="imtst_preview_form();" />
                    </td>
                    <td style="font-weight:bold;">
                        <?php echo __('Client Image', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Image', 'imtst');?>" id="client_image_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_image_req" onClick="imtst_preview_form();" />
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_job" onClick="imtst_preview_form();"  checked />
                    </td>
                    <td style="font-weight:bold;">
                        <?php echo __('Client Job', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Position', 'imtst');?>" id="client_job_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_job_req" onClick="imtst_preview_form();" checked/>
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_url" onClick="imtst_preview_form();" />
                    </td>
                    <td style="font-weight:bold;">
                         <?php echo __('Client URL', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="URL" id="client_url_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="client_url_req" onClick="imtst_preview_form();" />
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="company" onClick="imtst_preview_form();"  checked />
                    </td>
                    <td style="font-weight:bold;">
                         <?php echo __('Company', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Company', 'imtst');?>" id="company_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="company_req" onClick="imtst_preview_form();" />
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="company_url" onClick="imtst_preview_form();" />
                    </td>
                    <td style="font-weight:bold;">
                         <?php echo __('Company URL', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Company URL', 'imtst');?>" id="company_url_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="company_url_req" onClick="imtst_preview_form();" />
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="quote" onClick="imtst_preview_form();"  checked />
                    </td>
                    <td style="font-weight:bold;">
                         <?php echo __('Quote', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Testimonial', 'imtst');?>" id="quote_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="quote_req" onClick="imtst_preview_form();" checked />
                    </td>
                </tr>
                <tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="rating" onClick="imtst_preview_form();"  checked />
                    </td>
                    <td style="font-weight:bold;">
                         <?php echo __('Rating', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('Rating', 'imtst');?>" id="rating_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="rating_req" onClick="imtst_preview_form();" />
                    </td>
                </tr>
                    <td class="imtst_td_align">
                        <input type="checkbox" id="capcha" onClick="imtst_preview_form();" />
                    </td>                
                    <td style="font-weight:bold;">
                    	<?php echo __('Capcha', 'imtst');?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo __('CapCha', 'imtst');?>" id="capcha_label" class='imtst_input' onKeyUp="imtst_preview_form();" />
                    </td>
                <tr>
                </tr>             
                <tr>
                    <td></td>
                    <td valign="top" style="font-weight:bold;"><?php echo __('Success message', 'imtst');?></td>
                    <td>
                        <textarea id="s_msg" class='imtst_input' onKeyUp="imtst_preview_form();"><?php echo __('Thank you for your submitted testimonial!', 'imtst');?></textarea>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td valign="top"  style="font-weight:bold;"><?php echo __('Error message', 'imtst');?></td>
                    <td>
                        <textarea id="err_msg" class='imtst_input' onKeyUp="imtst_preview_form();" ><?php echo __('An Error has Occurred. Please Try Again and complete all the required fields!', 'imtst');?></textarea>
                    </td>
                    <td></td>
                </tr>
          </table>
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
</div>
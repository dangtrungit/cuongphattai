<?php 
	if(isset($_REQUEST['imtst_submit'])) imtst_save_update_metas();
	$metas = imtst_general_settings_meta();
?>
<div class="ictst_wrap">
	    <div class="">
	        <h3>
	        	<i class="icon-cogs"></i><?php echo __('General Settings', 'imtst');?>
	        </h3>
	    </div>

	<form method="post" action="">	    
		<div class="stuffbox">
                    <h3 style="background-color: rgb(66, 66, 66) !important;">
                        <label><?php echo __('Responsive Settings', 'imtst');?></label>
                    </h3>
                    <div class="inside">
                        <table class="form-table indeed_admin_table">
        	                <tbody>
                                <tr>
									<td><?php echo __('Screen Max-Width:', 'imtst');?> <b>479px</b></td>
									<td>
										<select name="imtst_responsive_settings_small">
											<?php 
												for($i=1;$i<7;$i++){
													$selected = '';
													if($metas['imtst_responsive_settings_small']==$i) $selected = 'selected="selected"';
													?>
														<option value="<?php echo $i;?>" <?php echo $selected;?> ><?php echo $i.' '.__('Columns', 'imtst');?></option>
													<?php 
												}
												$selected = '';
												if($metas['imtst_responsive_settings_small']=='auto') $selected = 'selected="selected"';
												?>
													<option value="auto" <?php echo $selected;?> ><?php echo __('Auto', 'imtst');?></option>
												<?php 
											?>
										</select>
									</td>
                                </tr>
                                <tr>
									<td><?php echo __('Screen Min-Width:', 'imtst');?> <b>480px</b> <?php echo __('and Screen Max-Width:', 'imtst');?> <b>767px</b></td>
									<td>
										<select name="imtst_responsive_settings_medium">
											<?php 
												for($i=1;$i<7;$i++){
													$selected = '';
													if($metas['imtst_responsive_settings_medium']==$i) $selected = 'selected="selected"';													
													?>
														<option value="<?php echo $i;?>" <?php echo $selected;?> ><?php echo $i.' '.__('Columns', 'imtst');?></option>
													<?php 
												}
												$selected = '';
												if($metas['imtst_responsive_settings_medium']=='auto') $selected = 'selected="selected"';
												?>
													<option value="auto" <?php echo $selected;?> ><?php echo __('Auto', 'imtst');?></option>
												<?php 
											?>
										</select>
									</td>
                                </tr>
                                <tr>
									<td><?php echo __('Screen Min-Width:', 'imtst');?> <b>768px</b> <?php echo __('and Screen Max-Width:', 'imtst');?> <b>959px</b></td>
									<td>
										<select name="imtst_responsive_settings_large">
											<?php 
												for($i=1;$i<7;$i++){
													$selected = '';
													if($metas['imtst_responsive_settings_large']==$i) $selected = 'selected="selected"';													
													?>
														<option value="<?php echo $i;?>" <?php echo $selected;?> ><?php echo $i.' '.__('Columns', 'imtst');?></option>
													<?php 
												}
												$selected = '';
												if($metas['imtst_responsive_settings_large']=='auto') $selected = 'selected="selected"';
												?>
													<option value="auto" <?php echo $selected;?> ><?php echo __('Auto', 'imtst');?></option>
												<?php 
											?>
										</select>
									</td>
                                </tr>                                
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                        </div>
                    </div>
		</div>
		<div class="stuffbox">
                    <h3 style="background: #1fb5ac !important;">
                        <label><?php echo __('Inside Page', 'imtst');?></label>
                    </h3>
                    <div class="inside">
                        <table class="form-table indeed_admin_table">
        	                <tbody>
                                <tr>
									<td><?php echo __('Entry Information', 'imtst');?>:</td>
                                </tr>
                                <tr>
									<td>
				                      <div>
				                          <?php
				                          		$infos = explode(',', $metas['imtst_custom_page_entry_infos']);
				                          		$selected = '';
				                          		if(in_array('name', $infos)) $selected = 'checked="checked"';	
				                          ?>
				                          <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'name', '#imtst_custom_page_entry_infos');"/> <?php echo __('Client Name', 'imtst');?>
				                      </div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('quote', $infos)) $selected = 'checked="checked"';				                        
				                          ?>
				                          <input type="checkbox" <?php echo $selected;?> onClick="make_inputh_string(this, 'quote', '#imtst_custom_page_entry_infos');"/> <?php echo __('Quote', 'imtst');?>
				                      </div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('image', $infos)) $selected = 'checked="checked"';				                        
				                          ?>
				                          <input type="checkbox" <?php echo $selected;?> id="show_image" onClick="make_inputh_string(this, 'image', '#imtst_custom_page_entry_infos');" /> <?php echo __('Client Image', 'imtst');?>
				                      </div>
				                      <div class="space_b_divs"></div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('job', $infos)) $selected = 'checked="checked"';				                        
				                          ?>
				                          <input type="checkbox" <?php echo $selected;?> id="show_job" onClick="make_inputh_string(this, 'job', '#imtst_custom_page_entry_infos');"/> <?php echo __('Client Job', 'imtst');?>
				                      </div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('client_url', $infos)) $selected = 'checked="checked"';				                        
				                          ?>				                      
				                          <input type="checkbox" <?php echo $selected;?> id="show_client_url" onClick="make_inputh_string(this, 'client_url', '#imtst_custom_page_entry_infos');"/> <?php echo __('Client URL', 'imtst');?>
				                      </div>
				                      <div class="space_b_divs"></div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('company', $infos)) $selected = 'checked="checked"';				                        
				                          ?>	
				                          <input type="checkbox" <?php echo $selected;?> id="show_company" onClick="make_inputh_string(this, 'company', '#imtst_custom_page_entry_infos');" /> <?php echo __('Company', 'imtst');?>
				                      </div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('company_url', $infos)) $selected = 'checked="checked"';				                        
				                          ?>					       
				                          <input type="checkbox" <?php echo $selected;?> id="show_company_url" onClick="make_inputh_string(this, 'company_url', '#imtst_custom_page_entry_infos');"/> <?php echo __('Company URL', 'imtst');?>
				                      </div>
				                      <div class="space_b_divs"></div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('stars', $infos)) $selected = 'checked="checked"';				                        
				                          ?>				                         
				                          <input type="checkbox" <?php echo $selected;?> id="show_stars" onClick="make_inputh_string(this, 'stars', '#imtst_custom_page_entry_infos');"/> <?php echo __('Stars', 'imtst');?>
				                      </div>
				                      <div class="space_b_divs"></div>
				                      <div>
				                          <?php
				                          		$selected = '';
				                          		if(in_array('date', $infos)) $selected = 'checked="checked"';				                        
				                          ?>						                    
				                          <input type="checkbox" <?php echo $selected;?> id="show_date" onClick="make_inputh_string(this, 'date', '#imtst_custom_page_entry_infos');"/> <?php echo __('Date', 'imtst');?>
				                      </div>
				                      <input type="hidden" value="<?php echo $metas['imtst_custom_page_entry_infos'];?>" id="imtst_custom_page_entry_infos" name="imtst_custom_page_entry_infos" />
									</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                        </div>
                    </div>
		</div>
		<div class="stuffbox">
               <h3 style="background-color: #d9534f !important;">
               		<label><?php echo __('Custom CSS', 'imtst');?></label>
               </h3>
               <div class="inside">
			   <div style="margin-left: 10px;"><b><?php echo __('Add   !important;  after each style option and full style path to be sure that it will take effect!', 'imtst');?></b></div>
                        <table class="form-table indeed_admin_table">
                        	<tr>
                        		<td>
                        			<textarea name="imtst_custom_css" style="min-width: 500px;min-height: 100px;"><?php echo stripslashes($metas['imtst_custom_css']);?></textarea>
                        		</td>
                        	</tr>
                        </table>
                    <div class="submit">
                    	<input type="submit" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                    </div>           
               </div>     
        </div>
		<div class="stuffbox">
        	<h3 style="background-color: rgb(0, 175, 209) !important;">
            	<label><?php echo __('External Links', 'imt');?></label>
            </h3>
            <div class="inside">
            	<div>
                    <input type="checkbox" onClick="check_and_h(this, '#imtst_target_blank');" <?php if ($metas['imtst_target_blank']) echo 'checked';?>/>
                    <input type="hidden" value="<?php echo $metas['imtst_target_blank'];?>" name="imtst_target_blank" id="imtst_target_blank" />	            		
            		<?php echo __("Open 'Inside Page' & 'Custom Link' in new Window", 'imtst');?>
            	</div>
                <div class="submit">
                	<input type="submit" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                </div>            	
            </div>
        </div>
		<div class="stuffbox">
               <h3 style="background-color: rgb(231, 231, 231) !important;color: #333;">
               		<label><?php echo __('Rich Snippets', 'imtst');?></label>
               </h3>
               <div class="inside">
				     <div>
				     	<?php
				        	$selected = '';
				        	if(isset($metas['imtst_rich_snippets']) && $metas['imtst_rich_snippets']==1) $selected = 'checked="checked"';				                        
				        ?>						                    
				        <input type="checkbox" <?php echo $selected;?> onClick="check_and_h(this, '#imtst_rich_snippets');"/> <?php echo __('Show Rich Snippets Reviews on Google results', 'imtst');?>
				    </div>
				    <input type="hidden" value="<?php echo $metas['imtst_rich_snippets'];?>" id="imtst_rich_snippets" name="imtst_rich_snippets" />               		               
               		<div class="submit">
                    	<input type="submit" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                    </div>        
               </div>
       </div>  
       <div class="stuffbox">
               <h3 style="background: #FDB45C !important;">
               		<label><?php echo __('Default Client Image', 'imtst');?></label>
               </h3>   
               <div class="inside">   
               		<?php 
               			//preview default client image
               			if (isset($metas['default_client_img']) && $metas['default_client_img']){
               				?>
               					<div>
               						<img src="<?php echo $metas['default_client_img'];?>" class="imtst-default-client-img-admin" id="imtst-default-client-img-admin" />
               					</div>               					
               				<?php 
               			} 
               		?> 
               		<input type="text" onClick="open_media_up(this, '#imtst-default-client-img-admin');" name="default_client_img" value="<?php echo $metas['default_client_img'];?>" style="width: 500px;"/>  
               		<div class="submit">
                    	<input type="submit" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                    </div>        
               </div>         		
       </div>      
	</form>
		<div class="stuffbox">
                    <h3 style="background: #9972b5 !important;">
                        <label><?php echo __('Post Type', 'imtst');?></label>
                    </h3>
                    <div class="inside">
                        <table class="form-table indeed_admin_table">
        	                <tbody>
                                <tr>
									<td>
										<?php echo __('Name', 'imtst');?>: 
									</td>
                                    <td>
										<input type="text" value="<?php echo IMTST_POST_TYPE;?>" id="imtst_post_type_name" style="min-width: 300px;"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="margin-left: 10px;"><b><?php echo __('If You change the Post Type, the current Testimonials will not be available anymore!', 'imtst');?></b></div>
                        <div class="submit">
                            <input type="button" onClick="imtst_change_post_type_name('<?php echo get_site_url();?>');" value="<?php echo __('Save changes', 'imtst');?>" name="imtst_submit" class="button button-primary button-large" />
                        </div>
                    </div>
		</div>	
</div>

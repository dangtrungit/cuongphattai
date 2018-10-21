<?php
$dir_path = plugin_dir_path (__FILE__);
$style="<style>".file_get_contents( $dir_path.'style.css')."
</style>";
$list_item_template = '
<div class="testi-wrapper">
	<div class="quotes #SHOW_QUOTE">
		<a #IMTST_POST_LINK#>IMTST_QUOTE</a>
	</div>
	<div class="testi-details">
		<div class="clinet-img  #SHOW_IMG">
			<a #IMTST_POST_LINK#>
 				<img title="IMTST_NAME" src="IMTST_IMAGE" alt=""/>
 			</a>
		</div>
		<div class="testi-text">
			 <div class="row">
				<span class="testi-name">IMTST_NAME</span><span class="#SHOW_JOB" style="display:none;">,</span> 
				<span class="testi-job">#IMTST_CLIENT_URL IMTST_CLIENT_JOB #IMTST_CLIENT_END_URL</span>
				<span class="#SHOW_COMP" style="display:none;">,</span>
				<span class="testi-company">#COMPANY_URL IMTST_COMPANY #COMPANY_END_URL</span>
			</div>
			<div class="row">
			  <span class="stars">IMTST_STARS</span> <span class="date"><span class="#SHOW_DATE" style="display:none;">|</span> IMTST_DATE</span>
			</div>
		</div>
	</div>
</div>
';
?>
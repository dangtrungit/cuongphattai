
<?php global $redux_builder_amp;
amp_header() ?>
<div class="cntr archive">
	<div class="arch-tlt">
		<?php 
			ob_start();
			amp_archive_title(); 
			$archive_title = ob_get_contents();
			ob_end_clean();
			echo trim(str_replace("Category:", "" , $archive_title));


			amp_breadcrumb();
		?>

	</div>
	<div class="arch-dsgn">
		<div class="arch-psts">
			<?php amp_loop_template(); ?>
			<?php echo get_paginate_links(); ?>
		</div>
		<?php 

		if(isset($redux_builder_amp['gbl-sidebar']) && $redux_builder_amp['gbl-sidebar'] == '1'){ ?>
		<div class="sdbr-right">
			<?php 
				ob_start();
				dynamic_sidebar('swift-sidebar');
				$swift_footer_widget = ob_get_contents();
				ob_end_clean();
				$sanitizer_obj = new AMPFORWP_Content( 
									$swift_footer_widget,
									array(), 
									apply_filters( 'ampforwp_content_sanitizers', 
										array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), 
										) 
									) 
								);
				$sanitized_footer_widget =  $sanitizer_obj->get_amp_content();
	            echo $sanitized_footer_widget;
			?>
		</div>
		<?php } ?>
	</div>
</div>

<?php 
	ob_start();
	include("sidebar/sidebar1.php");
	// dynamic_sidebar( 'sidebar-1' );
	$sidebar = ob_get_contents();
	ob_end_clean();
	$sanitizer_obj = new AMPFORWP_Content( 
						$sidebar,
						array(), 
						apply_filters( 'ampforwp_content_sanitizers', 
							array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), 
							) 
						) 
					);
	$sanitized_sidebar =  $sanitizer_obj->get_amp_content();
    
    echo '<div id="secondary" class="widget-area" role="complementary">';
    echo str_replace('class="search-form"', 'class="search-form" target="_top"', $sanitized_sidebar);
    echo '</div>';
 ?>

<?php amp_footer()?>
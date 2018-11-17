<div class="siderbar" id="secondary">
	<div id="search-2" class="widget widget_search clr">
		<span class="label-widget">Tìm kiếm:</span>
		<form role="search" method="get" class="search-form" action="<?php echo get_home_url(); ?>">
			<label>
				<span class="screen-reader-text">Tìm kiếm cho:</span>
				<input type="search" class="search-field" placeholder="Tìm kiếm …" value="" name="s">
			</label>
			<input type="submit" class="search-submit" value="Tìm kiếm">
		</form>
	</div>

	<div class="menu-widget widget">
		<?php echo do_shortcode( '[pokamodule com="pokamodule-shortcode" task="show-category"]' ); ?>
	</div>


	<div class="r-pf recent-post widget">
		<div class="cntr">
			<h3 class="label-widget">Bài viết mới nhất</h3>
		<?php while( amp_loop('start', array( 'posts_per_page' => 6 ) ) ): ?>
			<div class="fsp">
				<?php if( ampforwp_has_post_thumbnail() ){
					$width 	= 346;
					$height = 188;
					if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
						$width 	= $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
						$height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
					}
					$args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
				    <div class="fsp-img">
				    	<?php amp_loop_image($args); ?>
				    </div>
			    <?php } ?>
			    <div class="fsp-cnt">
				    <?php amp_loop_title(); ?>
			    </div>
			</div>
		<?php endwhile; amp_loop('end');  ?>
		</div>
	</div>
</div>
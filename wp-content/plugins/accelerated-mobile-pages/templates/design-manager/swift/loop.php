<?php global $redux_builder_amp; 
$width  = 346;
$height = 188;
if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
    $width  = $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
    $height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
} ?>
<?php while(amp_loop('start')):
    global $post;
 ?>
<article class="fsp post post-<?php echo $post->ID; ?>" id="post-<?php echo $post->ID; ?>">
    <header class="entry-header">
        <?php amp_loop_title(); ?>
        
        <div class="poka-date">
        <?php amp_post_date(); ?>
        </div>
    </header>

	<?php if(ampforwp_has_post_thumbnail()){ $args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
    <div class="fsp-img">
    	<?php amp_loop_image($args); ?>
    </div><?php } ?>
    <div class="fsp-cnt">
	    <?php if( ampforwp_check_excerpt() ) { amp_loop_excerpt(50); } ?>
    </div>

    <?php echo amp_read_more(); ?>
</article>
<?php endwhile; amp_loop('end');  ?>
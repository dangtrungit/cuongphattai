<?php 
/**
 * Template Name: Indeed My Testimonials
 */
get_header(); 
$str = imtst_return_infos_str_for_template();//str is an array with all info, check functions.php
?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="imtst_inside_page">
				<div class="imtst_item_img">
				<img src="<?php echo $str['image'][0];?>"/>
				</div>
				<div class="imtst_item_details">
					<div class="imtst_name"><?php echo $str['name'];?></div>
					<div class="imtst_job"><a href="<?php echo $str['client_url'];?>"><?php echo $str['job'];?></a></div>
					<div class="imtst_company"><a href="<?php echo $str['company_url'];?>"><?php echo $str['company'];?></a></div>
					<div class="imtst_date"><?php echo $str['date'];?></div>
					<div class="imtst_stars"><?php echo imtst_return_stars($str['rating']);?></div>
				</div>
				<div class="imtst_clear"></div>
				<div class="imtst_quote"><?php echo $str['quote'];?></div>
				<?php 
					#RICH SNIPPETS
					$data = imtst_general_settings_meta();
					if(isset($data['imtst_rich_snippets']) && $data['imtst_rich_snippets']==1){
						global $post;
						$rich_arr = array(
								'title' => $str['name'],
								'post_author' => get_the_author_meta( 'user_nicename', $post->post_author ),
								'publish_date' => $str['date'],
								'rating' => $str['rating'],
								'description' => $str['quote'],
						);
						echo imtst_return_google_rich_snippets($rich_arr,'single');						
					}
				?>		
				<div class="imtst_clear"></div>				
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
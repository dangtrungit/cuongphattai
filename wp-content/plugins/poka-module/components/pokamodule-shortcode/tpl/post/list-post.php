<?php
	$html = '';
	$sThumbnail = $size_thumbnail;
	
	$arrThum = array(
		'thumbnail',
        'medium',
        'large',
        'full'
    );
	
	if(!in_array($sThumbnail, $arrThum)){
		$sThumbnail = array($size_thumbnail);
    }
    
    echo "<pre style='color: red; font-size: 16px'>";
        print_r($sThumbnail);
    echo "</pre>";
	
	
	$aArgs      = array();
	switch($post_category){
		//Bai Lien Quan
		case "related":
			global $post;
			
			$categories = get_the_category($post->ID);
			if ($categories){
				$category_ids = array();
				foreach($categories as $individual_category){
					$category_ids[] = $individual_category->term_id;
				}
				$aArgs = array(
					'category__in'     => $category_ids,
					'post__not_in'     => array($post->ID),
					'posts_per_page'   => $post_limit,
					'ignore_sticky_posts' => true
				);
			}
			break;
		//Tat Ca
		case "all":
			$aArgs = array(
				'posts_per_page'      => $post_limit,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			);
			
			//Theo id
			if(!empty($post_ids)){
				$aArgs["post__in"] = explode(",", trim($post_ids));
			}
			
			break;
		default:
			$aArgs = array(
				'posts_per_page'      => $post_limit,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			);
			
			if(!empty($post_category)){
				$aArgs["category__in"] = $post_category;
			}
			break;
	}
	
	$wpQuery = new WP_Query($aArgs);
	
	if($wpQuery->have_posts()){
		$html .= '<ul class="list-post">';
		while($wpQuery->have_posts()) :
			$wpQuery->the_post();
			
			$html .= '<li class="item-post">';
			if($show_thumbnail){
				$htmlThumbnail = '<div class="post-image">
                                    <a href="' . get_permalink() . '">'.get_the_post_thumbnail(get_the_ID(), $sThumbnail).'</a>
                                  </div>';
			}else{
				$htmlThumbnail = '';
			}
			
			$html .= $htmlThumbnail . '<div class="post-title"><a class="title" href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
			
			if($show_date){
				$html .= '<div class="post-date">' . get_the_date() . '</div>';
			}
			
			if($show_author){
				$html .= '<div class="post-author">' . get_the_author() . '</div>';
			}
			
			if($show_category){
				$html .= '<div class="post-category">';
				foreach((get_the_category()) as $category) {
					$html .=  '<a href="'.esc_url(get_category_link( $category->cat_ID)).'">'.$category->cat_name.'</a> ';
				}
				$html .= '</div>';
			}
			
			if($show_descrition){
				if(empty( $number_descrition)){
					$number_descrition = 150;
				}
				
				$descrition = wp_strip_all_tags(get_the_content());
				$descrition = mb_substr($descrition, 0, $number_descrition);
				
				if($show_dots){
					$descrition .= '...';
				}
				
				$html .= '<div class="post-descrition">' . $descrition . '</div>';
			}
			
			if($view_more){
				$html .= '<div class="view-more"><a href="' . get_permalink() . '">Xem Thêm</a></div>';
			}
			$html .= '</li>';
		endwhile;
		
		$html .= '</ul>';
		
		wp_reset_postdata();
	}
	
	wp_reset_query();
?>

<div class='poka-list-post <?php echo $class; ?>'>
	<?php
		echo $html;
	?>
</div>

<?php 
	$featured       = wp_get_attachment_url( $product->get_image_id() );
	$carousel       = !empty( $featured ) ? 
						'<amp-img src="'. $featured .'"
					      width="400"
					      height="300"
					      layout="responsive"
					      alt="'. $product_name .'"></amp-img>' 
					     : "";
	$featured_thumb =  wp_get_attachment_image_src( $product->get_image_id() , "thumbnail")[0];				     
	$carousel_pre   = !empty( $featured_thumb ) ? 
						'<span role="tab" tabindex="0" on="tap:carousel-with-preview.goToSlide(index=0)">
						<amp-img src="'. $featured_thumb .'"
					      width="75"
					      height="75"
					      layout="responsive"
					      alt="'. $product_name .'"></amp-img></span>' 
					     : "";


	$attachment_ids = $product->get_gallery_attachment_ids();
    foreach( $attachment_ids as $key => $attachment_id ) {
        $image_link     = wp_get_attachment_url( $attachment_id );
        $carousel      .= '<amp-img src="'. $image_link .'"
					    width="400"
					    height="300"
					    layout="responsive"
					    alt="'. $product_name .'"></amp-img>';

		$thumb_link     =  wp_get_attachment_image_src( $attachment_id , "thumbnail")[0];	
		$carousel_pre  .= '<span role="tab" tabindex="'. ($key+1) .'" on="tap:carousel-with-preview.goToSlide(index='. ($key+1) .')">
						<amp-img src="'. $thumb_link .'"
					    	width="75"
					    	height="75"
					    	layout="responsive"
					    	alt="'. $product_name .'"></amp-img></span>';
    }

if ( empty($featured) && empty($attachment_ids) ) return;
 ?>

<amp-carousel id="carousel-with-preview"
width="400"
height="300"
layout="responsive"
type="slides">
<?php echo $carousel; ?>
</amp-carousel>
<div class="carousel-preview">
	<?php echo $carousel_pre; ?>
</div>
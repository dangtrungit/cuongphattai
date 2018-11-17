<?php 
	global $product;
	$id           = $product->get_id();
	$product_name = $product->get_name();
 ?>

<?php amp_header(); ?>

<div class="sp sgl">
	<div class="cntr">
		<?php amp_breadcrumb(); ?>
	</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="product-gallery">
				<?php include("widgets/single-product/single-product-carousel.php"); ?>
			</div>
		</main>

        <?php
            $flag = false;
	        $vSale = $product->get_sale_price();
	
	        
            $vClass = '';
	        if(!empty($vSale)){
		        $flag = true;
		        $vClass = 'not-sale';
            }
        ?>
		<div class="summary entry-summary poka-center">
			<h1 class="product_title entry-title"><?php echo $product_name; ?></h1>
			<p class="price <?php echo $vClass; ?>"><span class="woocommerce-Price-amount amount"><?php echo wc_price($product->get_regular_price()); ?></span></p>
            <?php
                if($flag == true) :
            ?>
			    <p class="price"><span class="woocommerce-Price-amount amount"><?php echo wc_price($product->get_sale_price()); ?></span></p>
            <?php
                endif;
            ?>

			<form class="cart" action="<?php echo amp_loop_permalink(true); ?>" target="_top" method="get" enctype="multipart/form-data">
				<div class="quantity">
					<label class="screen-reader-text" for="quantity">Số lượng</label>
					<input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="SL" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="">
				</div>
			
				<button type="submit" name="add-to-cart" value="<?php echo $id; ?>" class="single_add_to_cart_button button alt">Thêm vào giỏ</button>
			</form>
		</div>

		<?php 
			/*ob_start();
			include("widgets/single-product/short-description.php");
			$short_description = ob_get_contents();
			ob_end_clean();
			$sanitizer_obj = new AMPFORWP_Content(
								$short_description,
								array(),
								apply_filters( 'ampforwp_content_sanitizers',
									array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(),
									)
								)
							);
			$sanitized_short_description =  $sanitizer_obj->get_amp_content();
            echo $sanitized_short_description;*/
            

			ob_start();
			include("widgets/single-product/descriptions.php"); 
			$descriptions = ob_get_contents();
			ob_end_clean();
			$sanitizer_obj = new AMPFORWP_Content( 
								$descriptions,
								array(), 
								apply_filters( 'ampforwp_content_sanitizers', 
									array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), 
									) 
								) 
							);
			$sanitized_descriptions =  $sanitizer_obj->get_amp_content();
            echo $sanitized_descriptions;


           	ob_start();
			echo do_shortcode( '[related_products limit="3"]' );
			$related = ob_get_contents();
			ob_end_clean();
			$sanitizer_obj = new AMPFORWP_Content(
								$related,
								array(),
								apply_filters( 'ampforwp_content_sanitizers',
									array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(),
									)
								)
							);
			$sanitized_related =  $sanitizer_obj->get_amp_content();
			
			//===========================================================================
			$vIn = '{<div class="carousel_view".*">}';
			$vOut = '<amp-carousel id="poka-amp-testimonials" height="460" layout="fixed-height" type="slides" autoplay delay="3000" controls loop data-next-button-aria-label="Go to next slide" data-previous-button-aria-label="Go to previous slide">';
			$sanitized_related = preg_replace($vIn, $vOut, $sanitized_related);
   
			$vIn = '{</ul>.*</div>}';
			$vOut = '</ul></amp-carousel>';
			$sanitized_related = preg_replace($vIn, $vOut, $sanitized_related);
			
			//===========================================================================
			$vIn = '{<ul class="products columns-4">}';
			$vOut = '<amp-carousel id="poka-amp-product" height="400" layout="fixed-height" type="slides" autoplay delay="3000" controls loop data-next-button-aria-label="Go to next slide" data-previous-button-aria-label="Go to previous slide">';
			$sanitized_related = preg_replace($vIn, $vOut, $sanitized_related);
			
			$vIn = '{</li>.*</ul>.*</section>}';
			$vOut = '</li></amp-carousel></section>';
			$sanitized_related = preg_replace($vIn, $vOut, $sanitized_related);
   
            echo $sanitized_related;
		?>

		<?php
		    if(is_active_sidebar('poka-widget-single-product-bottom')){
		    	ob_start();
			  	dynamic_sidebar('poka-widget-single-product-bottom');
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
	            echo $sanitized_sidebar;
		    }
	       
		 ?>

	</div>
		
</div>
 
 <?php amp_footer()?>
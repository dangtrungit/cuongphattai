<?php
	$short_description = apply_filters( 'woocommerce_short_description', $product->post_excerpt );
?>
<div class="product-details short-description info">
	<div>
        <div class="extent">
			<?php
				$donVi     = get_post_meta($id, '_poka_unit', true);
				$baoHanh   = get_post_meta($id, '_poka_baohanh', true);
				$tinhTrang = get_post_meta($id, '_stock_status', true);
				
				if(!empty($donVi)){
					echo '<div class="item donvi" ><label>Đơn vị:</label> <span>'.$donVi.'</span></div>';
				}
				
				if(!empty($baoHanh)){
					echo '<div class="item baohanhsp" ><label>Đơn vị:</label> <span>'.$baoHanh.'</span></div>';
				}
				
				if($tinhTrang == 'instock'){
					echo '<div class="item stock" ><label>Tình trạng:</label> <span>Còn hàng</span></div>';
				}
			
			?>
        </div>
        
        <?php
            if(!empty($short_description)) :
        ?>
        <div class="info-product">
            <h3 class="title-des">Mô tả sản phẩm</h3>
	        <?php echo $short_description; // WPCS: XSS ok. ?>
        </div>
        <?php
            endif;
        ?>

        <div class="info-product">
            <h3 class="title-des">Mô tả sản phẩm</h3>
	        <p>Tuy nhỏ, nhưng Q Acoustics seri 3020i có khả năng tạo ra một không gian giải trí bằng âm thanh ấn tượng trong phòng có diện tích tới 30m2</p>
        </div>
    </div>
    
    <div>
	    <?php
		    if(is_active_sidebar('poka-widget-single-product-top')){
			    dynamic_sidebar('poka-widget-single-product-top');
		    }
	    ?>
    </div>
    <div class="clear"></div>
	
	<?php
		$khuyenmai = get_post_meta($id, '_poka_khuyenmai', true);
		if(!empty($khuyenmai)) :
	?>
        <div class="khuyenmai">
            <h3 class="title-khuyenmai">Khuyến mãi</h3>
            <div class="content">
	            <?php echo htmlspecialchars_decode($khuyenmai); ?>
            </div>
        </div>
    <?php
        endif;
    ?>
    
    <div class="btn-cart">
            <a class="btn buy-now" href="<?php echo get_home_url() . '/dat-hang?order-product=' . get_the_ID(); ?>">Mua Ngay</a>
        <?php
	        $_product = wc_get_product(get_the_ID());
	        $vPrice = $_product->get_price();
	        if($vPrice >= 3000000) :
        ?>
            <a class="btn btn-tragop" href="<?php echo get_home_url() . '/tra-gop/?id=' . get_the_ID(); ?>">Mua trả góp</a>
        <?php
            endif;
        ?>
    </div>
	
	
	<?php
		$ghepNoi = get_post_meta($id, '_poka_ghepnois', true);
		if(!empty($ghepNoi)){
			$ghepNoi = explode(',', $ghepNoi);
			
			$args = array(
				'include' => $ghepNoi,
			);
			$products = wc_get_products( $args );
			if(!empty($products)){
				echo '<div class="ghepnoi">
						<h3 class="title-ghepnoi">Sản phẩm ghép nối</h3>
							<div class="list-products">';
				
				foreach($products as $key => $product){
					$urlImage = get_the_post_thumbnail_url($product->get_id(), 'thumbnail');
					echo '<div class="item"><a target="_blank" href="'.get_permalink($product->get_id()).'"><img src="'.$urlImage.'" alt="'.$product->get_name().'"></a></div>';
				}
				
				echo '</div></div>';
			}
        }
	?>

    
    <?php
	    $giaithuong  = get_post_meta($id, '_poka_giaithuong', true);
	    if(!empty($giaithuong)){
		    echo '<div class="giaithuong"><h3 class="title-giaithuong">Giải Thưởng</h3>';
		    
	        foreach($giaithuong as $keyGiaiThong => $valueGiaiThuong){
		        echo '<div class="item">
                        <a target="_blank" href="'.$valueGiaiThuong['link'].'"><img src="'.$valueGiaiThuong['image'].'" alt="'.$valueGiaiThuong['title'].'"></a>
                     </div>';
            }
	        
		    echo '</div>';
        }
    ?>
</div>
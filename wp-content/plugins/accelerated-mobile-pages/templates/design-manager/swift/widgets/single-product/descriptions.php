<div class="descriptions">
<h2 class="title-info">Thông tin sản phẩm</h2>
<?php the_content(); ?>


<?php	
	if(wp_is_mobile()){
		$thongSoKyThuat = get_post_meta($id, '_poka_thongsokythuat', true);
		if(!empty($thongSoKyThuat)){
			?>
            <div class="thongso">
                <div class="label-widget">Thông số kỹ thuật</div>
                <div class="content">
					<?php echo htmlspecialchars_decode($thongSoKyThuat); ?>
                </div>
            </div>
			<?php
		}
		
	}
	
	$tinhTrang = get_post_meta($id, '_stock_status', true);
	if($tinhTrang == 'instock'){
		$urlProduct = get_permalink() . '?add-to-cart=' . $id;
		$img        = get_the_post_thumbnail('', 'thumbnail');
		
		$vPrice = wc_price(get_post_meta($id, '_regular_price', true));
		$sale   = get_post_meta($id, '_sale_price', true);
		
		if($sale > 0){
			$vSale = '<p class="sale">'.wc_price($sale).'</p>';
		}else{
			$vSale = '';
		}
	    ?>
        <div class="after-description">
            <div class="img">
                <?php echo $img; ?>
            </div>
            <div >
                <h4 class="title"><?php echo get_the_title(); ?></h4>
                <?php echo $vSale; ?>
                <p class="price"><?php echo $vPrice; ?></p>
                <div class="add-cart">
                    <a class="ajax_add_to_cart" href="<?php echo esc_url($urlProduct); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> THÊM VÀO GIỎ</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php
	}
?>
</div>
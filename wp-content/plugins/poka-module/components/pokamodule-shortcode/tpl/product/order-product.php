<?php
	$product = wc_get_product($productID);
?>

<?php
	if(!empty($product)) :
		$urlProduct = $product->add_to_cart_url();
?>
		<div class="page-order-product">
			<div class="info-product">
                <div class="title">Thông tin sản phẩm</div>
				<div class="title-product"><label>- Sản Phẩm:</label> <a href="<?php echo $urlProduct; ?>" target="_blank"><?php echo $product->get_title(); ?></a></div>
				<div class="image-product"><label>- Hình Ảnh Sản Phẩm</label></div>
				<?php echo $product->get_image(); ?>
			</div>
			<p class="info-desc">Thông tin đặt hàng</p>
		</div>
		<script type="text/javascript">
			var pokaUrlProduct = '<?php echo $urlProduct; ?>';
		</script>
<?php
	endif;
?>
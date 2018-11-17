
<?php 
global $wp_query;
$term = $wp_query->get_queried_object();

amp_header();
ob_start();


?>

<div class="cntr archive">
	<div class="arch-tlt">
    	<?php 
			echo '<h3 class="amp-archive-title">'. str_replace("product", "Cửa hàng", $term->name) .'</h3>';
			amp_breadcrumb(); 
		?>
	</div>

	<?php do_action( 'woocommerce_archive_description' ); ?>
    
<?php
	do_action( 'woocommerce_before_main_content' );
	
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	
	$vHomeUrl = get_home_url();
?>
	<div class="clearfix"></div>

    <div class="list-tag">
        <label>TÌM KIẾM NHIỀU:</label>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/dan-am-thanh/amp/">Dàn âm thanh</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/5-1/amp/">Âm thanh 5.1</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/ke-tivi/amp/">Kệ tivi</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/khong-day536549/amp/">Bộ Giải Mã DAC Không dây</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/loa-vi-tinh/amp/">Loa Vi tính</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/nghe-nhac536/amp/">Ampli Nghe Nhạc</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/chan-chong-rung/amp/">Chân Chống Rung</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/hdmi/amp/">Dây HDMI</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/day-loa/amp/">Dây Loa</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/dau-hd/amp/">Đầu HD</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/ampli/amp/">Ampli</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/dau-karaoke536/amp/">Đầu Karaoke</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/loa/amp/">Loa</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/loa-bluetooth/amp/">Loa Bluetooth</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/mic-hat-karaoke/amp/">Mic Hát Karaoke</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/phu-kien-am-thanh/amp/">Phụ Kiện Âm Thanh</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/vat-lieu-cach-am/amp/">Vật Liệu Cách Âm</a></span>
        <span>\ <a href="<?php echo $vHomeUrl; ?>/o-cam-dien-audio/amp/">Ổ Cắm Điện Audio</a></span>
    </div>
    <div class="banner-full-product">
        <img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/banner-catproduct.jpg" alt="techlandaudio">
    </div>

    <amp-carousel height="40" layout="fixed-height" type="carousel" autoplay>
        <a href=""><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-sony.png" width="100" height="40" alt="sony"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=bose&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-bose.png" width="100" height="40" alt="bose"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=mass-fidelity&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-mass-fidelity.png" width="100" height="40" alt="mass"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=jamo&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-jamo.png" width="100" height="40" alt="jamo"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=plinius&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-plinius.png" width="100" height="40" alt="plinius"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=akg&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-akg.png" width="100" height="40" alt="akg"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=shure&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-shure.png" width="100" height="40" alt="shure"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=dynaudio&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-dynaudio.png" width="100" height="40" alt="dynaudio"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=cambridge-audio&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-cambridge.png" width="40" height="40" alt="Cambridge"></amp-img></a>
        <a href=""><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-tranpraent.png" width="100" height="40" alt="tranpraent"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=mcintosh&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-mcIntosh.png" width="100" height="40" alt="McIntosh_Logo"></amp-img></a>
        <a href=""><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-van-den.png" width="100" height="40" alt="van-den"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=yamaha&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-yamaha.png" width="100" height="40" alt="yamaha"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=titan-audio&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-titan.png" width="100" height="40" alt="TITAN"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=avantgarde&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-avantgarde.png" width="100" height="40" alt="avantgarde"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=harmonix&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-harmonix.png" width="100" height="40" alt="harmonix"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=audio-pro&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-audiovector.png" width="100" height="40" alt="audio"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=arcam&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-arcam.png" width="100" height="40" alt="ARCAM"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=linn&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-linn.png" width="100" height="40" alt="Linn"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=nad&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-nad.png" width="100" height="40" alt="NAD"></amp-img></a>
        <a href=""><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-panasonic.png" width="100" height="40" alt="Panasonic"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=qed&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-qed.png" width="100" height="40" alt="QED"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=marantz&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/09/logo-marantz.png" width="100" height="40" alt="Marantz"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=acoustic-energy&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/Acoustics.png" width="100" height="40" alt="Acoustics"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>/cua-hang/?value=jbl&orderby=thuong-hieu"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/logo-acoustics.png" width="100" height="40" alt="JBL"></amp-img></a>
    </amp-carousel>

    <div class="clear"></div>
<?php

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );


$content = ob_get_contents();
ob_end_clean();
$sanitizer_obj = new AMPFORWP_Content( 
					$content,
					array(), 
					apply_filters( 'ampforwp_content_sanitizers', 
						array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), 
						) 
					) 
				);
$sanitized_content =  $sanitizer_obj->get_amp_content();
// $sanitized_content = str_replace(array('<form class="woocommerce-ordering" method="get">', '</form>'), array('', ''),$sanitized_content );

echo $sanitized_content;

?>

</div>

<?php amp_footer(); ?>
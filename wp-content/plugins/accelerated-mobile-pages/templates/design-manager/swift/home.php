<div class="hmp">
	<?php
	if (is_home() ){
	 	if (get_query_var( 'paged' ) ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var( 'page' ) ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
	}
	
	//Banner
	$vHomeUrl = get_home_url();
	?>
    <amp-carousel width="400" height="250" layout="responsive" type="slides" controls loop autoplay delay="3000" data-next-button-aria-label="Go to next slide" data-previous-button-aria-label="Go to previous slide">
        <a href="<?php echo $vHomeUrl; ?>"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/banner-xeo20.jpg" width="400" height="250" layout="responsive" alt="a sample image"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/banner.png" width="400" height="250" layout="responsive" alt="a sample image"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/loa-ls50.jpg" width="400" height="250" layout="responsive" alt="a sample image"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/banner-ls50w.jpg" width="400" height="250" layout="responsive" alt="a sample image"></amp-img></a>
        <a href="<?php echo $vHomeUrl; ?>"><amp-img src="<?php echo $vHomeUrl; ?>/wp-content/uploads/2018/08/loa-1.jpg" width="400" height="250" layout="responsive" alt="a sample image"></amp-img></a>
    </amp-carousel>

    <?php
        //Hang ban chay
	    ob_start();
	    echo '<h3 class="title-product-list">Hàng Bán Chạy</h3>';
	    echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="amp-show-products" label="hang-ban-chay"]');
	    echo '<div class="btn-view-more">';
	        echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="btn-view-more" url="https://techlandaudio.com.vn/cua-hang/" id="all" current="6"]');
	    echo '</div>';
	    $vContent = ob_get_contents();
	    ob_end_clean();
	    $objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
	    echo $objAMP->get_amp_content();
    ?>
    
    <?php //Thuong hieu ?>
    <div class="thuonghieu">
        <amp-carousel height="40" layout="fixed-height" type="carousel" autoplay delay="3000" controls loop data-next-button-aria-label="Go to next slide" data-previous-button-aria-label="Go to previous slide">
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
    </div>
	
	<?php
		//Dan am thanh
		ob_start();
		echo '<h3 class="title-product-list"><amp-img alt="Dàn Âm Thanh" src="'.$vHomeUrl.'/wp-content/uploads/2018/08/icon-danamthanh.png" width="35" height="22"></amp-img> Dàn Âm Thanh</h3>';
		echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="amp-show-products" label="dan-am-thanh"]');
		echo '<div class="btn-view-more">';
		    echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="btn-view-more" url="https://techlandaudio.com.vn/danh-muc/dan-am-thanh/" id="53" current="6"]');
		echo '</div>';
		$vContent = ob_get_contents();
		ob_end_clean();
		$objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
		echo $objAMP->get_amp_content();
	?>
	
	<?php
		//Loa
		ob_start();
		echo '<h3 class="title-product-list"><amp-img alt="Loa" src="'.$vHomeUrl.'/wp-content/uploads/2018/08/icon-load.png" width="12" height="17"></amp-img> Loa</h3>';
		echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="amp-show-products" label="loa"]');
		echo '<div class="btn-view-more">';
		    echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="btn-view-more" url="https://techlandaudio.com.vn/danh-muc/loa/" id="44" current="6"]');
		echo '</div>';
		$vContent = ob_get_contents();
		ob_end_clean();
		$objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
		echo $objAMP->get_amp_content();
	?>

	<?php
		//Bo gai ma dac
		ob_start();
		echo '<h3 class="title-product-list"><amp-img alt="Bộ giải mã dac" src="'.$vHomeUrl.'/wp-content/uploads/2018/08/icon-dac.png" width="33" height="22"></amp-img> Bộ giải mã dac</h3>';
		echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="amp-show-products" label="bo-giai-ma-dac"]');
		echo '<div class="btn-view-more">';
		echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="btn-view-more" url="https://techlandaudio.com.vn/danh-muc/bo-giai-ma-dac/" id="40" current="6"]');
		echo '</div>';
		$vContent = ob_get_contents();
		ob_end_clean();
		$objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
		echo $objAMP->get_amp_content();
	?>
	
	<?php
		//Ke Tivi
		ob_start();
		echo '<h3 class="title-product-list"><amp-img alt="Kệ TIVI" src="'.$vHomeUrl.'/wp-content/uploads/2018/08/icon-dac.png" width="35" height="22"></amp-img> Kệ TIVI</h3>';
		echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="amp-show-products" label="ke-tivi"]');
		echo '<div class="btn-view-more">';
		echo do_shortcode('[pokamodule com="pokamodule-shortcode" task="btn-view-more" url="https://techlandaudio.com.vn/danh-muc/ke-tivi/" id="239" current="6"]');
		echo '</div>';
		$vContent = ob_get_contents();
		ob_end_clean();
		$objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
		echo $objAMP->get_amp_content();
	?>
    
    <?php
        //Video
	    ob_start();
	    echo '<h3 class="title-product-list"><amp-img alt="Kệ TIVI" src="'.$vHomeUrl.'/wp-content/uploads/2018/08/icon-play.png" width="23" height="23"></amp-img> Video</h3>';
	    
	    echo '<div class="video-item">
                <amp-youtube width="480" height="270" layout="responsive" data-videoid="4lKkDGBnw8k"></amp-youtube>
              </div>
	            <div class="video-item">
	            <amp-youtube width="480" height="270" layout="responsive" data-videoid="RxwA9_tgxfU"></amp-youtube>
                </div>';
	    
	    echo '<div class="view-more-video"><a target="_blank" href="https://www.youtube.com/channel/UC4qsTJR3IsvAbzdz855CHsQ">XEM THÊM VIDEO</a></div>';
	    
	    $vContent = ob_get_contents();
	    ob_end_clean();
	    $objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
	    echo $objAMP->get_amp_content();
    ?>

     <?php
        //Góc tư vấn
	     ob_start();
	     echo '<h3 class="title-product-list"><amp-img alt="Kệ TIVI" src="'.$vHomeUrl.'/wp-content/uploads/2018/08/icon-goctuvan.png" width="23" height="23"></amp-img> Góc tư vấn</h3>';
	
	     echo '<div class="go-tu-van">' . do_shortcode('[pokamodule com="pokamodule-shortcode" task="list-post" category="all" thumbnail="1" is_screen="mobile" limit="3" date="1"]') . '</div>';
	
	     echo '<div class="view-more-video"><a href="https://techlandaudio.com.vn/goc-tu-van/">Xem Thêm</a></div>';
	
	     $vContent = ob_get_contents();
	     ob_end_clean();
	     $objAMP = new AMPFORWP_Content($vContent, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array())));
	     echo $objAMP->get_amp_content();
    ?>
	
	<?php
		//Tìm kiếm nhiều
	?>
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
</div>

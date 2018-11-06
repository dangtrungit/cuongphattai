<?php 
	 if(is_user_logged_in() && get_current_user_id() == $this->customer_order_urer_id){
         wp_logout();
    }
 ?>

<div class="null_cart">
	<span class="wrap-icon"><i class="iconnoti iconcheck"></i></span>
	<div style="color: #07b224"><?php echo 'Chúc mừng bạn đã đặt hàng thành công!'; ?></div>
	<a href="<?php echo get_home_url(); ?>" class="buyother"><?php echo 'Về trang chủ'; ?></a>
	<div class="callship">
       <?php echo ' Khi cần trợ giúp vui lòng gọi'; ?> <a href="tel:098.435.3333">098.435.3333</a> hoặc <a href="tel:0909.70.4444">0909.70.4444</a> (7h30 - 22h)
    </div>
</div>

<style type="text/css" media="screen">
	body{background: white !important;}
	.woocommerce-message{display: none}
</style>


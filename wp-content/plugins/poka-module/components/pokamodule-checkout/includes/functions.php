<?php
/**
 * 
 */
class Common
{
	public static function wp_create_user($username, $password, $email = ''){
        $user_login = esc_sql( $username );
        $user_email = esc_sql( $email    );
        $user_pass = $password;

        $userdata = compact('user_login', 'user_email', 'user_pass');
        return wp_insert_user($userdata);
    }

    public static function displayTotal(){  
	    $total_price = str_replace("VNĐ", "", WC()->cart->get_cart_total())."₫";

	    if(!empty(WC()->cart->applied_coupons)){
	        $sub_total          = WC()->cart->subtotal;
	        $coupon_code        = WC()->cart->applied_coupons[0];
	        $total_price_coupon = WC()->cart->discount_cart;

	        $sub_total          = number_format( (int)$sub_total, 0, ",", ".") .'₫';
	        $coupon_code        = $coupon_code;

	        $total_price_coupon = number_format( (int)$total_price_coupon, 0, ",", ".") .'₫';
	        
	        $display_total = '
	        <p style="margin-bottom: 4px !important"><b>Tổng tiền:</b>
	        <strong>'. $sub_total .'</strong></p>

	        <p style="margin-bottom: 4px !important"><b>Mã giảm giá "'. $coupon_code .'":</b>
	        <strong>-'. $total_price_coupon .'</strong> </p>
	        
	        <p style="margin-bottom: 4px !important"><b>Tổng tiền:</b>
	        <strong>'.$total_price.'</strong></p>';

	    }else{
            
	        $display_total= '<p style="margin-bottom: 4px !important"><b>' . 'Tổng tiền:' .'</b>
	        <strong>'.$total_price.'</strong></p>';
	    }

	    return $display_total;
	}

	public static function display_products()
	{
		$products      = WC()->cart->get_cart();
        $list_products = "";
        foreach ($products as $key => $product) {
            $product_id = $product["product_id"];

            $list_order .= '<div class="order_item order_'. $product_id .'">';

            $thumbnail_url = get_the_post_thumbnail_url($product_id, "thumbnail");
            $list_order .= '<div class="col_img">';

            $list_order .= '<a href="'. get_home_url()."/". $product["slug"] .'"><img src="'.$thumbnail_url.'" alt=""></a>';

            $list_order .= '<button type="button" class="delete" data-product-id="'. $key  .'"><span></span>Xóa</button>';

                $list_order .= '</div>'; //End col_img

                $list_order .= '<div class="order_info">';

                $list_order .= '<div class="product_name">';

                $list_order .= '<a href="'.get_home_url() ."/". $product["slug"] .'">'. $product["data"]->name .'</a>';

                    $list_order .= '</div>';//End product_name

                    $ttkm = get_post_meta($product_id, "thongtinkhuyenmai", true);
                    $list_order .= '<div class="product_desc">';
                    $list_order .= $ttkm;
                    $list_order .= '</div>';//End product_desc

                    $list_order .= '<span class="price">'. number_format( (int)$product["data"]->price, 0, ",", ".") .'₫</span>';
                    
                    $active = ( $product["quantity"] > 1 ) ? "active" : "";
                    $list_order .= '<div class="clearfix">
                    <div class="choosenumber">
                    <div class="abate '. $active .'"></div>
                    <div class="number" data-product-id="'. $key .'">'. $product["quantity"] .'</div>
                    <div class="augment "></div>
                    </div>
                    </div>';

                $list_order .= '</div>';//End order_info

            $list_order .= '<div class="clearfix"></div></div>';//End order_item
        }

        return $list_order;
	}


    public static function get_cart()
    {
        session_start();
        if (!empty($_SESSION["fast_cart"])) {
            WC()->cart->empty_cart();
            WC()->cart->add_to_cart(@$_SESSION["fast_cart"]["product_id"], @$_SESSION["fast_cart"]["quantity"], @$_SESSION["fast_cart"]["variation_id"]); 

            if ( !empty($_SESSION["fast_cart"]["coupon_code"]) ) {
                WC()->cart->add_discount($_SESSION["fast_cart"]["coupon_code"]);
            }
        }else{
            return "";
        }
        
    }

}
<?php
class PokamoduleCheckoutController { 
    private $sPath                   = "";
    private $sSelfURL                = "";
    private $sTask                   = "";
    private $sPage                   = "";
    private $sClassName              = "";
    private $customer_order_urer_id  = "";
    
    public function __construct() {     
        $this->sClassName   = __CLASS__;
        $this->sPath        = realpath(dirname(__FILE__));
        $this->sSelfURL     = PMCommon::getSelfURL("component");
        $this->sTask        = !empty($_REQUEST["task"]) ? PMCommon::trim_all($_REQUEST["task"]) : "";
        $this->sPage        = !empty($_REQUEST["page"]) ? PMCommon::trim_all($_REQUEST["page"]) : "";
        $this->customer_order_urer_id = get_option( "acc_customer_order" );

        wp_enqueue_style( 'pokamodule-checkout' );
        wp_enqueue_script( 'pokamodule-checkout' );
    } 
    
    
    public function doAction() {
        include($this->sPath."/includes/functions.php");
        $sTask  = PMCommon::trim_all($_REQUEST["task"]);
        
        session_start();
        if ( empty($_SESSION["fast_cart"]) ) {
            echo "EMPTY_CART";
            wp_die();
        }

        Common::get_cart();

        switch($sTask) {  
            case "delete-product":
                $this->deleteProduct();
                break;

            case "update-product":
                $this->updateProduct();
                break;

            case "apply-coupon":
                $this->applyCoupon();
                break;

            case "calculate-shipping":
                $this->calculateShipping();
                break;

            case "create-order":
                $this->createOrder();
                break;

            default:
                echo "NOTHINGS";
                break;
        }
    }

    public function doShortCode($aAtts = array()) { 
        include($this->sPath."/includes/functions.php");

        switch($aAtts["task"]) { 
            case "checkout":
                $this->checkoutPage($aAtts);
                break;
            case "nothing":
                default:
                echo "NOTHING";
                break;
        }  
    }

    public function checkoutPage() { 
        session_start();  
        wp_enqueue_style( 'semantic-ui-loader-css' ); 
        wp_enqueue_style( 'semantic-ui-segment-css' );  
        wp_enqueue_style( 'semantic-ui-dimmer-css' );  
        wp_enqueue_script( 'semantic-ui-dimmer-js' ); 
        wp_enqueue_style( 'semantic-ui-dropdown-css' );  
        wp_enqueue_script( 'semantic-ui-dropdown-js' );
        wp_enqueue_style( 'semantic-ui-transition-css' );  
        wp_enqueue_script( 'semantic-ui-transition-js' ); 
        wp_enqueue_style( 'semantic-ui-form-css' );  
        wp_enqueue_script( 'semantic-ui-form-js' );
        
        // 1. Checkout Complete
        if ( isset($_GET["checkout"]) && $_GET["checkout"] == "complete" ) {
            include ( $this->sPath . "/tpl/complete.php" );
            return;
        }

        // 2. Cart Empty
        if ( empty($_SESSION["fast_cart"]) ) {
            include ( $this->sPath . "/tpl/null_cart.php" );
            return;
        }else{
            Common::get_cart();
        }

        // 3. Page checkout
        include ( $this->sPath . "/tpl/checkout_page.php" );
    }

    private function createOrder(){   
        parse_str($_REQUEST["fdata"], $aData);

        $name           = $aData["name"];
        $gender         = $aData["chosse_gender"];
        $phonenumbers   = $aData["phonenumbers"];
        $email          = $aData["order_email"];
        $province       = !empty($aData["province"]) ? $aData["province"] : "";
        $address        = !empty($aData["address"]) ? $aData["address"] : "";
        $order_excerpt  = !empty($aData["order_excerpt"]) ? $aData["order_excerpt"] : "";

        $checkout = WC()->checkout();
        $order_id = $checkout->create_order();
        $order    = wc_get_order( $order_id );

        $aAddress_billing = array(
            'first_name' => "(".$gender.") ",
            'last_name'  => $name,
            'company'    => '',
            'email'      => $email,
            'phone'      => $phonenumbers,
            'address_1'  => $address,
            'address_2'  => $province,
            'city'       => $province,
            'state'      => $province,
            'country'    => 'VN'
        );
        $aAddress_shipping = $aAddress_billing;
        $order->set_address( $aAddress_billing, 'billing' );
        $order->set_address( $aAddress_shipping, 'shipping' );

        $order->update_status("on-hold", 'Imported order', TRUE);
        update_post_meta( $order_id, "_fast_order", 1 );
        update_post_meta( $order_id, '_customer_question', $order_excerpt );

        if (get_current_user_id() == $this->customer_order_urer_id) {
            update_post_meta( $order_id, '_customer_user', "" );
        }

        $order->calculate_totals();
        WC()->cart->empty_cart();

        session_start();
        $_SESSION["fast_cart"] = "";

        wp_die();
    }

    private function deleteProduct(){   
        session_start();
        $_SESSION["fast_cart"] = "";
        wp_die();
    }

    private function applyCoupon(){
        $coupon_code = $_REQUEST["coupon_code"] ? sanitize_text_field($_REQUEST["coupon_code"]) : "";
        
        if ( empty( WC()->cart->applied_coupons ) ){
            WC()->cart->add_discount( $coupon_code );
            echo Common::displayTotal();
        }else{
            $message =  '<ul class="woocommerce-error">
                        <li>Đơn hàng đã áp dụng 1 Mã ưu đãi!</li>
                        </ul>';   
        }
        echo "|";
        if(!empty($message)){
            echo $message;
        }else{
            wc_print_notices();  
        }

        session_start();
        $_SESSION["fast_cart"]["coupon_code"] = $coupon_code;
        
        wp_die(); 
    }

    private function updateProduct(){
        $product_id  = !empty($_REQUEST["product_id"]) ? $_REQUEST["product_id"] : 0;
        $quantity    = !empty($_REQUEST["quantity"]) ? $_REQUEST["quantity"] : 0;

        WC()->cart->set_quantity($product_id, $quantity);

        session_start();
        $_SESSION["fast_cart"]["quantity"] = $quantity;

        echo $display_total = Common::displayTotal();
        wp_die();
    }

    private function calculateShipping()
    {
        $province = !empty($_REQUEST["province"]) ? trim($_REQUEST["province"]) : "";
        WC()->customer->set_billing_state($province);
        WC()->customer->set_shipping_state( $province );

        wp_die();
    }

}


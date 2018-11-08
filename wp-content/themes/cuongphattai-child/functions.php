<?php 


/*====================URL==========================*/
define('VUTIENIT_THEME_URL', get_stylesheet_directory_uri());
define('VUTIENIT_VUTEINIT_URL', VUTIENIT_THEME_URL . '/pokamedia');
define('VUTIENIT_PUBLIC_URL', VUTIENIT_VUTEINIT_URL . '/public');
define('VUTIENIT_CSS_URL', VUTIENIT_PUBLIC_URL . '/css');
define('VUTIENIT_IMAGE_URL', VUTIENIT_PUBLIC_URL . '/image');
define('VUTIENIT_JS_URL', VUTIENIT_PUBLIC_URL . '/js');



add_action('wp_enqueue_scripts', 'vt_load_styles');
function vt_load_styles(){
	wp_enqueue_style('parent-theme', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-theme', get_stylesheet_directory_uri() . '/style.css', array('parent-theme'));
	
	
	wp_register_style('font-awesome', VUTIENIT_CSS_URL . '/font-awesome/css/font-awesome.css', array());
	wp_enqueue_style('font-awesome');

}

add_action('wp_enqueue_scripts', 'add_js_file');
function add_js_file(){

	
	wp_register_script('wow-js', VUTIENIT_JS_URL . '/wow.min.js', array('jquery'), '', true);
	wp_enqueue_script('wow-js');



	wp_register_script('poka-js', VUTIENIT_JS_URL . '/poka.js', array('jquery'), '', true);
	wp_enqueue_script('poka-js');

}
function ilc_mce_buttons($buttons){
	array_push($buttons,
		"backcolor",
		"anchor",
		"hr",
		"sub",
		"sup",
		"fontselect",
		"fontsizeselect",
		"styleselect",
		"cleanup"
	);
	return $buttons;
}

// hien thi tren topbar
register_sidebar(array(
    'name' => 'hiển thị thông tin topbar',
    'id' => 'pk-topbar',
    'description' => 'Hiển thị trên thanh topbar',
    'before_widget' => '<div id="pk-topbar" class="widget pk-topbar-widget">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => ''
));

add_filter("mce_buttons_2", "ilc_mce_buttons");
load_child_theme_textdomain('siteorigin-north', get_stylesheet_directory() . '/languages/');


if(!is_admin()){
    PMCommon::load_assets_css_js('sticky/', 'jquery.sticky.min.js', 'js');
}
// hien thi so dien thoai duoi sp
register_sidebar(array(
    'name' => 'hien thi so dien thoai duoi san pham',
    'id' => 'pk-post-detai',
    'description' => 'Hiển thị dưới sản phẩm',
    'before_widget' => '<div id="pk-post-detai" class="widget pk-post-detai-widget">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => ''
));

// hien thi dưới bài viết chi tiết
register_sidebar(array(
    'name' => 'hien thi mo ta chi tiet san pham',
    'id' => 'pk-post-product-detail',
    'description' => 'Hiển thị dưới mô tả chi tiết sản phẩm',
    'before_widget' => '<div id="pk-post-product-detail" class="widget pk-post-product-detail-widget">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => ''
));
/*hien thi thông tin vận chuyển*/
register_sidebar(array(
    'name' => 'hien thi thong tin van chuyen',
    'id' => 'pk-thongtin-vanchuyen',
    'description' => 'Hiển thị thông tin vận chuyển',
    'before_widget' => '<div id="pk-thongtin-vanchuyen" class="widget pk-thongtin-vanchuyen-widget">',
    'after_widget' => '</div>',
    'before_title' => '',
    'after_title' => ''
));
/*hien thi video hướng*/
//register_sidebar(array(
//    'name' => 'hien thi thong tin van chuyen',
//    'id' => 'pk-thongtin-vanchuyen',
//    'description' => 'Hiển thị thông tin vận chuyển',
//    'before_widget' => '<div id="pk-thongtin-vanchuyen" class="widget pk-thongtin-vanchuyen-widget">',
//    'after_widget' => '</div>',
//    'before_title' => '',
//    'after_title' => ''
//));

// Buy Now
add_action( 'woocommerce_after_add_to_cart_button', 'single_product_add_to_cart', 50 );
function single_product_add_to_cart(){
    global $product;

    echo '<form action="" method="post" accept-charset="utf-8">';
    echo '<input type="hidden" name="product_id" id="product_id" value="'. $product->get_id() .'">';
    echo '<input type="hidden" name="quantity" id="quantity" value="1">';
    echo '<input type="hidden" name="price" id="price" value="'. $product->price .'">';
    echo '<button type="submit" name="buy-now" class="buynow_product" value="Mua Ngay">Mua Ngay</button>';
    echo '</form>';


    if ( !empty($_POST["buy-now"]) ) {
        addToCart();

        header('Location: '.get_home_url()."/dat-hang-nhanh");
    }
}

// function addToCart()
// {
//  session_start();
//  $product_id   = !empty( $_POST["product_id"] ) ? intval( $_POST["product_id"] ) : 0;
//  $quantity     = !empty( $_POST["quantity"] ) ? intval( $_POST["quantity"] ) : 0;
//  $variation_id = !empty( $_POST["variation_id"] ) ? intval( $_POST["variation_id"] ) : 0;


//  WC()->cart->empty_cart();
//  WC()->cart->add_to_cart($product_id, $quantity, $variation_id);

//  // Đánh dấu là Data form đặt hàng nhanh
//  $_SESSION["fast_cart"] = WC()->cart;
// }


function addToCart()
{
    session_start();
    $product_id   = !empty( $_POST["product_id"] ) ? intval( $_POST["product_id"] ) : 0;
    $quantity     = !empty( $_POST["quantity"] ) ? intval( $_POST["quantity"] ) : 0;
    $variation_id = !empty( $_POST["variation_id"] ) ? intval( $_POST["variation_id"] ) : 0;

    // Đánh dấu là Data form đặt hàng nhanh
    $_SESSION["fast_cart"] = array(
        "product_id"    => $product_id,
        "quantity"      => $quantity,
        "variation_id"  => $variation_id
    );
}
add_action( 'woocommerce_single_product_summary', 'test', 17 );
function test(){
    echo "<div class='free-ship' ><p>Vận chuyển</p><img src='".get_home_url()."/wp-content/uploads/2018/11/shipfreeoto.png'><span>Free ship nội thành</span></div>";
}

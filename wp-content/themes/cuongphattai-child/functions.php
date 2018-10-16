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

	wp_register_script('slick-js', VUTIENIT_JS_URL . '/slick.min.js', array('jquery'), '', true);
	wp_enqueue_script('slick-js');

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

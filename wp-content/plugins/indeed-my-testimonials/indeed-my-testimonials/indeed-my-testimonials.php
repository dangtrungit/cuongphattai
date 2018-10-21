<?php
/*
Plugin Name: Indeed My Testimonials
Plugin URI: http://www.wpindeed.com/
Description: The most shainny Testimonials Showcase plugin. With predifined themes and colors scheme you can display your testimonials with few clicks and without any line of code.
Version: 2.8
Author: indeed
Author URI: http://www.wpindeed.com
*/
if (get_option('imtst_post_type_name')!==FALSE && get_option('imtst_post_type_name')!='' ){
	define('IMTST_POST_TYPE', get_option('imtst_post_type_name'));
	if (IMTST_POST_TYPE=='tetimonials'){
		define('IMTST_TAXONOMY', 'testimonial_groups');
	} else {
		define('IMTST_TAXONOMY', IMTST_POST_TYPE.'_groups');
	}
} else {
	global $wpdb;
	$temp_check = $wpdb->get_var("SELECT COUNT(*) as c FROM {$wpdb->postmeta} WHERE meta_key='imtst_clienturl';");
	if ($temp_check){
		define('IMTST_POST_TYPE', 'testimonials');
		define('IMTST_TAXONOMY', 'team_cats');	
	} else {
		define('IMTST_POST_TYPE', 'imtst_testimonials');
		define('IMTST_TAXONOMY', 'imtst_testimonial_groups');	
	}
	update_option('imtst_post_type_name', IMTST_POST_TYPE);
} 

define('IMTST_DIR_URL', plugin_dir_url(__FILE__));
define('IMTST_DIR_PATH', plugin_dir_path(__FILE__));

add_action('init', 'imtst_load_language');
function imtst_load_language(){
	load_plugin_textdomain( 'imtst', false, dirname(plugin_basename(__FILE__)).'/languages/' );
}

///FUNCTIONS
include_once IMTST_DIR_PATH.'includes/functions.php';
//////// imtst on EACH FUNCTION NAME
add_action( 'init', 'imtst_post_testimonials' );
function imtst_post_testimonials() {
  $labels = array(
    'name'               => 'Testimonials',
    'singular_name'      => 'Testimonial',
    'add_new'            => 'Add New Testimonial',
    'add_new_item'       => 'Add New Testimonial',
    'edit_item'          => 'Edit Testimonial',
    'new_item'           => 'New Testimonial',
    'all_items'          => 'All Testimonials',
    'view_item'          => 'View Testimonial',
    'search_items'       => 'Search Testimonials',
    'not_found'          => 'No Testimonials available',
    'not_found_in_trash' => 'No Testimonials found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'My Testimonials'
  );
  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 8,
    'menu_icon'          => IMTST_DIR_URL . 'files/images/ed-gray.png',
    'supports'           => array( 'title', 'editor', 'thumbnail' )
  );
    register_post_type( IMTST_POST_TYPE, $args );
}
////////////TAXONOMY
add_action( 'init', 'imtst_taxonomy_testimonials', 0 );
function imtst_taxonomy_testimonials() {
	$labels = array(
		'name'              => _x( 'Groups', 'taxonomy general name' ),
		'singular_name'     => _x( 'Group', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Groups' ),
		'all_items'         => __( 'All Groups' ),
		'parent_item'       => __( 'Parent Group' ),
		'parent_item_colon' => __( 'Parent Group:' ),
		'edit_item'         => __( 'Edit Group' ),
		'update_item'       => __( 'Update Group' ),
		'add_new_item'      => __( 'Add New Group' ),
		'new_item_name'     => __( 'New Group Name' ),
		'menu_name'         => __( 'Groups' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => IMTST_TAXONOMY ),
	);
register_taxonomy( IMTST_TAXONOMY, IMTST_POST_TYPE, $args );
}
////RENAME FEATURED IMAGE TO LOGO
add_action('do_meta_boxes', 'imtst_change_image_box');
function imtst_change_image_box(){
    remove_meta_box( 'postimagediv', IMTST_POST_TYPE, 'side' );
    add_meta_box('postimagediv', __('Client Image', 'imtst'), 'post_thumbnail_meta_box', IMTST_POST_TYPE, 'normal', 'high');
}
add_action('admin_head-post-new.php', 'imtst_change_thumbnail_html');
add_action('admin_head-post.php', 'imtst_change_thumbnail_html');
function imtst_change_thumbnail_html( $content ) {
    if ( isset($GLOBALS['post_type']) && $GLOBALS['post_type']==IMTST_POST_TYPE )
      add_filter('admin_post_thumbnail_html', 'imtst_rename_thumb');
}
function imtst_rename_thumb($content){
     return str_replace(__('featured image'), __('Client Image', 'imtst'), $content);
}
///////////////SHORTCODE GENERATOR ( SUBMENU )
add_action( 'admin_menu', 'imtst_shortcode_menu_testimonials' );
function imtst_shortcode_menu_testimonials(){
    add_submenu_page( 'edit.php?post_type='.IMTST_POST_TYPE, __('Shortcode Generator', 'imtst'), __('Shortcode Generator', 'imtst'), 'manage_options', 'testimonials_shortcode_generator', 'imtst_shortcode_page_testimonials' );
    add_submenu_page( 'edit.php?post_type='.IMTST_POST_TYPE, __('Form Builder', 'imtst'), __('Form Builder', 'imtst'), 'manage_options', 'testimonials_form_builder', 'imtst_formbuilder_page_testimonials' );
    add_submenu_page( 'edit.php?post_type='.IMTST_POST_TYPE, __('General Settings', 'imtst'), __('General Settings', 'imtst'), 'manage_options', 'testimonials_general_settings', 'imtst_general_settings' );
}
function imtst_shortcode_page_testimonials(){
    include_once IMTST_DIR_PATH . 'includes/imtst_shortcode_generator.php';
}
function imtst_formbuilder_page_testimonials(){
    include_once IMTST_DIR_PATH . 'includes/imtst_form_builder.php';
}
function imtst_general_settings(){
	include_once IMTST_DIR_PATH . 'includes/general_settings.php';	
}
/////////CUSTOM FIELD
    //////////INFO
    add_action( 'add_meta_boxes', 'imtst_cf_ti' );
    function imtst_cf_ti(){
        add_meta_box('client_personal_info',
                      __('Client Information', 'imtst'),
                     'imtst_metabox_ti', //function available in function.php
                     IMTST_POST_TYPE,
                     'normal',
                     'low');
    }
    add_action('save_post', 'imtst_save_ti');
    //////////RATINGS
    add_action( 'add_meta_boxes', 'imtst_cf_rating' );
    function imtst_cf_rating(){
        add_meta_box('client_rating',
                     __('Ratings', 'imtst'),
                     'imtst_metabox_rating', //function available in function.php
                     IMTST_POST_TYPE,
                     'normal',
                     'low');
    }
	 #CUSTOM LINK
    add_action( 'add_meta_boxes', 'imtst_custom_href' );
    function imtst_custom_href(){
    	add_meta_box('postcustomhref',
    			__( 'Select Target Link', 'imtst'),
    			'imtstCustomHrefMetaBox',
    			IMTST_POST_TYPE,
    			'normal',
    			'high' );
    }
#Enable feature image for IMTST_POST_TYPE
add_action( 'init', 'imtst_theme_suport');
function imtst_theme_suport(){
  	$postTypes = get_theme_support( 'post-thumbnails' );
   	if(isset($postTypes) && is_array($postTypes)){
   		$postTypes[] = IMTST_POST_TYPE;
   		add_theme_support( 'post-thumbnails', $postTypes );
   	}else{
   		add_theme_support( 'post-thumbnails' );
   	}
}    
 //add_filter('content_save_pre', 'imtst_removeHTMLtags');
function imtst_removeHTMLtags($content) {
    if ( isset($GLOBALS['post_type']) && $GLOBALS['post_type']==IMTST_POST_TYPE ) return strip_tags($content);
    else return $content;
}   
////////SHORTCODE
add_shortcode( 'indeed-my-testimonials', 'imtst_shortcode_func' );
function imtst_shortcode_func($attr){
    $return_str = true;
    $final_str = '';
    include IMTST_DIR_PATH . 'includes/imtst_view.php';
	return $final_str;
}
////////SHORTCODE Form Builder
add_shortcode( 'indeed-my-testimonials-form', 'imtst_form_shortcode' );
function imtst_form_shortcode($attr){
    wp_enqueue_style ( 'imtst_style_front_end', IMTST_DIR_URL.'files/css/style.css' );
    wp_enqueue_script ( 'testimonials_js', IMTST_DIR_URL.'files/js/functions.js', array(), null );
    $return_str = true;
    $str = '';
    include IMTST_DIR_PATH.'includes/imtst_form_view.php';
    return $str;
}
////////WIDGET
class IndeedMyTestimonialsWidget extends WP_Widget {
	function IndeedMyTestimonialsWidget() {
		// Instantiate the parent object
		parent::__construct( false, 'Indeed My Testimonials' );
	}
	function widget( $args, $instance ) {
        $dir = plugin_dir_path ( __FILE__ );
	    $current_instance_id = explode('-', $this->id);
		$instance_no = $current_instance_id[1];
        $attr = $instance;
        include_once IMTST_DIR_PATH . 'includes/imtst_view.php';
        global $wp_query;
        $a = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
	}
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
        $instance['group'] = $new_instance['group'];
        $instance['limit'] = $new_instance['limit'];
        $instance['order'] = $new_instance['order'];
        $instance['order_by'] = $new_instance['order_by'];
        $instance['max_num_desc'] = $new_instance['max_num_desc'];
        $instance['read_more'] = $new_instance['read_more'];        
        $instance['color_scheme'] = $new_instance['color_scheme'];
        $instance['disable_hover'] = $new_instance['disable_hover'];
        $instance['theme'] = $new_instance['theme'];
        $instance['show'] = $new_instance['show'];
        $instance['page_inside'] = $new_instance['page_inside'];
        $instance['inside_template'] = $new_instance['inside_template'];
        $instance['columns'] = $new_instance['columns'];
        //SLIDER
        $instance['slider_set'] = $new_instance['slider_set'];
        $instance['items_per_slide'] = $new_instance['items_per_slide'];
        $instance['slide_speed'] = $new_instance['slide_speed'];
        $instance['slide_pagination_speed'] = $new_instance['slide_pagination_speed'];
        $instance['slide_css_transition'] = $new_instance['slide_css_transition'];
        $instance['slide_opt'] = $new_instance['slide_opt'];
        return $instance;
	}
	function form( $instance ) {
        wp_enqueue_script( 'imtst_js_functions', IMTST_DIR_URL.'files/js/functions.js');
        wp_enqueue_style( 'be_style', IMTST_DIR_URL.'files/css/style.css');
	    $current_instance_id = explode('-', $this->id);
		$instance_no = $current_instance_id[1];
        $div_id_pre = $this->id;
        include IMTST_DIR_PATH.'includes/imtst_widget_form.php';
	}
}
function register_IndeedMyTestimonialsWidget() {
	register_widget( 'IndeedMyTestimonialsWidget' );
}
add_action( 'widgets_init', 'register_IndeedMyTestimonialsWidget' );

////STYLE AND JS
add_action('wp_enqueue_scripts', 'imtst_fe_head');
function imtst_fe_head(){
  wp_enqueue_style( 'imtst_style', IMTST_DIR_URL.'files/css/style.css' );
  wp_enqueue_style ( 'imtst_owl_carousel', IMTST_DIR_URL.'files/css/owl.carousel.css' );
  wp_enqueue_style( 'imtst_font-awesome', IMTST_DIR_URL.'files/css/font-awesome.min.css' );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script ( 'imtst_owl_carousel', IMTST_DIR_URL.'files/js/owl.carousel.js', array(), null );
  wp_enqueue_script ( 'imtst_front_end_testimonials_js', IMTST_DIR_URL .'files/js/front_end.js', array(), null );
  wp_enqueue_script ( 'imtst_isotope_pkgd_min', IMTST_DIR_URL.'files/js/isotope.pkgd.min.js', array(), null );
}
add_action("admin_enqueue_scripts", 'imtst_be_head');
function imtst_be_head(){
	wp_enqueue_style ( 'imtst_style-dashboard', IMTST_DIR_URL.'files/css/dashboard.css' );
    $screen = get_current_screen();
    if( $screen->post_type==IMTST_POST_TYPE ){
          wp_enqueue_style ( 'imtst_font-awesome', IMTST_DIR_URL.'files/css/font-awesome.min.css' );
          wp_enqueue_style ( 'imtst_style', IMTST_DIR_URL.'files/css/style.css' );
          wp_enqueue_style ( 'imtst_owl_carousel', IMTST_DIR_URL.'files/css/owl.carousel.css' );
          wp_enqueue_script( 'jquery' );
          wp_enqueue_script ( 'imtst_functions', IMTST_DIR_URL.'files/js/functions.js', array(), null );
          wp_enqueue_script ( 'imtst_owl_carousel', IMTST_DIR_URL.'files/js/owl.carousel.js', array(), null );
          
          if( function_exists( 'wp_enqueue_media' ) ){
          	wp_enqueue_media();
          	wp_enqueue_script ( 'imtst_open_media_3_5', IMTST_DIR_URL . 'files/js/open_media_3_5.js', array(), null );
          }else{
          	wp_enqueue_style( 'thickbox' );
          	wp_enqueue_script( 'thickbox' );
          	wp_enqueue_script( 'media-upload' );
          	wp_enqueue_script ( 'imtst_open_media_3_4', IMTST_DIR_URL . 'files/js/open_media_3_4.js', array(), null );
          }          
    }
}
//////  INSIDE TEMPLATE OPTION
add_filter( 'template_include', 'imtst_portfolio_page_template', 99 );
function imtst_portfolio_page_template( $template ) {
    if(get_post_type()==IMTST_POST_TYPE && isset($_REQUEST['imtst_cpt']) && $_REQUEST['imtst_cpt']!=''){
    	if($_REQUEST['imtst_cpt']=='IMTST_PAGE_TEMPLATE'){
    		//return our awesome page template
    		return IMTST_DIR_PATH.'includes/imtst_page_template.php';
    	}
        $template = urldecode($_REQUEST['imtst_cpt']);
        $template .= ".php";
    	$new_template = locate_template( $template );
        return $new_template;
    }
    else return $template;
}
//////////CUSTOM ADMIN COLUMNS
///IMAGE COLUMN
add_filter('manage_edit-'.IMTST_POST_TYPE.'_columns', 'imtst_custom_admin_column');
function imtst_custom_admin_column($columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['title'] = __('Client Name', 'imtst');
    $new_columns['quote'] = __('Quote', 'imtst');
    $new_columns['postimagediv'] = __('Client Image', 'imtst');
    $new_columns['taxonomy-'.IMTST_TAXONOMY] = __('Groups', 'imtst');   
    $new_columns['company'] = 'Company';    
    $new_columns['rating'] = 'Rating';
    $new_columns['date'] = _x('Date', 'column name');
    return $new_columns;
}
add_action('manage_posts_custom_column',  'imtst_display_columns' );
function imtst_display_columns($name) {
    global $post;
    $screen = get_current_screen();
    if( isset($screen->post_type) && $screen->post_type==IMTST_POST_TYPE){    
	    switch($name){
	        case 'postimagediv':
	            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail', false, '' );
	            if ($src && isset($src[0])){
	            	echo "<img src='{$src[0]}' width='50' height='50' title='{$post->post_title}'/>";
	            } else {
	            	$src = get_option('default_client_img');
	            	echo "<img src='".$src."' width='50' height='50' title='{$post->post_title}'/>";
	            }
	        break;
	        case 'quote':
	            $the_content = $post->post_content;
	            $arr = explode(" ", $the_content);
	      			if (count($arr) > 15){
	      			    array_splice($arr, 15);
	      				$the_content = implode(" ", $arr);
	                    $the_content .= " ...";
	      			}
	            echo $the_content;
	        break;
	        case 'company':
	        	$data = get_post_meta($post->ID, 'imtst_company', true);
	        	if ($data) echo $data;
	        break;
	        case 'rating':
	        	$data = get_post_meta($post->ID, 'imtst_stars', true);
	        	if ($data) echo imtst_return_stars($data);	        	
	        break;
	    }
    }
}

///Ajax change post type name
function imtst_change_post_type(){
	if(isset($_REQUEST['post_name']) && $_REQUEST['post_name']!=''){
		if(get_option('imtst_post_type_name')!==FALSE) update_option('imtst_post_type_name', $_REQUEST['post_name']);
		else add_option('imtst_post_type_name', $_REQUEST['post_name']);
		echo $_REQUEST['post_name'];
	}
	die();
}
add_action('wp_ajax_imtst_change_post_type', 'imtst_change_post_type');
add_action('wp_ajax_nopriv_imtst_change_post_type', 'imtst_change_post_type');

/////custom css for admin table
if (is_admin()){
	add_action('admin_head', 'imtst_custom_admin_css');
	function imtst_custom_admin_css(){
		?>
		<style>
			body.post-type-<?php echo IMTST_POST_TYPE;?> #posts-filter .wp-list-table #company{
				width: 10% !important;
			}
			body.post-type-<?php echo IMTST_POST_TYPE;?> #posts-filter .wp-list-table #rating{
				width: 12% !important;
			}
		</style>
		<?php 
	}
}

////INCLUDE WIDGET DO SHORTCODE
include_once IMTST_DIR_PATH . 'includes/do_shortcode_widget.php';

add_action( 'wp_dashboard_setup', 'imtst_register_admindashboard' );
function imtst_register_admindashboard() {
	$args = array(
			'posts_per_page'   => 25,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => IMTST_POST_TYPE,
			'post_status'      => 'pending',
	);
	$testimonials = get_posts($args);
	if ($testimonials && count($testimonials)){
		add_meta_box('indeed', 'Indeed My Testimonials - Pending', 'indeed_print_dashboard_widget_imtst', 'dashboard', 'normal', 'high');
	}	
}

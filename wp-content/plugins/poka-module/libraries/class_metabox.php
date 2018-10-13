<?php
new POKA_MetaBox();
class POKA_MetaBox {
	public function __construct() {
		if(is_admin()){
			$arr = array(
				'post_page' => false,       //Meta boxes POST, Page
				'category'  => false,       //Meta boxes Category
				'user'      => false,       //Meta boxes User Profile
				'product'   => false        //Meta boxes Product Woocommerce
			);
			
			foreach($arr as $key => $value){
				if($value == true){
					if(is_file(_POKA_PLUGIN_LIB_PATH_ . "/metabox/{$key}/css/" . $key . '.css')){
						wp_register_style('poka_metabox_' . $key, _POKA_PLUGIN_LIB_URL_ . "/metabox/{$key}/css/" . $key . '.css');
					}
					
					if(is_file(_POKA_PLUGIN_LIB_PATH_ . "/metabox/{$key}/css/" . $key . '.js')){
						wp_register_script('poka_metabox_' . $key, _POKA_PLUGIN_LIB_URL_ . "/metabox/{$key}/js/" . $key . '.js', array('jquery'), '1.0', true);
					}
					require_once _POKA_PLUGIN_LIB_PATH_ . "/metabox/{$key}/" . $key . '.php';
				}
			}
		}
    }
}

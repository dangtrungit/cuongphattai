<?php
/*
Plugin Name: POKA MODULE
Plugin URI: https://thietkewebwordpress.com.vn
Description: The easiest way to build your website ...
Author: Poka Team
Version: 1.1
Author URI: https://thietkewebwordpress.com.vn
*/

require_once 'define.php';

add_action('plugins_loaded', array('POKA_Plugin', 'init'));
class POKA_Plugin{
	public static function init(){
        ob_start();
		self::importCoreClass();
		
		if(is_admin()){
			add_action('admin_menu',            array('POKA_Controller', 'loadDashboardMenu'));
			add_action('admin_head',            array('POKA_Controller', 'loadHeader'));
			add_action('admin_enqueue_scripts', array('POKA_Controller', 'registerExtraScript'));
		}else{
			add_shortcode('pokamodule',     array('POKA_Controller', 'doShortCode'));
			add_action('wp_head',               array('POKA_Controller', 'loadHeader'));
//			add_action('wp_head',               array('POKA_Controller', 'loadCustomScriptHeader'));
			add_action('wp_footer',             array('POKA_Controller', 'loadCustomScriptFooter'));
			add_action('wp_enqueue_scripts',    array('POKA_Controller', 'registerExtraScript'));
		}
		
		//CALL AJAX
		add_action("wp_ajax_nopriv_pokamodule_ajax",    array('POKA_Controller', 'doAction'));
		add_action("wp_ajax_pokamodule_ajax",           array('POKA_Controller', 'doAction'));
		
		/*add_action('wp_login', array('POKA_Controller', 'designtoolActionNonce'));
		add_action('wp_logout',  array('POKA_Controller', 'designtoolActionNonce'));*/
		/*************** END HOOK ACTIONS ***************/
	}
	
	/*IMPORT CORE CLASS*/
	public function importCoreClass(){
		$aCoreClass = array(
			'PMCommon'           => 'class_common.php',
			'POKA_Controller'    => 'class_controller.php',
			'Poka_Widget'        => 'class_widget.php',
			'POKA_MetaBox'       => 'class_metabox.php',
		);
		
		foreach($aCoreClass as $key => $value){
			if(!class_exists($key)){
				require_once(_POKA_PLUGIN_PATH_ . "libraries/$value");
			}
		}
	}
}
<?php
	if(!class_exists('POKA_Controller')){
		class POKA_Controller{
			private $sPath = "";
			private $sPage = "";
			private $sTask = "";
			
			public function __construct(){
				$this->sPath = realpath(dirname(__FILE__));
				$this->sPage = PMCommon::trim_all(!empty($_REQUEST["page"]) ? trim($_REQUEST["page"]) : "");
				$this->sTask = PMCommon::trim_all(!empty($_REQUEST["task"]) ? trim($_REQUEST["task"]) : "");
			}
			
			/*PROCESS TASK*/
			public static function doAction($childTask = ""){
				$oTsController = new POKA_Controller;
				//IMPORT CURRENT CONTROLLER
				if(is_file(_POKA_PLUGIN_PATH_ . "components/" . $oTsController->sPage . "/" . $oTsController->sPage . ".php")){
					require_once(_POKA_PLUGIN_PATH_ . "components/" . $oTsController->sPage . "/" . $oTsController->sPage . ".php");
					
					$controllerName = PMCommon::convertCapitalizeString($oTsController->sPage, "-") . "Controller";
					
					$oController = new $controllerName;
					$oController->doAction();
				}else{
					echo "Class '" . $oTsController->sPage . ".php' not found.";
					exit();
				}
			}
			
			/*APPLY SHORTCODE ACTIONS*/
			/*Tham so com = page = ...*/
			public function doShortCode($atts = array(), $content = null, $tag = ''){
				$atts = array_change_key_case((array)$atts, CASE_LOWER);
				
				if(empty($atts['task'])){
					$atts['task'] = 'nothing';
				}
				if(empty($atts['com'])){
					$atts['com'] = '';
				}
				
				ob_start();
				//IMPORT CURRENT CONTROLLER
				if($atts['com'] != "" && is_file(_POKA_PLUGIN_PATH_ . "components/" . $atts["com"] . "/" . $atts["com"] . ".php")){
					require_once(_POKA_PLUGIN_PATH_ . "components/" . $atts["com"] . "/" . $atts["com"] . ".php");
					
					$controllerName = PMCommon::convertCapitalizeString($atts["com"], "-") . "Controller";
					$oController    = new $controllerName;
					$oController->doShortCode($atts);
				}else{
					echo "Attribute 'com' is incorrect or Class '" . $atts["com"] . ".php' not found.";
					exit();
				}
				
				return ob_get_clean();
			}
			
			/*LOAD LEFT MENU FOR ADMIN SITE*/
			public static function loadDashboardMenu(){
				if(function_exists('add_menu_page')){
					add_menu_page('Quản lý', 'Quản lý', 'edit_posts', 'pokamodule', array(
						'POKA_Controller',
						'doAction'
					), _POKA_PLUGIN_URL_ . 'images/pokamedia.png', 2);
					
					add_submenu_page('pokamodule', 'Cài Đặt', 'Cài Đặt', 'edit_posts', 'pokamodule-settings', array(
						'POKA_Controller',
						'doAction'
					));
					
					/*add_submenu_page('pokamodule', 'Cập nhật CSS & JS', 'Cập nhật CSS & JS', 'edit_posts', 'pokamodule-metascript', array(
						'POKA_Controller',
						'doAction'
					));*/
				}
			}
			
			/*LOAD HEADER CONTENT (CSS, JS...)*/
			public function loadHeader(){
				$ajax_nonce = wp_create_nonce('ajax-security-code');
				
				if(is_user_logged_in()){
					$sAjaxURL = "nopriv_"; // Authenticated actions
				}else{
					$sAjaxURL = ""; // Non-admin actions
				}
				$sAjaxURL = home_url() . "/wp-admin/admin-ajax.php?action=$sAjaxURL";
				
				echo "<script type='text/javascript'>
						/* <![CDATA[ */
						var MyAjax = {
							ajaxurl		  : '" . $sAjaxURL . "',
							security_code : '" . $ajax_nonce . "'
						};
						/* ]]> */
					</script>";
			}
			
			/*LOAD HEADER CONTENT (CSS, JS...)*/
			public function loadCustomScriptHeader(){
				echo stripcslashes(get_option("meta_script_head"));
			}
			
			/*LOAD AFTER BODY CONTENT (CSS, JS...)*/
			public function loadCustomScriptFooter(){
//				echo stripcslashes(get_option("meta_script_footer"));
				
				$call   = get_option( "_poka_number_call");
				if(!empty($call)){
					$html = '<div id="text-8">
							    <div class="textwidget">
							        <div class="zoomIn"></div>
							        <div class="pulse"></div>
							        <div class="tada"><a href="tel:'.$call.'"></a></div>
							    </div>
							</div>
							<div id="text-7">
								<a href="tel:'.$call.'"><img src="'._POKA_PLUGIN_URL_.'images/icon-phone.png">'.$call.'</a>
							</div>
							';
					
					echo $html;
				}
			}
			
			/*REGISTER EXTRA CSS & JS SCRIPTS*/
			public static function registerExtraScript(){
				$components = glob(_POKA_PLUGIN_COMPONENT_PATH_ . '*', GLOB_ONLYDIR);
				if(count($components)){
					foreach($components as $directory){
						$component = basename($directory);
						
						if(!empty($component)){
							if(is_file(_POKA_PLUGIN_PATH_ . "components/$component/js/$component.js")){
								wp_register_script($component, _POKA_PLUGIN_URL_ . "components/$component/js/$component.js", '', '', 'all');
							}
							if(is_file(_POKA_PLUGIN_PATH_ . "components/$component/css/$component.css")){
								wp_register_style($component, _POKA_PLUGIN_URL_ . "components/$component/css/$component.css", 'all');
							}
						}
					}
				}
				//End PLUGIN COMPONENTS
				
				//Start CORE PLUGIN
				if(is_admin()){
//					wp_enqueue_script('pokamodule-admin', _POKA_PLUGIN_URL_ . "js/admin.js", '', '', true);
//					wp_enqueue_style('pokamodule-admin', _POKA_PLUGIN_URL_ . 'css/admin_global.min.css', '', '', 'all');
				}else{
//					wp_enqueue_script('pokamodule-frontend', _POKA_PLUGIN_URL_ . "js/frontend.js", '', '', true);
					wp_enqueue_style('pokamodule-frontend', _POKA_PLUGIN_URL_ . 'css/frontend_global.min.css', '', '', 'all');
				}
				//End CORE PLUGIN
			}
		}
	}
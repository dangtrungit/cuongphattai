<?php
	class PokaModuleController{
		private $sPath = "";
		private $sSelfURL = "";
		private $sTask = "";
		private $sPage = "";
		private $sAdminEmail = "";
		private $aFieldsMap = array();
		private $aEmailHeader = array();
		private $aAdminEmailHeader = array();
		public $aAjaxAction = array();
		
		public function __construct(){
			$this->sPath       = realpath(dirname(__FILE__));
			//$this->sAdminEmail = get_option('admin_email');
			$this->sSelfURL    = PMCommon::getSelfURL("component");
			//$this->sTask       = PMCommon::trim_all(!empty($_REQUEST["task"]) ? trim($_REQUEST["task"]) : "");
			$this->sPage       = PMCommon::trim_all(!empty($_REQUEST["page"]) ? trim($_REQUEST["page"]) : "");
			
			//$this->aAjaxAction = array(/*"wp_ajax_nopriv_be_epm_sync_student"*/);
		}
		
		
		public function doAction(){
			$sTask = PMCommon::trim_all(!empty($_REQUEST["task"]) ? trim($_REQUEST["task"]) : "");
			
			switch($sTask){
				case "show":
				default:
					$this->showDashboard();
					break;
			}
		}
		
		private function showDashboard(){
			/*PMCommon::load_lib_css_js('semantic-ui/', 'semantic.min.css', 'css');
			PMCommon::load_lib_css_js('semantic-ui/', 'semantic.min.js', 'js');
			
			wp_enqueue_style('pokamodule');
			wp_enqueue_script('pokamodule');
			require_once $this->sPath . '/tpl/list-order/display.php';*/
		}
	}

?>
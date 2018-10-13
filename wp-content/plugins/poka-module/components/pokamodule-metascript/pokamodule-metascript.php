<?php
class PokamoduleMetascriptController {
	private $sPath 				= "";
	
	public function __construct() {
		$this->sPath = realpath(dirname(__FILE__));
    }
	
	
	public function doAction() {
		$sTask	= PMCommon::trim_all(!empty($_REQUEST["task"]) ? trim($_REQUEST["task"]) : "");
		switch($sTask) {
			case "save_change":
				$this->save_change();
			break;
			
			default:
				$this->showDashboard();
				break;
		}
	}
			
	private function showDashboard() {
		// LOAD LIBRARIES
		wp_enqueue_style('pokamodule-metascript');
		wp_enqueue_script('pokamodule-metascript');
        // END LOAD LIBRARIES
   
		require_once $this->sPath . '/tpl/metascript.php';
	}

	private function save_change(){
		$sFUpdate = PMCommon::trim_all(!empty($_REQUEST["f_data"]) ? trim($_REQUEST["f_data"]) : "");
		parse_str($sFUpdate, $aFUpdate);
		
		$meta_script_head   = !empty($aFUpdate["location-head"]) ? trim($aFUpdate["location-head"]) : "";
		$meta_script_footer = !empty($aFUpdate["location-footer"]) ? trim($aFUpdate["location-footer"]) : "";
		
		update_option("meta_script_head", $meta_script_head);
		update_option("meta_script_footer", $meta_script_footer);

		wp_die();
	}
}




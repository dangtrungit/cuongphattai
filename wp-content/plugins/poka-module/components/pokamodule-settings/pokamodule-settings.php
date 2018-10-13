<?php
class PokamoduleSettingsController {
	private $sPath 				= "";
	
	public function __construct() {
		$this->sPath = realpath(dirname(__FILE__));
    }
	
	
	public function doAction() {
		$sTask	= PMCommon::trim_all(!empty($_REQUEST["task"]) ? trim($_REQUEST["task"]) : "");
		switch($sTask) {
			default:
				$this->showDashboard();
				break;
		}
	}
			
	private function showDashboard() {
		wp_enqueue_style('pokamodule-settings');
		require_once $this->sPath . '/tpl/display.php';
	}
}




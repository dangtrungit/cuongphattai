<?php
	class PokaModuleShortcodeController{
		private $sPath = "";
		private $sSelfURL = "";
		private $sTask = "";
		private $sPage = "";
		private $sAdminEmail = "";
		private $sClassName = "";
		private $aFieldsMap = array();
		private $aEmailHeader = array();
		private $aAdminEmailHeader = array();
		public $aAjaxAction = array();
		
		public function __construct(){
			$this->sClassName  = __CLASS__;
			$this->sPath       = realpath(dirname(__FILE__));
			$this->sTask       = PMCommon::trim_all($_REQUEST["task"]);
			$this->sPage       = PMCommon::trim_all($_REQUEST["page"]);
		}
		
		/*Chay Shortode*/
		public function doShortCode($aAtts = array()){
			switch($aAtts["task"]){
				case "list-post": //Hien thi bai viet
					$this->showListPost($aAtts);
					break;
				case "order-product": //Dat Hang Nhanh
					$this->orderProduct($aAtts);
					break;
				case "nothing":
				default:
					echo "NOTHING";
					break;
			}
		}
		
		/*Chay Ajax*/
		public function doAction(){
			$sTask = PMCommon::trim_all($_REQUEST["task"]);
			
			switch($sTask){
				case "manager-image":
					$this->ajaxManagerImage();
					break;
				default:
					die("NOTHING");
					break;
			}
		}
		
		/*====================== DO SHORTCODE ======================*/
		//[pokamodule com="pokamodule-shortcode" task="list-post" category="related" thumbnail="1"]
		/*
		 * category         : related, all (Hien thi theo Category)
		 * ids              : 123,456,789 (Hien thi theo id bai viet)
		 * limit            : 10 - Default: 5 (So luong bai viet)
		 * class            : abc def (Dat Class)
		 * thumbnail        : 0 or 1 (Hien thi hinh anh)
		 * size_thumbnail   : thumbnail, medium, large, full, (150,150) - Default: thumbnail
		 * date             : 0 or 1 (Hien thi ngay viet)
		 * author           : 0 or 1 (Hien thi tac gia)
		 * category         : 0 or 1 (Hien thi danh sach chuyen muc)
		 * descrition       : 0 or 1 (Hien thi mo ta)
		 * number_descrition: 200 - Default: 150
		 * dots             : 0 or 1 (Hien thi dau ...)
		 * view_more        : 0 or 1 (Hien thi nut xem them)
		 */
		private function showListPost($aAtts = array()){
			$post_category     = isset($aAtts['category'])          ? $aAtts['category'] : '';
			$post_limit        = isset($aAtts['limit'])             ? $aAtts['limit'] : 5;
			$post_ids          = isset($aAtts['ids'])               ? $aAtts['ids'] : '';
			$class             = isset($aAtts['class'])             ? trim($aAtts['class']) : '';
			$show_thumbnail    = isset($aAtts['thumbnail'])         ? intval($aAtts['thumbnail']) : 0;
			$size_thumbnail    = isset($aAtts['size_thumbnail'])    ? $aAtts['size_thumbnail'] : 'medium';
			$show_date         = isset($aAtts['date'])              ? intval($aAtts['date']) : 0;
			$show_author       = isset($aAtts['author'])            ? intval($aAtts['author']) : 0;
			$show_category     = isset($aAtts['category'])          ? intval($aAtts['category']) : 0;
			$show_descrition   = isset($aAtts['descrition'])        ? intval($aAtts['descrition']) : 0;
			$number_descrition = isset($aAtts['number_descrition']) ? intval($aAtts['number_descrition']) : 150;
			$show_dots         = isset($aAtts['dots'])              ? intval($aAtts['dots']) : '';
			$view_more         = isset($aAtts['view_more'] )        ? intval($aAtts['view_more']) : 0;
			require_once $this->sPath . '/tpl/post/list-post.php';
		}
		
		//[pokamodule com="pokamodule-shortcode" task="order-product"]
		private function orderProduct($aAtts = array()){
			$productID = $_GET['order-product'];
			if($productID > 0){
				PMCommon::load_lib_css_js('pokamodule-shortcode/css/', 'order-product.min.css', 'css', 'components');
				require_once $this->sPath . '/tpl/product/order-product.php';
			}
		}
		
		
		/*====================== DO ACTION ======================*/
		private function ajaxManagerImage(){
			check_ajax_referer('ajax-security-code', 'security');
			
			$html = '<div class="poka-popup">aaaaaaa</div>';
			echo json_encode($html);
			
			die();
		}
	}

?>
<?php
	class PMCommon{
		//Returns the url of the plugin's root folder
		public static function get_base_url(){
			$folder = basename(dirname(__FILE__));
			return plugins_url($folder);
		}
		
		//load lib
		public static function load_lib_css_js($folder = '', $file = '', $type = '', $folderLib = "assets"){
			$folder_url = ( $folderLib == "assets" ) ? _POKA_PLUGIN_ASSET_URL_ : _POKA_PLUGIN_COMPONENT_URL_;
			
			
			$resultUrl = $folder_url . $folder . $file;
			
			if($type == 'css'){
				$name = str_replace(".min.css", "", $file) . '-css';
				wp_enqueue_style('poka_load_' . $name, $resultUrl);
			}
			
			if($type == 'js'){
				$name = str_replace(".min.js", "", $file) . '-js';
				wp_enqueue_script('poka_load_' . $name, $resultUrl, array('jquery'), '', true);
			}
		}
		
		//load assets
		public static function load_assets_css_js($folder = '', $file = '', $type = ''){
			if($type == 'css'){
				$name = str_replace(".min.css", "", $file) . '-css';
				wp_enqueue_style('poka_load_' . $name, _POKA_PLUGIN_ASSET_URL_ . $folder . $file);
			}
			
			if($type == 'js'){
				$name = str_replace(".min.js", "", $file) . '-js';
				wp_enqueue_script('poka_load_' . $name, _POKA_PLUGIN_ASSET_URL_ . $folder . $file, array('jquery'), '', true);
			}
		}
		
		//Get Msg BackEnd
		public static function getMsgBE($arr = array(), $type = 'success'){
			$html = "";
			if(count($arr) > 0){
				$classMsg = 'updated-message notice-success';
				
				if($type == 'error'){
					$classMsg = 'notice-error';
				}
				
				if($type == 'warning'){
					$classMsg = 'notice-warning';
				}
				
				$html = '<div class="update update-message notice is-dismissible inline ' . $classMsg . '">';
				foreach($arr as $key => $value){
					if(!empty($value)){
						$html .= '<p><strong> ' . $value . '</strong></p>';
					}
				}
				$html .= '</div>';
			}
			return $html;
		}
		
		/*
		 wp_enqueue_media(); //Post, Page, Category khong can keo
		 wp_enqueue_script( 'single-upload-media-script', _POKA_PLUGIN_URL_ . "js/upload-media/multiple_upload_media.js" , '', '', true );
		
		 $nameFile = 'anh_sanpham';
		 $idImage = 123;
		 echo PMCommon::getHtmlImageMultiple( $nameFile, $idImage);
		*/
		public static function getHtmlImageMultiple($name, $value = array()){
			$image_size = 'thumbnail'; // it would be better to use thumbnail size here (150x150 or so)
			
			if(is_array($value) && count($value) > 0){
				$list_attachment = "";
				foreach($value as $key => $val){
					if($image_attributes = wp_get_attachment_image_src($val["id"], $image_size)){
						// $image_attributes[0] - image URL
						// $image_attributes[1] - image width
						// $image_attributes[2] - image height
						$list_attachment .= '<li class="image ui-sortable-handle" data-attachment_id="' . $val["id"] . '">
								          <img style="max-width:100%;" src="' . $image_attributes[0] . '" />
								          <input type="hidden" name="' . $name . '[' . $key . '][id]" value="' . $val["id"] . '">
								            <input type="text" name="' . $name . '[' . $key . '][url]" class="link_redirect" placeholder="Redirect ..." value="' . $val["url"] . '">
								          <i title="Delete image" class="poka-btn-remove-image fa fa-times" aria-hidden="true"></i>
								         </li>';
					}
				}
				
				return '
			      <div>
			         <div class="poka_images_container">
			                <ul class="product_images sortable " id="sortable">' . $list_attachment . '</ul>
			         </div>
			         <a href="#" data-gallery-name="' . $name . '" class="poka_upload_image_button">Upload/Add images</a>
			      </div>';
			}else{
				return "";
			}
		}
		
		/*
		    wp_enqueue_media(); //Post, Page, Category khong can keo
		    wp_enqueue_script( 'single-upload-media-script', _POKA_PLUGIN_URL_ . "js/upload-media/single_upload_media.js" , '', '', true );
		
		    $nameFile = 'anh_sanpham';
			$idImage = 123;
		    $htmlImage = PMCommon::getHtmlImageSingle($nameFile, $idImage);
		 */
		public static function getHtmlImageSingle( $name, $value = '') {
			$image      = ' button">Upload image';
			$image_size = 'thumbnail'; // it would be better to use thumbnail size here (150x150 or so)
			$display = 'none'; // display state ot the "Remove image" button
			
			if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
				// $image_attributes[0] - image URL
				// $image_attributes[1] - image width
				// $image_attributes[2] - image height
				
				$image = '"><img src="' . $image_attributes[0] . '" style="display:block;" />';
				$display = 'inline-block';
				
			}
			
			return '
			      <div style="display: inline-block">
			          <a href="#" data-type-file="image" class="misha_upload_image_button' . $image . '</a>
			          <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
			          <a href="#" class="misha_remove_image_button button" style="display:inline-block;display:' . $display . '">Remove image</a>
			      </div>';
		}
		
		/*
		    wp_enqueue_media(); //Post, Page, Category khong can keo
			wp_enqueue_script( 'single-upload-media-script', _POKA_PLUGIN_URL_ . "js/upload-media/upload-file.js" , '', '', true );
		    $nameFile = 'anh_sanpham';
			$idImage = 123;
		    $htmlImage = PMCommon::getHtmlFile($nameFile, $idImage);
		 * */
		public static function getHtmlFile( $name, $value = '') {
			$display = 'none'; // display state ot the "Remove image" button
			
			if( $file_attributes = wp_get_attachment_url( $value ) ) {
				// $image_attributes[0] - image URL
				$file =  $file_attributes;
				$display = 'inline-block';
				
			}
			return '
			      <div>
			          <input type="text" data-type-file="application/msword" class="misha_upload_image_button" placeholder="Click to upload file" style="width: 78.5%;" value="'. $file .'"/>
			          <input type="hidden"name="' . $name . '" id="' . $name . '" value="' . $value . '" />
			          <span href="#" class="misha_remove_file_button button button-primary" style="display:inline-block;display:' . $display . '">Xóa</span>
			      </div>';
		}
	
		//Lay duong dan hien tai URL
		public static function getSelfURL(){
			$pageURL = 'http';
			if($_SERVER["HTTPS"] == "on"){
				$pageURL .= "s";
			}
			$pageURL .= "://";
			if($_SERVER["SERVER_PORT"] != "80"){
				$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
			}else{
				$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
			}
			
			return $pageURL;
		}
		
		/*
		 $totalItems;					// Tổng số phần tử
		 $totalItemsPerPagePram		= 5;	// Tổng số phần tử xuất hiện trên một trang
		 $pageRangePram				= 3;	// Số trang xuất hiện
		 $arrSearch = array(          //Noi tu Search
			'id' => 1,
		    'name' => 'abc
		)
		 */
		public static function showPagination($totalItems, $totalItemsPerPagePram = 5, $pageRangePram = 3, $arrSearch = array()){
			$totalItems             = $totalItems;
			$totalItemsPerPage		= $totalItemsPerPagePram;
			$pageRange              = $pageRangePram;
			$totalPage              = ceil($totalItems/$totalItemsPerPage);
			$currentPage			= isset($_GET['pages']) ? $_GET['pages'] : '1';
			
			$stringSearch = '';
			if(count($arrSearch) > 0){
				foreach ($arrSearch as $keySearch => $valueSearch){
					if(!empty($valueSearch)){
						$stringSearch .= "&". $keySearch . "=" . urlencode($valueSearch);
					}
				}
			}
			
			$paginationHTML = '';
			if($totalPage > 1){
				$start = '';
				$prev = '';
				if($currentPage > 1){
					if(empty($stringSearch)){
						$start 	= '<li class="start"><a href="?pages=1">Đầu tiên</a></li>';
						$prev 	= '<li class="previous"><a href="?pages='.($currentPage-1).'">Trước</a></li>';
					}else{
						$start 	= '<li class="start"><a href="?pages=1'.$stringSearch.'">Đầu tiên</a></li>';
						$prev 	= '<li class="previous"><a href="?pages='.($currentPage-1).$stringSearch.'">Trước</a></li>';
					}
				}
				
				$next = '';
				$end = '';
				if($currentPage < $totalPage){
					if(empty($stringSearch)){
						$next 	= '<li class="next"><a href="?pages='.($currentPage + 1).'">Kế tiếp</a></li>';
						$end 	= '<li class="end"><a href="?pages='.$totalPage.'">Cuối cùng</a></li>';
					}else{
						$next 	= '<li class="next"><a href="?pages='.($currentPage + 1) . $stringSearch.'">Kế tiếp</a></li>';
						$end 	= '<li class="end"><a href="?pages='.$totalPage . $stringSearch.'">Cuối cùng</a></li>';
					}
				}
				
				if($pageRange < $totalPage){
					if($currentPage == 1){
						$startPage  = 1;
						$endPage    = $pageRange;
					}else if($currentPage == $totalPage){
						$startPage	= $totalPage - $pageRange + 1;
						$endPage	= $totalPage;
					}else{
						$startPage	= $currentPage - ($pageRange - 1)/2;
						$endPage	= $currentPage + ($pageRange - 1)/2;
						
						if($startPage < 1){
							$endPage = $endPage + 1;
							$startPage = 1;
						}
						
						if($endPage > $totalPage){
							$endPage = $totalPage;
							$startPage = $endPage - $pageRange + 1;
						}
					}
				}else{
					$startPage	= 1;
					$endPage	= $totalPage;
				}
				
				$listPages = '';
				for($iTmp = $startPage; $iTmp <= $endPage; $iTmp++){
					if($iTmp == $currentPage) {
						$listPages .= '<li class="active">'.$iTmp.'</li>';
					}else{
						if(empty($stringSearch)){
							$listPages .= '<li class="item"><a href="?pages='.$iTmp.'">'.$iTmp.'</a></li>';
						}else{
							$listPages .= '<li class="item"><a href="?pages='.$iTmp. $stringSearch.'">'.$iTmp.'</a></li>';
						}
					}
				}
				
				$paginationHTML = '<div class="poka-pagination">
							   		<ul>' . $start . $prev . $listPages . $next . $end  . '</ul>
							   	   </div>
							   	   <div class="clear"></div>
							   	   ';
			}
			
			return $paginationHTML;
		}
		
		/*==========================Start Upload File*/
		public static function upload_document($valueFile, $valueNameFile, $typeUpload = "image"){
			$arrIDResultUp    = array();                        /*Dữ liệu upload nên*/
			$arrImageIDDB     = $valueFile['imageDB'];          /*Array ID dữ liệu có trong database*/
			$arrImageIDDelete = $valueFile['imageDelete'];      /*Array ID dữ liệu  muốn xóa*/
			
			$arrError = array();
			
			if(!empty($valueFile['file']) && count($valueFile['file']) > 0){
				if($typeUpload == 'image'){
					$arrFileExt = array(
						'gif', 'jpeg', 'png', 'jpg'
					);
					
					$arrFileExtType = array(
						'image/jpeg', 'image/png', 'image/jpeg', 'image/gif'
					);
				}
				
				if($typeUpload == 'document'){
					$arrFileExt = array(
						'gif', 'jpeg', 'png', 'jpg', 'docx', 'pdf', 'xlsx', 'xls', 'doc'
					);
					
					$arrFileExtType = array(
						'image/jpeg', 'image/png', 'image/jpeg', 'image/gif',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						'application/pdf',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
						'application/vnd.ms-excel',
						'application/msword'
					);
				}
				
				$arrUpName     = $valueFile['file'][ $valueNameFile ]['name'];
				$arrUpType     = $valueFile['file'][ $valueNameFile ]['type'];
				$arrUpTypeName = $valueFile['file'][ $valueNameFile ]['tmp_name'];
				$arrUpError    = $valueFile['file'][ $valueNameFile ]['error'];
				$arrUpSize     = $valueFile['file'][ $valueNameFile ]['size'];
				
				if(is_array($arrUpName)){
					/*
					 * Upload Nhiều File
					 */
					foreach($arrUpName as $keyUp => $valueUp){
						$arrFiles = array();
						if(!empty($valueUp)){
							$arrFiles['name']     = $arrUpName[ $keyUp ];
							$arrFiles['type']     = $arrUpType[ $keyUp ];
							$arrFiles['tmp_name'] = $arrUpTypeName[ $keyUp ];
							$arrFiles['error']    = $arrUpError[ $keyUp ];
							$arrFiles['size']     = $arrUpSize[ $keyUp ];
							
							if(((int)$arrFiles['size']/1024) < 10024){
								if(function_exists('mime_content_type')){
									if(!empty($arrUpTypeName[$keyUp])){
										$mimetype = mime_content_type($arrUpTypeName[$keyUp]);
										if(in_array($mimetype, $arrFileExtType )) {
											$attachmentID         = self::upload_file($arrFiles);
											if($attachmentID > 0){
												$arrIDResultUp[] = $attachmentID;
											}
										}
									}
								}else{
									$fileName = $arrUpName[$keyUp];
									$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
									
									if(in_array($fileExt, $arrFileExt)){
										$attachmentID         = self::upload_file($arrFiles);
										
										if($attachmentID > 0){
											$arrIDResultUp[] = $attachmentID;
										}
									}
								}
							}
						}
					}
				}else{
					/*
					 * Upload Một File
					 */
					if(!empty($arrUpName)){
						$fileName = $arrUpName;
						$fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
						
						if(((int)$arrUpSize/1024) < 10024){
							if(function_exists('mime_content_type')) {
								$mimetype = mime_content_type($arrUpTypeName);
								
								if(in_array($mimetype, $arrFileExtType )) {
									$attachmentID = self::upload_file($valueFile['file'][$valueNameFile]);
									
									if($attachmentID > 0){
										$arrIDResultUp[] = $attachmentID;
									}
								}
							}else{
								if(in_array($fileExt, $arrFileExt)){
									$attachmentID = self::upload_file($valueFile['file'][$valueNameFile]);
									
									if($attachmentID > 0){
										$arrIDResultUp[] = $attachmentID;
									}
								}
							}
						}
					}
				}
			}
			
			/*
			 * Nếu Array ID dữ liệu trong Database tồn tại
			 * Nếu người dùng chọn Araay ID dữ liệu muốn xóa trong Database
			 */
			if(
				(!empty($arrImageIDDB)      && count($arrImageIDDB) > 0) &&
				(!empty($arrImageIDDelete)  && count($arrImageIDDelete) > 0)
			){
				foreach($arrImageIDDB as $keyDB => $valueDB){
					if(in_array($valueDB, $arrImageIDDelete)){
						self::remove_all_size_images($valueDB);
						unset($arrImageIDDB[$keyDB]);
					}
				}
			}
			
			if(
				(!empty($arrIDResultUp) && count($arrIDResultUp) > 0) &&
				(!empty($arrImageIDDB)  && count($arrImageIDDB) > 0)
			){
				return @array_merge($arrIDResultUp, $arrImageIDDB);
			}else{
				if(!empty($arrIDResultUp) && count($arrIDResultUp) > 0){
					return $arrIDResultUp;
				}
				
				if(!empty($arrImageIDDB) && count($arrImageIDDB) > 0){
					return $arrImageIDDB;
				}
			}
		}
		
		public function upload_file($file = array()){
			require_once(ABSPATH . 'wp-admin/includes/admin.php');
			$file_return = wp_handle_upload($file, array('test_form' => false));
			if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){
				return false;
			} else{
				$filename      = $file_return['file'];
				$attachment    = array(
					'post_mime_type' => $file_return['type'],
					'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
					'post_content'   => '',
					'post_status'    => 'inherit',
					'guid'           => $file_return['url']
				);
				$attachment_id = wp_insert_attachment($attachment, $file_return['url']);
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				$attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
				wp_update_attachment_metadata($attachment_id, $attachment_data);
				if(0 < intval($attachment_id)){
					return $attachment_id;
				}
			}
			
			return false;
		}
	
		public static function poka_get_home_path() {
			$home    = set_url_scheme( get_option( 'home' ), 'http' );
			$siteurl = set_url_scheme( get_option( 'siteurl' ), 'http' );
			
			if ( ! empty( $home ) && 0 !== strcasecmp( $home, $siteurl ) ) {
				$wp_path_rel_to_home = str_ireplace( $home, '', $siteurl ); /* $siteurl - $home */
				$pos = strripos( str_replace( '\\', '/', $_SERVER['SCRIPT_FILENAME'] ), trailingslashit( $wp_path_rel_to_home ) );
				$home_path = substr( $_SERVER['SCRIPT_FILENAME'], 0, $pos );
				$home_path = trailingslashit( $home_path );
			} else {
				$home_path = ABSPATH;
			}
			
			return str_replace( '\\', '/', $home_path );
		}
		
		public static function remove_all_size_images($id){
			$arrFileExt = array(
				'gif', 'jpeg', 'png', 'jpg'
			);
			
			$ext = pathinfo(wp_get_attachment_url($id), PATHINFO_EXTENSION);
			
			if(in_array($ext, $arrFileExt)){
				foreach(get_intermediate_image_sizes() as $key => $value){
					$image = wp_get_attachment_image_src($id, $value);
					
					if(!empty($image)){
						$pathRooot = substr(self::poka_get_home_path(), 0,strlen(self::poka_get_home_path()) - 1);
						$imagepath = str_replace(get_site_url(), $pathRooot, $image[0]);
						
						if(file_exists($imagepath)) {
							@unlink($imagepath);
						}
					}
				}
			}
			wp_delete_attachment($id, true);
		}
		/*===============================End Upload File*/
		
		//Check Url
		public static function is_valid_url($url){
			return preg_match('!^(http|https)://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?$!', $url);
		}
		
		//Check Email
		public static function is_valid_email($email){
			return preg_match('/^(([a-zA-Z0-9_.\-+!#$&\'*+=?^`{|}~])+\@((([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+|localhost) *,? *)+$/', $email);
		}
		
		//Check Number
		public static function is_numeric($value, $number_format = ""){
			switch($number_format){
				case "decimal_dot" :
					return preg_match("/^(-?[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]+)?)$/", $value);
					break;
				case "decimal_comma" :
					return preg_match("/^(-?[0-9]{1,3}(?:\.?[0-9]{3})*(?:,[0-9]+)?)$/", $value);
					break;
				default :
					return preg_match("/^(-?[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]{2})?)$/", $value) || preg_match("/^(-?[0-9]{1,3}(?:\.?[0-9]{3})*(?:,[0-9]{2})?)$/", $value);
				
			}
		}
		
		//Xoa tat ca khoang trang
		public static function trim_all($text){
			$text = trim($text);
			do{
				$prev_text = $text;
				$text      = str_replace("  ", " ", $text);
			}while($text != $prev_text);
			
			return $text;
		}
		
		function send_email($from, $to, $bcc, $reply_to, $subject, $message, $from_name = "", $message_format = "html"){
			//invalid to email address or no content. can't send email
			if(!PMCommon::is_valid_email($to) || (empty($subject) && empty($message))){
				return;
			}
			
			if(!PMCommon::is_valid_email($from)){
				$from = get_bloginfo("admin_email");
			}
			
			//invalid from address. can't send email
			if(!PMCommon::is_valid_email($from)){
				return;
			}
			
			$content_type = $message_format == "html" ? "text/html" : "text/plain";
			
			$name    = empty($from_name) ? $from : $from_name;
			$headers = "From: \"$name\" <$from> \r\n";
			$headers .= PMCommon::is_valid_email($reply_to) ? "Reply-To: $reply_to\r\n" : "";
			$headers .= PMCommon::is_valid_email($bcc) ? "Bcc: $bcc\r\n" : "";
			$headers .= "Content-type: {$content_type}; charset=" . get_option('blog_charset') . "\r\n";
			
			$result = wp_mail($to, $subject, $message, $headers);
		}
	
		//Xoa bo duong dan va cac thu muc, file ben trong
		public static function delete_directory($dirname){
			if(is_dir($dirname)){
				$dir_handle = opendir($dirname);
			}
			if(!$dir_handle){
				return false;
			}
			while($file = readdir($dir_handle)){
				if($file != "." && $file != ".."){
					if(!is_dir($dirname . "/" . $file)){
						unlink($dirname . "/" . $file);
					}else{
						self::delete_directory($dirname . '/' . $file);
					}
				}
			}
			closedir($dir_handle);
			rmdir($dirname);
			
			return true;
		}
		
		public static function getMimeType($file){
			// MIME types array
			$mimeTypes = array(
				"323"     => "text/h323",
				"acx"     => "application/internet-property-stream",
				"ai"      => "application/postscript",
				"aif"     => "audio/x-aiff",
				"aifc"    => "audio/x-aiff",
				"aiff"    => "audio/x-aiff",
				"asf"     => "video/x-ms-asf",
				"asr"     => "video/x-ms-asf",
				"asx"     => "video/x-ms-asf",
				"au"      => "audio/basic",
				"avi"     => "video/x-msvideo",
				"axs"     => "application/olescript",
				"bas"     => "text/plain",
				"bcpio"   => "application/x-bcpio",
				"bin"     => "application/octet-stream",
				"bmp"     => "image/bmp",
				"c"       => "text/plain",
				"cat"     => "application/vnd.ms-pkiseccat",
				"cdf"     => "application/x-cdf",
				"cer"     => "application/x-x509-ca-cert",
				"class"   => "application/octet-stream",
				"clp"     => "application/x-msclip",
				"cmx"     => "image/x-cmx",
				"cod"     => "image/cis-cod",
				"cpio"    => "application/x-cpio",
				"crd"     => "application/x-mscardfile",
				"crl"     => "application/pkix-crl",
				"crt"     => "application/x-x509-ca-cert",
				"csh"     => "application/x-csh",
				"css"     => "text/css",
				"dcr"     => "application/x-director",
				"der"     => "application/x-x509-ca-cert",
				"dir"     => "application/x-director",
				"dll"     => "application/x-msdownload",
				"dms"     => "application/octet-stream",
				"doc"     => "application/msword",
				"dot"     => "application/msword",
				"dvi"     => "application/x-dvi",
				"dxr"     => "application/x-director",
				"eps"     => "application/postscript",
				"etx"     => "text/x-setext",
				"evy"     => "application/envoy",
				"exe"     => "application/octet-stream",
				"fif"     => "application/fractals",
				"flr"     => "x-world/x-vrml",
				"gif"     => "image/gif",
				"gtar"    => "application/x-gtar",
				"gz"      => "application/x-gzip",
				"h"       => "text/plain",
				"hdf"     => "application/x-hdf",
				"hlp"     => "application/winhlp",
				"hqx"     => "application/mac-binhex40",
				"hta"     => "application/hta",
				"htc"     => "text/x-component",
				"htm"     => "text/html",
				"html"    => "text/html",
				"htt"     => "text/webviewhtml",
				"ico"     => "image/x-icon",
				"ief"     => "image/ief",
				"iii"     => "application/x-iphone",
				"ins"     => "application/x-internet-signup",
				"isp"     => "application/x-internet-signup",
				"jfif"    => "image/pipeg",
				"jpe"     => "image/jpeg",
				"jpeg"    => "image/jpeg",
				"jpg"     => "image/jpeg",
				"js"      => "application/x-javascript",
				"latex"   => "application/x-latex",
				"lha"     => "application/octet-stream",
				"lsf"     => "video/x-la-asf",
				"lsx"     => "video/x-la-asf",
				"lzh"     => "application/octet-stream",
				"m13"     => "application/x-msmediaview",
				"m14"     => "application/x-msmediaview",
				"m3u"     => "audio/x-mpegurl",
				"man"     => "application/x-troff-man",
				"mdb"     => "application/x-msaccess",
				"me"      => "application/x-troff-me",
				"mht"     => "message/rfc822",
				"mhtml"   => "message/rfc822",
				"mid"     => "audio/mid",
				"mny"     => "application/x-msmoney",
				"mov"     => "video/quicktime",
				"movie"   => "video/x-sgi-movie",
				"mp2"     => "video/mpeg",
				"mp3"     => "audio/mpeg",
				"mpa"     => "video/mpeg",
				"mpe"     => "video/mpeg",
				"mpeg"    => "video/mpeg",
				"mpg"     => "video/mpeg",
				"mpp"     => "application/vnd.ms-project",
				"mpv2"    => "video/mpeg",
				"ms"      => "application/x-troff-ms",
				"mvb"     => "application/x-msmediaview",
				"nws"     => "message/rfc822",
				"oda"     => "application/oda",
				"p10"     => "application/pkcs10",
				"p12"     => "application/x-pkcs12",
				"p7b"     => "application/x-pkcs7-certificates",
				"p7c"     => "application/x-pkcs7-mime",
				"p7m"     => "application/x-pkcs7-mime",
				"p7r"     => "application/x-pkcs7-certreqresp",
				"p7s"     => "application/x-pkcs7-signature",
				"pbm"     => "image/x-portable-bitmap",
				"pdf"     => "application/pdf",
				"pfx"     => "application/x-pkcs12",
				"pgm"     => "image/x-portable-graymap",
				"pko"     => "application/ynd.ms-pkipko",
				"pma"     => "application/x-perfmon",
				"pmc"     => "application/x-perfmon",
				"pml"     => "application/x-perfmon",
				"pmr"     => "application/x-perfmon",
				"pmw"     => "application/x-perfmon",
				"pnm"     => "image/x-portable-anymap",
				"pot"     => "application/vnd.ms-powerpoint",
				"ppm"     => "image/x-portable-pixmap",
				"pps"     => "application/vnd.ms-powerpoint",
				"ppt"     => "application/vnd.ms-powerpoint",
				"prf"     => "application/pics-rules",
				"ps"      => "application/postscript",
				"pub"     => "application/x-mspublisher",
				"qt"      => "video/quicktime",
				"ra"      => "audio/x-pn-realaudio",
				"ram"     => "audio/x-pn-realaudio",
				"ras"     => "image/x-cmu-raster",
				"rgb"     => "image/x-rgb",
				"rmi"     => "audio/mid",
				"roff"    => "application/x-troff",
				"rtf"     => "application/rtf",
				"rtx"     => "text/richtext",
				"scd"     => "application/x-msschedule",
				"sct"     => "text/scriptlet",
				"setpay"  => "application/set-payment-initiation",
				"setreg"  => "application/set-registration-initiation",
				"sh"      => "application/x-sh",
				"shar"    => "application/x-shar",
				"sit"     => "application/x-stuffit",
				"snd"     => "audio/basic",
				"spc"     => "application/x-pkcs7-certificates",
				"spl"     => "application/futuresplash",
				"src"     => "application/x-wais-source",
				"sst"     => "application/vnd.ms-pkicertstore",
				"stl"     => "application/vnd.ms-pkistl",
				"stm"     => "text/html",
				"svg"     => "image/svg+xml",
				"sv4cpio" => "application/x-sv4cpio",
				"sv4crc"  => "application/x-sv4crc",
				"t"       => "application/x-troff",
				"tar"     => "application/x-tar",
				"tcl"     => "application/x-tcl",
				"tex"     => "application/x-tex",
				"texi"    => "application/x-texinfo",
				"texinfo" => "application/x-texinfo",
				"tgz"     => "application/x-compressed",
				"tif"     => "image/tiff",
				"tiff"    => "image/tiff",
				"tr"      => "application/x-troff",
				"trm"     => "application/x-msterminal",
				"tsv"     => "text/tab-separated-values",
				"txt"     => "text/plain",
				"uls"     => "text/iuls",
				"ustar"   => "application/x-ustar",
				"vcf"     => "text/x-vcard",
				"vrml"    => "x-world/x-vrml",
				"wav"     => "audio/x-wav",
				"wcm"     => "application/vnd.ms-works",
				"wdb"     => "application/vnd.ms-works",
				"wks"     => "application/vnd.ms-works",
				"wmf"     => "application/x-msmetafile",
				"wps"     => "application/vnd.ms-works",
				"wri"     => "application/x-mswrite",
				"wrl"     => "x-world/x-vrml",
				"wrz"     => "x-world/x-vrml",
				"xaf"     => "x-world/x-vrml",
				"xbm"     => "image/x-xbitmap",
				"xla"     => "application/vnd.ms-excel",
				"xlc"     => "application/vnd.ms-excel",
				"xlm"     => "application/vnd.ms-excel",
				"xls"     => "application/vnd.ms-excel",
				"xlsx"    => "vnd.ms-excel",
				"xlt"     => "application/vnd.ms-excel",
				"xlw"     => "application/vnd.ms-excel",
				"xof"     => "x-world/x-vrml",
				"xpm"     => "image/x-xpixmap",
				"xwd"     => "image/x-xwindowdump",
				"z"       => "application/x-compress",
				"zip"     => "application/zip"
			);
			
			$extension = end(explode('.', $file));
			
			return $mimeTypes[ $extension ]; // return the array value
		}
		
		//RandomString
		function generateRandomString($length = 10){
			$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString     = '';
			for($i = 0; $i < $length; $i ++){
				$randomString .= $characters[ rand(0, $charactersLength - 1) ];
			}
			
			return $randomString;
		}
		
		public static function convertCapitalizeString($sString = "", $sDelimiter = " ", $nSkip = - 1){
			if(!empty($sDelimiter) && !empty($sString)){
				$aString = explode($sDelimiter, $sString);
				
				if(count($aString)){
					for($i = 0; $i < count($aString); $i ++){
						if($nSkip >= 0 && $nSkip = $i){
							continue;
						}
						
						$aString[ $i ] = ucfirst($aString[ $i ]);
					}
				}
				
				return implode("", $aString);
			}
		}
	}
?>
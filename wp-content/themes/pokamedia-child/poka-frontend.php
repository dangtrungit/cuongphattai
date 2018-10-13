<?php
	add_action('wp_enqueue_scripts', 'add_css_js_file');
	function add_css_js_file(){
		$url = get_stylesheet_directory_uri();

		wp_register_style('load-font-awesome',  $url . '/poka/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style('load-font-awesome');
	}
	
	function storefront_credit() {
		echo 'Bản quyền thuộc về ' . get_bloginfo( 'name' ) . '<span class="sep"> | </span> Thiết kế website bởi <a target="_blank" href="http://thietkewebwp.vn/" rel="no_folow">POKA MEDIA</a>';
	}
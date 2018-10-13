<?php
	new POKA_MetaBox_Category();
	class POKA_MetaBox_Category {
		public function __construct() {
			 add_action ( 'category_edit_form_fields', array($this, 'edit'));
			 add_action ( 'edited_category',           array($this, 'save'));
			 add_action ( 'category_add_form_fields',  array($this, 'add'));
			 add_action ( 'created_category',          array($this, 'save'));
		}
		
		public function add(){
			wp_enqueue_style('poka_metabox_category');
			wp_enqueue_script('poka_metabox_category');
		}
		
		public function edit(){
			wp_enqueue_style('poka_metabox_category');
			wp_enqueue_script('poka_metabox_category');
		}
		
		public function save($term_id){
		}
	}
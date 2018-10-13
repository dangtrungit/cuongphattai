<?php
	//Yoast SEO
	add_filter( 'manage_edit-post_columns', 'poka_admin_remove_columns', 10, 1 );
	add_filter( 'manage_edit-page_columns', 'poka_admin_remove_columns', 10, 1 );

	function poka_admin_remove_columns( $columns ) {
		unset($columns['wpseo-score']);
		unset($columns['wpseo-score-readability']);
		unset($columns['wpseo-title']);
		unset($columns['wpseo-metadesc']);
		unset($columns['wpseo-focuskw']);
		unset($columns['wpseo-links']);
		unset($columns['wpseo-linked']);
		return $columns;
	}

	add_action( 'admin_init', 'poka_remove_yoast_seo_posts_filter', 15 );
	function poka_remove_yoast_seo_posts_filter() {
		global $wpseo_meta_columns;

		if($wpseo_meta_columns){
			remove_action('restrict_manage_posts', array($wpseo_meta_columns, 'posts_filter_dropdown'));
			remove_action('restrict_manage_posts', array($wpseo_meta_columns, 'posts_filter_dropdown_readability'));
		}
	}
	
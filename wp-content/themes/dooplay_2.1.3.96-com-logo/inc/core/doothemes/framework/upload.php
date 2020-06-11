<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.3
*
*/

if (!function_exists('dtfr_upload_image') || !function_exists('dtfr_remove_image')) {

	// Upload and save option
	add_action('wp_ajax_dtfr_ajax_upload', 'dtfr_upload_image');
    function dtfr_upload_image() {
		$id = $_POST['data'];
		$url = $_POST['url'];
		if( isset($id) and isset($url) ) {
			update_option($id, $url);
		}
        die();
    }

	// Delete options
    add_action('wp_ajax_dtfr_ajax_remove', 'dtfr_remove_image');
    function dtfr_remove_image() {
        $id = $_POST['data'];
		if(isset($id)) {
			update_option($id, '');
        }
		die();
    }

}

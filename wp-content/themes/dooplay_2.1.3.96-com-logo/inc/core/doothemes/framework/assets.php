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

function doothemes_framework_scripts() {
    if( is_admin() AND isset($_GET['page']) AND $_GET['page'] == DOO_THEME_SLUG ) {
		wp_enqueue_media();
		wp_enqueue_style('dt_framework_css',	DOO_URI .'/inc/core/doothemes/framework/assets/style.css' , array(), DOO_VERSION, 'all');
		wp_enqueue_script('dt_main_js',			DOO_URI .'/inc/core/doothemes/framework/assets/scripts.js' , array(), DOO_VERSION, false );
		wp_enqueue_script('dt_color_picker',	DOO_URI. '/inc/core/doothemes/framework/assets/color.js', array('jquery','wp-color-picker','thickbox'), false, true );
		wp_enqueue_style('wp-color-picker' );
		wp_enqueue_style('wp-jquery-ui-dialog' );
		wp_enqueue_script('wp-color-picker' );
		wp_enqueue_script('jquery-ui-dialog' );
		wp_enqueue_script('jquery-ui-sortable' );
		wp_enqueue_script('jquery-ui-accordion' );
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-form');
		wp_localize_script('dt_main_js', 'dtfa', array(
			// Importar
			'ajaxurl'   => admin_url('admin-ajax.php', 'relative'),
			'ititle'    => __d('Upload image'),
			'iuse'      => __d('Use image'),
			'save'      => __d('Settings saved.'),
			'remov'     => __d('Removing..'),
            'saving'    => __d('Saving changes..'),
            'save'      => __d('Save changes'),
			'justnow'   => __d('just now'),
            'loading'   => __d('Loading..'),
            'cleareg'   => __d('Clear registers'),
			'reset_all' => __d('Do you really want to delete this register, once completed this action will not recover the data again?')
			)
		);
	}
}
add_action('admin_enqueue_scripts', 'doothemes_framework_scripts');


// Save Menu option
function dto_ssection() {
    $ms = isset( $_POST['ms'] ) ? $_POST['ms'] : null;
    $ss = isset( $_POST['ss'] ) ? $_POST['ss'] : null;
    if($ms and $ss) {
        $data = array(
            'msection' => $ms,
            'ssection' => $ss
        );
        update_option( 'dt_menu_framework_secion', $data );
    }
    die();
}
add_action('wp_ajax_ssection', 'dto_ssection');
add_action('wp_ajax_nopriv_ssection', 'dto_ssection');

// function Database clear

function doothemes_clear_database() {

	// Data
	$key	= isset( $_REQUEST['key'] ) ? $_REQUEST['key'] : null;
	$nonce	= isset( $_REQUEST['nonce'] ) ? $_REQUEST['nonce'] : null;
	$dbdt	= get_option('dt_cleardb_date');
	$date	= time();

	// Conditional
	if( $key != null AND wp_verify_nonce( $nonce, 'dtdbclear') ) {

		// User views
		if( $key == 'user_views') {
			dt_clear_database('usermeta', 'meta_key', 'wp_user_view_count');
			dt_clear_database('postmeta', 'meta_key', '_dt_views_users');
			$new_date = array(
				'a1' => $date,
				'a2' => $dbdt['a2'],
				'a3' => $dbdt['a3'],
				'a4' => $dbdt['a4'],
				'a5' => $dbdt['a5'],
				'a6' => $dbdt['a6'],
				'a7' => $dbdt['a7'],
                'a8' => $dbdt['a8'],
			);
		}

		// User favorites
		if( $key == 'user_favorites' ) {
			dt_clear_database('usermeta', 'meta_key', 'wp_user_list_count');
			dt_clear_database('postmeta', 'meta_key', '_dt_list_users');
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $date,
				'a3' => $dbdt['a3'],
				'a4' => $dbdt['a4'],
				'a5' => $dbdt['a5'],
				'a6' => $dbdt['a6'],
				'a7' => $dbdt['a7'],
                'a8' => $dbdt['a8'],
			);
		}

		// User Ratings
		if( $key == 'user_ratings' ) {
			dt_clear_database('postmeta', 'meta_key', '_starstruck_total');
			dt_clear_database('postmeta', 'meta_key', '_starstruck_avg');
			dt_clear_database('postmeta', 'meta_key', '_starstruck_data');
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $dbdt['a2'],
				'a3' => $date,
				'a4' => $dbdt['a4'],
				'a5' => $dbdt['a5'],
				'a6' => $dbdt['a6'],
				'a7' => $dbdt['a7'],
                'a8' => $dbdt['a8'],
			);
		}

		// Count Post views
		if( $key == 'post_views' ) {
			dt_clear_database('postmeta', 'meta_key', 'dt_views_count');
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $dbdt['a2'],
				'a3' => $dbdt['a3'],
				'a4' => $date,
				'a5' => $dbdt['a5'],
				'a6' => $dbdt['a6'],
				'a7' => $dbdt['a7'],
                'a8' => $dbdt['a8'],
			);
		}

		// Post featured
		if( $key == 'post_featured' ) {
			dt_clear_database('postmeta', 'meta_key', 'dt_featured_post');
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $dbdt['a2'],
				'a3' => $dbdt['a3'],
				'a4' => $dbdt['a4'],
				'a5' => $date,
				'a6' => $dbdt['a6'],
				'a7' => $dbdt['a7'],
                'a8' => $dbdt['a8'],
			);
		}

		// Transients options
		if( $key == 'transients' ) {
			dt_clear_transients();
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $dbdt['a2'],
				'a3' => $dbdt['a3'],
				'a4' => $dbdt['a4'],
				'a5' => $dbdt['a5'],
				'a6' => $date,
				'a7' => $dbdt['a7'],
                'a8' => $dbdt['a8'],
			);
		}

		// User reports
		if( $key == 'user_reports' ) {
			dt_clear_database('postmeta', 'meta_key', 'numreport');
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $dbdt['a2'],
				'a3' => $dbdt['a3'],
				'a4' => $dbdt['a4'],
				'a5' => $dbdt['a5'],
				'a6' => $dbdt['a6'],
				'a7' => $date,
                'a8' => $dbdt['a8'],
			);
		}

        // Doothemes License
		if( $key == 'doothemes' ) {
            delete_option('_transient_dooplay_license_message');
            delete_option('_transient_timeout_dooplay_license_message');
            delete_option('dooplay_license_key');
            delete_option('dooplay_license_key_status');
            delete_option('_transient_dooplay-update-response');
			$new_date = array(
				'a1' => $dbdt['a1'],
				'a2' => $dbdt['a2'],
				'a3' => $dbdt['a3'],
				'a4' => $dbdt['a4'],
				'a5' => $dbdt['a5'],
				'a6' => $dbdt['a6'],
				'a7' => $dbdt['a7'],
                'a8' => $date,
			);
		}

		update_option('dt_cleardb_date', $new_date );
	}

	die();
}
add_action('wp_ajax_dtcdatabase', 'doothemes_clear_database');
add_action('wp_ajax_nopriv_dtcdatabase', 'doothemes_clear_database');

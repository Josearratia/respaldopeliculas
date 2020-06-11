<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.1.3
*
*/

$dbmvkey	= get_option( 'dbmovies_options' );
$database	= get_option( DOO_THEME_SLUG. '_database' );
$license	= get_option( DOO_THEME_SLUG. '_license_key_status' );

/* Notice Activate License
-------------------------------------------------------------------------------
*/
if( ! function_exists( 'activate_license_dooplay' ) ) {
    function activate_license_dooplay() {
        echo '<div class="notice notice-info is-dismissible"><p>';
    	echo '<span class="dashicons dashicons-warning" style="color: #00a0d2"></span> ';
        echo __d('Invalid license, it is possible that some of the options may not work correctly'). ', '.'<a href="'. admin_url(). 'themes.php?page='. DOO_THEME_SLUG. '-license"><strong>'. __d('here'). '</strong></a>';
        echo '</p></div>';
    }
}

/* Register dbmovies API
-------------------------------------------------------------------------------
*/
if( ! function_exists( 'activate_dbmovies_for_dooplay' ) ) {
    function activate_dbmovies_for_dooplay() {
        echo '<div class="notice notice-info is-dismissible activate_dbmovies_true"><p id="ac_dbm_not">';
    	echo '<span class="dashicons dashicons-warning" style="color: #00a0d2"></span> ';
    	echo __d('dbmovies API has not been activated, active to be able to generate content'). ' <a href="' .admin_url(). 'admin.php?page=dbmovies"><strong>'. __d('Active Dbmovies now') .'</strong></a>';
        echo '</p></div>';
    }
}

/* Notify update database
-------------------------------------------------------------------------------
*/
if( ! function_exists( 'update_database_for_dooplay' ) ) {
    function update_database_for_dooplay() {
        echo '<div class="notice notice-info is-dismissible"><p id="cfg_dts">';
    	echo '<span class="dashicons dashicons-warning" style="color: #00a0d2"></span> ';
        echo __d('Dooplay requires you to update the database'). ' <a class="dooplay_update_database"><strong>'. __d('click here to update') .'</strong></a>';;
        echo '</p></div>';
    }
}

/* Logical comparators
-------------------------------------------------------------------------------
*/

// Notices Admin
if ( $license !== 'valid') {
	add_action( 'admin_notices', 'activate_license_dooplay' );		// Active Your License
}elseif ( $database !== DOO_VERSION_DB ) {
	add_action( 'admin_notices', 'update_database_for_dooplay' );	// Update database
}elseif ( empty( $dbmvkey['dbmv'] ) ) {
	add_action( 'admin_notices', 'activate_dbmovies_for_dooplay' );	// Active Dbmovies
}

// End notificator..

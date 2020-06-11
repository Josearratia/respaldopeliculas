<?php
/*
* ----------------------------------------------------
*
* DBmovies ( Files ) for DooPlay
*
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.4
*
*/

/* Scripts Dbmovies
========================================================
*/
function dbmovies_assets() {
	global $post_type, $dbmvsoptions;

	// Dbmovies APP
	if( isset( $_GET['page'] ) AND $_GET['page'] == 'dbmovies') {
		wp_enqueue_style('dt-importer-tool-styles', DOO_URI .'/inc/core/dbmovies/css/style.gca.css', '', DBMOVIES_version, 'all');
		wp_enqueue_script('dt-importer-tool-scripts', DOO_URI .'/inc/core/dbmovies/js/dbmovies.gca.js', array('jquery'), DBMOVIES_version, false );
		wp_localize_script('dt-importer-tool-scripts', 'dBa', array(
			'url'			=> admin_url('admin-ajax.php', 'relative'),
			'loading'		=> __d('Loading..'),
			'exists_notice' => __d('This content already exists in the database'),
			'completed'		=> __d('Completed process'),
			'error'			=> __d('Unknown error'),
			'getting'		=> __d('Getting data..'),
			'save'			=> __d('Save'),
			'saving'		=> __d('Saving..'),
			'search'		=> __d('Search'),
			'filtering'		=> __d('Filtering..'),
			'filter'		=> __d('Filter'),
			'dbmv'			=> $dbmvsoptions['dbmv'],
			'apidbmv'		=> DBMOVIES_Api_dbmv
		) );
	}

	// Dbmovies in Movies
	if( $post_type == 'movies') {
		wp_enqueue_script('ajax_post_movies', DOO_URI .'/inc/core/dbmovies/js/movies.js', array('jquery'), DBMOVIES_version, false );
		wp_localize_script('ajax_post_movies', 'DTapi', array(
			// Importar
			'dbm'		=> DBMOVIES_Api_dbmv,
			'tmd'		=> DBMOVIES_Api_tmdb. 'movie/',
			'dbmkey'	=> $dbmvsoptions['dbmv'],
			'tmdkey'	=> $dbmvsoptions['tmdb'],
			'pda'		=> $dbmvsoptions['active'],
			'lang'		=> $dbmvsoptions['lang'],
			'genres'	=> $dbmvsoptions['genres'],
			'upload'	=> $dbmvsoptions['upload'],
			'post'		=> isset($_GET['action']) ? $_GET['action'] : null,
			'loading'	=> __('Loading...'),
		) );
	}

	// Dbmovies in TVShows
	if( $post_type == 'tvshows') {
		wp_enqueue_script('ajax_post_movies', DOO_URI .'/inc/core/dbmovies/js//tvshows.js', array('jquery'), DBMOVIES_version, false );
		wp_localize_script('ajax_post_movies', 'DTapi', array(
			// Importar
			'dbm'		=> DBMOVIES_Api_dbmv,
			'tmd'		=> DBMOVIES_Api_tmdb. 'tv/',
			'dbmkey'	=> $dbmvsoptions['dbmv'],
			'tmdkey'	=> $dbmvsoptions['tmdb'],
			'pda'		=> $dbmvsoptions['active'],
			'lang'		=> $dbmvsoptions['lang'],
			'genres'	=> $dbmvsoptions['genres'],
			'upload'	=> $dbmvsoptions['upload'],
			'post'		=> isset($_GET['action']) ? $_GET['action'] : null,
			'loading'	=> __('Loading...')
		) );
	}

	// Dbmovies in TVShows > Seasons
	if( $post_type == 'seasons') {
		wp_enqueue_script('ajax_post_movies', DOO_URI .'/inc/core/dbmovies/js/seasons.js', array('jquery'), DBMOVIES_version, false );
		wp_localize_script('ajax_post_movies', 'DTapi', array(
			// Importar
			'dbm'		=> DBMOVIES_Api_dbmv,
			'tmd'		=> DBMOVIES_Api_tmdb. 'tv/',
			'dbmkey'	=> $dbmvsoptions['dbmv'],
			'pda'		=> $dbmvsoptions['active'],
			'lang'		=> $dbmvsoptions['lang'],
			'tmdkey'	=> $dbmvsoptions['tmdb'],
			'upload'	=> $dbmvsoptions['upload'],
			'post'		=> isset($_GET['action']) ? $_GET['action'] : null,
			'slug'		=> __d('Season'),
			'loading'	=> __('Loading...')
		) );
	}

	// Dbmovies in TVShows > Episodes
	if( $post_type == 'episodes') {
		wp_enqueue_script('ajax_post_movies', DOO_URI .'/inc/core/dbmovies/js/episodes.js', array('jquery'), DBMOVIES_version, false );
		wp_localize_script('ajax_post_movies', 'DTapi', array(
			// Importar
			'dbm'		=> DBMOVIES_Api_dbmv,
			'tmd'		=> DBMOVIES_Api_tmdb. 'tv/',
			'dbmkey'	=> $dbmvsoptions['dbmv'],
			'pda'		=> $dbmvsoptions['active'],
			'lang'		=> $dbmvsoptions['lang'],
			'tmdkey'	=> $dbmvsoptions['tmdb'],
			'upload'	=> $dbmvsoptions['upload'],
			'post'		=> isset($_GET['action']) ? $_GET['action'] : null,
			'eseas'		=> DOO_ESEAS,
			'esepart'	=> DOO_ESEPART,
			'eepisod'	=> DOO_EEPISOD,
			'loading'	=> __('Loading...')
		) );
	}
}
add_action('admin_enqueue_scripts', 'dbmovies_assets');

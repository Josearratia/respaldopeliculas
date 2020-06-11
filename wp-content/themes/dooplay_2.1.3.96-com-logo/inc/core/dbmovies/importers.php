<?php
/*
* ----------------------------------------------------
*
* DBmovies Importers for DooPlay
*
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.4
*
*/


/* INSERT Movies
========================================================
*/
function dbm_post_movie($idmovie) {
	set_time_limit(30000);
	global $dbmvsoptions;
	$opt = $dbmvsoptions;
	$json_1 = dt_dbmovies_remote( DBMOVIES_Api_tmdb."movie/".$idmovie."?append_to_response=images,trailers&language=".$opt['lang']."&include_image_language=".$opt['lang']. ",null&api_key=".$opt['tmdb']);
	$data	= json_decode($json_1, TRUE);

	// Trailer
	$trailer = $data['trailers']['youtube'];
	foreach ($trailer as $key) {
		$youtube = '['. $key['source'].']';
	}

	// IMDb Data
	$imdb	= $data['imdb_id'];
	$jsonn	= dt_dbmovies_remote( IMDB_API_URL . '/'. $imdb );
	$data1	= json_decode($jsonn, TRUE);

	// Get response
	$xnsqehzq = $data1['response'];
	// Compose data from IMDb.com
	$a4 = $data1['imdbRating'];
	$a5 = $data1['imdbVotes'];
	$a6 = $data1['Rated'];
	$a7 = $data1['Country'];

	// Compose data from Themoviedb.org
	$b1		= $data['runtime'];
	$b2		= $data['tagline'];
	$b3		= $data['title'];
	$b4		= $data['overview'];
	$b9		= $data['vote_count'];
	$b10	= $data['vote_average'];
	$b11	= $data['release_date'];
	$b12	= $data['original_title'];
	$a3		= substr($b11, 0, 4);
	$b13	= $data['poster_path'];
	$upimg	= isset($b13) ? 'https://image.tmdb.org/t/p/w342' . $b13 : false;
	$b14	= $data['backdrop_path'];
	$b15	= $data['images']["backdrops"];

	$i = '0'; foreach($b15 as $valor2) if ($i < 10) {
		$imgs.= $valor2['file_path'] . "\n";
		$i +=1;
	}

	$b16 = $data['genres'];
	$generos = array();
	foreach($b16 as $ci) {
		$generos[] = $ci['name'];
	}
	$b17 = 'mov'.dt_dbmovies_key_string(6). $data['id'];

	// Get CAST from Themoviedb.org
	$json_2 = dt_dbmovies_remote( DBMOVIES_Api_tmdb. "movie/".$idmovie."/credits?append_to_response=images,trailers&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
	$data2	= json_decode($json_2, TRUE);

	$i = '0'; foreach($data2['cast'] as $valor) if ($i < 10) {
		$actores.= $valor['name'] . ",";
		$i +=1;
	}

	$i = '0'; foreach($data2['cast'] as $valor) if ($i < 10) {
		if ($valor['profile_path'] == NULL) {
			$valor['profile_path'] = "null";
		}
		$d_actores.= "[" . $valor['profile_path'] . ";" . $valor['name'] . "," . $valor['character'] . "]";
		$i +=1;
	}

	foreach($data2['crew'] as $valorc) {
		$departamente = $valorc['department'];

		if ($valorc['profile_path'] == NULL) {
			$valorc['profile_path'] = "null";
		}

		if ($departamente == "Directing") {
			$d_dir.= "[" . $valorc['profile_path'] . ";" . $valorc['name'] . "]";
		}

		if ($departamente == "Directing") {
			$dir.= $valorc['name'] . ",";
		}
	}

	$optdate = ( $opt['release'] == true ) ? $b11 : date('Y-m-d H:i:s');

	// Compose Post
	$moviepost = array(
		'post_title'	=> dt_dbmovies_text_cleaner($b3),
		'post_content'	=> dt_dbmovies_text_cleaner($b4),
		'post_date'     => $optdate,
		'post_date_gmt' => $optdate,
		'post_status'	=> 'publish',
		'post_type'		=> 'movies',
		'post_author'	=> get_current_user_id()
	);

	// Verify parameters required
	if( isset($data['title']) AND dt_dbmovies_very_tmdb($idmovie, 'idtmdb') != true ) {
		$post_id = wp_insert_post($moviepost);

		// Insert taxonomies
		wp_set_post_terms( $post_id,	$dir,		'dtdirector',	false );
		wp_set_post_terms( $post_id,	$a3,		'dtyear',		false );
		wp_set_post_terms( $post_id,	$actores,	'dtcast',		false );
		wp_set_object_terms( $post_id,	$generos,	'genres',		false );

		// MetaKey and MetaValue
		$add_post_meta = array(
			'ids'				=> $imdb,
			'idtmdb'			=> $idmovie,
			'dt_poster'			=> $b13,
			'dt_backdrop'		=> $b14,
			'imagenes'			=> $imgs,
			'youtube_id'		=> $youtube,
			'imdbRating'		=> $a4,
			'imdbVotes'			=> $a5,
			'Rated'				=> $a6,
			'Country'			=> $a7,
			'original_title'	=> $b12,
			'release_date'		=> $b11,
			'vote_average'		=> $b10,
			'vote_count'		=> $b9,
			'tagline'			=> $b2,
			'runtime'			=> $b1,
			'dt_string'			=> $b17,
			'dt_cast'			=> $d_actores,
			'dt_dir'			=> $d_dir,
		);

		// Add Post meta
		foreach ($add_post_meta as $key => $value) {
			if($key == 'imagenes') {
				if( isset($value) ) add_post_meta($post_id, $key, esc_attr($value), true);
			} else {
				if( isset($value) ) add_post_meta($post_id, $key, sanitize_text_field($value), true);
			}
		}
		// Upload poster
		if( $upimg != false ) dt_dbmovies_upload_image( $upimg, $post_id, true, false );

		// Success import data
		if( $xnsqehzq != 0 ) {
			echo '<li class="fadeInDown"><span>'.dt_dbmovies_elapsed_time(time()).'</span> <span>'. __d('Movie') .'</span> <a href="'.get_permalink($post_id).'" target="_blank">'.$b3.'</a></li>';
		} else {
			echo isset( $data1['message'] ) ? '<li class="jump" style="color:red">'.$data1['message'].'</li>' : __d('Unexpected error');
		}

	} else {
		// Error repeated content
		echo '<li class="jump" style="color:orange">'.__d('Unexpected error').' - '.$idmovie.'</li>';
	}
}


/* INSERT TVShows
========================================================
*/
function dbm_post_tv($ids) {
	set_time_limit(30000);
	global $dbmvsoptions;
	$opt = $dbmvsoptions;
	$json2 = dt_dbmovies_remote( DBMOVIES_Api_tmdb."tv/".$ids."?append_to_response=images,trailers&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
	$data2 = json_decode($json2, TRUE);
	$name			= $data2['name'];
	$episodes		= $data2['number_of_episodes'];
	$seasons		= $data2['number_of_seasons'];
	$year			= substr($data2['first_air_date'], 0, 4);
	$date1			= $data2['first_air_date'];
	$date2			= $data2['last_air_date'];
	$overview		= $data2['overview'];
	$popularidad	= $data2['popularity'];
	$originalname	= $data2['original_name'];
	$promedio		= $data2['vote_average'];
	$votos			= $data2['vote_count'];
	$tipo			= $data2['type'];
	$web			= $data2['homepage'];
	$status			= $data2['status'];
	$poster			= $data2['poster_path'];
	$upload_poster	= isset($poster) ? 'https://image.tmdb.org/t/p/w342' . $poster : false;
	$backdrop		= $data2['backdrop_path'];
	// Forech!
	$i = '0';
	$images = $data2['images']["backdrops"];
	foreach($images as $valor2) if ($i < 10) {
		$imgs.= $valor2['file_path'] . "\n";
		$i +=1;
	}

	$genres = $data2['genres'];
	$generos = array();
	foreach($genres as $ci) {
		$generos[] = $ci['name'];
	}
	$networks = $data2['networks'];
	foreach($networks as $co) {
		$redes.= $co['name'];
	}
	$studio = $data2['production_companies'];
	foreach($studio as $ht) {
		$estudios.= $ht['name'] . ",";
	}
	$creator = $data2['created_by'];
	foreach($creator as $cg) {
		$creador.= $cg['name'] . ",";
	}
	foreach($creator as $ag) {
		if ($ag['profile_path'] == NULL) {
			$ag['profile_path'] = "null";
		}
		$creador_d.= "[" . $ag['profile_path'] . ";" . $ag['name'] . "]";
	}
	$runtime = $data2['episode_run_time'];
	foreach($runtime as $tm) {
		$duracion.= $tm;
		break;
	}

	$json3 = dt_dbmovies_remote( DBMOVIES_Api_tmdb."tv/".$ids."/credits?append_to_response=images,trailers&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
	$data3 = json_decode($json3, TRUE);

	$cast = $data3['cast'];
	$i = '0';
	foreach($cast as $valor) if ($i < 10) {
		$actores.= $valor['name'] . ",";
		$i +=1;
	}
	$i = '0';
	foreach($cast as $valor) if ($i < 10) {
		if ($valor['profile_path'] == NULL) {
			$valor['profile_path'] = "null";
		}
		$d_actores.= "[" . $valor['profile_path'] . ";" . $valor['name'] . "," . $valor['character'] . "]";
		$i +=1;
	}

	$json4 = dt_dbmovies_remote( DBMOVIES_Api_tmdb."tv/".$ids."/videos?append_to_response=images,trailers&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
	$data4 = json_decode($json4, TRUE);

	$video = $data4['results'];
	foreach($video as $yt) {
		$youtube.= "[" . $yt['key'] . "]";
		break;
	}

	// Define date
	$optdate = ( $opt['release'] == true ) ? $date1 : date('Y-m-d H:i:s');

	// Compose POST
	$tvpost = array(
		'post_title'	=> dt_dbmovies_text_cleaner($name),
		'post_content'	=> dt_dbmovies_text_cleaner($overview),
		'post_status'	=> 'publish',
		'post_type'		=> 'tvshows',
		'post_date'     => $optdate,
		'post_date_gmt' => $optdate,
		'post_author'	=> get_current_user_id()
	);

	// Verify parameters required
	if( isset( $data2['name'] ) AND dt_dbmovies_very_tmdb($ids, 'ids') != true ) {

		// Insert POST
		$post_id = wp_insert_post($tvpost);

		// Insert taxonomies
		wp_set_post_terms( $post_id,	$year,		'dtyear',		false );
		wp_set_object_terms( $post_id,	$generos,	'genres',		false );
		wp_set_post_terms( $post_id,	$redes,		'dtnetworks',	false );
		wp_set_post_terms( $post_id,	$estudios,	'dtstudio',		false );
		wp_set_post_terms( $post_id,	$actores,	'dtcast',		false );
		wp_set_post_terms( $post_id,	$creador,	'dtcreator',	false );

		// MetaKey and MetaValue
		$add_post_meta = array(
			'ids'					=> $ids,
			'dt_poster'				=> $poster,
			'dt_backdrop'			=> $backdrop,
			'imagenes'				=> $imgs,
			'youtube_id'			=> $youtube,
			'first_air_date'		=> $date1,
			'last_air_date'			=> $date2,
			'number_of_episodes'	=> $episodes,
			'number_of_seasons'		=> $seasons,
			'original_name'			=> $originalname,
			'status'				=> $status,
			'imdbRating'			=> $promedio,
			'imdbVotes'				=> $votos,
			'episode_run_time'		=> $duracion,
			'dt_cast'				=> $d_actores,
			'dt_creator'			=> $creador_d,
		);

		// Add Post meta
		foreach ($add_post_meta as $key => $value) {
			if($key == 'imagenes') {
				if( isset($value) ) add_post_meta($post_id, $key, esc_attr($value), true);
			} else {
				if( isset($value) ) add_post_meta($post_id, $key, sanitize_text_field($value), true);
			}
		}

		// Upload poster
		if( $upload_poster != false ) dt_dbmovies_upload_image($upload_poster, $post_id, true, false );

		// Success import data
		echo '<li class="fadeInDown"><span>'.dt_dbmovies_elapsed_time(time()).'</span> <span>'. __d('TV') .'</span><a href="'.get_permalink($post_id).'" target="_blank">'.$name.'</a></li>';
	} else {

		// Success Error
		echo '<li class="jump" style="color:orange">'.__d('Unexpected error').' - '.$ids.'</li>';
	}
}

/* INSERT Episodes in Seasons
========================================================
*/
function dbm_insert_episodes($seas = null, $tvsh = null, $idps = null) {

	// Get Dbmovies Option
	global $dbmvsoptions;
	$opt = $dbmvsoptions;

	// API Request (TVShow)
	$json2 = dt_dbmovies_remote( DBMOVIES_Api_tmdb."tv/".$tvsh."?&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
	$data2 = json_decode($json2, TRUE);

	// TV Show data
	$tituloserie = $data2['name'];

	// API Request (Season)
	$json1 = dt_dbmovies_remote( DBMOVIES_Api_tmdb."tv/".$tvsh."/season/".$seas."?append_to_response=images,trailers&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
	$data1 = json_decode($json1, TRUE);

	// Season data
	$sdasd			= count($data1['episodes']);
	$poster_serie	= $data1['poster_path'];
	for ($cont = 1; $cont <= $sdasd; $cont++) {

		// API Request (Episode)
		$json = dt_dbmovies_remote( DBMOVIES_Api_tmdb.'tv/'.$tvsh.'/season/'.$seas.'/episode/'.$cont.'?append_to_response=images&language='.$opt['lang'].'&include_image_language='.$opt['lang'].',null&api_key='.$opt['tmdb'] );
		$data = json_decode($json, TRUE);

		// Episode data
		$season		 = $data['season_number'];
		$episode	 = $data['episode_number'];
		$name		 = $data['name'];
		$dmtid		 = 'tv'.dt_dbmovies_key_string(6).$data['id'];
		$overview	 = $data['overview'];
		$air_date	 = isset( $data['air_date'] ) ? $data['air_date'] : date('Y-m-d');
		$still_path  = $data['still_path'];
		$upload_img  = isset( $still_path ) ? 'https://image.tmdb.org/t/p/w500' . $still_path : false;
		$crew		 = $data['crew'];
		$guest_stars = $data['guest_stars'];
		$images		 = $data['images']["stills"];
		$castor		 = $img = $cast = $director = $writer = "";

		// Compoce Crew shortcode
		foreach($crew as $valor) {
			$departamente = $valor['department'];
			if ($valor['profile_path'] == NULL) {
				$valor['profile_path'] = "null";
			}
			if ($departamente == "Directing") {
				$director.= $valor['name'] . ",";
			}
			if ($departamente == "Writing") {
				$writer.= $valor['name'] . ",";
			}
		}

		// Compose Cast shortcode
		$i = '0';
		foreach($guest_stars as $valor1) if ($i < 3) {
			if ($valor1['profile_path'] == NULL) {
				$valor1['profile_path'] = "null";
			}
			$castor.= $valor1['name'] . ",";
			$i +=1;
		}

		// Compose Images
		$i = '0';
		foreach($images as $valor2) if ($i < 10) {
			$img.= $valor2['file_path'] . "\n";
			$i +=1;
		}

		// Compose POST
		$postepisodes = array(
			'post_title'	=> dt_clear($tituloserie. ": ".DOO_ESEAS.$season.DOO_ESEPART.DOO_EEPISOD. $episode),
			'post_content'	=> dt_clear($overview),
			'post_status'	=> 'publish',
			'post_type'		=> 'episodes',
			'post_author'	=> get_current_user_id()
		);

		// Insert Post
		$post_id = wp_insert_post($postepisodes);

		// MetaKey And MetaValue
		$add_post_meta = array(
			'ids'			=> $tvsh,
			'temporada'		=> $season,
			'episodio'		=> $episode,
			'serie'			=> $tituloserie,
			'episode_name'	=> $name,
			'air_date'		=> $air_date,
			'imagenes'		=> $img,
			'dt_backdrop'	=> $still_path,
			'dt_poster'		=> $poster_serie,
			'dt_string'		=> $dmtid,
		);

		// Add Post meta
		foreach ($add_post_meta as $key => $value) {
			if($key == 'imagenes') {
				if( isset($value) ) add_post_meta($post_id, $key, $value, true);
			} else {
				if( isset($value) ) add_post_meta($post_id, $key, sanitize_text_field($value), true);
			}
		}
		// Upload Image
		if( $upload_img != false ) dt_dbmovies_upload_image($upload_img, $post_id, true, false);
	}
	// Update status button
	update_post_meta($idps, 'clgnrt', '1');
}

/* GET TVShow > Seasons
========================================================
*/
function dbm_post_tvshow_seasons() {

	// Define time limit
	set_time_limit(30000);
	global $dbmvsoptions;
	$opt = $dbmvsoptions;

	// Conditional (1)
	if( isset($_GET['seasons_nonce'] ) AND wp_verify_nonce($_GET['seasons_nonce'], 'add_seasons') ) {

		// Conditional (2)
		if ( is_user_logged_in() AND isset($_GET["se"]) AND isset($_GET["link"]) ) {

			// Main data
			$ids	= isset($_GET["se"])	? $_GET["se"]	: NULL;
			$link	= isset($_GET["link"])	? $_GET["link"] : NULL;

			// API Request (TVShow)
			$json2	= dt_dbmovies_remote( DBMOVIES_Api_tmdb."tv/". $ids."?&language=".$opt['lang']."&include_image_language=".$opt['lang'].",null&api_key=".$opt['tmdb'] );
			$data2	= json_decode($json2, TRUE);

			// Data
			$tituloserie	= $data2['name'];
			$sdasd			= $data2['number_of_seasons'];

			// Get Seasons
			for ($cont = 1; $cont <= $sdasd; $cont++) {

				// API Request (Season)
				$json = dt_dbmovies_remote( DBMOVIES_Api_tmdb.'tv/'.$ids.'/season/'.$cont .'?append_to_response=images&language='.$opt['lang'].'&include_image_language='.$opt['lang'].',null&api_key='.$opt['tmdb'] );
				$data = json_decode($json, TRUE);

				// Get Data
				$name			= $data['name'];
				$poster_serie	= $data['poster_path'];
				$upload_poster	= isset($poster_serie) ? 'https://image.tmdb.org/t/p/w342' . $poster_serie : false;
				$overview		= $data['overview'];
				$fecha			= isset( $data['air_date'] ) ? $data['air_date'] : date('Y-m-d');
				$season_number	= $data['season_number'];

				// Compose POST
				$seasonpost = array(
					'post_title'	=> dt_dbmovies_text_cleaner($tituloserie . ": " . __d('Season') . " " . $cont),
					'post_content'	=> dt_dbmovies_text_cleaner($overview),
					'post_status'	=> 'publish',
					'post_type'		=> 'seasons',
					'post_author'	=> get_current_user_id()
				);

				// Insert POST
				$post_id = wp_insert_post($seasonpost);

				// KeyMeta and KeyValue
				$add_post_meta = array(
					'ids'		=> $ids,
					'temporada' => $season_number,
					'serie'		=> $tituloserie,
					'air_date'	=> $fecha,
					'dt_poster' => $poster_serie
				);

				// Add Post meta
				foreach ($add_post_meta as $key => $value) {
					if( isset($value) ) add_post_meta( $post_id, $key, sanitize_text_field($value), true );
				}

				// Upload Image
				if( $upload_poster != false ) dt_dbmovies_upload_image($upload_poster, $post_id, true, false);
			}

			update_post_meta($link, 'clgnrt', '1');
			wp_redirect( get_admin_url() . "edit.php?post_type=seasons");
			exit;
		} // end conditional (2)
	} // end conditional (1)
	die();
}
add_action('wp_ajax_seasons_ajax', 'dbm_post_tvshow_seasons');
add_action('wp_ajax_nopriv_seasons_ajax', 'dbm_post_tvshow_seasons');


/* GET TVShow > Season > Episodes ( wp-admin )
========================================================
*/

function dbm_post_episodes_ajax() {

	// Define time limit
	set_time_limit(30000);

	// Conditional (1)
	if( isset($_GET['episodes_nonce'] ) and wp_verify_nonce($_GET['episodes_nonce'], 'add_episodes') ) {

		// Conditional (2)
		if ( is_user_logged_in() AND isset($_GET["te"]) AND isset($_GET["se"]) AND isset($_GET["link"]) ) {

			// Main data
			$seas = isset( $_GET["te"] )		? $_GET["te"]	: NULL;
			$tvsh = isset( $_GET["se"] )		? $_GET["se"]	: NULL;
			$idps = isset( $_GET["link"] )	? $_GET["link"] : NULL;

			// Insert serie
			dbm_insert_episodes( $seas, $tvsh, $idps );

			// Redirect page
			wp_redirect( get_admin_url() . "edit.php?post_type=seasons");

			exit;
		} // end conditional (2)
	} // end conditional (1)
	die();
}
add_action('wp_ajax_episodes_ajax', 'dbm_post_episodes_ajax');
add_action('wp_ajax_nopriv_episodes_ajax', 'dbm_post_episodes_ajax');


/* GET TVShow > Season > Episodes ( front-end )
========================================================
*/
function dbm_post_episodes_front_ajax() {

	// Define time limit
	set_time_limit(30000);

	// Conditional (1)
	if( isset($_GET['episodes_nonce'] ) and wp_verify_nonce($_GET['episodes_nonce'], 'add_episodes') ) {

		// Conditional (2)
		if ( is_user_logged_in() AND isset($_GET["te"]) AND isset($_GET["se"]) AND isset($_GET["link"]) ) {

			// Main data
			$seas = isset($_GET["te"])		? $_GET["te"]	: NULL;
			$tvsh = isset($_GET["se"])		? $_GET["se"]	: NULL;
			$idps = isset($_GET["link"])	? $_GET["link"] : NULL;

			// Insert serie
			dbm_insert_episodes($seas, $tvsh, $idps);

			// Redirect page
			wp_redirect( get_permalink($idps) );

			exit;
		} // end conditional (2)
	} // end conditional (1)
	die();
}
add_action('wp_ajax_seasonsf_ajax', 'dbm_post_episodes_front_ajax');
add_action('wp_ajax_nopriv_seasonsf_ajax', 'dbm_post_episodes_front_ajax');

<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.3
*
*/

/* POST Links Ajax
========================================================
*/
if( ! function_exists( 'dt_main_ajax' ) ) {
	function dt_main_ajax() {
		if ( is_singular() OR is_archive() ) {
			wp_enqueue_script('dt_main_ajax',  DOO_URI .'/assets/js/front.ajax.js', array('jquery'), DOO_VERSION, false );
			wp_localize_script('dt_main_ajax', 'dtAjax', array(
				'url'		=>	admin_url('admin-ajax.php', 'relative'),
				'loading'	=> __d('Loading..'),
				'afavorites' => __d('Add to favorites'),
				'rfavorites' => __d('Remove of favorites'),
				'remove'	=> __d('Remove'),
				'isawit'	=> __d('I saw it'),
				'send'		=> __d('Data send..'),
				'updating'	=> __d('Updating data..'),
				'error'		=> __d('Error'),
				'pending'	=> __d('Pending review'),
				'ltipe'		=> __d('Download'),
				'sending'	=> __d('Sending data'),
				'enabled'	=> __d('Enable'),
				'disabled'	=> __d('Disable'),
				'trash'		=> __d('Delete'),
				'lshared'	=> __d('Links Shared'),
				'ladmin'	=> __d('Manage pending links'),
				'sendingrep'=> __d('Please wait, sending data..'),
				'ready'		=> __d('Ready')
			));
		}
		if ( is_author() ) {
			wp_enqueue_script('dt_main_ajax',  DOO_URI .'/assets/js/front.ajax.js', array('jquery'), DOO_VERSION, false );
			wp_localize_script('dt_main_ajax', 'dtAjax', array(
				'url' =>	admin_url('admin-ajax.php', 'relative'),
			));
		}
	}
	add_action('wp_enqueue_scripts', 'dt_main_ajax');
}

/* POST Links function
========================================================
*/
if( ! function_exists( 'dt_post_links' ) ) {
	function dt_post_links() {

		// Time Limit
		set_time_limit(30000);

		// Conditional
		if( isset( $_POST['send-links-nonce'] ) and wp_verify_nonce( $_POST['send-links-nonce'], 'send-links') and is_user_logged_in() ) {

			// User levels
			if(current_user_can('administrator')) {
				$status = 'publish'; // Admin's
			}
			elseif(current_user_can('editor')) {
				$status = 'publish'; // Editor's
			}
			elseif(current_user_can('author')) {
				$status = 'publish'; // Author's
			}
			elseif(current_user_can('contributor')) {
				$status = 'publish'; // Contributor's
			}
			elseif(current_user_can('subscriber')) {
				$status = 'pending'; // Regular user's
			}
			else {
				$status = 'pending'; // No role
			}
			// _POST Form..
			$data	 = isset($_POST['data'])		? $_POST['data']		: NULL;
			$title	 = isset($_POST['titlepost'])	? $_POST['titlepost']	: NULL;
			$postid	 = isset($_POST['idpost'])		? $_POST['idpost']		: NULL;
			$string	 = isset($_POST['dt_string'])	? $_POST['dt_string']	: NULL;
			$count	 = count($data);
			$userid  = get_current_user_id();
			for ( $n = 0; $n < $count; $n++ ) {
				// Serialized data..
				$tipo		= $data[$n]['tipo'];
				$url		= $data[$n]['url'];
				$idioma		= $data[$n]['idioma'];
				$calidad	= $data[$n]['calidad'];
				$size		= $data[$n]['size'];
				if( $url ) {

					// Compose POST
					$linkpost = array(
						'post_title'	=> sanitize_text_field($string),
						'post_status'	=> $status,
						'post_type'		=> 'dt_links',
						'post_date'     => date('Y-m-d H:i:s'),
						'post_date_gmt' => date('Y-m-d H:i:s'),
						'post_author'	=> $userid,
					);

					// Insert POST
					$post_id = wp_insert_post($linkpost);

					// MetaKey and MetaValue
					$add_post_meta = array(
						'links_type'	=> $tipo,
						'links_url'		=> $url,
						'dt_string'		=> $string,
						'links_idioma'	=> $idioma,
						'links_quality'	=> $calidad,
						'dt_postid'		=> $postid,
						'dt_postitle'	=> $title,
						'dt_filesize'	=> $size,
					);

					// Add Post meta
					foreach ($add_post_meta as $key => $value) {
						if( isset($value) ) add_post_meta( $post_id, $key, sanitize_text_field($value), true );
					}

					// fin de proceso!
				}
			}
			if($status == 'pending') {
				$to = get_option('admin_email');
				$subject = __d('New link added'). ' ('. $title .')';
				$message = '
					<p>'. __d('There are new link(s) added to:'). '</p>
					<p>[ <a href="'. get_permalink( $postid ) .'" target="_blank"><strong>'. $title .'</strong></a> ]</p>
					<p>'. __d('<strong>PENDING:</strong> requires moderation'). ', <a href="'.get_option('dt_account_page').'">'. __d('click here'). '</a></p>
					<p>--------------------------</p>
					<p><strong>User:</strong> '. get_user_meta($userid, 'nickname', true) .'</p>
					<p><strong>IP adress:</strong> '. get_client_ip() .'</p>
					<p>--------------------------</p>
				';
				$headers[] = 'From: '. get_option('blogname') .' <'. $to .'>';
				$headers[] = 'Content-Type: text/html; charset=UTF-8';
				wp_mail( $to, $subject, $message, $headers );
				echo '<div class="msg"><i class="icon-check-circle"></i>'. __d('Content submitted, pending moderation ..').'</div>';
			} else {
				echo '<div class="msg"><i class="icon-check-circle"></i>'. __d('Content published correctly..').'</div>';
			}

		} // end conditional
		die();
	}
	add_action('wp_ajax_dt_post_links', 'dt_post_links');
	add_action('wp_ajax_nopriv_dt_post_links', 'dt_post_links');
}

/* POST Reports AJAX
========================================================
*/
if( ! function_exists( 'dt_post_reports_ajax' ) ) {
	function dt_post_reports_ajax() {
		set_time_limit(30000);
		if( isset($_POST['send_report']) AND $_POST['send_report'] == 'true')  {
			// revision Google Recaptcha
			global $doo_gorc_public, $doo_gorc_secret;
			get_template_part('inc/includes/controladores/recaptchalib');
			$siteKey			= $doo_gorc_public;
			$secret				= $doo_gorc_secret;
			$resp				= null;
			$error				= null;
			$reCaptcha			= new ReCaptcha($secret);
			$recaptcha_response = isset($_POST["g-recaptcha-response"]) ? $_POST["g-recaptcha-response"] : null;
			$remote_addr		= $_SERVER["REMOTE_ADDR"];
			if ($recaptcha_response) {
				$resp = $reCaptcha->verifyResponse($remote_addr, $recaptcha_response);
			}
			if ($resp != null && $resp->success)  {
				if( isset( $_POST['send-report-nonce'] ) and wp_verify_nonce( $_POST['send-report-nonce'], 'send-report') ) {
					$idpost		= isset( $_POST['idpost'] )		? $_POST['idpost']		: null;
					$mensaje	= isset( $_POST['mensaje'] )	? $_POST['mensaje']		: null;
					$permalink	= isset( $_POST['permalink'] )	? $_POST['permalink']	: null;
					$title		= isset( $_POST['title'] )		? $_POST['title']		: null;
					$ip			= isset( $_POST['ip'] )			? $_POST['ip']			: null;
					$val_report = get_post_meta($idpost, 'numreport', true) +1;
					$name		= get_option('blogname');
					$asunto		= __d('BUG REPORT').": ". $title;
					$to			= get_option('admin_email');
					$repy		= isset( $_POST['reportmail'] ) ? $_POST['reportmail'] : null;
					$url		= get_option('siteurl');
					$message	= "
					<strong>". $title ."</strong>
					<br>
					-------------------------------------<br>
					<br>
					<strong>". __d('Message') .":</strong><br>
					<br>
					". dt_clear($mensaje) ."<br>
					<br>
					-------------------------------------<br>
					<br>
					<strong>". __d('Permalink') .":</strong> ". $permalink ."<br>
					<strong>". __d('Edit post') .":</strong> ". $url ."/wp-admin/post.php?post=".$idpost."&action=edit<br>
					<br>
					-------------------------------------<br>
					<br>
					<strong>". __d('IP') .":</strong> ". $ip ."<br>
					";
					$headers[]	= 'Content-Type: text/html; charset=UTF-8';
					$headers[]	= 'From: '. $name .'  <'. $to .'>';
					$headers[]	= 'Reply-To: '. $repy;
					wp_mail( $to, $asunto , $message,  $headers );
					update_post_meta( $idpost, $key = 'numreport', $val_report );
					echo "<i class='icon-check_circle send'></i>\n";
					echo "<p>". __d('Thank you! Your report was submitted..'). "</p>\n";
				}
			} else {
				 echo __d('Invalid code, please try again.');
			}
		}
		die();
	}
	add_action('wp_ajax_reports_ajax', 'dt_post_reports_ajax');
	add_action('wp_ajax_nopriv_reports_ajax', 'dt_post_reports_ajax');
}


/* Update user account page
========================================================
*/
if( ! function_exists( 'dt_update_user_page' ) ) {
	function dt_update_user_page() {
		set_time_limit(30);
		global $current_user, $wp_roles;

		$nonce = isset( $_POST['update-user-nonce'] )	? $_POST['update-user-nonce']	: null;
		$pass1 = isset( $_POST['pass1'] )				? $_POST['pass1']				: null;
		$pass2 = isset( $_POST['pass2'] )				? $_POST['pass2']				: null;
		$usurl = isset( $_POST['url'] )					? $_POST['url']					: null;
		$fname = isset( $_POST['first-name'] )			? $_POST['first-name']			: null;
		$lname = isset( $_POST['last-name'] )			? $_POST['last-name']			: null;
		$dname = isset( $_POST['display_name'] )		? $_POST['display_name']		: null;
		$descr = isset( $_POST['description'] )			? $_POST['description']			: null;
		$twitt = isset( $_POST['twitter'] )				? $_POST['twitter']				: null;
		$faceb = isset( $_POST['facebook'] )			? $_POST['facebook']			: null;
		$gplus = isset( $_POST['gplus'] )				? $_POST['gplus']				: null;

		if( isset($nonce ) and wp_verify_nonce($nonce, 'update-user') ) {
			$error = array();

			wp_get_current_user();

			// update password
			if (!empty($pass1) && !empty($pass2)) {
				if ($pass1 == $pass2) {
					wp_update_user( array('ID' => $current_user->ID, 'user_pass' => esc_attr($pass1) ) );
				} else {
					echo '<div class="error"><i class="icon-times-circle"></i> '. __d('The passwords you entered do not match.  Your password was not updated.'). '</div>';
					exit;
				}
			}

			if (!empty($usurl)) wp_update_user(array('ID' => $current_user->ID,'user_url' => esc_attr($usurl)));
			if (!empty($fname)) update_user_meta($current_user->ID, 'first_name', esc_attr($fname));
			if (!empty($lname)) update_user_meta($current_user->ID, 'last_name', esc_attr($lname));
			if (!empty($dname)) wp_update_user(array('ID' => $current_user->ID,'display_name' => esc_attr($dname)));

			update_user_meta($current_user->ID, 'display_name', esc_attr($dname));
			update_user_meta($current_user->ID, 'description',	esc_attr($descr));
			update_user_meta($current_user->ID, 'dt_twitter',	esc_attr($twitt));
			update_user_meta($current_user->ID, 'dt_facebook',	esc_attr($faceb));
			update_user_meta($current_user->ID, 'dt_gplus',		esc_attr($gplus));

			if (count($error) == 0) {
				do_action('edit_user_profile_update', $current_user->ID);
				echo '<div class="sent"><i class="icon-check-circle"></i> '. __d('Your profile has been updated.'). '</div>';
				exit;
			}
		}
		die();
	}
	add_action('wp_ajax_dt_update_user', 'dt_update_user_page');
	add_action('wp_ajax_nopriv_dt_update_user', 'dt_update_user_page');
}

/* Page list account / Movies and TVShows
========================================================
*/
if( ! function_exists( 'next_page_list' ) ) {
	function next_page_list() {

		$paged		= isset( $_POST["page"] )		? $_POST["page"]+1		: null;
		$type		= isset( $_POST["typepost"] )	? $_POST["typepost"]	: null;
		$user		= isset( $_POST["user"] )		? $_POST["user"]		: null;
		$template	= isset( $_POST["template"] )	? $_POST["template"]	: null;

		$args = array(
		  'paged'			=> $paged,
		  'numberposts'		=> -1,
		  'orderby'			=> 'date',
		  'order'			=> 'DESC',
		  'post_type'		=> array('movies','tvshows'),
		  'posts_per_page'	=> 18,
		  'meta_query'		=> array (
				array (
				  'key' => $type,
				  'value' => 'u'.$user. 'r',
				  'compare' => 'LIKE'
				)
			)
		);

		$sep = '';
		$list_query = new WP_Query( $args );
		if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();
			 get_template_part('inc/parts/simple_item_'. $template);
		endwhile;
		else :
		echo '<div class="no_fav">'. __d('No more content to show.'). '</div>';
		endif; wp_reset_postdata();
		die();
	}
	add_action('wp_ajax_next_page_list', 'next_page_list');
	add_action('wp_ajax_nopriv_next_page_list', 'next_page_list');
}


/* Page list links
========================================================
*/
if( ! function_exists( 'next_page_link' ) ) {
	function next_page_link() {
		$paged	 = $_POST["page"]+1;
		$user	 = $_POST["user"];
		$args    = array(
		  'paged'          => $paged,
		  'orderby'        => 'date',
		  'order'          => 'DESC',
		  'post_type'      => 'dt_links',
		  'posts_per_page' => 10,
		  'post_status'    => array('pending', 'publish', 'trash'),
		  'author'         => $user,
		  );
		$list_query = new WP_Query( $args );
		if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();
			 get_template_part('inc/parts/item_links');
		endwhile;
		else :
		echo '<tr><td>-</td><td>-</td><td class="views">-</td><td class="status">-</td><td>-</td></tr>';
		endif; wp_reset_postdata();
		die();
	}
	add_action('wp_ajax_next_page_link', 'next_page_link');
	add_action('wp_ajax_nopriv_next_page_link', 'next_page_link');
}

/* Page list links profile
========================================================
*/
if( ! function_exists( 'next_page_link_profile' ) ) {
	function next_page_link_profile() {
		$paged	 = $_POST["page"]+1;
		$user	 = $_POST["user"];
		$args    = array(
		  'paged'          => $paged,
		  'orderby'        => 'date',
		  'order'          => 'DESC',
		  'post_type'      => 'dt_links',
		  'posts_per_page' => 10,
		  'post_status'    => array('pending', 'publish', 'trash'),
		  'author'         => $user,
		  );
		$list_query = new WP_Query( $args );
		if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();
			 get_template_part('inc/parts/item_links_profile');
		endwhile;
		else :
		echo '<tr><td>-</td><td>-</td><td class="views">-</td><td class="views">-</td><td class="views">-</td><td class="views">-</td><td class="views">-</td></tr>';
		endif; wp_reset_postdata();
		die();
	}
	add_action('wp_ajax_next_page_link_profile', 'next_page_link_profile');
	add_action('wp_ajax_nopriv_next_page_link_profile', 'next_page_link_profile');
}

/* Page list Admin links
========================================================
*/
if( ! function_exists( 'next_page_link_admin' ) ) {
	function next_page_link_admin() {
		$paged	 = $_POST["page"]+1;
		$args    = array(
		  'paged'          => $paged,
		  'orderby'        => 'date',
		  'order'          => 'DESC',
		  'post_type'      => 'dt_links',
		  'posts_per_page' => 10,
		  'post_status'    => array('pending'),
		  );
		$list_query = new WP_Query( $args );
		if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();
			 get_template_part('inc/parts/item_links_admin');
		endwhile;
		else :
		echo '<tr><td>-</td><td>-</td><td>-</td><td class="views">-</td><td class="status">-</td><td>-</td></tr>';
		endif; wp_reset_postdata();
		die();
	}
	add_action('wp_ajax_next_page_link_admin', 'next_page_link_admin');
	add_action('wp_ajax_nopriv_next_page_link_admin', 'next_page_link_admin');
}

/* Control post link
========================================================
*/
if( ! function_exists( 'control_link_user' ) ) {
	function control_link_user() {

		$post_id	= isset( $_POST['post_id'] )	? $_POST['post_id'] : null;
		$user_id	= isset( $_POST['user_id'] )	? $_POST['user_id'] : null;
		$status		= isset( $_POST['status'] )		? $_POST['status']	: null;

		$auhor_id = get_current_user_id();
		if($auhor_id) {
		$args = array('ID' => $post_id,'post_status'=> $status);
			wp_update_post( $args );
			if($status == 'publish'){
				echo __d('Link enabled');
			}elseif($status == 'pending'){
				echo __d('Link disabled');
			}elseif($status == 'trash'){
				echo __d('Link moved to trash');
			}
		}
		die();
	}
	add_action('wp_ajax_control_link_user', 'control_link_user');
	add_action('wp_ajax_nopriv_control_link_user', 'control_link_user');
}

/* Form Edit link
========================================================
*/
if( ! function_exists( 'edit_user_link' ) ) {
	function edit_user_link() {
		if(is_user_logged_in()) {
			$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : null;
	?>
	<div class="form_edit">
		<div class="cerrar"><a id="cerrar_form_edit_link"><i class="icon-close"></i></a></div>
		<form id="editar_link">
			<fieldset>
				<h3><i class="icon-voice_chat"></i> <a href="<?php echo home_url(). '?p='. get_post_meta( $post_id, 'dt_postid', true ); ?>" target="_blank"><?php echo get_post_meta( $post_id, 'dt_postitle', true ); ?></a></h3>
			</fieldset>
			<fieldset>
				<select name="type" id="type">
				<?php $tipo = array( __d('Download'), __d('Torrent'), __d('Watch online') );
				foreach( $tipo as $val ) { ?>
					<option <?php echo (get_post_meta( $post_id, 'links_type', true  ) === $val ) ? 'selected' : '' ?>><?php echo $val; ?></option>
				<?php } ?>
				</select>
			</fieldset>

			<fieldset>
				<input type="text" name="url" id="url" value="<?php echo get_post_meta( $post_id, 'links_url', true ); ?>">
			</fieldset>

			<fieldset>
				<select name="idioma" id="idioma">
				<?php $links_lang = get_option('dt_languages_post_link');
				if(!empty($links_lang)){ $val = explode(",", $links_lang); foreach( $val as $valor ){ ?>
					<option <?php  echo (get_post_meta( $post_id, 'links_idioma', true ) === $valor ) ? 'selected' : '' ?>><?php echo $valor; ?></option>
				<?php }  } else {
				$quality = array('Spanish','English','Portuguese','Italian','French','Turkish');
				foreach( $quality as $val ) { ?>
					<option <?php echo (get_post_meta( $post_id, 'links_idioma', true ) === $val ) ? 'selected' : '' ?>><?php echo $val; ?></option>
				<?php }  } ?>
				</select>
			</fieldset>
			<fieldset>
				<select name="quality" id="quality">
				<?php
				$links_quality = get_option('dt_quality_post_link');
				if(!empty($links_quality)){ $val = explode(",", $links_quality); foreach( $val as $valor ){ ?>
					<option <?php  echo (get_post_meta( $post_id, 'links_quality', true ) === $valor ) ? 'selected' : '' ?>><?php echo $valor; ?></option>
				<?php }  } else {
				$quality = array('SD','HD','480p','720p','1080p');
				foreach( $quality as $val ) { ?>
					<option <?php echo (get_post_meta( $post_id, 'links_quality', true ) === $val ) ? 'selected' : '' ?>><?php echo $val; ?></option>
				<?php }  } ?>
				</select>
			</fieldset>
			<fieldset>
				<input type="text" name="filesize" id="filesize" value="<?php echo get_post_meta( $post_id, 'dt_filesize', true ); ?>" placeholder="File size (optional)">
			</fieldset>
			<fieldset>
				<input type="submit" value="Save data">
			</fieldset>
			<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>">
		</form>
	</div>
	<?php
		}
		die();
	}
	add_action('wp_ajax_edit_user_link', 'edit_user_link');
	add_action('wp_ajax_nopriv_edit_user_link', 'edit_user_link');
}

/* save edit link
========================================================
*/
if( ! function_exists( 'save_user_link' ) ) {
	function save_user_link(){
		if(is_user_logged_in()) {
			// User levels
			if(current_user_can('administrator')) {
				$status = 'publish'; // Admin's
			}
			elseif(current_user_can('editor')) {
				$status = 'publish'; // Editor's
			}
			elseif(current_user_can('author')) {
				$status = 'publish'; // Author's
			}
			elseif(current_user_can('contributor')) {
				$status = 'publish'; // Contributor's
			}
			elseif(current_user_can('subscriber')) {
				$status = 'pending'; // Regular user's
			}
			else {
				$status = 'pending'; // No role
			}

			// Elements
			$post_id	= isset( $_POST['post_id'] )	? $_POST['post_id'] : null;
			$link		= isset( $_POST['link'] )		? $_POST['link']	: null;
			$tipo		= isset( $_POST['tipo'] )		? $_POST['tipo']	: null;
			$size		= isset( $_POST['size'] )		? $_POST['size']	: null;
			$calidad	= isset( $_POST['calidad'] )	? $_POST['calidad'] : null;
			$idioma		= isset( $_POST['idioma'] )		? $_POST['idioma']	: null;

			// Update data
			$post = array('ID'=> $post_id,'post_status' => $status);
			wp_update_post( $post );
			update_post_meta( $post_id, 'links_type', esc_attr( $tipo ) );
			update_post_meta( $post_id, 'links_url', esc_attr( $link ) );
			update_post_meta( $post_id, 'dt_filesize', esc_attr( $size ) );
			update_post_meta( $post_id, 'links_idioma', esc_attr( $idioma ) );
			update_post_meta( $post_id, 'links_quality', esc_attr( $calidad ) );
			echo '<div class="form_edit">';
			echo '<div class="cerrar"><a id="cerrar_form_edit_link"><i class="icon-close"></i></a></div>';
			echo '<div class="ready"><i class="icon-check-circle"></i>'.__d('Updated link').'</div>';
			echo '</div>';
		}
		die();
	}
	add_action('wp_ajax_save_user_link', 'save_user_link');
	add_action('wp_ajax_nopriv_save_user_link', 'save_user_link');
}

/* Live Search
========================================================
*/
if( ! function_exists( 'dooplay_live_search' ) ) {
	function dooplay_live_search( $request_data ) {
	   	$parameters = $request_data->get_params();
	    $keyword    = dt_clear($parameters['keyword']);
	    $nonce      = dt_clear($parameters['nonce']);
		$types      = array('movies','tvshows');
		if( !dooplay_verify_nonce('dooplay-search-nonce', $nonce ) ) return array('error' => 'no_verify_nonce', 'title' => __d('No data nonce') );
		if( !isset( $keyword ) || empty($keyword) ) return array('error' => 'no_parameter_given');
		if( strlen( $keyword ) <= 2 ) return array('error' => 'keyword_not_long_enough', 'title' => __d('') );

		$args = array(
			's'              => $keyword,
			'post_type'      => $types,
			'posts_per_page' => 6
		);
	    $query = new WP_Query( $args );
	    if ( $query->have_posts() ) {
	    	$data = array();
	        while ( $query->have_posts() ) {
	            $query->the_post();
	            global $post;
	            $data[$post->ID]['title'] = $post->post_title;
	            $data[$post->ID]['url'] = get_the_permalink();
				if ( has_post_thumbnail() ) {
					$data[$post->ID]['img'] = get_the_post_thumbnail_url($post->ID, 'dt_poster_b');
				} elseif ($dato = dt_get_meta('dt_poster')) {
					$data[$post->ID]['img']	= dt_image_search('dt_poster', $post->ID, 'w92', false, true );
				} else {
					$data[$post->ID]['img']	= esc_url( DOO_URI ) . '/assets/img/no/poster-small.png';
				}
				if($dato = dt_get_meta('release_date')) {
					$data[$post->ID]['extra']['date'] = substr($dato, 0, 4);
				}
				if($dato = dt_get_meta('first_air_date')) {
					$data[$post->ID]['extra']['date'] = substr($dato, 0, 4);
				}
				$data[$post->ID]['extra']['imdb'] = dt_get_meta('imdbRating');
	        }
	        return $data;
	    } else {
	    	return array('error' => 'no_posts', 'title' => __d('No results') );
	    }
	    wp_reset_postdata();
	}
}

/* Live Glossary
========================================================
*/
if( ! function_exists( 'dooplay_live_glossary' ) ) {

	function dooplay_live_glossary( $request_data ) {

	    $parameters = $request_data->get_params();
	    $term	    = dt_clear( $parameters['term'] );
		$nonce	    = dt_clear( $parameters['nonce'] );
	    $type       = isset( $parameters['type'] ) ? $parameters['type'] : null;
		if( !dooplay_verify_nonce('dooplay-search-nonce', $nonce ) ) return array('error' => 'no_verify_nonce', 'title' => __d('No data nonce') );
	    if( !isset( $term ) || empty($term) ) return array('error' => 'no_parameter_given');
	    if( $type == all )  $post_types = array('movies','tvshows'); else $post_types = $type;

	    $args = array(
	        'doo_first_letter' => $term,
	        'post_type'        => $post_types,
			'post_status'      => 'publish',
	        'posts_per_page'   => 18,
	    	'orderby'          => 'rand',
	    );

	    query_posts( $args );

	    if ( have_posts() ) {
	        $data = array();
	        while ( have_posts() ) {
	            the_post();
	            global $post;
	            $data[$post->ID]['title']   = $post->post_title;
	            $data[$post->ID]['url']     = get_the_permalink();
	            if ( has_post_thumbnail() ) {
					$data[$post->ID]['img'] = get_the_post_thumbnail_url($post->ID, 'dt_poster_b');
				} elseif ($dato = dt_get_meta('dt_poster')) {
					$data[$post->ID]['img']	= dt_image_search('dt_poster', $post->ID, 'w92', false, true );
				} else {
					$data[$post->ID]['img']	= esc_url( DOO_URI ) . '/assets/img/no/poster-small.png';
				}
	            if($dato = dt_get_meta('release_date')) $data[$post->ID]['year'] = substr($dato, 0, 4);

				if($dato = dt_get_meta('first_air_date')) $data[$post->ID]['year'] = substr($dato, 0, 4);

				$data[$post->ID]['imdb'] = dt_get_meta('imdbRating');
	        }
	        return $data;

	    } else {
	        return array('error' => 'no_posts', 'title' => __d('No results') );
	    }
	    wp_reset_query();
	}
}

/* Add Post featured
========================================================
*/
if( ! function_exists( 'dt_add_featured' ) ) {
	function dt_add_featured(){
		global $wpdb;
		$postid		= isset($_REQUEST['postid']) ? $_REQUEST['postid'] : null;
		$nonce		= isset($_REQUEST['nonce'])  ? $_REQUEST['nonce']  : null;
		$newdate	= date("Y-m-d H:i:s");
		if($postid AND wp_verify_nonce( $nonce, 'dt-featured-'. $postid )) {
			$wpdb->query( "UPDATE `$wpdb->posts` SET `post_modified` = '".$newdate."' WHERE `ID` = '".$postid."'" );
			$wpdb->query( "UPDATE `$wpdb->posts` SET `post_modified_gmt` = '".$newdate."' WHERE `ID` = '".$postid."'" );
			update_post_meta($postid, 'dt_featured_post', '1');
		}
		die();
	}
	add_action('wp_ajax_dt_add_featured', 'dt_add_featured');
	add_action('wp_ajax_nopriv_dt_add_featured', 'dt_add_featured');
}

/* Delete Post featured
========================================================
*/
if( ! function_exists( 'dt_remove_featured' ) ) {
	function dt_remove_featured(){
		$postid		= isset($_REQUEST['postid']) ? $_REQUEST['postid'] : null;
		$nonce		= isset($_REQUEST['nonce'])  ? $_REQUEST['nonce']  : null;
		if($postid AND wp_verify_nonce( $nonce, 'dt-featured-'. $postid )) {
			delete_post_meta( $postid, 'dt_featured_post');
		}
		die();
	}
	add_action('wp_ajax_dt_remove_featured', 'dt_remove_featured');
	add_action('wp_ajax_nopriv_dt_remove_featured', 'dt_remove_featured');
}

/* Filter all content
========================================================
*/
if( ! function_exists( 'dt_social_count' ) ) {
	function dt_social_count() {
		$idpost = isset( $_POST['id'] ) ? $_POST['id']: null;
		$meta = get_post_meta( $idpost, 'dt_social_count', true);
		$total = $meta +1;
		update_post_meta( $idpost, 'dt_social_count', $total );
		echo comvert_number($total);
		die();
	}
	add_action('wp_ajax_dt_social_count', 'dt_social_count');
	add_action('wp_ajax_nopriv_dt_social_count', 'dt_social_count');
}
/* Delete count report
========================================================
*/
if( ! function_exists( 'delete_notice_report' ) ) {
	function delete_notice_report() {
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		if(current_user_can('administrator')) {
			delete_post_meta($id, 'numreport' );
		}
		die();
	}
	add_action('wp_ajax_delete_notice_report', 'delete_notice_report');
	add_action('wp_ajax_nopriv_delete_notice_report', 'delete_notice_report');
}

/* Cookie Player width ( Save )
========================================================
*/
if( ! function_exists( 'dt_player_cookie_save' ) ) {
	function dt_player_cookie_save() {
		$expire = 86400 * 5;
		dt_cookie('dt_player_width', 'full', $expire);
		die();
	}
	add_action('wp_ajax_dtpcookie_save', 'dt_player_cookie_save');
	add_action('wp_ajax_nopriv_dtpcookie_save', 'dt_player_cookie_save');
}

/* Cookie Player width ( Update )
========================================================
*/
if( ! function_exists( 'dt_player_cookie_update' ) ) {
	function dt_player_cookie_update() {
		$expire = 86400 * 5;
		dt_cookie('dt_player_width', 'medium', $expire);
		die();
	}
	add_action('wp_ajax_dtpcookie_update', 'dt_player_cookie_update');
	add_action('wp_ajax_nopriv_dtpcookie_update', 'dt_player_cookie_update');
}

/* Cookie Database Updater
========================================================
*/
if( !function_exists('dt_update_db_dooplay') ) {

	function dt_update_db_dooplay() {

		// Verify parameters
		if( current_user_can('administrator') AND isset( $_REQUEST['action'] ) ) {

			global $wpdb;

			// Cleaner Database
	        dt_clear_database('postmeta', 'meta_key', 'status');
			dt_clear_database('postmeta', 'meta_key', '_user_liked');
			dt_clear_database('postmeta', 'meta_key', '_post_like_modified');
			dt_clear_database('postmeta', 'meta_key', '_post_like_count');
			dt_clear_database('usermeta', 'meta_key', $wpdb->base_prefix.'_user_like_count');

			// Delete options
			delete_option('dt_cleardb_date');
	        delete_option('minify_html_active');
	        delete_option('minify_html_comments');
			delete_option('wp_app_dbmkey');
			delete_option('dt_register_note');
			delete_option('_site_register_in_dbmvs');
			delete_option('dt_activate_api');
			delete_option('dt_api_key');
			delete_option('dt_api_language');
			delete_option('dt_api_genres');
			delete_option('dt_api_upload_poster');
			delete_option('dt_api_release_date');
			delete_option('dt_shorcode_home');
			delete_option('dt_main_slider');
			delete_option('dt_main_slider_radom');
			delete_option('dt_main_slider_autoplay');
			delete_option('dt_main_slider_order');
			delete_option('dt_main_slider_speed');
			delete_option('dt_main_slider_items');

			// Update options
			update_option('dt_links_table_size', 'true');
			update_option('dt_links_table_added', 'true');
			update_option('dt_links_table_quality', 'true');
			update_option('dt_links_table_language', 'true');
			update_option('dt_links_table_user', 'true');

			// Update version Database
			update_option( 'dooplay_database', DOO_VERSION_DB );

		}
		die();
	}
	add_action('wp_ajax_update_dbdooplay', 'dt_update_db_dooplay');
	add_action('wp_ajax_nopriv_update_dbdooplay', 'dt_update_db_dooplay');
}

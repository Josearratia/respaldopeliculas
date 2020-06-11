<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.4
*
*/

if( ! function_exists( 'dt_styles' ) ) {
	function dt_styles()  {
		global $doo_font;
		$theme = get_option('dt_color_style','default');
		wp_enqueue_style('owl-carousel', DOO_URI .'/assets/css/front.owl.css' , array(), DOO_VERSION );
	    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family='. $doo_font .':300,400,500,700' , array(), null );
		wp_enqueue_style('icons', DOO_URI .'/assets/css/front.icons.css' , array(), DOO_VERSION );
		wp_enqueue_style('scrollbar', DOO_URI .'/assets/css/front.crollbar.css' , array(), DOO_VERSION );
		wp_enqueue_style('theme', DOO_URI .'/assets/css/front.style.css' , array(), DOO_VERSION );
		wp_enqueue_style('color-scheme', DOO_URI .'/assets/css/colors.'.$theme.'.css' , array(), DOO_VERSION );
		wp_enqueue_style('responsive', DOO_URI .'/assets/css/front.mobile.css' , array(), DOO_VERSION );
	}
	add_action('wp_enqueue_scripts', 'dt_styles');
}

/* javascript */
if( ! function_exists( 'dt_scripts' ) ) {
	function dt_scripts() {
		if( !wp_is_mobile() ) {
			wp_enqueue_script('scrollbar',  DOO_URI .'/assets/js/front.scrollbar.js' , array('jquery'), DOO_VERSION, false );
		}
		wp_enqueue_script('owl',  DOO_URI .'/assets/js/front.owl.js' , array('jquery'), DOO_VERSION, false  );
		if(is_single()) {  wp_enqueue_script('idTabs',  DOO_URI .'/assets/js/front.tabs.js' , array('jquery'), DOO_VERSION, false  ); }
		if(is_page()) {  wp_enqueue_script('idTabs',  DOO_URI .'/assets/js/front.tabs.js' , array('jquery'), DOO_VERSION, false  ); }
		if(is_author()) {  wp_enqueue_script('idTabs',  DOO_URI .'/assets/js/front.tabs.js' , array('jquery'), DOO_VERSION, false  ); }
		if(is_single()) {  wp_enqueue_script('dtRepeat',  DOO_URI .'/assets/js/front.repeater.js' , array('jquery'), DOO_VERSION, false  ); }
		wp_enqueue_script('scripts',  DOO_URI .'/assets/js/front.scripts.js' , array('jquery'), DOO_VERSION, true  );
	    if ( is_singular() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply');
		}
		if ( is_singular() ) {
			wp_enqueue_style('blueimp-gallery', DOO_URI .'/assets/css/front.gallery.css' , array(), DOO_VERSION, 'all');
			wp_enqueue_script('blueimp-gallery',  DOO_URI .'/assets/js/front.gallery.js' , array('jquery'), DOO_VERSION, false  );
			if( get_option('dt_grpublic_key') != null AND get_option('dt_grprivate_key') != null ) {
				wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js', array(), DOO_VERSION, false );
			}
		}
	}
	add_action('wp_enqueue_scripts', 'dt_scripts');
}

// Live Search The function
if( ! function_exists( 'live_search' ) ) {
	function live_search() {
		$args = array(
			'api'	           => dooplay_url_search(),
	        'glossary'         => dooplay_url_glossary(),
			'nonce'            => dooplay_create_nonce('dooplay-search-nonce'),
			'area'	           => ".live-search",
			'button'	       => ".search-button",
			'more'		       => __d('View all results'),
			'mobile'	       => doo_mobile(),
			'reset_all'        => __d('Really you want to restart all data?'),
			'manually_content' => __d('They sure have added content manually?'),
	        'loading'          => __d('Loading..'),
			'livesearchactive' => get_option('dt_live_search')
		);
		wp_enqueue_script('live_search', DOO_URI .'/assets/js/front.livesearch.js', array('jquery'), DOO_VERSION, true );
		wp_localize_script('live_search', 'dtGonza', $args);
	}
	add_action('wp_enqueue_scripts', 'live_search');
}


// Ajax Admin
if( ! function_exists( 'dt_ajax_admin' ) ) {
	function dt_ajax_admin() {
		wp_enqueue_script('ajax_dooplay_upload', DOO_URI . '/assets/js/admin.upload.js', array('jquery'), DOO_VERSION, false );
		wp_enqueue_script('ajax_dooplay_admin', DOO_URI . '/assets/js/admin.ajax.js', array('jquery'), DOO_VERSION, false );
		wp_localize_script('ajax_dooplay_admin', 'dooAj', array(
				// Importar
				'url' => admin_url('admin-ajax.php', 'relative'),
				'loading'	=> __d('Loading...'),
				'reloading' => __d('Reloading..'),
				'exists'	=> __d('Domain has already been registered'),
				'updb'		=> __d('Updating database..'),
				'completed' => __d('Action completed'),
				'rem_featu'	=> __d('Remove featured'),
				'add_featu' => __d('Add to featured'),
				'domain'	=> dt_domain( get_site_url() ),
				'doothemes_server'	=> DOO_SERVER,
				'doothemes_license' => get_option( DOO_THEME_SLUG. '_license_key'),
				'doothemes_item'	=> DOO_THEME,
			) );
	}
	add_action('admin_enqueue_scripts', 'dt_ajax_admin');
}

/* owl controls */
if( ! function_exists( 'dooplay_scripts_footer' ) ) {
	function dooplay_scripts_footer() {
		#globals
		global $user_ID, $post;

		# Options
		$dt_featured_slider_ac   = get_option('dt_featured_slider_ac');
		$dt_featured_slider_ap   = get_option('dt_featured_slider_ap');
		$dt_mm_activate_slider   = get_option('dt_mm_activate_slider');
		$dt_mm_autoplay_slider   = get_option('dt_mm_autoplay_slider');
		$dt_mt_activate_slider   = get_option('dt_mt_activate_slider');
		$dt_mt_autoplay_slider   = get_option('dt_mt_autoplay_slider');
		$dt_me_autoplay_slider   = get_option('dt_me_autoplay_slider');
		$dt_ms_autoplay_slider   = get_option('dt_ms_autoplay_slider');
		$dt_autoplay_s_movies    = get_option('dt_autoplay_s_movies');
		$dt_slider_speed         = get_option('dt_slider_speed','3000');
		$dt_autoplay_s_tvshows   = get_option('dt_autoplay_s_tvshows');
		$dt_autoplay_s           = get_option('dt_autoplay_s');
		$dt_google_analytics     = get_option('dt_google_analytics');
	    $dt_full_width           = get_option('dt_layout_full_width');

		# conditionals
		$cond['0'] = ($dt_featured_slider_ap   == "true") ? "3500"                : "false";
		$cond['1'] = ($dt_mm_autoplay_slider   == "true") ? "3500"                : "false";
		$cond['2'] = ($dt_mt_autoplay_slider   == "true") ? "3500"                : "false";
		$cond['3'] = ($dt_me_autoplay_slider   == "true") ? "3500"                : "false";
		$cond['4'] = ($dt_ms_autoplay_slider   == "true") ? "3500"                : "false";
		$cond['5'] = ($dt_autoplay_s_movies    == "true") ? $dt_slider_speed      : "false";
		$cond['6'] = ($dt_autoplay_s_tvshows   == "true") ? $dt_slider_speed      : "false";
		$cond['7'] = ($dt_autoplay_s           == "true") ? $dt_slider_speed      : "false";


	    // Condicionals full width
	    $cond['9']  = ($dt_full_width == "true") ? "6" : "5";
	    $cond['10'] = ($dt_full_width == "true") ? "5" : "4";
	    $cond['11'] = ($dt_full_width == "true") ? "4" : "3";
	    $cond['12'] = ($dt_full_width == "true") ? "3" : "2";

		echo "<script type='text/javascript'>\n";
		echo "jQuery(document).ready(function($) {\n";
		if(is_single()) {
			echo "$('#dt_galery').owlCarousel({ items:3,autoPlay:false,itemsDesktop:[1199,3],itemsDesktopSmall:[980,3],itemsTablet:[768,3],itemsTabletSmall:false,itemsMobile:[479,1] });\n";
			echo "$('#dt_galery_ep').owlCarousel({ items:2,autoPlay:false });\n";
			echo "$('#single_relacionados').owlCarousel({ items:6,autoPlay:3000,stopOnHover:true,pagination:false,itemsDesktop:[1199,6],itemsDesktopSmall:[980,6],itemsTablet:[768,5],itemsTabletSmall:false,itemsMobile:[479,3] });\n";
		} else {
			if($dt_featured_slider_ac == 'true') {
				echo "$('#featured-titles').owlCarousel({ autoPlay:". $cond['0'] .",items:".$cond['10'].",stopOnHover:true,pagination:false,itemsDesktop:[1199,4],itemsDesktopSmall:[980,4],itemsTablet:[768,3],itemsTabletSmall: false,itemsMobile : [479,2] });\n";
				echo "$('.nextf').click(function(){ $('#featured-titles').trigger('owl.next') });\n";
				echo "$('.prevf').click(function(){ $('#featured-titles').trigger('owl.prev') });\n";

			}
			if($dt_mm_activate_slider == 'true') {
				echo "$('#dt-movies').owlCarousel({ autoPlay:". $cond['1'] .",items:".$cond['9'].",stopOnHover:true,pagination:false,itemsDesktop:[1199,5],itemsDesktopSmall:[980,5],itemsTablet:[768,4],itemsTabletSmall: false,itemsMobile : [479,3] });\n";
				if($dt_mm_autoplay_slider != 'true') {
					echo "$('.next3').click(function(){ $('#dt-movies').trigger('owl.next') });\n";
					echo "$('.prev3').click(function(){ $('#dt-movies').trigger('owl.prev') });\n";
				}
			}
			if($dt_mt_activate_slider == 'true') {
				echo "$('#dt-tvshows').owlCarousel({ autoPlay:". $cond['2'] .",items:".$cond['9'].",stopOnHover:true,pagination:false,itemsDesktop:[1199,5],itemsDesktopSmall:[980,5],itemsTablet:[768,4],itemsTabletSmall:false,itemsMobile:[479,3] });\n";
				if($dt_mt_autoplay_slider != 'true') {
					echo "$('.next4').click(function(){ $('#dt-tvshows').trigger('owl.next') });\n";
					echo "$('.prev4').click(function(){ $('#dt-tvshows').trigger('owl.prev') });\n";
				}
			}
			echo "$('#dt-episodes').owlCarousel({ autoPlay:". $cond['3'] .",pagination:false,items:".$cond['11'].",stopOnHover:true,itemsDesktop:[900,3],itemsDesktopSmall:[750,3],itemsTablet:[500,2],itemsMobile:[320,1] });\n";
			if($dt_me_autoplay_slider != 'true') {
				echo "$('.next').click(function(){ $('#dt-episodes').trigger('owl.next') });\n";
				echo "$('.prev').click(function(){ $('#dt-episodes').trigger('owl.prev') });\n";
			}
			echo "$('#dt-seasons').owlCarousel({ autoPlay:". $cond['4'] .",items:".$cond['9'].",stopOnHover:true,pagination:false,itemsDesktop:[1199,5],itemsDesktopSmall:[980,5],itemsTablet:[768,4],itemsTabletSmall:false,itemsMobile:[479,3] });\n";
			if( $dt_ms_autoplay_slider != 'true') {
				echo "$('.next2').click(function(){ $('#dt-seasons').trigger('owl.next') });\n";
				echo "$('.prev2').click(function(){ $('#dt-seasons').trigger('owl.prev') });\n";
			}
			echo "$('#slider-movies').owlCarousel({ autoPlay:". $cond['5'] .",items:".$cond['12'].",stopOnHover:true,pagination:true,itemsDesktop:[1199,2],itemsDesktopSmall:[980,2],itemsTablet:[768,2],itemsTabletSmall:[600,1],itemsMobile:[479,1] });\n";
			echo "$('#slider-tvshows').owlCarousel({ autoPlay:". $cond['6'] .",items:".$cond['12'].",stopOnHover:true,pagination:true,itemsDesktop:[1199,2],itemsDesktopSmall:[980,2],itemsTablet:[768,2],itemsTabletSmall:[600,1],itemsMobile:[479,1] });\n";
			echo "$('#slider-movies-tvshows').owlCarousel({ autoPlay:". $cond['7'] .",items:".$cond['12'].",stopOnHover:true,pagination:true,itemsDesktop:[1199,2],itemsDesktopSmall:[980,2],itemsTablet:[768,2],itemsTabletSmall:[600,1],itemsMobile:[479,1] });\n";
		}
		if(is_single()) {
			if( $user_ID ) {
				if( current_user_can('level_10') ) {
					echo "$('.dtload').click(function() { var o = $(this).attr('id'); 1 == o ? ($('.dtloadpage').hide(), $(this).attr('id', '0')) : ($('.dtloadpage').show(), $(this).attr('id', '1')) });\n";
					echo "$('.dtloadpage').mouseup(function() { return !1 });\n";
					echo "$('.dtload').mouseup(function() { return !1 });\n";
					echo "$(document).mouseup(function() { $('.dtloadpage').hide(), $('.dtload').attr('id', '') });\n";
				}
			}
		}
		echo "$('.reset').click(function(event){ if (!confirm( dtGonza.reset_all )) { event.preventDefault() } });\n";
		echo "$('.addcontent').click(function(event){ if (!confirm( dtGonza.manually_content )) { event.preventDefault() } });";
		echo "});\n";
		if( is_single() == true AND get_post_type() != 'seasons' AND get_post_meta($post->ID, 'imagenes', true) ) {
			echo "document.getElementById('dt_galery').onclick=function(a){a=a||window.event;var b=a.target||a.srcElement,c=b.src?b.parentNode:b,d={index:c,event:a},e=this.getElementsByTagName('a');blueimp.Gallery(e,d)};\n";
		}
		if($dt_google_analytics) {
			echo "(function(b,c,d,e,f,h,j){b.GoogleAnalyticsObject=f,b[f]=b[f]||function(){(b[f].q=b[f].q||[]).push(arguments)},b[f].l=1*new Date,h=c.createElement(d),j=c.getElementsByTagName(d)[0],h.async=1,h.src=e,j.parentNode.insertBefore(h,j)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'),ga('create','".$dt_google_analytics."','auto'),ga('send','pageview');\n";
		}
		echo "</script>\n";
	}
	add_action('wp_footer', 'dooplay_scripts_footer');
}

if( ! function_exists( 'dooplay_scripts_head' ) ) {
	function dooplay_scripts_head() {
		echo "<script type='text/javascript'>jQuery(document).ready(function(a){'false'==dtGonza.mobile&&a(window).load(function(){a('.scrolling').mCustomScrollbar({theme:'minimal-dark',scrollButtons:{enable:!0},callbacks:{onTotalScrollOffset:100,alwaysTriggerOffsets:!1}})})});</script>";
	}
	add_action('wp_head', 'dooplay_scripts_head');
}

/* facebook JS */
if( ! function_exists( 'dt_fb_js' ) ) {
	function dt_fb_js() {
		if(is_single()) { if( get_option('dt_commets') == 'comtfb') { ?>
	<div id="fb-root"></div>
	<script type="text/javascript">
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/<?php echo get_option('dt_app_language_facebook'); ?>/sdk.js#xfbml=1&version=v2.6&appId=<?php echo get_option('dt_app_id_facebook'); ?>";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<?php
			}
		}
	}
	add_action('wp_head', 'dt_fb_js');
}

if( ! function_exists( 'dt_fb_js_page' ) ) {
	function dt_fb_js_page() {
		if(is_page()) { if( get_option('dt_commets') == 'comtfb') { ?>
	<div id="fb-root"></div>
	<script type="text/javascript">
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "https://connect.facebook.net/<?php echo get_option('dt_app_language_facebook'); ?>/sdk.js#xfbml=1&version=v2.6&appId=<?php echo get_option('dt_app_id_facebook'); ?>";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<?php
			}
		}
	}
	add_action('wp_head', 'dt_fb_js_page');
}

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
if( ! function_exists( 'header_output' ) ) {
	function header_output() {
		global $doo_font;
		$color1 = get_option('color1');
		$color2 = get_option('color2');
		$custom = get_option('dt_custom_css');
		$dt_color_style = get_option('dt_color_style');
		echo "\n<style type='text/css'>\n";
		// fonts
		dt_css('body', 'font-family', '"'. $doo_font .'", sans-serif');
	    dt_css('body', 'background', $color2);
		// color
		dt_css('a,.home-blog-post .entry-date .date,.top-imdb-item:hover>.title a,.module .content .items .item .data h3 a:hover,.head-main-nav ul.main-header li:hover>a,.login_box .box a.register', 'color', $color1);
		dt_css('.nav_items_module a.btn:hover,.pagination span.current,.w_item_b a:hover>.data span.wextra b i,.comment-respond h3:before,footer.main .fbox .fmenu ul li a:hover','color', $color1);
		dt_css('header.main .hbox .search form button[type=submit]:hover,.loading,#seasons .se-c .se-a ul.episodios li .episodiotitle a:hover,.sgeneros a:hover,.page_user nav.user ul li a:hover','color',$color1);
		dt_css('footer.main .fbox .fmenu ul li.current-menu-item a,.posts .meta .autor i,.pag_episodes .item a:hover,a.link_a:hover,ul.smenu li a:hover','color', $color1);
		dt_css('header.responsive .nav a.active:before, header.responsive .search a.active:before,.dtuser a.clicklogin:hover,.menuresp .menu ul.resp li a:hover,.menuresp .menu ul.resp li ul.sub-menu li a:hover','color', $color1);
		dt_css('.sl-wrapper a:before,table.account_links tbody td a:hover,.dt_mainmeta nav.genres ul li a:hover','color', $color1);
		dt_css('.dt_mainmeta nav.genres ul li.current-cat a:before','color', $color1);
		dt_css('.head-main-nav ul.main-header li ul.sub-menu li a:hover,form.form-resp-ab button[type=submit]:hover>span,.sidebar aside.widget ul li a:hover', 'color', $color1);
		dt_css('header.top_imdb h1.top-imdb-h1 span,article.post .information .meta span.autor,.w_item_c a:hover>.rating i,span.comment-author-link,.pagination a:hover','color',$color1);
		dt_css('.letter_home ul.glossary li a:hover, .letter_home ul.glossary li a.active, .user_control a.in-list', 'color', $color1);
		if($dt_color_style == 'dark') dt_css('.starstruck .star-on-png:before','color', $color1);
		// Background
		dt_css('.linktabs ul li a.selected,ul.smenu li a.selected,a.liked,.module .content header span a.see-all,.page_user nav.user ul li a.selected,.dt_mainmeta nav.releases ul li a:hover','background', $color1);
		dt_css('a.see_all,p.form-submit input[type=submit]:hover,.report-video-form fieldset input[type=submit],a.mtoc,.contact .wrapper fieldset input[type=submit],span.item_type,a.main', 'background', $color1);
		dt_css('.head-main-nav ul.main-header li a i,.post-comments .comment-reply-link:hover,#seasons .se-c .se-q span.se-o,#edit_link .box .form_edit .cerrar a:hover','background',$color1);
		dt_css('.user_edit_control ul li a.selected,form.update_profile fieldset input[type=submit],.page_user .content .paged a.load_more:hover,#edit_link .box .form_edit fieldset input[type="submit"]','background', $color1);
		dt_css('.login_box .box input[type="submit"],.form_post_lik .control .left a.add_row:hover,.form_post_lik .table table tbody tr td a.remove_row:hover,.form_post_lik .control .right input[type="submit"]','background', $color1);
		dt_css('#dt_contenedor','background', $color2);
		dt_css('.plyr input[type=range]::-ms-fill-lower', 'background', $color1);
		dt_css('.menuresp .menu .user a.ctgs,.menuresp .menu .user .logout a:hover', 'background', $color1);
		dt_css('.plyr input[type=range]:active::-webkit-slider-thumb', 'background', $color1);
		dt_css('.plyr input[type=range]:active::-moz-range-thumb', 'background', $color1);
		dt_css('.plyr input[type=range]:active::-ms-thumb', 'background', $color1);
		dt_css('.tagcloud a:hover,ul.abc li a:hover,ul.abc li a.select, ','background',$color1);

		// border color
		dt_css('.contact .wrapper fieldset input[type=text]:focus, .contact .wrapper fieldset textarea:focus,header.main .hbox .dt_user ul li ul li:hover > a,.login_box .box a.register','border-color',$color1);
		dt_css('.module .content header h1','border-color', $color1);
		dt_css('.module .content header h2','border-color', $color1);
		dt_css('a.see_all','border-color', $color1);
		dt_css('.top-imdb-list h3', 'border-color', $color1);
		dt_css('.user_edit_control ul li a.selected:before','border-top-color', $color1 );

		// custom CSS
		if($custom) { echo "\n$custom\n"; }
		echo "</style>\n";
	}
	add_action('wp_head','header_output');
}

// Generate CSS Line
if( ! function_exists( 'dt_css' ) ) {
	function dt_css( $class = null, $type = null, $val = null ) {
		if($class != null AND $type != null AND $val != null ) {
			$class = sprintf('%s{%s:%s;}', $class, $type, $val);
			echo "$class\n";
		}
	}
}

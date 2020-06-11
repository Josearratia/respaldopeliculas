<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2017 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.1.3
*
*/

$option = get_option('dt_activate_post_links');

if( DOO_THEME_DOWNLOAD_MOD == true || $option =='true') {
	echo '<div class="box_links">';
	get_template_part('inc/parts/single/listas/links');
	echo '</div>';
}

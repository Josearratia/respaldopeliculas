<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.1.4
*
*/

// Header
get_header();

// Glossary
doo_glossary();

// Modules
$modules = array(
	'slider'        => null,
	'featured-post' => null,
	'movies'        => null,
	'ads'           => null,
	'tvshows'       => null,
	'seasons'       => null,
	'episodes'      => null,
	'top-imdb'      => null,
	'blog'          => null
);

// Options
$full_width   = get_option('dt_layout_full_width');
$home_modules = get_option('dt_home_sortable');
$home_enabled = ( ! empty( $home_modules['enabled'] ) ) ? $home_modules['enabled'] : $modules;
$home_class	  = ($full_width == "true") ? 'full_width_layout' : null;

// Print home
echo '<div class="module">';
echo '<div class="content '.$home_class.'">';
if( ! empty( $home_enabled ) ) {

	// Get template
	foreach( $home_enabled as $template => $template_name ) {
		get_template_part('inc/parts/modules/'. $template );
	}

}
echo '</div>';

// Sidebar
if( $full_width != "true") {
	echo '<div class="sidebar scrolling"><div class="fixed-sidebar-blank">';
	if( $widgets = dynamic_sidebar('sidebar-home') ) {

		// Dynamic sidebar
		$widgets;

	} else {

		// Notice sidebar NULL
		echo '<a href="'. esc_url( home_url() ) .'/wp-admin/widgets.php">'. __d('Add widgets') .'</a>';

	}
	echo '</div></div>';
}
echo '</div>';

// Footer
get_footer();

// End home

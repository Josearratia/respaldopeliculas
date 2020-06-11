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
function dt_requests() {
	$labels = array(
		'name'                => __d('Requests'),
		'singular_name'       => __d('Requests'),
		'menu_name'           => __d('Requests'),
		'name_admin_bar'      => __d('Requests'),
		'all_items'           => __d('Requests'),
	);
	$rewrite = array(
		'slug'                => get_option('dt_requests_slug','requests'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __d('Requests'),
		'description'         => __d('Requests manage'),
		'labels'              => $labels,
		'supports'            => array('title','thumbnail'),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-add-page',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type('requests', $args );
}
add_action('init', 'dt_requests', 0 );

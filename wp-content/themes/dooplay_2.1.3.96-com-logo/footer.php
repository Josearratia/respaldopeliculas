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


// Options
$option[0] = get_option('dt_defaul_footer');
$option[1] = get_option('dt_footer_code');
$option[2] = get_option('dt_logo_footer');
$option[3] = get_option('dt_footer_text');
$option[4] = get_option('dt_footer_tt1');
$option[5] = get_option('dt_footer_tt2');
$option[6] = get_option('dt_footer_tt3');
$option[7] = get_option('dt_footer_copyright');

// Copyright
$copytext = sprintf( __d('%s %s %s. Todos os Direitos Reservados.'), '&copy;', date('Y'), '<strong>'.get_option('blogname').'</strong>', '<a href="'.DOO_SERVER.'"><strong>'.DOO_COM.'</strong></a>' );
$copyright = ($option[7]) ? $option[7] : $copytext;

// Print Header
?>
</div>
<footer class="main">
	<div class="fbox">
		<div class="fcmpbox">
			<?php if( $option[0] == 'complete' ) { ?>
			<div class="primary">
				<div class="columenu">

					<div class="item">
					   <?php echo ( $option[4] ) ? '<h3>'. $option[4]. '</h3>' : null; ?>
					   <?php wp_nav_menu( array('theme_location' => 'footer1', 'fallback_cb' => null ) ); ?>
					</div>

					<div class="item">
						<?php echo ( $option[5] ) ? '<h3>'. $option[5]. '</h3>' : null; ?>
						<?php wp_nav_menu( array('theme_location' => 'footer2', 'fallback_cb' => null ) ); ?>
					</div>

					<div class="item">
						<?php echo ( $option[6] ) ? '<h3>'. $option[6]. '</h3>' : null; ?>
						<?php wp_nav_menu( array('theme_location' => 'footer3', 'fallback_cb' => null ) ); ?>
					</div>

				</div>
				<div class="fotlogo">
					<?php
					// Logo And text
					echo ( $option[2] ) ? '<div class="logo"><img src="'. $option[2] .'" alt="'.get_bloginfo().'" /></div>' : null;
					echo ( $option[3] ) ? '<div class="text"><p>'. $option[3]. '</p></div>' : null;
					?>
				</div>
			</div>
			<?php } ?>
			<div class="copy"><?php echo $copyright; ?></div>
			<span class="top-page"><a id="top-page"><i class="icon-angle-up"></i></a></span>
			<?php wp_nav_menu( array('theme_location' => 'footer','container_class' => 'fmenu', 'fallback_cb' => null ) ); ?>
		</div>
	</div>
</footer>
</div>
<?php wp_footer();  if( $option[1] ) echo stripslashes( $option[1] ). "\n"; ?>
<div id="oscuridad"></div>
<?php if( is_single() == true AND get_post_type() != 'seasons' AND get_post_meta($post->ID, 'imagenes', true) ) { ?>
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev"><?php _d('‹'); ?></a>
    <a class="next"><?php _d('›'); ?></a>
    <a class="close"><?php _d('×'); ?></a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<?php } ?>
</body>
</html>

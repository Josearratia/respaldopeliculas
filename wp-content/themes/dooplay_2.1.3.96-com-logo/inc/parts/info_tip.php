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

$dt_player	= get_post_meta($post->ID, 'repeatable_fields', true); 
$year = get_the_term_list( $post->ID, 'dtyear');
$genres = get_the_term_list($post->ID, 'genres', '<div class="genres"><div class="mta">', '', '</div></div>');
?>
<div class="animation-1 dtinfo">
	<div class="title">
		<h4><?php the_title(); ?></h4>
		<?php if($dt_player) { ?>
		<span class="flags">
			<?php $i=0; if ( $dt_player ) : foreach ( $dt_player as $field ) { if($i==2) break; if($field['idioma']) { ?>
				<div class="flag" style="background-image: url(<?php echo DOO_URI, '/assets/img/flags/',$field['idioma'],'.png'; ?>)"></div>
			<?php } $i++; } endif; ?>
		</span>
		<?php } ?>
	</div>
	<div class="metadata">
		<?php echo ($imdb = dt_get_meta('imdbRating')) ? '<span class="imdb">IMDb: '.$imdb.'</span>' : ''; ?>
		<?php echo ($year) ? '<span>'. strip_tags($year) .'</span>' : ''; ?>
		<?php echo ($time = dt_get_meta('runtime')) ? '<span>'.$time.' '. __d('min') .'</span>' : ''; ?>
		<?php echo ($views = dt_get_meta('dt_views_count')) ? '<span>'.$views.' '. __d('views') .'</span>' : ''; ?>
	</div>
	<div class="texto"><?php dt_content_alt('150'); ?></div>
	<?php echo $genres; ?>
</div>

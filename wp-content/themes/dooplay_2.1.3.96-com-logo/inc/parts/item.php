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
$thumb_id	= get_post_thumbnail_id();
$thumb_url	= wp_get_attachment_image_src($thumb_id,'dt_poster_a', true);
$rating		= dt_get_meta( DOO_MAIN_RATING );
$imdb		= ( $a = dt_get_meta('imdbRating')) ? $a : '0';
$dt_player	= get_post_meta($post->ID, 'repeatable_fields', true);
?>
<article id="post-<?php the_ID(); ?>" class="item <?php echo get_post_type(); ?>">
	<div class="poster">
		<img src="<?php if($thumb_id) { echo $thumb_url[0]; } else { dt_image('dt_poster', $post->ID, 'w185'); } ?>" alt="<?php the_title(); ?>">
		<div class="rating"><span class="icon-star2"></span> <?php echo ( $rating ) ? $rating : $imdb; ?></div>
		<?php wp_delete_post_link('<span class="icon-times-circle"></span>', '<i class="delete">', '</i>'); ?>
		<div class="mepo">
		<?php if($mostrar = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'dtquality'))) {  ?><span class="quality"><?php echo $mostrar; ?></span><?php } ?>
		</div>
		<a href="<?php the_permalink() ?>"><div class="see"></div></a>
	</div>
	<div class="data">
		<h3>
		<?php $i=0; if ( $dt_player ) : foreach ( $dt_player as $field ) { if($i==1) break; if($field['idioma']) { ?>
		<span class="flag" style="background-image: url(<?php echo DOO_URI, '/assets/img/flags/',$field['idioma'],'.png'; ?>)"></span>
		<?php } $i++; } endif; ?>
		<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		</h3>
		<?php if($mostrar = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'dtyear'))) {  ?>
		<span><?php echo $mostrar; ?></span>
		<?php } else { ?>
		<span>&nbsp;</span>
		<?php } ?>
	</div>
	<?php if( is_archive() == true ) get_template_part('inc/parts/info_tip'); ?>
</article>

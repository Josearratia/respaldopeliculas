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

if(get_option('dt_mm_random_order') == 'true') {
	$rand = 'rand';
} else {
	$rand = '';
} ?>
<header>
<h2><?php echo get_option('dt_mm_title','Movies'); ?></h2>
<?php if( get_option('dt_mm_activate_slider') == 'true' AND get_option('dt_mm_autoplay_slider') != 'true') { ?>
<div class="nav_items_module">
  <a class="btn prev3"><i class="icon-caret-left"></i></a>
  <a class="btn next3"><i class="icon-caret-right"></i></a>
</div>
<?php } ?>
<span><?php echo doo_total_count('movies'); ?> <?php if($url = get_option('dt_movies_slug','movies')) { ?><a href="<?php echo esc_url( home_url() ) .'/'. $url .'/'; ?>" class="see-all"><?php _d('See all'); ?></a><?php } ?></span>
</header>
<div id="movload" class="load_modules"><?php _d('Loading..');?></div>
<div <?php if(get_option('dt_mm_activate_slider') == 'true') { echo 'id="dt-movies"'; } ?> class="items">
	<?php query_posts( array('post_type' => array('movies'), 'showposts' => get_option('dt_mm_number_items','10'), 'orderby' => $rand, 'order' => 'desc')); ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part('inc/parts/item'); ?>
	<?php endwhile; wp_reset_query(); ?>
</div>

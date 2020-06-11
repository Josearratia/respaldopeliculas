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

$metax = get_post_meta($post->ID, "dt_string", $single = true);
$a = new WP_Query( array( 'post_type'=>'dt_links','meta_query'=> array(
array( 'key'=>'dt_string','compare'=>'=','value'=>$metax )
) ) );
if (!empty($a->posts)) {  ?>
<div class="fix-table">
<table class="dt_table_admin">
<thead>
<tr>
<th><?php _d('Type'); ?></th>
<th><?php _d('Server'); ?></th>
<th><?php _d('Quality'); ?></th>
<th><?php _d('Language'); ?></th>
<th><?php _d('Size'); ?></th>
<th><?php _d('Added'); ?></th>
<th><?php _d('Manage'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($a->posts as $p) {
$type		= dt_post_meta( $p->ID, 'links_type');
$url		= dt_post_meta( $p->ID, 'links_url' );
$title		= dt_post_meta( $p->ID, 'dt_postitle' );
$string		= dt_post_meta( $p->ID, 'dt_string' );
$size		= dt_post_meta( $p->ID, 'dt_filesize' );
$lang		= dt_post_meta( $p->ID, 'links_idioma' );
$quality	= dt_post_meta( $p->ID, 'links_quality' );
$permalink	= get_permalink( $p->ID );
?>
<tr id="<?php echo $metax; ?>">
<td><a class="link_a" href="<?php echo $url; ?>" target="_blank"><?php echo $type; ?></a></td>
<td><img src="<?php echo DOO_GICO. saca_dominio($url); ?>"> <?php echo saca_dominio($url); ?></td>
<td><?php echo $quality; ?></td>
<td><?php echo $lang; ?></td>
<td><?php echo $size; ?></td>
<td><?php echo human_time_diff(get_the_time('U',$p->ID), current_time('timestamp',$p->ID)); ?> </td>
<?php if (current_user_can('edit_post', $p->ID)) { ?>
<td>
<?php
echo "<a href='" . esc_url( home_url() ) . "/wp-admin/post.php?post=".$p->ID."&action=edit' target='_blank'>". __d('Edit') ."</a> / ";
echo "<a href='" . wp_nonce_url( esc_url( home_url() ) . "/wp-admin/post.php?action=delete&amp;post=".$p->ID."", 'delete-post_' . $p->ID) . "' target='_blank'>". __d('Delete') ."</a>";
?>
</td>
<?php } ?>
</tr>
<?php
}
echo '</tbody></table></div>';
} else { ?>
<div id="links" class="sbox">
<div class="links_table">
<div class="dt_nodata"><?php _d('no data'); ?></div>
</div>
</div>
<?php
}

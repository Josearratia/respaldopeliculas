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
$id_post = get_the_id();
$author = get_the_author_meta('nickname');
$idcontent = dt_get_meta('dt_postid');
$title = dt_get_meta('dt_postitle');
$url = dt_get_meta('links_url');
$type = dt_get_meta('links_type');
$views = dt_get_meta('dt_views_count');
$status = get_post_status();
?>
<tr id="adm-<?php echo $id_post; ?>">
	<td><a href="<?php the_permalink(); ?>" target="_blank"><img src="<?php echo DOO_GICO, ($type == 'Torrent') ? 'https://utorrent.com' : saca_dominio($url); ?>"> <?php echo ($type == 'Torrent') ? __d('Torrent') : saca_dominio($url); ?></a></td>
	<td><a href="<?php echo home_url(). '?p='. $idcontent; ?>" target="_blank"><?php echo $title; ?></a></td>
	<td><?php echo $author; ?></td>
	<td class="views"><?php if($views) { echo $views; } else { echo "-"; } ?></td>
	<td class="metas status <?php echo $status; ?>"><i class="icon"></i></td>
	<td class="status">
		<a class="edit_link" data-id="<?php echo $id_post; ?>"><?php _d('Edit'); ?></a>
		<?php if(current_user_can('administrator')) { if($status == 'publish') { ?>
		&nbsp;&nbsp;
		<a class="control_admin_link" data-id="<?php echo $id_post; ?>" data-status="pending"><?php _d('Disable'); ?></a>
		<?php } else { ?>
		&nbsp;&nbsp;
		<a class="control_admin_link" data-id="<?php echo $id_post; ?>" data-status="publish"><?php _d('Enable'); ?></a>
		<?php } ?>
		&nbsp;&nbsp;
		<a class="control_admin_link" data-id="<?php echo $id_post; ?>" data-status="trash"><?php _d('Delete'); ?></a>
		<?php } ?>

	</td>
</tr>
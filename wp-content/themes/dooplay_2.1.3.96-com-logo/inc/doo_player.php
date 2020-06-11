<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.3
*
*/

/* Player languages flags
========================================================
*/
if( ! function_exists( 'dt_get_player_language' ) ) {
	function dt_get_player_language() {
		$idiomas = array(
		__d('---------')			=> null,
		__d('Arabic')				=> 'ar',
		__d('Chinese')				=> 'cn',
		__d('Denmark')				=> 'dk',
		__d('Dutch')				=> 'nl',
		__d('English')				=> 'en',
		__d('English British')		=> 'gb',
		__d('Egypt')				=> 'egt',
		__d('French')				=> 'fr',
		__d('German')				=> 'de',
		__d('Indonesian')			=> 'id',
		__d('Hindi')				=> 'in',
		__d('Italian')				=> 'it',
		__d('Japanese')				=> 'jp',
		__d('Korean')				=> 'kr',
		__d('Philippines')			=> 'ph',
		__d('Portuguese Portugal')	=> 'pt',
		__d('Portuguese Brazil')	=> 'br',
		__d('Polish')				=> 'pl',
		__d('Romanian')				=> 'td',
		__d('Scotland')				=> 'sco',
		__d('Spanish Spain')		=> 'es',
		__d('Spanish Mexico')		=> 'mx',
		__d('Spanish Argentina')	=> 'ar',
		__d('Spanish Peru')			=> 'pe',
		__d('Spanish Chile')		=> 'pe',
		__d('Spanish Colombia')		=> 'co',
		__d('Sweden')				=> 'se',
		__d('Turkish')				=> 'tr',
		__d('Rusian')				=> 'ru',
		__d('Vietnam')				=> 'vn'
		);
		return $idiomas;
	}
}

/* Player Options
========================================================
*/
if( ! function_exists( 'dt_get_player_options' ) ) {
	function dt_get_player_options() {
		$options = array(
			__d('URL Iframe')				=> 'iframe',
			__d('JW Player')				=> 'mp4',
			__d('JW Player Google Drive')	=> 'gdrive',
			__d('Shortcode')				=> 'dtshcode',
		);
		return $options;
	}
}


/* Player metabox
========================================================
*/
if( ! function_exists( 'dt_player_meta_boxes' ) ) {
	function dt_player_meta_boxes() {
		add_meta_box('repeatable-fields', __d('Video Player') , 'dt_player_display_meta_box', 'movies', 'normal', 'default');
		add_meta_box('repeatable-fields', __d('Video Player') , 'dt_player_display_meta_box', 'episodes', 'normal', 'default');
	}
	add_action('admin_init', 'dt_player_meta_boxes', 1);
}

/* Player metabox display HTML
========================================================
*/
if( ! function_exists( 'dt_player_display_meta_box' ) ) {
	function dt_player_display_meta_box() {

		global $post;
		$repeatable_fields	= get_post_meta($post->ID, 'repeatable_fields', true);
		$options			= dt_get_player_options();
		$idiomas			= dt_get_player_language();
		wp_nonce_field('dt_repeatable_meta_box_nonce', 'dt_repeatable_meta_box_nonce');
	?>
		<script type="text/javascript">
		jQuery(document).ready(function( $ ){
			$('#add-row').on('click', function() {
				var row = $('.empty-row.screen-reader-text').clone(true);
				row.removeClass('empty-row screen-reader-text');
				row.insertBefore('#repeatable-fieldset-one tbody>tr:last');
				return false;
			});
			$('.remove-row').on('click', function() {
				$(this).parents('tr').remove();
				return false;
			});
			$('.dt_table_admin').sortable( {
				items: '.tritem',
				opacity: 0.8,
				cursor: 'move',
			} );
		});
		</script>
		<table id="repeatable-fieldset-one" width="100%" class="dt_table_admin">
		<thead>
			<tr>
				<th>#</th>
				<th><?php _d('Title'); ?></th>
				<th><?php _d('Type'); ?></th>
				<th><?php _d('URL source or Shortcode'); ?></th>
				<th><?php _d('Flag Language'); ?></th>
				<th><?php _d('Control'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php if ( $repeatable_fields ) : foreach ( $repeatable_fields as $field ) { ?>
		<tr class="tritem">
			<td class="draggable"><span class="dashicons dashicons-move"></td>
			<td class="text_player"><input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" required/></td>
			<td>
				<select name="select[]" style="width: 100%;">
				<?php foreach ( $options as $label => $value ) : ?>
				<option value="<?php echo $value; ?>"<?php selected( $field['select'], $value ); ?>><?php echo $label; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td><input type="text" class="widefat" name="url[]" placeholder="" value="<?php if ($field['url'] != '') echo esc_attr( $field['url'] ); else echo ''; ?>" /></td>
			<td>
				<select name="idioma[]" style="width: 100%;">
				<?php foreach ( $idiomas as $label => $value ) : ?>
				<option value="<?php echo $value; ?>"<?php selected( $field['idioma'], $value ); ?>><?php echo $label; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td><a class="button remove-row" href="#"><?php _d('Remove'); ?></a></td>
		</tr>
		<?php } else : ?>
		<tr class="tritem">
			<td class="draggable"><span class="dashicons dashicons-move"></td>
			<td class="text_player"><input type="text" class="widefat" name="name[]" /></td>
			<td>
				<select name="select[]" style="width: 100%;">
				<?php foreach ( $options as $label => $value ) : ?>
				<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td><input type="text" class="widefat" name="url[]" placeholder="" /></td>
			<td>
				<select name="idioma[]" style="width: 100%;">
				<?php foreach ( $idiomas as $label => $value ) : ?>
				<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td><a class="button remove-row" href="#"><?php _d('Remove'); ?></a></td>
		</tr>
		<?php endif; ?>
		<tr class="empty-row screen-reader-text tritem">
			<td class="draggable"><span class="dashicons dashicons-move"></td>
			<td class="text_player"><input type="text" class="widefat" name="name[]" /></td>
			<td>
				<select name="select[]" style="width: 100%;">
				<?php foreach ( $options as $label => $value ) : ?>
				<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td><input type="text" class="widefat" name="url[]" placeholder="" /></td>
			<td>
				<select name="idioma[]" style="width: 100%;">
				<?php foreach ( $idiomas as $label => $value ) : ?>
				<option value="<?php echo $value; ?>"><?php echo $label; ?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td><a class="button remove-row" href="#"><?php _d('Remove'); ?></a></td>
		</tr>
		</tbody>
		</table>
		<p class="repeater"><a id="add-row" class="add_row" href="#"><?php _d('Add new row'); ?></a></p>
	<?php
	}
}

/* Save Player metabox
========================================================
*/
if( ! function_exists( 'dt_player_save_options' ) ) {
	function dt_player_save_options($post_id) {

		if (!isset($_POST['dt_repeatable_meta_box_nonce']) || !wp_verify_nonce($_POST['dt_repeatable_meta_box_nonce'], 'dt_repeatable_meta_box_nonce')) return;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!current_user_can('edit_post', $post_id)) return;

		// Meta data
		$antiguo	= get_post_meta($post_id, 'repeatable_fields', true);
		$nuevo		= array();
		$options	= dt_get_player_options();
		$names		= isset( $_POST['name'] )	? $_POST['name']	: null;
		$selects	= isset( $_POST['select'] )	? $_POST['select']	: null;
		$idiomas	= isset( $_POST['idioma'] )	? $_POST['idioma']	: null;
		$urls		= isset( $_POST['url'] )	? $_POST['url']		: null;
		$count		= count($names);

		// Serialized data
		for ($i = 0; $i < $count; $i++) {
			if ($names[$i] != ''):
				$nuevo[$i]['name'] = stripslashes(strip_tags($names[$i]));
				if (in_array($selects[$i], $options)) $nuevo[$i]['select'] = $selects[$i];
				else $nuevo[$i]['select'] = '';
				if (in_array($idiomas[$i], $idiomas)) $nuevo[$i]['idioma'] = $idiomas[$i];
				else $nuevo[$i]['idioma'] = '';
				if ($urls[$i] == 'http://') $nuevo[$i]['url'] = '';
				else $nuevo[$i]['url'] = stripslashes($urls[$i]);
			endif;
		}
		if (!empty($nuevo) && $nuevo != $antiguo) update_post_meta($post_id, 'repeatable_fields', $nuevo);
		elseif (empty($nuevo) && $antiguo) delete_post_meta($post_id, 'repeatable_fields', $antiguo);
	}
	add_action('save_post', 'dt_player_save_options');
}

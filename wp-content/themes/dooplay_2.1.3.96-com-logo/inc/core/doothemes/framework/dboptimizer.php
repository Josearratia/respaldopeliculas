<?php

$dbdt	= get_option('dt_cleardb_date');
$nonce	= wp_create_nonce('dtdbclear');
$total[1] = dt_count_rows_indb( null, null, null, true, null );
$total[2] = dt_count_rows_indb('postmeta','meta_key','dt_views_count');
$total[3] = dt_count_rows_indb('postmeta','meta_key','_starstruck_data') + dt_count_rows_indb('postmeta','meta_key','_starstruck_avg') + dt_count_rows_indb('postmeta','meta_key','_starstruck_total');
$total[4] = dt_count_rows_indb('postmeta','meta_key','_dt_list_users') + dt_count_rows_indb('usermeta','meta_key','wp_user_list_count');
$total[5] = dt_count_rows_indb('postmeta','meta_key','_dt_views_users') + dt_count_rows_indb('usermeta','meta_key','wp_user_view_count');
$total[6] = dt_count_rows_indb('postmeta','meta_key','dt_featured_post');
$total[7] = dt_count_rows_indb('postmeta','meta_key','numreport');
$total[8] = dt_count_rows_indb( null, null, null, null, true );
?>
<table>
    <thead>
        <tr>
            <th style="text-align: left"><?php _d('Type'); ?></th>
            <th><?php _d('Registers'); ?></th>
            <th><?php _d('Last revision'); ?></th>
            <th><?php _d('Control'); ?></th>
        </tr>
    </thead>
    <tbody>

		<tr>
            <td class="type"><?php _d('Transients options'); ?></td>
            <td id="ctransients"><?php echo $total[1]; ?></td>
            <td id="ttransients"><?php echo ( $dbdt['a6'] ) ? human_time_diff( $dbdt['a6'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="atransients" class="button button-small cleaneract" data-key="transients" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

		<tr>
            <td class="type"><?php _d('Count Post Views'); ?></td>
            <td id="cpost_views"><?php echo $total[2]; ?></td>
            <td id="tpost_views"><?php echo ( $dbdt['a4'] ) ? human_time_diff( $dbdt['a4'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="apost_views" class="button button-small cleaneract" data-key="post_views" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

		<tr>
            <td class="type"><?php _d('User ratings'); ?></td>
            <td id="cuser_ratings"><?php echo $total[3]; ?></td>
            <td id="tuser_ratings"><?php echo ( $dbdt['a3'] ) ? human_time_diff( $dbdt['a3'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="auser_ratings" class="button button-small cleaneract" data-key="user_ratings" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

        <tr>
            <td class="type"><?php _d('User favorites'); ?></td>
            <td id="cuser_favorites"><?php echo $total[4]; ?></td>
            <td id="tuser_favorites"><?php echo ( $dbdt['a2'] ) ? human_time_diff( $dbdt['a2'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="auser_favorites" class="button button-small cleaneract" data-key="user_favorites" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

        <tr>
            <td class="type"><?php _d('User views'); ?></td>
            <td id="cuser_views"><?php echo $total[5]; ?></td>
            <td id="tuser_views"><?php echo ( $dbdt['a1'] ) ? human_time_diff( $dbdt['a1'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="auser_views" class="button button-small cleaneract" data-key="user_views" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

		<tr>
            <td class="type"><?php _d('Post featured'); ?></td>
            <td id="cpost_featured"><?php echo $total[6]; ?></td>
            <td id="tpost_featured"><?php echo ( $dbdt['a5'] ) ? human_time_diff( $dbdt['a5'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="apost_featured" class="button button-small cleaneract" data-key="post_featured" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

		<tr>
            <td class="type"><?php _d('User reports'); ?></td>
            <td id="cuser_reports"><?php echo $total[7]; ?></td>
            <td id="tuser_reports"><?php echo ( $dbdt['a7'] ) ? human_time_diff( $dbdt['a7'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="auser_reports" class="button button-small cleaneract" data-key="user_reports" data-nonce="<?php echo $nonce; ?>"><?php _d('Clear registers'); ?></a></td>
        </tr>

        <tr>
            <td class="type"  style="color:red"><?php _d('Doothemes License'); ?></td>
            <td id="cdoothemes" style="color:green"><?php echo $total[8]; ?></td>
            <td id="tdoothemes"><?php echo ( $dbdt['a8'] ) ? human_time_diff( $dbdt['a8'], current_time('timestamp') ) : __('never'); ?></td>
            <td><a id="adoothemes" class="button button-small cleaneract" data-key="doothemes" data-nonce="<?php echo $nonce; ?>"><?php _d('Reset License'); ?></a></td>
        </tr>

    </tbody>
</table>

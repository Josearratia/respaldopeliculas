jQuery(document).ready(function($) {

	// Ad to featured
	$('.add-to-featured').click(function(){
		var ajaxurl = dooAj.url;
		var postid  = $(this).data('postid');
		var nonce	= $(this).data('nonce');
		$( '#feature-add-'+ postid ).html( dooAj.loading )
		$.ajax({
            url: ajaxurl,
            type: 'post',
			data: {
				postid: postid,
				nonce: nonce,
                action: 'dt_add_featured'
            },
			error: function(response) {
                console.log(response);
            },
			success: function( response ) {
				$( '#feature-add-'+ postid ).html( dooAj.add_featu )
				$( '#feature-add-'+ postid ).hide();
				$( '#feature-del-'+ postid ).show();
			}
		});
		return false;
	});


	// Suprime featured item
	$('.del-of-featured').click(function(){
		var ajaxurl = dooAj.url;
		var postid  = $(this).data('postid');
		var nonce	= $(this).data('nonce');
		$('#feature-del-'+ postid ).html( dooAj.loading )
		$.ajax({
            url: ajaxurl,
            type: 'post',
			data: {
				postid: postid,
				nonce: nonce,
                action: 'dt_remove_featured'
            },
			error: function(response) {
                console.log(response);
            },
			success: function( response ) {
				$('#feature-del-'+ postid ).html( dooAj.rem_featu )
				$( '#feature-add-'+ postid ).show();
				$( '#feature-del-'+ postid ).hide();
			}
		});
		return false;
	});

	// Update database
	$('.dooplay_update_database').click(function(){
        var ajaxurl = dooAj.url;
		$('#cfg_dts').html( dooAj.updb )
		$.ajax({
            url: ajaxurl,
            type: 'post',
			data: {
                action: 'update_dbdooplay'
            },
			error: function(response) {
                console.log(response);
            },
			success: function( response ) {
				location.reload();
            }
		});
		return false;
	});

	// Upload Ajax image
	$('.import-upload-image').click(function(){
		var preli = $(this).data('prelink');
		var nonce = $(this).data('nonce');
		var field = $(this).data('field');
		var postid = $(this).data('postid');
		var image = $('#'+ field ).get(0).value;
		var urlimage = preli + image;
		if( image ) {
			$( '.import-upload-image' ).hide();
			$( '#'+ field ).val( dooAj.loading )
			$( '#'+ field ).prop('disabled', true)
			$.ajax({
				url: dooAj.url,
				type: 'post',
				data: {
					url: urlimage,
					nonce: nonce,
					field: field,
					postid: postid,
					action: 'dt_upload_ajax_image'
				},
				error: function(response) {
					console.log(response);
				},
				success: function( response ) {
					$( '#'+ field ).prop('disabled', false)
					$( '#'+ field ).val(response);
				}
			});
		}
		return false;
	});

	// Menu tabs
	$('.doo-nav-tab').click(function(){
		var tab_id = $(this).attr('data-tab')
		$('.doo-nav-tab').removeClass('nav-tab-active')
		$('.dt_boxg').removeClass('current')
		$(this).addClass('nav-tab-active')
		$('#'+tab_id).addClass('current')
		return false;
	});

	// Get Doothemes API
	$('#api_doothemes').click(function() {
		$('.apivalue').html(dooAj.loading);
		var a = dooAj.doothemes_server,
			b = dooAj.doothemes_item,
			c = dooAj.doothemes_license,
			d = dooAj.domain;
			var obj = {"success":true,"license":"Valid","item_name":"Dooplay","checksum":"b21c462b8eb91ffdc901b89fe7feb6d8","customer_name":"Karii lina","customer_email":"admin@tv-anime.co","payment_id":"#114","license_limit":"Unlimited","site_count":"1+","activations_left":"Unlimited","expires":"Lifetime"};
			

			$.each(obj, function(f, g) {
				$('#' + f).html(g), 'license' == f && ('valid' == g ? $('#license').html('<span class="valid_dt_key_info">' + g + '</span> <code>' + c + '</code>') : $('#license').html('<span class="invalid_dt_key_info">' + g + '</span> <code>' + c + '</code>'))
			})

		return false;
	});

});

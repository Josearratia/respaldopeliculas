jQuery(document).ready(function($) {

	// All Functions
	function switch_tabs(a) {
		$(".tab-content").hide(),
		$("#domts-main-menu ul a").removeClass("selected");
		var b = a.attr("rel");
		$("#" + b).fadeIn(500), a.addClass("selected")
	}

	function checked_img(a) {
		a.is(":checked") ? a.closest("label").addClass("domts-img-selected") : a.closest("label").removeClass("domts-img-selected")
	}

	function checked_img_radio(a) {
		a.is(":checked") ? (a.closest(".cOf").find("label.domts-img-selected").removeClass("domts-img-selected"), a.closest("label").addClass("domts-img-selected")) : a.closest("label").removeClass("domts-img-selected")
	}

	$.fn.slideFadeToggle = function(a, b, c) {
		return this.animate({
			opacity: "toggle",
			height: "toggle"
		}, a, b, c)
	},

	$("#domts-main-menu > li > p").click(function() {
		$(this).next().slideToggle(300)
	}),

	$("#domts-main-menu ul a").click(function() {
		switch_tabs( $(this) )
	}),

	$(".tab-content").hide();

	var a = $(".defaulttab").attr("rel");

	$("#" + a).show(),
	$(".default-accordion").show(),

	$(".domts-image-checkbox-b").click(function() {
		var a = $(this);
		checked_img(a)
	}),

	$(".domts-image-radio-b").click(function() {
		var a = $(this);
		checked_img_radio(a)
	}),

	$('input[type="checkbox"]').each(function() {
		var a = $(this),
			b = a.attr("id");
		a.is(":checked") || $('div[rel="' + b + '"]').hide()
	}),

	$('input[type="checkbox"]').click(function() {
		var a = $(this),
			b = a.attr("id");
		a.is(":checked") ? $('div[rel="' + b + '"]').slideFadeToggle(500) : $('div[rel="' + b + '"]').slideFadeToggle(500)
	}),

	// Upload image
    $('.domts_upload').click(function(e) {
		var custom_uploader;
		var id = $(this).attr('data-id');
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: dtfa.ititle,
            button: {
                text: dtfa.iuse
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#' + id ).val(attachment.url);
			$('#preview_' + id ).html('<div data-id="'+ id +'" class="img upload_image"><img src="'+ attachment.url +'"></div>');
			$('#remove_' + id ).removeClass( "hiddenex" );
			var uploading = {
				action: "dtfr_ajax_upload",
				data: id,
				url: attachment.url,
			}
			$.post( ajaxurl, uploading );

        });
        custom_uploader.open();
   }),

   // Remove Image
	$(".domts_remove").live("click", function() {
		var a = $(this),
			b = $(this).attr('data-id');
		a.html( dtfa.remov );
		var c = {
			action: "dtfr_ajax_remove",
			data: b
		};
		$.post( ajaxurl, c, function(b) {
			a.prev().prev().val(""), a.next().html(""), a.remove()
		})
	}),

    // Save Settings
	$('#domts-settings').submit(function() {
      	$('.dt_save_framework').val( dtfa.saving )
      	$('.dt_save_framework').prop('disabled', true )
      	$('.dt_separator').addClass('saving')
      	$(this).ajaxSubmit({
    	 	success: function(){
            	$('.dt_save_framework').val( dtfa.save )
            	$('.dt_save_framework').prop('disabled', false )
            	$('.dt_separator').removeClass('saving')
    	 	},
      	});
      	return false;
  	}),

	// Save Menu section
	$(".get_ssection").click( function() {
		var ms = $(this).data('msection')
	  	var ss = $(this).data('ssection')
	  	$.ajax({
	      	url: dtfa.ajaxurl,
	      	type: 'POST',
	      	data: {
	          	ss: ss,
	          	ms: ms,
	          	action: 'ssection'
	      	},
	      	error: function(response) {
	          	console.log(response);
	      	},
	      	success: function(response) {
	          	console.log(response);
	      	}
	  	})
	  return false;
	}),

  	// Depurate Database
  	$('.cleaneract').click( function() {
    	if (confirm( dtfa.reset_all)) {
        	var key = $(this).data('key')
          	var nonce = $(this).data('nonce')
          	$('#c' + key ).html( '...')
          	$('#a' + key ).html( dtfa.loading )
          	$('#a' + key ).addClass('disabled')
          	$.ajax({
            	url: dtfa.ajaxurl,
              	type: 'POST',
              	data: {
                	key: key,
                  	nonce: nonce,
                  	action: 'dtcdatabase'
              	},
              	error: function(response) {
                	console.log(response);
              	},
              	success: function(response) {
                	$('#t' + key ).html( dtfa.justnow )
                  	$('#a' + key ).html( dtfa.cleareg )
                  	$('#a' + key ).removeClass('disabled')
                  	$('#c' + key ).html( '0')
                  	console.log(response);
              	}
          	})
        }
      return false;
  	}),

	// Sortable
	$('.dt-sorter-enabled').sortable({
		connectWith: '.dt-sorter-disabled',
		placeholder: 'ui-sortable-placeholder',
		update: function( event, ui ){
			var $el = ui.item.find('input');
		 	if( ui.item.parent().hasClass('dt-sorter-enabled') ) {
		    	$el.attr('name', $el.attr('name').replace('disabled', 'enabled'));
		  	} else {
		    	$el.attr('name', $el.attr('name').replace('enabled', 'disabled'));
		  	}
		}
	});

	// Sortable conflict
	$('.dt-sorter-disabled').sortable({
		connectWith: '.dt-sorter-enabled',
		placeholder: 'ui-sortable-placeholder'
	});
}),

function(a, b, c, d, e, f, g) {
	a.GoogleAnalyticsObject = e, a[e] = a[e] || function() {
		(a[e].q = a[e].q || []).push(arguments)
	}, a[e].l = 1 * new Date, f = b.createElement(c), g = b.getElementsByTagName(c)[0], f.async = 1, f.src = d, g.parentNode.insertBefore(f, g)
}(window, document, "script", "https://www.google-analytics.com/analytics.js", "ga"), ga("create", "UA-74366679-2", "auto"), ga("send", "pageview");

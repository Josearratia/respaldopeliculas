(function( $ ) {

    // Color Picker
    $(function() {
        $('.domts-color-picker').wpColorPicker();
    });

	// Select color
	$("#dt_color_style").live('change', function() {
		if ($(this).val() == 'default'){
			$('#color1').val('#408BEA');
			$('#color2').val('#F5F7FA');
		}
		if ($(this).val() == 'dark'){
			$('#color1').val('#408BEA');
			$('#color2').val('#464e5a');
		}
		if ($(this).val() == 'fusion'){
			$('#color1').val('#408BEA');
			$('#color2').val('#9facc1');
		}
	});

})( jQuery );

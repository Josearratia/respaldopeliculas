<?php
/*
Template Name: DT - jwplayer
*/

if( isset( $_GET['source'] ) and isset( $_GET['id'] ) ) {

// main data
$id     = isset( $_GET['id'] ) ? $_GET['id']         : null;
$mp4url = isset( $_GET['source'] ) ? $_GET['source'] : null;
$source = base64_decode($mp4url);

// Options
$abouttext 		= get_option('dt_jw_abouttext');
$skinname 		= get_option('dt_jw_skinname');
$skinactive 	= get_option('dt_jw_skinactive');
$skininactive 	= get_option('dt_jw_skininactive');
$skinbackground = get_option('dt_jw_skinbackground');
$jwlogo 		= get_option('dt_jw_logo');
$jwkey 			= get_option('dt_jw_key');
$jwlogoposit 	= get_option('dt_jw_logo_position');
$image 			= rand_images('imagenes', $id, 'original', true, true);

// End PHP
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="<?php echo DOO_URI. '/assets'; ?>/jwplayer/jwplayer.js"></script>
		<script src="<?php echo DOO_URI. '/assets'; ?>/jwplayer/provider.html5.js"></script>
		<script>jwplayer.key="<?php echo $jwkey; ?>";</script>
		<script type="text/javascript">
		/* <![CDATA[ */
		var JWp = {
			'mp4file': '<?php echo $source; ?>',
			'image': '<?php echo esc_url($image); ?>',
			'abouttext': '<?php echo $abouttext; ?>',
			'aboutlink': '<?php echo esc_url( home_url() ); ?>',
			'flashplayer': '<?php echo DOO_URI. "/assets/jwplayer/jwplayer.flash.swf"; ?>',
			'skin-name': '<?php echo $skinname; ?>',
			'skinactive': '<?php echo $skinactive; ?>',
			'skininactive': '<?php echo $skininactive; ?>',
			'skinbackground': '<?php echo $skinbackground; ?>',
			'logofile': '<?php echo $jwlogo; ?>',
			'logolink': '<?php echo esc_url( home_url() ); ?>',
			'logoposition': '<?php echo $jwlogoposit; ?>',
		};
		/* ]]> */
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo DOO_URI. '/assets'; ?>/jwplayer/skins/seven.css">
		<style>html,body{height:100%;width:100%;margin:0;overflow:hidden;}</style>
	</head>
	<body>
		<div id="video"></div>
		<script type="text/JavaScript">
			var playerInstance = jwplayer("video");
			playerInstance.setup({
				image: JWp.image,
				file: JWp.mp4file,
				mute: "false",
				autostart: "false",
				repeat: "false",
				abouttext: JWp.abouttext,
				aboutlink: JWp.aboutlink,
				height: "100%",
				width: "100%",
				stretching: "uniform",
				primary: "html5",
				flashplayer: JWp.flashplayer,
				preload:"metadata",
				skin: {
					name:JWp.skinname,
					active:JWp.skinactive,
					inactive:JWp.skininactive,
					background: JWp.skinbackground
				},
				logo: {
					file:JWp.logofile,
					hide:"false",
					link:JWp.logolink,
					margin:"15",
					position:JWp.logoposition
				}
			});
		</script>
	</body>
</html>
<?php } else {
	_d('No data');
} ?>

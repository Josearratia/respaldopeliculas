<?php
$expire = time() + 14000;
$dt = base64_decode($expire);
 
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'akaplayerdotcom'; //letter only
		$secret_iv = 'akaplayerdotcom';
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
?>
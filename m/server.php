<?php
if (! empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}

	$uri .= str_replace("m.","",$_SERVER['HTTP_HOST']);
	$alamat = array("site" => "$uri" );
	// Menutup script pada file .php
 	// 	header('Location: '.$uri.'/dashboard/');

	// exit;
?>

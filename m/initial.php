<?php
session_start();
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_seo.php";
include "../config/desc.php";
include "../library/Mobile_Detect.php";
include "../class/url.php";
include "../class/meta.php";
include "../class/data.php";
include "../class/datetimes.php";


$automobile = new Mobile_Detect;
$meta = new meta;
$url = new url;
$data = new data;
$datetime = new Date_time;

// var_dump ( $url->url_load_img() ); 
// echo $url->url_load_img();

$tes = $data->mode_tes();

// define ('SITE_URL_IMG', $url->url_redirect('www', 'saudagar', '/m/', TRUE) );
// define ('SITE_URL_IMG', $url->url_load_img('https', 'www', 'saudagarnews.id') ); 
define ('SITE_URL', $url->url_redirect('m', 'saudagar', '/m/', $tes) );
define ('SITE_URL_REDIRECT', $url->url_redirect('www', 'saudagar', '/', $tes) );

$new_request_uri = preg_replace("/(\/)/", "", $_SERVER[REQUEST_URI], 1);
$url_redirect_to_web = preg_replace("/saudagar\/m\//", "", $new_request_uri);

// echo SITE_URL;

// $pop = array_pop(explode('/', $_SERVER['REQUEST_URI']));
if(! $automobile->isMobile()){
  header("Location:".SITE_URL_REDIRECT.$url_redirect_to_web);
  exit();
}
	error_reporting(0);

$detail=mysql_query("SELECT * FROM berita, users, menu
			WHERE users.id = berita.username
			AND id_kategori = id_menu
			AND judul_seo='$_GET[judul]'");
	$d   = mysql_fetch_array($detail);
  $tgl = tgl_indo($d['tanggal']);
?>
<?php
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/library.php";
include "../class/url.php";
include "../class/data.php";
include "../class/datetimes.php";

error_reporting(0);

$url = new url;
$data = new data;
$datetime = new Date_time;

$tes = $data->mode_tes();
define ('SITE_URL_IMG', $url->url_load_img('https', 'www', 'saudagarnews.id') ); 
define ('SITE_URL', $url->url_redirect('www', 'saudagar', '/', $tes) ); 

$new_request_uri = preg_replace("/(\/)/", "", $_SERVER[REQUEST_URI], 1);
$url_redirect_to_mobile = preg_replace("/saudagar\//", "", $new_request_uri);


$terkini=mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND id_berita < '$_GET[id]' ORDER BY id_berita DESC LIMIT 1");
while($t=mysql_fetch_array($terkini)){
	$row[] = $t[menu_dari];
	$row[] = $t[id_berita];
	$row[] = $t[judul_seo];
}

echo json_encode($row);
?>
<?php
  session_start();
  // Panggil semua fungsi yang dibutuhkan (semuanya ada di folder config)
  include_once "config/koneksi.php";
  include_once "config/fungsi_indotgl.php";
  include_once "config/fungsi_seo.php";
	include_once "config/class_paging.php";
	include_once "config/fungsi_combobox.php";
	include_once "config/library.php";
  include_once "config/fungsi_autolink.php";
  include_once "config/fungsi_badword.php";
  include_once "config/fungsi_kalender.php";
  include_once "config/option.php";
  include_once "config/desc.php";
  include_once "library/Mobile_Detect.php";
  include_once "class/url.php";
  include_once "class/meta.php";
  include_once "class/data.php";
  include_once "class/datetimes.php";


  $meta = new meta;
  $url = new url;
  $data = new data;
  $datetime = new Date_time;
  $automobile = new Mobile_Detect;

  $tes = $data->mode_tes();
  
  // define ('SITE_URL_IMG', $url->url_load_img('https', 'www', 'saudagarnews.id') ); 
  define ('SITE_URL_REDIRECT', $url->url_redirect('m', 'saudagar', '/m/', $tes) ); 
  define ('SITE_URL', $url->url_redirect('www', 'saudagar', '/', $tes) ); 
  
  $new_request_uri = preg_replace("/(\/)/", "", $_SERVER[REQUEST_URI], 1);
  $url_redirect_to_mobile = preg_replace("/saudagar\//", "", $new_request_uri);
  
  if($automobile->isMobile()){
    header("Location:".SITE_URL_REDIRECT.$url_redirect_to_mobile);
    exit();
  }
  error_reporting(0);
  
  $detail=mysql_query("SELECT * FROM berita,users, menu
        WHERE users.id=berita.username
        AND id_kategori = id_menu
        AND judul_seo='$_GET[judul]'");
    $d   = mysql_fetch_array($detail);
    $tgl = tgl_indo($d['tanggal']);
    
    
  // Memilih template yang aktif saat ini
  $pilih_template=mysql_query("SELECT folder FROM templates WHERE aktif='Y'");
  $f=mysql_fetch_array($pilih_template);
  include_once "$f[folder]/template.php";

  // Close connection to database after use it
  mysql_close($link);
?>

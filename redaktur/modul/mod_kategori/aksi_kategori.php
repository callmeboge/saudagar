<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  echo "<link href='../../css/zalstyle.css' rel='stylesheet' type='text/css'>
  <link rel='shortcut icon' href='../../favicon.png' />
  
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  <img src='../../img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  </section>
  <section id='error-text'>
  <p><a class='button' href='../../index.php'> <b>LOGIN DI SINI</b> </a></p>
  </section>
  </div>";}
  
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = str_replace(' ', '',$acak.$nama_file); 
  
   if (!empty($lokasi_file)){
   UploadImage1($nama_file_unik);
  mysql_query("INSERT INTO kategori
  (nama_kategori,
  username,
  kategori_seo,
  photo) 
  
  VALUES(
  '$_POST[nama_kategori]',
  '$_SESSION[namauser]',
  '$kategori_seo',
  '$nama_file_unik')");
   
  header('location:../../media.php?module='.$module);
   }
   else{
	   mysql_query("INSERT INTO kategori
  (nama_kategori,
  username,
  kategori_seo) 
  
  VALUES(
  '$_POST[nama_kategori]',
  '$_SESSION[namauser]',
  '$kategori_seo')");
   
  header('location:../../media.php?module='.$module);
   }
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  $kategori_seo = seo_title($_POST['nama_kategori']);
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = str_replace(' ', '',$acak.$nama_file); 
   if (!empty($lokasi_file)){
   UploadImage1($nama_file_unik);
  
  mysql_query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]', kategori_seo='$kategori_seo', aktif='$_POST[aktif]', photo='$nama_file_unik' 
               WHERE id_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
	}else{
		mysql_query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]', kategori_seo='$kategori_seo', aktif='$_POST[aktif]' 
               WHERE id_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
	}
	
}



}
?>

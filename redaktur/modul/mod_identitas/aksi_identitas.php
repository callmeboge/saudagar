<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Update identitas
if ($module=='identitas' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFavicon($nama_file);
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[name_website]',
	                                         title     = '$_POST[title_website]',
                                           url       = '$_POST[url]',
                                           meta_deskripsi  = '$_POST[meta_deskripsi]',
                                           meta_keyword  = '$_POST[meta_keyword]',
                                           img_path  = '$_POST[image_path]',
                                           meta_robot  = '$_POST[meta_robot]',
                                           mode_tes   = '$_POST[tes_mode]'
                                WHERE id_identitas   = '$_POST[id]'");
  }
  else{
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[name_website]',
                                      title   = '$_POST[title_website]',
                                      url       = '$_POST[url]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
                                      img_path   = '$_POST[image_path]',
                                      meta_robot   = '$_POST[meta_robot]',
                                      mode_tes   = '$_POST[tes_mode]'
                                WHERE id_identitas   = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>

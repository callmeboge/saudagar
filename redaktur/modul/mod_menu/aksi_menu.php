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
include "../../../config/fungsi_seo.php";
include "../../../library//src/ThumbLib.inc.php";
include "../../../class/data.php";


$gambar = new data;
$module=$_GET[module];
$act=$_GET[act];

// Hapus sub menu
if ($module=='menu' AND $act=='hapus'){
  $sql = "SELECT logo FROM menu WHERE id_menu='$_GET[id]'";
  $row = mysql_fetch_array(mysql_query($sql), MYSQL_ASSOC);

  if($row['logo']):
    $gambar->delete_gambar("assets/menu", [400, 100], $row['logo']);
  endif;

  mysql_query("DELETE FROM menu WHERE id='$_GET[id]'");

  header('location:../../media.php?module='.$module);
}

// Input sub menu
elseif ($module=='menu' AND $act=='input'){
  $slug = seo_title($_POST['nama_menu']);
  $logo = $_FILES[fupload][name];

  mysql_query("INSERT INTO menu(nama_menu, 
                                  title, 
                                  description,
                                  keywords,
                                  logo,
                                  link)
                            VALUES('$_POST[nama_menu]',
                                    '$_POST[title]',
                                    '$_POST[menu_description]',
                                    '$_POST[keywords]',
                                    '$logo',
                                    '$slug')");

header('location:../../media.php?module='.$module);
}
// Update sub menu
elseif ($module=='menu' AND $act=='update'){
  $slug = seo_title($_POST['nama_menu']);
  $logo = $_POST[n_img] ?: $_FILES[fupload][name];

  if($_FILES[fupload][type] <> ''):
    $_FILES[fupload][name] = $logo;
    $gambar->upload_gambar($_FILES[fupload], "assets/menu", [400, 100], 85);
  endif;

  mysql_query("UPDATE menu SET id_parent  = '$_POST[id_parent]',
                                   nama_menu = '$_POST[nama_menu]',
                                    title = '$_POST[title]',
                                    menu = '$_POST[menu]',
                                    menu_dari = '$_POST[menu_from]',
                                    description = '$_POST[description]',
                                    keywords = '$_POST[keywords]',
                                    aktif = '$_POST[aktif]',
                                    link = '$slug',
                                    logo = '$logo'
                             WHERE id_menu = '$_POST[id]' ");
  
  // echo "Horey";
  header('location:../../media.php?module='.$module);

}
}
?>
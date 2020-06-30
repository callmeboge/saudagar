<?php
session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])):
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
else:
  include "../../../config/koneksi.php";
  include "../../../config/library.php";
  include "../../../library/src/ThumbLib.inc.php";
  include "../../../class/data.php";
  
  $gambar = new data;
 
  $module=$_GET[module];
  $act=$_GET[act];

  // Hapus iklanatas
  if ($module=='iklan' AND $act=='hapus'):
    $data=mysql_fetch_array(mysql_query("SELECT gambar FROM iklanatas WHERE id_iklanatas='$_GET[id]'"));

    if ($data[gambar]):
      $gambar->delete_gambar('img_ads', [700, 300], $data[gambar]);
    endif;
    
    mysql_query("DELETE FROM iklanatas WHERE id_iklanatas='$_GET[id]'");  
   
    header('location:../../media.php?module='.$module);

    // Input iklanatas
  elseif ($module=='iklan' AND $act=='input'):
      // Apabila ada gambar yang diupload
      $judul = $_POST[judul];
      $url = $_POST[url];
      $kategori = $_POST[kategori];
      $layout = $_POST[layout];
      $nama = $_FILES[fupload][name];
      

      $gambar->upload_gambar($_FILES[fupload], 'img_ads', [700, 300], 70);
      
      mysql_query("INSERT INTO iklanatas(judul,
                                        username,
                                        url,
                                        id_kategori,
                                        tata_letak,
                                        status,
                                        tgl_posting,
                                        gambar) 
                                VALUES('$judul',
                                      '$_SESSION[id]',
                                      '$url',
                                      '$kategori',
                                      '$layout',
                                      'N',
                                      '$tgl_sekarang',
                                      '$nama')");
      header('location:../../media.php?module='.$module);
      
    // Update iklanatas
  elseif ($module=='iklan' AND $act=='update'):
    // Apabila gambar tidak diganti
    $url      =   $_POST[url];
    $layout   =   $_POST[layout];
    $kategori =   $_POST[kategori];
    $status   =   $_POST[status];
    
    if(! empty($_POST[img_name]) && $_FILES[fupload][type] <> ''):
      $_FILES[fupload][name] = $_POST[img_name];
      $gambar->upload_gambar($_FILES[fupload], "img_ads", [700, 300], 70);
    endif;

    mysql_query("UPDATE iklanatas SET url = '$url',
                                      tata_letak = '$layout',
                                      id_kategori = '$kategori',
                                      status      = '$status'
                                     WHERE id_iklanatas = '$_POST[id]'");

    header('location:../../media.php?module='.$module);
  endif;
endif;
?>
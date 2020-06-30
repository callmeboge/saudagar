<?php
session_start();
error_reporting(1);

require_once 'settings.php';
require_once 'source.php';
require_once '../library/src/ThumbLib.inc.php';

// $data = new data ;
//fungsi cek akses user
function user_akses($mod,$id){
	$link = "?module=".$mod;
	$cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
	return $cek;
}
//fungsi cek akses menu
function umenu_akses($link,$id){
	$cek = mysql_num_rows(mysql_query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'"));
	return $cek;
}
//fungsi redirect
function akses_salah(){
	$pesan = "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Maaf Anda tidak berhak mengakses halaman ini</center>";
 	$pesan.= "<meta http-equiv='refresh' content='2;url=media.php?module=home'>";
	return $pesan;
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  echo "<link href='css/zalstyle.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>

  <img src='img/lock.png'>
  <h1>AKSES ILEGAL</h1>

  <p><span class style=\"font-size:14px; color:#ccc;\">
  Maaf, untuk masuk Halaman Administrator
  anda harus Login dahulu!</p></span><br/>

  </section>

  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>LOGIN DI SINI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";

}
else{
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
	<meta charset="utf-8"/>
	<title>.:: HALAMAN ADMINISTRATOR ::.</title>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="shortcut icon" href="../favicon.ico" />
  <link rel="dns-prefetch" href="http://fonts.googleapis.com/" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/zalstyle.css" />
	<link rel="stylesheet" href="js/jQuery-tagEditor-master/jquery.tag-editor.css" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=PT+Sans" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script type="text/javascript">
    var _BASE_URL_ = '<?= APP_URL; ?>';
	</script>
  </head>
  <body id="top">
  <div id="container">
  <div id="header-surround">
  <header id="header">
  <img src="img/logo.png" alt="Grape" class="logo" />

  <div id="user-info">
  <p>
  <a target='_blank' href=../index.php  class="button blue">Lihat Web</a>
  <a href="logout.php" class="button red">Logout</a> </p>
  </div>
  </header>
  </div>
  <div class="fix-shadow-bottom-height"></div>
  <aside id="sidebar">
  <section id="login-details">
  <?php include "foto.php"; ?>
  <div class='selamat'><SCRIPT language=JavaScript>var d = new Date();
  var h = d.getHours();
  if (h < 11) { document.write('Selamat pagi,'); }
  else { if (h < 15) { document.write('Selamat siang,'); }
  else { if (h < 19) { document.write('Selamat sore,'); }
  else { if (h <= 23) { document.write('Selamat malam,'); }
  }}}</SCRIPT></div>
  <h3><?php include "nama.php"; ?></h3>

  <?php
  $jumHub=mysql_num_rows(mysql_query("SELECT * FROM hubungi WHERE dibaca='N'"));
  echo "
  <span class=messages> <a href='?module=hubungi'>
  <img src='img/icons/packs/fugue/16x16/mail.png' alt='Pesan'>  <span class style=\"color:#66CCFF;\"><b>$jumHub</b></span>
  <span class style=\"font-size:11px; color:#fff;\"> belum dibaca</span></a> </span>";
  ?>
  <div class="clearfix"></div>
  </section>

  <nav id="nav">
  <ul class="menu collapsible shadow-bottom">

  <li>
  <a href="javascript:void(0);">
   MENU UTAMA</a>
  <ul class="sub">
  <?php include "menu1.php"; ?>
  </ul>
   <li>
  <a href="javascript:void(0);">
   MODUL BERITA</a>
  <ul class="sub">
  <?php include "menu2.php"; ?>
  </ul>
   <li>
  <a href="javascript:void(0);">
   MODUL VIDEO</a>
  <ul class="sub">
  <?php include "menu3.php"; ?>
  </ul>
   <li>
  <a href="javascript:void(0);">
   MODUL IKLAN</a>
  <ul class="sub">
  <?php include "menu4.php"; ?>
  </ul>
   <li>
  <a href="javascript:void(0);">
   MODUL WEB</a>
  <ul class="sub">
  <?php include "menu5.php"; ?>
  </ul>
  <li>
  <a href="javascript:void(0);">
   MODUL USER</a>
  <ul class="sub">
  <?php include "menu6.php"; ?>
  </ul>
  </ul>
  </nav>
  </aside>

  <div id="main" role="main">
  <div id="title-bar">
  <ul id="breadcrumbs">
  <li><a href="?module=home" title="Beranda"><span id="bc-home"></span></a></li>
  <li class="no-hover">Selamat Datang di Halaman Administrator. </li>
  </ul>
  </div>
  <div class="shadow-bottom shadow-titlebar"></div>
  <?php include "content.php"; ?>
  </div>

  <script src="js/jquery-1.7.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
  <script src="js/jQuery-tagEditor-master/jquery.tag-editor.min.js"></script>
  <script src="js/jQuery-tagEditor-master/jquery.caret.min.js"></script>
  <script>
  <?php
    function return_bytes($val){
      $val = trim($val);
      $last = strtolower($val[strlen($val)-1]);
        switch($last):
          case 'g':
            $val *= 1024;
          case 'm':
            $val *= 1024;
          case 'k':
            $val *= 1024;
        endswitch;
      return $val;
    }
  ?>
  jQuery(document).ready(function() {
    $('#fupload, #grafis_upload').change(function() {
      var file_size = $(this)[0].files[0].size;
      if(file_size > <?= return_bytes(ini_get('upload_max_filesize'))?>){
        // 2097152
        alert('Ukuran File lebih besar dari <?= ini_get('upload_max_filesize')?>');
        this.value = '';
        return false;
      }else{
        return true;
      }
    });

  $('#menu').click(function(){
    if(this.value == 'Sub'){
      $('#menu_from').show();
    }
    else {
      $('#menu_from').hide();}
  });

    $('#editberita').validate({
      rules:{
          kategori : {
            required: true
          }
          // ,
          // deskripsi : {
          //   required: true,
          //   rangelength: [2, 6]
          // }
      },
      messages:{
          kategori : {
              required : "silahkan pilih kategori"
          }
          // ,
          // deskripsi: {
          //   rangelength: function(range, input){
          //     return [
          //       'you are only allowed between ',
          //       range[0],
          //       'and ',
          //       range[1],
          //       'You have typed ',
          //       $(input).val().length,
          //       'characters'
          //     ].join('');
          //   }
          }
      },
      onkeyup : false,
      submitHandler: function (form){
          form.submit();
      }
    });
  });

  jQuery('#tags_berita').tagEditor({
    autocomplete:{
      delay:0,
      position: {collision: 'flip'},
      source: <?php source('tag_news');?>
    },
    placeholder: 'Tag Berita Terkait',
    forceLowercase: false
  });  
  
  jQuery('#topik').tagEditor({
    autocomplete:{
      delay:0,
      position: {collision: 'flip'},
      source: <?php source('topik_news');?>
    },
    placeholder: 'Topik Berita Terkait',
    forceLowercase: false
  });
	CKEDITOR.replace('editor');
  </script>
  <script>window.jQuery||document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>');</script>
  <script defer type="text/javascript" src="js/zal.js"></script>
  </body>
  </html>
  <?php } ?>

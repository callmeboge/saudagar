<?php
	if ($_GET['module']=='home')
    include "modul/mod_berita/beranda.php";
	if ($_GET['module']=='regional')
    include "modul/mod_berita/regional.php";
  elseif ($_GET['module']=='main')
    include "modul/mod_berita/main.php";
	elseif ($_GET['module']=='epaper')
    include "modul/mod_berita/epaper.php";
  elseif ($_GET['module']=='menu')
    include "modul/mod_berita/menu.php";
  elseif ($_GET['module']=='rekomendasi')
    include "modul/mod_berita/rekomendasi.php";
  elseif ($_GET['module']=='detailkategori')
    include "modul/mod_berita/detailkategori.php";
  elseif ($_GET['module']=='detailberita')
    include "modul/mod_berita/detailberita.php";
  elseif ($_GET['module']=='detailvideo')
    include "modul/mod_berita/detailvideo.php";
	elseif ($_GET['module']=='hasilcari')
  	include "modul/mod_berita/hasilcari.php";
	elseif ($_GET['module']=='hasiltag')
  	include "modul/mod_berita/hasiltag.php";
  elseif ($_GET['module']=='rubrik')
    include "modul/mod_berita/detailrubrik.php";
	elseif ($_GET['module']=='video')
		include 'modul/mod_berita/video.php';
	elseif ($_GET['module']=='foto')
		include 'modul/mod_berita/foto.php';
	elseif ($_GET['module']=='detailfoto')
		include 'modul/mod_berita/detailfoto.php';
	elseif ($_GET['module']=='halaman-statis')
		include 'modul/mod_berita/halaman-statis.php';
  elseif ($_GET['module']=='warnaislam')
  	include 'modul/mod_berita/warnaislami.php';
  elseif ($_GET['module']=='pilkd')
  	include 'modul/mod_berita/pilkd.php';
  elseif ($_GET['module']=='pilkd-daerah')
  	include 'modul/mod_berita/pilkd-daerah.php';
?>
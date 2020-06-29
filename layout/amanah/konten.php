<?php 
  if ($_GET['module']=='home')
  include "$f[folder]/beranda.php";
  if ($_GET['module']=='regional')
  include "$f[folder]/regional.php";

  elseif ($_GET['module']=='main')
  include "$f[folder]/menupage.php";

  elseif ($_GET['module']=='sitemap')
  include "$f[folder]/sitemap.php";

  elseif ($_GET['module'] == 'detailfoto')
  include "$f[folder]/modul/mod_foto/detailfoto.php";

  elseif ($_GET['module'] == 'detailvideo')
  include "$f[folder]/modul/mod_video/detailvideo.php";

  elseif ($_GET['module'] == 'detailberita')
  include "$f[folder]/modul/mod_berita/detailberita.php";

  elseif ($_GET['module']=='detailkategori')
  include "$f[folder]/modul/mod_berita/detailkategori.php";

  elseif ($_GET['module']=='detailtag')
  include "$f[folder]/modul/mod_halaman/hasiltag.php";

  elseif ($_GET['module']=='hasilcari')
  include "$f[folder]/modul/mod_berita/hasilcari.php";

  elseif ($_GET['module']=='indeks')
  include "$f[folder]/modul/mod_berita/index.php";

  elseif ($_GET['module']=='halamanstatis')
  include "$f[folder]/modul/mod_halaman/halaman.php";

  elseif ($_GET['module']=='warnaislami')
  include "$f[folder]/modul/mod_halaman/warnaislami.php";

  elseif ($_GET['module']=='epaper')
  include "$f[folder]/modul/mod_berita/detailpaper.php";

  elseif ($_GET['module']=='pilkd-daerah')
  include "$f[folder]/modul/mod_halaman/pilkd-daerah.php";

  elseif ($_GET['module']=='pilkd')
  include "$f[folder]/modul/mod_halaman/pilkd.php";

  elseif ($_GET['module']=='foto')
  include "$f[folder]/menufoto.php";

  elseif ($_GET['module']=='error')
  include "$f[folder]/notfound.html";
?>

<?php
include '../config/koneksi.php';
include '../config/fungsi_indotgl.php';
include '../config/library.php';
include '../class/url.php';
include '../class/data.php';
include '../class/datetimes.php';
include 'server.php';

$url = new url;
$data = new data;
$datetime = new Date_time;

// define('SITE_URL', site_URL());
$tes = $data->mode_tes();
define ('SITE_URL_IMG', $url->url_load_img('https', 'www', 'saudagarnews.id') );
define ('SITE_URL', $url->url_redirect('m', 'saudagar', '/m/', $tes) );

$new_request_uri = preg_replace("/(\/)/", "", $_SERVER[REQUEST_URI], 1);
$url_redirect_to_mobile = preg_replace("/saudagar\//", "", $new_request_uri);

if(isset($_GET['kategori'])):
  if($_GET['kategori'] == 'update'):
    // $artikel_update = '';
    $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND id_berita < $_GET[urut] ORDER BY id_berita DESC LIMIT 5");
    $target = 'update';
  elseif($_GET['kategori'] == 'detail'):
    $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND link = '$_GET[id]' AND id_berita < '$_GET[urut]' ORDER BY id_berita DESC LIMIT 5");
    $target = $_GET[id];
  elseif($_GET['kategori'] == 'popular'):
    $date = date('Y-m-d');
    $artikel = mysql_query("SELECT * FROM berita, menu WHERE tanggalwaktu BETWEEN DATE_SUB('$date', INTERVAL 7 DAY) AND '$date' AND id_menu = id_kategori AND dibaca < '$_GET[urut]' ORDER BY dibaca DESC LIMIT 5");
    $target = 'popular';
  elseif($_GET['kategori'] == 'rekomendasi'):
    $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND id_berita < '$_GET[urut]' AND berita.aktif = 'Y' ORDER BY id_berita DESC LIMIT 5");
    $target = 'rekomendasi';
  elseif($_GET['kategori'] == 'berita-utama'):
    $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND id_berita < '$_GET[urut]' AND utama = 'Y' ORDER BY id_berita DESC LIMIT 5");
    $target = 'berita-utama';
  else:
    $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND menu_dari = '$_GET[kategori]' AND id_berita < '$_GET[urut]' ORDER BY id_berita DESC LIMIT 5");
    $target = $_GET[kategori];
  endif;
  
  if(isset($artikel)):
    while ($q = mysql_fetch_array($artikel)):
      if($_GET[kategori] == 'popular'):
        $kode = $q[dibaca];
      else:
        $kode = $q[id_berita];
      endif;
      if($q['jenis_berita'] == 'foto'):
        echo "<article class= 'artikle' >
        <div class='list-picture photo-gall'>
          <a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."'>
            <img class='picture lazy' data-src='".$url->url_article_img($q[gambar], 700)."' alt='$q[judul]' >
          </a>
        </div>
        <div class='artikle-text' data-target='$target' kode='$kode' style='width:100%;padding:0;margin-top:10px;'>
          <p class='waktu-berita'>". $datetime->time_ago( $q[tanggalwaktu] ) ."</p>
          <a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."' class='berita' title='$q[judul]'>$q[judul]</a>
          <!-- <a href='#' class='link-kategori'>$q[nama_kategori]</a> -->
        </div>
      </article>";   
      else:
        echo "
        <article class= 'artikle' >
          <div class='list-picture'>
            <a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."'>
              <img class='picture lazy' data-src='".$url->url_article_img($q[gambar], 180)."' alt='$q[judul]'/>
            </a>
          </div>
          <div class='artikle-text' data-target='$target' kode='$kode'>
            <p class='waktu-berita'>". $datetime->time_ago( $q[tanggalwaktu] ) ."</p>
            <a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."' class='berita' title='$q[judul]'>$q[judul]</a>
            <!-- <a href='#' class='link-kategori'>$q[nama_kategori]</a> -->
          </div>
        </article>";   
      endif;
    endwhile;
  endif;
endif;
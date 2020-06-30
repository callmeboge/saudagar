<?php
session_start();
error_reporting(0);

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
	include "../../../config/library.php";
	include "../../../config/fungsi_thumb.php";
	include "../../../config/fungsi_seo.php";
	include "../../../library/src/ThumbLib.inc.php";
	include "../../../class/data.php";

	$gambar_upload = new data;
	$module=$_GET[module];
	$act=$_GET[act];

	// Hapus berita
	if ($module=='berita' AND $act=='hapus'){
		if (! empty($_GET[id])):
			$data=mysql_fetch_array(mysql_query("SELECT gambar FROM berita WHERE id_berita='$_GET[id]'"));
			// var_dump($_SERVER);
			if ($data[gambar]):
				$gambar_upload->delete_gambar("img_berita", [700, 600, 300,180], $data[gambar]);
			endif;

			mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");

		endif;
	header('location:../../media.php?module='.$module);
	}

	// Input berita
	elseif ($module=='berita' AND $act=='input'){
		$jud = mysql_escape_string ($_POST[judul] );
		$ket_gam = mysql_escape_string( $_POST[keterangan_gambar] );
		$deskripsi = mysql_escape_string( $_POST[deskripsi] );
		$topik = $_POST[topik];
		$subjud =  $_POST[sub_judul];
		$reporter = $_POST[reporter];
		$youtube = $_POST[youtube];
		$kategori = $_POST[kategori];
		$dae = $_SESSION[daerah];
		$headline = $_POST[headline];
		$aktif =  $_POST[aktif];
		$utama = $_POST[utama];
		$dibaca = $_POST[dibaca];
		$isi_berita = $_POST[editor];
		$nama_user = $_SESSION[id];
		$tag = $_POST[tags_berita];
		$jenis_berita = $_POST[jenis_berita];
		$gambar = $_FILES[fupload][name];
		$judul_seo = seo_title($_POST[judul]);
		$topik_seo = seo_title($topik);
		$tanggalwaktu = date('Y-m-d H:i:s');

		// $tags = explode(',' , $tag);
		$gambar_upload->upload_gambar($_FILES[fupload], "img_berita", [700, 600, 300, 180], 85);
		// $name_extract = $gambar_upload->upload_gambar_multiple($_FILES[image_gall], $judul_seo , "img_galeri", [600, 1200], 85);

		// $sql = "INSERT INTO gallery(slug_gall, gambar, keterangan) VALUES";
		// for($i = 0; $i < 3; $i++):
		// 	$sql .= "( '$judul_seo', '".$name_extract[name_file][$i]."', '".$name_extract[exif_data][$i]."' )".($i < 2 ? ',' : '');
		// endfor;

		// mysql_query( $sql );
		// mysql_query( "INSERT INTO topik_news(nama_tag, tag_seo, kategori_tag, hari, tanggal_tag) VALUES('$topik', $topik_seo', '$kategori', '$hari_ini', '$tgl_sekarang')" );
		mysql_query( "INSERT INTO berita( judul,
														sub_judul,
														topik,
														jenis_berita,
														youtube,
														judul_seo,
														id_kategori,
														daerah,
														headline,
														aktif,
														utama,
														dibaca,
														username,
														isi_berita,
														deskripsi,
														keterangan_gambar,
														tag,
														tanggalwaktu,
														gambar,
														reporter)
												 VALUES('$jud',
														'$subjud',
														'$topik',
														'$jenis_berita',
														'$youtube',
														'$judul_seo',
														'$kategori',
														'$dae',
														'$headline',
														'$aktif',
														'$utama',
														'$dibaca',
														'$nama_user',
														'$isi_berita',
														'$deskripsi',
														'$ket_gam',
														'$tag',
														'$tanggalwaktu',
														'$gambar',
														'$reporter') ");

		header('location:../../media.php?module='.$module);
}

// Update berita
elseif ($module=='berita' AND $act=='update'){
	$jud = mysql_escape_string($_POST[judul]);
	$ket_gam= mysql_escape_string( $_POST[keterangan_gambar] );
	$subjud=  $_POST[sub_judul];
	$reporter=  $_POST[reporter];
	$youtube= $_POST[youtube];
	$kategori=  $_POST[kategori];
	$dae= $_SESSION[daerah];
	$headline=  $_POST[headline];
	$aktif=  $_POST[aktif];
	$utama= $_POST[utama];
	$dibaca= $_POST[dibaca];
	$nama_user= $_SESSION[id];
	$isi_berita=   $_POST[editor];
	$deskripsi = $_POST[deskripsi];
	$tag = $_POST[tags_berita];
	$jenis_berita = $_POST[jenis_berita];

	$judul_seo = seo_title($_POST[judul]);
	$topik = seo_title($_POST[sub_judul]);

	// Apabila gambar tidak diganti
	if(! empty($_POST[img_name]) && $_FILES[fupload][type] <> ''):
		$_FILES[fupload][name] = $_POST[img_name];
		// var_dump($_FILES[fupload]);
		$gambar_upload->upload_gambar($_FILES[fupload], "img_berita", [700, 600, 300, 180], 85);
	endif;

	mysql_query("UPDATE berita SET judul = '$jud',
							sub_judul  = '$subjud',
							topik = '$topik',
							jenis_berita = '$jenis_berita',
							youtube   = '$youtube',
							id_kategori   = '$kategori',
							daerah = '$dae',
							headline    = '$headline',
							aktif     = '$aktif',
							utama     = '$utama',
							tag         = '$tag',
							isi_berita  = '$isi_berita',
							deskripsi    = '$deskripsi',
							keterangan_gambar     = '$ket_gam',
							reporter = '$reporter'
						WHERE id_berita   = '$_POST[id]'");

	// header('location:../../media.php?module='.$module);
	}

}
?>
<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/library.php";
include "class/url.php";
include "class/data.php";
include "class/datetimes.php";

error_reporting(0);

$url = new url;
$data = new data;
$datetime = new Date_time;

$tes = $data->mode_tes();
define ('SITE_URL_IMG', $url->url_load_img('https', 'www', 'saudagarnews.id') ); 
define ('SITE_URL', $url->url_redirect('www', 'saudagar', '/', $tes) ); 

$new_request_uri = preg_replace("/(\/)/", "", $_SERVER[REQUEST_URI], 1);
$url_redirect_to_mobile = preg_replace("/saudagar\//", "", $new_request_uri);
if(! empty($_GET[menu])):
 $add_statement = "AND menu_dari = '$_GET[menu]'";
endif;

$x=1;
$terkini=mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND id_berita < '$_GET[urut]' $add_statement AND jenis_berita <> 'foto' ORDER BY id_berita DESC LIMIT 7");
while($t=mysql_fetch_array($terkini)){
	if($x%5 == 0):
		$inilah = mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND id_berita < '$_GET[urut_foto]' AND jenis_berita = 'foto' ORDER BY id_berita DESC LIMIT 1");
		while($foto=mysql_fetch_array($inilah)):
		echo "<li data-berita-foto='$foto[id_berita]'>
						<a href='".$url->url_baca($foto[menu_dari], $foto[id_berita], $foto[judul_seo])."'>
							<img class='lazy' data-src='".$url->url_article_img($foto[gambar], 700)."' alt='$foto[judul]' style='object-fit:cover;width:100%;'>
						</a>
						<div class='deskripsi-judul home reda' style='margin-top:15px;'>
							<p class='rubrik-tanggal'><a href='".$url->url_sub($foto[menu_dari], $foto[link])."'>".strtoupper($foto['nama_menu'])."</a>&nbsp;". $datetime->time_ago( $foto[tanggalwaktu] ) ."</p>
							<h6 ><a style='font-size:26px;line-height:1.3;' href='".$url->url_baca($foto[menu_dari], $foto[id_berita], $foto[judul_seo])."' title='$foto[judul]'>$foto[judul]</a></h6>
						</div>
					</li>";
					$_GET['urut_foto'] = $foto['id_berita'];
		endwhile;
	else:
		echo "<li data-berita='$t[id_berita]'>
		<a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."'>
			<img class='lazy' data-src='".$url->url_article_img($t[gambar])."' alt='$t[judul]'>
		</a>
		<div class='deskripsi-judul home'>
			<p style='margin-left:7px;' class='rubrik-tanggal'><a href='".$url->url_sub($t[menu_dari], $t[link])."'>".strtoupper($t['nama_menu'])."</a>&nbsp;". $datetime->time_ago( $t[tanggalwaktu] ) ."</p>
			<h6><a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."' title='$t[judul]'>$t[judul]</a></h6>
			<p class='deskripsi-data'> $t[deskripsi]</p>
		</div>
	</li>";
	endif; 
	$x++;
}
?>
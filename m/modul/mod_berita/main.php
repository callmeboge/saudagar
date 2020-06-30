<ul class="navbar sub-rubrik">
<?php
	$query = mysql_query("SELECT * FROM menu WHERE menu_dari = 'Mobile' ORDER BY menu_order ASC");
	while($menu = mysql_fetch_array($query)):
		echo "<li class='".($_GET['jn'] == $menu[link] ? 'active' : '')."'><a href='".SITE_URL.$menu[link]."'>$menu[nama_menu]</a></li>";	
	endwhile;

	if($_GET['jn'] == 'popular'):
		$today = date('Y-m-d H:i:s');
		$terkini = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND tanggalwaktu BETWEEN DATE_SUB('$today', INTERVAL 7 DAY) AND '$today' AND berita.headline = 'Y' ORDER BY dibaca DESC LIMIT 3;");
		$_ajx_data = ['data-target' => $_GET['jn'], 'kategori' => $_GET['jn']];
	elseif($_GET['jn'] == 'berita-utama'):	
		$terkini = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND utama = 'Y' AND berita.headline = 'Y' ORDER BY id_berita DESC LIMIT 3");
		$_ajx_data = ['data-target' => $_GET['jn'], 'kategori' => $_GET['jn']];
	elseif($_GET['jn'] == 'rekomendasi'):
		$terkini = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.aktif = 'Y' AND berita.headline = 'Y' ORDER BY id_berita DESC LIMIT 3");
		$_ajx_data = ['data-target' => $_GET['jn'], 'kategori' => $_GET['jn']];
	else:
		$terkini = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.headline = 'Y' ORDER BY id_berita DESC LIMIT 3");
		$_ajx_data = ['data-target' => 'update', 'kategori' => 'update'];
	endif;
?>
</ul>
 	<section class="container-fluid" style="background-color:white;padding:0 10px;">
		<section class="headline row">
			<div id="home-carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#home-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#home-carousel" data-slide-to="1"></li>
					<li data-target="#home-carousel" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner" role='listbox'>
					<?php
						while($t=mysql_fetch_array($terkini)){
							// if($_GET['jn'] == 'popular'):
							// 	$id1 = $t["dibaca"];
							// else:
							// 	$id1 = $t['id_berita'];
							// endif;
							$id1 = $t['id_berita'];
					echo"
							<div class='item'>
								<img class='lazy' data-src='".$url->url_article_img($t[gambar], 700)."' alt='Header-$t[judul]'>
								<span class='judul-berita-utama'>
									<div class='caption-dt-jd'>
										<span class='tanggal-release home'>". $datetime->time_ago( $t[tanggalwaktu] ) ."</span>
										<h3><a href='".$url->url_baca($t['menu_dari'], $t['id_berita'], $t['judul_seo'])."' title='$t[judul]'>$t[judul]</a></h3>
									</div>
								</span>
							</div>"; }?>
				</div>
				<!-- Kontrol navigasi Left & Right -->
				<a href="#home-carousel" class="left carousel-control" data-slide="prev">
				<!-- <i style="margin-top:100px;" class="fa fa-2x fa-chevron-left"></i> -->
				<svg style="width:48px;height:48px;margin-top:100px;" viewBox="0 0 24 24">
						<path fill="#fff" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
				</svg>
			</a>
			<a href="#home-carousel" class="right carousel-control" data-slide="next">
				<!-- <i style="margin-top:100px;" class="fa fa-2x fa-chevron-right"></i> -->
				<svg style="width:48px;height:48px;margin-top:100px;" viewBox="0 0 24 24">
					<path fill="#fff" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
				</svg>
			</a>
				<!-- end -->
			</div>
		</section>
		<!-- <section>
			<h4>TOPIK KHUSUS</h4>
			<?php
				$topik = mysql_query("SELECT topik, sub_judul FROM berita WHERE topik != '' GROUP BY topik");
				while ($tp = mysql_fetch_array($topik))
				{
					echo "<i class='fa fa-hashtag' style='color:#00a0a5;'></i>&nbsp;<a href='topik-$tp[topik]'>$tp[sub_judul]</a>";
				}
			?>
		</section> -->
		<hr>
		<section style="text-align:center;">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- M_Banner -->
			<ins class="adsbygoogle"
					style="display:inline-block;width:320px;height:50px"
					data-ad-client="ca-pub-4290882175389422"
					data-ad-slot="6679890438"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</section>
		<section id='daftar-artikel' class="daftar-artikel">
			<?php
			$x=1;
			/* MENU SELECTION QUERY */
			if($_GET['jn'] == 'popular'):
				$today = date('Y-m-d H:i:s');
				// $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.jenis_berita != 'foto' AND tanggal BETWEEN DATE_SUB('$today', INTERVAL 7 DAY) AND '$today' AND kategori.id_kategori = berita.id_kategori AND dibaca < '$id1' ORDER BY dibaca DESC LIMIT 15");
				$artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND tanggalwaktu BETWEEN DATE_SUB('$today', INTERVAL 7 DAY) AND '$today' ORDER BY dibaca DESC LIMIT 15");
			elseif($_GET['jn'] == 'rekomendasi'):
				// $artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.id_berita < '$id1' AND berita.aktif = 'Y' ORDER BY id_berita DESC LIMIT 15");
				$artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.id_berita != '$id1' AND berita.aktif = 'Y' ORDER BY id_berita DESC LIMIT 15");
			elseif($_GET['jn'] == 'berita-utama'):
				$artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.jenis_berita != 'foto' AND id_berita != $id1 AND utama='Y' ORDER BY id_berita DESC LIMIT 15");
			else:
				$artikel = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND berita.jenis_berita != 'foto' AND id_berita != $id1 ORDER BY id_berita DESC LIMIT 15");
			endif;

			while($q=mysql_fetch_array($artikel))
			{
				if($_GET['jn'] == 'popular'):
					$kode = $q['dibaca'];
				else:
					$kode = $q['id_berita'];
				endif;
			if($q[jenis_berita] == 'foto'):
					echo "<article class= 'artikle' >
					<div class='list-picture photo-gall'>
						<a href='".$url->url_baca($q['menu_dari'], $q['id_berita'], $q['judul_seo'])."'>
							<img class='picture lazy' data-src='".$url->url_article_img($q[gambar], 700)."' alt='$q[judul]' >
						</a>
					</div>
					<div class='artikle-text' data-target='update' kode='$q[id_berita]' style='width:100%;padding:0;margin-top:10px;'>
						<a href='".$url->url_baca($q['menu_dari'], $q['id_berita'], $q['judul_seo'])."' class='berita' title='$q[judul]'>$q[judul]</a>
						<!-- <a href='#' class='link-kategori'>$q[nama_kategori]</a> -->
						<br>
						<p class='waktu-berita'> ". $datetime->time_ago( $q[tanggalwaktu] ) ." </p> 
					</div>
				</article>";
				elseif($x == '6' || $x=='11'):
					echo '<article class="artikle" style="text-align:center;">
									<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<!-- M_Banner -->
									<ins class="adsbygoogle"
											style="display:inline-block;width:320px;height:50px"
											data-ad-client="ca-pub-4290882175389422"
											data-ad-slot="6679890438"></ins>
									<script>
									(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
					</article>';
			else:
				echo "<article class= 'artikle' >
					<div class='list-picture'>
						<a href='".$url->url_baca($q['menu_dari'], $q['id_berita'], $q['judul_seo'])."'>
							<img class='picture lazy' data-src='".$url->url_article_img($q[gambar], 180)."' alt='$q[judul]' >
						</a>
					</div>
					<div class='artikle-text' data-target='".$_ajx_data['data-target']."' kode='$kode'>
						<p class='waktu-berita'> ". $datetime->time_ago( $q[tanggalwaktu] ) ." </p>
            <a href='".$url->url_baca($q['menu_dari'], $q['id_berita'], $q['judul_seo'])."' class='berita' title='$q[judul]'>$q[judul]</a>
					</div>
				</article>";
			endif;
			$x++;
			}
		?>
		</section>
		<section id="daftar-artikel"></section>
		<div id="more" style="display: none;">
			<center><i class="fa fa-2x fa-spin fa-circle-o-notch" style="color:#035680;display:block;"></i>Memuat...</center>
		</div>
		</section>
<script>
		$(document).ready(function(){
			var loadMore = true;
			$(window).scroll(function(){
				var nearbottom = 110;
				if($(window).scrollTop()+nearbottom >= $(document).height() - $(window).height() && loadMore)
				{
					loadMore = false;
					$.ajax({
            method: 'GET',
            url: 'more.php',
            data:{
              kategori: '<?= $_ajx_data['kategori']; ?>',
              urut: $('.artikle-text[data-target=<?= $_ajx_data['data-target']; ?>]:last').attr('kode')
            },
						beforeSend: function()
						{
							$('#more').show();
						},
						complete: function()
						{
							$('#more').hide().delay(1000);
						},
						success: function(result)
						{
							if(result)
							{
								$('#daftar-artikel').append(result);
								$('.lazy').lazy();
									loadMore = true;
							}
						}
					});
				}
			});
		});
	</script>

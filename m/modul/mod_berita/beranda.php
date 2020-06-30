<ul class="navbar sub-rubrik">
<?php
	$sql = mysql_query("SELECT * FROM menu WHERE menu_dari = 'Mobile' ORDER BY menu_order ASC");
	while($row = mysql_fetch_array($sql)):
		echo "<li><a href='$row[link]'>$row[nama_menu]</a></li>";
	endwhile;

?>
    <!-- <li class='active'><a href='./'>Terkini</a></li>
    <li><a href='rekomendasi'>Rekomendasi</a></li> -->
  </ul>
 	<section class="container-fluid" style="background-color:white;padding:0 10px;">
		<section class="headline">
		<div id='home-carousel' class='carousel slide' data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#home-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#home-carousel" data-slide-to="1"></li>
				<li data-target="#home-carousel" data-slide-to="2"></li>
			</ol>
      <div class="carousel-inner"> 
				<?php
					$terkini=mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND headline='Y' ORDER BY id_berita DESC LIMIT 3");
					while($t=mysql_fetch_array($terkini)){
						$id = $t['id_berita'];
				echo"
						<div class='item'>
							<img class='lazy' data-src='".$url->url_article_img($t[gambar], 700)."' alt='$t[judul]'>
							<span class='judul-berita-utama'>
								<div class='caption-dt-jd'>
									<span class='tanggal-release home'>". $datetime->time_ago( $t[tanggalwaktu] ) ."</span>
									<h3><a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."'>$t[judul]</a></h3>
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
		<section>
			<!-- <h4>TOPIK KHUSUS</h4>
			<?php
				$topik = mysql_query("SELECT topik, sub_judul FROM berita WHERE topik != '' GROUP BY topik");
				while ($tp = mysql_fetch_array($topik))
				{
					echo "<i class='fa fa-hashtag' style='color:#035680;'></i>&nbsp;<a style='text-transform:uppercase;' href='topik-$tp[topik]'>$tp[sub_judul]</a>";
				}
			?> -->
		</section>
		<hr>
		<img src="<?= SITE_URL."foto_banner/saudagar.jpg"?>" alt="" width="100%">
		<section class="daftar-artikel">
			<?php
			$x = 1;
			$artikel=mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND jenis_berita <> 'foto' ORDER BY id_berita DESC LIMIT 20");
			while($q=mysql_fetch_array($artikel))
			{
				if($x%5 == 0):
					if($state):
						$add_q = "AND id_berita < '$test'";
					else:
						$add_q = '';
					endif;
					$inilah = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND jenis_berita = 'foto' $add_q ORDER BY id_berita DESC LIMIT 1");
					while($foto=mysql_fetch_array($inilah)):
				 		echo "<article class= 'artikle' >
						<div class='list-picture photo-gall'>
							<a href='".$url->url_baca($foto[menu_dari], $foto[id_berita], $foto[judul_seo])."'>
								<img class='picture lazy' data-src='".$url->url_article_img($foto[gambar], 700)."' alt='$foto[judul]' >
							</a>
						</div>
						<div class='artikle-text' data-target='update-foto' kode='$foto[id_berita]' style='width:100%;padding:0;margin-top:10px;'>
							<p class='waktu-berita'>". $datetime->time_ago( $q[tanggalwaktu] ) ."</p>
							<a hdref='".$url->url_baca($foto[menu_dari], $foto[id_berita], $foto[judul_seo])."' class='berita' title='$foto[judul]'>$foto[judul]</a>
							<!-- <a href='#' class='link-kategori'>$foto[nama_kategori]</a> -->
						</div>
					</article>";
					$state = true;
					$test = $foto['id_berita'];
					endwhile;
				elseif($x == 6):
					echo "<img src=\"".SITE_URL.'foto_iklanatas/handayani.jpeg'."\" width=\"100%\">";
				elseif($x == 11):
					echo "<img src=\"".SITE_URL.'foto_banner/bosowa.jpg'."\" width=\"100%\">";
				elseif($x == 9): ?>
					<article><h5 style="color:#035680;font-size:17px;font-weight:bold;">BERITA REKOMENDASI</h5>
					<section style="white-space:nowrap;overflow:auto;">
						<?php
							$topik = mysql_query("SELECT * FROM berita, menu WHERE id_berita = id_menu AND berita.aktif = 'Y' ORDER BY id_berita DESC LIMIT 9");
							while ($tp = mysql_fetch_array($topik))
							{
								echo "<article class= 'artikle' style='border:0;width:200px;display:inline-block;padding-right:15px !important;white-space:normal;vertical-align:top;'>
												<div class='list-picture rekomendasi'>
													<a href='".$url->url_baca($tp['menu_dari'], $tp['id_berita'], $tp['judul_seo'])."'>
														<img class='picture lazy' data-src='".$url->url_article_img($tp[gambar])."' alt='$tp[judul]'>
													</a>
												</div>
												<div class='artikle-text' data-target='update' kode='$tp[id_berita]' style='width:100%;padding:0;margin-top:10px;'>
													<a href='".$url->url_baca($tp['menu_dari'], $tp['id_berita'], $tp['judul_seo'])."' class='berita' title='$tp[judul]' style='font-size:14px;'>$tp[judul]</a>
													<br>
												</div>
											</article>";
							}
						?>
					</section> </article>
					<?php
					elseif($x == '6' || $x=='11'|| $x == '17'):
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
        
				endif;

				echo "<article class= 'artikle' >
								<div class='list-picture'>
									<a href='".$url->url_baca($q['menu_dari'], $q['id_berita'], $q['judul_seo'])."'>
										<img class='picture lazy' data-src='".$url->url_article_img($q[gambar], 180)."' alt='$q[judul]'/>
									</a>
								</div>
								<div class='artikle-text' data-target='update' kode='$q[id_berita]'>
									<p class='waktu-berita'>". $datetime->time_ago( $q[tanggalwaktu] ) ."</p>
									<a href='" .$url->url_baca($q['menu_dari'], $q['id_berita'], $q['judul_seo']). "' class='berita' title='$q[judul]'>$q[judul]</a>
								</div>
							</article>";
				$x++;
			}?>
			  <!-- img ads -->
				<img src="<?= SITE_URL."foto_banner/pegadaian.jpg"?>" width="100%">
            <!-- end img -->
		</section>
		<section id="daftar-artikel"></section>
		<div id="more" style="display: none;">
			<center><i class="fa fa-2x fa-spin fa-circle-o-notch" style="color:#035680;margin:10px 0;display:block;"></i>Memuat...</center>
		</div>
		</section>
<script>
		$(document).ready(function(){
			var loadMore = true;
			$(window).scroll(function(){
				if($(window).scrollTop() + 110 >= $(document).height() - $(window).height() && loadMore)
				{
					loadMore = false;
					$.ajax({
						method: 'GET',
						url: 'more.php',
						data: {
							kategori: 'update',
							urut: $('.artikle-text[data-target=update]:last').attr('kode'),
							urut_foto: $('.artikle-text[data-target=update-foto]:last').attr('kode')
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
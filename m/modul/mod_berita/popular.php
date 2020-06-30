<ul class="navbar sub-rubrik">
    <li><a href='./'>Terkini</a></li>
    <li class='active'><a href='popular'>Popular</a></li>
    <li><a href='rekomendasi'>Rekomendasi</a></li>
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
						$today = date('Y-m-d');
						$terkini=mysql_query("SELECT * FROM berita WHERE tanggal BETWEEN DATE_SUB('$today', INTERVAL 7 DAY) AND '$today' ORDER BY dibaca DESC LIMIT 3;");
						// $terkini=mysql_query("SELECT * FROM berita WHERE tanggal BETWEEN DATE_SUB('2017-11-28', INTERVAL 7 DAY) AND '2017-11-28' ORDER BY dibaca DESC LIMIT 1;");
						while($t=mysql_fetch_array($terkini)){
							$tgl = tgl_indo($t["tanggal"]);
							$jam = trans_jam($t["jam"]);
							$id1 = $t["dibaca"];
					echo"
							<div class='item'>
								<img class='lazy' src='assets/base.png' data-src='http://harianamanah.com/foto_berita/$t[gambar]' alt='Header-$t[judul]' style='width:100%;height:285px;object-fit:cover;'>
								<span class='judul-berita-utama'>
									<div class='caption-dt-jd'>
										<h3><a href='berita-$t[judul_seo]' title='$t[judul]'>$t[judul]</a></h3>
										<span class='tanggal-release home'>$t[hari], $tgl - $jam</span>
									</div>
								</span>
							</div>"; }?>
				</div>
			</div>
		</section>
		<section>
			<!-- <h4>TOPIK KHUSUS</h4>
			<?php
				$topik = mysql_query("SELECT topik, sub_judul FROM berita WHERE topik != '' GROUP BY topik");
				while ($tp = mysql_fetch_array($topik))
				{
					echo "<i class='fa fa-hashtag' style='color:#00a0a5;'></i>&nbsp;<a href='topik-$tp[topik]'>$tp[sub_judul]</a>";
				}
			?> -->
		</section>
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
			$_digit = 50;
			$x=1;
			// $artikel=mysql_query("SELECT * FROM berita, kategori WHERE tanggal BETWEEN '2017-11-27' AND '2017-11-28' AND kategori.id_kategori = berita.id_kategori AND dibaca < '$id1' ORDER BY dibaca DESC LIMIT $_digit");
			$date = date('Y-m-d');
			$artikel=mysql_query("SELECT * FROM berita, kategori WHERE tanggal BETWEEN DATE_SUB('$date', INTERVAL 7 DAY) AND '$date' AND kategori.id_kategori = berita.id_kategori AND dibaca < '$id1' ORDER BY dibaca DESC LIMIT $_digit");
			while($q=mysql_fetch_array($artikel))
			{
        $tgl = tgl_indo($q['tanggal']);
				$jam = trans_jam($q['jam']);
			if($x%5 == 0):
				if($state):
					$add_q = "AND id_berita < '$test'";
				else:
					$add_q = ''; 
				endif;
				$inilah = mysql_query("SELECT * FROM berita b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE jenis_berita = 'foto' $add_q ORDER BY b.id_berita DESC LIMIT 1");
				while($foto=mysql_fetch_array($inilah)):
					echo "<article class= 'artikle' >
					<div class='list-picture'>
						<a href='berita-$foto[judul_seo]'>
							<img class='picture lazy' src='assets/base.png' data-src='http://harianamanah.com/foto_berita/$foto[gambar1]' alt='$foto[judul]' style='width:100%;height:auto;object-fit:cover;'>
						</a>
					</div>
					<div class='artikle-text' data-target='update' kode='$foto[id_berita]' style='width:100%;padding:0;margin-top:10px;'>
						<a href='berita-$foto[judul_seo]' class='berita' title='$foto[judul]'>$foto[judul]</a>
						<!-- <a href='#' class='link-kategori'>$foto[nama_kategori]</a> -->
						<br>
						<p class='waktu-berita'> $foto[hari], $tgl - $jam </p> 
					</div>
				</article>";
				$state = true;
				$test = $foto['id_berita'];
				endwhile;
			elseif($x == 9 || $x == 29):
				echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
							style="display:block"
							data-ad-format="autorelaxed"
							data-ad-client="ca-pub-4290882175389422"
							data-ad-slot="9556530284"></ins>
				<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
				</script>';
			else:
				echo "<article class= 'artikle' >
					<div class='list-picture'>
						<a href='berita-$q[judul_seo]'>
							<img class='picture lazy' src='assets/base_n.png' data-src='http://harianamanah.com/foto_small/$q[gambar1]' alt='$q[judul]' />
						</a>
					</div>
					<div class='artikle-text' data-target='popular' kode='$q[dibaca]'>
            <a href='berita-$q[judul_seo]' class='berita' title='$q[judul]'>$q[judul]</a>
            <a href='kategori-$q[id_kategori]-$q[kategori_seo]' class='link-kategori'>$q[nama_kategori]</a>
            <p class='waktu-berita'> $q[hari], $tgl - $jam </p>
					</div>
				</article>";
			endif;
			$x++;
			}
		?>
		</section>
		<!-- <div class="iklan">
      <a href="abutours" title="AbuTours.com">
        <img class="img-responsive" src="assets/abujie.jpg" alt="iklan">
      </a>
    </div> -->

		<section id="daftar-artikel"></section>
		<div id="more" style="display: none;">
			<center><i class="fa fa-2x fa-spin fa-circle-o-notch" style="color:#1c9fa7;margin:10px 0;"></i></center>
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
              kategori: 'popular',
              urut: $('.artikle-text[data-target=popular]:last').attr('kode')
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
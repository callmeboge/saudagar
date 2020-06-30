  <section class="container-fluid" style="padding:0;background:#fff;">
			<section class="daftar-artikel search">
        <span class="fl art-count">
				<?php
          $kata = $_GET['tag'];
          // $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
          echo "<h3 style='font-weight:bold;line-height:1;margin-bottom:0;text-transform:uppercase;'>#".str_replace('-', ' ', $kata)."</h3><br>";
          
          $hasilcari_page = new Paging_hasilcari_mobtag;
          $batas = 15;
          $cariposisi = $hasilcari_page->cariPosisi($batas);

          $cari = "SELECT * FROM berita b JOIN menu m ON b.id_kategori = m.id_menu where judul LIKE '%$kata%' OR isi_berita LIKE '%$kata%' ORDER BY id_berita DESC LIMIT $cariposisi, $batas";
          $hasil  = mysql_query($cari);
        ?>
        </span>
<?php
  while($r=mysql_fetch_array($hasil)){
  echo"<article class= 'artikle' style='padding:0;'>
								<div class='list-picture'>
									<a href='berita-$r[judul_seo]'>
									<img class='picture lazy' data-src='".$url->url_article_img($r[gambar], 180)."' alt='$r[judul]'>
									</a>
								</div>
								<div class='artikle-text' kode='$r[id_berita]'>
                  <p class='waktu-berita'>". $datetime->time_ago( $r[tanggalwaktu] ) ."</p>
                  <a href='".$url->url_baca($r['menu_dari'], $r['id_berita'], $r['judul_seo'])."' title='$r[judul]' class='berita'>$r[judul]</a>
								</div>
				</article>
  ";}

  $cari = "SELECT * FROM berita b JOIN menu m ON b.id_kategori = m.id_menu where judul LIKE '%$kata%' OR isi_berita LIKE '%$kata%' ORDER BY id_berita DESC";
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);

  $jumlah_halaman = $hasilcari_page -> jumlahHalaman($ketemu, $batas);
  $link_halaman = $hasilcari_page -> navHalaman($_GET['halaman'], $jumlah_halaman);
  ?>
  <div style="text-align:center;width:100%;">
    <ul class="pagination">
      <?php echo $link_halaman;?>
    </ul>
  </div>
  </section>
</section>
<section style="text-align:center;">
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Mobile Banner -->
  <ins class="adsbygoogle"
      style="display:inline-block;width:320px;height:50px"
      data-ad-client="ca-pub-4290882175389422"
      data-ad-slot="6679890438"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</section>
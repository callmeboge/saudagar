<?php
  $sq = mysql_query("SELECT id_menu, nama_menu, menu_dari from menu where link='$_GET[id]'");
  $n = mysql_fetch_array($sq);
?>
<div class="wraplist">
<div id="listberita">
    <section class="container cf" style="margin-bottom:0px;padding:0;margin-top:0;"><!--konten start-->
          <div class="right-konten" style="border: 0px solid red;"><!-- right konten start -->
              <div class="penulis"><!-- penulis start -->
                  <?php
                  echo"<h2 style=\"text-transform:uppercase;font-weight:bold !important;\">$n[nama_menu]</h2>";
                  ?>
          <div class="ket">
            <!-- <p>Portal Harian Amanah hadir dengan wajah baru, sejak 25 Juli 2016. Meskipun sebelumnya portal berita sudah ada. Namun dengan wajah dan tampilan baru ini, dirasakan lebih kompetitif dengan media sejenis lainnya. Portal Berita Amanah menjadi media yang mendampingi Harian Amanah.</p> -->
          </div>
        </div>
        <div id="fixed-right" class="single_blog_sidebar wow fadeInUp" style="background-color: #fff;height:auto;margin-top:10px;margin-bottom:3px;"></div>
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- Banner Side -->
          <ins class="adsbygoogle"
              style="display:inline-block;width:300px;height:1050px"
              data-ad-client="ca-pub-4290882175389422"
              data-ad-slot="9517721043"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
        <!-- right konten start -->
        <div class="left-konten trend" style="float:right;margin:0;"><!-- left konten start -->
          <div class="art-social-bar">
          </div>
			<?php
      $p      = new Paging_kategori;
      $batas  = 15;
      $posisi = $p->cariPosisi($batas);
      $sql   = "SELECT judul, id_berita, isi_berita, judul_seo, gambar, tanggalwaktu FROM berita,users WHERE users.id=berita.username AND berita.id_kategori = '$n[id_menu]' ORDER BY id_berita DESC LIMIT $posisi, $batas";
      $hasil = mysql_query($sql);
      $jumlah = mysql_num_rows($hasil);
      if ($jumlah > 0){
      while($r=mysql_fetch_array($hasil))
      {
        echo"
        <div class='trend-left-inner'>
          <div class='trend-left-list cf'>
            <figure>
              <div class='left-trending-fix'>
                <a href='".$url->url_baca($n[menu_dari], $r[id_berita], $r[judul_seo])."'>
                  <img class='lazy' data-src='".$url->url_article_img($r[gambar])."' border='0' alt='$r[judul]'>
                </a>
              </div>
            </figure>
            <div class='trend-left-info'>
              <p style='margin-left:0;' class='rubrik-tanggal'>". $datetime->time_ago( $r[tanggalwaktu] ) ."</p>
              <a href='".$url->url_baca($n[menu_dari], $r[id_berita], $r[judul_seo])."'>$r[judul]</a>
              <div class='publish-info cf'>".substr(strip_tags($r['isi_berita']), 0, 100)."</div>
            </div>
          </div>
        </div>";
      }
    }

  $sql = "SELECT judul, id_berita, isi_berita, judul_seo, gambar, tanggalwaktu FROM berita,users WHERE users.id=berita.username AND berita.id_kategori = '$n[id_menu]' ORDER BY id_berita DESC";
  $jmldata = mysql_num_rows( mysql_query( $sql ) );

  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);?>
      <div class="clearfix"></div>
      <div class="halaman"> <?php echo $linkHalaman?></div>
     </div>
    </section><!--konten end-->
    <div class="clr"></div>
    <section class="big-ads" id="remove-fixed23"></section>
</div>
</div>
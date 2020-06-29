<?php
  $daerah = $_GET['daerah_pilkada'];
  $calon = $_GET['calon'];
  // query nama calon kepala daerah
  $query = mysql_query("SELECT nama_pasangan FROM pilkada WHERE tag_seo = '$_GET[calon]'");
  $row_calon = mysql_fetch_array($query);
?>
<div class="wraplist">
  <div id="listberita">
    <section class="container cf" style="margin-bottom:0px;padding:0;"><!--konten start-->
    <!-- right konten start -->
    <div class="left-konten trend"><!-- left konten start -->
      <div class="art-social-bar">
        <span class="fl art-count">
        <?php
        $data_kata = "SELECT * FROM berita b JOIN menu m ON b.id_kategori = m.id_menu where judul LIKE '%$kata%' OR isi_berita LIKE '%$kata%'";
        $hasil  = mysql_query($data_kata);
        $data_artikel = mysql_num_rows($hasil);

        // echo "<h1 style='margin-bottom:0;font-weight:bolder;text-transform:uppercase;'>$calon</h1>";
        // echo "<div style='font-size:20px;font-weight:bold;line-height:1;'>$row[nama_pasangan]</div>";
        // echo "<div style='font-size:20px;font-weight:100;line-height:1;'>#$daerah</div>";
        echo "<br>";
        echo "<div style='font-size:20px;font-weight:100;line-height:1;'>$data_artikel berita yang ditemukan.</div>";
        echo "</span></div>";
        
        // call pagination
        $hasilcari_page = new Paging_hasiltag;
        $batas = 15;
        $cariposisi = $hasilcari_page->cariPosisi($batas);
        // end

        $cari = "SELECT * FROM berita b JOIN menu m ON b.id_kategori = m.id_menu where judul LIKE '%$kata%' OR isi_berita LIKE '%$kata%' ORDER BY id_berita DESC LIMIT $cariposisi, $batas";
        $hasil_cari  = mysql_query($cari);
        $ketemu = mysql_num_rows($hasil_cari);

        if ($ketemu > 0){
          while($r=mysql_fetch_array($hasil_cari)){
          $tgl = tgl_indo($r['tanggal']);
          echo "
          <div class='trend-left-inner'>
            <div class='trend-left-list cf'>
              <span class='img-circle trend-bullet'></span>
              <figure>
                <div class='left-trending-fix'>
                <a href='berita-$r[judul_seo]' title='$r[judul]'>
                  <img class='lazy' src='".SITE_URL."foto_statis/base.png' data-src='".SITE_URL_IMG."foto_berita/$r[gambar]' border='0' alt='$r[judul]'>
                </a>
                </div>
              </figure>
              <div class='trend-left-info'>
                <a href='".SITE_URL."berita-$r[judul_seo]' title='$r[judul]' style='margin-top:0;'>$r[judul]</a>
                <div class='publish-info cf'>".substr(strip_tags($r['isi_berita']), 0, 160)." - <a style='display:inline-block;margin:0;color:#19A2AC;line-height:1;' href='$r[link]'>$r[nama_menu]</a></div>
              </div>
            </div>
          </div>";}
      } 
      $jumlah_halaman = $hasilcari_page -> jumlahHalaman($data_artikel, $batas);
      $link_halaman = $hasilcari_page -> navHalaman($_GET['halaman'], $jumlah_halaman); ?>
      <div class="clearfix"></div>
      <div class="halaman">
        <?php echo $link_halaman;?>
      </div>
      </div>
    </section><!--konten end-->
    <div class="clr"></div>
    <section class="big-ads" id="remove-fixed23">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Banner Bottom -->
      <ins class="adsbygoogle"
          style="display:inline-block;width:728px;height:90px"
          data-ad-client="ca-pub-4290882175389422"
          data-ad-slot="4948221961"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </section>
  </div>
</div>
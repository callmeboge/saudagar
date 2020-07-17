<div class="wraplist">
  <div id="listberita">
    <section class="container cf" style="margin-bottom:0px;padding:0;"><!--konten start-->
      <!-- right konten start -->
      <div class="left-konten trend"><!-- left konten start -->
        <div class="art-social-bar">
        <span class="fl art-count">
        <?php
        $kata = $_GET['query-search'];

        echo "<div style='font-size:17px;font-weight:100;line-height:1.5;'>Hasil Pencarian <b>\"$kata\"</b></div>";
        echo "</span></div>";
        
        // call pagination
        $hasilcari_page = new Paging_hasilcari;
        $batas = 15;
        $cariposisi = $hasilcari_page->cariPosisi($batas);
        // end

        $cari = "SELECT * FROM berita b JOIN menu m ON b.id_kategori = m.id_menu where judul LIKE '%$kata%' ORDER BY id_berita DESC LIMIT $cariposisi, $batas";
        $hasil_cari  = mysql_query($cari);
        $ketemu = mysql_num_rows($hasil_cari);

        if ($ketemu > 0){
          while($r = mysql_fetch_array($hasil_cari)){
          echo "
          <div class='trend-left-inner'>
            <div class='trend-left-list cf'>
              <figure>
                <div class='left-trending-fix'>
                <a href='".$url->url_baca($r[menu_dari], $r[id_berita], $r[judul_seo])."' title='$r[judul]'>
                  <img class='lazy' data-src='".$url->url_article_img($r[gambar])."' border='0' alt='$r[judul]'>
                </a>
                </div>
              </figure>
              <div class='trend-left-info'>
                <p style='margin-left:0;' class='rubrik-tanggal'><a style='display:inline' href='".$url->url_sub($r[menu_dari], $r[link])."'>".strtoupper($r['nama_menu'])."</a>&nbsp;". $datetime->time_ago( $r[tanggalwaktu] ) ."</p>
                <a href='".$url->url_baca($r[menu_dari], $r[id_berita], $r[judul_seo])."' title='$r[judul]' style='margin-top:0;font-size:16px;font-weight:bolder;'>$r[judul]</a>
                <div class='publish-info cf'>".substr(strip_tags($r['isi_berita']), 0, 100)."</div>
              </div>
            </div>
          </div>";}
      } 

      $navigasi = "SELECT * FROM berita b JOIN menu m ON b.id_kategori = m.id_menu where judul LIKE '%$kata%' ORDER BY id_berita DESC";
      $data_artikel = mysql_num_rows(mysql_query($navigasi));

      $jumlah_halaman = $hasilcari_page -> jumlahHalaman($data_artikel, $batas);
      $link_halaman = $hasilcari_page -> navHalaman($_GET['halaman'], $jumlah_halaman); ?>
      <div class="clearfix"></div>

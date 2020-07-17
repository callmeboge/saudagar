<div class="wraplist">
  <div id="listberita">
    <section class="container cf" style="margin-bottom:0px;padding:0;"><!--konten start-->
      <!-- right konten start -->
      <div style="float:left;width:25%;margin-right:25px;margin-top:25px;">
        <div class="list-indeks">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:left;">
              <h6 style="text-transform:uppercase;margin:0;font-weight:bold;font-size:16px;">Indeks Kanal</h6>
            </div>
            <div class="panel-body" style="padding:0 15px;">
              <ul class="menu-list-index">
              <?php
                  $sql = mysql_query("SELECT * FROM menu WHERE menu = 'Main' AND menu_dari != 'Mobile' AND aktif = 'Ya' ORDER BY menu_order");
                  while($r = mysql_fetch_array($sql)){
                    echo "<li><a class='". ($_GET[menu] == $r[menu_dari] ? 'active' : '') ."' href='". $url->url_index_menu($r[link]) ."'>$r[nama_menu]</a>
                    </li>";
                  }
              ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="left-konten trend"><!-- left konten start -->
      <?php
        if($_GET[menu]):
          $choose = "AND menu != 'Main' AND menu_dari = '$_GET[menu]'";
        endif;
        
        // call pagination
        $hasilcari_page = new Paging_hasiltag;
        $batas = 15;
        $cariposisi = $hasilcari_page->cariPosisi($batas);
        // end
        

        $cari = "SELECT * FROM berita, menu WHERE id_menu = id_kategori $choose ORDER BY id_berita DESC LIMIT $cariposisi, $batas";
        $hasil_cari  = mysql_query($cari);
        $ketemu = mysql_num_rows($hasil_cari);

        if ($ketemu > 0){
          while($r=mysql_fetch_array($hasil_cari)){
          echo "
          <div class='trend-left-inner'>
            <div class='trend-left-list cf'>
              <figure>
                <div class='left-trending-fix'>
                <a href='".$url->url_baca($r[menu_dari], $r[id_berita], $r[judul_seo])."' title='$r[judul]'>
                  <img class='lazy' data-src='".$url->url_article_img($r[gambar])."' border='0' alt='$r[judul]'>

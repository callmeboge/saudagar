  <div id="page-content" class="index-page container">
    <div id="sidebar" style="padding:0;">
      <div class="col-xs-12" style="padding:0;float:none;margin-bottom:25px;">
        <div class='flex-container'>
        <?php
        $rubrik=mysql_query("SELECT id_berita,
                                    b.id_kategori,
                                    u.username,
                                    m.menu_dari,
                                    judul,
                                    tanggalwaktu,
                                    judul_seo,
                                    gambar
                              FROM berita b, users u, menu m
                              WHERE b.id_kategori = m.id_menu AND b.username = u.id and menu_dari = '$_GET[menu]'
                              ORDER BY id_berita DESC LIMIT 3");
        $i=0;
        while($row = mysql_fetch_array($rubrik)){
          $id_berita = $row['id_berita'];
          echo "<div class='item-flex grid-$i'>
                  <a href='".$url->url_baca($row[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'><h2 class='grid-flex-foto'>$row[judul]</h2></a>
                  <span class='info-uploader' style='margin-left:5px;'>". $datetime->time_ago( $row[tanggalwaktu] ) ."</span>
                  <div class='black_layer'></div>
                  <img class='lazy' data-src='".$url->url_article_img($row[gambar], 700)."' alt='$row[judul]' style='height:inherit;object-fit:cover;'>
                </div>";
        $i++;
        }
      ?>
      </div>
      </div>
      <div class="col-xs-12" style="padding:0;float:none;">
      <div class="col-xs-9 news-category" style="padding:0;">
          <?php
          $terkini=mysql_query("SELECT id_berita,
                                        b.id_kategori,
                                        u.username,
                                        m.nama_menu,
                                        m.menu_dari,
                                        m.link,
                                        tanggalwaktu,
                                        judul,
                                        judul_seo,
                                        gambar
                                    FROM berita b, users u, menu m
                                    WHERE b.id_kategori = m.id_menu AND b.username = u.id and menu_dari = '$_GET[menu]' and b.id_berita < $id_berita
                                    ORDER BY id_berita DESC LIMIT 27");
					while($t=mysql_fetch_array($terkini)){
            echo "
            <article>
              <div class='badges-cate'>
                <span style='background:#fff'><a href='".$url->url_sub($t[menu_dari], $t[link])."'>$t[nama_menu]</a></span>
              </div>
              <a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."'>
                <img class='lazy' data-src='".$url->url_article_img($t[gambar])."' alt='$t[judul]'>
              </a>
              <span style='font-size:10px;display:block;padding:5px 0;'>". $datetime->time_ago( $t[tanggalwaktu] ) ."</span>
              <a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."' class='captions'>$t[judul]</a>
            </article>"; }
          ?>
          <div class="clearfix"></div>
          <div id="more_animasi" style="text-align:right;margin-top:10px;"><a id="more_indeks" href="indeks" style='border-radius:50px 0 0 0 ;'>INDEKS</a></div>
        </div>
      <div class="clearfix"></div>
      </div>
    </div>
		<div id="daftar-artikel"></div>
    
		<div id="more" style="display: none;">
			<center><img src="images/loading.gif" width="170px"></center>
		</div>
	</div>

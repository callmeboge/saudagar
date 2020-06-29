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
                                    judul_seo,
                                    tanggal,
                                    jam,
                                    hari,
                                    gambar
                              FROM berita b, users u, menu m
                              WHERE b.id_kategori = m.id_menu AND b.username = u.id AND jenis_berita = 'foto'
                              ORDER BY id_berita DESC LIMIT 5");
        $i=0;
        while($row = mysql_fetch_array($rubrik)){
          $tgl = tgl_indo_short($row['tanggal']);
          $jam = trans_jam($row['jam']);
          $id_berita = $row['id_berita'];
          echo "<div class='item-flex grid-$i'>
          
          <a href='".$url->url_baca($row[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'><h2 class='grid-flex-foto'>$row[judul]</h2></a>
          <span class='info-uploader' style='margin-left:5px;'>$row[hari], $tgl - $jam</span>
          <div class='black_layer'></div>
          <img class='lazy' src='".SITE_URL."foto_statis/base.png' data-src='".SITE_URL_IMG."foto_berita/$row[gambar]' alt='$row[judul]'>
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
                                        judul,
                                        judul_seo,
                                        tanggal,
                                        jam,
                                        hari,
                                        gambar
                                    FROM berita b, users u, menu m
                                    WHERE b.id_kategori = m.id_menu AND b.username = u.id and menu_dari = '$_GET[menu]' AND jenis_berita = 'foto' and b.id_berita < $id_berita
                                    ORDER BY id_berita DESC LIMIT 27");
					while($t=mysql_fetch_array($terkini)){
            $tgl = tgl_indo_short($t['tanggal']);
            $jam = trans_jam($t['jam']);
            echo "
            <article>
              <div class='badges-cate'>
                <span style='background:#fff'><a href='".$url->url_sub($t[menu_dari], $t[link])."'>$t[nama_menu]</a></span>
              </div>
              <a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."'>
                <img class='lazy' src='".SITE_URL."foto_statis/base.png' data-src='".SITE_URL_IMG."foto_berita/$t[gambar]' alt='$t[judul]'>
              </a>
              <span style='font-size:10px;display:block;padding:5px 0;'>".$tgl." - ".$jam."</span>
              <a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."' class='captions'>$t[judul]</a>
            </article>"; }
          ?>
          <div class="clearfix"></div>
        </div>
      <div class="clearfix"></div>
      </div>
    </div>
		<div id="daftar-artikel"></div>
		<div id="more" style="display: none;">
			<center><img src="images/loading.gif" width="170px"></center>
		</div>
	</div>

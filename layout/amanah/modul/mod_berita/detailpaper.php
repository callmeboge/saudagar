<?php
$detail=mysql_query("SELECT * FROM berita,users,kategori,menu
            WHERE users.id=berita.username
            AND kategori.id_kategori=berita.id_kategori
            AND kategori.id_kategori=menu.id_menu
            AND judul_seo='$_GET[judul]'");
$d   = mysql_fetch_array($detail);
$tgl = tgl_indo($d['tanggal']);
$jam = trans_jam($d['jam']);

$main_menu = mysql_query("SELECT * FROM menu WHERE id_menu = (SELECT id_parent FROM menu WHERE id_menu = '$d[id_kategori]')");
$menu = mysql_fetch_array($main_menu);

// var_export(array_flip($param));
// echo $d['id_kategori'];
// echo $d['judul'];
?>
<div id="page-content" style="background-color: #fff;margin-bottom:10px;margin-top:130px;" class="index-page container">
  <div class="col-xs-12 col-md-12 col-lg-12" style="background:#fff;">
    <div id="sidebar">
      <div class="user-panel">
        <div class="info">
          <p class="daftar-redaksi"><?php echo "<a href='/'>Home</a>&nbsp;&#8883;&nbsp;<a href=".SITE_URL.'kategori/'.lcfirst($menu['link']).">".$menu['nama_menu']."</a>&nbsp;&#8883;&nbsp;<a href='$d[link]'>$d[nama_kategori]</a>"; ?></p>
          <ul class="block-top" style="width:auto;float:right;">
            <li style="display:inline-block;width:28px;"><a href="https://www.facebook.com/harianamanah/" target="_blank" style='color:#abb3b7;'><i class='fa fa-2x fa-fw fa-facebook-official'></i></a></li>
            <li style="display:inline-block;width:28px;"><a href="https://twitter.com/harianamanah" target="_blank" style='color:#abb3b7;'><i class='fa fa-2x fa-fw fa-twitter-square'></i></a></li>
            <li style="display:inline-block;width:28px;"><a href="https://www.instagram.com/harian_amanah/" target="_blank" style='color:#abb3b7;'><i class='fa fa-2x fa-fw fa-instagram'></i></a></li>
            <li style="display:inline-block;width:28px;"><a href="https://plus.google.com/115045050828571942973" target="_blank" style='color:#abb3b7;'><i class='fa fa-2x fa-fw fa-google-plus-square'></i></a></li>
            <li style="display:inline-block;width:28px;"><a href="https://www.linkedin.com/company/13466134" target="_blank" style='color:#abb3b7;'><i class='fa fa-2x fa-fw fa-linkedin-square'></i></a></li>
            <li style="display:inline-block;width:28px;"><a href="https://www.youtube.com/channel/UCyk4N4qJdhduvO697WQKc1w" target='_blank' style='color:#abb3b7;'><i class='fa fa-2x fa-fw fa-youtube-square'></i></a></li>
          </ul>
        </div>
        <div class="judul">
            <?php echo"<h1 style='color:$menu[color]'>$d[judul]</h1>"; ?>
        </div>
        <div class="sosial" style="float:right;width:200px;">
          <ul class="list-inline" style="text-align:left;margin:0;">
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 2.4;" href="https://www.facebook.com/sharer.php?u=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>" class="btn-facebook" target="_blank" style="padding:10px;"><i class="fa fa-fw fa-facebook"></i></a>
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 2.4;" href="https://twitter.com/intent/tweet?url=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>&text=<?php echo $d['judul']?>&via=harianamanah.com" class="btn-twitter" target="_blank" style="padding:10px;"><i class="fa fa-fw fa-twitter"></i></a>
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 2.4;" href="https://plus.google.com/share?url=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>" class="btn-google" target="_blank" style="padding:10px;"><i class="fa fa-fw fa-google-plus"></i></a>
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 2.4;" href="#facebook-comment" class="btn-facebook" style="padding:10px;background-color:#02b875;"><i class="fa fa-fw fa-commenting-o"></i></a>
            <!-- <a href="https://line.me/R/msg/text/?<?php echo "$d[judul] http://harianamanah.com/berita-$d[judul_seo]"?>" class="social-share line" target="_blank"></a> -->
            <!-- <a href="whatsapp://send?text=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>" class="social-share fa fa-whatsapp" target="_blank"></a> -->
            <!-- <a href="https://telegram.me/share/url?url=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>&text=<?php echo $d['judul']?>" class="social-share fa fa-paper-plane" target="_blank"></a> -->
            <!-- <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script> -->
          </ul>
        </div>
      </div>
      <div class="info">
        <span class="info-name"> <?php echo ucfirst($d['nama_lengkap']);?></span>
        <p class="daftar-redaksi" style="font-size:12px;color:rgba(49, 49, 49, 0.76);"><?php echo"$d[hari], $tgl - $jam"; ?></p>
      </div>
      <hr>
      <div class="dua-atas">
        <div class="single_blog_sidebar wow fadeInUp">
        <?php
        echo '<div class="isi-berita full">';
        $konten = explode('</p>', $d['isi_berita']);
        for($i = 0; $i < count($konten); $i++):
          if($i == 1): 
          ?>
          <p id="iklan-google-p" style="text-align:center;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- B_amanah_paper -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-4290882175389422"
                data-ad-slot="5805154747"
                data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </p>
          <?php  
          elseif($i == count($konten)-1):
          ?>
          <div class="baca-juga-berita terkait">
            <h2 style="color:#00a0a5;font-size:17px;text-transform:uppercase;text-align:left;">Berita Terkait</h2>
            <ul>
              <?php
              $detail1=mysql_query("SELECT * FROM berita WHERE id_kategori = '$d[id_kategori]' AND id_berita != '$d[id_berita]' order by id_berita DESC limit 6");
              while($p1=mysql_fetch_array($detail1))
              {
                $idarray = $p1['id_berita'];
                echo "
                      <li>
                        <a href='berita-$p1[judul_seo]'>$p1[judul]</a>
                      </li>
                    ";}
              ?>
            </ul>
          </div>
          <div class="clearfix"></div>
          <br>
          <?php
          endif;
          echo $konten[$i].'</p>';
        endfor;?>
        <table>
          <tr><td >Laporan</td><td width="25px" align="center">:</td><td><?= ucfirst($d['reporter'])?></td></tr>
          <tr><td >Editor</td><td width="25px" align="center">:</td><td><?= ucfirst($d['nama_lengkap'])?></td></tr>
        </table>
        <div class="sosial">
          <ul class="list-inline" style="text-align:left;;margin:10px 0 20px 0;">
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 1.67;font-size:28px;" href="https://www.facebook.com/sharer.php?u=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>" class="btn-facebook" target="_blank" style="padding:10px;"><i class="fa fa-fw fa-facebook"></i></a>
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 1.67;font-size:28px;" href="https://twitter.com/intent/tweet?url=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>&text=<?php echo $d['judul']?>&via=harianamanah.com" class="btn-twitter" target="_blank" style="padding:10px;"><i class="fa fa-fw fa-twitter"></i></a>
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 1.67;font-size:28px;" href="https://plus.google.com/share?url=<?php echo "http://harianamanah.com/berita-".$d['judul_seo']?>" class="btn-google" target="_blank" style="padding:10px;"><i class="fa fa-fw fa-google-plus"></i></a>
            <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;line-height: 1.67;font-size:28px;" href="#facebook-comment" class="btn-facebook" style="padding:10px;background-color:#02b875;"><i class="fa fa-fw fa-commenting-o"></i></a>
          </ul>
        </div>
        <?php
        echo '</div>';
        echo "<div class='clearfix'></div>";
        mysql_query("UPDATE berita SET dibaca='$d[dibaca]'+1 WHERE judul_seo='$_GET[judul]'");
        ?>
        <div class="tagline">
          <span>TAGS</span>
            <?php
              echo "<a href=".SITE_URL.'kategori/'.lcfirst($menu['link']).">#".$menu['nama_menu']."</a><a href='$d[link]'>#$d[nama_kategori]</a>";
              if($d['tag'] != ''):
                $array = explode(',', $d[tag]);
                foreach($array as $tag):
                  // echo $tag;
                  echo "<a href='".SITE_URL."tag/".seo_title($tag)."'>#".ucwords($tag)."</a>";
                endforeach;
              endif;
            ?>
        </div>
        <div id="facebook-comment" class="fb-comments" data-href="" data-width="100%" data-numposts="10"></div>
        <div class="related-news">
          <div class='kotak' style="width:100%;float:none;">
            <div class="row">
              <h2 style="display:inline-block;width:auto;padding:13px 0;text-align:left;text-transform:uppercase !important;border-bottom:3px solid <?php echo $menu['color']?>; font-weight:bold !important; color:#000;margin:15px;">PAPER</h2>
            </div>
            <ul class="featured_nav0">
            <?php
            $detail1=mysql_query("");
            while($p1=mysql_fetch_array($detail1))
            {
              $tgl = tgl_indo($p1['tanggal']);
              $jam = trans_jam($p1['jam']);

              $idarray = $p1['id_berita'];
              echo "
                <li style='text-align:left;float:none;'>
                    <a class='featured_img berita-terkini'><img class='lazy' src='foto_statis/base_n.png' data-src='".SITE_URL_IMG."foto_small/$p1[gambar]' alt='$p1[judul]'></a>
                    <div class='deskripsi-judul'>
                      <h3 class='featured_title berita-terkini'>
                      <a href='berita-$p1[judul_seo]' style='font-size:20px;text-align:left;padding-left:0;font-weight:bold;'>$p1[judul]</a>
                    </h3>
                      <p class='rubrik-tanggal'><a style='color:#052844;pointer:cursor;' href='kategori-$p1[id_kategori]-$p1[kategori_seo]'>".ucfirst($p1[nama_kategori])."</a> | $p1[hari], $tgl - $jam </p>
                      <p style='margin-left:15px;display:inline-block;'>".substr(strip_tags($p1['isi_berita']), 0, 160)."</p>
                    </div>
                  </li>
                ";} ?>
            </ul>
          </div>
        </div>
          <div class="match_content"> 
            <div class='row'>
              <h6 style="display:inline-block;padding:10px 0px;text-transform:uppercase;font-weight:bold !important;text-align:left;color:#000;border-bottom:3px solid <?php echo $menu['color']?>;margin:15px;">BERITA REKOMENDASI</h6>
            </div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-format="autorelaxed"
                data-ad-client="ca-pub-4290882175389422"
                data-ad-slot="9556530284"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </div>
          
        </div>
        <!-- end of news content -->
      </div>
    </div>
  </div>
</div>
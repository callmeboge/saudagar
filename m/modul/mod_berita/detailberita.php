<?php
  $detail = mysql_query("SELECT * FROM berita, users, menu
                          WHERE users.id=berita.username
                          AND berita.id_kategori=menu.id_menu
                          AND judul_seo='$_GET[judul]'");
  $d   = mysql_fetch_array($detail);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<section class="container-fluid bungkus" id="test" style="margin-bottom:0;">
    <p class="daftar-redaksi" style="margin:10px 0 0;font-size:12px;">
    <?php echo "<a style='color:#035680' href='".SITE_URL."'>Home</a>
    <i class='fa fa-fw fa-chevron-right'></i>
    <a style='color:#035680' href='".$url->url_sub($d[menu_dari])."'>".ucfirst($d[menu_dari])."</a>
    <i class='fa fa-fw fa-chevron-right'></i>
    <a style='color:#035680' href='".$url->url_sub($d[menu_dari], $d[link])."'>$d[nama_menu]</a>"; ?>
    </p>
    <div class="sub-judul">
      <h5 style="margin-top:20px;color:#035680;"><?= $d['sub_judul'] ?></h5>
    </div>
    <h1 class="read_berita" style="margin-top:3px;"><?php echo $d['judul'];?></h1>
    <!-- <span style='display:block'><?php echo ucfirst($d['username'])?></span> -->
    <span class="tanggal-release">Oleh&nbsp;<?php echo ucfirst($d['nama_lengkap'])."&nbsp;pada&nbsp;". $datetime->post_date_format( $d[tanggalwaktu] ) ?></span>
    <?php if( $d[jenis_berita] <> 'foto' && $d[jenis_berita] <> 'video' ): ?>
      <div class="box-header">
        <div class="gambar-berita" style="position:relative;margin:0 0 7px;">
          <!-- <span data-toggle="collapse" data-target="#info-gambarku" id="toggle-info" class="fa fa-info-circle"></span> -->
          <img data-toggle="collapse" data-target="#info-gambarku" class="toggle" src="<?= SITE_URL. "img_berita/50px/saudagar.jpg"?>">
          <img class="post-img lazy" data-src='<?= $url->url_article_img($d['gambar'], 700) ?>' class='img-responsive' alt='<?php echo $d['judul']?>'>
        </div>
      </div>
    <?php elseif ( $d[jenis_berita] == 'video' ):?>
      <div class="box-header">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ygTknt6qF6Q" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>

    <?php endif;?>
    
    <div class="social-optimize" style='margin-top:10px;text-align:center;display:table;border-spacing:5px;width:100%;'>
      <a href="https://www.facebook.com/sharer.php?u=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>" class="social-share big fa fa-facebook" target="_blank"></a>
      <a href="https://twitter.com/intent/tweet?url=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>&text=<?= $d['judul']?>&via=harianamanah.com" class="social-share big fa fa-twitter" target="_blank"></a>
      <a href="https://plus.google.com/share?url=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>" class="social-share big fa fa-google-plus" target="_blank"></a>
      <a href="https://line.me/R/msg/text/?<?= SITE_URL."berita-$d[judul_seo]"?>" class="social-share big line" target="_blank"></a>
      <a href="whatsapp://send?text=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>" class="social-share big fa fa-whatsapp" target="_blank"></a>
      <a href="https://telegram.me/share/url?url=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>&text=<?= $d['judul']?>" class="social-share big fa fa-paper-plane" target="_blank"></a>
      <a href="#facebook-comment" class="social-share big fa fa-commenting-o"></a>
    </div> 
    <div class="box left">
      <div class="berita" style="font-size:16px;">
      <?php
      $konten = explode('</p>', $d['isi_berita']);
      for($i = 0; $i < count($konten); $i++):
        if($i == 2): ?>
          <p style="text-align:center;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- B_Center Ads -->
            <ins class="adsbygoogle"
                style="display:inline-block;width:300px;height:250px"
                data-ad-client="ca-pub-4290882175389422"
                data-ad-slot="1158479752"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </p>
      <?php
        endif;
        echo $konten[$i]."</p>";
      endfor;
      mysql_query("UPDATE berita SET dibaca=$d[dibaca]+1 WHERE judul_seo='$_GET[judul]'");
      ?>
      </div>
      <div class="baca-juga-berita terkait">
            <b style="display:inline-block;margin-bottom:10px;border-bottom:1px solid #333;">KAIT</b>
            <ul>
                <?php
                $detail1=mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND id_berita != '$d[id_berita]' order by id_berita DESC limit 5");
                while($p1=mysql_fetch_array($detail1)){
                echo"
                  <li>
                    <a href='".$url->url_baca($p1['menu_dari'], $p1['id_berita'], $p1['judul_seo'])."' title='artikel-lain'>$p1[judul]</a>
                  </li>";
                }?>
            </ul>
        </div>
      <hr>
      <table>
        <tr><td colspan="1">Laporan</td><td width="25px" align="center">:</td><td><?= ucfirst($d['reporter'])?></td></tr>
        <tr><td colspan="1">Editor</td><td width="25px" align="center">:</td><td><?= ucfirst($d['nama_lengkap'])?></td></tr>
      </table>
      <br>
      <h5>TAG</h5>
      <div class="tagline">
        <?php
            echo "<a href='".$url->url_sub($d[menu_dari])."'>".ucfirst($d[menu_dari])."</a>
                  <a href='".$url->url_sub($d[menu_dari], $d[link])."'>$d[nama_menu]</a>";
            if($d[tag] != ''):
              $array = explode(',', $d[tag]);
                foreach($array as $tag):
                  // echo $tag;
                echo "<a  href='".$url->url_tag(seo_title($tag))."'>".ucwords($tag)."</a>";
              endforeach;
            endif;
          ?>
      </div>
    </div>
  </div>
</div>
<div class="social-optimize" style='margin-top:10px;text-align:center;display:table;border-spacing:5px;width:100%;'>
  <a href="https://www.facebook.com/sharer.php?u=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>" class="social-share big fa fa-facebook" target="_blank"></a>
  <a href="https://twitter.com/intent/tweet?url=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>&text=<?= $d['judul']?>&via=harianamanah.com" class="social-share big fa fa-twitter" target="_blank"></a>
  <a href="https://plus.google.com/share?url=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>" class="social-share big fa fa-google-plus" target="_blank"></a>
  <a href="https://line.me/R/msg/text/?<?= SITE_URL."berita-$d[judul_seo]"?>" class="social-share big line" target="_blank"></a>
  <a href="whatsapp://send?text=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>" class="social-share big fa fa-whatsapp" target="_blank"></a>
  <a href="https://telegram.me/share/url?url=<?= SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE) ?>&text=<?= $d['judul']?>" class="social-share big fa fa-paper-plane" target="_blank"></a>
  <a href="#facebook-comment" class="social-share big fa fa-commenting-o"></a>
</div> 

</section>
<div class="match_content">
  <img src="<?= SITE_URL."foto_banner/saudagar.jpg"?>" width="100%">
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
<section id='facebook-comment' class="container-fluid bungkus" style="background: transparent;text-align:center;">
  <br>
  <i class="fa fa-5x fa-comments-o" style="display:block;color:#31708f;"></i>
  <br>
  <div class="fb-comments" data-href="" data-width="686" data-numposts="5"></div>
</section>
<!-- <section class="container-fluid bungkus nav-nex-pre" style='margin:0;border-bottom:1px solid #e0e0e0;'>
  <?php
  // echo $d['id_kategori'];
    $link_berita_prev = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND id_berita < $d[id_berita] AND id_kategori = '$d[id_kategori]' ORDER BY id_berita DESC LIMIT 1");
    while($row_p=mysql_fetch_array($link_berita_prev)){
      echo "<a class='berita-next' href='".$url->url_baca($row_p[menu_dari], $row_p[id_berita], $row_p[judul_seo])."'>$row_p[judul]<span>Balik</span></a>";
    }
    $link_berita_next = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND id_berita > $d[id_berita] AND id_kategori = '$d[id_kategori]' LIMIT 1");
    while($row_n=mysql_fetch_array($link_berita_next)){
      echo "<a class='berita-prev' href='".$url->url_baca($row_n[menu_dari], $row_n[id_berita], $row_n[judul_seo])."'>$row_n[judul]<span>Lanjut</span></a>";
    }
  ?>
</section> -->
<section>
<div style="text-align:center;"> 
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- M_Banner -->
  <ins class="adsbygoogle"
      style="display:inline-block;width:320px;height:50px"
      data-ad-client="ca-pub-4290882175389422"
      data-ad-slot="6679890438"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</div>
</section>
<img src="<?= SITE_URL.'foto_banner/bosowa.jpg'; ?>" width="100%">
<section class="container-fluid bungkus">
  <section class="container-fluid bungkus" style="padding:0;">
    <div class="baca-juga">
      <div class="garis-bawah">
      <h3>KINI</h3>
      </div>
        <ul class="list-berita-terkini" style="list-style-type: none;">
            <?php
            $detail1=mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND link='$d[link]' ORDER BY id_berita DESC LIMIT 7");
            $x=1;
            while($p1=mysql_fetch_array($detail1)){
            if($x == 6):
            ?>
              <div class="clearfix"></div>
              <h5 data-style='middle-line' data-id='rekomendasi' style='position:relative;' >BERITA REKOMENDASI</h5>
              <section style="white-space:nowrap;overflow:auto;">
                <?php
                  $topik = mysql_query("SELECT judul, judul_seo, gambar, menu_dari, id_berita FROM berita, menu WHERE id_kategori = id_menu AND berita.aktif = 'Y' AND nama_menu = '$d[nama_menu]' ORDER BY id_berita DESC LIMIT 7");
                  while($tp = mysql_fetch_array($topik))
                  {
                    echo "<article class= 'artikle' style='border:0;width:200px;display:inline-block;padding-right:15px;white-space:normal;vertical-align:top;'>
                    <div class='list-picture post-rekomendasi'>
                    <a href='".$url->url_baca($tp[menu_dari], $tp[id_berita], $tp[judul_seo])."' style='width:100%;'>
                    <img class='picture lazy' data-src='".$url->url_article_img($tp[gambar])."' alt='$tp[judul]'>
                    </a>
                    </div>
                    <div class='artikle-text' data-target='update' style='padding:0;margin-top:10px;width:100% !important'>
                    <a href='".$url->url_baca($tp[menu_dari], $tp[id_berita], $tp[judul_seo])."' class='berita' title='$tp[judul]' style='font-size:14px;width:100% !important'>$tp[judul]</a>
                    <br>
                    </div>
                    </article>";
                  }
                  ?>
              </section>
              <h5 data-style='middle-line' data-id='popular' style='position:relative;' >BERITA POPULAR</h5>
              <section style="white-space:nowrap;overflow:auto;">
                <?php
                  $date = date('Y-m-d H:i:s');
                  $topik = mysql_query("SELECT * FROM berita, menu WHERE tanggalwaktu BETWEEN date_sub('$date', INTERVAL 30 DAY) AND '$date' AND id_kategori = id_menu AND nama_menu = '$d[nama_menu]' ORDER BY dibaca DESC LIMIT 7");
                  while ($tp = mysql_fetch_array($topik))
                  {
                  echo "<article class= 'artikle' style='border:0;width:200px;display:inline-block;padding-right:15px;white-space:normal;vertical-align:top;'>
                          <div class='list-picture post-popular'>
                            <a href='".$url->url_baca($tp[menu_dari], $tp[id_berita], $tp[judul_seo])."' style='width:100%;'>
                              <img class='picture lazy'  data-src='".$url->url_article_img($tp[gambar])."' alt='$tp[judul]' >
                            </a>
                          </div>
                          <div class='artikle-text' data-target='update' kode='$tp[id_berita]' style='padding:0;margin-top:10px;width:100% !important'>
                            <a href='".$url->url_baca($tp[menu_dari], $tp[id_berita], $tp[judul_seo])."' class='berita' title='$tp[judul]' style='font-size:14px;width:100% !important'>$tp[judul]</a>
                            <br>
                          </div>
                        </article>";
                  }
                ?>
              </section>
            <?php
            elseif($x == 7): 
            ?>
                <div style="text-align:center;">
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- B_Center Ads -->
                  <ins class="adsbygoogle"
                      style="display:inline-block;width:300px;height:250px"
                      data-ad-client="ca-pub-4290882175389422"
                      data-ad-slot="1158479752"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
                </div>
            <?php 
            else:
              echo"
              <li>
                <img class='lazy' data-src='".$url->url_article_img($p1[gambar], 180)."' width='120' height='75' alt='$p1[judul]'>
                <a href='".$url->url_baca($p1['menu_dari'], $p1['id_berita'], $p1['judul_seo'])."' title='$p1[judul]' style='padding:0;'>
                  <div class='caption'>$p1[judul]</div>
                </a>
              </li>";
            endif;
            $x++;
            }?>

          <div class="clearfix"></div>
          <!-- img ads -->
        <!-- end img -->
        </ul>
    </div>
  </section>
</section>
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
<img src="<?= SITE_URL."foto_banner/pegadaian.jpg"?>" width="100%">

<script>
     var loadMore = true;
      var page = 1;
      $(window).scroll(function(){
        if(($(window).scrollTop() >= $(document).height()-$(window).height()) && loadMore)
        {
          loadMore = false;
          if (page <= 5)
          {
            $.ajax({
              url: '<?= SITE_URL?>loadArticle.php',
              data: {
                id: $('.judul').last().data('id')
              },
              dataType: "json",
              method: 'GET',
              beforeSend: function(){
                
              },
              success: function(result)
              {
                if(result){
                  // alert(result[0]+result[1]+result[2);
                  // console.log(result[0]);
                  $('.other_load').last().before('<hr>');
                  $('.other_load').last().append(function() {
                    $(this).load('<?= SITE_URL?>'+ result[0] +'/baca/'+ result[1] +'/'+ result[2] +' #sidebar');
                    $('.lazy').lazy();
                  });

                  $('.other_load').last().after('<div class=\'other_load\'></div>');

                  // // $('.other_load').append(result);
                  loadMore = true;
                }
              }
            });
          }
          page++;
        }
      });
 
  </script>
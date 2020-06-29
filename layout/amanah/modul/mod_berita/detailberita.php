<?php
$detail=mysql_query("SELECT * FROM berita,users,menu
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

<div id="page-content" style="margin-bottom:10px;" class="index-page container">
  <div id='load_other' class="col-xs-12 col-md-12 col-lg-8">
    <div id="sidebar" style="padding:0;">
      <div class="user-panel">
        <div class="info">
          <p class="daftar-redaksi">
          <?php echo "<a href='/'>Home</a>
          <i class='fa fa-fw fa-chevron-right'></i>
          <a href='".$url->url_sub($d[menu_dari])."'>".ucfirst($d['menu_dari'])."</a>
          <i class='fa fa-fw fa-chevron-right'></i>
          <a href='".$url->url_sub($d[menu_dari], $d[link])."'>$d[nama_menu]</a>";?>
          </p>
        </div>
        <div class="sub-judul">
          <h6 style="margin-top:20px;color:#035680;"><?= $d['sub_judul'] ?></h6>
        </div>
        <div data-menu-dari='<?= $d[menu_dari]?>' data-nama-menu = '<?= $d[link]?>' data-judul-slug='<?= $d[judul_seo]?>' data-id='<?= $d[id_berita]?>' class="judul">
            <?php echo"<h1>$d[judul]</h1>"; ?>
        </div>
        <div class="sosial" style="float:right;width:200px;margin-top:5px;">
          <ul class="list-inline" style="text-align:left;margin:0;">
            <a style="border-radius: 100%;width: 42px;font-size:20px;height: 42px;text-align: center;display: inline-block;" href="https://www.facebook.com/sharer.php?u=<?php echo SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE)?>" class="btn-facebook" target="_blank" style="padding:10px;"><i style='line-height:2;' class="fa fa-fw fa-facebook"></i></a>
            <a style="border-radius: 100%;width: 42px;font-size:20px;height: 42px;text-align: center;display: inline-block;" href="https://twitter.com/intent/tweet?url=<?php echo SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE)?>&text=<?php echo $d['judul']?>&via=harianamanah.com" class="btn-twitter" target="_blank" style="padding:10px;"><i style='line-height:2;' class="fa fa-fw fa-twitter"></i></a>
            <a style="border-radius: 100%;width: 42px;font-size:20px;height: 42px;text-align: center;display: inline-block;" href="https://plus.google.com/share?url=<?php echo SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE)?>" class="btn-google" target="_blank" style="padding:10px;"><i style='line-height:2;' class="fa fa-fw fa-google-plus"></i></a>
            <a style="border-radius: 100%;width: 42px;font-size:20px;height: 42px;text-align: center;display: inline-block;" href="#facebook-comment" class="btn-facebook" style="padding:10px;background-color:#02b875;"><i style='line-height:2;' class="fa fa-fw fa-commenting-o"></i></a>
            <!-- <a href="https://line.me/R/msg/text/?<?php echo "$d[judul] ".SITE_URL_IMG."berita-$d[judul_seo]"?>" class="social-share line" target="_blank"></a> -->
            <!-- <a href="whatsapp://send?text=<?php echo SITE_URL_IMG."berita-".$d['judul_seo']?>" class="social-share fa fa-whatsapp" target="_blank"></a> -->
            <!-- <a href="https://telegram.me/share/url?url=<?php echo SITE_URL_IMG."berita-".$d['judul_seo']?>&text=<?php echo $d['judul']?>" class="social-share fa fa-paper-plane" target="_blank"></a> -->
            <!-- <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script> -->
          </ul>
        </div>
      </div>
      <img src='<?= ($d[foto] ?  $url->url_user_image($d[foto]) : SITE_URL."img_berita/50px/saudagar.jpg") ?>' style="width:50px;height:50px;margin-right:10px;border-radius:100%;float:left;object-fit:cover;">
      <div class="info" style="float:left;margin-top:5px;">
        <span class="info-name"> <?php echo ucfirst($d['nama_lengkap']);?></span>
        <p class="daftar-redaksi" style="font-size:12px;color:rgba(49, 49, 49, 0.76);"><?= $datetime->post_date_format( $d[tanggalwaktu] ); ?></p>
      </div>
      <div class="clearfix">
      </div>
      <hr>
      <div class="dua-atas">
        <div class="single_blog_sidebar wow fadeInUp main_post">
        <?php
        if($d[jenis_berita] <> 'foto' && $d[jenis_berita] <> 'video'):
          echo "<img class='main-pic lazy' data-src='".$url->url_article_img($d[gambar], 700)."' alt='$d[judul]'>";
          echo "<p class='caption-pic'>$d[keterangan_gambar]</p>";
          echo "<hr>";
        elseif($d[jenis_berita] == 'video'): 
          echo "<div class='box-header'><iframe width='560' height='315' src='https://www.youtube.com/embed/ygTknt6qF6Q' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe></div>";
        endif; 
        ?>

        <!-- <div id="ads_news" class='hidden-xs hidden-sm hidden-md' style='width:160px;'>
          <img src='<?= SITE_URL."foto_Iklan_isiberita/ems web.png"?>'> 
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                style="display:inline-block;width:160px;height:600px"
                data-ad-client="ca-pub-4290882175389422"
                data-ad-slot="4658060817"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div> -->
        <?php echo '<div class="isi-berita">';
        
        $konten = explode('</p>', $d['isi_berita']);
        for($i = 0; $i < count($konten); $i++):
          if($i == count($konten)-1):com
          ?>
          <hr>
          <div class="baca-juga-berita terkait">
            <h6 style="color:#035680">TERKAIT</h6>
            <ul>
              <?php
              $detail1=mysql_query("SELECT * FROM berita WHERE id_kategori = '$d[id_kategori]' AND id_berita != '$d[id_berita]' order by id_berita DESC limit 5");
              while($p1=mysql_fetch_array($detail1))
              {
                $idarray = $p1['id_berita'];
                echo "
                  <li>
                    <a href='".$url->url_baca($d['menu_dari'], $p1['id_berita'], $p1['judul_seo'])."'>$p1[judul]</a>
                  </li>
                ";}
              ?>
            </ul>
          </div>
          <br>
          <?php
          endif;
          echo $konten[$i].'</p>';
        endfor;
        ?>
        <table>
          <tr><td colspan="1">Laporan</td><td width="25px" align="center">:</td><td><?= ucfirst($d['reporter'])?></td></tr>
          <tr><td colspan="1">Editor</td><td width="25px" align="center">:</td><td><?= ucfirst($d['nama_lengkap'])?></td></tr>
        </table>
       
        <?php
        echo '</div>';
        mysql_query("UPDATE berita SET dibaca='$d[dibaca]'+1 WHERE judul_seo='$_GET[judul]'");
        ?>
        
        <div class="col-xs-12" style="padding:0;margin-top:40px;">
          <div class="col-xs-8 tagline" style="padding:0;">
            <span>TAG</span>
            <?php
                echo "<a href=".$url->url_sub($d['menu_dari']).">".ucfirst($d[menu_dari])."</a>
                      <a href='".$url->url_sub($d[menu_dari], $d[link])."'>$d[nama_menu]</a>";
                if($d['tag'] != ''):
                  $array = explode(',', $d[tag]);
                  foreach($array as $tag):
                    echo "<a href='".$url->url_tag($tag)."'>".ucwords($tag)."</a>";
                  endforeach;
                endif;
                ?>
          </div>
          <div class="col-xs-4 sosial">
            <span>BAGI</span>
            <ul class="list-inline" style="text-align:left;margin:0 0 20px 0;">
              <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;font-size:28px;" href="https://www.facebook.com/sharer.php?u=<?php echo SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE)?>" class="btn-facebook" target="_blank" style="padding:10px;"><i style='line-height:1.5;' class="fa fa-fw fa-facebook"></i></a>
              <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;font-size:28px;" href="https://twitter.com/intent/tweet?url=<?php echo SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE)?>&text=<?php echo $d['judul']?>&via=harianamanah.com" class="btn-twitter" target="_blank" style="padding:10px;"><i style='line-height:1.5;' class="fa fa-fw fa-twitter"></i></a>
              <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;font-size:28px;" href="https://plus.google.com/share?url=<?php echo SITE_URL.$url->url_baca($d[menu_dari], $d[id_berita], $d[judul_seo], FALSE)?>" class="btn-google" target="_blank" style="padding:10px;"><i style='line-height:1.5;' class="fa fa-fw fa-google-plus"></i></a>
              <a style="border-radius: 100%;width: 42px;height: 42px;text-align: center;display: inline-block;font-size:28px;" href="#facebook-comment" class="btn-facebook" style="padding:10px;background-color:#02b875;"><i style='line-height:1.5;' class="fa fa-fw fa-commenting-o"></i></a>
            </ul>
          </div>
        </div>
        <img src="<?= SITE_URL."foto_banner/saudagar.jpg"?>" alt="">
        <div class="match_content"> 
            <h6 style="display:inline-block; padding:10px 0px; text-transform:uppercase; font-weight:bold !important; text-align:left; color:#000;margin-left:15px; margin-left:0;">REKOMENDASI</h6>
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
          <div id="facebook-comment" class="fb-comments" data-href="" data-width="100%" data-numposts="10"></div>
        </div>
        <!-- end of news content -->
        <div style="margin-top:10px;text-align:center;">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- W_Banner Top Ads -->
          <ins class="adsbygoogle"
              style="display:inline-block;width:640px;height:95px"
              data-ad-client="ca-pub-4290882175389422"
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div>
        <div class="related-news">
          <div class='kotak' style="width:100%;float:none;">
            <div class="row">
              <h6 style="display:inline-block;width:auto;padding:13px 0;text-align:left;text-transform:uppercase !important; font-weight:bold !important; color:#000;margin:0 0 0 15px;">KINI</h6>
            </div>
            <ul class="featured_nav0" style="margin-bottom:50px;">
            <?php
            $detail1=mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND id_berita != '$d[id_berita]' ORDER BY id_berita DESC LIMIT 6");
            while($p1=mysql_fetch_array($detail1))
            {
              $idarray = $p1['id_berita'];
              echo "
                <li class='col-xs-4 berita-kini'>
                    <a class='featured_img berita-terkini'><img class='lazy' data-src='".$url->url_article_img($p1[gambar], 300)."' alt='$p1[judul]'></a>
                    <div class='deskripsi-judul'>
                      <h3 class='featured_title berita-terkini'>
                      <a href='".$url->url_baca($d[menu_dari], $p1[id_berita], $p1[judul_seo])."' style='font-size:14px;text-align:left;padding-left:0;line-height:1.5;font-weight:bold;'>$p1[judul]</a>
                    </h3>
                       <!--<p class='rubrik-tanggal'><a style='color:#052844;pointer:cursor;' href='".$url->url_sub($p1[menu_dari], $p1[link])."'>".ucfirst($p1[nama_menu])."</a> | $p1[hari], $tgl - $jam </p>-->
                    </div>
                  </li>
                ";} ?>
            </ul>
       
          </div>
        </div>
      </div>
    </div>
   
    <div class='other_load'> </div>

  </div>

<!-- <div class="clearfix"></div> -->
<div class="hidden-xs col-lg-4" style="padding-left:35px;float:left;">
      <div id="scroll-fixed">
        <div class="single_blog_sidebar wow fadeInUp">
          <ul class="featured_nav0 read-news">
          <!-- id="fixed-baca" data-spy="affix" -->
          <li>
            <h1 class="title berita-foto" style="color:#333;font-weight:bold;font-size:20px;text-align:left;margin-top:0;">TOPIK</h1>
          </li>
           <li>
              <h1 class="title berita-foto" style="color:#333;font-weight:bold;font-size:20px;text-align:left;margin-top:0;">POPULAR</h1>
              <div class="single_blog_sidebar wow fadeInUp popular-rubrik" style="background-color:#fff;margin-bottom:10px;">
                <ol class="list-berita-popular-rubrik">
                <?php
                $date = date('Y-m-d H:i:s');
                $berita_popular = mysql_query("SELECT * FROM berita WHERE tanggalwaktu BETWEEN date_sub('$date', INTERVAL 30 DAY) AND '$date' AND id_kategori = '$d[id_kategori]' ORDER BY dibaca DESC LIMIT 5");
                $x=1;
                while($row = mysql_fetch_array($berita_popular)){
                if ($x == 1):
                  echo "
                    <img class='lazy' data-src='".$url->url_article_img($row[gambar], 300)."' alt='$row[judul]' >
                    <li>
                      <a href='".$url->url_baca($d[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'>$row[judul]</a>
                      <div class='clearfix'></div>
                    </li>";
                else:
                  echo "
                    <li>
                      <a href='".$url->url_baca($d[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'>$row[judul]</a>
                      <div class='clearfix'></div>
                    </li>";
                endif;
                $x++;  
                }?>
                </ol>
              </div>
            </li>
            <li class="email-subs">
              <div class="panel panel-default">
                <div class="panel-heading" style="padding-top:20px;">
                  <svg style="width:52px;height:52px;display:block;margin:auto;stroke:#fff;" viewBox="0 0 24 24">
                    <path fill="#333" d="M12,15.36L4,10.36V18H20V10.36L12,15.36M4,8L12,13L20,8V8L12,3L4,8V8M22,8V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V8C2,7.27 2.39,6.64 2.97,6.29L12,0.64L21.03,6.29C21.61,6.64 22,7.27 22,8Z" />
                  </svg>

                  <span class="caption-text">Dapat berita terbaru dari kami</span>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Alamat Email">
                    <div class="input-group-btn">
                      <button class="btn btn-default">
                        <i class="fa fa-paper-plane"></i>
                      </button>
                    </div>
                  </div>
                  <span class="caption-desc">contoh: example@email.com</span>
                </div>
                <div class="panel-body">
                  <span><b>Ikuti kami di social</b></span>
                  <a href="https://www.facebook.com/saudagar/" target="_blank" style="color:#3b5999">
                    <i class="fa fa-fw fa-facebook-official"></i>
                  </a>
                  <a href="https://twitter.com/saudagar" target="_blank" style="color:#55acee">
                    <i class="fa fa-fw fa-twitter-square"></i>
                  </a>
                  <a href="https://www.instagram.com/saudagar/" target="_blank" style="color:#e4405f">
                    <i class="fa fa-fw fa-instagram"></i>
                  </a>
                  <a href="https://www.linkedin.com/company/13466134" target="_blank" style="color:#0077B5">
                    <i class="fa fa-fw fa-linkedin-square"></i>
                  </a>
                </div>
              </div>
            </li>
            <li>
                <!-- img ads -->
                <img src="<?= SITE_URL."foto_banner/pegadaian.jpg"?>" alt="">
            <!-- end img -->
            </li>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- W_Right Banner Ads -->
            <ins class="adsbygoogle"
                style="display:inline-block;width:270px;height:350px"
                data-ad-client="ca-pub-4290882175389422"
                data-ad-slot="1385019502"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div style="text-align:center;">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Banner Bottom -->
      <ins class="adsbygoogle"
          style="display:inline-block;width:728px;height:90px"
          data-ad-client="ca-pub-4290882175389422"
          data-ad-slot="4948221961"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    <!-- End Banner Bottom -->
  </div>
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
                    $('.lazy').lazy();
                    $(this).load('<?= SITE_URL?>'+ result[0] +'/baca/'+ result[1] +'/'+ result[2] +' #sidebar');
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
  <!-- <div class="clearfix"></div> -->
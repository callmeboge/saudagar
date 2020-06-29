  <div class="featured container" style="top:35px;" >
      <div class="row">
      <!-- <a href="lombamewarnaiislami" style="margin-bottom:10px;display:block;">
        <img src="img_lomba/Proposal Lomba Mewarnai.jpg" alt="Lomba Mewarnai Islami - harianamanah.com" style="width:100%;">
      </a> -->
        <div class="col-xs-12 col-lg-8">
            <!-- Carousel -->
            <div id="carousel-example-generic" class="carousel slide carousel-fade hl-slider" data-ride="carousel" style="height:auto;">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role='listbox'>
              <?php
              $terkini=mysql_query("SELECT * FROM berita, menu WHERE headline='Y' AND berita.id_kategori = menu.id_menu ORDER BY id_berita DESC LIMIT 4");
              while($t=mysql_fetch_array($terkini)){
                echo"
                  <div class='item'>
                    <div class='col-xs-12' style='float:none;padding-bottom:8px;padding-left:0;'>
                      <div style='position:relative;'>
                        <a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."'>
                          <img class='lazy' data-src='".$url->url_article_img($t[gambar], 700)."' alt='$t[judul]' style='display:inline-block;vertical-align:top;'>
                        </a>
                      </div>
                      <div class='header-text'>
                      <div class='desc-home' style='display:inline-block;bottom:15px;right:15px;padding:15px 15px 15px 0;'>
                          <a href='".$url->url_sub($t[menu_dari], $t[link])."' style='font-size:12px;color:#035680;padding:0 5px;display:inline-block;font-weight:500;'>".strtoupper($t['nama_menu'])."</a>
                          <div class='tanggal-news' style='display:inline-block;font-size:12px;margin-left:15px;color:#666;'>". $datetime->time_ago($t[tanggalwaktu]) ."</div>
                          <h1 id='title' style='font-size:27px;margin-top:10px;'><a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."'>$t[judul]</a></h1>
                          <p style='font-size:12px;color:#666;line-height:1.5;word-wrap:break-word;margin:0;'>$t[deskripsi]</p>
                      </div>
                      <br>
                      </div>
                    </div>
                    <!-- Static Header -->
                   <!-- <div class='slider-berita-terkait'>
                      <ul style='line-height:20px;margin-bottom:15px;list-style:disc;margin-left:15px;'>";
                        $terkait=mysql_query("SELECT * FROM berita, menu WHERE id_kategori = '$t[id_kategori]' AND menu.id_menu = berita.id_kategori ORDER BY id_berita DESC LIMIT 3");
                        while($u=mysql_fetch_array($terkait)){
                          echo "<li><a href='".$url->url_baca($u[menu_dari], $u[id_berita], $u[judul_seo])."' style='font-size:16px;color:#333;'>$u[judul]</a></li>";
                        };
                  echo "</ul></div> --></div>";
                } ?>
              </div>
              <div class='col-xs-12' style='float:none;padding-left:0;'>
                <script>
                  function open_link (obj){
                  window.open(obj.getAttribute("href"), '_self');
                  return false;
                  }
                </script>
                <ol class='carousel-indicators' style='position:relative;'>
                  <?php
                    $terkini=mysql_query("SELECT * FROM berita, menu WHERE headline='Y' AND menu.id_menu = berita.id_kategori ORDER BY id_berita DESC LIMIT 3");
                    $i = 0;
                    while($indicator = mysql_fetch_array($terkini)){
                      echo "<li data-target='#carousel-example-generic' data-slide-to='$i'>
                        <img class='lazy' data-src='".$url->url_article_img($indicator[gambar])."' alt='$indicator[judul]'>
                        <a href='".$url->url_baca($indicator[menu_dari], $indicator[id_berita], $indicator[judul_seo])."' onclick='open_link(this); return false;' style=margin:0;padding:7px;font-size:13px;color:#333;display:inline-block;line-height:1.5;font-weight:bold;'>$indicator[judul]</a>
                      </li>";
                    $i++;
                    }
                  ?>
                </ol>
              </div>
            </div><!-- /carousel -->
          <div class="col-xs-12" style="margin-top:7px;padding:0;text-align:center;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- W_Banner Bottom -->
            <ins class="adsbygoogle"
                style="display:inline-block;width:728px;height:90px"
                data-ad-client="ca-pub-4290882175389422"
                data-ad-slot="4948221961"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          </div>
          <img src="<?= SITE_URL."foto_banner/saudagar.jpg"?>" alt="">
          <div class="col-xs-12" style="margin-top:7px;padding:0;">
              <div class="single_blog_sidebar1 berita-terkini wow fadeInUp">
                <ul id="list-terkini-middle">
                <?php
                  $x=1;
                  $detail1=mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND jenis_berita <> 'foto' ORDER BY id_berita DESC LIMIT 16");
                  while($p1=mysql_fetch_array($detail1))
                  {
                    if($x%5 == 0):
                      if($state):
                        $add_q = "AND id_berita < '$test'";
                      else:
                        $add_q = '';
                      endif;
                      $inilah = mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND jenis_berita = 'foto' $add_q ORDER BY id_berita DESC LIMIT 1");
                    
                      while($foto=mysql_fetch_array($inilah)):
                        echo "<li data-berita-foto='$foto[id_berita]'>
                        <a href='".$url->url_baca($p1[menu_dari], $foto[id_berita], $foto[judul_seo])."'>
                          <img class='lazy' data-src='".$url->url_article_img($foto[gambar], 700)."' alt='$foto[judul]' style='object-fit:cover;width:100%;'>
                        </a>
                        <div class='deskripsi-judul home reda' style='margin-top:15px;'>
                          <p class='rubrik-tanggal'><a href='".$url->url_sub($foto[menu_dari], $foto[link])."'>".strtoupper($foto['nama_menu'])."</a>&nbsp;". $datetime->time_ago( $foto[tanggalwaktu] ) ."</p>
                          <h6 ><a style='font-size:26px;line-height:1.3;' href='".$url->url_baca($p1[menu_dari], $foto[id_berita], $foto[judul_seo])."' title='$foto[judul]'>$foto[judul]</a></h6>
                        </div>
                      </li>";
                      $state = true;
                      $test = $foto['id_berita'];
                      endwhile;

                    elseif($x == 16):
                      echo "<img src=\"".SITE_URL.'foto_banner/bosowa.jpg'."\" >";

                    elseif($x == 14):
                      echo "<li><ul class='featured_nav0 berita-lainnya' style='border-bottom:1px solid #ececec;'>
                            <h6 style='font-weight:700;'>REKOMENDASI</h6>";
                            $detail2=mysql_query("SELECT * FROM berita, menu WHERE id_kategori = id_menu AND jenis_berita <> 'foto' AND utama='Y' order by id_berita DESC limit 6");
                            while($p2=mysql_fetch_array($detail2))
                            {
                              echo"
                                    <li >
                                      <a class='featured_img' href='".$url->url_baca($p2[menu_dari], $p2[id_berita], $p2[judul_seo])."'><img class='lazy' data-src='".$url->url_article_img($p2[gambar], 300)."' alt='$p2[judul]'>
                                      </a>
                                      <div class='featured_title berita-lainnya' style='font-size:14px;'>
                                        <a href='".$url->url_baca($p2[menu_dari], $p2[id_berita], $p2[judul_seo])."' style='margin-top:0;padding-top:5px;text-align:left;width:auto;font-weight:bold;line-height:1.5;'>$p2[judul]</a>
                                      </div>
                                    </li>
                                  ";
                            }
                      echo "<div class='clearfix'></div></ul></li>";
                    endif;

                      echo "<li data-berita='$p1[id_berita]'>
                      <a href='".$url->url_baca($p1[menu_dari], $p1[id_berita], $p1[judul_seo])."'>
                      <img class='lazy' data-src='".$url->url_article_img($p1[gambar])."' alt='$p1[judul]'>
                      </a>
                      <div class='deskripsi-judul home'>
                        <p style='margin-left:7px;' class='rubrik-tanggal'><a href='".$url->url_sub($p1[menu_dari], $p1[link])."'>".strtoupper($p1['nama_menu'])."</a>&nbsp;". $datetime->time_ago( $p1[tanggalwaktu] ) ."</p>
                        <h6><a href='".$url->url_baca($p1[menu_dari], $p1[id_berita], $p1[judul_seo])."' title='$p1[judul]'>$p1[judul]</a></h6>
                        <p class='deskripsi-data'> $p1[deskripsi]</p>
                      </div>
                    </li>";
                    $x++;
                  } ?>
                </ul>
                <div id="more_animasi" style="text-align:center;margin-top:10px;">
                  
                </div>
              </div>
              <div class="row">
                <div id="iklan-footer" style="padding-bottom:10px;margin-top:10px;">
                  <div class="iklan">
                    <!-- <img src="foto_pasangiklan/adhomebanner.jpg" width="96%"> -->
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- W_Home_Bottom_Banner -->
                    <ins class="adsbygoogle"
                        style="display:inline-block;width:782px;height:200px"
                        data-ad-client="ca-pub-4290882175389422"
                        data-ad-slot="3687949871"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- break -->
        <div class="col-xs-12 col-lg-4 hidden-sm hidden-md" style="padding-left:30px">
        
          <div class="single_blog_sidebar berita-popular wow fadeInUp">
            <h1 style="font-weight:900;font-size:20px;">BERITA POPULAR</h1>
            <ol class="list-berita-popular">
            <?php
            $date = date('Y-m-d H:i:s');
            $berita_popular = mysql_query("SELECT judul,judul_seo, nama_menu, link, menu_dari, id_berita, gambar FROM berita, menu WHERE id_menu = id_kategori AND tanggalwaktu BETWEEN date_sub('$date', INTERVAL 7 DAY) AND '$date' ORDER BY dibaca DESC LIMIT 10");
            $x=1;
            while($row = mysql_fetch_array($berita_popular)){
              if($x == 1){
                echo "<img class='lazy' data-src='".$url->url_article_img($row[gambar], 300)."' alt='$row[judul]' style='height:auto;'><li>
                <a href='".$url->url_sub($row[menu_dari], $row[link])."' style='float:right;width:calc(100% - 65px);text-transform:uppercase;color:#035680;font-size:11px;margin-bottom:5px;'>$row[nama_menu]</a>
                <a style='float:right;width:calc(100% - 65px)' href='".$url->url_baca($row[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'>$row[judul]</a><div class='clearfix'></div></li>";
              }else{
                echo "<li>
                  <a href='".$url->url_sub($row[menu_dari], $row[link])."' style='float:right;width:calc(100% - 65px);text-transform:uppercase;color:#035680;font-size:11px;margin-bottom:5px;'>$row[nama_menu]</a>
                  <a style='float:right;width:calc(100% - 65px)' href='".$url->url_baca($row[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'>$row[judul]</a><div class='clearfix'></div>
                </li>";
              }
              $x++;
            }
            ?>
            </ol>
          </div>
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- W_Right Banner Ads -->
          <ins class="adsbygoogle"
              style="display:inline-block;width:270px;height:350px"
              data-ad-client="ca-pub-4290882175389422"
              data-ad-slot="1385019502"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
            <div class="single_blog_sidebar berita-foto wow fadeInUp">
              <h1 class="title" style="margin-top:0px;font-size:20px;">INFOGRAFIS</h1>
              <ul class="list-berita-foto">
              <?php
              $foto = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND username = 'alifahmi' ORDER BY id_berita DESC LIMIT 1");
              while($row = mysql_fetch_array($foto)){
                echo "
                <li style='position:relative;'>
                  <img class='lazy' src='".$url->url_base_image('R')."' data-src='".$url->url_article_img($row[gambar], 300)."' style='height:auto'>
                  <div class='black_layer'></div>
                  <div style='position:absolute;bottom:0;'>
                    <a href='foto-$row[judul_seo]' title='$row[judul]'><h1 style='color:#fff;font-size:15px;padding:0 5px;'>$row[judul]</h1></a>
                  </div>
                </li>";
              }
              ?>
              </ul>
            </div>
          <div id='scroll-fixed'>
            <div class="single_blog_sidebar wow fadeInUp" style="height:auto;margin-bottom:10px;">
              <h1 class="title" style="font-size:20px;">FOTO
                <a href="foto" style='font-weight:100;float:right;font-size:14px;line-height:25px;'>+ Semua</a>
              </h1>
              <ul class="list-berita-foto">
              <?php
              $foto = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND jenis_berita = 'foto' ORDER BY id_berita DESC LIMIT 1");
              while($row = mysql_fetch_array($foto)){
                echo "
                <li style='position:relative;'>
                  <img class='lazy' data-src='".$url->url_article_img($row[gambar], 300)."' alt='$row[judul]'>
                  <div class='black_layer'></div>
                  <div style='position:absolute;bottom:0;'>
                    <a href='".$url->url_baca($row[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'><h1 style='color:#fff;font-size:15px;padding:0 5px;margin:0;'>$row[judul]</h1></a>
                    <svg style='display:block;width:24px;height:24px;float:right;margin-right:5px;' viewBox='0 0 24 24'>
                    <path fill='#fff' d='M1,5H3V19H1V5M5,5H7V19H5V5M22,5H10A1,1 0 0,0 9,6V18A1,1 0 0,0 10,19H22A1,1 0 0,0 23,18V6A1,1 0 0,0 22,5M11,17L13.5,13.85L15.29,16L17.79,12.78L21,17H11Z' />
                    </svg>
                  </div>
                </li>";
              }
              ?>
              </ul>
            </div>
            <div class="single_blog_sidebar wow fadeInUp" style="height:auto;margin-bottom:10px;">
              <h1 class="title liputan-khusus" style="font-size:20px;">VIDEO
              <a href="video" style='font-weight:100;float:right;font-size:14px;line-height:25px;'>+ Semua</a>
              </h1>
              <ul class="list-liputan-video">
              <?php
              $video = mysql_query("SELECT * FROM berita, menu WHERE id_menu = id_kategori AND jenis_berita = 'video' ORDER BY id_berita DESC LIMIT 1");
              while($row = mysql_fetch_array($video)){
                echo "
                  <li style='position:relative;margin-bottom:2px;'>
                    <img class='lazy' src='".$url->url_base_image('R')."' data-src='".$url->url_article_img($row[gambar], 300)."'>

                    <div class='black_layer'></div>
                    <div style='position:absolute;bottom:0;'>
                      <a href='".$url->url_baca($row[menu_dari], $row[id_berita], $row[judul_seo])."' title='$row[judul]'><h1 style='color:#fff;font-size:15px;padding:0 5px;margin:0;'>$row[judul]</h1></a><svg style='width:24x;height:24px;display:block;float:right;margin-right:5px;' viewBox='0 0 24 24'>
                      <path fill='#fff' d='M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z' />
                    </svg>
                    </div>
                  </li>";
              }
              ?>
              </ul>
            </div>
            <br>
            <div class="single_blog_sidebar wow fadeInUp" style="margin-bottom:50px;">
            <h1 style="font-weight:bold;margin-top:0;font-size:20px;line-height:.8;color:#333;">PILKADA SULSEL 2018</h1>
              <ul class="list-topik-khusus">
                <?php
                  
                  while($row = mysql_fetch_array($query)):
                    echo "<li style='background: transparent;'>
                    <i class='fa fa-hashtag' style='font-size:15x;margin-right:10px;color:#333'></i>
                    <a style='text-transform:uppercase;color:#41454f;font-size:15px;display:inline-block;width:calc(100% - 50px);font-weight:100;vertical-align:middle;line-height:1.5;' href='pilkada/$row[kategori_pilkada]'>$row[kategori_pilkada]</a>
                  </li>";
                  endwhile;
                ?>
              </ul>
            </div>
            <img src="<?= SITE_URL."foto_banner/pegadaian.jpg"?>" alt="">       
            <div class="clearfix"></div>
            <br>
            <div class="email-subs">
              <div class="panel panel-default">
                <div class="panel-heading" style="padding-top:20px;">
                  <svg style="width:52px;height:52px;display:block;margin:auto;stroke: #fff;" viewBox="0 0 24 24">
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
                  <a href="https://www.facebook.com/harianamanah/" target="_blank" style="color:#3b5999">
                    <i class="fa fa-fw fa-facebook-official"></i>
                  </a>
                  <a href="https://twitter.com/harianamanah" target="_blank" style="color:#55acee">
                    <i class="fa fa-fw fa-twitter-square"></i>
                  </a>
                  <a href="https://www.instagram.com/harian_amanah/" target="_blank" style="color:#e4405f">
                    <i class="fa fa-fw fa-instagram"></i>
                  </a>
                  <a href="https://www.linkedin.com/company/13466134" target="_blank" style="color:#0077B5">
                    <i class="fa fa-fw fa-linkedin-square"></i>
                  </a>
                </div>
              </div>
            </div>
                <!-- img ads -->
                
            <!-- end img -->
            <div class="single_blog_sidebar wow fadeInUp" style="margin-bottom:50px;">
              <img src='<?= SITE_URL.'foto_iklanatas/handayani.jpeg' ?>' width="100%">
            </div>    
            <div style="text-align:center;">
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <!-- W_Custom Square Ads -->
              <ins class="adsbygoogle"
                  style="display:inline-block;width:270px;height:270px"
                  data-ad-client="ca-pub-4290882175389422"
                  data-ad-slot="1205411324"></ins>
              <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
            </div>
          </div>
      </div>
    </div>
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
              url: 'more-web.php',
              data: {
                urut: $('li[data-berita]:nth-last-of-type(1)').attr('data-berita'),
                urut_foto: $('li[data-berita-foto]:nth-last-of-type(3)').attr('data-berita-foto')
              },
              success: function(result)
              {
                if(result){
                  $('#list-terkini-middle').append(result);
                  $('.lazy').lazy();
                  loadMore = true;
                 
                }
              }
            });
          }else{
             $('#more_animasi').html('<a id="more_indeks" href="indeks">INDEKS</a>');
          }
          page++;
        }
      });
    </script>

  <ul class="navbar sub-rubrik line-<?php echo $_GET['jn']?>">
  <?php
    $kalam = mysql_query("SELECT nama_menu, link FROM menu WHERE menu_dari = '$_GET[jn]' AND menu = 'Sub'");
    while($row = mysql_fetch_array($kalam)):
      echo "<li><a href='".SITE_URL.$_GET[jn]."/".$row[link]."'>$row[nama_menu]</a></li>";
    endwhile;
  ?>
</ul>
  <section class="container-fluid" style="background-color:white;padding: 0 10px;">
		<section class="headline row">
      <div id='home-carousel' class='carousel slide' data-ride="carousel">
        <div class="carousel-inner"> 
          <?php
            $terkini=mysql_query("SELECT * FROM menu, berita WHERE id_menu = id_kategori AND menu_dari = '$_GET[jn]' ORDER BY id_berita DESC LIMIT 1");
            while($t=mysql_fetch_array($terkini)){
              $id = $t['id_berita'];
          echo"
              <div class='item'>
                <img class='lazy' src='".$url->url_base_image('R')."' data-src='".$url->url_article_img($t[gambar], 700)."' alt='$t[judul]' style='width:100%;height:285px;object-fit:cover;'>
                <span class='judul-berita-utama'>
                  <div class='caption-dt-jd'>
                    <h3><a href='".$url->url_baca($t['menu_dari'], $t['id_berita'], $t['judul_seo'])."' title='$t[judul]'>$t[judul]</a></h3>
                    <span class='tanggal-release home'>". $datetime->time_ago( $t[tanggalwaktu] ) ."</span>
                  </div>
                </span>
              </div>"; }?>
        </div>
			</div>
		</section>
		<section class="daftar-artikel">
    <?php
    $x=1;
    $artikel=mysql_query("SELECT * FROM menu, berita WHERE id_menu = id_kategori AND menu_dari = '$_GET[jn]' AND id_berita < $id ORDER BY id_berita DESC LIMIT 35");
    while($q=mysql_fetch_array($artikel))
    {
      if($x%5 == 0):
        if($state):
          $add_q = "AND id_berita < '$test'";
        else:
          $add_q = ''; 
        endif;
        $inilah = mysql_query("SELECT * FROM berita b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE username = 'alifahmi' $add_q ORDER BY b.id_berita DESC LIMIT 1");
        while($foto=mysql_fetch_array($inilah)):
          echo "<article class= 'artikle' >
          <div class='list-picture'>
            <a href='".SITE_URL."berita-$q[judul_seo]'>
              <img class='picture lazy' src='".SITE_URL."assets/base.png' data-src='".SITE_URL_IMG."foto_berita/$q[gambar1]' alt='$q[judul]' style='width:100%;height:auto;object-fit:cover;'>
            </a>
          </div>
          <div class='artikle-text' data-target='update' kode='$q[id_berita]' style='width:100%;padding:0;margin-top:10px;'>
            <a href='".SITE_URL."berita-$q[judul_seo]' class='berita' title='$q[judul]'>$q[judul]</a>
            <!-- <a href='#' class='link-kategori'>$q[nama_kategori]</a> -->
            <br>
            <p class='waktu-berita'> $q[hari], $tgl - $jam </p> 
          </div>
        </article>";
        $state = true;
        $test = $foto['id_berita'];
        endwhile;
      else:
      echo "<article class= 'artikle' >
        <div class='list-picture'>
          <a href='".SITE_URL."berita-$q[judul_seo]'>
            <img class='picture lazy' src='".SITE_URL."assets/base_n.png' data-src='".SITE_URL_IMG."foto_small/$q[gambar1]' alt='$q[judul]'/>
          </a>
        </div>
        <div class='artikle-text' data-target='update' kode='$q[id_berita]'>
        <a href='".SITE_URL."$q[link]' class='link-kategori'>$q[nama_kategori]</a>
        <a href='".SITE_URL."berita-$q[judul_seo]' class='berita' title='$q[judul]'>$q[judul]</a>
        <p class='waktu-berita'>$q[hari], $tgl - $jam </p>
        </div>
      </article>";
      endif;
      $x++;
      }	?>
    </section>
    <section class="daftar-artikel" id="daftar-artikel"></section>
	 
    <section id="daftar-artikel"></section>
  
    <div id="more" style="display: none;">
			<center><img src="assets/loading.gif" width="100px"></center>
		</div>
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
    <script>
      $(document).ready(function(){
        // var loadMore = true;
        // $(window).scroll(function(){
        //   var nearbottom = 100;
        //   if($(window).scrollTop()+nearbottom >= $(document).height() - $(window).height() && loadMore)
        //   {
        //     loadMore = false;
        //     $.ajax({
        //       method: 'GET',
        //       url: 'more.php',
        //       data: {
        //         kategori: '<?php echo $_GET['jn']?>',
        //         urut: $('.artikle-text:last').attr('kode')
        //       },
        //       beforeSend: function()
        //       {
        //         $('#more').show();
        //       },
        //       complete: function()
        //       {
        //         $('#more').hide().delay(1000);
        //       },
        //       success: function(result)
        //       {
        //         if(result)
        //         {
        //           $('#daftar-artikel').append(result);
        //           loadMore = true;
        //           // $('#more')('<div class="more">MUAT LAINNYA</div>');
        //           // $('.iklan')('<a href="https://abutours.com/" target="_blank" title="AbuTours.com"><img class="img-responsive" src="../foto_iklantengah/917737Iklan-Web-Amanah-2.gif" alt="iklan"></a>');
        //         }
        //       }
        //     });
        //   }
        // });
        $('#more').click(function(){
        	$.ajax({
            method: 'GET',
        		url: 'more.php',
            data: {
              kategori:'<?php echo $_GET['jn']?>',
              urut:$('.artikle-text:last').attr('kode'),
            },
            beforeSend: function(){
              $(this).hide().delay(6000);
            },
        		success: function(html)
        		{
        			if(html)
        			{
        				$('#daftar-artikel').append(html);
        				$('#more').show();
                $('.lazy').lazy();
        			}
        		}
        	})
        });
      });
    </script>
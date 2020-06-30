<ul class="navbar sub-rubrik">
	<?php
	$query = mysql_query("SELECT nama_menu, link, menu_dari
	FROM menu
	WHERE aktif = 'Ya' AND menu='Sub' AND menu_dari = '$_GET[menu]'
	ORDER BY menu_order ASC");
		while($menu = mysql_fetch_array($query)):
			echo "<li class='".($_GET['id'] == $menu[link] ? 'active' : '')."'><a href='".$url->url_sub($menu[menu_dari], $menu[link])."'>$menu[nama_menu]</a></li>";	
		endwhile;
	?>
</ul>
	<!-- Content -->
  <section class="container-fluid" style="background-color:white;padding:0 10px;">
		<section class="headline row">
    <span id="id" style="display:none;"><?php echo $_GET['id']?></span>
		<div id='home-carousel' class='carousel slide' data-ride="carousel">
        <div class="carousel-inner"> 
          <?php
            $terkini=mysql_query("SELECT * FROM menu, berita WHERE id_menu = id_kategori AND headline='Y' AND link = '$_GET[id]' ORDER BY id_berita DESC LIMIT 1");
            while($t=mysql_fetch_array($terkini)){
              $id = $t['id_berita'];
          echo"
              <div class='item'>
                <img class='lazy' data-src='".$url->url_article_img($t[gambar], 700)."' alt='$t[judul]' >
                <span class='judul-berita-utama'>
                  <div class='caption-dt-jd'>
										<span class='tanggal-release home'>". $datetime->time_ago( $t[tanggalwaktu] ) ."</span>
                    <h3><a href='".$url->url_baca($t[menu_dari], $t[id_berita], $t[judul_seo])."' title='$t[judul]'>$t[judul]</a></h3>
                  </div>
                </span>
              </div>"; }?>
        </div>
			</div>
    </section>
		<section class="daftar-artikel">
		<?php
			$x=1;
			$artikel=mysql_query("SELECT * FROM menu, berita WHERE id_menu = id_kategori AND link = '$_GET[id]' ORDER BY id_berita DESC LIMIT 10");
			while($q=mysql_fetch_array($artikel))
			{
				if($q[jenis_berita] == 'foto'):
						echo "<article class= 'artikle' >
						<div class='list-picture photo-gall'>
							<a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."'>
								<img class='picture lazy' src='".$url->url_base_image('R')."' data-src='".$url->url_article_img($q[gambar], 700)."' alt='$q[judul]'>
							</a>
						</div>
						<div class='artikle-text' data-target='$_GET[id]' kode='$q[id_berita]' style='width:100%;padding:0;margin-top:10px;'>
							<p class='waktu-berita'>". $datetime->time_ago( $q[tanggalwaktu] ) ."</p> 
							<a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."' class='berita' title='$q[judul]'>$q[judul]</a>
							<!-- <a href='#' class='link-kategori'>$q[nama_kategori]</a> -->
						</div>
					</article>";
			elseif($x == 9):
				echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<ins class="adsbygoogle"
							style="display:block"
							data-ad-format="autorelaxed"
							data-ad-client="ca-pub-4290882175389422"
							data-ad-slot="9556530284"></ins>
				<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
				</script>';
			else:
					echo "<article class= 'artikle' >
						<div class='list-picture'>
							<a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."'>
								<img class='picture lazy' data-src='".$url->url_article_img($q[gambar], 180)."' alt='$q[judul]'/>
							</a>
						</div>
						<div class='artikle-text' data-target='$_GET[id]' kode='$q[id_berita]'>
							<p class='waktu-berita'>". $datetime->time_ago( $q[tanggalwaktu] ) ."</p>
							<a href='".$url->url_baca($q[menu_dari], $q[id_berita], $q[judul_seo])."' class='berita' title='$q[judul]'>$q[judul]</a>
							<br>
						</div>
					</article>";
				endif;
				$x++;
				} ?>
		</section>
		<section id="daftar-artikel"></section>
		<div id="more" style="display: none;">
			<center><i class="fa fa-2x fa-spin fa-circle-o-notch" style="color:#035680;display:block;"></i>Memuat...</center>
		</div>
		</section>
		<section>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Mobile Banner -->
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
  var loadMore = true;
  $(window).scroll(function(){
    var nearbottom = 110;
    if($(window).scrollTop()+nearbottom >= $(document).height() - $(window).height() && loadMore)
    {
      loadMore = false;
      $.ajax({
        method: 'GET',
        url: '../more.php',
        data: {
          kategori: 'detail',
          urut: $('.artikle-text:last').attr('kode'),
          id: $('#id').text()
        },
        beforeSend: function()
        {
          $('#more').show();
        },
        complete: function()
        {
          $('#more').hide().delay(1000);
        },
        success: function(result)
        {
          if(result)
          {
            $('#daftar-artikel').append(result);
						$('.lazy').lazy();
            loadMore = true;
          }
        }
      });
    }
  });
});
</script>
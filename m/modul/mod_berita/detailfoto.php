<style>


#navs>li, #navs:after{
	position: absolute;
	right: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border-radius: 50%;
	background: #e74c3c;
}

#navs>li{
	transition: all .6s;
	background:transparent;
}

#navs:after{
	content: attr(data-close);
	z-index: 1;
	border-radius: 50%;
}

#navs.active:after{
	content: attr(data-open);
}

#navs a{
	display: inline-block;
	text-decoration: none;
	font-size: 0.8em;
}

#navs li img{
	width: 38px;
	height: 38px;
	border-radius: 50%;
}
#navs li .vote{
	position: absolute;
	padding: 3px 9px 3px 11px;
	background: white;
	display: inline-block;
	font-size: 12px;
	color: black;
	border: 1px solid #808080;
	border-radius: 0 45px 45px 0;
	left: 15px;
	z-index: -1;
}
.bungkus{
	padding-top:0;
	padding-right: 10px;
	padding-left: 10px;
	padding-bottom: 10px;
}
	</style>
	
	<?php 
		$ip = "";

if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
 //check for ip from share internet
 $ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
 // Check for the Proxy User
 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
 $ip = $_SERVER["REMOTE_ADDR"];
}

	?>
		<style>
	.navbar,.navbar-default{
		display:none;
	}
	
	#main{
		background:none;
		z-index:-2;
	}
	</style>
	<div id="fb-root"></div>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '168067490271817',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>	

	<div id="kepala">
		<div class="back">
			<a class="tombol fa fa-angle-left" aria-hidden="true" href="./"></a>			
		</div>
		<div class="share-sosmed">
			<a class="share fa fa-share-alt" aria-hidden="true" data-toggle="modal" data-target="#share-modals"></a>
		</div>
		<div class="modal fade" id="share-modals">
			<div class="box-modal">
				<div class="header-modal">
					<h4>Bagikan Ke :</h4>
				</div>
				<div class="body-mo">
					<a href="#" onclick="
  window.open(
    'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
    'facebook-share-dialog', 
    'width=626,height=436'); 
    return false;" >
						<img src="assets/FB.png" alt="">
						Facebook
					</a>
					<a href="#" onclick="window.open('https://twitter.com/share','width=336','height=206');return false;" >
						<img src="assets/twitter.jpg" alt="">
						Twitter
					</a>
					<a href="#">
						<img src="assets/line.png" alt="">
						Line
					</a>
					<a href="#">
						<img src="assets/INSTAGRAM.jpg" alt="">
						Instagram
					</a>
				</div>
			</div>
		</div>
	</div>					

	
	<section class="container-flui bungkus" id="test">
		<div class="box-header row">
		
				<?php 

				//$detail=mysql_query("SELECT * FROM album, gallery   
                    //  WHERE album.id_album = gallery.id_album AND
                     // album.album_seo = '$_GET[judul]'");

				$detail=mysql_query("
SELECT *
FROM album where album_seo = '$_GET[judul]'
");

				$d   = mysql_fetch_array($detail);
				
				
				?>
		
			<div class="gambar-berita">

					<?php // echo"<img src='http://harianamanah.id/img_album/$d[gbr_album]' class='img-responsive' alt='img'>";
					echo"<p id='testtest' >$d[jdl_album]</p>";
				?>
				
				
			</div>
		</div>
		<br>
			<div class="box">


			<div id="hasil"></div>
			<input type="hidden" class="ip" value="<?php echo $ip; ?>" >
			<input type="hidden" class="jud" value="<?php echo $_GET[judul]; ?>" >

			<span class="berita">
				
				<section class="variable slider">
					<!-- Swiper -->
    <div class='swiper-container'>
     <div class='swiper-wrapper'>
	<?php 
	$detail1=mysql_query("SELECT * FROM album,users,gallery    
                      WHERE users.username=album.username 
                      AND album.id_album=gallery.id_album 
                      AND album_seo='$_GET[judul]'
");

				while($r   = mysql_fetch_array($detail1)){

    echo"
   
       
            <div class='swiper-slide'><img src='http://harianamanah.id/img_galeri/$r[gbr_gallery]' width='100%'></div>
        
   
    ";


}
 ?>			
 			 </div>
 		
 			<!-- Add Pagination -->
        <div class='swiper-pagination'></div>
        <!-- Add Arrows -->
        <div class='swiper-button-next'></div>
        <div class='swiper-button-prev'></div>
      </div>
      <?php 
      		echo"<p id='' >$d[jdl_album]</p>";
      ?>
  </section>
   
			</span>
			<div class="fb-comments" data-href="" data-width="686" data-numposts="5"></div>
							
							<br>
			
		
			<div class="iklan">
				<a href="https://abutours.com/" target="_blank" title="AbuTours.com">
					<img class="img-responsive" src="http://harianamanah.id/foto_iklantengah/917737Iklan-Web-Amanah-2.gif" alt="iklan">
				</a>
			</div>
		</div>
		
	</section>

<script type="text/javascript">
	window.onscroll = changePos;

	function changePos() {
	    // var header = document.getElementById("kepala");
	    var berita = document.getElementById("testtest");
	    if (window.pageYOffset > 199) {
	        // header.style.position = "absolute";
	        // header.style.background = "rgba(20, 175, 180, 0.72)";
	        // header.style.width = "100%";
	        // header.style.height = "57px";
	        // header.style.top = pageYOffset + "px";
	        berita.style.position = "fixed";
	        berita.style.width = "100%";
	        berita.style.top = "0";
	    } else {
	        // header.style.position = "";
	        // header.style.background = "transparent";
	        // header.style.height = "";
	        // header.style.top = "";
	        berita.style.position = "";
	        berita.style.width = ""
	        berita.style.top = "";
	    }
		  
		}

	</script>

	 <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
    });
  </script>


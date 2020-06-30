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

	<section class="container-fluid">
		<div class="box">
		<br>
		<br>
		<br>
				<div class="back">
					<a class="tombol glyphicon glyphicon-chevron-left" onclick="history.back(-1)"></a>
				</div>
				<?php 
				$detail=mysql_query("SELECT * FROM video,users WHERE users.username=video.username  AND video_seo ='$_GET[judul]'");
				$d   = mysql_fetch_array($detail);
				
				
				?>
			<div class="judul-berita">
				<h4>
   
				<h3><?php echo $d[jdl_video]; ?></h3>
			</div>
			<div class="sosial">
		        		<ul class="list-inline pull-right ">
							<li>
						
							<a class="btn btn-social-icon btn-facebook" onclick="
  window.open(
    'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
    'facebook-share-dialog', 
    'width=626,height=436'); 
    return false;"><i class="fa fa-facebook fa-2x"></i> Share</a></li>
							<li><!-- <a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a> -->
							<a class="btn btn-social-icon btn-twitter " onclick="window.open('https://twitter.com/share','width=336','height=206');return false;" ><i class="fa fa-twitter fa-2x"></i> Tweet</a></li>
							
						</ul>
					</div>
			
			
			<span class="berita">
				
				<?php echo"
						<iframe width='100%' tabindex='0' style='background:#000; min-height: 480px;' allowfullscreen='1' src='$d[youtube]' frameborder='0' height='480' allowfullscreen></iframe>
						";
						?>
                <br><br>
                <?php
                echo $d['keterangan'];
                ?>
			</span>
			<div class="fb-comments" data-href="" data-width="686" data-numposts="5"></div>
							
							<br>

			
			
		</div>
	</section>

	
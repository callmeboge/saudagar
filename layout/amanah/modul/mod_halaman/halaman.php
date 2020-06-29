	<div class="row">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Billboard Category -->
		<ins class="adsbygoogle"
				style="display:block"
				data-ad-client="ca-pub-4290882175389422"
				data-ad-slot="6347211346"
				data-ad-format="auto"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<div class="featured container"></div>
	<div class="container"></div></div>
	<!-- /////////////////////////////////////////Content -->
	<div id="page-content" style="background-color: #fff;margin-top:0;" class="index-page container">
				<?php
					$detail=mysql_query("SELECT * FROM halamanstatis, users WHERE judul_seo='$_GET[redaksi]'");
					$d   = mysql_fetch_array($detail);
				?>
				<div class="user-panel">
				<?php echo"<h1 style='font-size: 28px;font-weight:bold;'>$d[judul]</h1>";?>
      			</div><hr>
				<div class="dua-atas">
						<div id="maps" class="single_blog_sidebar wow fadeInUp" style="width:100%;">
							<?php
								echo"<p>$d[isi_halaman]</p>";
							?>
						</div>
					</div>
				</div>
	<div class="clearfix"></div>
</div>
</div><br>
<div class="row" style="text-align:center;">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Banner Bottom -->
	<ins class="adsbygoogle"
			style="display:inline-block;width:728px;height:90px"
			data-ad-client="ca-pub-4290882175389422"
			data-ad-slot="4948221961"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>






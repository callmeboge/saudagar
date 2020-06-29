<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
<div id="page-content" style="background-color: #161616;border:5px solid #00B0B2;margin-bottom:10px;margin-top:130px;padding:20px 30px;" class="index-page container">
<h1 style="font-size:20px;color:#fff;">SITEMAP</h1>
<ul>
<?php
  $menu = mysql_query("SELECT * FROM menu WHERE id_parent='0' AND aktif='Ya'");
  while($row = mysql_fetch_array($menu)){
    echo "
    <li style='display:inline-block;vertical-align:top;margin-right:50px;'>
      <a style='color:#E8BF0A;font-weight:bold;font-size:40px;' href=\"kategori/$row[link]\">$row[nama_menu]</a>
      <ol style='list-style:disc;'>";
      $submenu = mysql_query("SELECT * FROM menu WHERE id_parent = '$row[id_menu]' AND aktif='Ya'");
      while($rowsub = mysql_fetch_array($submenu)){
        echo " <li style='color:#fff;'><a style='color:#fff;' href=\"$rowsub[link]\">$rowsub[nama_menu]</a></li>";
      }
    echo "<br>";
    echo "</ol></li>";
  }
  ?>
</ul>
</div>
<div class="clear">&nbsp;</div>
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
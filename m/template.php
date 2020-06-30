<?php require_once "initial.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta http-equiv="content-language" content="In-Id">
	<meta http-equiv="Content-Type" content="text/html">
	<!-- <meta http-equiv="refresh" content="900"> -->
	<meta name="geo.country" content="id">
	<meta name="geo.placename" content="Indonesia">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
	<meta name="language" content="id">
	<meta name="robots" content="index, follow" >
	<meta name="googlebot" content="index, follow" >
	<meta name="googlebot-news" content="index, follow" >
	<meta name="title" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['jn'], $_GET['module']); ?>" >
	<meta name="description" content="<?= $meta->meta_description($d['isi_berita']); ?>" >
	<meta name="image" content="<?= $meta->meta_image($d['gambar'])?>" >
	<title><?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['jn'], $_GET['module']); ?></title>
	<meta property="og:title" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['jn'], $_GET['module']); ?>" >
	<meta property="og:description" content="<?= $meta->meta_description($d['isi_berita']); ?>" >
	<meta property="og:type" content="article" >
	<meta property="og:url" content="<?= $meta->meta_seo_title($d['menu_dari'], $d['id_berita'], $d['judul_seo'])?>" >
	<meta property="og:image" content="<?= $meta->meta_image($d['gambar'])?>" >
	<meta property="og:image:alt" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['jn'], $_GET['module']); ?>">
	<meta property="og:image:width" content="600">
	<meta property="og:image:height" content="315">
	<meta property="og:site_name" content="<?= $meta->meta_site('saudagarnews.id')['url']; ?>" >
	<meta property="og:locale" content="id_ID" >
	<meta property="fb:app_id" content="490830364408744" >
	<meta property="fb:pages" content="490830364408744" >
	<meta name="twitter:card" content="summary_large_image" >
	<meta name="twitter:site" content="@saudagarnews" >
	<meta name="twitter:site:id" content="@saudagarnews" >
	<meta name="twitter:creator" content="@saudagarnews" >
	<meta name="twitter:title" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['jn'], $_GET['module']); ?>" >
	<meta name="twitter:url" content="<?= $meta->meta_seo_title($d['menu_dari'], $d['id_berita'], $d['judul_seo'])?>" >
	<meta name="twitter:description" content="<?= $meta->meta_description($d['isi_berita']); ?>" >
	<meta name="twitter:image" content="<?= $meta->meta_image($d['gambar'])?>" >
	
	<meta name="theme-color" content="#035680">
	<meta name="msapplication-navbutton-color" content="#035680">
	<meta name="apple-mobile-web-app-status-bar-style" content="#035680">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<link rel="shortcut icon" href="<?= SITE_URL. "assets/favicon/favicon.jpg"?>">
	<!--Bootstrap Theme-->
	<!-- CSS -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500"> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,500" rel="stylesheet">
	<link rel="stylesheet" href="<?= SITE_URL?>fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= SITE_URL. "css/bootstrap.min.css" ?> ">
	<link rel="stylesheet" href="<?= SITE_URL. "css/style.css?v=1.07" ?> ">
	<link rel="stylesheet" href="<?= SITE_URL. "css/berita.css?v=1.07" ?> ">
	<link rel="stylesheet" href="<?= SITE_URL. "css/dream.css?v=1.07" ?> ">
	<link rel="stylesheet" href="<?= SITE_URL. "css/sidemenu.css?v=1.07" ?> ">
	<link rel="stylesheet" href="<?= SITE_URL. "css/lightgallery.min.css?v=1.07" ?>">

	<script src="<?= SITE_URL. "js/bower_components/jquery/dist/jquery.min.js" ?> "></script>
	<script src="<?= SITE_URL. "js/bower_components/bootstrap/dist/js/bootstrap.min.js" ?> "></script>
	<script src="<?= SITE_URL. "js/jquery.lazy.min.js" ?> "></script>
	<script src="<?= SITE_URL. "js/lightgallery-all.min.js?v=1.07" ?>"></script>
	<script src="<?= SITE_URL. "js/script.js?v=1.07" ?> "></script>
	<script>

	</script>
 
	<?php 
		// include_once "heatmap.php"; 
		include_once "analyticstracking.php"; 
		include_once "adsense.php"; 
	?>
</head>
<body>
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
		<header id="head_fixed" class="navbar navbar-default">
				<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#menuSamping">
								<span class="sr-only">Toggle Navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
						<button type="button" class="tutup"><span class="big-close"></span></button>
						<a href="<?php echo SITE_URL?>" class="navbar-brand"><img src="<?= SITE_URL. "assets/logo/main/saudagar.png"?>" class="img-responsive" alt="logo-amanah"></a>
						<form method="GET" action="<?= SITE_URL.'search'?>" style="width:100vw;">
							<div style="width:28px;height:28px;border-radius:50%;border:1px solid #035680;margin-top:11px;margin-right:11px;float:right;"> <input id='search-fill' type="text" name="query-search" placeholder="Cari berita dan peristiwa"></div>
						</form>
				</div>
			<div id="menuSamping" class="sidenav" style="border-top:1px solid rgba(3, 86, 128, 0.36)">
				<!-- <h2 class='caption' style="color:#fff;background-color:#333;display:inline-block;margin:0 0 10px 10px;padding:5px;">PILKADA</h2> -->
				<ul class="nav navbar-nav container-log">
				<?php
					$query = mysql_query("SELECT DISTINCT kategori_pilkada FROM pilkada");
					while($gub = mysql_fetch_array($query)):
						echo "<li><a class='tagging' href='".SITE_URL."pilkada/$gub[kategori_pilkada]' style='padding:10px 15px;text-transform:uppercase;'>#&nbsp;$gub[kategori_pilkada]</a></li>";
					endwhile;
				?>
				</ul>
				<ul class="nav navbar-nav">
					<?php
						$sql = mysql_query("SELECT * FROM menu WHERE menu_dari = 'Mobile' ORDER BY menu_order ASC");
						while($row = mysql_fetch_array($sql)):
							echo "<li><a href='".SITE_URL.$row[link]."' class='tagging'>$row[nama_menu]</a></li>";
						endwhile;
					?>
				</ul>
				<hr style="margin:12px 0;">
				<ul class="nav navbar-nav">
			<?php
				$result = mysql_query("SELECT * FROM menu WHERE menu='Main' AND aktif='Ya' ORDER BY menu_order");
				while ($row = mysql_fetch_array($result)) {
					$idp = $row['id_menu'];
					echo "<li>
						<a href='".$url->url_sub($row[link])."' class='tagging' >$row[nama_menu] </a><li>"; 
					}?> 
					<div class='clearfix'></div>
				</ul>
			</div>
		</header>
		<section id="main">
		<!-- <pre>
			<?php
				echo $_SERVER['QUERY_STRING'];
			?>
		</pre> -->
			<?php include "content.php"; ?>
		<footer>
		<br>
		<div class="container">
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
			<span class="caption-desc" style="font-size:10px;color:#333;display:block;text-align:left;">contoh: example@email.com</span>
		</div>
		<hr>
		<div class="menu-footer">
		<?php
				$query_foot_menu = mysql_query("SELECT judul_seo, judul FROM halamanstatis ORDER BY id_halaman ASC");
				while($row = mysql_fetch_array($query_foot_menu)):
					echo "<li><a href='".$url->url_pages($row[judul_seo])."'>$row[judul]</a></li>";
				endwhile;
			?>
		<div class="clearfix"> </div>
		</div>
		<div class="isi-footer">
			<span class="copyright" style="font-size:10px;">
				2018&nbsp;&copy;&nbsp;PT. Media Saudagar Indonesia - All Rights Reserved.
			</span>
		</div>
		</footer>
</section>
 <!-- JS -->

</body>
</html>

<?php mysql_close($link); ?>
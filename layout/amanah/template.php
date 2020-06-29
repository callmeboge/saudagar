<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html">
  <meta http-equiv="content-language" content="In-Id">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <!-- <meta http-equiv="refresh" content="900"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="author" content="<?= $meta->meta_site('saudagarnews.id')['url']; ?>">
  <meta name="robots" content="index, follow">
  <meta name="googlebot" content="index, follow">
  <meta name="googlebot-news" content="index, follow">
  <meta name="keywords" content>
  <meta name="news_keywords" content>
  <meta name="language" content="id">
  <meta name="geo.placename" content="Indonesia">
  <meta name="geo.country" content="id">
  <meta name="title" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['menu'], $_GET['module']); ?>">
  <meta name="description" content="<?= $meta->meta_description($d['isi_berita']); ?>">
  <meta name="image" content="<?= $meta->meta_image($d['gambar'])?>">
  <title><?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['menu'], $_GET['module']); ?></title>
  <meta property="og:title" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['menu'], $_GET['module']); ?>">
  <meta property="og:description" content="<?= $meta->meta_description($d['isi_berita']); ?>">
  <meta property="og:type" content="article">
  <meta property="og:url" content="<?= $meta->meta_seo_title($d['menu_dari'], $d['id_berita'], $d['judul_seo'])?>">
  <meta property="og:image" content="<?= $meta->meta_image($d['gambar'])?>">
  <meta property="og:image:alt" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['menu'], $_GET['module']); ?>">
  <meta property="og:image:width" content="600">
  <meta property="og:image:height" content="315">
  <meta property="og:site_name" content="<?= $meta->meta_site('saudagarnews.id')['url'];  ?>">
  <meta property="og:locale" content="id_ID">
  <meta property="fb:app_id" content="490830364408744">
  <meta property="fb:pages" content="490830364408744">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@saudagarnews">
  <meta name="twitter:site:id" content="@saudagarnews">
  <meta name="twitter:creator" content="@saudagarnews">
  <meta name="twitter:title" content="<?= $meta->meta_title($_GET['judul'], $_GET['id'], $_GET['menu'], $_GET['module']); ?>">
  <meta name="twitter:url" content="<?= $meta->meta_seo_title($d['menu_dari'], $d['id_berita'], $d['judul_seo'])?>">
  <meta name="twitter:description" content="<?= $meta->meta_description($d['isi_berita']); ?>">
  <meta name="twitter:image" content="<?= $meta->meta_image($d['gambar'])?>">

  <!-- Bootstrap Core CSS -->
  <link rel="shortcut icon" href="<?= SITE_URL. "assets/favicon/favicon.jpg"?>">
  <link rel="stylesheet" href="<?= SITE_URL. "css/bootstrap.min.css" ?>" type="text/css">
  <link rel="stylesheet" href="<?= SITE_URL. "font-awesome-4.7.0/css/font-awesome.min.css" ?>"  type="text/css">
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900"> -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,500" rel="stylesheet">
  <link rel="stylesheet" href="<?= SITE_URL. "css/lightgallery.min.css?v=1.07" ?>">
  <link rel="stylesheet" href="<?= SITE_URL. "css/structure.css?v=1.07" ?>">
  <link rel="stylesheet" href="<?= SITE_URL. "css/style.css?v=1.07" ?>">
  <link rel="stylesheet" href="<?= SITE_URL. "css/new.css?v=1.07" ?>">
  <!-- JS -->
  <!-- jQuery and Modernizr-->
  <script src="<?= SITE_URL. "js/jquery-2.1.1.js" ?> "></script>
  <script src="<?= SITE_URL. "js/bootstrap.min.js" ?> "></script>
  <script src="<?= SITE_URL. "js/jquery.lazy.min.js" ?> "></script>
  <script src="<?= SITE_URL. "js/jquery.lazy.plugins.min.js" ?>"></script>
  <script src="<?= SITE_URL. "js/jquery-scrolltofixed-min.js" ?>"></script>
  <script src="<?= SITE_URL. "js/lightgallery-all.min.js?v=1.07" ?>"></script>
  <script src="<?= SITE_URL. "js/script.js?v=1.07" ?> "></script>
  <script>
 
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
  <![endif]-->
<?php
  // include_once "heatmap.php";
  include_once "analyticstracking.php";
  include_once "adsense.php";
  ?>
</head>
<body>
<header style="margin-bottom:20px;">
  <!--Navigation-->
  <nav id="menu" class="navbar navbar-default" style="margin:0;">
    <div class="row header-row-logo-bulat">
      <div class="container" style="padding:0;">
        <a href="/">
          <div class="logo"><img src="<?= SITE_URL. "assets/logo/main/saudagar.png" ?>" alt="Saudagarnews.id" style="width: 195px;"></div>
        </a>
        <div id="cari">
          <div class="mid1">
          <!-- <form method="GET" action="/search"> -->
          <form method="GET" action="<?= SITE_URL."search"?>">
            <input type="text" name="query-search" placeholder='Cari berita dan peristiwa'>
            <button><i class="fa fa-circle-thin"></i></button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <nav id="logo" class="navbar navbar-default" style="background-color:#fff;">
    <div class="row">
      <div class="container nav-menu" style="padding:0;">
        <div class="navbar-header">
          <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" style="padding:0;position:relative;">
          <ul class="nav navbar-nav" style="position:relative;">
          <?php
            $result = mysql_query("SELECT * FROM menu WHERE menu='Main' AND aktif='Ya' ORDER BY menu_order");
            while( $row = mysql_fetch_array($result)):
          ?>
            <li data-caption ="<?= $row['link']?>" class="main-menu" style="position:static;">
              <a href="<?= $url->url_sub($row['link'])?>"><?= $row['nama_menu']?></a>
                <ul class="menu-show sub-nav-menu <?= strtolower($row['link']) ?>">
                  <li class="sub__rubrik col-lg-3" style="border-right:1px solid rgba(0, 0, 0, 0.25);">
                  <?php
                    $sub_rubrik = mysql_query("SELECT link, nama_menu FROM menu WHERE menu_dari = '$row[menu_dari]' AND menu = 'Sub'");
                    while($row_sub = mysql_fetch_array($sub_rubrik)):
                      echo "<a href='".$url->url_sub($row[link], $row_sub[link])."' style='font-size:12;font-weight:bolder;padding:7px 0;display:block;'>$row_sub[nama_menu]</a>";
                    endwhile;
                  ?>
                  </li>
                  <li class="col-lg-9" style="padding-left:25px;">
                  <?php
                  $query = mysql_query("SELECT judul, judul_seo, gambar, id_berita FROM berita, menu WHERE id_kategori = id_menu AND menu_dari = '$row[menu_dari]' ORDER BY id_berita DESC LIMIT 4");
                  while($img_news = mysql_fetch_array($query)):
                  ?>
                    <div class="mega_menu_img">
                      <a href="<?= $url->url_baca($row[menu_dari], $img_news[id_berita], $img_news[judul_seo]) ?>" style="display:inline-block;">
                        <img class="lazy reset_img" data-src='<?= $url->url_article_img($img_news[gambar]) ?>' alt="<?= $img_news['judul']?>" style="object-fit:cover;">
                      </a>
                      <a class="caption" href="<?= $url->url_baca($row[menu_dari], $img_news[id_berita], $img_news[judul_seo]) ?>"><?= $img_news['judul']?></a>
                    </div>
                  <?php endwhile; ?>
                  </li>
                </ul>
              </li>
          <?php endwhile;?>
          </ul>
        </div>
        </div>
    </div>
    <div class="row" style="border-bottom:1px solid #e5e5e5;border-top:1px solid #e5e5e5;">
      <div class="container" style="padding:0;">
        <ul class="sub-nav-menu sub-menu-rubrik">
        <?php
            if($_GET['menu']):
              $sub_rubrik = mysql_query("SELECT nama_menu, link, menu_dari FROM menu WHERE menu_dari = '$_GET[menu]' AND menu = 'Sub'");
            elseif($_GET['judul']):
              $sub_rubrik = mysql_query("SELECT nama_menu, link FROM menu WHERE id_parent = (SELECT id_parent FROM menu WHERE id_menu = (SELECT id_kategori FROM berita WHERE judul_seo = '$_GET[judul]'))");
            elseif($_GET['id']):
              $sub_rubrik = mysql_query("SELECT nama_menu, link FROM menu WHERE id_parent = (SELECT id_parent FROM menu WHERE id_menu = '$_GET[id]')");
            endif;

            while($row_sub = mysql_fetch_array($sub_rubrik)):
                echo "
                <li class=\"sub__rubrik\">
                  <a href='".$url->url_sub($row_sub[menu_dari], $row_sub[link])."'>$row_sub[nama_menu]</a>
                </li>";
            endwhile;?>
          </ul>
      </div>
    </div>
  </nav>
  <div class="clearfix"></div>
</header>
<?php
    echo "<pre>";
      echo $_SERVER[QUERY_STRING];     
    echo "</pre>";
  include_once "konten.php";
?>
<footer>
  <div class="footer-logo">
    <div class="gambar-footer">
      <a href="/" class="go-top"><span class="fa fa-angle-up" aria-hidden="true" style="color:#1f2126;"></span></a>
    </div>
  </div>
  <div class="footer-menu">
    <div class="container">
    <img src="<?= SITE_URL."assets/logo/foot/saudagar.png"?>" alt="" style="float:left;width:195px;margin-top:20px;">
      <ul class="must-know" style="text-transform:uppercase;">
      <?php
        $query_foot_menu = mysql_query("SELECT judul_seo, judul FROM halamanstatis ORDER BY id_halaman ASC");
        while($row = mysql_fetch_array($query_foot_menu)):
          echo "<li><a style='color:#eee;' href='".$url->url_pages($row[judul_seo])."'>$row[judul]</a></li>";
        endwhile;
      ?>
        <li><a style="color:#eee;" href="<?= SITE_URL?>sitemap">SITEMAP</a></li>
      </ul>
      <ul class="menu-utama">
        <li style="text-align:right;">
          <ul class="block" style="display:block;">
            <li><a href="https://www.facebook.com/harianamanah/" target="_blank"><i  class='fa fa-fw fa-facebook'></i></a></li>
            <li><a href="https://twitter.com/harianamanah" target="_blank"><i  class='fa fa-fw fa-twitter'></i></a></li>
            <li><a href="https://www.instagram.com/harian_amanah/" target="_blank"><i  class='fa fa-fw fa-instagram'></i></a></li>
            <li><a href="https://plus.google.com/115045050828571942973" target="_blank"><i  class='fa fa-fw fa-google-plus'></i></a></li>
            <li><a href="https://www.linkedin.com/company/13466134"><i  class='fa fa-fw fa-linkedin'></i></a></li>
            <li><a href="https://www.youtube.com/channel/UCyk4N4qJdhduvO697WQKc1w" target='_blank'><i  class='fa fa-fw fa-youtube'></i></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <div class="copy-right">
    <div class="container">
      <p style="margin:0;font-size:10px;text-align:left;">2018&nbsp;&copy;&nbsp;PT. Media Saudagar Indonesia - All Rights Reserved.</p>
    </div>
  </div>
	</footer>
	<!-- Footer -->
  
</body>
</html>
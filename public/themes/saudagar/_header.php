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
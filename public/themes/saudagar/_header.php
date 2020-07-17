<?php

Assets::add_css(array(
    'assets/favicon/favicon.jpg',
    base_url('css/bootstrap.min.css'),
    base_url('font-awesome-4.7.0/css/font-awesome.min.css'),
    base_url('https://fonts.googleapis.com/css?family=Rubik:400,500'),
    base_url('css/lightgallery.min.css?v=1.07'),
    base_url('css/structure.css?v=1.07'),
    base_url('css/style.css?v=1.07'),
    base_url('css/new.css?v=1.07')
  ));

Assets::add_js(array(
    base_url('js/jquery-2.1.1.js'),
    base_url('js/bootstrap.min.js'),
    base_url('js/jquery.lazy.min.js'),
    base_url('js/jquery.lazy.plugins.min.js'),
    base_url('js/jquery-scrolltofixed-min.js'),
    base_url('js/lightgallery-all.min.js?v=1.07'),
    base_url('js/script.js?v=1.07'),
));

// Inline script for Google Adsense tag
$googleAdsTag = '<!-- Google Adsense tag -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
  google_ad_client: "ca-pub-4290882175389422",
  enable_page_level_ads: true
});
</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
  google_ad_client: "ca-pub-5843554218260221",
  enable_page_level_ads: true
});
</script>';

// Inline script for Google Analytics tag
$googleAnalyticTag = '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-98715886-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "UA-118291711-1");
  gtag("config", "UA-98715886-2");
</script>';

Assets::add_js($googleAdsTag, 'inline');
Assets::add_js($googleAnalyticTag, 'inline');

?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html">
  <meta http-equiv="content-language" content="In-Id">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <!-- <meta http-equiv="refresh" content="900"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="author" content="">
  <meta name="robots" content="index, follow">
  <meta name="googlebot" content="index, follow">
  <meta name="googlebot-news" content="index, follow">
  <meta name="keywords" content>
  <meta name="news_keywords" content>
  <meta name="language" content="id">
  <meta name="geo.placename" content="Indonesia">
  <meta name="geo.country" content="id">
  <meta name="title" content="">
  <meta name="description" content="">
  <meta name="image" content="">
  <title></title>
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:type" content="article">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <meta property="og:image:alt" content="">
  <meta property="og:image:width" content="600">
  <meta property="og:image:height" content="315">
  <meta property="og:site_name" content="">
  <meta property="og:locale" content="id_ID">
  <meta property="fb:app_id" content="490830364408744">
  <meta property="fb:pages" content="490830364408744">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@saudagarnews">
  <meta name="twitter:site:id" content="@saudagarnews">
  <meta name="twitter:creator" content="@saudagarnews">
  <meta name="twitter:title" content="">
  <meta name="twitter:url" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Bootstrap Core CSS -->
  <?php 
  
    echo Assets::css(null, 'screen', true); 
  
  ?>
  <!-- JS -->
  <?php
  
    echo Assets::js();

  ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
  <![endif]-->
  <!-- // include_once "heatmap.php"; -->
  <!-- // include_once "analyticstracking.php"; -->
  <!-- // include_once "adsense.php"; -->
</head>
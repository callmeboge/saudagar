<?php

Assets::add_css(array(
  'bootstrap.min.css',
  'font-awesome-4.7.0/css/font-awesome.min.css',
  'lightgallery.min.css?v=' . time(),
  'structure.css?v=' . time(),
  'style.css?v=' . time(),
  'new.css?v=' . time()
));
  
Assets::add_js(array(
  'jquery-2.1.1.js',
  'bootstrap.min.js',
  'jquery.lazy.min.js',
  'jquery.lazy.plugins.min.js',
  'jquery-scrolltofixed-min.js',
  'lightgallery-all.min.js?v=' . time(),
  'script.js?v=' . time()
));

// Inline script for Google Adsense tag
$googleAdsTag = '<!-- Google Adsense tag --><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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

// Additional tag: Google Tag
// Assets::add_js($googleAdsTag, 'inline');
// Assets::add_js($googleAnalyticTag, 'inline');

?>
<head>
  <?php

    echo meta(array(
      // Meta SEO
      array(
        'name'    => 'viewport',
        'content' => 'width=device-width, initial-scale=1, user-scalable=no'
      ),
      array(
        'name'    => 'robots',
        'content' => 'index, follow',
      ),
      array(
        'name'    => 'googlebot',
        'content' => 'index, follow',
      ),
      array(
        'name'    => 'keywords',
        'content' => '',
      ),
      array(
        'name'    => 'news keywords',
        'content' => '',
      ),
      array(
        'name'    => 'googlebot-news',
        'content' => 'index, follow',
      ),
      array(
        'name'    => 'language',
        'content' => 'id',
      ),
      array(
        'name'    => 'geo.placement',
        'content' => 'Indonesia',
      ),
      array(
        'name'    => 'geo.country',
        'content' => 'id',
      ),

      // Meta General
      array(
        'name'    => 'title',
        'content' => '',
      ),
      array(
        'name'    => 'description',
        'content' => '',
      ),
      array(
        'name'    => 'image',
        'content' => '',
      ),
      array(
        'name'    => 'url',
        'content' => '',
      ),

      // Opengraph Twitter
      array(
        'name'    => 'twitter:card',
        'content' => 'summary_large_image',
      ),
      array(
        'name'    => 'twitter:site',
        'content' => '@saudagarnews',
      ),
      array(
        'name'    => 'twitter:site:id',
        'content' => '@saudagarnews',
      ),
      array(
        'name'    => 'twitter:creator',
        'content' => '@saudagarnews',
      ),
      array(
        'name'    => 'twitter:title',
        'content' => '',
      ),
      array(
        'name'    => 'twitter:image',
        'content' => '',
      ),
      array(
        'name'    => 'twitter:url',
        'content' => '',
      ),
      array(
        'name'    => 'twitter:description',
        'content' => '',
      ), 

      // Metatag 'http-equiv'
      array(
        'name'    => 'Content-Type',
        'content' => 'text/html',
        'type'    => 'equiv'
      ),
      array(
        'name'    => 'Content-Language',
        'content' => 'In-Id',
        'type'    => 'equiv'
      ),
      array(
        'name'    => 'X-UA-Compatible',
        'content' => 'IE=edge, chrome=1',
        'type'    => 'http-equiv'
      ),

      // Metatag 'property'
      array(
        'name'    => 'og:title',
        'content' => '',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:description',
        'content' => '',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:type',
        'content' => 'article',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:url',
        'content' => '',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:image',
        'content' => '',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:image:alt',
        'content' => '',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:image:width',
        'content' => '600',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:image:height',
        'content' => '315',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:site_name',
        'content' => '',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:locale',
        'content' => 'id_ID',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:app_id',
        'content' => '490830364408744',
        'type'    => 'property'
      ),
      array(
        'name'    => 'og:pages',
        'content' => '490830364408744',
        'type'    => 'property'
      ),

      // Metatag 'charset'
      array(
        'name'    => 'UTF-8',
        'type'    => 'charset'
      )
    ));
    
  ?>
  
  <title></title>

  <!-- Bootstrap Core CSS --> 
  <?php 

      echo link_tag(array(
          'href' => 'https://fonts.googleapis.com/css?family=Rubik:400,500',
          'rel'  => 'stylesheet',
          'type' => 'text/css'
      ));
      echo link_tag(array(
          'href' => 'assets/favicon/favicon.jpg',
          'rel'  => 'shortcut icon',
          'type' => 'image/jpg'
      )); 
  
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
</head>

<?php

  Assets::add_css('main.css');
  Assets::add_js(array(
    'jquery-2.1.4.min.js', 
    Template::theme_url('js/bootstrap.min.js'),// 'bootstrap.min.js', //read file bootstrap in default theme no like css we cant pass parameter to prevent global inheritance.
    'plugins/pace.min.js', 
    'main.js'));

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <?php
    
    echo Assets::css(null, 'screen', TRUE); 
    
    ?>
    <!-- Font-icon css-->

    <?php

    echo Assets::css('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    ?>

    <title><?= e(class_exists('Settings_lib') ? settings_item('site.title') : 'Bonfire') ?></title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
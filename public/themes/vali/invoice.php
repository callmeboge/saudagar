<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="<?= Template::theme_url('css/main.css') ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= e(class_exists('Settings_lib') ? settings_item('site.title') : 'Bonfire'); ?></title>
    <style>
      @media print{
          dl:nth-child(1)
          {
            border:1px dashed black
          }
          img.ilustrasi
          {
            width: ;
          }
          .grid-containers
          {
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 20px;
          }
          
      }
      </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->

  </head>
  <body class="sidebar-mini sidebar-collapse">
    <div class="wrapper">
      <div class="content-wrapper" style="margin-left:0 !important">
        <div class="page-title hidden-print" style="justify-content:start">
          <div style="flex-basis:40px;"><a href="javascript:window.history.back();"><i class="fa fa-2x fa-angle-left"></i></a></div>
          <div>
            <h1><i class="fa fa-file-text-o"></i> Print</h1>
            <p>A Printable Report</p>
          </div>
          <div style="flex:1;">
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Invoice</a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-5">
              <section class="invoice">
                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <div class="logo-container">
                        <img class="pull-left mr-20" 
                             src="<?= Template::theme_url('../toraya-maelo/images/tana-toraja.png') ?>" 
                             width="50"
                             alt="Tana Toraja">
                        <span class="block">Pemerintah Daerah</span>
                        <span class="">Kabupaten Tana Toraja</span>
                        <address class="mt-10"
                                 style="font-size:16px;color:#555"><?= e(class_exists('Settings_lib') ? settings_item('ext.street_name') : null )?></address>
                      </div>
                    </h2>
                    </div>
                  </div>
                <br>
                <div class="invoice-info">
                  <div class="col-lg-6">
                    <img class="ilustrasi" 
                         src="<?= isset($post) ? base_url('/uploads/post_img//' . $post->post_img) : '' ?>"
                         alt="toraya maelo"
                         style="width:100%">
                  </div>
                  <div class="col-lg-6 p-0">
                    <small><strong>Tanggal :</strong><?= isset($post) ? date('d/m/Y', strtotime($post->created_on)) : '' ?></small>
                    <div class="grid-containers">
                      <dl>
                      <dt>ID:</dt>
                      <dd><?= isset($post) ? $post->post_id : '' ?></dd>
                      </dl>
                      <dl>
                      <dt>Nama Lengkap :</dt>
                      <dd><?= isset($post) ? $post->post_name : '' ?></dd>
                      </dl>
                      <dl>
                      <dt>Email:</dt>
                      <dd><?= isset($post) ? $post->post_email : '' ?></dd>
                      </dl>
                      <dl>
                      <dt>Telp</dt>
                      <dd><?= isset($post) ? $post->post_telp : '' ?></dd>
                      </dl>
                      <dl>
                      <dt>Lokasi:</dt>
                      <dd><?= isset($post) ? $this->district_model->get_field($post->post_location, 'nama') : '' ?></dd>
                      </dl>
                      <dl>
                      <dt>Alamat:</dt>
                      <dd><?= isset($post) ? $post->post_address : '' ?></dd>
                      </dl>
                    </div>
                    <dl>
                    <dt>Aduan:</dt>
                    <dd><?= isset($post) ? $post->post_content : '' ?></dd>
                    </dl>
                  </div>
                </div>
              </section>
              <div class="row hidden-print mt-20">
                <div class="col-xs-12 text-right"><a class="btn btn-primary" href="javascript:window.print();"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Javascripts-->
  </body>
</html>
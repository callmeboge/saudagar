<?php

  echo theme_view('_header');

?>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
     <?php

      echo theme_view('_navbar');
      echo theme_view('_sidenav');

     ?>
     <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="<?php echo isset($page_title) ? $page_title['icon'] : 'fa fa-dashboard' ?>"></i> <?php echo isset($page_title) ? ucwords($page_title['name']) : 'Title' ?></h1>
            <p><?php echo isset($page_title) ? $page_title['description'] : 'Description' ?></p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#"><?php echo isset($page_title) ? ucwords($page_title['name']) : 'Title' ?></a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <?php
              echo Template::message() 
            ?>
          </div>
        </div>
        <?php
          echo Template::content();
        ?>
      </div>
    </div>
    <?php

      echo theme_view('_footer');
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
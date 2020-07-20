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
  
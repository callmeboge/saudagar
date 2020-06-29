<?php
  $daerah = $_GET['daerah_pilkada'];
  $calon = $_GET['calon'];
  // query nama calon kepala daerah
  $query = mysql_query("SELECT nama_pasangan FROM pilkada WHERE tag_seo = '$_GET[calon]'");
  $row_calon = mysql_fetch_array($query);
?>
<div class="wraplist">
  <div id="listberita">
    <section class="container cf" style="margin-bottom:0px;padding:0;"><!--konten start-->
    <div class='col-xs-12' style="background:#333;">
      <div class="col-xs-3" style="padding:0;">
        <img src="<?php echo SITE_URL.'foto_banner/leader_amanah.jpg'?>">
      </div>
      <div class="col-xs-9" style="margin-top:30px;">
        <?php
          $query = mysql_query("SELECT * FROM pilkada WHERE kategori_pilkada = '$daerah'");
          while($mbr = mysql_fetch_array($query)):
            echo "<a href='".SITE_URL."tag/$mbr[tag_seo]'><img src='".SITE_URL."img_pilkada/$mbr[gambar_pilkada]' width='50%'></a>";
          endwhile;
        ?>
      </div>
      <div class="clearfix"></div>
    </div>
    </section><!--konten end-->
    <div class="clr"></div>
    <section class="big-ads" id="remove-fixed23">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Banner Bottom -->
      <ins class="adsbygoogle"
          style="display:inline-block;width:728px;height:90px"
          data-ad-client="ca-pub-4290882175389422"
          data-ad-slot="4948221961"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </section>
  </div>
</div>
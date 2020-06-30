<?php
  $daerah = $_GET['daerah_pilkada'];
  $calon = $_GET['calon'];
  // query nama calon kepala daerah
  $query = mysql_query("SELECT nama_pasangan FROM pilkada WHERE tag_seo = '$_GET[calon]'");
  $row_calon = mysql_fetch_array($query);
?>
  <section class="container-fluid" style="padding:0;background:#fff;">
    <div style="background:#333;">
      <img src="<?php echo SITE_URL."/foto_banner/leader_amanah.jpg"?>" width="100%" alt="" >
      <?php
        $query = mysql_query("SELECT * FROM pilkada WHERE kategori_pilkada = '$daerah'");
        while($mbr = mysql_fetch_array($query)):
          echo "<a href='".SITE_URL."tag/$mbr[tag_seo]'><img src='".SITE_URL."img_pilkada/$mbr[gambar_pilkada]' width='100%'></a>";
        endwhile;
      ?>
    </div>
</section>
<section>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Mobile Banner -->
  <ins class="adsbygoogle"
      style="display:inline-block;width:320px;height:50px"
      data-ad-client="ca-pub-4290882175389422"
      data-ad-slot="6679890438"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</section>
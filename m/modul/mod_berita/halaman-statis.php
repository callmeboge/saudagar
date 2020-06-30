<section class="container-fluid" style="background-color:white;">
  <?php
    $query = mysql_query("SELECT * FROM halamanstatis WHERE judul_seo = '$_GET[judulseo]'");
    $row = mysql_fetch_array($query);
  ?>

  <h2><?= $row['judul']?></h2>
  <br>
  <div class="isi-halaman">
    <?php echo $row['isi_halaman'] ; ?>
  </div>
</section>
<section style='text-align:center;'>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- B_Square Ads -->
  <ins class="adsbygoogle"
      style="display:inline-block;width:250px;height:250px"
      data-ad-client="ca-pub-4290882175389422"
      data-ad-slot="4401462448"></ins>
  <script>
  (adsbygoogle = window.adsbygoogle || []).push({});
  </script>
</section>
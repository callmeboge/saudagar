<?php
class meta extends url{
  function meta_title($judul, $id, $menu, $module = ''){
    if($judul):
      $title = $this->select_title('judul', 'berita', 'judul_seo', $judul);
      return htmlentities($title[0]);
    elseif($id):
      return "Berita ".ucfirst($id)." - Saudagar Indonesia";
    elseif($menu):
      return ucfirst($menu)." - Inspirasi Indonesia &#9679 saudagarnews.id";
    else:
      $title = $this->meta_site('saudagarnews.id');
      return $title['title'];
    endif;
  }

  function meta_description($isi = ''){
    if($isi):
      $desc = $this->meta_site('saudagarnews.id');
      return "$desc[meta_deskripsi]";
    else:
      return desc($isi);
    endif;
  }

  function meta_image($gambar = ''){
      if ($gambar):
        return SITE_URL. "img_berita/600px/" .$gambar;
      else:
        return SITE_URL. "assets/share/saudagar.jpg";      
      endif;
  }

  function meta_seo_title($menu, $id_berita, $seo_title, $online=''){
    if($online):
      if($seo_title != ''):
        return "http://$online/".$this->url_baca($menu, $id_berita, $seo_title);
      else:
        return "http://$online";
      endif;
    else:
      if($seo_title != ''):
        return $this->url_baca($menu, $id_berita, $seo_title);
      else:
        return SITE_URL;
      endif;
    endif;
  }

  function select_title ($field, $table, $by, $input){
    $sql = "SELECT $field FROM $table WHERE $by = '$input'";
    $query = mysql_query($sql);

    return mysql_fetch_array($query);
  }

  function meta_site($url){
    $sql = "SELECT * FROM identitas WHERE url = '$url'";
    $query = mysql_query($sql);

    return mysql_fetch_array($query);
  }  
}
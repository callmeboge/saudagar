<?php
class url
{
  function url_baca($menu, $id_berita, $slug, $online = TRUE){
    if($online):
      return SITE_URL.$menu."/baca/".$id_berita."/".$slug;
    else:
      return $menu."/baca/".$id_berita."/".$slug;
    endif;
  }

  function url_sub($menu, $sub = ''){
    if($sub):
      return SITE_URL.$menu."/".$sub;
    else:
      return SITE_URL.$menu;
    endif;
  }

  function url_pages($slug){
    return SITE_URL."halaman/".$slug;
  }
  
  function url_tag ($slug){
    return SITE_URL."tag/".seo_title($slug);
  }

  function url_index_menu ($menu){
    return SITE_URL. $menu ."/indeks";
  }
  
  function url_redirect($domain, $segment1 = '', $segment2 = '', $online = TRUE)
  {
    if($online):
      return preg_replace("/(\/\/w{3}.)|(\/\/m.)|(\/\/)/", "//$domain.", site_URL());
    else:
      return site_URL().$segment1.$segment2;
    endif;
  }

  function url_load_img()
  {
    $sql = "SELECT img_path FROM identitas";

    $row = mysql_fetch_array(mysql_query($sql), MYSQL_ASSOC);

    return $row[img_path];
  }
  
  function url_user_image($foto)
  {
    return $this->url_load_img() . "foto_user/" . $foto;
  }
  
  function url_base_image($dim)
  {
    if($dim == 'R'):
      $base_image = $this->url_load_img() . "img_statis/300px/base.png";
    else:
      $base_image = $this->url_load_img() . "img_statis/85px/base.png";
    endif;
    
    return $base_image;
  }

  function url_article_img($foto, $dim = '300') 
  {
      return $this->url_load_img() . "img_berita/" .$dim. 'px/' . $foto;
  }

}
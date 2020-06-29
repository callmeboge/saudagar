<?php
class data {

  private $option;
  private $thumb;
  private $path;
  private $location;
  private $exif;
  private $pathinfo;

  function select_menu($menu, $sub_menu = ''){
    $sql = "SELECT * FROM menu WHERE $menu";
    if($sub_menu):
      $sql .= "AND menu_dari = '$sub_menu'";
    endif;
    $sql .= "ORDER BY nama_menu ASC";
   
    $query = mysql_query($sql);
    while ( $row = mysql_fetch_array($query, MYSQL_ASSOC) ):
      $row_arr[] = $row;
    endwhile;
    // return mysql_fetch_array($query, MYSQL_ASSOC);
    return $row_arr;
  }

  function upload_gambar($source, $dir, $image_res, $quality){
    $this->option = [jpegQuality => $quality];
    // $this->thumb = PhpThumbFactory::create($source[tmp_name], $this->option);
    // var_dump( $this->path = explode('/', ltrim($_SERVER[PHP_SELF], "/")) )  ;
    $this->path = explode('/', ltrim($_SERVER[PHP_SELF], "/"));
    $this->location = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $this->path[0] . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
    $this->watermark = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $this->path[0] . DIRECTORY_SEPARATOR . 'assets/watermark' . DIRECTORY_SEPARATOR . 'watermark.png';
    // $this->location = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;

    foreach ($image_res as $res):
      $this->thumb = PhpThumbFactory::create($source[tmp_name], $this->option);
    
        if( $res == 700 || $res == 300):
          $this->thumb->resize($res, 0)->save($this->location . $res . "px" . DIRECTORY_SEPARATOR . $source[name]);
        elseif( $res == 600 ):
          $this->thumb->adaptiveResize(600, 315);
          $this->thumb->createWatermark( $this->watermark, 0, 0);
          $this->thumb->save($this->location . $res . "px" . DIRECTORY_SEPARATOR . $source[name]);
        else:
          $this->thumb->adaptiveResize($res, $res)->save($this->location . $res . "px" . DIRECTORY_SEPARATOR . $source[name]);
        endif;
      
      imagedestroy( $this->thumb->getWorkingImage() );
    endforeach;
  }

  function upload_gambar_multiple($source, $slug, $dir, $image_res, $quality){
    $this->option = [jpegQuality => $quality];

    $number_arr_image = count( $source[name] );

    for ($i=0; $i < $number_arr_image; $i++) { 
      $this->thumb = PhpThumbFactory::create($source[tmp_name][$i], $this->option);
      $this->path = explode('/', ltrim($_SERVER[PHP_SELF], "/"));
      // $this->location = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
      $this->location = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $this->path[0] . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
      $this->pathinfo = pathinfo( $source[name][$i], PATHINFO_EXTENSION );

      foreach ($image_res as $res):
        $this->thumb->adaptiveResize($res)->save($this->location . $res . "px" . DIRECTORY_SEPARATOR . $slug ."-". $i .".". $this->pathinfo );
      endforeach;

      // $name['loc'][] = $this->location . $res . "px" . DIRECTORY_SEPARATOR . $slug ."-". $i .".". $this->pathinfo;
      $name['name_file'][] = $slug ."-". $i .".". $this->pathinfo;
      $name['exif_data'][] = exif_read_data( $source[tmp_name][$i] )[ImageDescription] ;
    }
    return $name;
  }

  function delete_gambar($dir, $img_res, $source_name){
    $this->path = explode('/', ltrim($_SERVER[PHP_SELF], "/"));
    $this->location = $_SERVER['DOCUMENT_ROOT'] .  DIRECTORY_SEPARATOR . $this->path[0]. DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
    // $this->location = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;

    foreach ($img_res as $res):
      unlink($this->location . $res . "px" . DIRECTORY_SEPARATOR . $source_name);
    endforeach;
  }

  function mode_tes(){
    $sql = "SELECT mode_tes FROM identitas WHERE id_identitas = 1";
    $row = mysql_fetch_array(mysql_query($sql));

    return (bool) $row['mode_tes'];
  }

  function test(){
    return "tesst";
  }

}
?>
<?php
// connect to db
include "koneksi.php";
include "library.php";
error_reporting(0);

define ('SITE_URL', site_URL());
// call the passed function

if(function_exists($_GET['method'])) {
    $_GET['method']();
}

//methods

function getBerita(){
    function anti_injection($data){
        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
        return $filter;
    }
    $BatasAwal = 10;
    if (!empty(anti_injection($_GET['page']))) {
        $hal = $_GET['page'] - 1;
        $MulaiAwal = $BatasAwal * $hal;
    } else if (!empty(anti_injection($_GET['page'])) and anti_injection($_GET['page']) == 1) {
        $MulaiAwal = 0;
    } else if (empty(anti_injection($_GET['page']))) {
        $MulaiAwal = 0;
    }
    $kat = anti_injection($_GET['kategori']);
//    $dae = anti_injection($_GET['daerah']);

    $field = "judul,
                hari,
                tanggal,
                '1' as urutan,
                CONCAT('".SITE_URL."foto_berita/',gambar) as gambar,
                CONCAT('".SITE_URL."foto_small/',gambar1) as gambar1,
                CONCAT('".SITE_URL."berita-',judul_seo) as judul_seo,
                jam,
                b.id_kategori,
                nama_kategori,
                isi_berita,
                youtube";
    $limit = "LIMIT $MulaiAwal , $BatasAwal";

    $menu = mysql_query("select id_menu,id_parent,nama_menu from menu where id_menu = '$kat'");
    $row_menu = mysql_fetch_assoc($menu);
    if(!empty($kat)&&$row_menu['id_parent']==0){
      if ($kat == 79) {
        $menu = $row_menu['nama_menu'];
        $berita = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        where (b.id_kategori = '88' OR b.id_kategori = '76')
        ORDER BY tanggal DESC, jam DESC $limit");
        $berita_num = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        where (b.id_kategori = '88' OR b.id_kategori = '76')");
        while($row = mysql_fetch_assoc($berita)){
            $row_berita[] = $row;
          }
      }
      else{
        $menu = $row_menu['id_menu'];
        $kategori = mysql_query("select * from  menu WHERE id_parent = $menu");
        $row_kategori[] = $row_menu['nama_menu'];
        while($row = mysql_fetch_assoc($kategori)){
            $row_kategori[] = $row['nama_menu'];
        }
        $val_menu =  implode("','",$row_kategori);
        $berita = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        where k.nama_kategori IN ('$val_menu')
        ORDER BY tanggal DESC, jam DESC $limit");
        $berita_num = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        where k.nama_kategori IN ('$val_menu')");
        while($row = mysql_fetch_assoc($berita)){
            $row_berita[] = $row;
        }
      }
    }
    elseif(!empty($kat)&&$row_menu['id_parent']!=0){
        $id_menu = $row_menu['id_menu'];
        if($id_menu==71){
            $field = "jdl_video as judul,
            'N' as headline,
            'N' as utama,
            'N' as aktif,
            '2' as urutan,
            tanggal,
            CONCAT('".SITE_URL."img_video/',gbr_video) as gambar,
            CONCAT('".SITE_URL."img_video/kecil_',gbr_video) as gambar1,
            CONCAT('".SITE_URL."video-',video_seo) as judul_seo,
            jam,'81' as id_kategori,
            youtube,
            'video' as nama_kategori,
            keterangan as isi_berita";
            $berita = mysql_query("select ".$field." from video
            ORDER BY tanggal DESC, jam DESC $limit");
            $berita_num = mysql_query("select ".$field." from video");
            while($row = mysql_fetch_assoc($berita)){
                $row_berita[] = $row;
            }
        }
        elseif ($id_menu==75) {
          $field = "id_album,
                    jdl_album as judul,
                    hari,
                    tgl_posting as tanggal,
                    CONCAT('".SITE_URL."img_album/', gbr_album) as gambar,
                    CONCAT('".SITE_URL."img_album/', gbr_album) as gambar1,
                    CONCAT('".SITE_URL."foto-',album_seo) as judul_seo,
                    jam,
                    '75' as id_kategori,
                    'Berita Foto' as nama_kategori,
                    keterangan as isi_berita,
                    '' as youtube";

          $limit = "LIMIT $MulaiAwal, $BatasAwal";
          $berita = mysql_query("select ".$field." from album
                                  ORDER BY tgl_posting DESC, jam DESC ".$limit."");
          $berita_num = mysql_query("select ". $field." from album");
          while ($row = mysql_fetch_assoc($berita)) {
            $row_berita[] = $row;
          }
        }
        else{
            $menu = $row_menu['nama_menu'];
            $berita = mysql_query("select ".$field." from berita b
            JOIN kategori k ON k.id_kategori = b.id_kategori
            where k.nama_kategori = '$menu' 
            ORDER BY tanggal DESC, jam DESC $limit");
            $berita_num = mysql_query("select ".$field." from berita b
            JOIN kategori k ON k.id_kategori = b.id_kategori
            where k.nama_kategori = '$menu'");
            while($row = mysql_fetch_assoc($berita)){
                $row_berita[] = $row;
            }
        }
    }
    else{
        $berita = mysql_query("select distinct ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        JOIN menu m ON k.nama_kategori = m.nama_menu
        where m.aktif='YA'
        ORDER BY tanggal DESC, jam DESC $limit");
        $berita_num = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        JOIN menu m ON k.nama_kategori = m.nama_menu
        where m.aktif='YA'");
        while($row = mysql_fetch_assoc($berita)){
            $row_berita[] = $row;
        }
    }
    $row = mysql_num_rows($berita_num);
    if(!empty($_GET['page'])){
        $currentpage = $_GET['page'];
    }elseif(empty($_GET['page'])){
        $currentpage = 1;
    }
    $lastpage = ceil($row / $BatasAwal) ;
    $test = array("total"=>"$row",
                    "per_page"=>"$BatasAwal",
                    "current_page"=>"$currentpage",
                    "last_page"=>"$lastpage");

    $data = [
        'paginate'=>$test,
        'berita'=>is_null($row_berita)?[]:$row_berita
    ];
    header('Content-type: application/json');
    $news = json_encode($data);
    echo  $news;
    die();
}

function getBeritaFromIntent(){
  $getjudul = $_GET['judul'];
  $field = "judul,
              tanggal,
              id_kategori,
              CONCAT('".SITE_URL."foto_berita/',gambar) as gambar,
              CONCAT('".SITE_URL."foto_small/',gambar1) as gambar1,
              CONCAT('".SITE_URL."berita-',judul_seo) as judul_seo,
              jam,
              hari,
              isi_berita,
              youtube";

  $tank = mysql_query("SELECT ".$field." FROM berita WHERE judul_seo LIKE '".$getjudul."%'");

  while ($data = mysql_fetch_array($tank)){
    unset($data[0]);
    unset($data[1]);
    unset($data[2]);
    unset($data[3]);
    unset($data[4]);
    unset($data[5]);
    unset($data[6]);
    unset($data[7]);
    unset($data[8]);
    $respon[] = $data;
  }
  $kategori = $respon[0]['id_kategori'];
  //Berita Terkait
  $tgl_skrg = date("Y-m-d");
  $tgl_sepekan = date("Y-m-d", strtotime("-1 week")) ;
  $arrayhasil = explode("-", $getjudul);
  // $kategori = "56";
  $query_parts = array();
  foreach ($arrayhasil as $val) {
      $query_parts[] = "'% ".mysql_real_escape_string($val)." %'";
  }
  $string = implode(' OR judul LIKE ', $query_parts);

  $tank = mysql_query("SELECT ".$field." FROM berita WHERE judul LIKE {$string} ORDER BY id_berita DESC LIMIT 5");

  while ($data = mysql_fetch_array($tank)){
      unset($data[0]);
      unset($data[1]);
      unset($data[2]);
      unset($data[3]);
      unset($data[4]);
      unset($data[5]);
      unset($data[6]);
      unset($data[7]);
      unset($data[8]);
      $respon2[] = $data;
  }
  $row = count($respon);
  if ($row == 0){
      $tank2 = mysql_query("SELECT ".$field   ." FROM berita WHERE id_kategori = ".$kategori." AND  tanggal BETWEEN '".$tgl_sepekan."' and '".$tgl_skrg."' AND judul_seo <> '".$judul."' ORDER BY id_berita DESC LIMIT 5");
      while ($data2 = mysql_fetch_array($tank2)){
          unset($data2[0]);
          unset($data2[1]);
          unset($data2[2]);
          unset($data2[3]);
          unset($data2[4]);
          unset($data2[5]);
          unset($data2[6]);
          unset($data2[7]);
          unset($data2[8]);
          $respon2[] = $data2;
      }
  }

//    $respon= ['berita' => $respon, 'baris'=> $row];
  $respon2= ['berita' => $respon, 'beritaterkait' => $respon2];
  header('Content-type: application/json');
  $respon2 = json_encode($respon2);
  echo $respon2;
}

function getCari(){
    function anti_injection($data){
        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
        return $filter;
    }
    $BatasAwal = 10;
    if (!empty(anti_injection($_GET['page']))) {
        $hal = $_GET['page'] - 1;
        $MulaiAwal = $BatasAwal * $hal;
    } else if (!empty(anti_injection($_GET['page'])) and anti_injection($_GET['page']) == 1) {
        $MulaiAwal = 0;
    } else if (empty(anti_injection($_GET['page']))) {
        $MulaiAwal = 0;
    }

    $field = "judul,
                headline,
                utama,
                berita.aktif,
                hari,
                tanggal,
                CONCAT('".SITE_URL."foto_berita/',gambar) as gambar,
                CONCAT('".SITE_URL."foto_small/',gambar1) as gambar1,
                CONCAT('".SITE_URL."berita-',judul_seo) as judul_seo,
                jam,
                berita.id_kategori,
                nama_kategori,
                isi_berita,
                youtube";

    $kata = anti_injection($_GET['kata']);

    $sql = mysql_query("select ".$field." from berita
    join kategori on  kategori.id_kategori = berita.id_kategori
    where judul  LIKE '%$kata%'
    ORDER BY case
    when judul like '$kata' then 1
    when judul like '% $kata %' then 2
    when judul like '$kata %' then 3
    when judul like '% $kata' then 4
    else CONCAT(5,judul) end
    , id_berita  DESC LIMIT $MulaiAwal , $BatasAwal");

    while ($berita = mysql_fetch_assoc($sql)) {
        $news[] = $berita;
    }

    $query = mysql_query("select * from berita WHERE judul  LIKE '%$kata%'");
    $row = mysql_num_rows($query);
    if(!empty($_GET['page'])){
        $currentpage = $_GET['page'];
    }elseif(empty($_GET['page'])){
        $currentpage = 1;
    }
    $lastpage = ceil($row / $BatasAwal) ;
    $test = array("total"=>"$row",
                    "per_page"=>"$BatasAwal",
                    "current_page"=>"$currentpage",
                    "last_page"=>"$lastpage");

    $news = is_null($news)?[]:$news;
    $data = [
        'paginate'=>$test,
        'berita'=>$news
    ];
    header('Content-type: application/json');
    $news = json_encode($data);
    echo  $news;
}

function getHeadline(){
    $tgl_skrg = date("Y-m-d");
    $tgl_sepekan = date("Y-m-d", strtotime("-1 week")) ;
    $field = "judul,
                headline,
                utama,
                aktif,
                hari,
                tanggal,
                CONCAT('".SITE_URL."foto_berita/',gambar) as gambar,
                CONCAT('".SITE_URL."foto_small/',gambar1) as gambar1,
                CONCAT('".SITE_URL."berita-',judul_seo) as judul_seo,
                jam,
                isi_berita,
                youtube";
    // $sql = mysql_query(" select ".$field." from berita WHERE tanggal BETWEEN '".$tgl_sepekan."' and '".$tgl_skrg."' ORDER BY dibaca DESC LIMIT 5");
    $sql = mysql_query(" select ".$field." from berita WHERE headline = 'y' ORDER BY dibaca DESC LIMIT 5");

    while($berita = mysql_fetch_assoc($sql)){

      $news[] = $berita;
    }
    header('Content-type: application/json');
    $news = ['berita'=>$news];
    $news = json_encode($news);
    echo $news;
    echo $tgl_skrg;
}

function getMenuBaru(){
    $sqlparent = mysql_query("SELECT * FROM menu WHERE aktif ='Ya' AND id_parent = '0' ORDER BY id_menu ASC ");
    while($dataparent = mysql_fetch_array($sqlparent)){
        unset($dataparent[0]);
        unset($dataparent[1]);
        unset($dataparent[2]);
        unset($dataparent[3]);
        unset($dataparent[4]);
        $responparent[] = $dataparent;
    }

    $sqlchild = mysql_query("SELECT * FROM menu WHERE aktif ='Ya' AND id_parent != '0' ORDER BY id_menu ASC ");
    while($datachild = mysql_fetch_array($sqlchild)){
        unset($datachild[0]);
        unset($datachild[1]);
        unset($datachild[2]);
        unset($datachild[3]);
        unset($datachild[4]);
        $responchild[] = $datachild;
    }

    $respon= ['Parent' => $responparent, 'Child'=> $responchild];
    header('Content-type: application/json');
    $respon = json_encode($respon);
    echo $respon;
}

function getMenuBaruLagi(){
    $sqlparent = mysql_query("SELECT * FROM menu WHERE aktif ='Ya' AND id_parent = '0' ORDER BY id_menu ASC ");
    $row_parent = mysql_num_rows($sqlparent);
    while($dataparent = mysql_fetch_array($sqlparent)){
        unset($dataparent[0]);
        unset($dataparent[1]);
        unset($dataparent[2]);
        unset($dataparent[3]);
        unset($dataparent[4]);
        $responparent[] = $dataparent;
    }

    $sqlchild = mysql_query("SELECT * FROM menu WHERE aktif ='Ya' AND id_parent != '0' ORDER BY id_menu ASC ");
    while($datachild = mysql_fetch_array($sqlchild)){
        unset($datachild[0]);
        unset($datachild[1]);
        unset($datachild[2]);
        unset($datachild[3]);
        unset($datachild[4]);
        $responchild[] = $datachild;
    }

    $respon= ['Parent' => $responparent, 'Child'=> $responchild, 'Jumlah' => $row_parent];
    header('Content-type: application/json');
    $respon = json_encode($respon);
    echo $respon;
}

function getBeritaTerkait(){
    $tgl_skrg = date("Y-m-d");
    $tgl_sepekan = date("Y-m-d", strtotime("-1 week")) ;
    $gethasil = $_GET['judul'];
    $kategori = $_GET['kategori'];
    $arrayhasil = explode("-", $gethasil);
    $judul = explode("berita-", $gethasil);
    $judul = $judul[1];
    unset($arrayhasil[0]);

    $query_parts = array();
    foreach ($arrayhasil as $val) {
        $query_parts[] = "'% ".mysql_real_escape_string($val)." %'";
    }
    $string = implode(' OR judul LIKE ', $query_parts);

    $field = "judul,
                tanggal,
                id_kategori,
                CONCAT('".SITE_URL."foto_berita/',gambar) as gambar,
                CONCAT('".SITE_URL."foto_small/',gambar1) as gambar1,
                CONCAT('".SITE_URL."berita-',judul_seo) as judul_seo,
                jam,
                hari,
                isi_berita,
                youtube";
    $tank = mysql_query("SELECT ".$field." FROM berita WHERE (judul LIKE {$string}) AND id_kategori = ".$kategori." AND  tanggal BETWEEN '".$tgl_sepekan."' and '".$tgl_skrg."' AND judul_seo <> '".$judul."' ORDER BY id_berita DESC LIMIT 5");

    while ($data = mysql_fetch_array($tank)){
        unset($data[0]);
        unset($data[1]);
        unset($data[2]);
        unset($data[3]);
        unset($data[4]);
        unset($data[5]);
        unset($data[6]);
        unset($data[7]);
        unset($data[8]);
        $respon[] = $data;
    }
    $row = count($respon);
    if ($row == 0){
        $tank2 = mysql_query("SELECT ".$field   ." FROM berita WHERE id_kategori = ".$kategori." AND  tanggal BETWEEN '".$tgl_sepekan."' and '".$tgl_skrg."' AND judul_seo <> '".$judul."' ORDER BY id_berita DESC LIMIT 5");
        while ($data2 = mysql_fetch_array($tank2)){
            unset($data2[0]);
            unset($data2[1]);
            unset($data2[2]);
            unset($data2[3]);
            unset($data2[4]);
            unset($data2[5]);
            unset($data2[6]);
            unset($data2[7]);
            unset($data2[8]);
            $respon[] = $data2;
        }
    }

//    $respon= ['berita' => $respon, 'baris'=> $row];
    $respon= ['berita' => $respon, 'awal' => $gethasil, 'parsing' => $arrayhasil, 'judul'=> $judul];
    header('Content-type: application/json');
    $respon = json_encode($respon);
    echo $respon;
}

function getViralNews(){
    $field = "judul,
                tanggal,
                id_kategori,
                CONCAT('".SITE_URL."foto_berita/',gambar) as gambar,
                CONCAT('".SITE_URL."foto_small/',gambar1) as gambar1,
                CONCAT('".SITE_URL."berita-',judul_seo) as judul_seo,
                jam,
                hari,
                isi_berita";
    $tank = mysql_query("SELECT ".$field." FROM berita WHERE headline = 'Y' ORDER BY id_berita DESC LIMIT 5");
    while ($data = mysql_fetch_array($tank)){
        unset($data[0]);
        unset($data[1]);
        unset($data[2]);
        unset($data[3]);
        unset($data[4]);
        unset($data[5]);
        unset($data[6]);
        unset($data[7]);
        unset($data[8]);
        $respon[] = $data;
    }
    $respon= ['berita' => $respon];
    header('Content-type: application/json');
    $respon = json_encode($respon);
    echo $respon;
}

function getJadwalSalat(){
    $getkota = $_GET['kota'];
    $gettanggal = $_GET['tanggal'];
    $url = 'muslimsalat.com/' . $getkota . '/weekly/' . $gettanggal . '/false/5.json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
}


function getJadwalSalatKota(){
  $getLatLong = $_GET[latlong];
  $gettanggal = $_GET[tanggal];
  $url = 'maps.googleapis.com/maps/api/geocode/json?latlng='.$getLatLong.'&sensor=false';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);
  curl_close($ch);
  $json = json_decode($result,true);
  $kota = $json['results'][1]['address_components'][0]['short_name'];

  $url = 'muslimsalat.com/' . $kota . '/weekly/' . $gettanggal . '/false/5.json';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);
  curl_close($ch);
  echo $result;
}

function getMuslimNote(){
  $getTanggal = $_GET['tanggal'];
  $field = "judul,
            isi,
            CONCAT('".SITE_URL."foto_berita/',gambar) as gambar";

  $sql = mysql_query("SELECT ".$field." from muslimnote WHERE tanggal='".$getTanggal."'");
  // $sql = mysql_query("SELECT * from muslimnote WHERE tanggal='2017-04-20'");
  while ($data = mysql_fetch_array($sql)) {
    unset($data[0]);
    unset($data[1]);
    unset($data[2]);
    unset($data[3]);
    unset($data[4]);
    unset($data[5]);
    $respon[] = $data;
  }
  $respon= ['muslimnote' => $respon];
  header('Content-type: application/json');
  $respon = json_encode($respon);
  echo $respon;
  echo "string";
}

function cekUpdate(){
  $kodeversi = 16;
  $namaversi = "1.6.2";
  $teks = "<ol>
    <li>Perbaikan perbedaan waktu adzan karena kesalah deteksi lokasi<li>
    <li>Perbaikan bug beberapa perangkat</li>
  </ol>";
  $respon = ['kodeVersi' => $kodeversi, 'namaVersi' => $namaversi, 'teksUpdate' => $teks];
  $respon = ['responVersion' => $respon];
  $respon = json_encode($respon);
  echo $respon;
}

function getDetailBeritaFoto(){
  $getId = $_GET['id'];
  $sql = mysql_query("SELECT keterangan,
                    CONCAT('".SITE_URL."img_galeri/', gbr_gallery) as gbr_gallery
                    FROM gallery WHERE id_album = '$getId'");
  while ($data = mysql_fetch_assoc($sql)) {
    $respon[] = $data;
  }

  $respon = ['foto' => $respon];
  header('Content-type: application/json');
  $respon = json_encode($respon);
  echo $respon;
}

?>

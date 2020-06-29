<?php 
// connect to db
include"koneksi.php";
error_reporting(0);

// call the passed function

	if(function_exists($_GET['method'])) {
		$_GET['method']();
	}




//methods

function getBerita(){
    $base_url = "http://m.harianamanah.id/";
    $base_gambar = "http://harianamanah.id/";
    function anti_injection($data){
        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
        return $filter;
    }
    $BatasAwal = 20;
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

    $field = "judul,headline,utama,b.aktif as aktif,tanggal,CONCAT('".$base_gambar."foto_berita/',gambar) as gambar,CONCAT('".$base_gambar."foto_small/',gambar1) as gambar1,CONCAT(CONCAT('".$base_url."berita-',judul_seo),'.html') as judul_seo, jam,b.id_kategori, nama_kategori, isi_berita";
    $limit = "LIMIT $MulaiAwal , $BatasAwal";

    $menu = mysql_query("select id_menu,id_parent,nama_menu from menu where id_menu = '$kat'");
    $row_menu = mysql_fetch_assoc($menu);
    if(!empty($kat)&&$row_menu['id_parent']==0){
        $menu = $row_menu['id_menu'];
        $kategori = mysql_query("select * from  menu WHERE id_parent = $menu");
        $row_kategori[] = $row_menu['nama_menu'];
        while($row = mysql_fetch_assoc($kategori)){
            $row_kategori[] = $row['nama_menu'];
        }
        $val_menu =  implode("','",$row_kategori);
        $berita = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        where k.nama_kategori IN ('$val_menu') and k.aktif='Y'
        ORDER BY tanggal DESC, jam DESC $limit");
        $berita_num = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        where k.nama_kategori IN ('$val_menu') and k.aktif='Y'");
        while($row = mysql_fetch_assoc($berita)){
            $row_berita[] = $row;
        }
    }
    elseif(!empty($kat)&&$row_menu['id_parent']!=0){
        $id_menu = $row_menu['id_menu'];
        if($id_menu==71){
            $field = "jdl_video as judul,'N' as headline,'N' as utama,'N' as aktif,tanggal,CONCAT('".$base_gambar."img_video/',gbr_video) as gambar,CONCAT('".$base_gambar."img_video/kecil_',gbr_video) as gambar1,CONCAT(CONCAT('".$base_url."video-',video_seo),'.html') as judul_seo, jam,'81' as id_kategori,'video' as nama_kategori, keterangan as isi_berita";
            $berita = mysql_query("select ".$field." from video
            ORDER BY tanggal DESC, jam DESC $limit");
            $berita_num = mysql_query("select ".$field." from video");
            while($row = mysql_fetch_assoc($berita)){
                $row_berita[] = $row;
            }
        }else{
            $menu = $row_menu['nama_menu'];
            $berita = mysql_query("select ".$field." from berita b
            JOIN kategori k ON k.id_kategori = b.id_kategori
            where k.nama_kategori = '$menu' and k.aktif='Y'
            ORDER BY tanggal DESC, jam DESC $limit");
            $berita_num = mysql_query("select ".$field." from berita b
            JOIN kategori k ON k.id_kategori = b.id_kategori
            where k.nama_kategori = '$menu' and k.aktif='Y'");
            while($row = mysql_fetch_assoc($berita)){
                $row_berita[] = $row;
            }
        }
    }
    else{
        $berita = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        JOIN menu m ON k.nama_kategori = m.nama_menu
        where k.aktif='Y' and m.aktif='YA'
        ORDER BY tanggal DESC, jam DESC $limit");
        $berita_num = mysql_query("select ".$field." from berita b
        JOIN kategori k ON k.id_kategori = b.id_kategori
        JOIN menu m ON k.nama_kategori = m.nama_menu
        where k.aktif='Y' and m.aktif='YA'");
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
    $test = array("total"=>"$row", "per_page"=>"$BatasAwal", "current_page"=>"$currentpage","last_page"=>"$lastpage");

    $data = [
        'paginate'=>$test,
        'berita'=>is_null($row_berita)?[]:$row_berita
    ];
    header('Content-type: application/json');
    $news = json_encode($data);
    echo  $news;
    die();

//    $query = mysql_query("select * from kategori k JOIN menu m ON k.nama_kategori = m.nama_menu where m.id_menu = '$kat'");
////    $query = mysql_query("select * from kategori where nama_kategori = '$kat'");
//    $row = mysql_fetch_array($query);
//    $id_kat = $row['id_kategori'];
//    $field = "judul,tanggal,CONCAT('".$base_gambar."foto_berita/',gambar) as gambar,CONCAT('".$base_gambar."foto_small/',gambar1) as gambar1,CONCAT(CONCAT('".$base_url."berita-',judul_seo),'.html') as judul_seo, jam, nama_kategori";
//    $field1 = "judul,tanggal,CONCAT('".$base_gambar."foto_berita/',gambar) as gambar,CONCAT('".$base_gambar."foto_small/',gambar1) as gambar1,CONCAT(CONCAT('".$base_url."berita-',judul_seo),'.html') as judul_seo, jam";
//        if(!empty( ($kat) && ($dae) ) ) {
//
//            $sql = queryGetBerita($MulaiAwal,$BatasAwal, 1, $id_kat , $dae);
////            $sql = mysql_query("select ".$field1." from berita WHERE id_kategori = '$id_kat' and daerah = '$dae' ORDER BY id_berita  DESC  LIMIT $MulaiAwal , $BatasAwal");
//            $users = array();
//            while ($berita = mysql_fetch_array($sql)) {
//                unset($berita[0]);
//                unset($berita[1]);
//                unset($berita[2]);
//                unset($berita[3]);
//                unset($berita[4]);
//                unset($berita[5]);
//                unset($berita[6]);
//                $news[] = $berita;
//            }
//            $sql1 = queryGetBerita($MulaiAwal,$BatasAwal, 2, $id_kat , $dae);
////            $sql1 = mysql_query("select ".$field." from berita  WHERE id_kategori = '$id_kat' and daerah = '$dae' ORDER BY id_berita  DESC ");
//            $row = mysql_num_rows($sql1);
//            if(!empty($_GET['page'])){
//                $currentpage = $_GET['page'];
//            }elseif(empty($_GET['page'])){
//                $currentpage = 1;
//            }
//            $lastpage = round($row / $BatasAwal) ;
//            $test = array("total"=>"$row", "per_page"=>"$BatasAwal", "current_page"=>"$currentpage","last_page"=>"$lastpage");
//
//            $news = is_null($news)?[]:$news;
//            $data = [
//                'paginate'=>$test,
//                'berita'=>$news
//            ];
//            header('Content-type: application/json');
//            $news = json_encode($data);
//            echo  $news;
//        }
//        elseif(!empty($kat) && empty($dae)){
//            $sql = queryGetBerita($MulaiAwal,$BatasAwal, 3, $id_kat , $dae);
////            $sql = mysql_query("select ".$field1." from berita WHERE id_kategori = '$id_kat' ORDER BY id_berita  DESC  LIMIT $MulaiAwal , $BatasAwal");
//
//            while ($berita = mysql_fetch_array($sql)) {
//                unset($berita[0]);
//                unset($berita[1]);
//                unset($berita[2]);
//                unset($berita[3]);
//                unset($berita[4]);
//                unset($berita[5]);
//                unset($berita[6]);
//                $news[] = $berita;
//            }
//
//            $sql1 = queryGetBerita($MulaiAwal,$BatasAwal, 4, $id_kat , $dae);
////            $sql1 = mysql_query("select ".$field1." from berita WHERE id_kategori = '$id_kat' ORDER BY id_berita  DESC");
//            $row = mysql_num_rows($sql1);
//            if(!empty($_GET['page'])){
//                $currentpage = $_GET['page'];
//            }elseif(empty($_GET['page'])){
//                $currentpage = 1;
//            }
//            $lastpage = round($row / $BatasAwal) ;
//            $test = array("total"=>"$row", "per_page"=>"$BatasAwal", "current_page"=>"$currentpage","last_page"=>"$lastpage");
//
//            $news = is_null($news)?[]:$news;
//            $data = [
//                'paginate'=>$test,
//                'berita'=>$news
//            ];
//            header('Content-type: application/json');
//            $news = json_encode($data);
//            echo  $news;
//        }
//        elseif(empty($kat) && !empty($dae)){
//            $sql = queryGetBerita($MulaiAwal,$BatasAwal, 5, $id_kat , $dae);
////            $sql = mysql_query("select ".$field." from berita, kategori WHERE kategori.id_kategori = berita.id_kategori AND daerah = '$dae' ORDER BY id_berita  DESC  LIMIT $MulaiAwal , $BatasAwal");
//
//            while ($berita = mysql_fetch_array($sql)) {
//                unset($berita[0]);
//                unset($berita[1]);
//                unset($berita[2]);
//                unset($berita[3]);
//                unset($berita[4]);
//                unset($berita[5]);
//                unset($berita[6]);
//                $news[] = $berita;
//            }
//
//            $sql1 = queryGetBerita($MulaiAwal,$BatasAwal, 6, $id_kat , $dae);
////            $sql1 = mysql_query("select ".$field." from berita where daerah = '$dae' ORDER BY id_berita  DESC ");
//            $row = mysql_num_rows($sql1);
//            if(!empty($_GET['page'])){
//                $currentpage = $_GET['page'];
//            }elseif(empty($_GET['page'])){
//                $currentpage = 1;
//            }
//            $lastpage = round($row / $BatasAwal) ;
//            $test = array("total"=>"$row", "per_page"=>"$BatasAwal", "current_page"=>"$currentpage","last_page"=>"$lastpage");
//
//            $news = is_null($news)?[]:$news;
//            $data = [
//                'paginate'=>$test,
//                'berita'=>$news
//            ];
//            header('Content-type: application/json');
//            $news = json_encode($data);
//            echo  $news;
//        }
//        else{
//            $sql = queryGetBerita($MulaiAwal,$BatasAwal,5);
//
//            while ($berita = mysql_fetch_array($sql)) {
//                unset($berita[0]);
//                unset($berita[1]);
//                unset($berita[2]);
//                unset($berita[3]);
//                unset($berita[4]);
//                unset($berita[5]);
//                unset($berita[6]);
//                $news[] = $berita;
//            }
//
//            $query = mysql_query("select * from berita");
//            $row = mysql_num_rows($query);
//            if(!empty($_GET['page'])){
//                $currentpage = $_GET['page'];
//            }elseif(empty($_GET['page'])){
//                $currentpage = 1;
//            }
//            $lastpage = round($row / $BatasAwal) ;
//            $test = array("total"=>"$row", "per_page"=>"$BatasAwal", "current_page"=>"$currentpage","last_page"=>"$lastpage");
//
//            $news = is_null($news)?[]:$news;
//            $data = [
//                'paginate'=>$test,
//                'berita'=>$news
//            ];
//            header('Content-type: application/json');
//            $news = json_encode($data);
//            echo  $news;
//        }
}

//function queryGetBerita($MulaiAwal,$BatasAwal,$condition = 0, $id_kat =null, $dae = null){
//    $base_url = "http://m.harianamanah.id/";
//    $base_gambar = "http://harianamanah.id/";
//    $from = 'berita';
//    $limit = "LIMIT $MulaiAwal , $BatasAwal";
//    $field = "judul,tanggal,CONCAT('".$base_gambar."foto_berita/',gambar) as gambar,CONCAT('".$base_gambar."foto_small/',gambar1) as gambar1,CONCAT(CONCAT('".$base_url."berita-',judul_seo),'.html') as judul_seo, jam, nama_kategori";
//    $field1 = "judul,tanggal,CONCAT('".$base_gambar."foto_berita/',gambar) as gambar,CONCAT('".$base_gambar."foto_small/',gambar1) as gambar1,CONCAT(CONCAT('".$base_url."berita-',judul_seo),'.html') as judul_seo, jam";
//    switch ($condition) {
//        case 1:
//            $field = $field1;
//            $where = "id_kategori = '$id_kat' and daerah = '$dae'";
//            break;
//        case 2:
//            $where = "id_kategori = '$id_kat' and daerah = '$dae'";
//            $limit='';
//            break;
//        case 3:
//            $field = $field1;
//            $where = "id_kategori = '$id_kat'";
//            break;
//        case 4:
//            $field = $field1;
//            $where = "id_kategori = '$id_kat'";
//            $limit='';
//            break;
//        case 5:
//            $from = 'berita, kategori';
//            $where = "kategori.id_kategori = berita.id_kategori AND daerah = '$dae'";
//            break;
//        case 6:
//            $where = "daerah = '$dae'";
//            $limit='';
//            break;
//        default:
//            $where = 'kategori.id_kategori = berita.id_kategori';
//            $from = 'berita, kategori';
//    }
//    $sql = mysql_query("select ".$field." from ".$from." WHERE ".$where."  ORDER BY tanggal DESC, jam DESC $limit");
////    var_dump(mysql_fetch_array($sql));
////    die();
//    return $sql;
//}

function getCari(){
    $base_url = "http://m.harianamanah.id/";
    $base_gambar = "http://harianamanah.id/";
    function anti_injection($data){
        $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
        return $filter;
    }
    $BatasAwal = 20;
    if (!empty(anti_injection($_GET['page']))) {
        $hal = $_GET['page'] - 1;
        $MulaiAwal = $BatasAwal * $hal;
    } else if (!empty(anti_injection($_GET['page'])) and anti_injection($_GET['page']) == 1) {
        $MulaiAwal = 0;
    } else if (empty(anti_injection($_GET['page']))) {
        $MulaiAwal = 0;
    }

    $field = "judul,headline,utama,berita.aktif,tanggal,CONCAT('".$base_gambar."foto_berita/',gambar) as gambar,CONCAT('".$base_gambar."foto_small/',gambar1) as gambar1,CONCAT(CONCAT('".$base_url."berita-',judul_seo),'.html') as judul_seo, jam,berita.id_kategori, nama_kategori";

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
    $test = array("total"=>"$row", "per_page"=>"$BatasAwal", "current_page"=>"$currentpage","last_page"=>"$lastpage");

    $news = is_null($news)?[]:$news;
    $data = [
        'paginate'=>$test,
        'berita'=>$news
    ];
    header('Content-type: application/json');
    $news = json_encode($data);
    echo  $news;
}


function getNewBerita(){
    $query = ("select * from berita");
    $jml_baris_now = mysql_num_rows($query);
    if($jml_baris >= $jml_baris_now){
	$sql = mysql_query("select  * from berita ORDER BY id_berita DESC LIMIT 1");

	while($berita = mysql_fetch_array($sql)){
	      $news[] = $berita;	
	}
    header('Content-type: application/json');
    $news = json_encode($news);
    echo $news;
    }

}

function getKategori(){


        $sql = mysql_query("select  * from kategori WHERE aktif = 'Y' ORDER BY id_kategori DESC");

        while($berita = mysql_fetch_array($sql)){
            unset($berita[0]);
            unset($berita[1]);
            unset($berita[2]);
            unset($berita[3]);
            unset($berita[4]);
            unset($berita[5]);
            $news[] = $berita;
        }
        header('Content-type: application/json');
        $news = json_encode($news);
        echo $news;


}



function getMenu(){


    $sql = mysql_query("select  * from menu WHERE aktif = 'Ya' ORDER BY id_menu DESC");

    while($berita = mysql_fetch_array($sql)){
        unset($berita[0]);
        unset($berita[1]);
        unset($berita[2]);
        unset($berita[3]);
        unset($berita[4]);
        $news[] = $berita;
    }
    header('Content-type: application/json');
    $news = json_encode($news);
    echo $news;


}


function getMenuAtas(){


    $sql = mysql_query("select  * from menu  WHERE id_parent='0' AND aktif = 'Ya' ORDER BY id_menu DESC");

    while($berita = mysql_fetch_array($sql)){
        unset($berita[0]);
        unset($berita[1]);
        unset($berita[2]);
        unset($berita[3]);
        unset($berita[4]);
        $news[] = $berita;
    }
    header('Content-type: application/json');
    $news = json_encode($news);
    echo $news;


}

function getMenuCustom(){
    $base_url_menu = "http://harianamanah.id/";
    $slct = "id_menu, id_parent, CONCAT('".$base_url_menu."',link) as link, nama_menu, id_kategori, nama_kategori ";
    $result = mysql_query("SELECT $slct FROM menu, kategori WHERE menu.nama_menu = kategori.nama_kategori ORDER BY id_menu");
    while( $row = mysql_fetch_array($result)) {
        $idp = $row['id_menu'];
        unset($row[0]);
        unset($row[1]);
        unset($row[2]);
        unset($row[3]);
        unset($row[4]);
        unset($row[5]);

            $menu[] = $row;
        $result1 = mysql_query("SELECT $slct FROM menu WHERE aktif='Ya' AND id_parent=$idp ORDER BY id_menu");
        while ($row1 = mysql_fetch_array($result1)) {
            unset($row1[0]);
            unset($row1[1]);
            unset($row1[2]);
            unset($row1[3]);

            $menu_child[] = $row1;


        }




    }

    $data = [
        "menu_parent"=>$menu,
        "menu_child"=>$menu_child
    ];



    header('Content-type: application/json');
    $data = json_encode($data);
    echo $data;
}


?>
<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

    echo "<link href='../../css/zalstyle.css' rel='stylesheet' type='text/css'>
  <link rel='shortcut icon' href='../../favicon.png' />
  
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  <img src='../../img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  </section>
  <section id='error-text'>
  <p><a class='button' href='../../index.php'> <b>LOGIN DI SINI</b> </a></p>
  </section>
  </div>";}

else{
    include "../../../config/koneksi.php";
    include "../../../config/library.php";
    include "../../../config/fungsi_thumb.php";
    include "../../../config/fungsi_seo.php";

    $module=$_GET[module];
    $act=$_GET[act];

    // Hapus berita
    if ($module=='berita' AND $act=='hapus'){
        $data=mysql_fetch_array(mysql_query("SELECT gambar FROM berita WHERE id_berita='$_GET[id]'"));
        if ($data[gambar]!=''){
            mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
            unlink("../../../foto_berita/$_GET[namafile]");
            unlink("../../../foto_small/$_GET[namafile1]");
        }
        else{
            mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
        }
        header('location:../../media.php?module='.$module);
    }


    // Input berita
    elseif ($module=='berita' AND $act=='input'){

        $TempSrc        = $_FILES['fupload']['tmp_name'];
        $ImageType      = $_FILES['fupload']['type'];
        $ImageSize      = $_FILES['fupload']['size'];
        $ImageName      = $_FILES['fupload']['name'];

        // if (!empty($_POST['tag_seo'])){
        //     $tag_seo = $_POST['tag_seo'];
        //     $tag=implode(',',$tag_seo);
        // }
        $jud = mysql_escape_string($_POST[judul]);
        $topik = $_POST[topik];
        $subjud=  $_POST[sub_judul];
        $reporter = $_POST[reporter];
        $youtube= $_POST[youtube];
        $kategori=  $_POST[kategori];
        $dae= $_SESSION[daerah];
        $headline=  $_POST[headline];
        $aktif=  $_POST[aktif];
        $utama= $_POST[utama];
        $dibaca= $_POST[dibaca];
        $nama_user= $_SESSION[id];
        $isi_berita=   $_POST[editor];
        $deskripsi = $_POST[deskripsi];
        $ket_gam= $_POST[keterangan_gambar];
        $tag = $_POST[tags_berita];
        $jenis_berita = $_POST[jenis_berita];

        $judul_seo = seo_title($_POST[judul]);
        $topik_seo = seo_title($topik);

        if(!empty($TempSrc)){
            list($CurWidth,$CurHeight)=getimagesize($TempSrc);
            $RandomNumber           = rand(1,9999);
            //Get file extension from Image name, this will be added after random name
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);

            //remove extension from filename
            $ImageName    = preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName);

            //Construct a new name with random number and extension.
            $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;

            $NewImageName = preg_replace('/\s+/', '', $NewImageName);

            //set the Destination Image
            $thumb_DestRandImageName  = $DestinationDirectory1.$ThumbPrefix.$NewImageName; //Thumbnail name with destination directory
            $DestRandImageName      = $DestinationDirectory.$NewImageName; // Image with destination directory

            if(resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
            {
                //Create a square Thumbnail right after, this time we are using cropImage() function
                if(!cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
                {
                    echo 'Error Creating thumbnail';
                }
            }else{
                die('Resize Error'); //output error
            }
        }

        $tags = explode(',', $tag);
        foreach($tags as $value):
            $tag_seo = seo_title($value);
            mysql_query("INSERT INTO tag_news(nama_tag, tag_seo, hari, tanggal_tag, username) 
                            VALUES('$value','$tag_seo','$hari_ini','$tgl_sekarang','$nama_user')");
        endforeach;
        
        mysql_query("INSERT INTO topik_news(nama_tag, tag_seo, kategori_tag, hari, tanggal_tag) 
                        VALUES('$topik','$topik_seo','$kategori','$hari_ini','$tgl_sekarang')");
        
        if(!empty($ImageName)){
            mysql_query("INSERT INTO berita( judul,
                                    sub_judul,
                                    topik,
                                    jenis_berita,
                                    youtube,
                                    judul_seo,
                                    id_kategori,
                                    daerah,
                                    headline,
                                    aktif,
                                    utama,
                                    dibaca,
                                    username,
                                    isi_berita,
                                    deskripsi,
                                    keterangan_gambar,
                                    jam,
                                    tanggal,
                                    hari,
                                    tag, 
                                    gambar,
                                    reporter)
                      VALUES('$jud','$subjud','$topik','$jenis_berita','$youtube','$judul_seo','$kategori','$dae','$headline','$aktif','$utama','$dibaca','$nama_user','$isi_berita','$deskripsi','$ket_gam','$jam_sekarang','$tgl_sekarang','$hari_ini','$tag','$NewImageName','$reporter')

                                     ");

            header('location:../../media.php?module='.$module);
        }

    }
    // Update berita
    elseif ($module=='berita' AND $act=='update'){
        ############ Edit settings ##############
        $ThumbSquareSize    = 250; //Thumbnail will be 200x200
        $BigImageMaxSize    = 700; //Image Maximum height or width
        $ThumbPrefix      = ""; //Normal thumb Prefix
        $DestinationDirectory = '../../../foto_berita/';
        $DestinationDirectory1  = '../../../foto_small/';//specify upload directory ends with / (slash)
        $Quality        = 90; //jpeg quality
        ##########################################

        $TempSrc        = $_FILES['fupload']['tmp_name'];
        $ImageType      = $_FILES['fupload']['type'];
        $ImageSize      = $_FILES['fupload']['size'];
        $ImageName      = $_FILES['fupload']['name'];

        if(!empty($TempSrc)){
            switch(strtolower($ImageType))
            {
                case 'image/png':
                    //Create a new image from file
                    $CreatedImage =  imagecreatefrompng($_FILES['fupload']['tmp_name']);
                    break;
                case 'image/gif':
                    $CreatedImage =  imagecreatefromgif($_FILES['fupload']['tmp_name']);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    $CreatedImage = imagecreatefromjpeg($_FILES['fupload']['tmp_name']);
                    break;
                default:
                    die('Unsupported File!'); //output error and exit
            }
        }

        $jud = mysql_escape_string($_POST[judul]);
        $subjud=  $_POST[sub_judul];
        $reporter=  $_POST[reporter];
        $youtube= $_POST[youtube];
        $kategori=  $_POST[kategori];
        $dae= $_SESSION[daerah];
        $headline=  $_POST[headline];
        $aktif=  $_POST[aktif];
        $utama= $_POST[utama];
        $dibaca= $_POST[dibaca];
        $nama_user= $_SESSION[id];
        $isi_berita=   $_POST[editor];
        $deskripsi = $_POST[deskripsi];
        $ket_gam= $_POST[keterangan_gambar];
        $tag = $_POST[tags_berita];
        $jenis_berita = $_POST[jenis_berita];

        // $judul_seo      = seo_title($_POST[judul]);
        $topik      = seo_title($_POST[sub_judul]);

        if(!empty($TempSrc)){
            list($CurWidth,$CurHeight)=getimagesize($TempSrc);
            $RandomNumber           = rand(1,9999);
            //Get file extension from Image name, this will be added after random name
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);

            //remove extension from filename
            $ImageName    = preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName);

            //Construct a new name with random number and extension.
            $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;

            $NewImageName = preg_replace('/\s+/', '', $NewImageName);
            
            //set the Destination Image
            $thumb_DestRandImageName  = $DestinationDirectory1.$ThumbPrefix.$NewImageName; //Thumbnail name with destination directory
            $DestRandImageName      = $DestinationDirectory.$NewImageName; // Image with destination directory

            if(resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
            {
                //Create a square Thumbnail right after, this time we are using cropImage() function
                if(!cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
                {
                    echo 'Error Creating thumbnail';
                }
            }else{
                die('Resize Error'); //output error
            }
        }
        // Apabila gambar tidak diganti
        if (empty($ImageName)) {
            mysql_query("UPDATE berita SET judul = '$jud',
                                    sub_judul  = '$subjud',
                                    topik = '$topik',  
                                    jenis_berita = '$jenis_berita',
                                    youtube   = '$youtube',
                                 id_kategori   = '$kategori',
                                 daerah = '$dae',
                                   headline    = '$headline',
                     aktif     = '$aktif',
                     utama     = '$utama',
                                   tag         = '$tag',
                                   isi_berita  = '$isi_berita',
                                   deskripsi    = '$deskripsi',
                keterangan_gambar     = '$ket_gam',
               reporter = '$reporter'
                             WHERE id_berita   = '$_POST[id]'");
            header('location:../../media.php?module='.$module);
        }
        else{
            $data_gambar = mysql_query("SELECT gambar FROM berita WHERE id_berita='$_POST[id]'");
            $r      = mysql_fetch_array($data_gambar);
            
            if (!empty($ImageName)){
                @unlink('../../../foto_berita/'.$r['gambar']);
                @unlink('../../../foto_small/'.$r['gambar1']);
                
                
                mysql_query("UPDATE berita SET judul = '$jud',
                                sub_judul       = '$subjud',
                                topik = '$topik',
                                jenis_berita = '$jenis_berita',
                                youtube      = '$youtube',
                                   id_kategori = '$kategori',
                                   daerah = '$dae',
                                   headline    = '$headline',
                   aktif       = '$aktif',
                    utama      = '$utama',
                                   tag         = '$tag',
                                   isi_berita  = '$isi_berita',
                                    deskripsi    = '$deskripsi',
                keterangan_gambar  = '$ket_gam',
                  gambar    = '$NewImageName',
                  reporter = '$reporter'
                             WHERE id_berita   = '$_POST[id]'");
                header('location:../../media.php?module='.$module);
            }
        }
    }
}
?>
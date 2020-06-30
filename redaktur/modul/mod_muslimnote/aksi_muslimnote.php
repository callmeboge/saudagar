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
    if ($module=='muslimnote' AND $act=='hapus'){
       
        if ($data[gambar]!=''){
            mysql_query("DELETE FROM muslimnote WHERE id='$_GET[id]'");
           
        }
        else{
            mysql_query("DELETE FROM muslimnote WHERE id='$_GET[id]'");
        }
        header('location:../../media.php?module='.$module);
    }


    // Input berita
    elseif ($module=='muslimnote' AND $act=='input'){



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

        if (!empty($_POST['tag_seo'])){
            $tag_seo = $_POST['tag_seo'];
            $tag=implode(',',$tag_seo);
        }
        $jud = $_POST[judul];
        $isi_muslimnote=   $_POST[editor];

        $judul_seo      = seo_title($_POST[judul]);

        $tgl = $_POST[tgl];



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
        if(!empty($ImageName)){

            mysql_query("INSERT INTO muslimnote( judul,
                                    judul_seo,
                                    isi,
                 
                                    tanggal,
                                   
                                    gambar)
                                    
                      VALUES('$jud','$judul_seo','$isi_muslimnote','$tgl','$NewImageName')

                                     ");

            header('location:../../media.php?module='.$module);
        }


    }
    // Update berita
    elseif ($module=='muslimnote' AND $act=='update'){
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

        $jud = $_POST[judul];
        
        $isi_muslimnote=   $_POST[editor];
       

        $judul_seo      = seo_title($_POST[judul]);
        $tgl = $_POST[tgl];


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
            mysql_query("UPDATE   muslimnote SET judul       = '$jud',
                                   judul_seo   = '$judul_seo', 
                                   isi  = '$isi_muslimnote',
                                tanggal = '$tgl'
                             WHERE id   = '$_POST[id]'") or die(mysql_error());
            header('location:../../media.php?module='.$module);
        }
        else{
            $data_gambar = mysql_query("SELECT gambar FROM muslimnote WHERE id='$_POST[id]'");
            $r      = mysql_fetch_array($data_gambar);


            if (!empty($ImageName)){
              

                mysql_query("UPDATE muslimnote SET judul       = '$jud',
                           
                                   judul_seo   = '$judul_seo', 
                               
                                   isi  = '$isi_muslimnote',
                                    tanggal = '$tgl',
                                    gambar    = '$NewImageName'
                 
                             WHERE id   = '$_POST[id]'") or die(mysql_error()) ;
                header('location:../../media.php?module='.$module);

            }

        }
    }

}



?>

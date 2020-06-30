<script>
    function confirmdelete(delUrl) {
        if (confirm("Anda yakin ingin menghapus?")) {
            document.location = delUrl;
        }
    }
</script>


<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

    echo "
  <link href='css/zalstyle.css' rel='stylesheet' type='text/css'>";

    echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='img/lock.png'>
  <h1>MODUL TIDAK DAPAT DIAKSES</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">Untuk mengakses modul, Anda harus login dahulu!</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>ULANGI LAGI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";

}
else{

//cek hak akses user
    $cek=user_akses($_GET[module],$_SESSION[sessid]);
    if($cek==1 OR $_SESSION[leveluser]=='admin' OR $_SESSION[namauser]=='muslimnote'){

        function GetCheckboxes($table, $key, $Label, $Nilai='') {
            $s = "select * from $table order by nama_tag";
            $r = mysql_query($s);
            $_arrNilai = explode(',', $Nilai);
            $str = '';
            while ($w = mysql_fetch_array($r)) {
                $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
                $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck>$w[$Label] ";
            }
            return $str;
        }

        $aksi="modul/mod_muslimnote/aksi_muslimnote.php";
        switch($_GET[act]){

            // Tampil Berita
            default:

                echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?module=muslimnote&act=tambah' class='button'>
   <span>Tambahkan Muslimnote</span>
   </a></div>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Muslimnote</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>";

                if (empty($_GET['kata'])){

                    echo " <thead><tr>  
   <th>No</th>
   <th>Judul Muslimnote</th>
   <th>Tgl. Posting</th>
   <th>Aksi</th>
   
   </thead>
   <tbody>";


                    $p      = new Paging;
                    $batas  = 40;
                    $posisi = $p->cariPosisi($batas);

                    if ($_SESSION[leveluser]=='admin' OR $_SESSION[namauser]=='muslimnote'){
                        $tampil = mysql_query("SELECT * FROM muslimnote ORDER BY id DESC");}

                    $no = $posisi+1;

                    while($r=mysql_fetch_array($tampil)){
                        $tgl_posting=tgl_indo($r[tanggal]);
                        $lebar=strlen($no);
                        switch($lebar){
                            case 1:
                            {
                                $g="0".$no;
                                break;
                            }
                            case 2:
                            {
                                $g=$no;
                                break;
                            }
                        }

                        echo "<tr class=gradeX>
   
   <td><center>$g</center></td>
   <td>$r[judul]</td>
   <td>$tgl_posting</td>
   <td width=80>
   
   <a href=?module=muslimnote&act=edit&id=$r[id] title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></a>
   
   <a href=javascript:confirmdelete('$aksi?module=muslimnote&act=hapus&id=$r[id]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a> 
	   
   </td></tr>";

                        $no++;
                    }

                    echo "</table>";

                    if ($_SESSION[leveluser]=='admin' OR $_SESSION[namauser]=='muslimnote'){
                        $jmldata = mysql_num_rows(mysql_query("SELECT * FROM muslimnote"));
                    }
                    
                    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

                    break;
                }
                else{
                    echo "<div class='module_content'>
          <table id='rounded-corner'>
          <tr><th>No</th><th>Judul</th><th>Tgl. Posting</th><th>Aksi</th></tr>";

                    $p      = new Paging9;
                    $batas  = 15;
                    $posisi = $p->cariPosisi($batas);

                    if ($_SESSION[leveluser]=='admin' OR $_SESSION[namauser]=='muslimnote'){
                        $tampil = mysql_query("SELECT * FROM muslimnote WHERE judul LIKE '%$_GET[kata]%' ORDER BY id_berita DESC LIMIT $posisi,$batas");
                    }
                   
                    $no = $posisi+1;
                    while($r=mysql_fetch_array($tampil)){
                        $tgl_posting=tgl_indo($r[tanggal]);
                        echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td>$tgl_posting</td>
		            <td><a href=?module=muslimnote&act=edit&id=$r[id]><img src='images/icn_edit.png' title='Edit'></a>  
 <a href=javascript:confirmdelete('$aksi?module=muslimnote&act=hapus&id=$r[id]&namafile=$r[gambar]')>
 <img src='images/icn_trash.png' title='Hapus'></a>		        </tr>";
                        $no++;
                    }
                    echo "</table>";

                    if ($_SESSION[leveluser]=='admin' OR $_SESSION[namauser]=='muslimnote'){
                        $jmldata = mysql_num_rows(mysql_query("SELECT * FROM muslimnote WHERE judul LIKE '%$_GET[kata]%'"));
                    }
                   
                    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

                    echo "<div class='pages'>$linkHalaman</div><br>";

                    break;
                }


            case "tambah":

                echo "
  <div id='main-content'>
  <div class='container_12'>

  <div class='grid_12'>
  <div class='block-border'>
  <div class='block-header'>
   
  <h1>TAMBAHKAN Muslimnote</h1>
  </div>
  <div class='block-content'>

  <form id='edit' method=POST action='$aksi?module=muslimnote&act=input' enctype='multipart/form-data'>
      
		  
   <p class=inline-small-label> 
   <label for=field4>Judul</label>
   <input type=text name='judul' size=60>
   </p>

    <p class=inline-small-label> 
   <label for=field4>Tgl Publish</label>
   <input type=date name='tgl' size=60>
   </p>

   "; 	  



                ///////////////////////////////////////////////////////////////////////

   echo "
		  
   <p class=inline-small-label> 
   <label for=field4>Isi Muslimnote</label>
   <textarea name='editor' id='editor' class='ckeditor' style='width: 720px; height: 350px;'></textarea>
   </p> 	  
   
		  
   <p class=inline-small-label> 
   <label for=field4>Gambar</label>
   <input type=file name='fupload' size=40 required> 
   </p>";


    echo "<br /><br /> 
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=berita'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
      <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
	  </li> </ul>
	  </form>";


                break;


            case "edit":
                $edit = mysql_query("SELECT * FROM muslimnote WHERE id='$_GET[id]'");
                $r    = mysql_fetch_array($edit);


                echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT Muslimnote</h1>
   </div>
   <div class='block-content'>

   <form id='edit' method=POST enctype='multipart/form-data' action=$aksi?module=muslimnote&act=update>
   <input type=hidden name=id value=$r[id]>
		  
   <p class=inline-small-label> 
   <label for=field4>Judul Muslimnote</label>
   <input type=text name='judul' size=60 value='$r[judul]'>
   </p>

   <p class=inline-small-label> 
   <label for=field4>Tanggal Publish</label>
   <input type=date name='tgl' size=60 value='$r[tanggal]'>
   </p>
    ";	

  
                //////////////////////////////////////////////////////////

   echo "
   <p class=inline-small-label> 
   <label for=field4>Isi Muslimnote</label>
   <textarea name='editor' id='editor' class='ckeditor' style='width: 720px; height: 350px;'>$r[isi]</textarea>
   </p> 	  

		  
   <p class=inline-small-label> 
   <label for=field4>Gambar</label> ";
                if ($r[gambar]!=''){
                    echo "<img src='../foto_berita/$r[gambar]' width='250px'>
   </p>";}



                echo "
   <p class=inline-small-label> 
   <label for=field4>Ganti Gambar</label>
   <input type=file name='fupload' size=30 >
   </p> ";


                echo  "<div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=muslimnote'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
      <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </form>";

                break;

            case "repairimage":
                repair_image_size('gambar','berita','../foto_berita/','120','120');

                break;

        }
        //kurawal akhir hak akses module
    } else {
        echo akses_salah();
    }
}
?>

</div>
</div>
</div>
<div class='clear height-fix'></div>
</div></div>
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
if($cek==1 OR $_SESSION[leveluser]=='admin'or'user'){

$aksi="modul/mod_iklanatas/aksi_iklanatas.php";
switch($_GET[act]){
  // Tampil Banner
  default:
  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?module=iklan&act=tambahiklanatas' class='button'>
   <span>Tambahkan Iklan</span>
   </a></div>
   
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>IKLAN LAYANAN MASYARAKAT</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>	  
	         
   <thead><tr>	  	
		  
   <th>No</th>
   <th>Judul</th>
   <th>URL</th>
   <th>Tgl. Posting</th>
   <th>Aksi</th>
   
  </thead>
   <tbody>";
		  
	  if ($_SESSION[leveluser]=='admin'or'user'){
      $tampil = mysql_query("SELECT * FROM iklanatas ORDER BY id_iklanatas DESC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM iklanatas
                           WHERE username='$_SESSION[namauser]'       
                           ORDER BY id_iklanatas DESC");
    }
		
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
	  
	  
   echo "<tr class=gradeX>
   <td width=50><center>$no</center></td>
   <td>$r[judul]</td>
   <td><a href=$r[url] target=_blank>$r[url]</a></td>
   <td>$tgl</td>
				
   <td width=80>
   
   <a href=?module=iklan&act=editiklanatas&id=$r[id_iklanatas] title='Edit' class='with-tip'>
   <center><img src='img/edit.png'></a>
   
   <a href=javascript:confirmdelete('$aksi?module=iklan&act=hapus&id=$r[id_iklanatas]') 
   title='Hapus' class='with-tip'>
   &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a> 
	   
   </td></tr>";
    $no++;

  }
  echo "</table>";
  break;
  
  case "tambahiklanatas":
  echo "
  <div id='main-content'>
  <div class='container_12'>

  <div class='grid_12'>
  <div class='block-border'>
  <div class='block-header'>
   
  <h1>TAMBAHKAN IKLAN</h1>
  </div>
  <div class='block-content'>	
  
  <form method=POST action='$aksi?module=iklan&act=input' enctype='multipart/form-data'>

   <p class=inline-small-label> 
   <label for=field4>Judul</label>
  <input type=text name='judul'>
   </p>	  
   
   <p class=inline-small-label>
	 <label for=field4>Kategori</label>
	 <select name='kategori' id='kategori'>
		 <option disable value=>Pilih Kategori</option>";
				foreach ($data_menu->select_menu("menu = 'Main' AND aktif = 'Ya'") as $value):
					echo "<option value='$value[id_menu]'>$value[nama_menu]</option>";
					foreach ($data_menu->select_menu("menu = 'Sub'", $value[menu_dari]) as $sub_value):
						echo "<option value='$sub_value[id_menu]'>--- $sub_value[nama_menu]</option>";
					endforeach;
				endforeach;
  echo "</select></p>
   <p class=inline-small-label>
	 <label for=field4>Letak</label>
	 <select name='layout' id='kategori'>
     <option disable value=>Pilih Tata Letak</option>";
      $_arr_lay = [
                    'TS' => 'Top Square', 
                    'BS' => 'Bottom Square', 
                    'HB' => 'Horizontal Banner'
                  ];
      foreach($_arr_lay as $key => $value):
        echo "<option value='$key' >$value</option>";
      endforeach;
     echo"
     </select></p>";
  
  // echo " <p class=inline-small-label>
  // <label for=field4>Device</label>
  // <input type=checkbox name='device' value='web'>Website
  // <input type=checkbox name='device' value='mob'>Mobile Site
  // </p>";

echo "<p class=inline-small-label> 
   <label for=field4>URL</label>
   <input type=text name='url' placeholder='http://'>
   </p>	  
		  
   <p class=inline-small-label> 
   <label for=field4>Gambar</label>
   <input type=file name='fupload'>
   </p>	  
		  		  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=iklanatas'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp; Simpan &nbsp;&nbsp;'>
   </li> </ul>
   </form>";
  break;

  case "editiklanatas":
    $edit = mysql_query("SELECT * FROM iklanatas WHERE id_iklanatas='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT IKLAN</h1>
   </div>
   <div class='block-content'>	

  <form method=POST enctype='multipart/form-data' action=$aksi?module=iklan&act=update>
  <input type=hidden name=id value=$r[id_iklanatas]>
   
  <p class=inline-small-label> 
    <label for=field4>URL</label>
    <input type=text name='url' size=50 value='$r[url]'>
  </p>
   
  <p class=inline-small-label> 
    <label for=field4>Status</label>";
    $_arr_status = [
                    'Y' => 'Aktif',
                    'N' => 'Non-Aktif'
                  ];
	
	foreach($_arr_status as $key => $value):
    echo "<input type=radio name='status' value='$key' ".($r[status]==$key ? 'checked' : '').">$value";
	endforeach;  

  echo "</p>

  <p class=inline-small-label> 
    <label for=layout>Tata Letak</label>
    <select name='layout' id='layout'>";
      $_arr_lay = [
                    'TS' => 'Top Square', 
                    'BS' => 'Bottom Square', 
                    'HB' => 'Horizontal Banner'
                  ];
      foreach($_arr_lay as $key => $value):
        echo "<option value='$key' ".($r[tata_letak] == $key ? 'selected' : '')." >$value</option>";
      endforeach;
  echo"
    </select>
  </p>

  <p class=inline-small-label> 
    <label for=kategori>Kategori</label>
    <select name='kategori' id='kategori'>";
        // while( $data = $data_menu->select_menu("menu = 'Main' AND aktif = 'Ya'") ):
        //   echo $data[id_menu];
        // endwhile;
        // var_dump( $data_menu->select_menu("menu = 'Main' AND aktif = 'Ya'") );
        foreach ($data_menu->select_menu("menu = 'Main' AND aktif = 'Ya'") as $value):
          echo "<option value='$value[id_menu]'".($r['id_kategori'] == $value['id_menu'] ? 'selected' : '').">$value[nama_menu]</option>";
          foreach ($data_menu->select_menu("menu = 'Sub'", $value[menu_dari]) as $sub_value):
            echo "<option value='$sub_value[id_menu]' ".($r['id_kategori'] == $sub_value['id_menu'] ? 'selected' : '').">--- $sub_value[nama_menu]</option>";
          endforeach;
        endforeach;
    echo"</select>
  </p>
  
   <p class=inline-small-label> 
    <input type='hidden' name='img_name' value='$r[gambar]'>
    <label for=field4>Gambar</label>
    <img src='../foto_iklanatas/$r[gambar]'width=200 >
   </p>
   
   <p class=inline-small-label> 
    <label for=field4>Ganti Gambar</label>
    <input type=file name='fupload' size=30>
   </p>
		  
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=iklanatas'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
   </form>";		  

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
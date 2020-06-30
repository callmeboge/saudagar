<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
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
  </div>";}
  
  else{

  //cek hak akses user
  $cek=user_akses($_GET[module],$_SESSION[sessid]);
  if($cek==1 OR $_SESSION[leveluser]=='admin'){


  $aksi="modul/mod_menu/aksi_menu.php";
  switch($_GET[act]){
  // Tampil Menu Utama
  default:
  
		  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class=grid_12> 
   <br/>
   <a href='?module=menu&act=tambahmenu' class='button'>
   <span>Tambah Menu</span>
   </a></div>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>MENU WEBSITE (MULTILEVEL)</h1>
   <span></span> 
   </div>
   <div class='block-content'>
		  
   <table id='table-example' class='table'>
		
   <thead><tr>
  
   <th>Menu</th>
   <th>Level Menu</th>
   <th>Sub Level Menu</th>
   <th>Aktif</th>
   <th>Aksi</th>
		  
   </thead>
   <tbody>";
		  
   $tampil=mysql_query("SELECT * FROM menu");
   $no=1;
   while ($r=mysql_fetch_array($tampil)){
	
   echo "<tr class=gradeX> 
   <td>$r[nama_menu]</td>
   <td>$r[menu]</td>
   <td>$r[menu_dari]</td>
   <td><center>$r[aktif]</center></td>
  
  <td width=50><a href=?module=menu&act=editmenu&id=$r[id_menu] rel=tooltip-top title='Edit' class='with-tip'>
  <center><img src='img/edit.png'></center></a> 
   
  </td></tr>";
  $no++;}
 
  echo "</table>";
  break;

  // Form Tambah Menu Utama
  case "tambahmenu":
  
  echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>TAMBAH MENU WEBSITE (MULTILEVEL)</h1>
   </div>
   <div class='block-content'>
   <form method=POST action='$aksi?module=menu&act=input'>
   
   <p class=inline-small-label> 
   <label for=field4>Nama Menu</label>
    <input class=form-control type=text name='nama_menu'>
   </p> 
	 
   <p class=inline-small-label> 
   <label for=field4>Menu Title</label>
   <input class=form-control type=text name='title'>
   </p>
   
   <p class=inline-small-label> 
   <label for=field4>Menu Description</label>
   <input class=form-control type=text name='menu_description'>
   </p>

   <p class=inline-small-label> 
   <label for=field4>Menu Keywords</label>
   <input class=form-control type=text name='keywords'>
   </p>
   		     
   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=menu'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
  <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </form>";
	 
   break;

    case "editmenu":
    $edit = mysql_query("SELECT * FROM menu WHERE id_menu='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    function list_menu_utama (){
      $main_menu = mysql_query("SELECT menu, nama_menu, link FROM menu WHERE menu = 'Main'");
      while ($row = mysql_fetch_array($main_menu)):
        echo "<option value='$row[link]'>".ucwords($row['nama_menu'])."</option>";
      endwhile;
    }
      
   echo "
   <div id='main-content'>
   <div class='container_12'>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   
   <h1>EDIT MENU WEBSITE (MULTILEVEL)</h1>
   </div>
   <div class='block-content'>
   
   <form method=POST action=$aksi?module=menu&act=update enctype='multipart/form-data'>
   <input type=hidden name=id value=$r[id_menu]>
		  
   <p class=inline-small-label> 
   <label for=field4>Nama Menu</label>
   <input class='form-control' type=text name='nama_menu' value='$r[nama_menu]'>
   </p>
   
   <p class=inline-small-label> 
   <label for=field4>Level Menu</label>
   <select id='menu' name='menu'>
    <option value='Main'".($r[menu] == 'Main' ? 'selected' : '').">Main Menu</option>
    <option value='Sub' ".($r[menu] == 'Sub' ? 'selected' : '').">Sub Menu</option>
    <option value='Not' ".($r[menu] == 'Not' ? 'selected' : '').">Not Spesific</option>
   </select>  
   </p>
  
   <p id='menu_from' class=inline-small-label style=display:none;> 
   <label for=field4>dari Menu:</label>
   <select name='menu_from'>
    <option value='Not' selected>Not Spesific</option>";
    list_menu_utama();
   echo "</select>  
   </p>

   <p class=inline-small-label> 
   <label for=field4>Aktif</label>
   <input type=radio name='aktif' value='Ya'".($r[aktif] == 'Ya' ? 'checked' : '').">Ya
   <input type=radio name='aktif' value='Tidak'".($r[aktif
   ] == 'Tidak' ? 'checked' : '').">Tidak
   </p>

   <p class=inline-small-label> 
   <label for=field4>Menu Title</label>
   <input class=form-control type=text name='title' value='$r[title]'>
   </p>

   <p class=inline-small-label> 
   <input type='hidden' name='n_img' value='$r[logo]'>
   <label for=field4>Logo Menu</label>
   <input class=form-control type=file name='fupload'>
   </p>
   
   <p class=inline-small-label> 
   <label for=field4>Menu Description</label>
   <input class=form-control type=text name='description' value='$r[description]'>
   </p>

   <p class=inline-small-label> 
   <label for=field4>Menu Keywords</label>
   <input class=form-control type=text name='keywords' value='$r[keywords]'>
   </p>

   <div class=block-actions> 
   <ul class=actions-right> 
   <li>
   <a class='button red' id=reset-validate-form href='?module=menu'>Batal</a>
   </li> </ul>
   <ul class=actions-left> 
   <li>
   <input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
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
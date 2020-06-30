 
  <?php
  $aksi="modul/mod_identitas/aksi_identitas.php";
  switch($_GET[act]){
  // Tampil identitas
  default:
    $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
    $r    = mysql_fetch_array($sql);

  
   echo "
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   </div>

   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>IDENTITAS WEBSITE</h1>
   <span></span> 
   </div>
   <div class='block-content'>
  
    <form method=POST enctype='multipart/form-data' action=$aksi?module=identitas&act=update>
    <input type=hidden name=id value=$r[id_identitas]>
		  
    <p class=inline-small-label> 
    <label for=field4>Name</label>
			<input class='form-control' type=text name='name_website' value='$r[nama_website]'>
    </p> 
    
    <p class=inline-small-label> 
    <label for=field4>Title</label>
			<input class='form-control' type=text name='title_website' value='$r[title]'>
    </p> 
	 
    <p class=inline-small-label> 
    <label for=field4>URL</label>
				<input class='form-control' type=text name='url' value='$r[url]'>
    </p> 
	  
    <p class=inline-small-label> 
    <label for=field4>Meta Deskripsi</label>
			<input class='form-control' type=text name='meta_deskripsi' value='$r[meta_deskripsi]'>
    </p> 
	  
    <p class=inline-small-label> 
    <label for=field4>Meta Keyword</label>
			<input class='form-control' type=text name='meta_keyword' value='$r[meta_keyword]'>
    </p>

    <p class=inline-small-label> 
    <label for=field4>Meta Robot</label>
			<input class='form-control' type=text name='meta_robot' value='$r[meta_robot]'>
    </p>

    <p class=inline-small-label> 
    <label for=field4>Image Path</label>
			<input class='form-control' type=text name='image_path' value='$r[img_path]'>
    </p>
    
	<p class=inline-small-label> 
		<div>Ganti Logo</div>
			<input type='file' name='fupload' /><br/></p>
    
 
    <p class=inline-small-label> 
			<div>Ganti Favicon</div>
      <input type='file' name='fupload' /><br/></p><br/>
      
         <br>
    <br>
    <p class=inline-small-label> 
    <label for=field4>Tes Mode Online/Offline</label>
			<input class='form-control' type=radio name='tes_mode' value='0'".($r['mode_tes'] == '0' ? 'checked' : '').">OFFline
			<input class='form-control' type=radio name='tes_mode' value='1'".($r['mode_tes'] == '1' ? 'checked' : '').">ONline
    </p>

			<div class=block-actions> 
      <ul class=actions-right> 
				<li>
					<a class='button red' id=reset-validate-form href='?module=identitas'>Batal</a>
				</li> 
			</ul>
      <ul class=actions-left> 
				<li>
					<input type='submit' name='upload' class='button' value=' &nbsp;&nbsp;&nbsp;&nbsp; Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
				</li>
			</ul>
			</div>
		</p>
	  </form>";
		break;
  }
  ?>
   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div>
	 </div>
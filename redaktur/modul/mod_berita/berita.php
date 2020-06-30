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
	<link href='css/zalstyle.css' rel='stylesheet' type='text/css'>
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
	if($cek==1 OR $_SESSION[leveluser]=='admin'){

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

		$aksi="modul/mod_berita/aksi_berita.php";
		switch($_GET[act]){

			// Tampil Berita
			default:
				// echo "<pre>";
				// 	var_dump($_SERVER);
				// echo"</pre>";

				echo "<div id='main-content'>
	 <div class='container_12'>
	 <div class=grid_12>
	 <br/>
	 <a href='?module=berita&act=tambahberita' class='button'>
	 <span>Tambahkan Berita</span>
	 </a></div>

	 <div class='grid_12'>
	 <div class='block-border'>
	 <div class='block-header'>
	 <h1>BERITA</h1>
	 <span></span>
	 </div>
	 <div class='block-content'>

	 <table id='table-example' class='table'>";

				if (empty($_GET['kata'])){

					echo " <thead><tr>
	 <th>No</th>
	 <th>Judul Berita</th>
	 <th>Uploader</th>
	 <th>Tgl. Posting</th>
	 <th>Reporter</th>
	 <th>Dibaca</th>
	 <th>Aksi</th>
	 </thead>
	 <tbody>";
		$p      = new Paging;
		$posisi = $p->cariPosisi($batas);

		if ($_SESSION[leveluser]=='admin'){
			$tampil = mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");}


		else{
			$tampil=mysql_query("SELECT * FROM berita b, users u
			WHERE b.username = u.ID AND u.username='$_SESSION[namauser]'
			ORDER BY id_berita DESC");}


		$no = $posisi+1;

		while($r=mysql_fetch_array($tampil)){
			$tgl_posting= date('d M y', strtotime( $r[tanggalwaktu] ));
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

			$tampil1 = mysql_query("SELECT * FROM users WHERE username = '$r[username]' ");
			$s = mysql_fetch_array($tampil1);
			echo "<tr class=gradeX>

	 <td><center>$g</center></td>
	 <td>$r[judul]</td>
	 <td>$s[nama_lengkap]</td>
	 <td>$tgl_posting</td>
	 <td>$r[reporter]</td>
	 <td>$r[dibaca]</td>
	 <td width=80>

	 <a href=?module=berita&act=editberita&id=$r[id_berita] title='Edit' class='with-tip'>
	 <center><img src='img/edit.png'></a>

	 <a href=javascript:confirmdelete('$aksi?module=berita&act=hapus&id=$r[id_berita]')
	 title='Hapus' class='with-tip'>
	 &nbsp;&nbsp;&nbsp;&nbsp;<img src='img/hapus.png'></center></a>
	 </td></tr>";
		$no++;
					}

					echo "</table>";

					if ($_SESSION[leveluser]=='admin'){
						$jmldata = mysql_num_rows(mysql_query("SELECT * FROM berita"));
					}
					else{
						$jmldata = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE username='$_SESSION[namauser]'"));
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

					if ($_SESSION[leveluser]=='admin'){
						$tampil = mysql_query("SELECT * FROM berita WHERE judul LIKE '%$_GET[kata]%' ORDER BY id_berita DESC LIMIT $posisi,$batas");
					}
					else{
						$tampil=mysql_query("SELECT * FROM berita
							 WHERE username='$_SESSION[namauser]'
							 AND judul LIKE '%$_GET[kata]%'
							 ORDER BY id_berita DESC LIMIT $posisi,$batas");
					}

					$no = $posisi+1;
					while($r=mysql_fetch_array($tampil)){
						$tgl_posting=tgl_indo($r[tanggal]);
						echo "<tr><td>$no</td>
				<td>$r[judul]</td>
				<td>$tgl_posting</td>
					<td><a href=?module=berita&act=editberita&id=$r[id_berita]><img src='images/icn_edit.png' title='Edit'></a>
 <a href=javascript:confirmdelete('$aksi?module=berita&act=hapus&id=$r[id_berita]&namafile=$r[gambar]')>
 <img src='images/icn_trash.png' title='Hapus'></a>		        </tr>";
						$no++;
					}
					echo "</table>";

					if ($_SESSION[leveluser]=='admin'){
						$jmldata = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE judul LIKE '%$_GET[kata]%'"));
					}
					else{
						$jmldata = mysql_num_rows(mysql_query("SELECT * FROM berita WHERE username='$_SESSION[namauser]' AND judul LIKE '%$_GET[kata]%'"));
					}
					$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
					$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

					echo "<div class='pages'>$linkHalaman</div><br>";

					break;
				}


			case "tambahberita":

				echo "
	<div id='main-content'>
	<div class='container_12'>

	<div class='grid_12'>
	<div class='block-border'>
	<div class='block-header'>

	<h1>TAMBAHKAN BERITA</h1>
	</div>
	<div class='block-content'>

	<form id='editberita' method=POST action='$aksi?module=berita&act=input' enctype='multipart/form-data' onSubmit='return validate();'>

	 <p class=inline-small-label>
	 <label>Judul Berita</label>
	 <input class=form-control type=text name='judul' minlength='25' required>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Sub Judul Berita</label>
	<input class=form-control type=text name='sub_judul' size=60>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Reporter</label>
	<input class=form-control type=text name='reporter' size=90 required>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Waktu Tayang</label>
	<input class=form-control type=date name='waktu' size=90 >
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Video Youtube</label>
	 <input class=form-control type=text name='youtube' size=60><br/>
	 contoh link: <span class style=\"color:#EA1C1C;\">http://www.youtube.com/embed/xbuEmoRWQHU</span>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Kategori</label>
	 <select name='kategori' id='kategori'>
		 <option selected value=>Pilih Kategori</option>";
				foreach ($data_menu->select_menu("menu = 'Main' AND aktif = 'Ya'") as $value):
					echo "<option value='$value[id_menu]'>$value[nama_menu]</option>";
					foreach ($data_menu->select_menu("menu = 'Sub'", $value[menu_dari]) as $sub_value):
						echo "<option value='$sub_value[id_menu]'>--- $sub_value[nama_menu]</option>";
					endforeach;
				endforeach;
	echo "</select></p>
			<hr>
			<p class='inline-small-label col-xs-12'>
				<label for=field4>Jenis Berita</label>
				<input type=checkbox name='jenis_berita' value='foto'>Foto
				<input type=checkbox name='jenis_berita' value='video'>Video
			</p>
			<!--	<label class='col-xs-12'>Gallery</label>
			<p class='col-xs-12 image-gallery' >
			<input type='file' name='image_gall[]'>
			</p>
			<p class='col-xs-12 image-gallery' >
			<input type='file' name='image_gall[]'>
			</p>
			<p class='col-xs-12 image-gallery' >
			<input type='file' name='image_gall[]'>
			</p>
			<div class='hide'>
			</div> -->

	<div class='clearfix'></div>
	<hr>";

	echo "<p class='inline-small-label col-xs-4'>
	 <label for=field4>Headline/Slider</label>
	 <input type=radio name='headline' value='Y' >Ya
	 <input type=radio name='headline' value='N' checked>Tidak
	 </p>";

	echo "<p class='inline-small-label col-xs-4'>
	 <label for=field4>Editor Choice</label>
	 <input type=radio name='aktif' value='Y' >Ya
	 <input type=radio name='aktif' value='N' checked>Tidak
	 </p>";
	
	 echo "
	 <p class='inline-small-label col-xs-4'>
	 <label for=field4>Berita Utama</label>
	 <input type=radio name='utama' value='Y' >Ya
	 <input type=radio name='utama' value='N' checked>Tidak
	 </p>
	 
	 <div class='clearfix'> </div>
	 <hr>";
	
	 //////////////////////////////////////////////////////////
	echo "
	 <p class=inline-small-label>
	 <label for=field4>Isi Berita</label>
	 <textarea name='editor' id='editor'></textarea>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Deskripsi Berita</label>
	 <textarea maxlength='160' id='deskripsi' class=form-control name='deskripsi'></textarea>
	 </p>
	
	 <p class=inline-small-label>
	 <label for=field4>Topik Berita</label>
	 <input type='text' name='topik' id='topik'>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Tags</label>
	 <input type='text' id='tags_berita' name='tags_berita'>
	 </p>


	 <p class='inline-small-label col-xs-12 col-md-4'>
	 <label for=field4>Gambar</label>
	 <input type='file' id='fupload' name='fupload' required>
	 <span class style=\"color:#EA1C1C;display:block\">Foto yang akan diupload kecil dari 2M</span>
	 </p>

	 <p class='inline-small-label col-xs-12 col-md-4'>
	 <label for=field4>Infografis</label>
	 <input type='file' id='grafis_upload' name='grafis_upload'>
	 <span class style=\"color:#EA1C1C;display:block\">Foto yang akan diupload kecil dari 2M</span>
	 </p>

	 <p class='inline-small-label col-xs-12'>
	 <label for=field4>Keterangan Gbr</label>

	 <input class=form-control type=text name='keterangan_gambar'>
	 </p>
	 <div class='clearfix'></div>
	 ";

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


			case "editberita":
				$edit = mysql_query("SELECT * FROM berita WHERE id_berita='$_GET[id]'");
				$r    = mysql_fetch_array($edit);


				echo "
	 <div id='main-content'>
	 <div class='container_12'>

	 <div class='grid_12'>
	 <div class='block-border'>
	 <div class='block-header'>

	 <h1>EDIT BERITA</h1>
	 </div>
	 <div class='block-content'>

	 <form id='editberita' method=POST enctype='multipart/form-data' action=$aksi?module=berita&act=update>
	 <input type=hidden name=id value=$r[id_berita]>

	 <p class=inline-small-label>
	 <label for=field4>Judul Berita</label>
	 <input class=form-control type=text name='judul' minlength='25' value='$r[judul]'>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Sub Judul Berita</label>
	<input class=form-control type=text name='sub_judul' size=60 value='$r[sub_judul]'>
	 </p>

	<p class=inline-small-label>
	 <label for=field4>Reporter</label>
	<input class=form-control type=text name='reporter' size=60 value='$r[reporter]'>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Video Youtube</label>
	 <input class=form-control type=text name='youtube' size=60 value='$r[youtube]'><BR/>
	 contoh link: <span class style=\"color:#EA1C1C;\">http://www.youtube.com/embed/xbuEmoRWQHU</span>
	 </p>
	 <p class=inline-small-label>
	 <label for=field4>Kategori</label>
	 <select name='kategori' id='kategori'>";
					foreach ($data_menu->select_menu("menu = 'Main' AND aktif = 'Ya'") as $value):
						echo "<option value='$value[id_menu]'".($r['id_kategori'] == $value['id_menu'] ? 'selected' : '').">$value[nama_menu]</option>";
						foreach ($data_menu->select_menu("menu = 'Sub'", $value[menu_dari]) as $sub_value):
							echo "<option value='$sub_value[id_menu]' ".($r['id_kategori'] == $sub_value['id_menu'] ? 'selected' : '').">--- $sub_value[nama_menu]</option>";
						endforeach;
					endforeach;
echo "</select>";
echo"<p class=inline-small-label form-group>
	<label for=field4>Jenis Berita</label>
	<input type=checkbox name='jenis_berita' value='foto' ".($r['jenis_berita'] == 'foto' ? 'checked' : '').">Foto
	<input type=checkbox name='jenis_berita' value='video' ".($r['jenis_berita'] == 'video' ? 'checked' : '').">Video
	</p>";
				if ($r[headline]=='Y'){
					echo "
	 <p class=inline-small-label>
	 <label for=field4>Headline</label>
	 <input type=radio name='headline' value='Y' checked>Ya
	 <input type=radio name='headline' value='N'>Tidak
	 </p>";}

				else{
					echo "
	 <p class=inline-small-label>
	 <label for=field4>Headline</label>
	 <input type=radio name='headline' value='Y'>Ya
	 <input type=radio name='headline' value='N' checked>Tidak
	 </p>";}
				if ($r[aktif]=='Y'){
					echo "
	 <p class=inline-small-label>
	 <label for=field4>Pilihan Redaksi</label>
	 <input type=radio name='aktif' value='Y' checked>Ya
	 <input type=radio name='aktif' value='N'>Tidak
	 </p>";}

				else{
					echo "
	 <p class=inline-small-label>
	 <label for=field4>Pilihan Redaksi</label>
	 <input type=radio name='aktif' value='Y'>Ya
	 <input type=radio name='aktif' value='N' checked>Tidak
	 </p>";}

				//////////////////////////////////////////////////////////////////////


				if ($r[utama]=='Y'){
					echo "
	 <p class=inline-small-label>
	 <label for=field4>Berita Utama</label>
	 <input type=radio name='utama' value='Y' checked>Ya
	 <input type=radio name='utama' value='N'>Tidak
	 </p>";}

				else{
					echo "
	 <p class=inline-small-label>
	 <label for=field4>Berita Utama</label>
	 <input type=radio name='utama' value='Y'>Ya
	 <input type=radio name='utama' value='N' checked>Tidak
	 </p>";}

				//////////////////////////////////////////////////////////

				echo "
	 <p class=inline-small-label>
	 <label for=field4>Isi Berita</label>
	 <textarea name='editor' id='editor' class='ckeditor' style='width: 720px; height: 350px;'>$r[isi_berita]</textarea>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Deskripsi Berita</label>
	 <textarea maxlength='160' id='deskripsi' class=form-control name='deskripsi'>$r[deskripsi]</textarea>
	 </p>
	 
	 <p class=inline-small-label>
	 <label for=field4>Topik Berita</label>
	 <input id='topik' type='text' name='topik' value='$r[topik]'>
	 </p>

	 <p class=inline-small-label>
	 <label for=field4>Tags</label>
	 <input type='text' id='tags_berita' name='tags_berita' value='$r[tag]'>
	 </p>

	 
	 <p class=inline-small-label>
	 <input type='hidden' name='img_name' value='$r[gambar]'>
	 <label for=field4>Gambar</label> ";
				if ($r[gambar]!=''){
					echo "<img src='../foto_berita/$r[gambar]' width='250px'>
	 </p>";}

	 echo "
			<p class=inline-small-label>
			<label for=field4>Ganti Gambar</label>
			<input type='file' id='fupload' name='fupload' >
			<span class style=\"color:#EA1C1C;display:block\">Foto yang akan diupload kecil dari 512K</span>
			</p> ";

	 echo "<p class=inline-small-label>
	 <label for=field4>Infografis</label> ";
				if ($r[gambar]!=''){
					echo "<img src='../info_grafis/$r[gambar]' width='250px'>
	 </p>";}
				echo "
	 <p class=inline-small-label>
	 <label for=field4>Ganti Gambar</label>
	 <input type='file' id='grafis_upload' name='grafis_upload'>
	 <span class style=\"color:#EA1C1C;display:block\">Foto yang akan diupload kecil dari 512K</span>
	 </p> ";

				echo"
	 <p class=inline-small-label>
	 <label for=field4>Gambar Kecil</label> ";
				if ($r[gambar]!=''){
					echo "<img src='../foto_small/$r[gambar1]' width='150px'>
	 </p>";}

				echo"
	 <p class=inline-small-label>
	<label for=field4>Keterangan Gbr</label>
	 <input class=form-control type=text name='keterangan_gambar' value='$r[keterangan_gambar]'>
	 </p>";

				echo  "<div class=block-actions>
	 <ul class=actions-right>
	 <li>
	 <a class='button red' id=reset-validate-form href='?module=berita'>Batal</a>
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
	} 
	else 
	{
		echo akses_salah();
	}
}
?>
</div>
</div>
</div>
<div class='clear height-fix'></div>
</div></div>

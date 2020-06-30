<?php
include "../config/koneksi.php";


$cek=umenu_akses("?module=user",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
    echo "<li><a href='?module=user'><b>Manajemen User</b></a></li>";
}


$cek=umenu_akses("?module=modul",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
    echo "<li><a href='?module=modul'><b>Manajemen Modul</b></a></li>";
}

$cek=umenu_akses("?module=muslimnote",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin' OR $_SESSION[namauser] =='muslimnote'){
    echo "<li><a href='?module=muslimnote'><b>Muslim Note</b></a></li>";
}

?>

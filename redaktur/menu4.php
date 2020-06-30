<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=iklan",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=iklan'><b>Iklan</b></a></li>";
}

?>

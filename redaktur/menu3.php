<?php
include "../config/koneksi.php";

$cek=umenu_akses("?module=video",$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='admin'){
echo "<li><a href='?module=video'><b>Video</b></a></li>";
}


?>

<?php
include '../config/koneksi.php';

function source ($table){
  $data_arr = [];
  $query = mysql_query("SELECT nama_tag FROM $table");
    while($row = mysql_fetch_array($query)):
        // var_export($row['nama_tag']);
        $data_arr[] = $row[nama_tag];
    endwhile;
  //array to json conversion 
  echo json_encode($data_arr);
}
?>
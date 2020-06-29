<?php
function seo_title($s) {
   $text = preg_replace('~[^\pL\d]+~u', '-', $s);

   $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

   $text = preg_replace('~[^-\w]+~', '', $text);

   $text = trim($text, '-');

   $text = preg_replace('~-+~', '-', $text);

   $text = strtolower($text);

   if(empty($text))
    return '';

    return $text;
}
// function seo_title($s) {
//     $c = array (' ');
//     $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

//     $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
//     $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
//     return $s;
// }
?>
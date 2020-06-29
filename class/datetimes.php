<?php
class Date_time
{
  function time_ago($original){
    $format = [
                [60*60*24*365, 'tahun'],
                [60*60*24*30, 'bulan'],
                [60*60*24*7, 'minggu'],
                [60*60*24, 'hari'],
                [60*60, 'jam'],
                [60, 'menit']
              ];

    $today = time();
    $since = $today - strtotime ($original);

    if ($since > 604800):
      $print = date("M j", strtotime ($original));

      if ($since > 31536000):
        $print .= ", ". date("Y", strtotime ($original));
      endif;

      return $print;
    endif;

    for($i = 0, $j = count($format); $i < $j; $i++ ):
      $second = $format[$i][0];
      $name = $format[$i][1];

      if( ( $count = floor($since / $second) ) <> 0 )
        break;
    endfor;

    $print = ($count == 1) ? '1 '.$name : "$count {$name}";

    return $print . " yang lalu";
  }

  function DatetoDateTime($arr, $database){
    foreach ($arr as $value) :
      $database->update ('berita', 'tanggalwaktu', $value['tanggal'], $value['jam']);
      echo "<br> success";
    endforeach;
  }

  function post_date_format( $datetime ){
    $toTime = strtotime( $datetime );

    $date = date( 'd', $toTime );
    $year = date( 'Y', $toTime );
    $hour = date( 'H:i', $toTime );
    
    // numeric representation of a day
    $day = date( 'N', $toTime );

    // numeric representation of a month
    $month = date ( 'n', $toTime );

    // Timezone Identifier
    $tz = date( 'e' );

    
    $daily = [1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Ahad"];
    $montly = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $timezone = ["Asia/Jakarta" => "WIB", "Asia/Makassar" => "WITA"];
    ;   
    

    return $daily[$day] .", ". $date ." ". $montly[$month] ." ". $year ." - ". $hour ." ". $timezone[$tz] ;
  }

}

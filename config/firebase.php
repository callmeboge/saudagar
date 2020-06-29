
<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAA_D94blg:APA91bGSul8qUzTgDLxNyFxIv0BzffIg7MqJvh88XMAQdF7gh1yh1zshUViwwSQFoLGp1_nSBl-zJ04GH28aI3S61AtbcCvl0cP7jKztAEMeFRVAtOFoP1WSiM4eN1X9-V8muh54JhTE' );
$registrationIds = array('');

// $regid = 'fp1UuQizTMs:APA91bF2ApFyMGWa3LeR4nQS1mm29ap25PWzUxlyrtIw4yCApA9vWZQIa9Hnyldl6GDOm-D3reTm12xdnvmKfhjrbf8eV-B_iBO0tuY5AQCB5Q690DQc4SK5lDlqMF5mkvtPiD3pvE5e';
// prep the bundle
$msg = array
(
	'message' 	=> 'Anu Baru',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'Semua',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);
$fields = array
(
	// 'registration_ids' 	=> $registrationIds,
  'to' 	=> $registrationIds[0],
  // 'to' => '/topics/news',
	'data'			=> $msg,
);

$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;

?>

<pre>
<?php
  var_export($_SERVER);

  define('GET_URL', ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . "://{$_SERVER['SERVER_NAME']}" . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));

/*
 * Server ROOT folder
 */
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);

/*
 * Application location, project path
 */
define('BASE_PATH', trim(str_replace(ROOT_PATH, '', str_replace(DIRECTORY_SEPARATOR, "/", dirname(__FILE__)))));

/*
 *  Ensure backslash in url
 */
define('APP_URL', rtrim(GET_URL, "/") . "/");


// echo basename($_SERVER['SCRIPT_NAME']);
// echo str_replace(ROOT_PATH, '', str_replace(DIRECTORY_SEPARATOR, "/", dirname(__FILE__)));
// echo str_replace(DIRECTORY_SEPARATOR, "/", dirname(__FILE__));
// echo str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
// echo dirname(__FILE__);
// echo __DIR__;
// echo str_replace('redaktur/', '', APP_URL);
// echo str_replace('redaktur', '', BASE_PATH);
// echo DIRECTORY_SEPARATOR;
?>
  </pre>
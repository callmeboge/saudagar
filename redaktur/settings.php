<?php

/**
 * Start the PHP SESSIOn if not started already
 */
if (!session_id()) session_start();

/* AuthCheckKey =  Session Check Key - (You can change name as per your requirement)
 * Force login for demo -true - false
 */
// $_SESSION['AuthCheckKey'] = 'CheckAuthentication';
// $_SESSION['AuthCheckKey'] = $_SESSION['sessid'];
// $_SESSION[$_SESSION['AuthCheckKey']] = false;

/*
 * Automatic base url
 */
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

/**
 * User access validation
 *
 * only login user can access CKEditor/KCFinder
 *
 * @return boolean [description]
 */
function CheckAuthentication() {
    // if session key not exist or not set
    if (!isset($_SESSION['sessid']) || $_SESSION['sessid'] === false) {
        return false;
    } else {
        return true;
    }
}

/**
 * KcFinder SESSION settings
 * @return [type] [description]
 */
function SetupKcFinder() {
    // check if user login or not
    if (CheckAuthentication()) {
        // Set KcFinder session array to prevent un-authorize access
        $_SESSION['KCFINDER']['disabled'] = false;
        // Set KcFinder session array to setup upload url
        // $_SESSION['KCFINDER']['uploadURL'] = APP_URL . "upload";
        $_SESSION['KCFINDER']['uploadURL'] = str_replace('redaktur/', '', APP_URL) . "img_body";
        // Set KcFinder session array to setup upload path
        // $_SESSION['KCFINDER']['uploadDir'] = ROOT_PATH . BASE_PATH . "/upload";
        $_SESSION['KCFINDER']['uploadDir'] = ROOT_PATH . str_replace('redaktur', '', BASE_PATH) . "img_body";

    } else {
        // If user not login or session is not set, prevent page
        $_SESSION['KCFINDER']['disabled'] = true;
    }
}

/*
 * Start Script
 * initialize all required path and sessions
 */
SetupKcFinder();

// echo '<pre>', print_r($_SESSION, true), '</pre>'; die ('debug');

/*
Array
(
    [KCFINDER] => Array
        (
            [self] => Array
                (
                    [stamp] => Array
                        (
                            [ip] => 127.0.0.1
                            [agent] => c40f98f4f0bffda78059ef8e58d95647
                        )

                    [dir] => images/
                )

            [disabled] =>
            [uploadURL] => http://localhost/CkEditor-KcFinder/upload
            [uploadDir] => D:/wamp/www/CkEditor-KcFinder/upload
        )

    [CheckAuthentication] =>
)
*/

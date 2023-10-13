<?php
/*
// FOR HOLDING GLOBAL/GENERAL VARIABLES AND SETTINGS
// HAS TO BE THE FIRST LOADED FILE
// DECLARE VARIABLES AS CONSTANTS TO BE ACCESSIBLE GLOBALLY
*/ 

// HTML BASE PATHS
define('ROOT', "http://localhost/phpcarhub");
define('MEDIA_ROOT', ROOT . '/media/');
define('STATIC_ROOT', ROOT . '/assets/');

// PHP BASE PATHS
define('APP_PATH', __DIR__ . '/../');
define('MEDIA_PATH', APP_PATH . 'media/');
define('STATIC_PATH', APP_PATH . 'assets/');



// DATABASE CONNECTION AND CONFIG
if ($_SERVER["SERVER_NAME"]  == "localhost") {
    // DATABASE PARAMETERS FOR LOCALHOST
    define('DBHOST', "localhost");
    define('DBNAME', "carshop_db");
    define('DBUSER', "root");
    define('DBPASS', "");
} else {
    // DATABASE PARAMETERS FOR PRODUCTION/LIVE
    define('DBHOST', "");
    define('DBNAME', "");
    define('DBUSER', "root");
    define('DBPASS', "");
}
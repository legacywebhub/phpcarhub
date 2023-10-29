<?php
// Importing all neccessary files
require("./app/init.php");

// Getting the full url
$url = $_GET['url'] ?? '';
// Converting url string to lowercase
$url = strtolower($url);
// Exploding the url into an array using /
$url = explode("/", $url);
// Viewing the the $url array
//print_r($url);

// Generating the path to the file
if (count($url) == 1) {
    // The first item determines the page
    $page_name = trim($url[0]);

    if ($url[0] == '') {
        $file_name = APP_PATH . "controllers/home.php";
    } else {
        $file_name = APP_PATH . "controllers/$page_name.php";
    }
} else if (count($url) == 2 && $url[0] == 'admin') {
    // Assume it's the dashboard if not given
    $section = $url[1] ?? 'dashboard';
    $file_name = APP_PATH . "controllers/admin/$section.php";
} else if (count($url) > 2) {
    $file_name = APP_PATH . "404.php";
} else {
    $file_name = APP_PATH . "404.php";
}

// Checking if page file exists
if (file_exists($file_name)) {
    require($file_name);
} else {
    require_once(APP_PATH . "404.php");
}

// Unset message after view has loaded
unset_message();
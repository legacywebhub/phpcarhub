<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

// View variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Cars";

// Checking for search in get request
if (isset($_GET['search'])) {
    $search =  strval($_GET['search']);
    $cars = paginate("SELECT * FROM cars WHERE name LIKE '%$search%' ORDER BY id DESC", 15);
} else {
    $cars = paginate("SELECT * FROM cars ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'user'=> $user,
    'cars'=> $cars
];

admin_view('cars', $context);
<?php
require("./app/init.php");

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | About us";

$context = [
    'company'=> $company,
    'title'=> $title,
];

landing_view('products', $context);
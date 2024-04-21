<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | About us";

$context = [
    'company'=> $company,
    'title'=> $title,
];

landing_view('about', $context);
<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Product";

$context = [
    'company'=> $company,
    'title'=> $title,
];

landing_view('product', $context);
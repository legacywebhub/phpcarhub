<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Blog";

$context = [
    'company'=> $company,
    'title'=> $title,
];

landing_view('blog', $context);
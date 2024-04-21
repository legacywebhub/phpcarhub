<?php

$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name']) . " | Token Expired";

$context = [
    'company'=> $company,
    'title'=> $title
];

auth_view('token-expired', $context);
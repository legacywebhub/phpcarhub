<?php

$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name']) . " | Password Reset Sent";

$context = [
    'company'=> $company,
    'title'=> $title
];

auth_view('reset-sent', $context);
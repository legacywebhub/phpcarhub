<?php

// Authorize user
$user = logged_in();

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Settings";
$settings = query_fetch("SELECT * FROM company");

$context = [
    'company'=> $company,
    'title'=> $title,
    'user'=> $user,
    'settings'=> $settings
];

admin_view('settings', $context);
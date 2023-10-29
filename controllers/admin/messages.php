<?php

// Authorizing user
$user = logged_in();

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Messages";
$messages = paginate("SELECT * FROM messages ORDER BY id DESC", 10);

$context = [
    'company'=> $company,
    'title'=> $title,
    'user'=> $user,
    'messages'=> $messages,
];

admin_view('messages', $context);
<?php

// Authorizing user
$admin = admin_logged_in();

// View variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Users";

if (isset($_GET['search'])) {
    $search =  strval($_GET['search']);
    $users = paginate("SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY id DESC", 15);
} else {
    $users = paginate("SELECT * FROM users ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'users'=> $users,
    'admin'=> $admin,
];

admin_view('users', $context);
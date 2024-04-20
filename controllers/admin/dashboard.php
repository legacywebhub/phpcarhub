<?php

// Authenticating user
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Dashboard";
$total_users = count(query_fetch("select * from users"));
$total_staffs = count(query_fetch("select * from users where is_staff = 1"));
$total_vehicles = count(query_fetch("select * from vehicles"));
$total_messages = count(query_fetch("select * from messages"));
$recent_messages = query_fetch("SELECT * FROM messages ORDER BY id DESC LIMIT 0,3");


$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'total_users'=> $total_users,
    'total_staffs'=> $total_staffs,
    'total_vehicles'=> $total_vehicles,
    'total_messages'=> $total_messages,
];

admin_view('dashboard', $context);
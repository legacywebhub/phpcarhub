<?php

// Authenticating user
$admin = admin_logged_in();

// View variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Vehicle Gallery";
$images = paginate("SELECT * FROM vehicle_images ORDER BY id DESC", 15);

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'images'=> $images
];

admin_view('vehicle-gallery', $context);
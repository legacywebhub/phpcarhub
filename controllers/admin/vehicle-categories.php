<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Vehicle Categories";

if (isset($_GET['search'])) {
    // If a vehicle was searched
    $search = $_GET['search'];
    $vehicle_categories = paginate("SELECT * FROM vehicle_categories WHERE category LIKE '%$search%'", 15);
} else {
    // Else return all vehicle_categories
    $vehicle_categories = paginate("SELECT * FROM vehicle_categories ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'vehicle_categories'=> $vehicle_categories
];

admin_view('vehicle-categories', $context);
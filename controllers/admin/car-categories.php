<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";

if (isset($_GET['search'])) {
    // If a service was searched
    $search = $_GET['search'];
    $car_categories = paginate("SELECT * FROM car_categories WHERE name LIKE '$search'", 15);
} else {
    // Else return all car_categorie
    $car_categories = paginate("SELECT * FROM car_categories ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'car_categories'=> $car_categories
];

admin_view('car-categories', $context);
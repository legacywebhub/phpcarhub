<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Products";
$vehicle_categories = query_fetch("SELECT * FROM vehicle_categories");
$vehicles = paginate("SELECT * FROM vehicles", 20);

$context = [
    'company'=> $company,
    'title'=> $title,
    'vehicle_categories'=> $vehicle_categories,
    'vehicles'=> $vehicles
];

landing_view('products', $context);
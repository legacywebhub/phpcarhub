<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Product";

// Authorizing view
if (!isset($_GET['vehicle_id'])) {
    // redirect back to products if vehicle_id not passed to url
    redirect('products');
} else {
    $vehicle_id = $_GET['vehicle_id'];
    $vehicles = query_fetch("SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id' LIMIT 1");

    if (empty($vehicles)) {
        // redirect back to products if vehicle does not exist
        redirect('products');
    }
    $vehicle = $vehicles[0];

}

$context = [
    'company'=> $company,
    'title'=> $title,
    'vehicle'=> $vehicle
];

landing_view('product', $context);
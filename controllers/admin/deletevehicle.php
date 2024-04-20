<?php

// Authorize user
$admin = admin_logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect('vehicles');
}

// Getting id
$id = intval($_GET['id']);
//  Checking for matching vehicles
$matched_vehicles = query_fetch("SELECT * FROM vehicles WHERE id = $id LIMIT 1");

if (!empty($matched_vehicles)) {
    $vehicle_image = $matched_vehicles[0]['image'];
    // Attempting to delete previous vehicle images
    $filename = MEDIA_PATH . "vehicles/$vehicle_image";
    if (file_exists($filename)) {
        // Deleting image associated to vehicle
        unlink($filename);
    }
    // Deleting vehicle finally from database
    $delete_vehicle = query_fetch("DELETE FROM vehicles WHERE id = $id");
}
redirect('vehicles');
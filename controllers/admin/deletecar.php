<?php

// Authorize user
$admin = logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect('cars');
}

// Getting id
$id = intval($_GET['id']);
//  Checking for matching cars
$matched_cars = query_fetch("SELECT * FROM cars WHERE id = $id LIMIT 1");

if (!empty($matched_cars)) {
    $car = $matched_cars[0];
    // Attempting to delete previous car image
    $filename = MEDIA_PATH . $car['image'];
    if (file_exists($filename)) {
        // Deleting image associated to car
        unlink($filename);
    }
    // Deleting car finally from database
    $delete_car = query_fetch("DELETE FROM cars WHERE id = $id");
}
redirect('cars');
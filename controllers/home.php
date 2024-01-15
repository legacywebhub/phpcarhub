<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Home";
$car_categories = query_fetch("SELECT * FROM car_categories");
$cars = query_fetch("SELECT * FROM cars");

$context = [
    'company'=> $company,
    'title'=> $title,
    'car_categories'=> $car_categories,
    'cars'=> $cars
];

landing_view('home', $context);
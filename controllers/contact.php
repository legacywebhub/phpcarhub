<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | About us";

// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Process data here
    try {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $query = query_db($sql, $data);
        $response = "success";
    } catch(Exception $e) {
        $response = "failed: $e";
    }
    // Send response as JSON
    echo json_encode($response);
    die();
}

$context = [
    'title'=> $title,
];

landing_view('contact', $context);
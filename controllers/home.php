<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Home";
$vehicle_categories = query_fetch("SELECT * FROM vehicle_categories");
$vehicles = query_fetch("SELECT * FROM vehicles LIMIT 9");

// Handling incoming AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Checking for csrf attack
    if ($data['csrf_token'] != $_SESSION['csrf_token']) {
        // Send response as JSON
        echo json_encode(['status'=> "failed", 'message'=>"Invalid request"]);
        die();
    }
    // Process data here
    $data = [
        'name'=> sanitize_input($data['name']),
        'email'=> sanitize_input($data['email']),
        'subject'=> sanitize_input($data['subject']),
        'message'=> sanitize_input($data['message'])
    ];
    try {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $query = query_db($sql, $data);
        sendMail($data['email'], $company['email'], "Message from your website", ['name'=> $data['name'], 'message'=> $data['message']]);
        $response = ['status'=> "success", 'message'=>"Message received successfully"];
    } catch(Exception) {
        $response = ['status'=> "failed", 'message'=>"Error please check your network connection"];
    }
    // Send response as JSON
    echo json_encode($response);
    die();
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'vehicle_categories'=> $vehicle_categories,
    'vehicles'=> $vehicles
];

landing_view('home', $context);
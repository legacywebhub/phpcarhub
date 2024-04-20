<?php

// Authenticating user
$admin = admin_logged_in();

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Messages";
$messages = paginate("SELECT * FROM messages ORDER BY id DESC", 10);

// Handling incoming AJAX request to delete message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Parse the JSON data into PHP array
    $data = json_decode($json_data, true);
    // Process data here
    try {
        $message_id = intval($data['id']);
        $query = query_fetch("DELETE FROM messages WHERE id = $message_id");
        $response = "success";
    } catch(Exception $e) {
        $response = "failed: $e";
    }
    // Send response as JSON
    echo json_encode($response);
    die();
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'messages'=> $messages,
];

admin_view('messages', $context);
<?php
require("../app/init.php");

// Authorizing user
$user = logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Home";
$total_users = count(query_fetch("select * from users"));
$total_staffs = count(query_fetch("select * from users where is_staff = 1"));
$total_cars = count(query_fetch("select * from cars"));
$total_messages = count(query_fetch("select * from messages"));
$recent_messages = query_fetch("SELECT * FROM messages ORDER BY id DESC LIMIT 0,3");

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
    'user'=> $user,
    'total_users'=> $total_users,
    'total_staffs'=> $total_staffs,
    'total_cars'=> $total_cars,
    'total_messages'=> $total_messages,
    'messages'=> $recent_messages
];

admin_view('home', $context);
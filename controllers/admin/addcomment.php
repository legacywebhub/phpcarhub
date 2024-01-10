<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Comment";


// Handling add comment request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    // Declaring DB variables as PHP array
    $data = [
        'post_id' => intval(sanitize_input($_POST['post_id'])),
        'name' => sanitize_input($_POST['name']),
        'email' => sanitize_input($_POST['email']),
        'comment' => sanitize_input($_POST['comment'])
    ];
    
    try {
        $query = "INSERT INTO comments (post_id, name, email, comment) 
        VALUES (:post_id, :name, :email, :comment)";
        $query = query_db($query, $data);
        $message = "Comment was successfully added";
        $message_tag = "success";
        redirect('comments', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addcomment', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin
];

admin_view('addcomment', $context);
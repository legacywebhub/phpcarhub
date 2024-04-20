<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Add Post Category";


// Handling add post category request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    
    try {
        $query = "INSERT INTO post_categories (category) VALUES (:category)";
        $query = query_db($query, ['category' => strtolower(sanitize_input($_POST['category']))]);
        $message = "Category was successfully added";
        $message_tag = "success";
        redirect('post-categories', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addpostcategory', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin
];

admin_view('addpostcategory', $context);
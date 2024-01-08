<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Add Post";
$categories = query_fetch("SELECT * FROM post_categories");


// Handling add post request
if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // Storing the post first to attach documents to
    
    // Declaring DB variables as PHP array
    $data = [
        'user_id' => intval($admin['id']),
        'category_id' => sanitize_input($_POST['category']),
        'image' => $_POST['image'],
        'slug' => create_slug(sanitize_input($_POST['title'])),
        'title' => sanitize_input($_POST['title']),
        'content' => $_POST['content'],
        'quote' => sanitize_input($_POST['quote']),
    ];
    
    try { // Adding record to DB
        $query = "INSERT INTO posts (user_id, category_id, image, slug, title, content, quote) 
        VALUES (:user_id, :category_id, :image, :slug, :title, :content, :quote)";
        $query = query_db($query, $data);
        $message = "Post was uploaded successfully";
        $message_tag = "success";
        redirect('posts', $message, $message_tag);
    } catch(Exception $error) {
        $message = "Error while saving data: $error";
        $message_tag = "danger";
    }
    redirect('addpost', $message, $message_tag);
}

// Generating CSRF Token
$csrf_token = generate_csrf_token();

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'categories'=> $categories
];

admin_view('addpost', $context);
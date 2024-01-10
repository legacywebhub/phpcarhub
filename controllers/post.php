<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Post";
$post_categories = query_fetch("SELECT * FROM post_categories ORDER BY id DESC");
$recent_posts = query_fetch("SELECT * FROM posts ORDER BY id DESC LIMIT 5");

// Authorizing view
if (!isset($_GET['title'])) {
    // redirect back to blog if title not passed to url
    redirect('blog');
} else {
    $slug = $_GET['title'];
    $posts = query_fetch("SELECT * FROM posts WHERE slug = '$slug' LIMIT 1");

    if (empty($posts)) {
        // redirect back to blog if post does not exists
        redirect('blog');
    }
    $post = $posts[0];

    // Handling edit post request
    if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {


        // Declaring DB variables as PHP array
        $data = [
            'user_id' => sanitize_input($_POST['user_id']),
            'name' => sanitize_input($_POST['name']),
            'email' => sanitize_input($_POST['email']),
            'post_id' => intval($_POST['post_id']),
            'comment' => sanitize_input($_POST['comment'])
        ];
        
        try { // Inserting comment record to DB
            $query = "INSERT into comments (user_id, name, email, post_id, comment) VALUES (:user_id, :name, :email, :post_id, :comment)";
            $query = query_db($query, $data);
            $_SESSION['message'] = "Comment submitted successfully";
            $_SESSION['message_tag'] = "success";
        } catch(Exception $error) {
            $_SESSION['message'] = "Function not available at the moment";
            $_SESSION['message_tag'] = "danger";
        }
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'company'=> $company,
    'title'=> $title,
    'post'=> $post,
    'post_categories'=> $post_categories,
    'recent_posts'=> $recent_posts
];

landing_view('post', $context);
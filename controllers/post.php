<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Post";
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
    $author = query_fetch("SELECT * FROM users WHERE id = ".$post['user_id']." LIMIT 1")[0] ?? null;

    // Handling edit post request
    if ($_SERVER["REQUEST_METHOD"]  == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

        // Declaring DB variables as PHP array
        $data = [
            'post_id' => intval($_POST['post_id']),
            'user_id' => sanitize_input($_POST['user_id']),
            'name' => sanitize_input($_POST['name']),
            'email' => sanitize_input($_POST['email']),
            'comment' => sanitize_input($_POST['comment'])
        ];
        
        try { // Inserting comment record to DB
            $query = "INSERT into comments (user_id, name, email, post_id, comment) VALUES (:user_id, :name, :email, :post_id, :comment)";
            $query = query_db($query, $data);
            $response = ['status'=> "success", 'message'=> "Comment submitted successfully"];
        } catch(Exception $error) {
            $response = ['status'=> "failed", 'message'=> "Feature not available at the moment"];
        }
        // Send response as JSON
        echo json_encode($response);
        die();
    }

}

// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'company'=> $company,
    'title'=> $title,
    'post'=> $post,
    'author'=> $author,
    'post_categories'=> $post_categories,
    'recent_posts'=> $recent_posts
];

landing_view('post', $context);
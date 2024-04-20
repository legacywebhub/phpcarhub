<?php

// Validating view
if (isset($_GET['category'])) {
    // Checking if category exists
    $category = $_GET['category'];
    $matching_categories = query_fetch("SELECT * FROM post_categories WHERE category = '$category'");

    if (empty($matching_categories)) {
        // Redirect back to blog
        redirect('blog', 'No such category', 'info');
    }
    $category_id = intval($matching_categories[0]['id']);
    $posts = paginate("SELECT * FROM posts WHERE category_id = $category_id", 10);

    if (empty($posts['result'])) {
        $_SESSION['message'] = "No result found";
        $_SESSION['message_tag'] = "secondary";
    }
} else {
    redirect('blog');
}

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Blog";
$post_categories = query_fetch("SELECT * FROM post_categories ORDER BY id DESC");
$recent_posts = query_fetch("SELECT * FROM posts ORDER BY id DESC LIMIT 5");


$context = [
    'company'=> $company,
    'title'=> $title,
    'post_categories'=> $post_categories,
    'recent_posts'=> $recent_posts,
    'posts'=> $posts
];

landing_view('blog', $context);
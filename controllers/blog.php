<?php

// Variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Blog";
$post_categories = query_fetch("SELECT * FROM post_categories ORDER BY id DESC");
$recent_posts = query_fetch("SELECT * FROM posts ORDER BY id DESC LIMIT 5");

// Checking for search in get request
if (isset($_GET['search'])) {
    // If a post was searched
    $search = $_GET['search'];
    $posts = paginate("SELECT * FROM posts WHERE title = '$search'", 10);

    if (empty($posts['result'])) {
        $_SESSION['message'] = "No result found";
        $_SESSION['message_tag'] = "secondary";
    }
} else {
    // Else return all post
    $posts = paginate("SELECT * FROM posts ORDER BY id DESC", 10);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'post_categories'=> $post_categories,
    'recent_posts'=> $recent_posts,
    'posts'=> $posts
];

landing_view('blog', $context);
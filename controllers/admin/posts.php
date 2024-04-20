<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Posts";

// Checking for search in get request
if (isset($_GET['search'])) {
    // If a post was searched
    $search = $_GET['search'];
    $posts = paginate("SELECT * FROM posts WHERE title LIKE '%$search%'", 15);
} else {
    // Else return all post
    $posts = paginate("SELECT * FROM posts ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'posts'=> $posts
];

admin_view('posts', $context);
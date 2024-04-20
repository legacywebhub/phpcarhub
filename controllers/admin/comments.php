<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucwords($company['name'])." | Comments";

// Checking for search in get request
if (isset($_GET['search'])) {
    // If a comment was searched
    $search = $_GET['search'];
    $comments = paginate("SELECT * FROM comments WHERE comment LIKE '%$search%'", 15);
} else {
    // Else return all comment
    $comments = paginate("SELECT * FROM comments ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'comments'=> $comments
];

admin_view('comments', $context);
<?php

// Authenticating admin
$admin = admin_logged_in();

// Other variables
$company = query_fetch("SELECT * FROM company ORDER BY id DESC LIMIT 1")[0];
$title = ucfirst($company['name'])." | Dashboard";

if (isset($_GET['search'])) {
    // If a service was searched
    $search = $_GET['search'];
    $post_categories = paginate("SELECT * FROM post_categories WHERE name LIKE '$search'", 15);
} else {
    // Else return all post_categorie
    $post_categories = paginate("SELECT * FROM post_categories ORDER BY id DESC", 15);
}

$context = [
    'company'=> $company,
    'title'=> $title,
    'admin'=> $admin,
    'post_categories'=> $post_categories
];

admin_view('post-categories', $context);
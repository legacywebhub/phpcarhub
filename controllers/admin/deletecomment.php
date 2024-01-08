<?php

// Authenticating admin
$admin = admin_logged_in();

// Redirecting comment if id not provided
if (!isset($_GET['id'])) {
    redirect("comments");
} else {

    // Checking if Admin is superuser
    if ($admin['is_superuser'] == 0) {
        redirect("comments", "Sorry.. You don't have such privilege", "danger");
    }

    // Getting id
    $id = intval($_GET['id']);
    //  Checking for matching comments
    $matched_comments = query_fetch("SELECT * FROM comments WHERE id = $id LIMIT 1");

    // If a record exists
    if (!empty($matched_comments)) {
        // Deleting comment from database
        query_fetch("DELETE FROM comments WHERE id = $id");
        // Redirect to comments page
        redirect("comments", "Comment successfully deleted", "success");
    }
    redirect("comments", "Invalid comment", "danger");
}
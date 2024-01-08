<?php

// Authenticating admin
$admin = admin_logged_in();

// Redirecting post if id not provided
if (!isset($_GET['id'])) {
    redirect("posts");
} else {

    // Checking if Admin is superuser
    if ($admin['is_superuser'] == 0) {
        redirect("posts", "Sorry.. You don't have such privilege", "danger");
    }

    // Getting id
    $id = intval($_GET['id']);
    //  Checking for matching posts
    $matched_posts = query_fetch("SELECT * FROM posts WHERE id = $id LIMIT 1");

    // If a record exists
    if (!empty($matched_posts)) {
        // Fetch the post
        $post = $matched_posts[0];

        // Deleting connected document
        if (!empty($post['document'])) {
            // Creating link or path to the document file
            $filename = MEDIA_PATH.'documents/'.$post['document'];

            if (file_exists($filename)) {
                // Deleting document from media folder
                unlink($filename);
            }
        }
        
        // Deleting post finally from database
        query_fetch("DELETE FROM posts WHERE id = $id");
        // Redirect to posts page
        redirect("posts", "Post successfully deleted", "success");
    }
    redirect("posts", "Invalid post", "danger");
}
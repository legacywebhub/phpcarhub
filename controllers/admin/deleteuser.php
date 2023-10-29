<?php

// Authorize user
$user = logged_in();

// Redirecting user if id not provided
if (!isset($_GET['id'])) {
    redirect('users');
}

// Getting id
$id = intval($_GET['id']);
//  Checking for matching users
$matched_users = query_fetch("SELECT * FROM users WHERE id = $id LIMIT 1");

if (!empty($matched_users)) {
    $user = $matched_users[0];
    // Attempting to delete previous user image
    $filename = MEDIA_PATH . $user['image'];
    if (file_exists($filename)) {
        // Deleting image associated to user
        unlink($filename);
    }
    // Deleting user finally from database
    $delete_user = query_fetch("DELETE FROM users WHERE id = $id");
}
redirect('users');